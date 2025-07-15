<?php
include 'includes/session.php';
include 'config.php';

// Enable error logging, disable display errors
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

// Set JSON header early
header('Content-Type: application/json');

$secret_key = 'sk_test_73a80011cd7cc3926aa141d442bd6130afab1b6d'; // Test Secret Key

try {
    if (!isset($_SESSION['user'])) {
        error_log('No user session found');
        echo json_encode(['success' => false, 'message' => 'Please log in to process payment']);
        exit;
    }

    $reference = isset($_POST['reference']) ? trim($_POST['reference']) : (isset($_GET['reference']) ? trim($_GET['reference']) : '');
    $checkout_token = isset($_POST['checkout_token']) ? trim($_POST['checkout_token']) : (isset($_GET['checkout_token']) ? trim($_GET['checkout_token']) : '');
    $total_amount = isset($_POST['total_amount']) ? floatval($_POST['total_amount']) : 0;
    $is_delivery = isset($_POST['total_amount']); // If total_amount is sent via POST, it's a delivery order

    if (empty($reference) || empty($checkout_token)) {
        error_log("Missing parameters: reference=$reference, checkout_token=$checkout_token");
        echo json_encode(['success' => false, 'message' => 'No payment reference or checkout token provided']);
        exit;
    }

    $conn = $pdo->open();

    // Verify checkout session
    $stmt = $conn->prepare("SELECT user_id, location FROM checkout_sessions WHERE checkout_token = :checkout_token");
    $stmt->execute(['checkout_token' => $checkout_token]);
    $session = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$session) {
        error_log("Invalid checkout token: $checkout_token");
        echo json_encode(['success' => false, 'message' => 'Invalid checkout session']);
        exit;
    }

    $user_id = $session['user_id'];
    $location = $session['location'];

    // Verify Paystack transaction
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . urlencode($reference),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $secret_key",
            "Content-Type: application/json"
        ],
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2
    ]);
    $response = curl_exec($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        error_log("Paystack cURL error: $err, HTTP Code: $http_code");
        echo json_encode(['success' => false, 'message' => 'Payment verification failed: cURL Error']);
        exit;
    }

    $response = json_decode($response, true);
    if (!$response || !isset($response['status']) || !$response['status'] || $response['data']['status'] !== 'success') {
        error_log("Paystack verification failed: HTTP $http_code, Response: " . json_encode($response));
        echo json_encode(['success' => false, 'message' => 'Payment verification failed']);
        exit;
    }

    $paystack_amount = $response['data']['amount'] / 100; // Convert from kobo to NGN
    if ($is_delivery && abs($paystack_amount - $total_amount) > 0.01) {
        error_log("Amount mismatch: Paystack=$paystack_amount, Expected=$total_amount");
        echo json_encode(['success' => false, 'message' => 'Payment amount mismatch']);
        exit;
    }

    // Check if already processed
    $stmt = $conn->prepare("SELECT id FROM sales WHERE pay_id = :pay_id AND user_id = :user_id");
    $stmt->execute(['pay_id' => $reference, 'user_id' => $user_id]);
    if ($stmt->rowCount() > 0) {
        $sales_id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
        error_log("Transaction already processed: sales_id=$sales_id");
        echo json_encode(['success' => true, 'sales_id' => $sales_id, 'message' => 'Transaction already processed']);
        exit;
    }

    // Insert into sales table
    $stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date, total_amount, delivery_address, status) VALUES (:user_id, :pay_id, CURDATE(), :total_amount, :delivery_address, 'pending')");
    $stmt->execute([
        'user_id' => $user_id,
        'pay_id' => $reference,
        'total_amount' => $paystack_amount,
        'delivery_address' => $location
    ]);
    $sales_id = $conn->lastInsertId();

    // Move cart items to details table
    $stmt = $conn->prepare("SELECT c.product_id, c.quantity, p.price FROM cart c LEFT JOIN products p ON p.id = c.product_id WHERE c.user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cart_items)) {
        error_log("No cart items found for user_id: $user_id");
        echo json_encode(['success' => false, 'message' => 'No items in cart']);
        exit;
    }

    foreach ($cart_items as $row) {
        if (!isset($row['price']) || $row['price'] === null) {
            error_log("Missing price for product_id: {$row['product_id']}");
            $row['price'] = 0.00; // Fallback price
        }
        $stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity, price) VALUES (:sales_id, :product_id, :quantity, :price)");
        $stmt->execute([
            'sales_id' => $sales_id,
            'product_id' => $row['product_id'],
            'quantity' => $row['quantity'],
            'price' => $row['price']
        ]);
    }

    // Clear cart
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);

    // Delete checkout session
    $stmt = $conn->prepare("DELETE FROM checkout_sessions WHERE checkout_token = :checkout_token");
    $stmt->execute(['checkout_token' => $checkout_token]);

    error_log("Transaction successful: sales_id=$sales_id, user_id=$user_id");
    echo json_encode(['success' => true, 'sales_id' => $sales_id, 'message' => 'Transaction successful']);
} catch (PDOException $e) {
    error_log("PDO error in sales.php: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Order creation failed: ' . $e->getMessage()]);
} catch (Exception $e) {
    error_log("General error in sales.php: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
} finally {
    if (isset($conn)) {
        $pdo->close();
    }
}
?>
