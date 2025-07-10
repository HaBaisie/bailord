<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  }
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <style>
        :root {
            --primary-color: #1E90FF; /* DodgerBlue */
            --secondary-color: #4169E1; /* RoyalBlue */
            --accent-blue: #87CEEB; /* SkyBlue */
            --dark-blue: #191970; /* MidnightBlue */
            --black: #000000;
            --white: #ffffff;
            --gray: #e6f0fa; /* Light blue-gray */
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

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, var(--accent-blue), var(--secondary-color));
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
            width: 375px;
            height: 600px;
            background: #000;
            border-radius: 50px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 8px solid var(--dark-blue);
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
            background: var(--white);
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
            padding: 1.5rem;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 1rem;
            width: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            transform: scale(0);
            transition: transform 0.6s ease-in-out, opacity 0.6s ease-in-out;
            opacity: 0;
            min-height: 80%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .container.sign-in .form.sign-in,
        .container.sign-up .form.sign-up {
            transform: scale(1);
            opacity: 1;
        }

        .input-group {
            position: relative;
            width: 100%;
            margin: 1.2rem 0;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            font-size: 1.8rem;
            color: var(--gray-2);
            transition: color 0.3s ease;
        }

        .input-group input {
            width: 100%;
            padding: 1.2rem 1.2rem 1.2rem 3.2rem;
            font-size: 1.2rem;
            background-color: var(--gray);
            border-radius: 0.5rem;
            border: 0.125rem solid var(--white);
            outline: none;
            transition: border 0.3s ease;
        }

        .input-group input:focus {
            border: 0.125rem solid var(--primary-color);
        }

        .form button {
            cursor: pointer;
            width: 100%;
            padding: 1rem;
            border-radius: 0.5rem;
            border: none;
            background-color: var(--primary-color);
            color: var(--white);
            font-size: 1.4rem;
            outline: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .form button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .form p {
            margin: 0.8rem 0;
            font-size: 0.95rem;
            color: var(--gray-2);
            text-align: center;
        }

        .form a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .form a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .pointer {
            cursor: pointer;
        }

        .content-row {
            display: none;
        }

        .callout {
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0.5rem;
            text-align: center;
            opacity: 0;
            transform: translateY(15px);
            transition: opacity 0.5s ease, transform 0.5s ease;
            transition-delay: 0.5s;
        }

        .container.sign-in .form.sign-in .callout,
        .container.sign-up .form.sign-up .callout {
            opacity: 1;
            transform: translateY(0);
        }

        .callout-danger {
            background-color: var(--error-bg);
            color: var(--error-text);
        }

        .callout-success p {
            background-color: var(--success-bg);
            color: var(--dark-blue);
            font-size: 2.0rem;
            margin: 0;
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
                background: var(--dark-blue);
            }

            .phone-frame::after {
                right: -5px;
                top: 100px;
                width: 2px;
                height: 30px;
                background: var(--dark-blue);
            }

            .phone-screen {
                border-radius: 20px;
            }

            .form-wrapper {
                padding: 1rem;
            }

            .form {
                padding: 1rem;
                border-radius: 0.75rem;
                min-height: auto;
            }

            .input-group {
                margin: 0.8rem 0;
            }

            .input-group input {
                padding: 0.9rem 0.9rem 0.9rem 2.8rem;
                font-size: 1rem;
            }

            .input-group i {
                font-size: 1.5rem;
            }

            .form button {
                padding: 0.7rem;
                font-size: 1.2rem;
            }

            .form p {
                font-size: 0.85rem;
                margin: 0.6rem 0;
            }

            .callout {
                padding: 0.8rem;
                margin: 0.8rem 0;
            }

            .callout-success p {
                font-size: 2.0rem;
                color: var(--dark-blue);
            }
        }

        @media only screen and (max-width: 375px) {
            .phone-frame {
                width: 92vw;
                height: 82vh;
                border-radius: 25px;
                padding: 10px;
            }

            .input-group input {
                padding: 0.8rem 0.8rem 0.8rem 2.6rem;
                font-size: 0.95rem;
            }

            .input-group i {
                font-size: 1.4rem;
            }

            .form button {
                padding: 0.6rem;
                font-size: 1.1rem;
            }

            .form p {
                font-size: 0.8rem;
            }

            .callout {
                padding: 0.8rem;
            }

            .callout-success p {
                font-size: 2.0rem;
                color: var(--white);
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
                <!-- SIGN UP -->
                <div class="col sign-up">
                    <div class="form-wrapper">
                        <div class="form sign-up">
                            <?php
                            if(isset($_SESSION['error'])){
                                echo "<div class='callout callout-danger text-center'><p>".$_SESSION['error']."</p></div>";
                                unset($_SESSION['error']);
                            }
                            if(isset($_SESSION['success'])){
                                echo "<div class='callout callout-success text-center'><p>".$_SESSION['success']."</p></div>";
                                unset($_SESSION['success']);
                            }
                            ?>
                            <form action="register.php" method="POST">
                                <div class="input-group">
                                    <i class='bx bxs-user'></i>
                                    <input type="text" name="firstname" placeholder="Firstname" value="<?php echo (isset($_SESSION['firstname'])) ? $_SESSION['firstname'] : '' ?>" required>
                                </div>
                                <div class="input-group">
                                    <i class='bx bxs-user'></i>
                                    <input type="text" name="lastname" placeholder="Lastname" value="<?php echo (isset($_SESSION['lastname'])) ? $_SESSION['lastname'] : '' ?>" required>
                                </div>
                                <div class="input-group">
                                    <i class='bx bx-mail-send'></i>
                                    <input type="email" name="email" placeholder="Email" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : '' ?>" required>
                                </div>
                                <div class="input-group">
                                    <i class='bx bxs-lock-alt'></i>
                                    <input type="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="input-group">
                                    <i class='bx bxs-lock-alt'></i>
                                    <input type="password" name="repassword" placeholder="Retype password" required>
                                </div>
                                <button type="submit" name="signup">Sign up</button>
                                <p>
                                    <span>Already have an account?</span>
                                    <b><a href="login.php"><i class='bx bx-home'></i> login here</a></b>
                                </p>
                                <p>
                                    <b><a href="index.php"><i class='bx bx-home'></i> Home</a></b>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END SIGN UP -->
                <!-- SIGN IN -->
                <div class="col sign-in">
                    <div class="form-wrapper">
                        <div class="form sign-in">
                            <?php
                            if(isset($_SESSION['error'])){
                                echo "<div class='callout callout-danger text-center'><p>".$_SESSION['error']."</p></div>";
                                unset($_SESSION['error']);
                            }
                            if(isset($_SESSION['success'])){
                                echo "<div class='callout callout-success text-center'><p>".$_SESSION['success']."</p></div>";
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
                                <button type="submit" name="login">Sign in</button>
                                <p>
                                    <b><a href="password_forgot.php">Forgot password?</a></b>
                                </p>
                                <p>
                                    <span>Don't have an account?</span>
                                    <b onclick="toggle()" class="pointer">Sign up here</b>
                                </p>
                                <p>
                                    <b><a href="index.php"><i class='bx bx-home'></i> Home</a></b>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END SIGN IN -->
            </div>
            <!-- END FORM SECTION -->
            <!-- CONTENT SECTION -->
            <div class="row content-row">
                <!-- SIGN UP CONTENT -->
                <div class="col">
                    <div class="text sign-up">
                        <h2>Become a Member</h2>
                    </div>
                </div>
                <!-- SIGN IN CONTENT -->
                <div class="col">
                    <div class="text sign-in">
                        <h2>Welcome Back</h2>
                    </div>
                </div>
                <!-- END SIGN IN CONTENT -->
            </div>
            <!-- END CONTENT SECTION -->
        </div>
    </div>
</div>

<script>
    let container = document.getElementById('container');

    function toggle() {
        container.classList.toggle('sign-in');
        container.classList.toggle('sign-up');
    }

    setTimeout(() => {
        container.classList.add('sign-up');
    }, 200);
</script>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
