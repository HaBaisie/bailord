<?php include 'includes/session.php'; ?>
<?php
    if (!isset($_SESSION['user'])) {
        header('location: login.php');
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
        .callout {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .callout-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .callout-danger {
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
        .box-header {
            padding: 10px 15px;
            background-color: var(--light-neutral);
            border-bottom: 1px solid #ddd;
        }
        .box-title {
            margin: 0;
            font-size: 18px;
            color: var(--dominant-color);
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
        img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }
        .btn-success, .btn-info {
            padding: 6px 12px;
            border-radius: 4px;
            color: var(--text-light);
        }
        .btn-success {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        .btn-success:hover {
            background-color: #1e7e34;
            border-color: #1e7e34;
        }
        .btn-info {
            background-color: var(--dominant-color);
            border-color: var(--dominant-color);
        }
        .btn-info:hover {
            background-color: var(--complementary-blue);
            border-color: var(--complementary-blue);
        }
        .pull-right {
            float: right;
        }
        h4 {
            margin: 10px 0;
            font-size: 16px;
        }
        .edit-form {
            display: none;
            background-color: var(--light-neutral);
            border: 1px solid var(--medium-neutral);
            border-radius: 4px;
            padding: 15px;
            margin-top: 15px;
        }
        .edit-form h4 {
            color: var(--dominant-color);
            margin-bottom: 15px;
        }
        .edit-form .form-group {
            margin-bottom: 15px;
        }
        .edit-form .form-control {
            border-radius: 4px;
        }
        .edit-form .btn-default {
            background-color: var(--medium-neutral);
            border-color: var(--dark-neutral);
            color: var(--text-dark);
        }
        .edit-form .btn-default:hover {
            background-color: #d3d7db;
        }
        /* Transaction History Table Styles */
        .table-responsive {
            margin: 15px 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .table {
            margin-bottom: 0;
            background-color: var(--light-neutral);
        }
        .table thead {
            background: var(--blue-gradient);
            color: var(--text-light);
        }
        .table th {
            font-weight: 600;
            padding: 12px 15px;
            text-transform: uppercase;
            font-size: 14px;
            border: none;
            border-bottom: 2px solid var(--medium-neutral);
        }
        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            font-size: 14px;
            color: var(--text-dark);
            border: none;
            border-bottom: 1px solid var(--medium-neutral);
        }
        .table tbody tr {
            transition: background-color 0.2s ease;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .table tbody tr:hover {
            background-color: #e6f0fa;
        }
        .table .btn-info {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 8px 12px;
            font-size: 13px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        .table .btn-info:hover {
            background-color: var(--complementary-blue);
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .table .btn-info i {
            font-size: 16px;
        }
        .table td:nth-child(2),
        .table td:nth-child(3),
        .table td:nth-child(4) {
            text-align: center;
        }
        /* Pagination and Info Text Styles */
        .dataTables_info {
            padding: 10px 15px;
            font-size: 14px;
            color: var(--text-dark);
            text-align: left;
        }
        .dataTables_paginate {
            padding: 10px 15px;
            text-align: right;
        }
        .dataTables_paginate .paginate_button {
            display: inline-block;
            padding: 8px 12px;
            margin: 0 5px;
            background-color: var(--dominant-color);
            color: var(--text-light);
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .dataTables_paginate .paginate_button:hover {
            background-color: var(--complementary-blue);
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .dataTables_paginate .paginate_button.disabled {
            background-color: var(--medium-neutral);
            color: var(--dark-neutral);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        .dataTables_paginate .paginate_button.current {
            background-color: var(--accent-color);
            color: var(--text-light);
            cursor: default;
        }
        /* Responsive Adjustments */
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
            .table-responsive {
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .table th, .table td {
                padding: 10px;
                font-size: 13px;
            }
            .table .btn-info {
                padding: 6px 10px;
                font-size: 12px;
            }
            .dataTables_info {
                font-size: 13px;
            }
            .dataTables_paginate .paginate_button {
                padding: 6px 10px;
                font-size: 13px;
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
            .box-body .row {
                flex-direction: column;
            }
            .box-body .col-sm-3, .box-body .col-sm-9 {
                max-width: 100%;
            }
            .pull-right {
                float: none;
                display: block;
                margin-top: 10px;
            }
            .table-responsive {
                border: none;
                box-shadow: none;
            }
            .table th, .table td {
                padding: 8px;
                font-size: 12px;
            }
            .table th {
                font-size: 12px;
            }
            .table .btn-info {
                padding: 5px 8px;
                font-size: 11px;
            }
            .table thead {
                display: none;
            }
            .table tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid var(--medium-neutral);
                border-radius: 4px;
                background-color: white;
            }
            .table tbody tr:nth-child(even) {
                background-color: white;
            }
            .table tbody tr:hover {
                background-color: #f8f9fa;
            }
            .table td {
                display: block;
                text-align: right;
                padding: 8px 12px;
                border-bottom: none;
                position: relative;
            }
            .table td:before {
                content: attr(data-label);
                position: absolute;
                left: 12px;
                font-weight: 600;
                color: var(--dominant-color);
                text-transform: uppercase;
            }
            .table td:nth-child(2):before {
                content: "Date";
            }
            .table td:nth-child(3):before {
                content: "Transaction#";
            }
            .table td:nth-child(4):before {
                content: "Amount";
            }
            .table td:nth-child(5):before {
                content: "Details";
            }
            .table td:nth-child(1) {
                display: none;
            }
            .dataTables_info {
                text-align: center;
                font-size: 12px;
            }
            .dataTables_paginate {
                text-align: center;
            }
            .dataTables_paginate .paginate_button {
                padding: 5px 8px;
                font-size: 12px;
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
            const editButton = document.querySelector('.edit-profile-btn');
            const editForm = document.querySelector('.edit-form');
            const cancelButton = document.querySelector('.edit-form .btn-default');
            if (editButton && editForm) {
                editButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    editForm.style.display = editForm.style.display === 'block' ? 'none' : 'block';
                });
            }
            if (cancelButton && editForm) {
                cancelButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    editForm.style.display = 'none';
                });
            }
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
                        <?php
                            if (isset($_SESSION['error'])) {
                                echo "<div class='callout callout-danger'>".htmlspecialchars($_SESSION['error'])."</div>";
                                unset($_SESSION['error']);
                            }
                            if (isset($_SESSION['success'])) {
                                echo "<div class='callout callout-success'>".htmlspecialchars($_SESSION['success'])."</div>";
                                unset($_SESSION['success']);
                            }
                        ?>
                        <div class="box box-solid">
                            <div class="box-body">
                                <div class="col-sm-3">
                                    <img src="<?php echo (!empty($user['photo'])) ? 'images/'.htmlspecialchars($user['photo']) : 'images/profile.jpg'; ?>" width="100%" alt="Profile Photo">
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h4>Name:</h4>
                                            <h4>Email:</h4>
                                            <h4>Contact Info:</h4>
                                            <h4>Address:</h4>
                                            <h4>Member Since:</h4>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4><?php echo htmlspecialchars($user['firstname'].' '.$user['lastname']); ?>
                                                <span class="pull-right">
                                                    <a href="#" class="btn btn-success btn-flat btn-sm edit-profile-btn"><i class="fa fa-edit"></i> Edit</a>
                                                </span>
                                            </h4>
                                            <h4><?php echo htmlspecialchars($user['email']); ?></h4>
                                            <h4><?php echo (!empty($user['contact_info'])) ? htmlspecialchars($user['contact_info']) : 'N/a'; ?></h4>
                                            <h4><?php echo (!empty($user['address'])) ? htmlspecialchars($user['address']) : 'N/a'; ?></h4>
                                            <h4><?php echo date('M d, Y', strtotime($user['created_on'])); ?></h4>
                                        </div>
                                    </div>
                                    <div class="edit-form">
                                        <form class="form-horizontal" method="POST" action="profile_edit.php" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-sm-3 control-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="col-sm-3 control-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="contact" class="col-sm-3 control-label">Contact Info</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($user['contact_info']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="address" class="col-sm-3 control-label">Address</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" id="address" name="address"><?php echo htmlspecialchars($user['address']); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="photo" class="col-sm-3 control-label">Photo</label>
                                                <div class="col-sm-9">
                                                    <input type="file" id="photo" name="photo" accept="image/*">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="curr_password" class="col-sm-3 control-label">Current Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="curr_password" name="curr_password" placeholder="Input current password to save changes" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
                                                    <button type="button" class="btn btn-default btn-flat">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-calendar"></i> <b>Transaction History</b></h4>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th class="hidden"></th>
                                                <th>Date</th>
                                                <th>Transaction#</th>
                                                <th>Amount</th>
                                                <th>Full Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $conn = $pdo->open();
                                            $total_entries = 0;
                                            try {
                                                $stmt = $conn->prepare("SELECT COUNT(*) as total FROM sales WHERE user_id=:user_id");
                                                $stmt->execute(['user_id' => $user['id']]);
                                                $total_entries = $stmt->fetch()['total'];
                                                
                                                $stmt = $conn->prepare("SELECT * FROM sales WHERE user_id=:user_id ORDER BY sales_date DESC");
                                                $stmt->execute(['user_id' => $user['id']]);
                                                $current_entries = $stmt->rowCount();
                                                foreach ($stmt as $row) {
                                                    $stmt2 = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE sales_id=:id");
                                                    $stmt2->execute(['id' => $row['id']]);
                                                    $total = 0;
                                                    foreach ($stmt2 as $row2) {
                                                        $subtotal = $row2['price'] * $row2['quantity'];
                                                        $total += $subtotal;
                                                    }
                                                    echo "
                                                        <tr>
                                                            <td class='hidden'></td>
                                                            <td data-label='Date'>".date('M d, Y', strtotime($row['sales_date']))."</td>
                                                            <td data-label='Transaction#'>".htmlspecialchars($row['pay_id'])."</td>
                                                            <td data-label='Amount'>$ ".number_format($total, 2)."</td>
                                                            <td data-label='Details'><button class='btn btn-sm btn-flat btn-info transact' data-id='".htmlspecialchars($row['id'])."'><i class='fa fa-search'></i> View</button></td>
                                                        </tr>
                                                    ";
                                                }
                                            } catch (PDOException $e) {
                                                echo "<tr><td colspan='5'>There is some problem in connection: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                                            }
                                            $pdo->close();
                                        ?>
                                        </tbody>
                                    </table>
                                    <div class="dataTables_info">Showing 1 to <?php echo $current_entries; ?> of <?php echo $total_entries; ?> entries</div>
                                    <div class="dataTables_paginate">
                                        <a class="paginate_button previous disabled" href="#">Previous</a>
                                        <a class="paginate_button next" href="#">Next</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <?php include 'includes/sidebar.php'; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/profile_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
    $(document).on('click', '.transact', function(e){
        e.preventDefault();
        $('#transaction').modal('show');
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'transaction.php',
            data: {id: id},
            dataType: 'json',
            success: function(response){
                $('#date').html(response.date);
                $('#transid').html(response.transaction);
                $('#detail').prepend(response.list);
                $('#total').html(response.total);
            },
            error: function(xhr, status, error) {
                console.error('Transaction fetch error:', error);
                alert('Failed to load transaction details.');
            }
        });
    });

    $("#transaction").on("hidden.bs.modal", function () {
        $('.prepend_items').remove();
    });
});
</script>
</body>
</html>
