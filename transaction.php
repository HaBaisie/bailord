<?php
include 'includes/session.php';

// Ensure no output before JSON
ob_start();
header('Content-Type: application/json');

try {
    // Log request data for debugging
    error_log('transaction.php called with POST: ' . json_encode($_POST));

    $conn = $pdo->open();
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if (!$id) {
        error_log('transaction.php: Invalid request - sales_id: ' . $id);
        echo json_encode(['error' => 'Invalid request parameters']);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM sales WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $sale = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$sale) {
        error_log('transaction.php: Sale not found for id: ' . $id);
        echo json_encode(['error' => 'Sale not found']);
        exit;
    }

    $stmt = $conn->prepare("SELECT d.*, p.name FROM details d LEFT JOIN products p ON p.id = d.product_id WHERE d.sales_id = :id");
    $stmt->execute(['id' => $id]);
    $details = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $list = '';
    $total = 0;
    foreach ($details as $row) {
        $product_name = $row['name'] ?? 'Unknown Product (ID: ' . $row['product_id'] . ')';
        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
        $list .= "<tr><td>" . htmlspecialchars($product_name) . "</td><td>$" . number_format($row['price'], 2) . "</td><td>" . $row['quantity'] . "</td><td>$" . number_format($subtotal, 2) . "</td></tr>";
    }

    if (empty($details)) {
        $list = "<tr><td colspan='4'>No items found for this sale</td></tr>";
    }

    echo json_encode([
        'date' => date('M d, Y', strtotime($sale['sales_date'])),
        'transaction' => $sale['pay_id'],
        'list' => $list,
        'total' => '$' . number_format($total, 2)
    ]);

    $pdo->close();
} catch (PDOException $e) {
    error_log('transaction.php PDOException: ' . $e->getMessage());
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    error_log('transaction.php Exception: ' . $e->getMessage());
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}
ob_end_flush();
?>
