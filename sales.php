<?php
include 'includes/session.php';

$secret_key = 'sk_test_73a80011cd7cc3926aa141d442bd6130afab1b6d'; // Replace with your Test Secret Key

if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];
    $date = date('Y-m-d');

    // Verify Paystack transaction
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
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
        $_SESSION['error'] = "Payment verification failed: cURL Error - " . $err;
        header('location: cart_view.php');
        exit;
    }

    $response = json_decode($response, true);

    if ($response['status'] && $response['data']['status'] === 'success') {
        $conn = $pdo->open();

        try {
            // Insert into sales table
            $stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date) VALUES (:user_id, :pay_id, :sales_date)");
            $stmt->execute(['user_id' => $user['id'], 'pay_id' => $reference, 'sales_date' => $date]);
            $salesid = $conn->lastInsertId();

            // Move cart items to details table
            try {
                $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
                $stmt->execute(['user_id' => $user['id']]);

                foreach ($stmt as $row) {
                    $stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity) VALUES (:sales_id, :product_id, :quantity)");
                    $stmt->execute(['sales_id' => $salesid, 'product_id' => $row['product_id'], 'quantity' => $row['quantity']]);
                }

                // Clear cart
                $stmt = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id");
                $stmt->execute(['user_id' => $user['id']]);

                $_SESSION['success'] = 'Transaction successful. Thank you.';
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Cart processing failed: ' . $e->getMessage();
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Order creation failed: ' . $e->getMessage();
        }

        $pdo->close();
    } else {
        $_SESSION['error'] = 'Payment verification failed: Invalid or unsuccessful transaction.';
    }
} else {
    $_SESSION['error'] = 'No payment reference provided.';
}

header('location: cart_view.php');
?>
