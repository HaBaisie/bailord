<?php
include 'config.php';
require_once 'includes/session.php';
$conn = $pdo->open();

header('Content-Type: application/json');

$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
$sales_id = isset($_POST['sales_id']) ? (int)$_POST['sales_id'] : 0;
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$address = isset($_POST['address']) ? trim($_POST['address']) : '';
$latitude = isset($_POST['latitude']) ? floatval($_POST['latitude']) : 0;
$longitude = isset($_POST['longitude']) ? floatval($_POST['longitude']) : 0;
$cart_total = isset($_POST['cart_total']) ? floatval($_POST['cart_total']) : 0;
$delivery_cost = isset($_POST['delivery_cost']) ? floatval($_POST['delivery_cost']) : 0;

if (!$user_id || !$sales_id || !$name || !$phone || !$address || !$latitude || !$longitude || !$delivery_cost) {
    error_log("Missing parameters: user_id=$user_id, sales_id=$sales_id, name=$name, phone=$phone, address=$address, latitude=$latitude, longitude=$longitude, delivery_cost=$delivery_cost");
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    $pdo->close();
    exit;
}

if (!preg_match('/^\+234\d{10}$/', $phone)) {
    error_log("Invalid phone number format: $phone");
    echo json_encode(['success' => false, 'message' => 'Invalid phone number format']);
    $pdo->close();
    exit;
}

