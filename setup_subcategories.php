<?php
include 'includes/session.php';
$conn = $pdo->open();

header('Content-Type: application/json');

try {
    $user_id = isset($_SESSION['user']) ? $_SESSION['user'] : null;

    if (!$user_id) {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
        exit;
    }

    // Create kwik_tokens table if it doesn't exist
    $conn->exec("CREATE TABLE IF NOT EXISTS kwik_tokens (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        vendor_id INT NOT NULL,
        access_token VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )");

    // Insert initial access token into kwik_tokens table
    $stmt = $conn->prepare("INSERT INTO kwik_tokens (user_id, vendor_id, access_token) VALUES (:user_id, :vendor_id, :access_token)");
    $stmt->execute([
        'user_id' => $user_id,
        'vendor_id' => 3552,
        'access_token' => '86f7517afd08d26f68166da7634edced'
    ]);

    echo json_encode(['success' => true, 'message' => 'Kwik tokens initialized']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} finally {
    $pdo->close();
}
?>
