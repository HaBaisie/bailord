<?php
include 'includes/session.php';
$conn = $pdo->open();

header('Content-Type: application/json');

try {
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;

    if (!$user_id || !$location) {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO sales (user_id, location, pay_id, sales_date, status) VALUES (:user_id, :location, :pay_id, CURDATE(), 'pending')");
    $pay_id = 'TEMP_' . time(); // Temporary pay_id, updated after Paystack
    $stmt->execute(['user_id' => $user_id, 'location' => $location, 'pay_id' => $pay_id]);
    $sales_id = $conn->lastInsertId();

    echo json_encode(['success' => true, 'sales_id' => $sales_id]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

$pdo->close();
?>