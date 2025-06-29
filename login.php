<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: index.php');
  }
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login - Bailord</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <style>
        :root {
            --primary-color: #1E90FF; /* DodgerBlue */
            --secondary-color: #4169E1; /* RoyalBlue */
            --accent-blue: #87CEEB; /* SkyBlue */
            --dark-blue: #191970; /* MidnightBlue */
            --black: #000000;
            --white: #ffffff;
            --gray: #F0F8FF; /* AliceBlue */
            --gray-2: #4682B4; /* SteelBlue for icons */
            --facebook-color: #4267B2;
            --google-color: #DB4437;
            --twitter-color: #1DA1F2;
            --insta-color: #E1306C;
            --success-bg: #E0F7FA; /* Cyan for success */
            --success-text: #0288D1; /* LightBlue */
            --error-bg: #E3F2FD; /* Blue100 */
            --error-text: #1565C0; /* Blue800 */
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-blue), var(--secondary-color));
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .phone-frame {
            position: relative;
            width: 400px;
            height: 640px;
            background: linear-gradient(145deg, #2a2a2a, #000000);
            border-radius: 50px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5), inset 0 2px 5px rgba(255, 255, 255, 0.1);
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 8px solid var(--dark-blue);
            animation: tilt 0.8s ease-out;
        }

        @keyframes tilt {
            0% { transform: rotateY(10deg) rotateX(5deg); }
            100% { transform: rotateY(0deg) rotateX(0deg); }
        }

        .phone-frame::before {
            content: '';
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 20px;
            background: var(--dark-blue);
            border-radius: 10px;
        }

        .phone-frame::after {
            content: '';
            position: absolute;
            right: -6px;
            top: 120px;
            width: 3px;
            height: 40px;
            background: var(--dark-blue);
        }

        .phone-screen {
            width: 100%;
            height: 100%;
            background: var(--white) url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="none" stroke="%23E0F0FF" stroke-width="1" stroke-opacity="0.2" d="M0 100L100 0M0 0L100 100"/></svg>') repeat;
            border-radius: 35px;
            overflow-y: auto;
            position: relative;
            z-index: 2;
        }

        .row {
            display: flex;
            flex-direction: column;
            min-height: 100%;
            position: relative;
            z-index: 2;
        }

        .col {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1 1 auto;
            padding: 0.5rem;
        }

        .form-wrapper {
            width: 100%;
            padding: 1.5rem;
        }

        .form {
            padding: 2rem;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.95), rgba(240, 248, 255, 0.9));
            border-radius: 1.2rem;
            width: 100%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transform: scale(1);
            opacity: 1;
            min-height: 80%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: transform 0.6s ease-in-out, opacity 0.6s ease-in-out;
        }

        .form .logo {
            width: 100px;
            margin-bottom: 1.5rem;
        }

        .form h2 {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
            text-align: center;
        }

        .input-group {
            position: relative;
            width: 100%;
            margin: 1rem 0;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            font-size: 1.6rem;
            color: var(--gray-2);
            transition: color 0.3s ease;
        }

        .input-group input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            font-size: 1.1rem;
            background-color: var(--gray);
            border-radius: 0.5rem;
            border: 1px solid transparent;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            color: var(--text-dark);
        }

        .input-group input:focus,
        .input-group input:hover {
            border-color: var(--primary-color);
            box-shadow: 0 0 8px rgba(30, 144, 255, 0.3);
        }

        .input-group input::placeholder {
            color: var(--gray-2);
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .input-group input:focus::placeholder {
            transform: translateX(10px);
            opacity: 0.5;
        }

        .form button {
            cursor: pointer;
            width: 100%;
            padding: 1rem;
            border-radius: 0.5rem;
            border: none;
            background: var(--primary-color);
            color: var(--white);
            font-size: 1.2rem;
            font-weight: 600;
            outline: none;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }

        .form button:hover {
            background: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .form p {
            margin: 0.8rem 0;
            font-size: 0.9rem;
            color: var(--gray-2);
            text-align: center;
        }

        .form a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .form a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .social-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .social-btn i {
            font-size: 1.5rem;
            color: var(--white);
        }

        .facebook-btn { background: var(--facebook-color); }
        .google-btn { background: var(--google-color); }
        .twitter-btn { background: var(--twitter-color); }
        .insta-btn { background: var(--insta-color); }

        .callout {
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0.5rem;
            text-align: center;
            font-size: 2.0rem;
            opacity: 1;
            transform: translateY(0);
            width: 100%;
        }

        .callout-danger {
            background-color: var(--error-bg);
            color: var(--error-text);
            font-size: 1.2rem; /* Matches Sign In button font size */
        }

        .callout-success {
            background-color: var(--success-bg);
            color: var(--success-text);
        }

        @media only screen and (max-width: 425px) {
            .phone-frame {
                width: 90vw;
                height: 80vh;
                border-radius: 30px;
                border: 6px solid var(--dark-blue);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
                padding: 12px;
            }

            .phone-frame::before {
                width: 60px;
                height: 15px;
                border-radius: 8px;
                top: 6px;
            }

            .phone-frame::after {
                right: -5px;
                top: 100px;
                width: 2px;
                height: 30px;
            }

            .phone-screen {
                border-radius: 20px;
            }

            .form-wrapper {
                padding: 1rem;
            }

            .form {
                padding: 1.2rem;
                border-radius: 0.75rem;
                min-height: auto;
            }

            .form .logo {
                width: 80px;
                margin-bottom: 1rem;
            }

            .form h2 {
                font-size: 1.5rem;
            }

            .input-group {
                margin: 0.8rem 0;
            }

            .input-group input {
                padding: 0.9rem 0.9rem 0.9rem 2.8rem;
                font-size: 1rem;
            }

            .input-group i {
                font-size: 1.4rem;
            }

            .form button {
                padding: 0.8rem;
                font-size: 1.1rem;
            }

            .form p {
                font-size: 0.85rem;
                margin: 0.6rem 0;
            }

            .social-btn {
                width: 35px;
                height: 35px;
            }

            .social-btn i {
                font-size: 1.3rem;
            }

            .callout {
                padding: 0.8rem;
                margin: 0.8rem 0;
                font-size: 0.85rem;
            }

            .callout-danger {
                font-size: 1.1rem; /* Matches button font size */
            }
        }

        @media only screen and (max-width: 375px) {
            .phone-frame {
                width: 92vw;
                height: 82vh;
                border-radius: 25px;
                padding: 10px;
            }

            .form .logo {
                width: 70px;
            }

            .form h2 {
                font-size: 1.3rem;
            }

            .input-group input {
                padding: 0.8rem 0.8rem 0.8rem 2.6rem;
                font-size: 0.95rem;
            }

            .input-group i {
                font-size: 1.3rem;
            }

            .form button {
                padding: 0.7rem;
                font-size: 1.0rem;
            }

            .form p {
                font-size: 0.8rem;
            }

            .social-btn {
                width: 32px;
                height: 32px;
            }

            .social-btn i {
                font-size: 1.2rem;
            }

            .callout {
                font-size: 0.8rem;
            }

            .callout-danger {
                font-size: 1.0rem; /* Matches button font size Ode size */
            }
        }
    </style>
</head>
<body>
<div id="container" class="container">
    <div class="phone-frame">
        <div class="phone-screen">
            <!-- FORM SECTION -->
            <div class="row">
                <!-- SIGN IN -->
                <div class="col sign-in">
                    <div class="form-wrapper">
                        <div class="form sign-in">
                            <?php if (file_exists('assets/images/demos/demo-4/logo.png')): ?>
                                <img src="assets/images/demos/demo-4/logo.png" alt="Bailord Logo" class="logo">
                            <?php else: ?>
                                <span class="callout callout-danger">Logo image not found</span>
                            <?php endif; ?>
                            <h2>Sign In</h2>
                            <?php
                            if(isset($_SESSION['error'])){
                                echo "<div class='callout callout-danger'><p>".$_SESSION['error']."</p></div>";
                                unset($_SESSION['error']);
                            }
                            if(isset($_SESSION['success'])){
                                echo "<div class='callout callout-success'><p>".$_SESSION['success']."</p></div>";
                                unset($_SESSION['success']);
                            }
                            ?>
                            <form action="verify.php" method="POST">
                                <div class="input-group">
                                    <i class='bx bx-mail-send'></i>
                                    <input type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="input-group">
                                    <i class='bx bxs-lock-alt'></i>
                                    <input type="password" name="password" placeholder="Password" required>
                                </div>
                                <button type="submit" name="login">Sign In</button>
                                <p><a href="password_forgot.php">Forgot password?</a></p>
                                <p>
                                    <span>Don't have an account?</span>
                                    <a href="signup.php">Sign up here</a>
                                </p>
                                <p><a href="index.php"><i class='bx bx-home'></i> Back to Home</a></p>
                                <div class="social-login">
                                    <button class="social-btn facebook-btn" title="Sign in with Facebook"><i class='bx bxl-facebook'></i></button>
                                    <button class="social-btn google-btn" title="Sign in with Google"><i class='bx bxl-google'></i></button>
                                    <button class="social-btn twitter-btn" title="Sign in with Twitter"><i class='bx bxl-twitter'></i></button>
                                    <button class="social-btn insta-btn" title="Sign in with Instagram"><i class='bx bxl-instagram'></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END SIGN IN -->
            </div>
            <!-- END FORM SECTION -->
            <!-- CONTENT SECTION -->
            <div class="row content-row" style="display: none;">
                <!-- SIGN IN CONTENT -->
                <div class="col">
                    <div class="text sign-in">
                        <h1>Welcome Back</h1>
                    </div>
                </div>
                <!-- END SIGN IN CONTENT -->
            </div>
            <!-- END CONTENT SECTION -->
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let container = document.getElementById('container');
        container.classList.add('sign-in');
    });

    // Note: Social login buttons are placeholders; implement actual functionality as needed
</script>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
