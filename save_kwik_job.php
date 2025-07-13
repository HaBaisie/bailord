<?php
include 'config.php';
require_once 'includes/session.php';
$conn = $pdo->open();

header('Content-Type: application/json');

$sales_id = isset($_POST['sales_id']) ? (int)$_POST['sales_id'] : 0;
$job_id = isset($_POST['job_id']) ? trim($_POST['job_id']) : '';
$pickup_tracking_link = isset($_POST['pickup_tracking_link']) ? trim($_POST['pickup_tracking_link']) : '';
$delivery_tracking_link = isset($_POST['delivery_tracking_link']) ? trim($_POST['delivery_tracking_link']) : '';

if (!$sales_id || !$job_id) {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    exit;
}

try {
    $stmt = $conn->prepare("INSERT INTO kwik_jobs (sales_id, job_id, pickup_tracking_link, delivery_tracking_link, created_at) 
                            VALUES (:sales_id, :job_id, :pickup_tracking_link, :delivery_tracking_link, NOW())");
    $stmt->execute([
        'sales_id' => $sales_id,
        'job_id' => $job_id,
        'pickup_tracking_link' => $pickup_tracking_link,
        'delivery_tracking_link' => $delivery_tracking_link
    ]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

$pdo->close();
?>
