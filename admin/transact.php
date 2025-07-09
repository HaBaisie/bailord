<?php
include 'includes/session.php';

if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $conn = $pdo->open();

    try {
        // Fetch sale and user details
        $stmt = $conn->prepare("
            SELECT s.pay_id, s.sales_date, s.user_id, u.address, u.contact_info
            FROM sales s
            LEFT JOIN users u ON u.id = s.user_id
            WHERE s.id = :id
        ");
        $stmt->execute(['id' => $id]);
        $sale = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$sale) {
            error_log("Transact.php: Sale not found for ID $id");
            echo json_encode(['error' => 'Sale not found']);
            exit;
        }

        // Log fetched data for debugging
        error_log("Transact.php: Sale ID $id, User ID {$sale['user_id']}, Address: " . ($sale['address'] ?? 'NULL') . ", Contact: " . ($sale['contact_info'] ?? 'NULL'));

        $output = [
            'transaction' => $sale['pay_id'],
            'date' => date('M d, Y', strtotime($sale['sales_date'])),
            'address' => !empty($sale['address']) ? htmlspecialchars($sale['address']) : 'No address provided',
            'contact_info' => !empty($sale['contact_info']) ? htmlspecialchars($sale['contact_info']) : 'No contact info provided',
            'list' => ''
        ];

        // Fetch product details
        $stmt = $conn->prepare("
            SELECT p.name, d.price, d.quantity
            FROM details d
            LEFT JOIN products p ON p.id = d.product_id
            WHERE d.sales_id = :id
        ");
        $stmt->execute(['id' => $id]);

        $total = 0;
        foreach ($stmt as $row) {
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;
            $output['list'] .= "
                <tr class='prepend_items'>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>$ " . number_format($row['price'], 2) . "</td>
                    <td>" . $row['quantity'] . "</td>
                    <td>$ " . number_format($subtotal, 2) . "</td>
                </tr>
            ";
        }

        $output['total'] = '<b>$ ' . number_format($total, 2) . '</b>';

        echo json_encode($output);
    } catch (PDOException $e) {
        error_log("Transact.php: Database error for ID $id: " . $e->getMessage());
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }

    $pdo->close();
} else {
    error_log("Transact.php: Invalid request, no ID provided");
    echo json_encode(['error' => 'Invalid request']);
}
?>
