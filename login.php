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
    <title>Login and Signup</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <style>
        :root {
            --primary-color: #1E90FF; /* DodgerBlue */
            --secondary-color: #4169E1; /* RoyalBlue */
            --black: #000000;
            --white: #ffffff;
            --gray: #efefef;
            --gray-2: #757575;
            --facebook-color: #4267B2;
            --google-color: #DB4437;
            --twitter-color: #1DA1F2;
            --insta-color: #E1306C;
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
            background: linear-gradient(135deg, #e0f7fa, #bbdefb);
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
            height: 750px;
            background: #000;
            border-radius: 50px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 8px solid #1a1a1a;
        }

        .phone-frame::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 25px;
            background: #1a1a1a;
            border-radius: 12px;
        }

        .phone-frame::after {
            content: '';
            position: absolute;
            right: -6px;
            top: 150px;
            width: 3px;
            height: 50px;
            background: #333;
        }

        .phone-screen {
            width: 100%;
            height: 100%;
            background: #fff;
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
            padding: 1rem;
        }

        .form-wrapper {
            width: 100%;
            padding: 2rem;
        }

        .form {
            padding: 2rem;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 1.5rem;
            width: 100%;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            transform: scale(0);
            transition: transform 0.6s ease-in-out, opacity 0.6s ease-in-out;
            opacity: 0;
            min-height: 85%;
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
            margin: 1.8rem 0;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 1.2rem;
            transform: translateY(-50%);
            font-size: 2rem;
            color: var(--gray-2);
            transition: color 0.3s ease;
        }

        .input-group input {
            width: 100%;
            padding: 1.4rem 1.4rem 1.4rem 3.5rem;
            font-size: 1.3rem;
            background-color: var(--gray);
            border-radius: 0.6rem;
            border: 0.15rem solid var(--white);
            outline: none;
            transition: border 0.3s ease;
        }

        .input-group input:focus {
            border: 0.15rem solid var(--primary-color);
        }

        .form button {
            cursor: pointer;
            width: 100%;
            padding: 1.2rem;
            border-radius: 0.6rem;
            border: none;
            background-color: var(--primary-color);
            color: var(--white);
            font-size: 1.6rem;
            outline: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .form button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }

        .form p {
            margin: 1.2rem 0;
            font-size: 1.1rem;
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
            padding: 1.2rem;
            margin: 1.2rem 0;
            border-radius: 0.6rem;
            text-align: center;
            font-size: 1.1rem;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
            transition-delay: 0.5s;
        }

        .container.sign-in .form.sign-in .callout,
        .container.sign-up .form.sign-up .callout {
            opacity: 1;
            transform: translateY(0);
        }

        .callout-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .callout-success {
            background-color: #d4edda;
            color: #155724;
        }

        @media only screen and (max-width: 425px) {
            .phone-frame {
                width: 100%;
                height: 100%;
                border-radius: 0;
                border: none;
                box-shadow: none;
                padding: 10px;
            }

            .phone-frame::before,
            .phone-frame::after {
                display: none;
            }

            .phone-screen {
                border-radius: 0;
            }

            .form-wrapper {
                padding: 1.5rem;
            }

            .form {
                padding: 1.5rem;
                border-radius: 1rem;
                min-height: auto;
            }

            .input-group {
                margin: 1.5rem 0;
            }

            .input-group input {
                padding: 1.2rem 1.2rem 1.2rem 3rem;
                font-size: 1.2rem;
            }

            .input-group i {
                font-size: 1.8rem;
            }

            .form button {
                padding: 1rem;
                font-size: 1.5rem;
            }

            .form p {
                font-size: 1rem;
            }
        }

        @media only screen and (max-width: 375px) {
            .input-group input {
                padding: 1.1rem 1.1rem 1.1rem 2.8rem;
                font-size: 1.1rem;
            }

            .input-group i {
                font-size: 1.6rem;
            }

            .form button {
                padding: 0.9rem;
                font-size: 1.4rem;
            }

            .form p {
                font-size: 0.95rem;
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
                                    <b onclick="toggle()" class="pointer">Sign in here</b>
                                </p>
                                <p>
                                    <b><a href="index.php"><i class='bx bx-home'></i> Home</a></b>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END SIGN UP -->
            </div>
            <!-- END FORM SECTION -->
            <!-- CONTENT SECTION -->
            <div class="row content-row">
                <!-- SIGN UP CONTENT -->
                <div class="col">
                    <div class="text sign-up">
                        <h2>Join with us</h2>
                    </div>
                </div>
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
    let container = document.getElementById('container');

    function toggle() {
        container.classList.toggle('sign-in');
        container.classList.toggle('sign-up');
    }

    setTimeout(() => {
        container.classList.add('sign-in');
    }, 200);
</script>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
