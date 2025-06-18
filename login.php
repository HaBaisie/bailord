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
            height: 100%;
            overflow: auto;
            background-color: var(--gray);
        }

        .container {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            overflow: hidden;
        }

        .form-wrapper {
            width: 100%;
            max-width: 28rem;
            padding: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form {
            padding: 2rem;
            background-color: var(--white);
            border-radius: 1rem;
            width: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transform: scale(0);
            transition: transform 0.6s ease-in-out, opacity 0.6s ease-in-out;
            opacity: 0;
        }

        .container.sign-in .form.sign-in,
        .container.sign-up .form.sign-up {
            transform: scale(1);
            opacity: 1;
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
            font-size: 1.2rem;
            color: var(--gray-2);
            transition: color 0.3s ease;
        }

        .input-group input {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.5rem;
            font-size: 1rem;
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
            padding: 0.8rem;
            border-radius: 0.5rem;
            border: none;
            background-color: var(--primary-color);
            color: var(--white);
            font-size: 1rem;
            outline: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .form button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
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

        .text {
            color: var(--white);
            text-align: center;
            margin-bottom: 1rem;
        }

        .text h2 {
            font-size: 1.8rem;
            font-weight: 600;
            margin: 0.5rem 0;
            transition: opacity 0.8s ease-in-out;
            opacity: 0;
        }

        .container.sign-up .text.sign-up h2,
        .container.sign-in .text.sign-in h2 {
            opacity: 1;
        }

        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: linear-gradient(-45deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            clip-path: circle(0% at 50% 0%);
            transition: clip-path 1.2s ease-in-out;
            z-index: -1;
        }

        .container.sign-in::before,
        .container.sign-up::before {
            clip-path: circle(150% at 50% 0%);
        }

        .callout {
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0.5rem;
            text-align: center;
            font-size: 0.9rem;
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
            .container {
                padding: 0.5rem;
            }

            .form-wrapper {
                padding: 1rem;
                max-width: 100%;
            }

            .form {
                padding: 1.5rem;
                border-radius: 0.75rem;
            }

            .input-group {
                margin: 0.8rem 0;
            }

            .input-group input {
                padding: 0.7rem 1rem 0.7rem 2.2rem;
                font-size: 0.9rem;
            }

            .input-group i {
                font-size: 1rem;
                left: 0.8rem;
            }

            .form button {
                padding: 0.7rem;
                font-size: 0.9rem;
            }

            .form p {
                font-size: 0.8rem;
                margin: 0.6rem 0;
            }

            .text h2 {
                font-size: 1.5rem;
            }

            .callout {
                font-size: 0.8rem;
                padding: 0.8rem;
            }
        }

        @media only screen and (max-width: 375px) {
            .form {
                padding: 1.2rem;
            }

            .input-group input {
                padding: 0.6rem 1rem 0.6rem 2rem;
                font-size: 0.85rem;
            }

            .input-group i {
                font-size: 0.9rem;
            }

            .form button {
                padding: 0.6rem;
                font-size: 0.85rem;
            }

            .form p {
                font-size: 0.75rem;
            }

            .text h2 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
<div id="container" class="container">
    <!-- FORM SECTION -->
    <div class="form-wrapper">
        <!-- SIGN UP -->
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
            <div class="text sign-up">
                <h2>Join with us</h2>
            </div>
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
        <!-- SIGN IN -->
        <div class="form sign-in">
            <?php
            if(isset($_SESSION['error'])){
                echo "<div class='callout callout-danger text-center'><p>".$_SESSION['error']."</p></div>";
                unset($_SESSION['error']);
            }
            if(isset($_SESSION['success'])){
                echo "<div class="callout callout-success text-center"><p>".$_SESSION['success']."</p></div>";
                unset($_SESSION['success']);
            }
            ?>
            <div class="text sign-in">
                <h2>Welcome Back</h2>
            </div>
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
