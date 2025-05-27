<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'includes/session.php';

if (isset($_POST['signup'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['email'] = $email;

    if ($password != $repassword) {
        $_SESSION['error'] = 'Passwords did not match';
        header('location: signup.php');
        exit;
    }

    $conn = $pdo->open();

    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch();
    if ($row['numrows'] > 0) {
        $_SESSION['error'] = 'Email already taken';
        header('location: signup.php');
        $pdo->close();
        exit;
    }

    $now = date('Y-m-d');
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Generate activation code
    $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = substr(str_shuffle($set), 0, 12);

    try {
        $stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname, activate_code, created_on) VALUES (:email, :password, :firstname, :lastname, :code, :now)");
        $stmt->execute(['email' => $email, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'code' => $code, 'now' => $now]);
        $userid = $conn->lastInsertId();

        $message = "
            <h2>Thank you for Registering.</h2>
            <p>Your Account:</p>
            <p>Email: " . htmlspecialchars($email) . "</p>
            <p>Please click the link below to activate your account.</p>
            <a href='http://localhost/ecommerce/activate.php?code=" . urlencode($code) . "&user=" . $userid . "'>Activate Account</a>
        ";

        // Load PHPMailer
        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);
        try {
            // Enable debug output for troubleshooting
            $mail->SMTPDebug = 2; // Set to 0 in production
            $mail->Debugoutput = function($str, $level) {
                file_put_contents('phpmailer.log', gmdate('Y-m-d H:i:s') . "\t$level\t$str\n", FILE_APPEND);
            };

            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'habeebullahilawal14@gmail.com';
            $mail->Password = 'pupl lqql ehaq gmgs'; // Replace with newly generated Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('habeebullahilawal14@gmail.com', 'Bailord');
            $mail->addAddress($email);
            $mail->addReplyTo('habeebullahilawal14@gmail.com');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Bailord Sign Up';
            $mail->Body = $message;

            $mail->send();

            unset($_SESSION['firstname']);
            unset($_SESSION['lastname']);
            unset($_SESSION['email']);

            $_SESSION['success'] = 'Account created. Check your email to activate.';
            header('location: signup.php');
        } catch (Exception $e) {
            $_SESSION['error'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            header('location: signup.php');
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database Error: ' . $e->getMessage();
        header('location: signup.php');
    }

    $pdo->close();
} else {
    $_SESSION['error'] = 'Fill up signup form first';
    header('location: signup.php');
}
?>
