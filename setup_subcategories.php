<?php
include 'includes/session.php';
include 'config.php';
$conn = $pdo->open();

header('Content-Type: application/json');

try {
    $user_id = isset($_SESSION['user']) ? $_SESSION['user'] : null;

    if (!$user_id) {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
        exit;
    }

    // Authenticate with Kwik API using /vendor_login with all required parameters
    $endpoint = 'https://staging-api-test.kwik.delivery/vendor_login';
    $payload = [
        'domain_name' => 'staging-client-panel.kwik.delivery',
        'email' => 'lawalhabeeb3191@gmail.com', // Consider moving to config.php
        'password' => 'Kwik2025$', // Consider moving to config.php
        'api_login' => 1
    ];

    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip'); // Handle gzip response
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Temporary for testing
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // Temporary for testing
    
    // Debugging setup
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    $verbose = fopen('php://temp', 'w+');
    curl_setopt($ch, CURLOPT_STDERR, $verbose);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch);
    curl_close($ch);

    // Log debugging info
    rewind($verbose);
    $verbose_log = stream_get_contents($verbose);
    file_put_contents('kwik_debug.log', 
        "Request to: $endpoint\n" .
        "Payload: " . json_encode($payload) . "\n" .
        "Response: $response\n" .
        "HTTP Code: $http_code\n" .
        "cURL Error: $curl_error\n" .
        "Verbose Log: $verbose_log\n\n",
        FILE_APPEND
    );

    if ($http_code !== 200) {
        $response_data = json_decode($response, true);
        $error_message = $response_data['message'] ?? 'Unknown error';
        echo json_encode([
            'success' => false,
            'message' => 'Kwik API authentication failed: ' . $error_message,
            'http_code' => $http_code,
            'curl_error' => $curl_error,
            'response' => $response_data
        ]);
        exit;
    }

    $data = json_decode($response, true);
    
    // Debug: Output full response to check structure
    // file_put_contents('kwik_response.log', print_r($data, true));
    
    // Adjust these field names based on actual API response structure
    if (!isset($data['access_token'])) {
        echo json_encode([
            'success' => false,
            'message' => 'No access token received from Kwik API',
            'response' => $data
        ]);
        exit;
    }

    // Extract token and vendor details - adjust field names as needed
    $access_token = $data['access_token'];
    $vendor_id = $data['vendor_id'] ?? '';
    $kwik_user_id = $data['user_id'] ?? '';
    $card_id = $data['card_id'] ?? '';

    // Drop existing tables
    $conn->exec("DROP TABLE IF EXISTS kwik_jobs");
    $conn->exec("DROP TABLE IF EXISTS kwik_tokens");

    // Create new kwik_tokens table
    $conn->exec("CREATE TABLE IF NOT EXISTS kwik_tokens (
        user_id INT PRIMARY KEY,
        access_token VARCHAR(255) NOT NULL,
        vendor_id VARCHAR(50) NOT NULL,
        kwik_user_id VARCHAR(50) NOT NULL,
        card_id VARCHAR(50) NOT NULL,
        created_at DATETIME NOT NULL,
        UNIQUE KEY (user_id),
        FOREIGN KEY (user_id) REFERENCES users(id)
    )");

    // Create new kwik_jobs table
    $conn->exec("CREATE TABLE IF NOT EXISTS kwik_jobs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        sales_id INT NOT NULL,
        job_id VARCHAR(50) NOT NULL,
        pickup_tracking_link TEXT,
        delivery_tracking_link TEXT,
        created_at DATETIME NOT NULL,
        FOREIGN KEY (sales_id) REFERENCES sales(id)
    )");

    // Insert access token and details into kwik_tokens
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
        'kwik_user_id' => $kwik_user_id,
        'card_id' => $card_id
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Kwik tables created and tokens initialized',
        'token_received' => !empty($access_token)
    ]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
} finally {
    $pdo->close();
}
