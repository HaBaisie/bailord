<?php
include 'includes/session.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

if (!isset($_SESSION['admin']) || trim($_SESSION['admin']) == '') {
    error_log('No admin session found');
    $_SESSION['error'] = 'Please log in as admin';
    header('location: login.php');
    exit;
}

try {
    $conn = $pdo->open();
} catch (PDOException $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    $_SESSION['error'] = 'Database connection failed';
    header('location: admin_sales.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    error_log('Invalid or missing sale ID');
    $_SESSION['error'] = 'No sale ID provided';
    header('location: admin_sales.php');
    exit;
}

$sale_id = (int)$_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $location = trim($_POST['location'] ?? '');
    error_log('POST received for sale_id: ' . $sale_id . ', location: ' . $location);

    if (empty($location)) {
        error_log('Empty location provided for sale_id: ' . $sale_id);
        $_SESSION['error'] = 'Location is required';
        header('location: sale_approve.php?id=' . $sale_id);
        exit;
    }

    try {
        // Fetch sale and user details
        $stmt = $conn->prepare("
            SELECT s.id, s.user_id, s.pay_id, u.email
            FROM sales s
            LEFT JOIN users u ON u.id = s.user_id
            WHERE s.id = :id AND s.status = 'pending'
        ");
        $stmt->execute(['id' => $sale_id]);
        $sale = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$sale) {
            error_log('Sale not found or not pending for sale_id: ' . $sale_id);
            $_SESSION['error'] = 'Sale not found or already processed';
            header('location: admin_sales.php');
            exit;
        }

        // Update sale status and location
        $stmt = $conn->prepare("UPDATE sales SET status = 'approved', location = :location WHERE id = :id");
        $stmt->execute(['location' => $location, 'id' => $sale_id]);

        // Send email notification
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'habeebullahilawal14@gmail.com';
            $mail->Password = 'pupl lqql ehaq gmgs';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('habeebullahilawal14@gmail.com', 'Bailord');
            $mail->addAddress($sale['email']);
            $mail->addReplyTo('habeebullahilawal14@gmail.com');
            $mail->isHTML(true);
            $mail->Subject = 'Your Order Has Been Approved';
            $mail->Body = "
                <h2>Order Approved</h2>
                <p>Your order (ID: {$sale['id']}, Pay ID: {$sale['pay_id']}) has been approved.</p>
                <p>Tracking Location: " . htmlspecialchars($location) . "</p>
                <p>View your order details at <a href='https://bailord-0b4b2667ca4f.herokuapp.com/profile.php'>your profile</a>.</p>
            ";

            $mail->send();
            error_log('Email sent for sale_id: ' . $sale_id);
            $_SESSION['success'] = 'Sale approved and email sent';
        } catch (Exception $e) {
            error_log('PHPMailer error for sale_id ' . $sale_id . ': ' . $e->getMessage());
            $_SESSION['error'] = 'Sale approved but email failed: ' . $e->getMessage();
        }

        header('location: admin_sales.php');
        exit;
    } catch (PDOException $e) {
        error_log('PDO error for sale_id ' . $sale_id . ': ' . $e->getMessage());
        $_SESSION['error'] = 'Failed to approve sale: ' . $e->getMessage();
        header('location: admin_sales.php');
        exit;
    }
}

try {
    $stmt = $conn->prepare("SELECT s.id, s.pay_id, s.status FROM sales s WHERE s.id = :id");
    $stmt->execute(['id' => $sale_id]);
    $sale = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$sale || $sale['status'] !== 'pending') {
        error_log('Sale not found or not pending for sale_id: ' . $sale_id);
        $_SESSION['error'] = 'Sale not found or not pending';
        header('location: admin_sales.php');
        exit;
    }
} catch (PDOException $e) {
    error_log('PDO error fetching sale_id ' . $sale_id . ': ' . $e->getMessage());
    $_SESSION['error'] = 'Failed to load sale';
    header('location: admin_sales.php');
    exit;
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
                <h2>Approve Sale #<?php echo $sale['id']; ?></h2>
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
                        <form method="POST" action="sale_approve.php?id=<?php echo $sale_id; ?>">
                            <div class="form-group">
                                <label for="location">Shipping Location</label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="Enter shipping location (e.g., Lagos, Nigeria)" required>
                            </div>
                            <button type="submit" class="btn btn-success">Approve and Notify</button>
                            <a href="admin_sales.php" class="btn btn-default">Cancel</a>
                        </form>
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
