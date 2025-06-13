<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: category.php?category=');
  }
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <style>
        :root {
            --primary-color: #4EA685;
            --secondary-color: #57B894;
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
            overflow: auto;
        }

        .container {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .form-wrapper {
            width: 100%;
            max-width: 28rem;
            padding: 1.5rem;
        }

        .form {
            padding: 1.5rem;
            background-color: var(--white);
            border-radius: 1.5rem;
            width: 100%;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            transform: scale(0);
            transition: transform 0.5s ease-in-out;
            transition-delay: 0.5s;
        }

        .container.sign-in .form {
            transform: scale(1);
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
            font-size: 1.4rem;
            color: var(--gray-2);
            transition: color 0.3s ease;
        }

        .input-group input {
            width: 100%;
            padding: 1rem 3rem;
            font-size: 1rem;
            background-color: var(--gray);
            border-radius: .5rem;
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
            border-radius: .5rem;
            border: none;
            background-color: var(--primary-color);
            color: var(--white);
            font-size: 1.2rem;
            outline: none;
            transition: background-color 0.3s ease;
        }

        .form button:hover {
            background-color: var(--secondary-color);
        }

        .form p {
            margin: 1rem 0;
            font-size: 0.9rem;
            color: var(--gray-2);
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

        .callout {
            padding: 1rem;
            margin: 1rem 0;
            border-radius: .5rem;
            text-align: center;
            font-size: 0.9rem;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .container.sign-in .callout {
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

        .text {
            margin: 4rem;
            color: var(--white);
            text-align: center;
        }

        .text h2 {
            font-size: 3.5rem;
            font-weight: 800;
            margin: 2rem 0;
            transform: translateX(-250%);
            transition: transform 1s ease-in-out;
        }

        .container.sign-in .text h2 {
            transform: translateX(0);
        }

        .container::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            height: 100vh;
            width: 200vw;
            transform: translate(35%, 0);
            background-image: linear-gradient(-45deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            transition: transform 1s ease-in-out;
            z-index: -1;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border-bottom-right-radius: max(50vw, 50vh);
            border-top-left-radius: max(50vw, 50vh);
        }

        .container.sign-in::before {
            transform: translate(0, 0);
            right: 50%;
        }

        @media only screen and (max-width: 425px) {
            .container {
                padding: 1rem;
                align-items: flex-start;
            }

            .form-wrapper {
                padding: 1rem;
            }

            .form {
                padding: 1rem;
                border-radius: 1rem;
                transition-delay: 0.3s;
            }

            .input-group {
                margin: 0.8rem 0;
            }

            .input-group input {
                padding: 0.9rem 2.5rem;
                font-size: 0.95rem;
            }

            .input-group i {
                font-size: 1.2rem;
            }

            .form button {
                padding: 0.7rem;
                font-size: 1.1rem;
            }

            .form p {
                font-size: 0.85rem;
            }

            .callout {
                font-size: 0.85rem;
            }

            .text {
                margin: 2rem 0;
            }

            .text h2 {
                font-size: 2rem;
                margin: 1rem 0;
            }

            .container::before {
                width: 100vw;
                right: 0;
                transform: none;
                border-radius: 0;
            }

            .container.sign-in::before {
                transform: translateY(0);
            }
        }

        @media only screen and (max-width: 375px) {
            .input-group input {
                padding: 0.8rem 2.2rem;
                font-size: 0.9rem;
            }

            .form button {
                padding: 0.6rem;
                font-size: 1rem;
            }

            .form p {
                font-size: 0.8rem;
            }

            .text h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
<div id="container" class="container sign-in">
    <div class="text">
        <h2>Welcome</h2>
    </div>
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
                    <b><a href="signup.php" class="pointer">Sign up here</a></b>
                </p>
                <p>
                    <b><a href="index.php"><i class='bx bx-home'></i> Home</a></b>
                </p>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
