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

    // Authenticate with Kwik API to get access token
    $ch = curl_init('https://staging-api-test.kwik.delivery/vendor_login');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'domain_name' => 'staging-client-panel.kwik.delivery',
        'email' => 'lawalhabeeb3191@gmail.com',
        'password' => 'Kwik2025$',
        'api_login' => 1
    ]));
    
    // Handle gzip response
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code !== 200) {
        echo json_encode(['success' => false, 'message' => 'Kwik API authentication failed']);
        exit;
    }

    // The response is gzip compressed, but curl should automatically decompress it
    $data = json_decode($response, true);
    
    // Adjust these based on the actual response structure from /vendor_login
    // You'll need to inspect the decompressed response to know the exact structure
    if (!isset($data['access_token'])) {
        echo json_encode(['success' => false, 'message' => 'No access token received from Kwik API', 'response' => $data]);
        exit;
    }

    $access_token = $data['access_token'];
    $vendor_id = $data['vendor_id'] ?? ''; // Adjust these based on actual response
    $kwik_user_id = $data['user_id'] ?? '';
    $card_id = $data['card_id'] ?? '';

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

    echo json_encode(['success' => true, 'message' => 'Kwik tables created and tokens initialized']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
} finally {
    $pdo->close();
}
