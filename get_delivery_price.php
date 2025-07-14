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
$name = isset($_POST['name']) ? trim($_POST['name']) : 'Customer';

if (!$user_id || !$address || !$latitude || !$longitude) {
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

    // Fetch vehicle ID from /getVehicle
    $ch = curl_init(KWIK_BASE_URL . '/getVehicle');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token_data['access_token']
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Temporary for debugging
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Temporary for debugging
    $vehicle_response = curl_exec($ch);
    $vehicle_http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $vehicle_content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    curl_close($ch);

    $vehicle_id = 10; // Default to car 6 (lowest fares)
    if ($vehicle_response !== false) {
        if (strpos($vehicle_content_type, 'application/json') === false) {
            error_log("Kwik Vehicle Response: Non-JSON response: " . $vehicle_response . " | HTTP Code: " . $vehicle_http_code);
            echo json_encode(['success' => false, 'message' => 'Invalid vehicle API response format']);
            exit;
        }
        $vehicle_data = json_decode($vehicle_response, true);
        if ($vehicle_http_code === 200 && isset($vehicle_data['data']) && is_array($vehicle_data['data'])) {
            $found_car_6 = false;
            $found_taxi = false;
            foreach ($vehicle_data['data'] as $vehicle) {
                if ($vehicle['vehicle_id'] == 10) {
                    $found_car_6 = true;
                    break;
                } elseif ($vehicle['vehicle_id'] == 3) {
                    $found_taxi = true;
                }
            }
            if (!$found_car_6) {
                $vehicle_id = $found_taxi ? 3 : (isset($vehicle_data['data'][0]['vehicle_id']) ? $vehicle_data['data'][0]['vehicle_id'] : 10);
            }
        }
        error_log("Kwik Vehicle Response: " . $vehicle_response . " | HTTP Code: " . $vehicle_http_code . " | Selected vehicle_id: " . $vehicle_id);
    } else {
        error_log("Kwik Vehicle cURL Error: " . curl_error($ch));
        echo json_encode(['success' => false, 'message' => 'Failed to fetch vehicle data']);
        exit;
    }

    // Get current time in Lagos (WAT, UTC+1)
    $pickup_time = date('Y-m-d H:i:s', time() + 60 * 60);

    $payload = [
        'custom_field_template' => 'pricing-template',
        'pickup_custom_field_template' => 'pricing-template',
        'access_token' => $token_data['access_token'],
        'domain_name' => KWIK_DOMAIN,
        'timezone' => 60,
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
        'parcel_amount' => $cart_total,
        'vehicle_id' => $vehicle_id
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
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    error_log("Kwik Delivery Price Request: " . json_encode($payload));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    if ($response === false) {
        $curl_error = curl_error($ch);
        curl_close($ch);
        error_log("cURL Error: " . $curl_error);
        echo json_encode(['success' => false, 'message' => 'cURL error: ' . $curl_error]);
        exit;
    }

    error_log("Kwik Delivery Price Response: " . $response . " | HTTP Code: " . $http_code . " | Content-Type: " . $content_type);
    curl_close($ch);

    if (strpos($content_type, 'application/json') === false) {
        echo json_encode(['success' => false, 'message' => 'Invalid API response format: Expected JSON, got ' . $content_type, 'response' => $response]);
        exit;
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON Decode Error: " . json_last_error_msg());
        echo json_encode(['success' => false, 'message' => 'Invalid API response format: JSON decode error', 'response' => $response]);
        exit;
    }

    if ($http_code !== 200) {
        $error_message = isset($data['message']) ? $data['message'] : 'Unknown API error';
        echo json_encode(['success' => false, 'message' => 'API error: ' . $error_message, 'response' => $data]);
        exit;
    }

    if (isset($data['data']['per_task_cost']) && is_numeric($data['data']['per_task_cost'])) {
        $delivery_cost = floatval($data['data']['per_task_cost']);
        if ($delivery_cost > 100000) {
            error_log("Unreasonably high delivery cost: " . $delivery_cost . " for vehicle_id: " . $vehicle_id);
            echo json_encode(['success' => false, 'message' => 'Delivery cost too high: ₦' . $delivery_cost, 'response' => $data]);
            exit;
        }
        echo json_encode(['success' => true, 'delivery_cost' => $delivery_cost]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No delivery cost returned or invalid format', 'response' => $data]);
    }
} catch (Exception $e) {
    error_log("Exception in get_delivery_price.php: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
$pdo->close();
?>
