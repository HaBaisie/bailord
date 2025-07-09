<?php
include 'includes/session.php';

// Fetch user data if logged in
if (isset($_SESSION['user'])) {
    $conn = $pdo->open();
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $_SESSION['user']]);
        $user = $stmt->fetch();
    } catch (PDOException $e) {
        $error_message = "Error fetching user data: " . htmlspecialchars($e->getMessage());
        error_log("User fetch failed: " . $e->getMessage());
    }
    $pdo->close();
}

// Handle form submission to execute SQL
$success_message = '';
$error_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['setup_subcategories'])) {
    $conn = $pdo->open();
    try {
        $sql_alter = "
            ALTER TABLE category
            DROP FOREIGN KEY category_ibfk_1";
        $conn->exec($sql_alter);
        $sql_alter = "
            ALTER TABLE category
            DROP COLUMN subcategory_id";
        $conn->exec($sql_alter);

        $success_message = "Subcategory table created and products table updated successfully.";
    } catch (PDOException $e) {
        $error_message = "Error executing database changes: " . htmlspecialchars($e->getMessage());
        error_log("Database setup failed: " . $e->getMessage());
    }
    $pdo->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Subcategories - Bailord</title>
    <meta name="keywords" content="Bailord Database Setup">
    <meta name="description" content="Setup subcategories for Bailord eCommerce">
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
            --text-light: #000000; /* Black for nav text */
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
        .btn-primary {
            background-color: var(--dominant-color);
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: var(--complementary-blue);
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
        }
        @media (max-width: 767px) {
            .header-middle .header-left {
                justify-content: space-between;
                width: 100%;
            }
            .header-middle .header-right {
                display: none;
            }
            .btn-primary {
                font-size: 14px;
                padding: 8px 15px;
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
                                            echo "<li><a href='category.php?category=$slug'>".htmlspecialchars($row['name'])."</a>";
                                            // Fetch subcategories
                                            $sub_stmt = $conn->prepare("SELECT * FROM subcategory WHERE category_id = :cat_id");
                                            $sub_stmt->execute(['cat_id' => $row['id']]);
                                            $subcategories = $sub_stmt->fetchAll();
                                            if (!empty($subcategories)) {
                                                echo "<ul>";
                                                foreach ($subcategories as $sub_row) {
                                                    $sub_slug = !empty($sub_row['subcat_slug']) ? htmlspecialchars($sub_row['subcat_slug']) : strtolower(str_replace(' ', '-', $sub_row['name']));
                                                    echo "<li><a href='category.php?category=$slug&subcategory=$sub_slug'>".htmlspecialchars($sub_row['name'])."</a></li>";
                                                }
                                                echo "</ul>";
                                            }
                                            echo "</li>";
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
                                            echo "<li><a href='category.php?category=$slug'>".htmlspecialchars($row['name'])."</a>";
                                            // Fetch subcategories
                                            $sub_stmt = $conn->prepare("SELECT * FROM subcategory WHERE category_id = :cat_id");
                                            $sub_stmt->execute(['cat_id' => $row['id']]);
                                            $subcategories = $sub_stmt->fetchAll();
                                            if (!empty($subcategories)) {
                                                echo "<ul>";
                                                foreach ($subcategories as $sub_row) {
                                                    $sub_slug = !empty($sub_row['subcat_slug']) ? htmlspecialchars($sub_row['subcat_slug']) : strtolower(str_replace(' ', '-', $sub_row['name']));
                                                    echo "<li><a href='category.php?category=$slug&subcategory=$sub_slug'>".htmlspecialchars($sub_row['name'])."</a></li>";
                                                }
                                                echo "</ul>";
                                            }
                                            echo "</li>";
                                        }
                                    } catch(PDOException $e) {
                                        echo "<li><a href='#'>Error loading categories</a></li>";
                                    }
                                    $pdo->close();
                                ?>
                            </ul>
                        </li>
                        <li><a href="db_tables.php">Database Tables</a></li>
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
                    <div class="col-sm-12">
                        <?php
                            if ($success_message) {
                                echo "<div class='callout callout-success'>$success_message</div>";
                            }
                            if ($error_message) {
                                echo "<div class='callout callout-danger'>$error_message</div>";
                            }
                        ?>
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-database"></i> <b>Setup Subcategories</b></h4>
                            </div>
                            <div class="box-body">
                                <p>This action will create the <code>subcategory</code> table and add a <code>subcategory_id</code> column to the <code>products</code> table.</p>
                                <form method="POST" action="">
                                    <button type="submit" name="setup_subcategories" class="btn btn-primary">Execute Database Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</div>
</body>
</html>
