<?php
include 'includes/session.php';

// Configuration constants
const KWIK_API_URL = 'https://staging-api-test.kwik.delivery/login';
const KWIK_VENDOR_EMAIL = 'lawalhabeeb3191@gmail.com';
const KWIK_VENDOR_PASSWORD = 'Kwik2025$';
const KWIK_DOMAIN_NAME = 'staging-client-panel.kwik.delivery';
const KWIK_DEFAULT_VENDOR_ID = 3876;

// Enable error reporting for Heroku logs
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'php://stderr');

/**
 * Make a POST request to the Kwik API
 * @param array $payload Data to send in the request
 * @return array [http_code, response, error]
 */
function callKwikApi(array $payload): array {
    $ch = curl_init(KWIK_API_URL);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($payload),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/json',
            'User-Agent: Bailord/1.0'
        ],
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_VERBOSE => true
    ]);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    error_log("Kwik API Request: Payload=" . json_encode($payload));
    error_log("Kwik API Response: HTTP $http_code - " . ($response ?: 'No response'));
    
    return [$http_code, $response, $error];
}

/**
 * Save or update token in the database
 * @param PDO $conn Database connection
 * @param int $user_id User ID
 * @param string $access_token Access token from API
 * @param int $vendor_id Vendor ID from API or default
 * @return bool Success status
 */
function saveKwikToken(PDO $conn, int $user_id, string $access_token, int $vendor_id): bool {
    try {
        $stmt = $conn->prepare(
            "INSERT INTO kwik_tokens (user_id, vendor_id, access_token, created_at) 
             VALUES (:user_id, :vendor_id, :access_token, NOW()) 
             ON DUPLICATE KEY UPDATE access_token = :access_token, created_at = NOW()"
        );
        $result = $stmt->execute([
            'user_id' => $user_id,
            'vendor_id' => $vendor_id,
            'access_token' => $access_token
        ]);
        error_log("Kwik Token Save: user_id=$user_id, vendor_id=$vendor_id, success=" . ($result ? 'true' : 'false'));
        return $result;
    } catch (PDOException $e) {
        error_log("Kwik Token Database Error: " . $e->getMessage());
        return false;
    }
}

$response = ['success' => false, 'message' => 'Unknown error'];

try {
    // Validate user_id
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
    if ($user_id === false || $user_id === null) {
        $response['message'] = 'Invalid or missing User ID';
        error_log('Kwik Login Error: Invalid or missing user_id');
        echo json_encode($response);
        exit;
    }

    error_log("Kwik Login: Starting request for user_id=$user_id");

    // Prepare API payload
    $payload = [
        'email' => KWIK_VENDOR_EMAIL,
        'password' => KWIK_VENDOR_PASSWORD,
        'domain_name' => KWIK_DOMAIN_NAME,
        'api_login' => 1
    ];

    // Call Kwik API
    [$http_code, $curl_response, $curl_error] = callKwikApi($payload);

    if ($curl_response === false) {
        $response['message'] = 'Failed to connect to Kwik API: ' . $curl_error;
        error_log("Kwik Login Error: cURL failed - $curl_error");
        echo json_encode($response);
        exit;
    }

    $data = json_decode($curl_response, true);
    if ($data === null) {
        $response['message'] = 'Invalid JSON response from Kwik API';
        $response['http_code'] = $http_code;
        $response['raw_response'] = $curl_response;
        error_log("Kwik Login Error: Invalid JSON - $curl_response");
        echo json_encode($response);
        exit;
    }

    if ($http_code === 200 && isset($data['data']['access_token'])) {
        $conn = $pdo->open();
        $vendor_id = $data['data']['vendor_id'] ?? KWIK_DEFAULT_VENDOR_ID;
        $access_token = $data['data']['access_token'];

        if (saveKwikToken($conn, $user_id, $access_token, $vendor_id)) {
            $response = [
                'success' => true,
                'access_token' => $access_token,
                'vendor_id' => $vendor_id
            ];
            error_log("Kwik Login Success: Token saved for user_id=$user_id");
        } else {
            $response['message'] = 'Failed to save token to database';
            error_log("Kwik Login Error: Failed to save token for user_id=$user_id");
        }
    } else {
        $response['message'] = $data['message'] ?? 'Failed to login';
        $response['http_code'] = $http_code;
        $response['raw_response'] = $curl_response;
        error_log("Kwik Login Failed: HTTP $http_code - Message: {$response['message']} - Raw: $curl_response");
    }
} catch (Exception $e) {
    $response['message'] = 'Unexpected error: ' . $e->getMessage();
    error_log("Kwik Login Unexpected Error: " . $e->getMessage());
} finally {
    if (isset($conn)) {
        $pdo->close();
    }
    echo json_encode($response);
}
?>
