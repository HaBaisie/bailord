<?php 
include 'includes/session.php'; 
require_once 'includes/database.php'; // Ensure Database class is included

// Fallback function if renderCategoryBlocks is undefined
if (!function_exists('renderCategoryBlocks')) {
    function renderCategoryBlocks($conn) {
        try {
            $stmt = $conn->prepare("SELECT * FROM category LIMIT 6");
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $output = '';
            foreach ($categories as $category) {
                $slug = !empty($category['cat_slug']) ? $category['cat_slug'] : strtolower(str_replace(' ', '-', $category['name']));
                $output .= '<div class="col-6 col-md-4 col-lg-2">';
                $output .= '<a href="category.php?category=' . htmlspecialchars($slug) . '" class="cat-block">';
                $output .= '<figure>';
                $output .= '<span>';
                $output .= '<img src="assets/images/demos/demo-4/cats/' . htmlspecialchars($category['name']) . '.jpg" alt="' . htmlspecialchars($category['name']) . '">';
                $output .= '</span>';
                $output .= '</figure>';
                $output .= '<h3 class="cat-block-title">' . htmlspecialchars($category['name']) . '</h3>';
                $output .= '</a>';
                $output .= '</div>';
            }
            return $output;
        } catch (PDOException $e) {
            return '<div class="col-12"><p>Error loading categories: ' . htmlspecialchars($e->getMessage()) . '</p></div>';
        }
    }
}
?>
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

            .intro-slider-container {
                height: 150px;
                padding: 0 10px;
            }

            .intro-slide {
                background-size: cover;
                background-position: center;
                height: 150px;
                border-radius: 8px;
                margin: 0 5px;
            }

            .intro-content {
                padding: 8px;
            }

            .intro-title {
                font-size: 14px;
                line-height: 1.2;
            }

            .intro-subtitle {
                font-size: 10px;
            }

            .intro-price {
                font-size: 12px;
            }

            .intro-price sup {
                font-size: 8px;
            }

            .btn-round {
                padding: 5px 10px;
                font-size: 10px;
            }

            .product {
                margin-bottom: 10px;
            }

            .product-media img {
                width: 100%;
                height: 120px;
                object-fit: cover;
            }

            .product-title {
                font-size: 12px;
                line-height: 1.3;
            }

            .product-price {
                font-size: 13px;
            }

            .ratings-container {
                font-size: 10px;
            }

            .ratings-text {
                font-size: 10px;
            }

            .mobile-menu-container {
                position: fixed;
                top: 0;
                left: 0;
                width: 85%;
                height: 100%;
                background-color: var(--light-neutral);
                z-index: 1000;
                overflow-y: auto;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }

            .mobile-menu-container.visible {
                opacity: 1;
                visibility: visible;
            }

            .mobile-menu-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }

            .mobile-menu-backdrop.visible {
                opacity: 1;
                visibility: visible;
            }

            .btn {
                padding: 8px 15px;
                font-size: 14px;
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
                margin-bottom: 20px;
            }

            .header-right.d-none.d-lg-block,
            .heading-right {
                display: none !important;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .intro-slider-container {
                height: 250px;
            }

            .intro-slide {
                height: 250px;
            }

            .intro-title {
                font-size: 20px;
            }

            .intro-subtitle {
                font-size: 12px;
            }

            .product {
                margin-bottom: 15px;
            }

            .product-media img {
                height: 150px;
            }

            .cat-block-title {
                font-size: 14px;
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

        /* Ensure slider visibility */
        .intro-slider-container {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Debug: Log to check if script runs
            console.log('DOM fully loaded');

            // Mobile menu toggle
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggler');
            const mobileMenuContainer = document.querySelector('.mobile-menu-container');
            const mobileMenuClose = document.querySelector('.mobile-menu-close');
            const mobileMenuBackdrop = document.createElement('div');
            mobileMenuBackdrop.classList.add('mobile-menu-backdrop');
            document.body.appendChild(mobileMenuBackdrop);

            if (mobileMenuToggle && mobileMenuContainer) {
                mobileMenuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileMenuContainer.classList.add('visible');
                    mobileMenuBackdrop.classList.add('visible');
                    document.body.style.overflow = 'hidden';
                });
            }

            if (mobileMenuClose && mobileMenuContainer) {
                mobileMenuClose.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileMenuContainer.classList.remove('visible');
                    mobileMenuBackdrop.classList.remove('visible');
                    document.body.style.overflow = '';
                });
            }

            if (mobileMenuBackdrop) {
                mobileMenuBackdrop.addEventListener('click', function() {
                    mobileMenuContainer.classList.remove('visible');
                    mobileMenuBackdrop.classList.remove('visible');
                    document.body.style.overflow = '';
                });
            }

            // Mobile search toggle
            const mobileSearchToggle = document.querySelector('.mobile-search-toggle');
            const mobileSearchForm = document.querySelector('.mobile-search');

            if (mobileSearchToggle && mobileSearchForm) {
                mobileSearchToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileSearchForm.classList.toggle('visible');
                });
            }

            // Mobile submenu toggle
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

            // Category dropdown on mobile
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

            // Desktop dropdowns
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

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (window.innerWidth < 992) {
                    if (!e.target.matches('.dropdown-toggle') && !e.target.closest('.dropdown-menu')) {
                        document.querySelectorAll('.dropdown-menu').forEach(menu => {
                            menu.style.display = 'none';
                        });
                    }
                }
            });

            // Prevent zooming on double-tap
            let lastTouchEnd = 0;
            document.addEventListener('touchend', function(event) {
                const now = (new Date()).getTime();
                if (now - lastTouchEnd <= 300) {
                    event.preventDefault();
                }
                lastTouchEnd = now;
            }, false);

            // Debug: Check if Owl Carousel is loaded
            if (typeof $.fn.owlCarousel === 'undefined') {
                console.error('Owl Carousel plugin is not loaded');
            } else {
                console.log('Owl Carousel initialized');
                // Force re-initialize slider
                $('.intro-slider').owlCarousel('destroy').owlCarousel({
                    dots: true,
                    nav: false,
                    center: true,
                    items: 1,
                    margin: 10,
                    responsive: {
                        0: { stagePadding: 30, items: 1 },
                        768: { stagePadding: 50, items: 1 },
                        1200: { nav: true, dots: false, stagePadding: 0, items: 1 }
                    }
                });
            }
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
                                    try {
                                        $stmt = $conn->prepare("SELECT * FROM category");
                                        $stmt->execute();
                                        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($categories as $category) {
                                            $slug = !empty($category['cat_slug']) ? $category['cat_slug'] : strtolower(str_replace(' ', '-', $category['name']));
                                            echo '<li><a href="category.php?category=' . htmlspecialchars($slug) . '">' . htmlspecialchars($category['name']) . '</a></li>';
                                        }
                                    } catch(PDOException $e) {
                                        echo "<li><a href='#'>Error loading categories: " . htmlspecialchars($e->getMessage()) . "</a></li>";
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
                                        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($categories as $category) {
                                            $slug = !empty($category['cat_slug']) ? $category['cat_slug'] : strtolower(str_replace(' ', '-', $category['name']));
                                            echo '<li><a href="category.php?category=' . htmlspecialchars($slug) . '">' . htmlspecialchars($category['name']) . '</a></li>';
                                        }
                                    } catch(PDOException $e) {
                                        echo "<li><a href='#'>Error loading categories: " . htmlspecialchars($e->getMessage()) . "</a></li>";
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
                            "0": {"stagePadding": 30, "items": 1},
                            "768": {"stagePadding": 50, "items": 1},
                            "1200": {"nav": true, "dots": false, "stagePadding": 0, "items": 1}
                        }
                    }'>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/ITEL_P70.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-primary">New Arrival</h3>
                                    <h1 class="intro-title">ITEL P70</h1>
                                    <div class="intro-price">
                                        <sup>Today:</sup>
                                        <span class="text-primary">₦999<sup>.99</sup></span>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/TECNO_POP_10C.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-primary">New Arrival</h3>
                                    <h1 class="intro-title">TECNO POP</h1>
                                    <h1 class="intro-title">10C</h1>
                                    <div class="intro-price">
                                        <sup>Today:</sup>
                                        <span class="text-primary">₦999<sup>.99</sup></span>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/TECNO_POP_10.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-primary">New Arrival</h3>
                                    <h1 class="intro-title">TECNO POP</h1>
                                    <h1 class="intro-title">10</h1>
                                    <div class="intro-price">
                                        <sup>Today:</sup>
                                        <span class="text-primary">₦999<sup>.99</sup></span>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/VIVO_Y04.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-primary">New Arrival</h3>
                                    <h1 class="intro-title">VIVO</h1>
                                    <h1 class="intro-title">YO4</h1>
                                    <div class="intro-price">
                                        <sup>Today:</sup>
                                        <span class="text-primary">₦999<sup>.99</sup></span>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/ZTE_BLADE_A35.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-primary">New Arrival</h3>
                                    <h1 class="intro-title">ZTE BLADE</h1>
                                    <h1 class="intro-title">A35</h1>
                                    <div class="intro-price">
                                        <sup>Today:</sup>
                                        <span class="text-primary">₦999<sup>.99</sup></span>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/ZTE_BLADE_A55.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-primary">New Arrival</h3>
                                    <h1 class="intro-title">ZTE BLADE</h1>
                                    <h1 class="intro-title">A55</h1>
                                    <div class="intro-price">
                                        <sup>Today:</sup>
                                        <span class="text-primary">₦999<sup>.99</sup></span>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/ITEL_CITY_100.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-primary">New Arrival</h3>
                                    <h1 class="intro-title">ITEL CITY</h1>
                                    <h1 class="intro-title">100</h1>
                                    <div class="intro-price">
                                        <sup>Today:</sup>
                                        <span class="text-primary">₦999<sup>.99</sup>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/REALME_C75.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-primary">New Arrival</h3>
                                    <h1 class="intro-title">REALME</h1>
                                    <h1 class="intro-title">C75</h1>
                                    <div class="intro-price">
                                        <sup>Today:</sup>
                                        <span class="text-primary">₦999<sup>.99</sup>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/REDMI_A5.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-primary">New Arrival</h3>
                                    <h1 class="intro-title">REDMI</h1>
                                    <h1 class="intro-title">A5</h1>
                                    <div class="intro-price">
                                        <sup>Today:</sup>
                                        <span class="text-primary">₦999<sup>.99</sup>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/REALME_NOTE50.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-primary">New Arrival</h3>
                                    <h1 class="intro-title">REALME</h1>
                                    <h1 class="intro-title">NOTE50</h1>
                                    <div class="intro-price">
                                        <sup>Today:</sup>
                                        <span class="text-primary">₦999<sup>.99</sup>
                                    </span>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/OPPO.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-third">Deals and Promotions</h3>
                                    <h1 class="intro-title">OPPO</h1>
                                    <h1 class="intro-title">A3</h1>
                                    <div class="intro-price">
                                        <sup class="intro-old-price">₦349,95</sup>
                                        <span class="text-third">
                                            ₦279<sup>.99</sup>
                                        </span>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            </div>
                    </div>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/INFINIX_SMART_10.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-third">Deals and Promotions</h3>
                                    <h1 class="intro-title">INFINIX</h1>
                                    <h1 class="intro-title">SMART 10</h1>
                                    <div class="intro-price">
                                        <sup class="intro-old-price">₦349,95</sup>
                                        <span class="text-third">
                                            ₦279<sup>.99</sup>
                                        </span>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="slider-loader"></span>
            </div>

            <div class="container">
                <h2 class="title text-center mb-4">Explore Popular Categories</h2>
                <div class="cat-blocks-container">
                    <div class="row">
                        <?php echo htmlspecialchars($conn->renderCategoryBlocks()); ?>
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
                                <img src="assets/images/demos/demo-4/banners/banner-1.jpg" alt="Banner">
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
                                <img src="assets/images/demos/demo-4/banners/banner-3.jpg" alt="Banner">
                            </a>
                            <div class="banner-content">
                                <h4 class="banner-subtitle"><a href="#">Clearance</a></h4>
                                <h3 class="banner-title"><a href="#">GoPro - Fusion 360</strong> <br>Save ₦70</a></h3>
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
                        <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": true,
                                "dots": true,
                                "margin": 2,
                                "loop": false,
                                "responsive": {
                                    "0": {"items": 2},
                                    "400": {"items": 3},
                                    "576": {"items": 4},
                                    "768": {"items": 5},
                                    "992": {"items": 6},
                                    "1200": {"items": 6}
                                }
                            }'>
                            <?php
                            $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/noimage.jpg';
                            try {
                                $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 15");
                                $stmt->execute();
                                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                if (empty($products)) {
                                    echo '<p>No products available.</p>';
                                } else {
                                    foreach ($products as $product) {
                                        $image_url = !empty($product['photo']) ? htmlspecialchars($product['photo']) : $default_image;
                                        echo '<div class="product">';
                                        echo '<figure class="product-media">';
                                        echo '<a href="product.php?product=' . htmlspecialchars($product['slug']) . '">';
                                        echo '<img src="' . $image_url . '" alt="' . htmlspecialchars($product['name']) . '" class="product-image">';
                                        echo '</a>';
                                        echo '<div class="product-action-vertical">';
                                        echo '<a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>';
                                        echo '</div>';
                                        echo '<div class="product-action">';
                                        echo '<a href="#" class="btn-product btn-cart" title="Add to cart">Add to Cart</a>';
                                        echo '</div>';
                                        echo '</figure>';
                                        echo '<div class="product-body">';
                                        echo '<h3 class="product-title"><a href="product.php?product=' . htmlspecialchars($product['slug']) . '">' . htmlspecialchars($product['name']) . '</a></h3>';
                                        echo '<div class="product-price">₦' . number_format($product['price'], 2) . '</div>';
                                        echo '<div class="ratings-container">';
                                        echo '<div class="ratings"><div class="ratings-val" style="width: 100%;"></div></div>';
                                        echo '<span class="ratings-text">( 5 Reviews )</span>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }
                            } catch (PDOException $e) {
                                echo '<p>Error loading products: ' . htmlspecialchars($e->getMessage()) . '</p>';
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
                                <a href="category.php?category=all">
                                    <img src="assets/images/banner.jpg" alt="Banner">
                                </a>
                                <div class="banner-content">
                                    <h3 class="banner-title text-white"><a href="#">New Collection</a></h3>
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
                                            "margin": 2,
                                            "loop": false,
                                            "responsive": {
                                                "0": {"items": 2},
                                                "400": {"items": 3},
                                                "576": {"items": 4},
                                                "768": {"items": 5},
                                                "992": {"items": 6},
                                                "1200": {"items": 6}
                                            }
                                        }'>
                                        <?php
                                        try {
                                            $stmt = $conn->prepare("SELECT * FROM products ORDER BY counter DESC LIMIT 8");
                                            $stmt->execute();
                                            $trending = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if (empty($trending)) {
                                                echo '<p>No trending products available.</p>';
                                            } else {
                                                foreach ($trending as $product) {
                                                    $image_url = !empty($product['photo']) ? htmlspecialchars($product['photo']) : $default_image;
                                                    echo '<div class="product">';
                                                    echo '<figure class="product-media">';
                                                    echo '<a href="product.php?product=' . htmlspecialchars($product['slug']) . '">';
                                                    echo '<img src="' . $image_url . '" alt="' . htmlspecialchars($product['name']) . '" class="product-image">';
                                                    echo '</a>';
                                                    echo '</figure>';
                                                    echo '<div class="product-body">';
                                                    echo '<h3 class="product-title"><a href="product.php?product=' . htmlspecialchars($product['slug']) . '">' . htmlspecialchars($product['name']) . '</a></h3>';
                                                    echo '<div class="product-price">₦' . number_format($product['price'], 2) . '</div>';
                                                    echo '<div class="ratings-container">';
                                                    echo '<div class="ratings"><div class="ratings-val" style="width: ' . rand(80, 100) . '%;"></div></div>';
                                                    echo '<span class="ratings-text">( ' . rand(5, 50) . ' Reviews )</span>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                            }
                                        } catch (PDOException $e) {
                                            echo '<p>Error loading trending products: ' . htmlspecialchars($e->getMessage()) . '</p>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane p-0 fade" id="trending-best-tab" role="tabpanel" aria-labelledby="trending-best-link">
                                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                                        data-owl-options='{
                                            "nav": true,
                                            "dots": true,
                                            "margin": 2,
                                            "loop": false,
                                            "responsive": {
                                                "0": {"items": 2},
                                                "400": {"items": 3},
                                                "576": {"items": 4},
                                                "768": {"items": 5},
                                                "992": {"items": 6},
                                                "1200": {"items": 6}
                                            }
                                        }'>
                                        <?php
                                        try {
                                            $stmt = $conn->prepare("SELECT p.* FROM products p JOIN details d ON p.id = d.product_id GROUP BY p.id ORDER BY SUM(d.quantity) DESC LIMIT 8");
                                            $stmt->execute();
                                            $bestSelling = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if (empty($bestSelling)) {
                                                echo '<p>No best-selling products available.</p>';
                                            } else {
                                                foreach ($bestSelling as $product) {
                                                    $image_url = !empty($product['photo']) ? htmlspecialchars($product['photo']) : $default_image;
                                                    echo '<div class="product">';
                                                    echo '<figure class="product-media">';
                                                    echo '<a href="product.php?product=' . htmlspecialchars($product['slug']) . '>';
                                                    echo '<img src="' . $image_url . '" alt="' . htmlspecialchars($product['name']) . '" class="product-image">';
                                                    echo '</a>';
                                                    echo '</figure>';
                                                    echo '<div class="product-body">';
                                                    echo '<h3 class="product-title"><a href="product.php?product=' . htmlspecialchars($product['slug']) . '">' . htmlspecialchars($product['name']) . '</a></h3>';
                                                    echo '<div class="product-price">₦' . number_format($product['price'], 2) . '</div>';
                                                    echo '<div class="ratings-container">';
                                                    echo '<div class="ratings"><div class="ratings-val" style="width: ' . rand(80,100) . '%;"></div></div>';
                                                    echo '<span class="ratings-text">>( ' . rand(5,50) . ' Reviews )</span>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                            }
                                        } catch (PDOException $e) {
                                            echo '<p>Error loading best-selling products: ' . htmlspecialchars($e->getMessage()) . '</p>';
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
                            <a href="category.php" class="title-link">View All Recommendations <i class="icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="products">
                        <div class="row justify-content-center">
                            <?php
                            try {
                                $stmt = $conn->prepare("SELECT * FROM products ORDER BY RAND() LIMIT 6");
                                $stmt->execute();
                                $recommended = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                if (empty($recommended)) {
                                    echo '<p>No recommended products available.</p>';
                                } else {
                                    foreach ($recommended as $product) {
                                        $image_url = !empty($product['photo']) ? htmlspecialchars($product['photo']) : $default_image;
                                        echo '<div class="col-6 col-md-4 col-lg-2">';
                                        echo '<div class="product">';
                                        echo '<figure class="product-media">';
                                        echo '<a href="product.php?product=' . htmlspecialchars($product['slug']) . '">';
                                        echo '<img src="' . $image_url . '" alt="' . htmlspecialchars($product['name']) . '" class="product-image">';
                                        echo '</a>';
                                        echo '</figure>';
                                        echo '<div class="product-body">';
                                        echo '<h3 class="product-title"><a href="product.php?product=' . htmlspecialchars($product['slug']) . '">' . htmlspecialchars($product['name']) . '</a></h3>';
                                        echo '<div class="product-price">₦' . number_format($product['price'], 2) . '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }
                            } catch (PDOException $e) {
                                echo '<p>Error loading recommended products: ' . htmlspecialchars($e->getMessage()) . '</p>';
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
                                        <img src="assets/images/logo.png" class="logo" alt="logo" width="60" height="15">
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
                                    <img src="assets/images/img-1.jpg" class="newsletter-img" alt="newsletter">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

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
        </body>
        </html>
