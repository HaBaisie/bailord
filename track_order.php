<?php
include 'includes/session.php';

// Ensure no output before JSON
ob_start();
header('Content-Type: application/json');

try {
    // Log request data for debugging
    error_log('track_order.php called with POST: ' . json_encode($_POST));

    $conn = $pdo->open();
    $sales_id = isset($_POST['id']) ? $_POST['id'] : null;
    $unique_order_id = isset($_POST['unique_order_id']) ? $_POST['unique_order_id'] : null;

    if (!$sales_id || !$unique_order_id) {
        error_log('track_order.php: Invalid request - sales_id: ' . $sales_id . ', unique_order_id: ' . $unique_order_id);
        echo json_encode(['success' => false, 'error' => 'Invalid request parameters']);
        exit;
    }

    // Use PDO prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT unique_order_id, tracking_link, created_at FROM delivery_tasks WHERE sales_id = :sales_id AND unique_order_id = :unique_order_id");
    $stmt->execute(['sales_id' => $sales_id, 'unique_order_id' => $unique_order_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo json_encode([
            'success' => true,
            'unique_order_id' => $row['unique_order_id'],
            'tracking_link' => $row['tracking_link'],
            'created_at' => $row['created_at']
        ]);
    } else {
        error_log('track_order.php: No tracking data found for sales_id: ' . $sales_id . ', unique_order_id: ' . $unique_order_id);
        echo json_encode(['success' => false, 'error' => 'Tracking information not available']);
    }

    $pdo->close();
} catch (PDOException $e) {
    error_log('track_order.php PDOException: ' . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    error_log('track_order.php Exception: ' . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Server error: ' . $e->getMessage()]);
}
ob_end_flush();
?>
