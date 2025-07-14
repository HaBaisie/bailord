<?php
include 'includes/session.php';

// Ensure no output before JSON
ob_start();
header('Content-Type: application/json');

try {
    // Log request data for debugging
    error_log('track_order.php called with POST: ' . json_encode($_POST));

    $conn = $pdo->open();
    $sales_id = isset($_POST['sales_id']) ? (int)$_POST['sales_id'] : null;
    $unique_order_id = isset($_POST['unique_order_id']) ? $_POST['unique_order_id'] : null;
    $user_id = isset($_SESSION['user']) ? (int)$_SESSION['user'] : null;

    if (!$sales_id || !$unique_order_id || !$user_id) {
        error_log('track_order.php: Invalid request - sales_id: ' . $sales_id . ', unique_order_id: ' . $unique_order_id . ', user_id: ' . $user_id);
        echo json_encode(['success' => false, 'error' => 'Invalid request parameters']);
        exit;
    }

    // Get vendor_id as customer_id from kwik_tokens
    $stmt = $conn->prepare("SELECT vendor_id, access_token FROM kwik_tokens WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $token_row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$token_row) {
        error_log('track_order.php: No token found for user_id: ' . $user_id);
        echo json_encode(['success' => false, 'error' => 'No valid access token found']);
        exit;
    }
    $customer_id = $token_row['vendor_id'];
    $access_token = $token_row['access_token'];

    // Verify task exists in delivery_tasks
    $stmt = $conn->prepare("SELECT unique_order_id, tracking_link, created_at FROM delivery_tasks WHERE sales_id = :sales_id AND unique_order_id = :unique_order_id");
    $stmt->execute(['sales_id' => $sales_id, 'unique_order_id' => $unique_order_id]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$task) {
        error_log('track_order.php: No tracking data found for sales_id: ' . $sales_id . ', unique_order_id: ' . $unique_order_id);
        echo json_encode(['success' => false, 'error' => 'Tracking information not available']);
        exit;
    }

    // Call Kwik API
    $url = "https://staging-api-test.kwik.delivery/getJobStatus?unique_order_id=" . urlencode($unique_order_id) . "&customer_id=" . urlencode($customer_id);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $access_token"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code !== 200) {
        error_log("track_order.php: Kwik API error - HTTP $http_code, Response: $response");
        echo json_encode(['success' => false, 'error' => "API request failed with status $http_code"]);
        exit;
    }

    // Handle non-JSON response (e.g., "UNASSIGNED,UNASSIGNED")
    if (strpos($response, 'UNASSIGNED') !== false) {
        echo json_encode([
            'success' => true,
            'status' => 'unassigned',
            'tracking_link' => $task['tracking_link'] ?? "https://staging-dashboard.kwik.delivery/tracking/index.html?jobID=" . urlencode($task['job_hash'] ?? $unique_order_id),
            'driver_name' => 'N/A',
            'driver_phone' => 'N/A',
            'estimated_delivery' => 'N/A',
            'created_at' => $task['created_at']
        ]);
        exit;
    }

    // Parse JSON response
    $data = json_decode($response, true);
    if ($data === null) {
        error_log("track_order.php: Invalid JSON response: $response");
        echo json_encode(['success' => false, 'error' => 'Invalid API response format']);
        exit;
    }

    if ($data['success']) {
        echo json_encode([
            'success' => true,
            'status' => $data['data']['status'] ?? 'unknown',
            'tracking_link' => $data['data']['tracking_link'] ?? $task['tracking_link'] ?? "https://staging-dashboard.kwik.delivery/tracking/index.html?jobID=" . urlencode($task['job_hash'] ?? $unique_order_id),
            'driver_name' => $data['data']['driver_details']['name'] ?? 'N/A',
            'driver_phone' => $data['data']['driver_details']['phone'] ?? 'N/A',
            'estimated_delivery' => $data['data']['estimated_delivery_time'] ?? 'N/A',
            'created_at' => $task['created_at']
        ]);
    } else {
        error_log("track_order.php: Kwik API failed: " . $data['message']);
        echo json_encode(['success' => false, 'error' => $data['message']]);
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
