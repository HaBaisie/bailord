<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
    <!-- New Slider CSS File -->
    <link rel="stylesheet" href="assets/css/slider.css">
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
        }
        body.menu-open {
            overflow: hidden;
        }
        .header {
            background: var(--blue-gradient);
            color: var(--text-light);
        }
        .header-top {
            background-color: var(--complementary-blue);
        }
        .main-nav .menu > li > a {
            color: var(--text-dark);
        }
        .main-nav .menu > li:hover > a {
            color: var(--accent-color);
        }
        .btn-primary {
            background-color: var(--dominant-color);
            border-color: var(--dominant-color);
        }
        .btn-primary:hover {
            background-color: var(--complementary-blue);
            border-color: var(--complementary-blue);
        }
        .btn-outline-primary {
            color: var(--dominant-color);
            border-color: var(--dominant-color);
        }
        .btn-outline-primary:hover {
            background-color: var(--dominant-color);
            color: var(--text-light);
        }
        .highlight, .intro-subtitle.text-third, .intro-price .text-third {
            color: var(--accent-color);
        }
        .user-btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 15px;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 4px;
            text-decoration: none;
            margin-left: 10px;
            font-size: 14px;
        }
        .user-btn:hover {
            background-color: #1e7e34;
            color: white;
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        @media (max-width: 767px) {
            .header-top {
                padding: 5px 0;
            }
            .header-contact, .top-menu li a {
                font-size: 12px;
                padding: 5px;
            }
            .logo img {
                width: 80px;
                height: auto;
            }
            .cat-blocks-container .col-6 {
                padding: 5px;
            }
            .cat-block-title {
                font-size: 12px;
            }
            .product {
                margin-bottom: 10px;
            }
            .product-media img {
                max-width}
            .product-title {
                font-size: 13px;
                line-height: 1.3;
            }
            .product-price {
                font-size: 14px;
            }
            .ratings-container {
                font-size: 12px;
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
            }
            .btn {
                padding: 7px 12px;
                font-size: 13px;
            }
            .deal {
                min-height: 180px;
            }
            .deal-content {
                padding: 8px;
            }
            .deal h2 {
                font-size: 14px;
            }
            .deal h3 {
                font-size: 12px;
            }
            .footer .col-sm-6 {
                margin-bottom: 15px;
            }
            .header-right.d-none.d-lg-block,
            .heading-right {
                display: none !important;
            }
        }
        @media (min-width: 768px) and (max-width: 991px) {
            .product {
                margin-bottom: 15px;
            }
            .product-media img {
                max-height: 150px;
            }
            .cat-block-title {
                font-size: 13px;
            }
        }
        .btn, .dropdown-toggle, .mobile-menu-toggler, 
        .mobile-search-toggle, .product-media a {
            min-height: 44px;
            min-width: 44px;
            position: relative;
        }
        .btn-product-icon:before, 
        .icon-phone:before, 
        .icon-search:before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
        }
        a, button {
            -webkit-tap-highlight-color: transparent;
            -webkit-touch-callout: none;
            user-select: none;
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
        .login-btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 15px;
            background-color: var(--dominant-color);
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }
        .login-btn:hover {
            background-color: var(--complementary-blue);
            color: white;
        }
        .mobile-menu li {
            position: relative;
        }
        .mobile-menu li ul {
            display: none;
            position: static;
            width: 100%;
            padding-left: 20px;
            background-color: var(--medium-neutral);
        }
        .mobile-menu li.active > ul {
            display: block;
        }
        .mobile-menu-container .mobile-menu li a {
            color: var(--text-dark);
        }
        .mobile-menu-container .mobile-menu li a:hover {
            color: var(--accent-color);
        }
        .mobile-menu-container .mobile-menu li ul li a {
            color: var(--text-dark);
        }
        .mobile-menu-container .mobile-menu li ul li a:hover {
            color: var(--accent-color);
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
            const mobileSearchToggle = document.querySelector('.mobile-search-toggle');
            const mobileSearchForm = document.querySelector('.mobile-search');
            if (mobileSearchToggle && mobileSearchForm) {
                mobileSearchToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileSearchForm.classList.toggle('visible');
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
            let lastTouchEnd = 0;
            document.addEventListener('touchend', function(event) {
                const now = (new Date()).getTime();
                if (now - lastTouchEnd <= 300) {
                    event.preventDefault();
                }
                lastTouchEnd = now;
            }, false);
        });
    </script>
