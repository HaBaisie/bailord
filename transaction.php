<?php
include 'includes/session.php';

// Ensure no output before JSON
ob_start();
header('Content-Type: application/json');

try {
    $conn = $pdo->open();
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if (!$id) {
        echo json_encode(['error' => 'Invalid request']);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM sales WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $sale = $stmt->fetch();

    if (!$sale) {
        echo json_encode(['error' => 'Sale not found']);
        exit;
    }

    $stmt = $conn->prepare("SELECT d.*, p.name FROM details d LEFT JOIN products p ON p.id = d.product_id WHERE d.sales_id = :id");
    $stmt->execute(['id' => $id]);
    $details = $stmt->fetchAll();

    $list = '';
    $total = 0;
    foreach ($details as $row) {
        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
        $list .= "<tr><td>".htmlspecialchars($row['name'])."</td><td>$".number_format($row['price'], 2)."</td><td>".$row['quantity']."</td><td>$".number_format($subtotal, 2)."</td></tr>";
    }

    echo json_encode([
        'date' => date('M d, Y', strtotime($sale['sales_date'])),
        'transaction' => $sale['pay_id'],
        'list' => $list,
        'total' => '$'.number_format($total, 2)
    ]);

    $pdo->close();
} catch (PDOException $e) {
    error_log('Transaction error: ' . $e->getMessage(), 0);
    echo json_encode(['error' => 'Database error']);
}
ob_end_flush();
?>