try {
    // Fetch access token and vendor_id
    $stmt = $conn->prepare("SELECT access_token, vendor_id, kwik_user_id, card_id FROM kwik_tokens WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $token_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$token_data || !$token_data['access_token'] || !$token_data['vendor_id']) {
        error_log("No access token or vendor_id found for user_id: $user_id");
        echo json_encode(['success' => false, 'message' => 'Delivery service not initialized']);
        $pdo->close();
        exit;
    }

    // Re-fetch delivery price to get additional fields
    $pickup_time = date('Y-m-d H:i:s');
    $delivery_time = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $payload = [
        'custom_field_template' => 'pricing-template',
        'pickup_custom_field_template' => 'pricing-template',
        'access_token' => $token_data['access_token'],
        'domain_name' => KWIK_DOMAIN,
        'timezone' => 60, // WAT (UTC+1)
        'vendor_id' => $token_data['vendor_id'],
        'user_id' => $token_data['kwik_user_id'],
        'auto_assignment' => 0,
        'layout_type' => 0,
        'has_pickup' => 1,
        'has_delivery' => 1,
        'is_multiple_tasks' => 1,
        'payment_method' => 32,
        'form_id' => 2,
        'is_schedule_task' => 0,
        'pickups' => [
            [
                'address' => '2 Ijegun Rd, Ikotun 100265, Lagos, Nigeria',
                'name' => 'Bailord',
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
                'name' => $name,
                'email' => KWIK_EMAIL,
                'phone' => $phone,
                'latitude' => (string)$latitude,
                'longitude' => (string)$longitude,
                'time' => $delivery_time,
                'has_return_task' => false,
                'is_package_insured' => 0
            ]
        ],
        'is_loader_required' => 0,
        'delivery_instruction' => 'Leave package at front desk',
        'is_cod_job' => 0,
        'parcel_amount' => $cart_total,
        'vehicle_id' => 1 // Default; will be updated below
    ];

    // Fetch vehicle and price details
    $ch = curl_init(KWIK_BASE_URL . '/send_payment_for_task');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token_data['access_token']
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    error_log("Kwik send_payment_for_task Request: " . json_encode($payload));
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($response === false) {
        $curl_error = curl_error($ch);
        error_log("send_payment_for_task cURL Error: $curl_error");
        echo json_encode(['success' => false, 'message' => 'cURL error: ' . $curl_error]);
        $pdo->close();
        exit;
    }

    $price_data = json_decode($response, true);
    if ($http_code !== 200 || json_last_error() !== JSON_ERROR_NONE || !isset($price_data['data']['per_task_cost'])) {
        $error_message = isset($price_data['message']) ? $price_data['message'] : 'Invalid response';
        error_log("send_payment_for_task Error: HTTP $http_code, Response: " . substr($response, 0, 500));
        echo json_encode(['success' => false, 'message' => 'Failed to fetch delivery price: ' . $error_message]);
        $pdo->close();
        exit;
    }

    $vehicle_id = $price_data['data']['vehicle_id'] ?? 1;
    $total_no_of_tasks = $price_data['data']['total_no_of_tasks'] ?? 1;
    $total_service_charge = $price_data['data']['total_service_charge'] ?? $delivery_cost;
    $is_loader_required = $price_data['data']['is_loader_required'] ?? 0;
    $loaders_amount = $price_data['data']['loaders_amount'] ?? 0;
    $loaders_count = $price_data['data']['loaders_count'] ?? 0;
    $delivery_instruction = $price_data['data']['delivery_instruction'] ?? 'Leave package at front desk';
    $insurance_amount = $price_data['data']['insurance_amount'] ?? 0;

    // Ensure numeric fields are strings where required
    $task_payload = [
        'domain_name' => KWIK_DOMAIN,
        'access_token' => $token_data['access_token'],
        'vendor_id' => $token_data['vendor_id'],
        'is_multiple_tasks' => 1,
        'timezone' => 60, // WAT (UTC+1)
        'has_pickup' => 1,
        'has_delivery' => 1,
        'layout_type' => 0,
        'auto_assignment' => 1,
        'team_id' => '',
        'pickups' => [
            [
                'address' => '2 Ijegun Rd, Ikotun 100265, Lagos, Nigeria',
                'name' => 'Bailord',
                'latitude' => 6.4320951,
                'longitude' => 3.274,
                'time' => $pickup_time,
                'phone' => '+2348161589373',
                'email' => KWIK_EMAIL,
                'template_data' => [],
                'template_name' => '',
                'ref_images' => []
            ]
        ],
        'deliveries' => [
            [
                'address' => $address,
                'name' => $name,
                'latitude' => (string)$latitude,
                'longitude' => (string)$longitude,
                'time' => $delivery_time,
                'phone' => $phone,
                'email' => KWIK_EMAIL,
                'template_data' => [
                    ['label' => 'Order Total', 'data' => '₦' . number_format($cart_total, 2)],
                    ['label' => 'Delivery Cost', 'data' => '₦' . number_format($delivery_cost, 2)]
                ],
                'template_name' => '',
                'ref_images' => [],
                'has_return_task' => false,
                'is_package_insured' => 0,
                'hadVairablePayment' => 1,
                'hadFixedPayment' => 0,
                'is_task_otp_required' => 0
            ]
        ],
        'insurance_amount' => (string)$insurance_amount,
        'total_no_of_tasks' => (string)$total_no_of_tasks,
        'total_service_charge' => (string)$total_service_charge,
        'payment_method' => 524288, // EOMB
        'amount' => (string)$delivery_cost, // Convert to string
        'surge_cost' => '0',
        'surge_type' => '0',
        'delivery_instruction' => $delivery_instruction,
        'loaders_amount' => (string)$loaders_amount,
        'loaders_count' => (string)$loaders_count,
        'is_loader_required' => $is_loader_required,
        'delivery_images' => '',
        'vehicle_id' => (string)$vehicle_id,
        'sareaId' => '6' // Default; adjust if needed
    ];

    $ch = curl_init(KWIK_BASE_URL . '/v2/create_task_via_vendor');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token_data['access_token']
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($task_payload));
    error_log("Kwik create_task_via_vendor Request: " . json_encode($task_payload));
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($response === false) {
        $curl_error = curl_error($ch);
        error_log("create_task_via_vendor cURL Error: $curl_error");
        echo json_encode(['success' => false, 'message' => 'cURL error: ' . $curl_error]);
        $pdo->close();
        exit;
    }

    $response_data = json_decode($response, true);
    error_log("Kwik create_task_via_vendor Response: " . substr($response, 0, 500) . " | HTTP Code: $http_code");

    if ($http_code === 200 && isset($response_data['status']) && $response_data['status'] === 200) {
        // Save task details
        $stmt = $conn->prepare("
            INSERT INTO delivery_tasks (sales_id, user_id, job_id, job_hash, job_token, unique_order_id, tracking_link, created_at)
            VALUES (:sales_id, :user_id, :job_id, :job_hash, :job_token, :unique_order_id, :tracking_link, NOW())
        ");
        $stmt->execute([
            'sales_id' => $sales_id,
            'user_id' => $user_id,
            'job_id' => $response_data['data']['deliveries'][0]['job_id'],
            'job_hash' => $response_data['data']['deliveries'][0]['job_hash'],
            'job_token' => $response_data['data']['deliveries'][0]['job_token'],
            'unique_order_id' => $response_data['data']['unique_order_id'],
            'tracking_link' => $response_data['data']['deliveries'][0]['result_tracking_link']
        ]);

        echo json_encode(['success' => true, 'message' => 'Delivery task created successfully']);
    } else {
        $error_message = isset($response_data['message']) ? $response_data['message'] : 'Failed to create task';
        error_log("Kwik API error: HTTP $http_code, Response: " . substr($response, 0, 500));
        echo json_encode(['success' => false, 'message' => 'Failed to create delivery task: ' . $error_message, 'response' => $response_data]);
    }
} catch (Exception $e) {
    error_log("Exception in create_kwik_task.php: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}

$pdo->close();
?>
