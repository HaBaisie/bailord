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
        .wrapper {
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
        .navbar {
            background: transparent;
            padding: 10px 0;
        }
        .navbar-header.header-left {
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            height: 50px;
            width: auto;
        }
        .navbar-nav.main-nav.menu > li > a {
            color: var(--text-light);
            padding: 10px 15px;
            font-size: 16px;
            text-transform: uppercase;
        }
        .navbar-nav.main-nav.menu > li:hover > a {
            color: var(--accent-color);
        }
        .navbar-form.navbar-left {
            margin: 8px 15px;
        }
        .navbar-custom-menu .navbar-nav > li > a {
            color: var(--text-light);
            padding: 10px;
        }
        .navbar-custom-menu .navbar-nav > li:hover > a {
            color: var(--accent-color);
        }
        .user-btn, .login-btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 15px;
            background-color: var(--secondary-color);
            color: var(--text-light);
            border-radius: 4px;
            text-decoration: none;
            margin: 0 5px;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .login-btn {
            background-color: var(--dominant-color);
        }
        .user-btn:hover, .login-btn:hover {
            background-color: var(--complementary-blue);
            color: var(--text-light);
        }
        .navbar-custom-menu {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        .navbar-custom-menu .navbar-nav {
            display: flex;
            align-items: center;
            gap: 10px;
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
            align-items: flex-start;
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
        .col-sm-9, .col-sm-3, .col-sm-4 {
            padding: 10px;
            box-sizing: border-box;
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
        /* Responsive Adjustments */
        @media (max-width: 991px) {
            .navbar-collapse.header-center {
                display: none;
            }
            .navbar-custom-menu {
                justify-content: center;
            }
            .navbar-brand img {
                height: 40px;
            }
            .col-sm-9, .col-sm-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .col-sm-4 {
                flex: 0 0 50%;
                max-width: 50%;
            }
            .page-header {
                font-size: 20px;
            }
            .thumbnail {
                height: 180px;
            }
        }
        @media (max-width: 767px) {
            .navbar-header.header-left {
                justify-content: space-between;
                width: 100%;
            }
            .navbar-custom-menu {
                display: none;
            }
            .col-sm-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .thumbnail {
                height: 150px;
            }
        }
        @media (min-width: 992px) {
            .mobile-menu-container {
                display: none;
            }
            .col-sm-9 {
                flex: 0 0 75%;
                max-width: 75%;
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
            const categoryToggle = document.querySelector('.category-dropdown .dropdown-toggle');
            if (categoryToggle) {
                categoryToggle.addEventListener('click', function(e) {
                    if (window.innerWidth < 992) {
                        e.preventDefault();
                        const menu = this.nextElementSibling;
                        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                    }
                });
            }
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle:not(.mobile-menu .dropdown-toggle)');
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
<div class="wrapper">
    <?php include 'includes/session.php'; ?>
    <header class="main-header header" style="background: var(--blue-gradient);">
        <nav class="navbar navbar-static-top" style="background: transparent;">
            <div class="container">
                <div class="navbar-header header-left">
                    <a href="index.php" class="navbar-brand">
                        <img src="../images/logo.png" alt="Bailord Logo" style="height: 50px; display: inline-block;">
                    </a>
                    <button type="button" class="navbar-toggle collapsed mobile-menu-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse pull-left header-center" id="navbar-collapse">
                    <ul class="nav navbar-nav main-nav menu">
                        <li><a href="index.php">HOME</a></li>
                        <li><a href="about.php">ABOUT US</a></li>
                        <li><a href="contact.php">CONTACT US</a></li>
                        <li class="dropdown category-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">CATEGORY <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <?php
                                    $conn = $pdo->open();
                                    try {
                                        $stmt = $conn->prepare("SELECT * FROM category");
                                        $stmt->execute();
                                        foreach ($stmt as $row) {
                                            echo "<li><a href='category.php?category=".htmlspecialchars($row['cat_slug'])."'>".htmlspecialchars($row['name'])."</a></li>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "<li><a href='#'>Error: ".htmlspecialchars($e->getMessage())."</a></li>";
                                    }
                                    $pdo->close();
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <form method="POST" class="navbar-form navbar-left mobile-search" action="search.php">
                        <div class="input-group">
                            <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Search for Product" required>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="navbar-custom-menu header-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="label label-success cart_count"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have <span class="cart_count"></span> item(s) in cart</li>
                                <li>
                                    <ul class="menu" id="cart_menu"></ul>
                                </li>
                                <li class="footer"><a href="cart_view.php">Go to Cart</a></li>
                            </ul>
                        </li>
                        <?php
                            if (isset($_SESSION['user'])) {
                                $image = (!empty($user['photo'])) ? 'images/'.htmlspecialchars($user['photo']) : 'images/profile.jpg';
                                echo '
                                    <li class="dropdown user user-menu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <img src="'.$image.'" class="user-image" alt="User Image">
                                            <span class="hidden-xs">'.htmlspecialchars($user['firstname']).' '.htmlspecialchars($user['lastname']).'</span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="user-header">
                                                <img src="'.$image.'" class="img-circle" alt="User Image">
                                                <p>
                                                    '.htmlspecialchars($user['firstname']).' '.htmlspecialchars($user['lastname']).'
                                                    <small>Member since '.date('M. Y', strtotime($user['created_on'])).'</small>
                                                </p>
                                            </li>
                                            <li class="user-footer">
                                                <div class="pull-left">
                                                    <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                                                </div>
                                                <div class="pull-right">
                                                    <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                ';
                            } else {
                                echo '
                                    <li><a href="login.php" class="user-btn login-btn">LOGIN</a></li>
                                    <li><a href="signup.php" class="user-btn">SIGNUP</a></li>
                                ';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="mobile-menu-container">
            <div class="mobile-menu-wrapper">
                <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
                <ul class="mobile-menu mobile-nav">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="about.php">ABOUT US</a></li>
                    <li><a href="contact.php">CONTACT US</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">CATEGORY <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                                $conn = $pdo->open();
                                try {
                                    $stmt = $conn->prepare("SELECT * FROM category");
                                    $stmt->execute();
                                    foreach ($stmt as $row) {
                                        echo "<li><a href='category.php?category=".htmlspecialchars($row['cat_slug'])."'>".htmlspecialchars($row['name'])."</a></li>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<li><a href='#'>Error: ".htmlspecialchars($e->getMessage())."</a></li>";
                                }
                                $pdo->close();
                            ?>
                        </ul>
                    </li>
                </ul>
                <form method="POST" class="mobile-search" action="search.php">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Search for Product" required>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </header>
    <div class="wrapper">
        <?php
            // Check if category parameter exists
            if (!isset($_GET['category'])) {
                header('location: index.php');
                exit;
            }

            $slug = $_GET['category'];
            $conn = $pdo->open();

            try {
                if ($slug == 'all') {
                    $stmt = $conn->prepare("SELECT * FROM products");
                    $page_title = "All Products";
                    $show_all_products = true;
                } else {
                    $stmt = $conn->prepare("SELECT * FROM category WHERE cat_slug = :slug");
                    $stmt->execute(['slug' => $slug]);
                    $cat = $stmt->fetch();
                    
                    if (!$cat) {
                        $_SESSION['error'] = 'Category not found';
                        header('location: index.php');
                        exit;
                    }
                    
                    $catid = $cat['id'];
                    $page_title = $cat['name'];
                    $show_all_products = false;
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
                header('location: index.php');
                exit;
            }

            $pdo->close();
        ?>
        <div class="content-wrapper">
            <div class="container">
                <section class="content">
                    <div class="row">
                        <div class="col-sm-9">
                            <h1 class="page-header"><?php echo htmlspecialchars($page_title); ?></h1>
                            <?php
                                $conn = $pdo->open();
                                try {
                                    $inc = 3;
                                    $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/noimage.jpg';

                                    if ($show_all_products) {
                                        $stmt = $conn->prepare("SELECT * FROM products");
                                        $stmt->execute();
                                    } else {
                                        $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
                                        $stmt->execute(['catid' => $catid]);
                                    }

                                    if ($stmt->rowCount() > 0) {
                                        foreach ($stmt as $row) {
                                            $image_url = !empty($row['photo'])
                                                ? htmlspecialchars($row['photo'])
                                                : $default_image;
                                            $inc = ($inc == 3) ? 1 : $inc + 1;
                                            if ($inc == 1) echo "<div class='row'>";
                                            echo "
                                                <div class='col-sm-4'>
                                                    <div class='box box-solid'>
                                                        <div class='prod-body'>
                                                            <img src='".$image_url."' width='100%' height='230px' class='thumbnail' alt='".htmlspecialchars($row['name'])."'>
                                                            <h5><a href='product.php?product=".htmlspecialchars($row['slug'])."'>".htmlspecialchars($row['name'])."</a></h5>
                                                        </div>
                                                        <div class='box-footer'>
                                                            <b>₦ ".number_format($row['price'], 2)."</b>
                                                        </div>
                                                    </div>
                                                </div>
                                            ";
                                            if ($inc == 3) echo "</div>";
                                        }
                                        if ($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>";
                                        if ($inc == 2) echo "<div class='col-sm-4'></div></div>";
                                    } else {
                                        echo "<div class='alert alert-info'>No products found.</div>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<div class='alert alert-danger'>Error loading products: ".htmlspecialchars($e->getMessage())."</div>";
                                }
                                $pdo->close();
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php include 'includes/sidebar.php'; ?>
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
