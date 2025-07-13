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

if (!$user_id || !$sales_id || !$name || !$phone || !$address || !$latitude || !$longitude || !$cart_total || !$delivery_cost) {
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
        'domain_name' => KWIK_DOMAIN,
        'access_token' => $token_data['access_token'],
        'vendor_id' => $token_data['vendor_id'],
        'is_multiple_tasks' => true,
        'timezone' => '-60',
        'has_pickup' => true,
        'has_delivery' => true,
        'layout_type' => 0,
        'auto_assignment' => 0,
        'pickups' => [
            [
                'address' => '2 Ijegun Rd, Ikotun 100265, Lagos, Nigeria',
                'name' => 'Habeebullahi Lawal',
                'latitude' => '6.4320951',
                'longitude' => '3.274',
                'time' => date('Y-m-d H:i:s', strtotime('+1 hour')),
                'phone' => '+2348161589373',
                'email' => KWIK_EMAIL,
                'template_data' => [
                    ['label' => 'baseFare', 'data' => 300],
                    ['label' => 'distanceFare', 'data' => 25],
                    ['label' => 'timeFare', 'data' => 30],
                    ['label' => 'totalTimeTaken', 'data' => 0],
                    ['label' => 'job_distance', 'data' => 0],
                    ['label' => 'pricingType', 'data' => 'variable'],
                    ['label' => 'insuranceAmount', 'data' => 0]
                ],
                'template_name' => 'pricing-template',
                'ref_images' => []
            ]
        ],
        'deliveries' => [
            [
                'address' => $address,
                'name' => $name,
                'latitude' => (string)$latitude,
                'longitude' => (string)$longitude,
                'time' => date('Y-m-d H:i:s', strtotime('+2 hours')),
                'phone' => $phone,
                'email' => KWIK_EMAIL,
                'template_data' => [
                    ['label' => 'baseFare', 'data' => 300],
                    ['label' => 'distanceFare', 'data' => 25],
                    ['label' => 'timeFare', 'data' => 30],
                    ['label' => 'totalTimeTaken', 'data' => 0],
                    ['label' => 'job_distance', 'data' => 0],
                    ['label' => 'pricingType', 'data' => 'variable'],
                    ['label' => 'insuranceAmount', 'data' => 0]
                ],
                'template_name' => 'pricing-template',
                'ref_images' => [],
                'is_package_insured' => 0
            ]
        ],
        'insurance_amount' => 0,
        'total_no_of_tasks' => 1,
        'total_service_charge' => $delivery_cost,
        'payment_method' => 262144,
        'amount' => $delivery_cost,
        'is_loader_required' => 0,
        'loaders_amount' => 0,
        'loaders_count' => 0,
        'delivery_instruction' => 'Leave package at front desk',
        'vehicle_id' => 1,
        'delivery_images' => '',
        'is_cod_job' => 1,
        'surge_cost' => 0,
        'surge_type' => 0,
        'is_task_otp_required' => 0
    ];

    $ch = curl_init(KWIK_BASE_URL . '/createTask');
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
        echo json_encode(['success' => false, 'message' => 'Failed to create delivery task']);
        exit;
    }

    $data = json_decode($response, true);
    if (isset($data['data']['job_id'])) {
        // Save job details to database
        $stmt = $conn->prepare("INSERT INTO kwik_jobs (sales_id, job_id, pickup_tracking_link, delivery_tracking_link, created_at) 
                                VALUES (:sales_id, :job_id, :pickup_tracking_link, :delivery_tracking_link, NOW())");
        $stmt->execute([
            'sales_id' => $sales_id,
            'job_id' => $data['data']['job_id'],
            'pickup_tracking_link' => $data['data']['pickup_tracking_link'] ?? '',
            'delivery_tracking_link' => 'https://www.openstreetmap.org/?mlat=' . $latitude . '&mlon=' . $longitude . '#map=15/' . $latitude . '/' . $longitude
        ]);

        echo json_encode([
            'success' => true,
            'job_id' => $data['data']['job_id'],
            'total_amount' => $cart_total + $delivery_cost
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No job ID returned']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$pdo->close();
?>