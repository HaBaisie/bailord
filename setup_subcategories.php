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

    // Authenticate with Kwik API using /vendor_login
    $endpoint = KWIK_BASE_URL . '/vendor_login';
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'email' => KWIK_EMAIL,
        'password' => KWIK_PASSWORD
    ]));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Temporary for testing
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // Temporary for testing
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
    error_log("Kwik API Request URL: " . $endpoint, 3, 'kwik_debug.log');
    error_log("Kwik API Response: " . $response, 3, 'kwik_debug.log');
    error_log("Kwik API HTTP Code: " . $http_code, 3, 'kwik_debug.log');
    error_log("Kwik API cURL Error: " . $curl_error, 3, 'kwik_debug.log');
    error_log("Kwik API Verbose Log: " . $verbose_log, 3, 'kwik_debug.log');

    if ($http_code !== 200) {
        $response_data = json_decode($response, true);
        $error_message = isset($response_data['message']) ? $response_data['message'] : 'Unknown error';
        echo json_encode([
            'success' => false,
            'message' => 'Kwik API authentication failed: ' . $error_message,
            'http_code' => $http_code,
            'curl_error' => $curl_error
        ]);
        exit;
    }

    $data = json_decode($response, true);
    if (!isset($data['body']['data']['access_token'])) {
        echo json_encode([
            'success' => false,
            'message' => 'No access token received from Kwik API',
            'response' => $response
        ]);
        exit;
    }

    $access_token = $data['body']['data']['access_token'];
    $vendor_id = $data['body']['data']['vendor_details']['vendor_id'];
    $kwik_user_id = $data['body']['data']['vendor_details']['user_id'];
    $card_id = $data['body']['data']['vendor_details']['card_id'];

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
                            VALUES (:user_id, :access_token, :vendor_id, :kwik_user_id, :card_id, NOW())");
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
        'endpoint_used' => $endpoint
    ]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
} finally {
    $pdo->close();
}
?>
