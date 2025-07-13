<?php
include 'includes/session.php';

$conn = $pdo->open();
$response = ['success' => false, 'message' => 'Unknown error'];

try {
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    if (!$user_id) {
        $response['message'] = 'User ID not provided';
        echo json_encode($response);
        exit;
    }

    $stmt = $conn->prepare("SELECT access_token FROM kwik_tokens WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1");
    $stmt->execute(['user_id' => $user_id]);
    $token = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($token) {
        $response['success'] = true;
        $response['access_token'] = $token['access_token'];
    } else {
        $response['message'] = 'No access token found';
    }
    echo json_encode($response);
} catch (PDOException $e) {
    $response['message'] = 'Database error: ' . $e->getMessage();
    echo json_encode($response);
} finally {
    $pdo->close();
}
?>