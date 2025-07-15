<?php
include 'includes/session.php';
include 'config.php';

header('Content-Type: application/json');

try {
    $conn = $pdo->open();

    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;

    if (!$user_id || !$location) {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
        exit;
    }

    // Verify user exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    if (!$stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'User not found']);
        exit;
    }

    // Generate a unique checkout token
    $checkout_token = 'CHECKOUT_' . uniqid() . '_' . time();

    // Save to checkout_sessions table
    $stmt = $conn->prepare("INSERT INTO checkout_sessions (user_id, location, checkout_token, created_at) VALUES (:user_id, :location, :checkout_token, NOW())");
    $stmt->execute([
        'user_id' => $user_id,
        'location' => $location,
        'checkout_token' => $checkout_token
    ]);

    echo json_encode(['success' => true, 'checkout_token' => $checkout_token]);
} catch (PDOException $e) {
    error_log("Save location error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} finally {
    $pdo->close();
}
?>
