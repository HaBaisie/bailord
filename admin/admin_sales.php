<?php
include 'includes/session.php';
if (!isset($_SESSION['admin']) || trim($_SESSION['admin']) == '') {
    header('location: ../login.php');
    exit;
}

$conn = $pdo->open();

ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

try {
    $stmt = $conn->prepare("
        SELECT s.id, s.user_id, s.pay_id, s.sales_date, s.status, s.location,
               u.email AS user_email,
               COALESCE(SUM(d.quantity * d.price), 0) AS total
        FROM sales s
        LEFT JOIN users u ON u.id = s.user_id
        LEFT JOIN details d ON d.sales_id = s.id
        GROUP BY s.id
        ORDER BY s.sales_date DESC
    ");
    $stmt->execute();
    $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('Query error: ' . $e->getMessage());
    $_SESSION['error'] = 'Failed to load sales data';
    $sales = [];
}

$pdo->close();
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
    <?php include 'includes/admin_navbar.php'; ?>
    <div class="content-wrapper">
        <div class="container">
            <section class="content">
                <h2>Sales Management</h2>
                <?php
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>" . htmlspecialchars($_SESSION['error']) . "</div>";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "<div class='alert alert-success'>" . htmlspecialchars($_SESSION['success']) . "</div>";
                    unset($_SESSION['success']);
                }
                ?>
                <div class="box box-solid">
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User Email</th>
                                    <th>Date</th>
                                    <th>Pay ID</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sales as $row): ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo htmlspecialchars($row['user_email'] ?: 'Unknown'); ?></td>
                                        <td><?php echo date('M d, Y', strtotime($row['sales_date'])); ?></td>
                                        <td><?php echo htmlspecialchars($row['pay_id']); ?></td>
                                        <td>$<?php echo number_format($row['total'], 2); ?></td>
                                        <td><?php echo ucfirst($row['status']); ?></td>
                                        <td><?php echo htmlspecialchars($row['location'] ?: '-'); ?></td>
                                        <td>
                                            <?php if ($row['status'] === 'pending'): ?>
                                                <a href="sale_approve.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success">Approve</a>
                                            <?php endif; ?>
                                            <a href="sale_details.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">Details</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
