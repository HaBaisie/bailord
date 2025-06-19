<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  }
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1584438784894-089d6a62b8f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .container {
            position: relative;
            max-width: 64rem;
            width: 100%;
            margin: 1rem;
            z-index: 10;
            display: flex;
            justify-content: center;
        }

        .form-wrapper {
            display: flex;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            position: relative;
        }

        .form-container {
            width: 50%;
            padding: 2.5rem;
            transition: transform 0.6s ease, opacity 0.6s ease;
        }

        .form-container.sign-in {
            transform: translateX(0);
            opacity: 1;
        }

        .form-container.sign-up {
            transform: translateX(100%);
            opacity: 0;
            position: absolute;
            right: 0;
        }

        .container.sign-up .form-container.sign-in {
            transform: translateX(-100%);
            opacity: 0;
        }

        .container.sign-up .form-container.sign-up {
            transform: translateX(0);
            opacity: 1;
            position: relative;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 1.25rem;
        }

        .input-group input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .input-group input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .btn-primary {
            background: linear-gradient(to right, #3b82f6, #1d4ed8);
            color: white;
            padding: 0.875rem;
            border-radius: 0.5rem;
            font-size: 1.125rem;
            font-weight: 500;
            transition: transform 0.2s ease, background 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            background: linear-gradient(to right, #1d4ed8, #1e40af);
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 1rem;
            color: #374151;
            transition: border-color 0.3s ease, background 0.3s ease;
        }

        .social-btn.google:hover {
            border-color: #db4437;
            background: rgba(219, 68, 55, 0.05);
        }

        .social-btn.facebook:hover {
            border-color: #4267b2;
            background: rgba(66, 103, 178, 0.05);
        }

        .callout {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
            text-align: center;
            font-size: 0.875rem;
        }

        .callout-danger {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .callout-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        @media (max-width: 768px) {
            .form-wrapper {
                flex-direction: column;
                max-width: 28rem;
            }

            .form-container {
                width: 100%;
                position: relative;
                transform: translateY(0);
            }

            .form-container.sign-up {
                transform: translateY(100%);
                position: absolute;
                top: 0;
                right: auto;
            }

            .container.sign-up .form-container.sign-in {
                transform: translateY(-100%);
            }

            .container.sign-up .form-container.sign-up {
                transform: translateY(0);
            }

            .form-container {
                padding: 1.5rem;
            }

            .input-group input {
                padding: 0.75rem 0.75rem 0.75rem 2.5rem;
                font-size: 0.875rem;
            }

            .btn-primary {
                padding: 0.75rem;
                font-size: 1rem;
            }

            .social-btn {
                padding: 0.625rem;
                font-size: 0.875rem;
            }
        }

        @media (max-width: 640px) {
            .container {
                margin: 0.5rem;
            }

            .form-wrapper {
                border-radius: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="container" id="container">
    <div class="form-wrapper">
        <!-- SIGN IN FORM -->
        <div class="form-container sign-in">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Welcome Back</h2>
            <?php
            if(isset($_SESSION['error'])){
                echo "<div class='callout callout-danger'>".$_SESSION['error']."</div>";
                unset($_SESSION['error']);
            }
            if(isset($_SESSION['success'])){
                echo "<div class='callout callout-success'>".$_SESSION['success']."</div>";
                unset($_SESSION['success']);
            }
            ?>
            <form action="verify.php" method="POST" aria-label="Sign In Form">
                <div class="input-group">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required aria-label="Email">
                </div>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required aria-label="Password">
                </div>
                <button type="submit" name="login" class="btn-primary w-full mt-4">Sign In</button>
            </form>
            <div class="mt-6">
                <p class="text-center text-gray-600 text-sm mb-4">Or sign in with</p>
                <div class="space-y-2">
                    <button class="social-btn google w-full">
                        <i class="fa-brands fa-google"></i> Google
                    </button>
                    <button class="social-btn facebook w-full">
                        <i class="fa-brands fa-facebook-f"></i> Facebook
                    </button>
                </div>
            </div>
            <p class="text-center text-gray-600 text-sm mt-6">
                <a href="password_forgot.php" class="text-blue-600 hover:underline">Forgot password?</a>
            </p>
            <p class="text-center text-gray-600 text-sm mt-2">
                Don't have an account? <button onclick="toggleForm()" class="text-blue-600 hover:underline font-medium">Sign up</button>
            </p>
            <p class="text-center text-gray-600 text-sm mt-2">
                <a href="index.php" class="text-blue-600 hover:underline"><i class="fa-solid fa-home"></i> Home</a>
            </p>
        </div>

        <!-- SIGN UP FORM -->
        <div class="form-container sign-up">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Join Us</h2>
            <?php
            if(isset($_SESSION['error'])){
                echo "<div class='callout callout-danger'>".$_SESSION['error']."</div>";
                unset($_SESSION['error']);
            }
            if(isset($_SESSION['success'])){
                echo "<div class='callout callout-success'>".$_SESSION['success']."</div>";
                unset($_SESSION['success']);
            }
            ?>
            <form action="register.php" method="POST" aria-label="Sign Up Form">
                <div class="input-group">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="firstname" placeholder="First Name" value="<?php echo (isset($_SESSION['firstname'])) ? $_SESSION['firstname'] : '' ?>" required aria-label="First Name">
                </div>
                <div class="input-group">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="lastname" placeholder="Last Name" value="<?php echo (isset($_SESSION['lastname'])) ? $_SESSION['lastname'] : '' ?>" required aria-label="Last Name">
                </div>
                <div class="input-group">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : '' ?>" required aria-label="Email">
                </div>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required aria-label="Password">
                </div>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="repassword" placeholder="Confirm Password" required aria-label="Confirm Password">
                </div>
                <button type="submit" name="signup" class="btn-primary w-full mt-4">Sign Up</button>
            </form>
            <div class="mt-6">
                <p class="text-center text-gray-600 text-sm mb-4">Or sign up with</p>
                <div class="space-y-2">
                    <button class="social-btn google w-full">
                        <i class="fa-brands fa-google"></i> Google
                    </button>
                    <button class="social-btn facebook w-full">
                        <i class="fa-brands fa-facebook-f"></i> Facebook
                    </button>
                </div>
            </div>
            <p class="text-center text-gray-600 text-sm mt-6">
                Already have an account? <button onclick="toggleForm()" class="text-blue-600 hover:underline font-medium">Sign in</button>
            </p>
            <p class="text-center text-gray-600 text-sm mt-2">
                <a href="index.php" class="text-blue-600 hover:underline"><i class="fa-solid fa-home"></i> Home</a>
            </p>
        </div>
    </div>
</div>

<script>
    function toggleForm() {
        const container = document.getElementById('container');
        container.classList.toggle('sign-up');
    }

    // Initialize sign-in form as visible
    setTimeout(() => {
        document.getElementById('container').classList.remove('sign-up');
    }, 200);
</script>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
