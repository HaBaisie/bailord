<?php
include 'config.php';
require_once 'includes/session.php';
$conn = $pdo->open();

header('Content-Type: application/json');

$user_id = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
if (!$user_id) {
    echo json_encode(['success' => false, 'message' => 'User ID is required']);
    exit;
}

try {
    // Authenticate with Kwik API
    $ch = curl_init(KWIK_BASE_URL . 'vendor_login');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'email' => KWIK_EMAIL,
        'password' => KWIK_PASSWORD
    ]));
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code !== 200) {
        echo json_encode(['success' => false, 'message' => 'Authentication failed']);
        exit;
    }

    $data = json_decode($response, true);
    if (!isset($data['body']['data']['access_token'])) {
        echo json_encode(['success' => false, 'message' => 'No access token received']);
        exit;
    }

    $access_token = $data['body']['data']['access_token'];
    $vendor_id = $data['body']['data']['vendor_details']['vendor_id'];
    $user_id_kwik = $data['body']['data']['vendor_details']['user_id'];
    $card_id = $data['body']['data']['vendor_details']['card_id'];

    // Store token in database
    $stmt = $conn->prepare("INSERT INTO kwik_tokens (user_id, access_token, vendor_id, kwik_user_id, card_id, created_at) 
                            VALUES (:user_id, :access_token, :vendor_id, :kwik_user_id, :card_id, NOW())
                            ON DUPLICATE KEY UPDATE access_token = :access_token, vendor_id = :vendor_id, 
                            kwik_user_id = :kwik_user_id, card_id = :card_id, created_at = NOW()");
    $stmt->execute([
        'user_id' => $user_id,
        'access_token' => $access_token,
        'vendor_id' => $vendor_id,
        'kwik_user_id' => $user_id_kwik,
        'card_id' => $card_id
    ]);

    echo json_encode([
        'success' => true,
        'access_token' => $access_token,
        'vendor_id' => $vendor_id,
        'kwik_user_id' => $user_id_kwik,
        'card_id' => $card_id
    ]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$pdo->close();
?>
