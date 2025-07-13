<?php
include 'config.php';
require_once 'includes/session.php';
$conn = $pdo->open();

header('Content-Type: application/json');

$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
$address = isset($_POST['address']) ? trim($_POST['address']) : '';
$latitude = isset($_POST['latitude']) ? floatval($_POST['latitude']) : 0;
$longitude = isset($_POST['longitude']) ? floatval($_POST['longitude']) : 0;

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

    $payload = [
        'custom_field_template' => 'pricing-template',
        'access_token' => $token_data['access_token'],
        'domain_name' => KWIK_DOMAIN,
        'vendor_id' => $token_data['vendor_id'],
        'auto_assignment' => 0,
        'layout_type' => 0,
        'has_pickup' => 1,
        'has_delivery' => 1,
        'is_multiple_tasks' => 1,
        'payment_method' => 262144,
        'form_id' => 2,
        'is_schedule_task' => 0,
        'pickups' => [
            [
                'address' => '2 Ijegun Rd, Ikotun 100265, Lagos, Nigeria',
                'email' => KWIK_EMAIL,
                'phone' => '+2348161589373',
                'latitude' => '6.4320951',
                'longitude' => '3.274'
            ]
        ],
        'deliveries' => [
            [
                'address' => $address,
                'email' => KWIK_EMAIL,
                'phone' => '+2348161589373',
                'latitude' => (string)$latitude,
                'longitude' => (string)$longitude,
                'is_package_insured' => 0
            ]
        ],
        'is_loader_required' => 0,
        'delivery_instruction' => 'Leave package at front desk',
        'is_cod_job' => 1,
        'parcel_amount' => 0 // Will be updated after cart total
    ];

    $ch = curl_init(KWIK_BASE_URL . '/send_payment_for_task');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token_data['access_token']
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code !== 200) {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch delivery price']);
        exit;
    }

    $data = json_decode($response, true);
    if (isset($data['data']['amount'])) {
        echo json_encode([
            'success' => true,
            'delivery_cost' => $data['data']['amount']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No delivery cost returned']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$pdo->close();
?>