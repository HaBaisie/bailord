<?php
include 'includes/session.php';
require 'vendor/autoload.php';
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/menubar.php'; ?>
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['admin'])) {
    header('location: admin/login.php');
    exit;
}

ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

$conn = $pdo->open();

if (!isset($_GET['id'])) {
    $_SESSION['error'] = 'No sale ID provided';
    header('location: admin_sales.php');
    exit;
}

$sale_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $location = $_POST['location'] ?? '';

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
            $mail->Username = $_ENV['SMTP_USERNAME'];
            $mail->Password = $_ENV['SMTP_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($_ENV['SMTP_USERNAME'], 'Bailord eCommerce');
            $mail->addAddress($sale['email']);
            $mail->isHTML(true);
            $mail->Subject = 'Your Order Has Been Approved';
            $mail->Body = "
                <h2>Order Approved</h2>
                <p>Your order (ID: {$sale['id']}, Pay ID: {$sale['pay_id']}) has been approved.</p>
                <p>Tracking Location: " . htmlspecialchars($location) . "</p>
                <p>View your order details at <a href='https://bailord-0b4b2667ca4f.herokuapp.com/profile.php'>your profile</a>.</p>
            ";

            $mail->send();
            $_SESSION['success'] = 'Sale approved and email sent';
        } catch (Exception $e) {
            error_log('PHPMailer error: ' . $e->getMessage());
            $_SESSION['error'] = 'Sale approved but email failed: ' . $e->getMessage();
        }

        header('location: admin_sales.php');
        exit;
    } catch (PDOException $e) {
        error_log('PDO error: ' . $e->getMessage());
        $_SESSION['error'] = 'Failed to approve sale: ' . $e->getMessage();
        header('location: admin_sales.php');
        exit;
    }
}

// Fetch sale for form
try {
    $stmt = $conn->prepare("SELECT s.id, s.pay_id, s.status FROM sales s WHERE s.id = :id");
    $stmt->execute(['id' => $sale_id]);
    $sale = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$sale || $sale['status'] !== 'pending') {
        $_SESSION['error'] = 'Sale not found or not pending';
        header('location: admin_sales.php');
        exit;
    }
} catch (PDOException $e) {
    error_log('PDO error: ' . $e->getMessage());
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
                        <form method="POST" action="">
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