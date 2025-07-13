<?php
include 'includes/conn.php';
session_start();

if(isset($_SESSION['admin'])){
    header('location: admin/home.php');
}

if(isset($_SESSION['user'])){
    $conn = $pdo->open();
    try{
        $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(['id'=>$_SESSION['user']]);
        $user = $stmt->fetch();
    }
    catch(PDOException $e){
        echo "There is some problem in connection: " . $e->getMessage();
    }
    $pdo->close();
} else {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Tables - Bailord</title>
    <meta name="keywords" content="Bailord Database Tables">
    <meta name="description" content="View descriptions of all tables in the Bailord database">
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
        .col-sm-12 {
            padding: 10px;
            box-sizing: border-box;
            flex: 0 0 100%;
            max-width: 100%;
        }
        .callout {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
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
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
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
            .table th, .table td {
                padding: 8px;
                font-size: 14px;
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
        }
        @media (min-width: 992px) {
            .mobile-menu-container {
                display: none;
            }
            .main-nav {
                display: block !important;
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
                    <a href="profile.php" class="user-btn" title="User Profile">
                        <i class="icon-user"></i> <?php echo htmlspecialchars($user['firstname']); ?>
                    </a>
                    <a href="logout.php" class="user-btn" title="Logout">
                        <i class="las la-sign-out-alt"></i> Logout
                    </a>
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
                        <li><a href="db_tables.php">Database Tables</a></li>
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
                        <li><a href="db_tables.php">Database Tables</a></li>
                        <li><a href="profile.php"><?php echo htmlspecialchars($user['firstname']); ?></a></li>
                        <li><a href="logout.php">Logout</a></li>
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
                    <div class="col-sm-12">
                        <?php
                            if (isset($_SESSION['error'])) {
                                echo "<div class='callout callout-danger'>".htmlspecialchars($_SESSION['error'])."</div>";
                                unset($_SESSION['error']);
                            }
                        ?>
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-database"></i> <b>Database Table Descriptions</b></h4>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <?php
                                        $conn = $pdo->open();
                                        try {
                                            // Get list of tables
                                            $stmt = $conn->prepare("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE()");
                                            $stmt->execute();
                                            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
                                            if (empty($tables)) {
                                                echo "<p>No tables found in the database.</p>";
                                            } else {
                                                foreach ($tables as $table) {
                                                    echo "<h4>Table: " . htmlspecialchars($table) . "</h4>";
                                                    // Get column details for each table
                                                    $stmt = $conn->prepare("
                                                        SELECT 
                                                            COLUMN_NAME, 
                                                            DATA_TYPE, 
                                                            CHARACTER_MAXIMUM_LENGTH, 
                                                            IS_NULLABLE, 
                                                            COLUMN_DEFAULT, 
                                                            COLUMN_KEY, 
                                                            EXTRA 
                                                        FROM INFORMATION_SCHEMA.COLUMNS 
                                                        WHERE TABLE_NAME = :table AND TABLE_SCHEMA = DATABASE()
                                                    ");
                                                    $stmt->execute(['table' => $table]);
                                                    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    if (!empty($columns)) {
                                                        echo "<table class='table table-bordered'>";
                                                        echo "<thead>";
                                                        echo "<tr>";
                                                        echo "<th>Column Name</th>";
                                                        echo "<th>Data Type</th>";
                                                        echo "<th>Length</th>";
                                                        echo "<th>Nullable</th>";
                                                        echo "<th>Default</th>";
                                                        echo "<th>Key</th>";
                                                        echo "<th>Extra</th>";
                                                        echo "</tr>";
                                                        echo "</thead>";
                                                        echo "<tbody>";
                                                        foreach ($columns as $column) {
                                                            echo "<tr>";
                                                            echo "<td>" . htmlspecialchars($column['COLUMN_NAME']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($column['DATA_TYPE']) . "</td>";
                                                            echo "<td>" . ($column['CHARACTER_MAXIMUM_LENGTH'] ? htmlspecialchars($column['CHARACTER_MAXIMUM_LENGTH']) : '-') . "</td>";
                                                            echo "<td>" . htmlspecialchars($column['IS_NULLABLE']) . "</td>";
                                                            echo "<td>" . ($column['COLUMN_DEFAULT'] !== null ? htmlspecialchars($column['COLUMN_DEFAULT']) : '-') . "</td>";
                                                            echo "<td>" . ($column['COLUMN_KEY'] ? htmlspecialchars($column['COLUMN_KEY']) : '-') . "</td>";
                                                            echo "<td>" . ($column['EXTRA'] ? htmlspecialchars($column['EXTRA']) : '-') . "</td>";
                                                            echo "</tr>";
                                                        }
                                                        echo "</tbody>";
                                                        echo "</table>";
                                                    } else {
                                                        echo "<p>No columns found for table " . htmlspecialchars($table) . ".</p>";
                                                    }
                                                }
                                            }
                                        } catch(PDOException $e) {
                                            echo "<div class='callout callout-danger'>Error fetching table descriptions: " . htmlspecialchars($e->getMessage()) . "</div>";
                                            error_log("Table descriptions fetch failed: " . $e->getMessage());
                                        }
                                        $pdo->close();
                                    ?>
                                </div>
                                <div class="table-responsive">
                                    <h4>Category Table Data</h4>
                                    <?php
                                        $conn = $pdo->open();
                                        try {
                                            $stmt = $conn->prepare("SELECT * FROM category");
                                            $stmt->execute();
                                            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if (empty($categories)) {
                                                echo "<p>No data found in the category table.</p>";
                                            } else {
                                                echo "<table class='table table-bordered'>";
                                                echo "<thead>";
                                                echo "<tr>";
                                                // Dynamically generate headers based on column names
                                                $columns = array_keys($categories[0]);
                                                foreach ($columns as $column) {
                                                    echo "<th>" . htmlspecialchars($column) . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";
                                                foreach ($categories as $category) {
                                                    echo "<tr>";
                                                    foreach ($category as $value) {
                                                        echo "<td>" . (is_null($value) ? '-' : htmlspecialchars($value)) . "</td>";
                                                    }
                                                    echo "</tr>";
                                                }
                                                echo "</tbody>";
                                                echo "</table>";
                                            }
                                        } catch(PDOException $e) {
                                            echo "<div class='callout callout-danger'>Error fetching category data: " . htmlspecialchars($e->getMessage()) . "</div>";
                                            error_log("Category data fetch failed: " . $e->getMessage());
                                        }
                                        $pdo->close();
                                    ?>
                                </div>
                                <div class="table-responsive">
                                    <h4>Kwik Tokens Table Data</h4>
                                    <?php
                                        $conn = $pdo->open();
                                        try {
                                            $stmt = $conn->prepare("SELECT * FROM kwik_tokens");
                                            $stmt->execute();
                                            $kwik_tokens = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if (empty($kwik_tokens)) {
                                                echo "<p>No data found in the kwik_tokens table.</p>";
                                            } else {
                                                echo "<table class='table table-bordered'>";
                                                echo "<thead>";
                                                echo "<tr>";
                                                // Dynamically generate headers based on column names
                                                $columns = array_keys($kwik_tokens[0]);
                                                foreach ($columns as $column) {
                                                    echo "<th>" . htmlspecialchars($column) . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";
                                                foreach ($kwik_tokens as $token) {
                                                    echo "<tr>";
                                                    foreach ($token as $value) {
                                                        echo "<td>" . (is_null($value) ? '-' : htmlspecialchars($value)) . "</td>";
                                                    }
                                                    echo "</tr>";
                                                }
                                                echo "</tbody>";
                                                echo "</table>";
                                            }
                                        } catch(PDOException $e) {
                                            echo "<div class='callout callout-danger'>Error fetching kwik_tokens data: " . htmlspecialchars($e->getMessage()) . "</div>";
                                            error_log("Kwik tokens data fetch failed: " . $e->getMessage());
                                        }
                                        $pdo->close();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
