<?php
include 'config.php';
require_once 'includes/session.php';
$conn = $pdo->open();

header('Content-Type: application/json');

$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
$address = isset($_POST['address']) ? trim($_POST['address']) : '';
$latitude = isset($_POST['latitude']) ? floatval($_POST['latitude']) : 0;
$longitude = isset($_POST['longitude']) ? floatval($_POST['longitude']) : 0;
$cart_total = isset($_POST['cart_total']) ? floatval($_POST['cart_total']) : 0;
$name = isset($_POST['name']) ? trim($_POST['name']) : '';

if (!$user_id || !$address || !$latitude || !$longitude || !$name) {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    exit;
}

try {
    // Fetch access token
    $stmt = $conn->prepare("SELECT access_token, vendor_id, kwik_user_id, card_id FROM kwik_tokens WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $token_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$token_data) {
        echo json_encode(['success' => false, 'message' => 'No access token found']);
        exit;
    }

    // Get current time in Lagos (WAT, UTC+1)
    $pickup_time = date('Y-m-d H:i:s', time() + 60 * 60); // Add 1 hour for WAT

    $payload = [
        'custom_field_template' => 'pricing-template', // Confirm with Kwik support
        'pickup_custom_field_template' => 'pricing-template', // Added from documentation
        'access_token' => $token_data['access_token'],
        'domain_name' => KWIK_DOMAIN,
        'timezone' => 60, // WAT (UTC+1) in minutes
        'vendor_id' => $token_data['vendor_id'],
        'user_id' => $token_data['kwik_user_id'], // Use kwik_user_id from kwik_tokens
        'auto_assignment' => 0,
        'layout_type' => 0,
        'has_pickup' => 1,
        'has_delivery' => 1,
        'is_multiple_tasks' => 1,
        'payment_method' => 32, // Paystack (per cart.view.php integration)
        'form_id' => 2, // Confirm with Kwik support
        'is_schedule_task' => 0,
        'pickups' => [
            [
                'address' => '2 Ijegun Rd, Ikotun 100265, Lagos, Nigeria',
                'name' => 'Bailord', // Pickup point name
                'email' => KWIK_EMAIL,
                'phone' => '+2348161589373',
                'latitude' => '6.4320951',
                'longitude' => '3.274',
                'time' => $pickup_time
            ]
        ],
        'deliveries' => [
            [
                'address' => $address,
                'name' => $name, // From delivery form
                'email' => KWIK_EMAIL,
                'phone' => '+2348161589373',
                'latitude' => (string)$latitude,
                'longitude' => (string)$longitude,
                'time' => $pickup_time,
                'has_return_task' => false,
                'is_package_insured' => 0
            ]
        ],
        'is_loader_required' => 0,
        'delivery_instruction' => 'Leave package at front desk',
        'is_cod_job' => 0,
        'parcel_amount' => $cart_total, // Use cart total
        'vehicle_id' => 0 // Default to small vehicle; fetch from /getVehicle if needed
    ];

    $ch = curl_init(KWIK_BASE_URL . '/send_payment_for_task');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token_data['access_token']
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Temporary for debugging
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Temporary for debugging
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    error_log("Kwik Delivery Price Request: " . json_encode($payload));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($response === false) {
        $curl_error = curl_error($ch);
        curl_close($ch);
        error_log("cURL Error: " . $curl_error);
        echo json_encode(['success' => false, 'message' => 'cURL error: ' . $curl_error]);
        exit;
    }

    error_log("Kwik Delivery Price Response: " . $response . " | HTTP Code: " . $http_code);
    curl_close($ch);

    if ($http_code !== 200) {
        $response_data = json_decode($response, true);
        $error_message = isset($response_data['message']) ? $response_data['message'] : 'Unknown error';
        echo json_encode(['success' => false, 'message' => 'API error: ' . $error_message, 'response' => $response_data]);
        exit;
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON Decode Error: " . json_last_error_msg());
        echo json_encode(['success' => false, 'message' => 'Invalid JSON response: ' . json_last_error_msg()]);
        exit;
    }

    if (isset($data['data']['per_task_cost'])) {
        echo json_encode([
            'success' => true,
            'delivery_cost' => $data['data']['per_task_cost']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No delivery cost returned', 'response' => $data]);
    }
} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$pdo->close();
?>