</head>

<body>
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
                            <form action="#" method="get">
                                <div class="header-search-wrapper">
                                    <label for="q" class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Search product..." required>
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
                                    <span class="cart-count">0</span>
                                </div>
                                <p>Cart</p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-cart-products"></div>
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
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="category.php?category=all">Shop</a></li>
                            <li><a href="profile.php">Orders</a></li>
                            <li>
                                <a href="#">Browse Categories</a>
                                <ul>
                                    <?php
                                    $pdo = new Database();
                                    $conn = $pdo->open();
                                    try {
                                        $stmt = $conn->prepare("SELECT * FROM category");
                                        $stmt->execute();
                                        $categories = $stmt->fetchAll();
                                        foreach ($categories as $category) {
                                            $slug = !empty($category['cat_slug']) ? $category['cat_slug'] : strtolower(str_replace(' ', '-', $category['name']));
                                            echo '<li><a href="category.php?category='.$slug.'">'.$category['name'].'</a></li>';
                                        }
                                    } catch(PDOException $e) {
                                        echo "<li><a href='#'>Error loading categories</a></li>";
                                    }
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
                    <form action="#" method="get" class="mobile-search">
                        <label for="mobile-search" class="sr-only">Search</label>
                        <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search..." required>
                        <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                    </form>
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="category.php?category=all">Shop</a></li>
                            <li><a href="profile.php">Orders</a></li>
                            <li>
                                <a href="#">Browse Categories</a>
                                <ul>
                                    <?php
                                    try {
                                        $stmt = $conn->prepare("SELECT * FROM category");
                                        $stmt->execute();
                                        $categories = $stmt->fetchAll();
                                        foreach ($categories as $category) {
                                            $slug = !empty($category['cat_slug']) ? $category['cat_slug'] : strtolower(str_replace(' ', '-', $category['name']));
                                            echo '<li><a href="category.php?category='.$slug.'">'.$category['name'].'</a></li>';
                                        }
                                    } catch(PDOException $e) {
                                        echo "<li><a href='#'>Error loading categories</a></li>";
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Pages</a>
                                <ul>
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="faq.html">FAQs</a></li>
                                    <li><a href="404.html">Error 404</a></li>
                                    <li><a href="coming-soon.html">Coming Soon</a></li>
                                </ul>
                            </li>
                            <li><a href="blog.html">Blog</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main class="main">
            <div class="intro-slider-container mb-5">
                <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" 
                    data-owl-options='{
                        "dots": true,
                        "nav": false,
                        "center": true,
                        "items": 1,
                        "margin": 10,
                        "responsive": {
                            "0": {"stagePadding": 40},
                            "768": {"stagePadding": 60},
                            "1200": {"nav": true, "dots": false, "stagePadding": 80}
                        }
                    }'>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/slider1.png" alt="ITEL P70">
                    </div>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/TECNO_POP_10C.png" alt="TECNO POP 10C">
                    </div>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/TECNO_POP_10.png" alt="TECNO POP 10">
                    </div>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/VIVO_Y04.png" alt="VIVO Y04">
                    </div>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/ZTE_BLADE_A35.png" alt="ZTE BLADE A35">
                    </div>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/ZTE_BLAD_A55.png" alt="ZTE BLADE A55">
                    </div>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/ITEL_CITY_100.png" alt="ITEL CITY 100">
                    </div>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/REALME_C75.png" alt="REALME C75">
                    </div>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/REDMI_A5.png" alt="REDMI A5">
                    </div>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/REALME_NOTE50.png" alt="REALME NOTE50">
                    </div>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/OPPO.png" alt="OPPO A3">
                    </div>
                    <div class="intro-slide">
                        <img src="images/INIFINIX_SMART_10.png" alt="INIFINIX SMART 10">
                    </div>
                </div>
                <span class="slider-loader"></span>
            </div>
            <div class="container">
                <h2 class="title text-center mb-4">Explore Popular Categories</h2>
                <div class="cat-blocks-container">
                    <div class="row">
                        <?php echo renderCategoryBlocks($conn); ?>
                    </div>
                </div>
            </div>
            <div class="mb-4"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <!-- Promo banners will be dynamically loaded here -->
                </div>
            </div>
            <div class="mb-3"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="banner banner-overlay banner-overlay-light">
                            <a href="#">
                                <img src="assets/images/demos/demo-4/banners/banner-1.png" alt="Banner">
                            </a>
                            <div class="banner-content">
                                <h4 class="banner-subtitle"><a href="#">Smart Offer</a></h4>
                                <h3 class="banner-title"><a href="#">Save ₦150 <strong>on Samsung <br>Galaxy Note9</strong></a></h3>
                                <a href="category.php?category=all" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="banner banner-overlay banner-overlay-light">
                            <a href="#">
                                <img src="assets/images/demos/demo-4/banners/banner-2.jpg" alt="Banner">
                            </a>
                            <div class="banner-content">
                                <h4 class="banner-subtitle"><a href="#">Time Deals</a></h4>
                                <h3 class="banner-title"><a href="#"><strong>Bose SoundSport</strong> <br>Time Deal -30%</a></h3>
                                <a href="category.php?category=all" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="banner banner-overlay banner-overlay-light">
                            <a href="#">
                                <img src="assets/images/demos/demo-4/banners/banner-3.png" alt="Banner">
                            </a>
                            <div class="banner-content">
                                <h4 class="banner-subtitle"><a href="#">Clearance</a></h4>
                                <h3 class="banner-title"><a href="#"><strong>GoPro - Fusion 360</strong> <br>Save ₦70</a></h3>
                                <a href="category.php?category=all" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container new-arrivals">
                <div class="heading heading-flex mb-3">
                    <div class="heading-left">
                        <h2 class="title">New Arrivals</h2>
                    </div>
                    <div class="heading-right">
                        <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="new-all-link" data-toggle="tab" href="#new-all-tab" role="tab" aria-controls="new-all-tab" aria-selected="true">All</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content tab-content-carousel just-action-icons-sm">
                    <div class="tab-pane p-0 fade show active" id="new-all-tab" role="tabpanel" aria-labelledby="new-all-link">
                        <div class="owl-carousel owl-theme owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": true, 
                                "dots": true,
                                "margin": 5,
                                "loop": false,
                                "responsive": {
                                    "0": {"items": 2},
                                    "400": {"items": 2},
                                    "576": {"items": 3},
                                    "768": {"items": 4},
                                    "992": {"items": 5},
                                    "1200": {"items": 6}
                                }
                            }'>
                            <?php
                            $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/noimage.jpg';
                            $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 15");
                            $stmt->execute();
                            $products = $stmt->fetchAll();
                            $productGroups = array_chunk($products, 5);
                            foreach ($productGroups as $group) {
                                echo '<div class="products-slide d-flex">';
                                foreach ($group as $product) {
                                    $image_url = !empty($product['photo']) 
                                        ? htmlspecialchars($product['photo']) 
                                        : $default_image;
                                    echo '<div class="product" style="width: 20%; flex: 0 0 20%; padding: 0 10px;">
                                        <figure class="product-media">
                                            <a href="product.php?product='.htmlspecialchars($product['slug']).'">
                                                <img src="'.$image_url.'" alt="'.htmlspecialchars($product['name']).'" class="product-image">
                                            </a>
                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                            </div>
                                            <div class="product-action">
                                                <a href="#" class="btn-product btn-cart" title="Add to cart">Add to Cart</a>
                                            </div>
                                        </figure>
                                        <div class="product-body">
                                            <h3 class="product-title"><a href="product.php?product='.htmlspecialchars($product['slug']).'">'.htmlspecialchars($product['name']).'</a></h3>
                                            <div class="product-price">₦'.number_format($product['price'], 2).'</div>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 100%;"></div>
                                                </div>
                                                <span class="ratings-text">( 5 Reviews )</span>
                                            </div>
                                        </div>
                                    </div>';
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-6"></div>
            <div class="container">
                <div class="cta cta-border mb-5" style="background-image: url(assets/images/demos/demo-4/bg-1.jpg);">
                    <img src="assets/images/demos/demo-4/camera.png" alt="camera" class="cta-img">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="cta-content">
                                <div class="cta-text text-right text-white">
                                    <p>Shop Today's Deals <br><strong>Awesome Made Easy. HERO7 Black</strong></p>
                                </div>
                                <a href="category.php?category=all" class="btn btn-primary btn-round"><span>Shop Now - ₦429.99</span><i class="icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="more-container text-center mt-1 mb-5">
                <a href="category.php?category=all" class="btn btn-outline-dark-2 btn-round btn-more"><span>Shop more Outlet deals</span><i class="icon-long-arrow-right"></i></a>
            </div>
            <div class="bg-light pt-5 pb-6">
                <div class="container trending-products">
                    <div class="heading heading-flex mb-3">
                        <div class="heading-left">
                            <h2 class="title">Trending Products</h2>
                        </div>
                        <div class="heading-right">
                            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="trending-top-link" data-toggle="tab" href="#trending-top-tab" role="tab" aria-controls="trending-top-tab" aria-selected="true">Top Rated</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="trending-best-link" data-toggle="tab" href="#trending-best-tab" role="tab" aria-controls="trending-best-tab" aria-selected="false">Best Selling</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="trending-sale-link" data-toggle="tab" href="#trending-sale-tab" role="tab" aria-controls="trending-sale-tab" aria-selected="false">On Sale</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-5col d-none d-xl-block">
                            <div class="banner banner-overlay banner-overlay-light">
                                <a href="category.php">
                                    <img src="images/Banner.jpg" alt="Banner">
                                </a>
                                <div class="banner-content">
                                    <h3 class="banner-title text-white"><a href="category.php">New Collection</a></h3>
                                    <h4 class="banner-subtitle text-white">Up to 30% Off</h4>
                                    <a href="category.php?category=all" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4-5col">
                            <div class="tab-content tab-content-carousel just-action-icons-sm">
                                <div class="tab-pane p-0 fade show active" id="trending-top-tab" role="tabpanel" aria-labelledby="trending-top-link">
                                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                                        data-owl-options='{
                                            "nav": true, 
                                            "dots": true,
                                            "margin": 5,
                                            "loop": false,
                                            "responsive": {
                                                "0": {"items": 2},
                                                "400": {"items": 2},
                                                "576": {"items": 3},
                                                "768": {"items": 4},
                                                "992": {"items": 5},
                                                "1200": {"items": 6}
                                            }
                                        }'>
                                        <?php
                                        $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/noimage.jpg';
                                        $stmt = $conn->prepare("SELECT * FROM products ORDER BY counter DESC LIMIT 8");
                                        $stmt->execute();
                                        $trending = $stmt->fetchAll();
                                        foreach ($trending as $product) {
                                            $image_url = !empty($product['photo']) 
                                                ? htmlspecialchars($product['photo']) 
                                                : $default_image;
                                            echo '<div class="product">
                                                <figure class="product-media">
                                                    <a href="product.php?product='.htmlspecialchars($product['slug']).'">
                                                        <img src="'.$image_url.'" alt="'.htmlspecialchars($product['name']).'" class="product-image">
                                                    </a>
                                                </figure>
                                                <div class="product-body">
                                                    <h3 class="product-title"><a href="product.php?product='.htmlspecialchars($product['slug']).'">'.htmlspecialchars($product['name']).'</a></h3>
                                                    <div class="product-price">₦'.number_format($product['price'], 2).'</div>
                                                    <div class="ratings-container">
                                                        <div class="ratings">
                                                            <div class="ratings-val" style="width: '.rand(80,100).'%;"></div>
                                                        </div>
                                                        <span class="ratings-text">( '.rand(5,50).' Reviews )</span>
                                                    </div>
                                                </div>
                                            </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane p-0 fade" id="trending-best-tab" role="tabpanel" aria-labelledby="trending-best-link">
                                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                                        data-owl-options='{
                                            "nav": true, 
                                            "dots": true,
                                            "margin": 5,
                                            "loop": false,
                                            "responsive": {
                                                "0": {"items": 2},
                                                "400": {"items": 2},
                                                "576": {"items": 3},
                                                "768": {"items": 4},
                                                "992": {"items": 5},
                                                "1200": {"items": 6}
                                            }
                                        }'>
                                        <?php
                                        $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/noimage.jpg';
                                        $stmt = $conn->prepare("SELECT p.* FROM products p JOIN details d ON p.id = d.product_id GROUP BY p.id ORDER BY SUM(d.quantity) DESC LIMIT 8");
                                        $stmt->execute();
                                        $bestSelling = $stmt->fetchAll();
                                        foreach ($bestSelling as $product) {
                                            $image_url = !empty($product['photo']) 
                                                ? htmlspecialchars($product['photo']) 
                                                : $default_image;
                                            echo '<div class="product">
                                                <figure class="product-media">
                                                    <a href="product.php?product='.htmlspecialchars($product['slug']).'">
                                                        <img src="'.$image_url.'" alt="'.htmlspecialchars($product['name']).'" class="product-image">
                                                    </a>
                                                </figure>
                                                <div class="product-body">
                                                    <h3 class="product-title"><a href="product.php?product='.htmlspecialchars($product['slug']).'">'.htmlspecialchars($product['name']).'</a></h3>
                                                    <div class="product-price">₦'.number_format($product['price'], 2).'</div>
                                                    <div class="ratings-container">
                                                        <div class="ratings">
                                                            <div class="ratings-val" style="width: '.rand(80,100).'%;"></div>
                                                        </div>
                                                        <span class="ratings-text">( '.rand(5,50).' Reviews )</span>
                                                    </div>
                                                </div>
                                            </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container for-you">
                    <div class="heading heading-flex mb-3">
                        <div class="heading-left">
                            <h2 class="title">Recommendation For You</h2>
                        </div>
                        <div class="heading-right">
                            <a href="category.php" class="title-link">View All Recommendation <i class="icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="products">
                        <div class="row justify-content-center">
                            <?php
                            $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/noimage.jpg';
                            $stmt = $conn->prepare("SELECT * FROM products ORDER BY RAND() LIMIT 6");
                            $stmt->execute();
                            $recommended = $stmt->fetchAll();
                            foreach ($recommended as $product) {
                                $image_url = !empty($product['photo']) 
                                    ? htmlspecialchars($product['photo']) 
                                    : $default_image;
                                echo '<div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="product.php?product='.htmlspecialchars($product['slug']).'">
                                                <img src="'.$image_url.'" alt="'.htmlspecialchars($product['name']).'" class="product-image">
                                            </a>
                                        </figure>
                                        <div class="product-body">
                                            <h3 class="product-title"><a href="product.php?product='.htmlspecialchars($product['slug']).'">'.htmlspecialchars($product['name']).'</a></h3>
                                            <div class="product-price">₦'.number_format($product['price'], 2).'</div>
                                        </div>
                                    </div>
                                </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <div class="row no-gutters bg-white newsletter-popup-content">
                                <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                                    <div class="banner-content text-center">
                                        <img src="images/logoo.jpg" class="logo" alt="logo" width="60" height="15">
                                        <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                                        <p>Subscribe to Bailord newsletter to receive timely updates from your favorite products.</p>
                                        <form action="#">
                                            <div class="input-group input-group-round">
                                                <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                                <div class="input-group-append">
                                                    <button class="btn" type="submit"><span>go</span></button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="custom-control custom-checkbox" style="text-align: left;">
                                            <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                            <label class="custom-control-label" for="register-policy-2">Do not show this again</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2-5col col-lg-5">
                                    <img src="images/img-1.jpg" class="newsletter-img" alt="newsletter">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="assets/js/jquery.min.js"></script>
                <script src="assets/js/bootstrap.bundle.min.js"></script>
                <script src="assets/js/jquery.hoverIntent.min.js"></script>
                <script src="assets/js/jquery.waypoints.min.js"></script>
                <script src="assets/js/superfish.min.js"></script>
                <script src="assets/js/owl.carousel.min.js"></script>
                <script src="assets/js/bootstrap-input-spinner.js"></script>
                <script src="assets/js/jquery.plugin.min.js"></script>
                <script src="assets/js/jquery.magnific-popup.min.js"></script>
                <script src="assets/js/jquery.countdown.min.js"></script>
                <script src="assets/js/main.js"></script>
                <script src="assets/js/demos/demo-4.js"></script>
        </main>
    </div>
</body>
</html>
