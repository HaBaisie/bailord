<?php
include 'includes/session.php';

$secret_key = 'sk_test_73a80011cd7cc3926aa141d442bd6130afab1b6d'; // Test Secret Key

// Enable error logging
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

if (!isset($_SESSION['user'])) {
    error_log('No user session found');
    $_SESSION['error'] = 'Please log in to process payment';
    header('location: login.php');
    exit;
}

if (!isset($_GET['reference'])) {
    error_log('No reference provided');
    $_SESSION['error'] = 'No payment reference provided';
    header('location: cart_view.php?payment=failed');
    exit;
}

$reference = $_GET['reference'];
$date = date('Y-m-d');

try {
    $conn = $pdo->open();
} catch (PDOException $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    $_SESSION['error'] = 'Database connection failed';
    header('location: cart_view.php?payment=failed');
    exit;
}

try {
    // Verify Paystack transaction
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . urlencode($reference),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $secret_key",
            "Content-Type: application/json"
        ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        error_log("Paystack cURL error: $err");
        $_SESSION['error'] = "Payment verification failed: cURL Error - " . $err;
        header('location: cart_view.php?payment=failed');
        exit;
    }

    $response = json_decode($response, true);
    if (!$response || !isset($response['status'])) {
        error_log('Invalid Paystack response: ' . print_r($response, true));
        $_SESSION['error'] = 'Payment verification failed: Invalid response';
        header('location: cart_view.php?payment=failed');
        exit;
    }

    if ($response['status'] && $response['data']['status'] === 'success') {
        // Check if already processed
        $stmt = $conn->prepare("SELECT id FROM sales WHERE pay_id = :pay_id AND user_id = :user_id");
        $stmt->execute(['pay_id' => $reference, 'user_id' => $_SESSION['user']]);
        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = 'Transaction already processed';
            $pdo->close();
            header('location: profile.php');
            exit;
        }

        // Insert into sales table
        $stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date, status) VALUES (:user_id, :pay_id, :sales_date, 'pending')");
        $stmt->execute(['user_id' => $_SESSION['user'], 'pay_id' => $reference, 'sales_date' => $date]);
        $salesid = $conn->lastInsertId();

        // Move cart items to details table
        $stmt = $conn->prepare("SELECT c.product_id, c.quantity, p.price FROM cart c LEFT JOIN products p ON p.id = c.product_id WHERE c.user_id = :user_id");
        $stmt->execute(['user_id' => $_SESSION['user']]);
        $cart_items = $stmt->fetchAll();

        if (empty($cart_items)) {
            error_log('No cart items found for user_id: ' . $_SESSION['user']);
            $_SESSION['error'] = 'No items in cart';
            $pdo->close();
            header('location: cart_view.php?payment=failed');
            exit;
        }

        foreach ($cart_items as $row) {
            if (!isset($row['price']) || $row['price'] === null) {
                error_log('Missing price for product_id: ' . $row['product_id']);
                $row['price'] = 0.00; // Fallback price
            }
            $stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity, price) VALUES (:sales_id, :product_id, :quantity, :price)");
            $stmt->execute([
                'sales_id' => $salesid,
                'product_id' => $row['product_id'],
                'quantity' => $row['quantity'],
                'price' => $row['price']
            ]);
        }

        // Clear cart
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $_SESSION['user']]);

        $_SESSION['success'] = 'Transaction successful. Thank you.';
        $pdo->close();
        header('location: profile.php');
        exit;
    } else {
        error_log('Paystack verification failed: ' . print_r($response, true));
        $_SESSION['error'] = 'Payment verification failed: Invalid or unsuccessful transaction.';
    }
} catch (PDOException $e) {
    error_log('PDO error: ' . $e->getMessage());
    $_SESSION['error'] = 'Order creation failed: ' . $e->getMessage();
} catch (Exception $e) {
    error_log('General error: ' . $e->getMessage());
    $_SESSION['error'] = 'An error occurred: ' . $e->getMessage();
}

$pdo->close();
header('location: cart_view.php?payment=failed');
?>
