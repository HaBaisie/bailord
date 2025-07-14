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
    echo json_encode(['success' => false, 'message' => 'Missing required parameters', 'delivery_cost' => 2000]);
    exit;
}

try {
    // Fetch access token
    $stmt = $conn->prepare("SELECT access_token, vendor_id, kwik_user_id, card_id FROM kwik_tokens WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $token_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$token_data) {
        echo json_encode(['success' => false, 'message' => 'No access token found', 'delivery_cost' => 2000]);
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
    $vehicle_content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE) ?: 'unknown';
    curl_close($ch);

    $vehicle_id = 3; // Default to taxi (lower cost)
    if ($vehicle_response !== false) {
        $vehicle_data = json_decode($vehicle_response, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            if ($vehicle_http_code === 200 && isset($vehicle_data['data']) && is_array($vehicle_data['data'])) {
                $found_taxi = false;
                $found_car_6 = false;
                foreach ($vehicle_data['data'] as $vehicle) {
                    if ($vehicle['vehicle_id'] == 3) {
                        $found_taxi = true;
                        break;
                    } elseif ($vehicle['vehicle_id'] == 10) {
                        $found_car_6 = true;
                    }
                }
                if (!$found_taxi) {
                    $vehicle_id = $found_car_6 ? 10 : (isset($vehicle_data['data'][0]['vehicle_id']) ? $vehicle_data['data'][0]['vehicle_id'] : 3);
                }
            } elseif (isset($vehicle_data['message']) && in_array($vehicle_data['message'], ['"access_token" is required', 'Session expired. Please logout and login again.'])) {
                error_log("Kwik Vehicle Response: Authentication error: " . $vehicle_data['message'] . " | HTTP Code: " . $vehicle_http_code . " | Content-Type: " . $vehicle_content_type);
                // Attempt to refresh token
                $ch = curl_init('https://bailord-0b4b2667ca4f.herokuapp.com/login_kwik.php');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
                curl_setopt($ch, CURLOPT_POSTFIELDS, 'user_id=' . $user_id);
                $login_response = curl_exec($ch);
                curl_close($ch);
                $login_data = json_decode($login_response, true);
                if ($login_data && isset($login_data['success']) && $login_data['success'] && isset($login_data['access_token'])) {
                    $stmt = $conn->prepare("UPDATE kwik_tokens SET access_token = :access_token, vendor_id = :vendor_id, kwik_user_id = :kwik_user_id, card_id = :card_id WHERE user_id = :user_id");
                    $stmt->execute([
                        'access_token' => $login_data['access_token'],
                        'vendor_id' => $login_data['vendor_id'],
                        'kwik_user_id' => $login_data['kwik_user_id'],
                        'card_id' => $login_data['card_id'] ?? '',
                        'user_id' => $user_id
                    ]);
                    $token_data['access_token'] = $login_data['access_token'];
                    $token_data['vendor_id'] = $login_data['vendor_id'];
                    $token_data['kwik_user_id'] = $login_data['kwik_user_id'];
                    error_log("Refreshed access_token: " . $login_data['access_token']);
                    // Retry /getVehicle
                    $ch = curl_init(KWIK_BASE_URL . '/getVehicle');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        'Content-Type: application/json',
                        'Authorization: Bearer ' . $token_data['access_token']
                    ]);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                    $vehicle_response = curl_exec($ch);
                    $vehicle_http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $vehicle_content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE) ?: 'unknown';
                    curl_close($ch);
                    $vehicle_data = json_decode($vehicle_response, true);
                    if (json_last_error() === JSON_ERROR_NONE && $vehicle_http_code === 200 && isset($vehicle_data['data']) && is_array($vehicle_data['data'])) {
                        $found_taxi = false;
                        $found_car_6 = false;
                        foreach ($vehicle_data['data'] as $vehicle) {
                            if ($vehicle['vehicle_id'] == 3) {
                                $found_taxi = true;
                                break;
                            } elseif ($vehicle['vehicle_id'] == 10) {
                                $found_car_6 = true;
                            }
                        }
                        if (!$found_taxi) {
                            $vehicle_id = $found_car_6 ? 10 : (isset($vehicle_data['data'][0]['vehicle_id']) ? $vehicle_data['data'][0]['vehicle_id'] : 3);
                        }
                        error_log("Kwik Vehicle Retry Response: " . substr($vehicle_response, 0, 500) . " | HTTP Code: " . $vehicle_http_code . " | Content-Type: " . $vehicle_content_type);
                    } else {
                        error_log("Kwik Vehicle Retry Failed: " . substr($vehicle_response, 0, 500) . " | HTTP Code: " . $vehicle_http_code . " | Content-Type: " . $vehicle_content_type);
                    }
                } else {
                    error_log("Failed to refresh token: " . $login_response);
                    echo json_encode(['success' => false, 'message' => 'Authentication error: Unable to refresh token', 'delivery_cost' => 2000]);
                    exit;
                }
            } else {
                error_log("Kwik Vehicle Response: Invalid JSON or unexpected response: " . substr($vehicle_response, 0, 500) . " | HTTP Code: " . $vehicle_http_code . " | Content-Type: " . $vehicle_content_type);
            }
        } else {
            error_log("Kwik Vehicle Response: JSON decode error: " . json_last_error_msg() . " | Response: " . substr($vehicle_response, 0, 500) . " | HTTP Code: " . $vehicle_http_code . " | Content-Type: " . $vehicle_content_type);
        }
    } else {
        error_log("Kwik Vehicle cURL Error: " . curl_error($ch));
    }
    error_log("Selected vehicle_id: " . $vehicle_id);

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
    $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE) ?: 'unknown';
    if ($response === false) {
        $curl_error = curl_error($ch);
        curl_close($ch);
        error_log("cURL Error: " . $curl_error);
        echo json_encode(['success' => false, 'message' => 'cURL error: ' . $curl_error, 'delivery_cost' => 2000]);
        exit;
    }

    error_log("Kwik Delivery Price Response: " . substr($response, 0, 500) . " | HTTP Code: " . $http_code . " | Content-Type: " . $content_type);
    curl_close($ch);

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON Decode Error: " . json_last_error_msg() . " | Response: " . substr($response, 0, 500));
        echo json_encode(['success' => false, 'message' => 'Invalid API response format: JSON decode error', 'response' => substr($response, 0, 500), 'delivery_cost' => 2000]);
        exit;
    }

    if ($http_code !== 200 || (isset($data['status']) && in_array($data['status'], [100, 101]))) {
        $error_message = isset($data['message']) ? $data['message'] : 'Unknown API error';
        if (in_array($error_message, ['"access_token" is required', 'Session expired. Please logout and login again.'])) {
            error_log("Kwik Delivery Response: Authentication error: " . $error_message . " | HTTP Code: " . $http_code . " | Content-Type: " . $content_type);
            // Attempt to refresh token
            $ch = curl_init('https://bailord-0b4b2667ca4f.herokuapp.com/login_kwik.php');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'user_id=' . $user_id);
            $login_response = curl_exec($ch);
            curl_close($ch);
            $login_data = json_decode($login_response, true);
            if ($login_data && isset($login_data['success']) && $login_data['success'] && isset($login_data['access_token'])) {
                $stmt = $conn->prepare("UPDATE kwik_tokens SET access_token = :access_token, vendor_id = :vendor_id, kwik_user_id = :kwik_user_id, card_id = :card_id WHERE user_id = :user_id");
                $stmt->execute([
                    'access_token' => $login_data['access_token'],
                    'vendor_id' => $login_data['vendor_id'],
                    'kwik_user_id' => $login_data['kwik_user_id'],
                    'card_id' => $login_data['card_id'] ?? '',
                    'user_id' => $user_id
                ]);
                $payload['access_token'] = $login_data['access_token'];
                $token_data['access_token'] = $login_data['access_token'];
                $token_data['vendor_id'] = $login_data['vendor_id'];
                $token_data['kwik_user_id'] = $login_data['kwik_user_id'];
                error_log("Refreshed access_token: " . $login_data['access_token']);
                // Retry send_payment_for_task with new token
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
                $response = curl_exec($ch);
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE) ?: 'unknown';
                curl_close($ch);
                error_log("Kwik Delivery Price Retry Response: " . substr($response, 0, 500) . " | HTTP Code: " . $http_code . " | Content-Type: " . $content_type);
                $data = json_decode($response, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    echo json_encode(['success' => false, 'message' => 'Invalid API response format: JSON decode error', 'response' => substr($response, 0, 500), 'delivery_cost' => 2000]);
                    exit;
                }
            } else {
                error_log("Failed to refresh token: " . $login_response);
                echo json_encode(['success' => false, 'message' => 'Authentication error: Unable to refresh token', 'delivery_cost' => 2000]);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'API error: ' . $error_message, 'response' => $data, 'delivery_cost' => 2000]);
            exit;
        }
    }

    if (isset($data['data']['per_task_cost']) && is_numeric($data['data']['per_task_cost'])) {
        $delivery_cost = floatval($data['data']['per_task_cost']);
        if ($delivery_cost > 2000) { // Lowered threshold to catch high costs
            error_log("Unreasonably high delivery cost: " . $delivery_cost . " for vehicle_id: " . $vehicle_id . " | hadVairablePayment: " . (isset($data['data']['hadVairablePayment']) ? $data['data']['hadVairablePayment'] : 'N/A'));
            echo json_encode(['success' => false, 'message' => 'Delivery cost too high: ₦' . $delivery_cost, 'response' => $data, 'delivery_cost' => 2000]);
            exit;
        }
        echo json_encode(['success' => true, 'delivery_cost' => $delivery_cost]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No delivery cost returned or invalid format', 'response' => $data, 'delivery_cost' => 2000]);
    }
} catch (Exception $e) {
    error_log("Exception in get_delivery_price.php: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage(), 'delivery_cost' => 2000]);
}
$pdo->close();
?>
