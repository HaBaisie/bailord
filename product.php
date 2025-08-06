<?php include 'includes/session.php'; ?>
<?php
$conn = $pdo->open();
$slug = $_GET['product'];

try {
    $stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname, products.id AS prodid FROM products LEFT JOIN category ON category.id=products.category_id WHERE slug = :slug");
    $stmt->execute(['slug' => $slug]);
    $product = $stmt->fetch();
    if (!$product) {
        $_SESSION['error'] = 'Product not found';
        header('location: index.php');
        exit;
    }
} catch (PDOException $e) {
    $_SESSION['error'] = 'Database error: ' . htmlspecialchars($e->getMessage());
    header('location: index.php');
    exit;
}

// Page view counter
$now = date('Y-m-d');
if ($product['date_view'] == $now) {
    $stmt = $conn->prepare("UPDATE products SET counter=counter+1 WHERE id=:id");
    $stmt->execute(['id' => $product['prodid']]);
} else {
    $stmt = $conn->prepare("UPDATE products SET counter=1, date_view=:now WHERE id=:id");
    $stmt->execute(['id' => $product['prodid'], 'now' => $now]);
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
    <!-- Preload critical resources -->
    <link rel="preload" href="assets/css/bootstrap.min.css" as="style">
    <link rel="preload" href="assets/css/style.css" as="style">
    <link rel="preload" href="assets/js/jquery.min.js" as="script">
    <link rel="preload" href="assets/js/bootstrap.bundle.min.js" as="script">
    <!-- DNS prefetch for external resources -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
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
        --text-light: #000000;
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
        color: #ffffff;
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
        color: #ffffff;
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
        color: #ffffff;
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
        color: var(--text-light);
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
        color: var(--text-light);
    }
    .mobile-menu li a {
        color: var(--text-light);
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
        color: #ffffff;
    }
    .page-header {
        color: var(--dominant-color);
        border-bottom: 2px solid var(--secondary-color);
        padding-bottom: 10px;
        margin: 0 0 20px;
        font-size: 24px;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }
    .col-sm-9, .col-sm-6, .col-sm-3, .col-sm-4 {
        padding: 10px;
        box-sizing: border-box;
    }
    .callout {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid var(--medium-neutral);
        border-radius: 4px;
        position: relative;
    }
    .callout .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }
    .zoom {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: contain;
        border-radius: 4px;
    }
    .form-inline .form-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .input-group {
        display: flex;
    }
    .input-group-btn .btn {
        background-color: var(--dominant-color);
        color: #ffffff;
        border: none;
        padding: 10px 15px;
        font-size: 18px;
        line-height: 1;
        transition: all 0.3s ease;
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .input-group-btn:last-child .btn {
        border-radius: 0 4px 4px 0;
    }
    .input-group-btn:first-child .btn {
        border-radius: 4px 0 0 4px;
    }
    .input-group-btn .btn:hover {
        background-color: var(--complementary-blue);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .input-group-btn .btn:active {
        transform: translateY(0);
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    .input-group-btn .btn:disabled {
        background-color: var(--medium-neutral);
        color: var(--dark-neutral);
        cursor: not-allowed;
        box-shadow: none;
    }
    .input-group .form-control.input-lg {
        border: 1px solid var(--medium-neutral);
        border-left: none;
        border-right: none;
        background-color: #ffffff;
        font-size: 16px;
        text-align: center;
        width: 60px;
        height: 46px;
    }
    .btn-primary {
        background-color: var(--dominant-color);
        border-color: var(--dominant-color);
    }
    .btn-primary:hover {
        background-color: var(--complementary-blue);
        border-color: var(--complementary-blue);
    }
    .fb-comments {
        margin-top: 20px;
    }
    .box {
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: white;
    }
    .box:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .prod-body {
        padding: 15px;
    }
    .box-footer {
        background-color: var(--light-neutral);
        padding: 10px 15px;
        border-top: 1px solid #eee;
        font-weight: bold;
        color: var(--dominant-color);
    }
    .thumbnail {
        object-fit: cover;
        border-radius: 3px;
        margin-bottom: 10px;
        width: 100%;
        height: 230px;
    }
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    .alert-info {
        color: #31708f;
        background-color: #d9edf7;
        border-color: #bce8f1;
    }
    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
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
        .col-sm-9, .col-sm-6, .col-sm-3, .col-sm-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .zoom {
            max-height: 300px;
        }
        .page-header {
            font-size: 20px;
        }
        .thumbnail {
            height: 180px;
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
        .form-inline .form-group {
            flex-direction: column;
            align-items: flex-start;
        }
        .input-group {
            width: 100%;
            margin-bottom: 10px;
            justify-content: center;
        }
        .btn-primary.btn-lg {
            width: 100%;
            text-align: center;
        }
        .zoom {
            max-height: 250px;
        }
        .thumbnail {
            height: 150px;
        }
        .mobile-search {
            display: block;
        }
        .input-group-btn .btn {
            padding: 8px 12px;
            font-size: 16px;
            width: 40px;
            height: 40px;
        }
        .input-group .form-control.input-lg {
            height: 40px;
            width: 50px;
            font-size: 14px;
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
        .col-sm-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
        .col-sm-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }
        .col-sm-4 {
            flex: 0 0 33.333%;
            max-width: 33.333%;
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
<script>
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
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
                            <i class="icon-user"></i> <?php echo htmlspecialchars($user['firstname']); ?>
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
                            <li><a href="profile.php"><?php echo htmlspecialchars($user['firstname']); ?></a></li>
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
                        <div class="callout" id="callout" style="display:none">
                            <button type="button" class="close"><span aria-hidden="true">×</span></button>
                            <span class="message"></span>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/noimage.jpg';
                                $image_url = !empty($product['photo'])
                                    ? htmlspecialchars($product['photo'])
                                    : $default_image;
                                $large_image_url = !empty($product['photo'])
                                    ? htmlspecialchars(str_replace('/upload/', '/upload/w_800,h_800,c_fill,f_auto,q_auto/', $product['photo']))
                                    : $default_image;
                                ?>
                                <img src="<?php echo $image_url; ?>" width="100%" class="zoom" data-magnify-src="<?php echo $large_image_url; ?>" alt="<?php echo htmlspecialchars($product['prodname']); ?>">
                                <br><br>
                                <form class="form-inline" id="productForm">
                                    <div class="form-group">
                                        <div class="input-group col-sm-5">
                                            <span class="input-group-btn">
                                                <button type="button" id="minus" class="btn btn-default btn-flat btn-lg" aria-label="Decrease quantity"><i class="fa fa-minus"></i></button>
                                            </span>
                                            <input type="text" name="quantity" id="quantity" class="form-control input-lg" value="1">
                                            <span class="input-group-btn">
                                                <button type="button" id="add" class="btn btn-default btn-flat btn-lg" aria-label="Increase quantity"><i class="fa fa-plus"></i></button>
                                            </span>
                                            <input type="hidden" value="<?php echo $product['prodid']; ?>" name="id">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <h1 class="page-header"><?php echo htmlspecialchars($product['prodname']); ?></h1>
                                <h3><b>₦ <?php echo number_format($product['price'], 2); ?></b></h3>
                                <p><b>Category:</b> <a href="category.php?category=<?php echo htmlspecialchars($product['cat_slug']); ?>"><?php echo htmlspecialchars($product['catname']); ?></a></p>
                                <p><b>Description:</b></p>
                                <p><?php echo htmlspecialchars($product['description']); ?></p>
                            </div>
                        </div>
                        <br>
                        <div class="fb-comments" data-href="https://bailord-0b4b2667ca4f.herokuapp.com/product.php?product=<?php echo htmlspecialchars($slug); ?>" data-numposts="10" width="100%"></div>
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
    <script>
    $(function(){
        function updateMinusButtonState() {
            var quantity = parseInt($('#quantity').val());
            $('#minus').prop('disabled', quantity <= 1);
        }

        $('#add').click(function(e){
            e.preventDefault();
            var quantity = parseInt($('#quantity').val());
            quantity++;
            $('#quantity').val(quantity);
            updateMinusButtonState();
        });

        $('#minus').click(function(e){
            e.preventDefault();
            var quantity = parseInt($('#quantity').val());
            if (quantity > 1) {
                quantity--;
                $('#quantity').val(quantity);
            }
            updateMinusButtonState();
        });

        // Initial state check
        updateMinusButtonState();

        // Update state on manual input
        $('#quantity').on('input', function() {
            var quantity = parseInt($(this).val());
            if (isNaN(quantity) || quantity < 1) {
                $(this).val(1);
            }
            updateMinusButtonState();
        });
    });
    </script>
</div>
</body>
</html>
