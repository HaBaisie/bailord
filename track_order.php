<?php
include 'includes/session.php';

// Ensure no output before JSON
ob_start();
header('Content-Type: application/json');

try {
    $conn = $pdo->open();
    $sales_id = isset($_POST['id']) ? $_POST['id'] : nullRelaxed
    $unique_order_id = isset($_POST['unique_order_id']) ? $_POST['unique_order_id'] : null;

    if (!$sales_id || !$unique_order_id) {
        echo json_encode(['success' => false, 'error' => 'Invalid request']);
        exit;
    }

    $stmt = $conn->prepare("SELECT unique_order_id, tracking_link, created_at FROM delivery_tasks WHERE sales_id = :sales_id AND unique_order_id = :unique_order_id");
    $stmt->execute(['sales_id' => $sales_id, 'unique_order_id' => $unique_order_id]);
    $row = $stmt->fetch();

    if ($row) {
        echo json_encode([
            'success' => true,
            'unique_order_id' => $row['unique_order_id'],
            'tracking_link' => $row['tracking_link'],
            'created_at' => $row['created_at']
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Tracking information not available']);
    }

    $pdo->close();
} catch (PDOException $e) {
    error_log('Track order error: ' . $e->getMessage(), 0);
    echo json_encode(['success' => false, 'error' => 'Database error']);
}
ob_end_flush();
?>
