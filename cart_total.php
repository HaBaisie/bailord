<?php
include 'includes/session.php';
header('Content-Type: application/json');
$conn = $pdo->open();

$response = ['total' => 0];

if (!isset($_SESSION['user'])) {
    echo json_encode($response);
    exit;
}

try {
    // Verify user exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE id = :id");
    $stmt->execute(['id' => $_SESSION['user']]);
    if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
        $response['error'] = 'Invalid user ID';
        echo json_encode($response);
        exit;
    }

    // Calculate total
    $stmt = $conn->prepare("
        SELECT SUM(p.price * c.quantity) AS total
        FROM cart c
        LEFT JOIN products p ON p.id = c.product_id
        WHERE c.user_id = :user_id
        AND p.price IS NOT NULL
    ");
    $stmt->execute(['user_id' => $_SESSION['user']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $response['total'] = $result['total'] ? floatval($result['total']) : 0;
} catch (PDOException $e) {
    $response['error'] = 'Database error: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
}

$pdo->close();
echo json_encode($response);
?>
