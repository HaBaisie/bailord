<?php
include 'includes/session.php';

$secret_key = 'sk_test_73a80011cd7cc3926aa141d442bd6130afab1b6d'; // Test Secret Key

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
        header('location: cart_view.php?payment=failed');
        exit;
    }

    $response = json_decode($response, true);

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
        try {
            $stmt = $conn->prepare("SELECT c.product_id, c.quantity, p.price FROM cart c LEFT JOIN products p ON p.id = c.product_id WHERE c.user_id = :user_id");
            $stmt->execute(['user_id' => $_SESSION['user']]);

            foreach ($stmt as $row) {
                $stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity, price) VALUES (:sales_id, :product_id, :quantity, :price)");
                $stmt->execute(['sales_id' => $salesid, 'product_id' => $row['product_id'], 'quantity' => $row['quantity'], 'price' => $row['price']]);
            }

            // Clear
