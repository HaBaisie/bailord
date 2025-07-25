<?php
include 'includes/session.php';
include 'config.php';
$conn = $pdo->open();
$user_email = 'customer@example.com';
$user_id = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if ($user_id) {
    try {
        $stmt = $conn->prepare("SELECT email, firstname FROM users WHERE id = :id");
        $stmt->execute(['id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $user_email = htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8');
            $user_firstname = htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8');
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database error: Unable to fetch user details.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bailord</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Bailord eCommerce Template">
    <meta name="author" content="Your Name">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.webmanifest">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Bailord">
    <meta name="application-name" content="Bailord">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/skins/skin-demo-4.css">
    <link rel="stylesheet" href="assets/css/demos/demo-4.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
    <!-- Preload critical resources -->
    <link rel="preload" href="assets/css/bootstrap.min.css" as="style">
    <link rel="preload" href="assets/css/style.css" as="style">
    <!-- DNS prefetch for external resources -->
    <link rel="dns-prefetch" href="//unpkg.com">
    <style>
        :root {
            --dominant-color: #2a5bd7;
            --secondary-color: #28a745;
            --accent-color: #fd7e14;
            --complementary-blue: #1e429f;
            --complementary-orange: #e67700;
            --light-neutral: #f8f9fa;
            --medium-neutral: #e9ecef;
            --dark-neutral: #495057;
            --text-dark: #212529;
            --text-light: #f8f9fa;
            --blue-gradient: linear-gradient(135deg, var(--dominant-color) 0%, var(--complementary-blue) 100%);
            --green-gradient: linear-gradient(135deg, var(--secondary-color) 0%, #1e7e34 100%);
        }
        body {
            background-color: var(--light-neutral);
            color: var(--text-dark);
            font-family: 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            margin: 0;
        }
        body.menu-open {
            overflow: hidden;
        }
        .page-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content-wrapper {
            flex: 1;
            background-color: white;
            padding: 20px 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            width: 100%;
            box-sizing: border-box;
        }
        .header {
            background: var(--blue-gradient);
            color: var(--text-light);
            position: relative;
            z-index: 1000;
        }
        .header-middle .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .header-middle .header-left,
        .header-middle .header-center,
        .header-middle .header-right {
            flex: 1;
            min-width: 0;
        }
        .header-middle .header-left {
            display: flex;
            align-items: center;
        }
        .header-middle .header-right {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
        }
        .header-middle .header-center {
            flex-grow: 2;
            padding: 0 15px;
        }
        .logo img {
            width: 105px;
            height: auto;
        }
        .header-search-extended {
            width: 100%;
            max-width: 500px;
        }
        .header-search-wrapper {
            position: relative;
        }
        .header-search-wrapper .form-control {
            border-radius: 4px 0 0 4px;
            border: 1px solid var(--medium-neutral);
            padding: 8px 15px;
        }
        .header-search-wrapper .btn {
            border-radius: 0 4px 4px 0;
            background-color: var(--dominant-color);
            color: var(--text-light);
            border: none;
        }
        .header-search-wrapper .btn:hover {
            background-color: var(--complementary-blue);
        }
        .search-toggle {
            color: var(--text-light);
            font-size: 20px;
        }
        .user-btn, .login-btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 15px;
            background-color: var(--secondary-color);
            color: var(--text-light);
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .login-btn {
            background-color: var(--dominant-color);
        }
        .user-btn:hover, .login-btn:hover {
            background-color: var(--complementary-blue);
        }
        .cart-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
            color: var(--text-light);
            text-decoration: none;
        }
        .cart-dropdown .icon {
            position: relative;
            font-size: 24px;
        }
        .cart-dropdown .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--secondary-color);
            color: var(--text-light);
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
        .cart-dropdown .dropdown-menu {
            width: 300px;
            padding: 15px;
        }
        .header-bottom {
            background-color: var(--complementary-blue);
        }
        .main-nav .menu > li > a {
            color: var(--text-dark);
            padding: 10px 15px;
            font-size: 16px;
            text-transform: uppercase;
        }
        .main-nav .menu > li:hover > a {
            color: var(--accent-color);
        }
        .mobile-menu-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: flex;
            justify-content: flex-start;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .mobile-menu-container.visible {
            transform: translateX(0);
        }
        .mobile-menu-wrapper {
            width: 80%;
            max-width: 300px;
            height: 100%;
            background-color: var(--light-neutral);
            overflow-y: auto;
            padding: 15px;
        }
        .mobile-menu-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
            color: var(--text-dark);
        }
        .mobile-menu li a {
            color: var(--text-dark);
            padding: 10px;
            display: block;
            font-size: 16px;
        }
        .mobile-menu li a:hover {
            color: var(--accent-color);
        }
        .mobile-menu li ul {
            display: none;
            padding-left: 20px;
            background-color: var(--medium-neutral);
        }
        .mobile-menu li.active > ul {
            display: block;
        }
        .mobile-search .form-control {
            border-radius: 4px 0 0 4px;
            padding: 8px 15px;
        }
        .mobile-search .btn {
            border-radius: 0 4px 4px 0;
            background-color: var(--dominant-color);
            color: var(--text-light);
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        .col-sm-9, .col-sm-3 {
            padding: 10px;
            box-sizing: border-box;
        }
        .page-header {
            color: var(--dominant-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin: 0 0 20px;
            font-size: 24px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
        .box {
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
        }
        .box-body {
            padding: 15px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table th {
            background-color: var(--light-neutral);
            color: var(--dominant-color);
        }
        .table img {
            width: 50px;
            height: auto;
            object-fit: cover;
            border-radius: 4px;
        }
        .btn-primary {
            background-color: var(--dominant-color);
            border-color: var(--dominant-color);
            color: var(--text-light);
            padding: 10px 20px;
            border-radius: 4px;
            margin-right: 10px;
        }
        .btn-primary:hover {
            background-color: var(--complementary-blue);
            border-color: var(--complementary-blue);
        }
        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--text-light);
            padding: 10px 20px;
            border-radius: 4px;
        }
        .btn-secondary:hover {
            background-color: #1e7e34;
            border-color: #1e7e34;
        }
        .delivery-form {
            display: none;
            margin-top: 20px;
            padding: 15px;
            border: 1px solid var(--medium-neutral);
            border-radius: 4px;
        }
        .delivery-form.visible {
            display: block;
        }
        .delivery-form .form-group {
            margin-bottom: 15px;
        }
        .delivery-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .delivery-form input,
        .delivery-form textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid var(--medium-neutral);
            border-radius: 4px;
            box-sizing: border-box;
        }
        .delivery-form textarea {
            resize: vertical;
        }
        .delivery-cost {
            margin-top: 10px;
            font-size: 16px;
            color: var(--dominant-color);
        }
        #map {
            height: 400px;
            width: 100%;
            margin-top: 20px;
            border: 1px solid var(--medium-neutral);
            border-radius: 4px;
        }
        @media (max-width: 991px) {
            .header-middle .header-center .header-search-extended {
                display: none;
            }
            .header-middle .header-center .search-toggle {
                display: inline-block;
            }
            .header-middle .header-right {
                justify-content: center;
            }
            .logo img {
                width: 80px;
            }
            .col-sm-9, .col-sm-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .page-header {
                font-size: 20px;
            }
            .table {
                font-size: 14px;
            }
            .table img {
                width: 40px;
            }
        }
        @media (max-width: 767px) {
            .header-middle .header-left {
                justify-content: space-between;
                width: 100%;
            }
            .header-middle .header-right {
                display: none;
            }
            .table-responsive {
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .table th, .table td {
                padding: 8px;
            }
            .btn-primary, .btn-secondary {
                width: 100%;
                text-align: center;
                margin-bottom: 10px;
            }
            #map {
                height: 300px;
            }
        }
        @media (min-width: 992px) {
            .mobile-menu-container {
                display: none;
            }
            .main-nav {
                display: block !important;
            }
            .col-sm-9 {
                flex: 0 0 75%;
                max-width: 75%;
            }
            .col-sm-3 {
                flex: 0 0 25%;
                max-width: 25%;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggler');
            const mobileMenuContainer = document.querySelector('.mobile-menu-container');
            const mobileMenuClose = document.querySelector('.mobile-menu-close');
            const mobileSearchToggle = document.querySelector('.mobile-search-toggle');
            const mobileSearchForm = document.querySelector('.mobile-search');
            if (mobileMenuToggle && mobileMenuContainer) {
                mobileMenuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileMenuContainer.classList.toggle('visible');
                    document.body.classList.toggle('menu-open');
                });
            }
            if (mobileMenuClose && mobileMenuContainer) {
                mobileMenuClose.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileMenuContainer.classList.remove('visible');
                    document.body.classList.remove('menu-open');
                });
            }
            if (mobileMenuContainer) {
                mobileMenuContainer.addEventListener('click', function(e) {
                    if (e.target === mobileMenuContainer) {
                        mobileMenuContainer.classList.remove('visible');
                        document.body.classList.remove('menu-open');
                    }
                });
            }
            if (mobileSearchToggle && mobileSearchForm) {
                mobileSearchToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileSearchForm.classList.toggle('visible');
                });
            }
            const mobileMenuItems = document.querySelectorAll('.mobile-nav .mobile-menu > li > a');
            mobileMenuItems.forEach(item => {
                if (item.nextElementSibling && item.nextElementSibling.tagName === 'UL') {
                    item.addEventListener('click', function(e) {
                        e.preventDefault();
                        const parentLi = this.parentElement;
                        const subMenu = this.nextElementSibling;
                        parentLi.classList.toggle('active');
                        subMenu.style.display = subMenu.style.display === 'block' ? 'none' : 'block';
                        mobileMenuItems.forEach(otherItem => {
                            if (otherItem !== item && otherItem.nextElementSibling && otherItem.nextElementSibling.tagName === 'UL') {
                                otherItem.parentElement.classList.remove('active');
                                otherItem.nextElementSibling.style.display = 'none';
                            }
                        });
                    });
                }
            });
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    if (window.innerWidth < 992) {
                        e.preventDefault();
                        const menu = this.nextElementSibling;
                        if (menu && menu.classList.contains('dropdown-menu')) {
                            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                            document.querySelectorAll('.dropdown-menu').forEach(m => {
                                if (m !== menu) m.style.display = 'none';
                            });
                        }
                    }
                });
            });
            document.addEventListener('click', function(e) {
                if (window.innerWidth < 992) {
                    if (!e.target.matches('.dropdown-toggle') && !e.target.closest('.dropdown-menu')) {
                        document.querySelectorAll('.dropdown-menu').forEach(menu => {
                            menu.style.display = 'none';
                        });
                    }
                }
            });
        });
    </script>
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="page-wrapper">
    <header class="header header-intro-clearance header-4">
        <div class="header-middle">
            <div class="container">
                <div class="header-left">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="icon-bars"></i>
                    </button>
                    <a href="index.php" class="logo">
                        <img src="assets/images/demos/demo-4/logo.png" alt="Bailord Logo" width="105" height="25">
                    </a>
                </div>
                <div class="header-center">
                    <div class="header-search header-search-extended d-none d-lg-block">
                        <form action="search.php" method="POST">
                            <div class="header-search-wrapper">
                                <label for="q" class="sr-only">Search</label>
                                <input type="search" class="form-control" name="keyword" id="q" placeholder="Search product..." required>
                                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a href="#" class="search-toggle mobile-search-toggle d-lg-none" role="button">
                        <i class="icon-search"></i>
                    </a>
                </div>
                <div class="header-right">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a href="profile.php" class="user-btn" title="User Profile">
                            <i class="icon-user"></i> <?php echo $user_firstname ?? 'Profile'; ?>
                        </a>
                        <a href="logout.php" class="user-btn" title="Logout">
                            <i class="las la-sign-out-alt"></i> Logout
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="login-btn">
                            <i class="icon-user"></i> Login/Signup
                        </a>
                    <?php endif; ?>
                    <div class="dropdown cart-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="icon">
                                <i class="icon-shopping-cart"></i>
                                <span class="cart-count cart_count">0</span>
                            </div>
                            <p>Cart</p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-cart-products" id="cart_menu"></div>
                            <div class="dropdown-cart-total">
                                <span>Total</span>
                                <span class="cart-total-price">$0.00</span>
                            </div>
                            <div class="dropdown-cart-action">
                                <a href="cart_view.php" class="btn btn-primary">View Cart</a>
                                <a href="cart_view.php" class="btn btn-outline-primary-2">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom sticky-header">
            <div class="container">
                <nav class="main-nav d-none d-lg-block">
                    <ul class="menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="category.php?category=all">Shop</a></li>
                        <li><a href="profile.php">Orders</a></li>
                        <li>
                            <a href="#">Browse Categories</a>
                            <ul>
                                <?php
                                    $conn = $pdo->open();
                                    try {
                                        $stmt = $conn->prepare("SELECT * FROM category");
                                        $stmt->execute();
                                        foreach ($stmt as $row) {
                                            $slug = !empty($row['cat_slug']) ? htmlspecialchars($row['cat_slug']) : strtolower(str_replace(' ', '-', $row['name']));
                                            echo "<li><a href='category.php?category=$slug'>".htmlspecialchars($row['name'])."</a></li>";
                                        }
                                    } catch(PDOException $e) {
                                        echo "<li><a href='#'>Error loading categories</a></li>";
                                    }
                                    $pdo->close();
                                ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="mobile-menu-container">
            <div class="mobile-menu-wrapper">
                <span class="mobile-menu-close"><i class="icon-close"></i></span>
                <form action="search.php" method="POST" class="mobile-search">
                    <label for="mobile-search" class="sr-only">Search</label>
                    <input type="search" class="form-control" name="keyword" id="mobile-search" placeholder="Search..." required>
                    <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                </form>
                <nav class="mobile-nav">
                    <ul class="mobile-menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="category.php?category=all">Shop</a></li>
                        <li><a href="profile.php">Orders</a></li>
                        <li>
                            <a href="#">Browse Categories</a>
                            <ul>
                                <?php
                                    $conn = $pdo->open();
                                    try {
                                        $stmt = $conn->prepare("SELECT * FROM category");
                                        $stmt->execute();
                                        foreach ($stmt as $row) {
                                            $slug = !empty($row['cat_slug']) ? htmlspecialchars($row['cat_slug']) : strtolower(str_replace(' ', '-', $row['name']));
                                            echo "<li><a href='category.php?category=$slug'>".htmlspecialchars($row['name'])."</a></li>";
                                        }
                                    } catch(PDOException $e) {
                                        echo "<li><a href='#'>Error loading categories</a></li>";
                                    }
                                    $pdo->close();
                                ?>
                            </ul>
                        </li>
                        <?php if (isset($_SESSION['user'])): ?>
                            <li><a href="profile.php"><?php echo $user_firstname ?? 'Profile'; ?></a></li>
                            <li><a href="logout.php">Logout</a></li>
                        <?php else: ?>
                            <li><a href="login.php">Login/Signup</a></li>
                        <?php endif; ?>
                        <li><a href="cart_view.php">Cart</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <div class="content-wrapper">
        <div class="container">
            <section class="content">
                <div class="row">
                    <div class="col-sm-9">
                        <h1 class="page-header">YOUR CART</h1>
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo "<div class='alert alert-danger'>" . htmlspecialchars($_SESSION['error']) . "</div>";
                            unset($_SESSION['error']);
                        }
                        if (isset($_GET['payment'])) {
                            $payment = htmlspecialchars($_GET['payment']);
                            if ($payment === 'success') {
                                echo "<div class='alert alert-success'>Payment successful! Your cart has been cleared.</div>";
                            } elseif ($payment === 'failed') {
                                echo "<div class='alert alert-danger'>Payment failed. Please try again.</div>";
                            }
                        }
                        ?>
                        <div class="box box-solid">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th></th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th width="20%">Quantity</th>
                                            <th>Subtotal</th>
                                        </thead>
                                        <tbody id="tbody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_SESSION['user'])): ?>
                            <div id="checkout-options">
                                <button id="pickup-button" class="btn btn-primary">Pickup</button>
                                <button id="delivery-button" class="btn btn-secondary">Delivery</button>
                            </div>
                            <div id="delivery-form" class="delivery-form">
                                <form id="delivery-address-form">
                                    <div class="form-group">
                                        <label for="delivery-name">Name</label>
                                        <input type="text" id="delivery-name" name="name" class="form-control" value="<?php echo $user_firstname ?? ''; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="delivery-phone">Phone Number</label>
                                        <input type="tel" id="delivery-phone" name="phone" class="form-control" placeholder="+234xxxxxxxxxx" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="delivery-address">Delivery Address</label>
                                        <textarea id="delivery-address" name="address" class="form-control" rows="4" placeholder="Enter your delivery address" required></textarea>
                                    </div>
                                    <div class="delivery-cost" id="delivery-cost">Delivery Cost: Calculating...</div>
                                    <button type="submit" class="btn btn-primary">Proceed to Delivery Checkout</button>
                                </form>
                                <div id="map"></div>
                            </div>
                        <?php else: ?>
                            <h4>You need to <a href='login.php'>Login</a> to checkout.</h4>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-3">
                        <?php include 'includes/sidebar.php'; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php $pdo->close(); ?>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
    var total = 0;
    var deliveryCost = null; // No default cost

    function loginKwik() {
        return $.ajax({
            type: 'POST',
            url: 'login_kwik.php',
            data: { user_id: <?php echo json_encode($user_id); ?> },
            dataType: 'json'
        });
    }

    function proceedToPaystack(amount, checkout_token, isDelivery, deliveryData) {
        if (isDelivery && deliveryCost === null) {
            alert('Cannot proceed to checkout: No valid delivery cost available.');
            return;
        }
        var handler = PaystackPop.setup({
            key: '<?php echo PAYSTACK_PUBLIC_KEY; ?>',
            email: '<?php echo $user_email; ?>',
            amount: amount * 100,
            currency: 'NGN',
            metadata: { checkout_token: checkout_token },
            callback: function(response) {
                if (isDelivery && deliveryData) {
                    $.ajax({
                        type: 'POST',
                        url: 'sales.php',
                        data: {
                            reference: response.reference,
                            checkout_token: checkout_token,
                            user_id: <?php echo json_encode($user_id); ?>,
                            total_amount: amount
                        },
                        dataType: 'json',
                        success: function(salesResponse) {
                            if (salesResponse.success) {
                                $.ajax({
                                    type: 'POST',
                                    url: 'create_kwik_task.php',
                                    data: {
                                        user_id: <?php echo json_encode($user_id); ?>,
                                        sales_id: salesResponse.sales_id,
                                        name: deliveryData.name,
                                        phone: deliveryData.phone,
                                        address: deliveryData.address,
                                        latitude: deliveryData.latitude,
                                        longitude: deliveryData.longitude,
                                        cart_total: total,
                                        delivery_cost: deliveryCost
                                    },
                                    dataType: 'json',
                                    success: function(taskResponse) {
                                        if (taskResponse.success) {
                                            window.location.href = 'profile.php';
                                        } else {
                                            alert('Error creating delivery task: ' + (taskResponse.message || 'Unknown error'));
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Create task error:', error, xhr.responseText);
                                        alert('Failed to create delivery task: ' + error);
                                    }
                                });
                            } else {
                                alert('Error processing order: ' + (salesResponse.message || 'Unknown error'));
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Sales error:', error, xhr.responseText);
                            alert('Failed to process order: ' + error);
                        }
                    });
                } else {
                    window.location.href = 'sales.php?reference=' + encodeURIComponent(response.reference) + '&checkout_token=' + encodeURIComponent(checkout_token);
                }
            },
            onClose: function() {
                alert('Payment window closed.');
            }
        });
        handler.openIframe();
    }

    $(function(){
        // Initialize Kwik token on page load
        if (<?php echo json_encode($user_id); ?>) {
            loginKwik().done(function(response) {
                if (!response.success) {
                    console.error('Failed to initialize delivery service:', response);
                    alert('Failed to initialize delivery service: ' + (response.message || 'Unknown error'));
                }
            }).fail(function(xhr, status, error) {
                console.error('Kwik login error:', error, xhr.responseText);
                alert('Failed to initialize delivery service: ' + error);
            });
        }

        $(document).on('click', '.cart_delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: 'cart_delete.php',
                data: {id: id},
                dataType: 'json',
                success: function(response){
                    if (!response.error) {
                        getDetails();
                        getCart();
                        getTotal();
                    } else {
                        alert('Error deleting item: ' + (response.message || 'Unknown error'));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Cart delete error:', error, xhr.responseText);
                    alert('Failed to delete item.');
                }
            });
        });

        $(document).on('click', '.minus', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var qty = parseInt($('#qty_' + id).val()) || 1;
            if (qty > 1) {
                qty--;
                $('#qty_' + id).val(qty);
                updateCart(id, qty);
            }
        });

        $(document).on('click', '.add', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var qty = parseInt($('#qty_' + id).val()) || 1;
            qty++;
            $('#qty_' + id).val(qty);
            updateCart(id, qty);
        });

        function updateCart(id, qty) {
            $.ajax({
                type: 'POST',
                url: 'cart_update.php',
                data: {id: id, qty: qty},
                dataType: 'json',
                success: function(response){
                    if (!response.error) {
                        getDetails();
                        getCart();
                        getTotal();
                    } else {
                        alert('Error updating quantity: ' + (response.message || 'Unknown error'));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Cart update error:', error, xhr.responseText);
                    alert('Failed to update quantity.');
                }
            });
        }

        getDetails();
        getTotal();

        // Initialize Leaflet map
        var map = L.map('map').setView([6.5244, 3.3792], 13); // Default to Lagos, Nigeria
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        $('#pickup-button').on('click', function(e){
            e.preventDefault();
            if (total <= 0) {
                alert('Your cart is empty.');
                return;
            }
            $.ajax({
                type: 'POST',
                url: 'save_location.php',
                data: { location: '2 Ijegun Rd, Ikotun 100265, Lagos, Nigeria', user_id: <?php echo json_encode($user_id); ?> },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        proceedToPaystack(total, response.checkout_token, false, null);
                    } else {
                        alert('Error saving pickup location: ' + (response.message || 'Unknown error'));
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Save location error:', error, xhr.responseText);
                    alert('Failed to save pickup location.');
                }
            });
        });

        $('#delivery-button').on('click', function(e){
            e.preventDefault();
            if (total <= 0) {
                alert('Your cart is empty.');
                return;
            }
            $('#delivery-form').toggleClass('visible');
        });

        $('#delivery-address').on('input', function() {
            var address = $(this).val().trim();
            var name = $('#delivery-name').val() ? $('#delivery-name').val().trim() : 'Customer';
            if (address.length > 5) {
                $.ajax({
                    type: 'GET',
                    url: 'https://api.mapbox.com/geocoding/v5/mapbox.places/' + encodeURIComponent(address + ', Nigeria') + '.json',
                    data: {
                        access_token: '<?php echo MAPBOX_ACCESS_TOKEN; ?>'
                    },
                    success: function(geocodeResponse) {
                        if (geocodeResponse.features && geocodeResponse.features.length > 0) {
                            var location = geocodeResponse.features[0].center;
                            var longitude = location[0];
                            var latitude = location[1];
                            map.eachLayer(function(layer) {
                                if (layer instanceof L.Marker) {
                                    map.removeLayer(layer);
                                }
                            });
                            L.marker([latitude, longitude]).addTo(map);
                            map.setView([latitude, longitude], 15);
                            $('#delivery-cost').text('Delivery Cost: Calculating...');
                            var ajaxData = {
                                user_id: <?php echo json_encode($user_id); ?>,
                                address: address,
                                latitude: latitude,
                                longitude: longitude,
                                cart_total: total,
                                name: name
                            };
                            console.log('Sending AJAX data to get_delivery_price.php:', ajaxData);
                            $.ajax({
                                type: 'POST',
                                url: 'get_delivery_price.php',
                                data: ajaxData,
                                dataType: 'json',
                                success: function(priceResponse) {
                                    console.log('Delivery price response:', priceResponse);
                                    if (priceResponse.success && priceResponse.delivery_cost !== undefined) {
                                        deliveryCost = priceResponse.delivery_cost;
                                        $('#delivery-cost').text('Delivery Cost: ₦' + deliveryCost.toFixed(2));
                                    } else {
                                        deliveryCost = null;
                                        $('#delivery-cost').text('Delivery Cost: Error - ' + (priceResponse.message || 'No delivery cost returned'));
                                        alert('Unable to calculate delivery cost: ' + (priceResponse.message || 'No delivery cost returned'));
                                        if (priceResponse.response) {
                                            console.log('API Response:', priceResponse.response);
                                        }
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Delivery price error:', error, xhr.responseText);
                                    deliveryCost = null;
                                    $('#delivery-cost').text('Delivery Cost: Error - Failed to calculate delivery cost: ' + error);
                                    alert('Failed to calculate delivery cost: ' + error);
                                }
                            });
                        } else {
                            deliveryCost = null;
                            $('#delivery-cost').text('Delivery Cost: Unable to geocode address');
                            alert('Please enter a valid address in Nigeria.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Geocode error:', error, xhr.responseText);
                        deliveryCost = null;
                        $('#delivery-cost').text('Delivery Cost: Error - Failed to geocode address: ' + error);
                        alert('Failed to geocode address: ' + error);
                    }
                });
            } else {
                deliveryCost = null;
                $('#delivery-cost').text('Delivery Cost: Enter a valid address');
            }
        });

        $('#delivery-address-form').on('submit', function(e){
            e.preventDefault();
            var name = $('#delivery-name').val().trim();
            var phone = $('#delivery-phone').val().trim();
            var address = $('#delivery-address').val().trim();
            if (!name || !phone || !address) {
                alert('Please fill in all delivery details.');
                return;
            }
            if (!/^\+234\d{10}$/.test(phone)) {
                alert('Please enter a valid phone number in the format +234xxxxxxxxxx');
                return;
            }
            if (deliveryCost === null) {
                alert('Cannot proceed to checkout: No valid delivery cost available.');
                return;
            }
            $.ajax({
                type: 'GET',
                url: 'https://api.mapbox.com/geocoding/v5/mapbox.places/' + encodeURIComponent(address + ', Nigeria') + '.json',
                data: {
                    access_token: '<?php echo MAPBOX_ACCESS_TOKEN; ?>'
                },
                success: function(geocodeResponse) {
                    if (geocodeResponse.features && geocodeResponse.features.length > 0) {
                        var location = geocodeResponse.features[0].center;
                        var longitude = location[0];
                        var latitude = location[1];
                        $.ajax({
                            type: 'POST',
                            url: 'save_location.php',
                            data: {
                                location: address,
                                user_id: <?php echo json_encode($user_id); ?>
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (!response.success) {
                                    alert('Error saving delivery address: ' + (response.message || 'Unknown error'));
                                    return;
                                }
                                var deliveryData = {
                                    name: name,
                                    phone: phone,
                                    address: address,
                                    latitude: latitude,
                                    longitude: longitude
                                };
                                proceedToPaystack(total + deliveryCost, response.checkout_token, true, deliveryData);
                            },
                            error: function(xhr, status, error) {
                                console.error('Save location error:', error, xhr.responseText);
                                alert('Failed to save delivery address: ' + error);
                            }
                        });
                    } else {
                        alert('Unable to geocode address. Please ensure the address is valid and includes a city in Nigeria.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Geocode error:', error, xhr.responseText);
                    alert('Failed to geocode address: ' + error);
                }
            });
        });

        function getDetails() {
            $.ajax({
                type: 'POST',
                url: 'cart_details.php',
                dataType: 'html',
                success: function(response) {
                    $('#tbody').html(response);
                    getCart();
                },
                error: function(xhr, status, error) {
                    console.error('Cart details error:', error, xhr.responseText);
                    $('#tbody').html('<tr><td colspan="6">Failed to load cart.</td></tr>');
                }
            });
        }

        function getTotal() {
            $.ajax({
                type: 'POST',
                url: 'cart_total.php',
                dataType: 'json',
                success: function(response) {
                    total = response.total || 0;
                },
                error: function(xhr, status, error) {
                    console.error('Cart total error:', error, xhr.responseText);
                    total = 0;
                }
            });
        }
    });
    </script>
</div>
</body>
</html>
