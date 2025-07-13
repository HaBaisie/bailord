<?php
include 'includes/session.php';
$conn = $pdo->open();

header('Content-Type: application/json');

try {
    $sales_id = isset($_POST['sales_id']) ? $_POST['sales_id'] : null;
    $job_id = isset($_POST['job_id']) ? $_POST['job_id'] : null;
    $pickup_tracking_link = isset($_POST['pickup_tracking_link']) ? $_POST['pickup_tracking_link'] : null;
    $delivery_tracking_link = isset($_POST['delivery_tracking_link']) ? $_POST['delivery_tracking_link'] : null;

    if (!$sales_id || !$job_id) {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO kwik_jobs (sales_id, job_id, pickup_tracking_link, delivery_tracking_link) VALUES (:sales_id, :job_id, :pickup_tracking_link, :delivery_tracking_link)");
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