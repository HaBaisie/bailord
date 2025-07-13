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
    // Log user_id for debugging
    error_log("User ID received: " . $user_id);

    // Authenticate with Kwik API
    $ch = curl_init(KWIK_BASE_URL . '/vendor_login');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Temporary for debugging
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Temporary for debugging
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate'); // Handle gzip decompression
    $post_data = [
        'email' => KWIK_EMAIL,
        'password' => KWIK_PASSWORD,
        'api_login' => api_login,
        'domain_name' => domain_name
    ];
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
    error_log("Kwik API Request: " . json_encode($post_data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($response === false) {
        $curl_error = curl_error($ch);
        curl_close($ch);
        error_log("cURL Error: " . $curl_error);
        echo json_encode(['success' => false, 'message' => 'cURL error: ' . $curl_error]);
        exit;
    }

    error_log("Kwik API Response: " . $response . " | HTTP Code: " . $http_code);
    curl_close($ch);

    if ($http_code !== 200) {
        $response_data = json_decode($response, true);
        $error_message = $response_data['message'] ?? 'Unknown error';
        echo json_encode(['success' => false, 'message' => 'Authentication failed: ' . $error_message, 'http_code' => $http_code, 'response' => $response]);
        exit;
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON Decode Error: " . json_last_error_msg());
        echo json_encode(['success' => false, 'message' => 'Invalid JSON response: ' . json_last_error_msg(), 'response' => $response]);
        exit;
    }

    if (!isset($data['data']['access_token'])) {
        echo json_encode(['success' => false, 'message' => 'No access token received', 'response' => $data]);
        exit;
    }

    $access_token = $data['data']['access_token'];
    $vendor_id = $data['data']['vendor_details']['vendor_id'];
    $user_id_kwik = $data['data']['vendor_details']['user_id'];
    $card_id = $data['data']['vendor_details']['card_id'];

    // Store token in database
    $stmt = $conn->prepare("INSERT INTO kwik_tokens (user_id, access_token, vendor_id, kwik_user_id, card_id, created_at) 
                            VALUES (:user_id, :access_token, :vendor_id, :kwik_user_id, :card_id, NOW())
                            ON DUPLICATE KEY UPDATE 
                            access_token = VALUES(access_token),
                            vendor_id = VALUES(vendor_id),
                            kwik_user_id = VALUES(kwik_user_id),
                            card_id = VALUES(card_id),
                            created_at = NOW()");
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
    error_log("Exception: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$pdo->close();
?>
