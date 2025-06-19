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
            background-image: url('https://images.unsplash.com/photo-1584438784894-089d6a62b8f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .container {
            position: relative;
            max-width: 28rem;
            width: 100%;
            margin: 1rem;
            z-index: 10;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .form-container.hidden {
            transform: scale(0.8);
            opacity: 0;
            position: absolute;
            pointer-events: none;
        }

        .form-container.visible {
            transform: scale(1);
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
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus {
            border-color: #3b82f6;
            outline: none;
        }

        .btn-primary {
            background: linear-gradient(to right, #3b82f6, #1d4ed8);
            color: white;
            padding: 0.75rem;
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
            transition: border-color 0.3s ease;
        }

        .social-btn:hover {
            border-color: #3b82f6;
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

        @media (max-width: 640px) {
            .container {
                margin: 0.5rem;
            }

            .form-container {
                padding: 1.5rem;
                border-radius: 1rem;
            }

            .input-group input {
                padding: 0.625rem 0.625rem 0.625rem 2.25rem;
                font-size: 0.875rem;
            }

            .btn-primary {
                padding: 0.625rem;
                font-size: 1rem;
            }

            .social-btn {
                padding: 0.625rem;
                font-size: 0.875rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- SIGN IN FORM -->
    <div id="sign-in-form" class="form-container visible">
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
                <button class="social-btn w-full">
                    <i class="fa-brands fa-google"></i> Google
                </button>
                <button class="social-btn w-full">
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
    <div id="sign-up-form" class="form-container hidden">
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
                <button class="social-btn w-full">
                    <i class="fa-brands fa-google"></i> Google
                </button>
                <button class="social-btn w-full">
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

<script>
    function toggleForm() {
        const signInForm = document.getElementById('sign-in-form');
        const signUpForm = document.getElementById('sign-up-form');
        
        if (signInForm.classList.contains('visible')) {
            signInForm.classList.remove('visible');
            signInForm.classList.add('hidden');
            signUpForm.classList.remove('hidden');
            signUpForm.classList.add('visible');
        } else {
            signUpForm.classList.remove('visible');
            signUpForm.classList.add('hidden');
            signInForm.classList.remove('hidden');
            signInForm.classList.add('visible');
        }
    }

    // Initialize sign-in form as visible
    setTimeout(() => {
        document.getElementById('sign-in-form').classList.add('visible');
    }, 200);
</script>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
