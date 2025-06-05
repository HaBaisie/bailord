<?php
include 'includes/session.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = 'Please log in to process payment';
    header('location: login.php');
    exit;
}

if (!isset($_GET['reference'])) {
    $_SESSION['error'] = 'No payment reference provided';
    header('location: cart_view.php?payment=failed');
    exit;
}

$reference = $_GET['reference'];
$date = date('Y-m-d');
$conn = $pdo->open();

try {
    // Verify Paystack transaction
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . urlencode($reference),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer " . getenv('PAYSTACK_SECRET_KEY'),
            "Content-Type: application/json"
        ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        throw new Exception("cURL Error: " . $err);
    }

    $response = json_decode($response, true);

    if ($response['status'] && $response['data']['status'] === 'success') {
        // Check if already processed
        $stmt = $conn->prepare("SELECT id FROM sales WHERE pay_id = :pay_id AND user_id = :user_id");
        $stmt->execute(['pay_id' => $reference, 'user_id' => $_SESSION['user']['id']]);
        if ($stmt->rowCount() > 0) {
            $_SESSION['success'] = 'Order already processed';
            header('location: orders.php');
            exit;
        }

        // Insert into sales
        $stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date, status) VALUES (:user_id, :pay_id, :sales_date, 'pending')");
        $stmt->execute(['user_id' => $_SESSION['user']['id'], 'pay_id' => $reference, 'sales_date' => $date]);
        $sales_id = $conn->lastInsertId();

        // Move cart to details
        $stmt = $conn->prepare("SELECT c.product_id, c.quantity, p.price FROM cart c LEFT JOIN products p ON p.id = c.product_id WHERE c.user_id = :user_id");
        $stmt->execute(['user_id' => $_SESSION['user']['id']]);
        foreach ($stmt as $row) {
            $stmt_detail = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity, price) VALUES (:sales_id, :product_id, :quantity, :price)");
            $stmt_detail->execute([
                'sales_id' => $sales_id,
                'product_id' => $row['product_id'],
                'quantity' => $row['quantity'],
                'price' => $row['price']
            ]);
        }

        // Clear cart
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $_SESSION['user']['id']]);

        $_SESSION['success'] = 'Transaction successful. Your order has been placed.';
        header('location: profile.php');
    } else {
        throw new Exception('Invalid or unsuccessful transaction');
    }
} catch (Exception $e) {
    $_SESSION['error'] = 'Payment verification failed: ' . $e->getMessage();
    header('location: cart_view.php?payment=failed');
}

$pdo->close();
?>
