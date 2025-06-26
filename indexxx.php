<?php include 'includes/session.php'; ?>
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
    <link rel="icon" type="image/png" sizes="32x16" href="assets/images/icons/favicon-32x32.png">
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
    <!-- Include FontAwesome for mobile menu dropdown indicators -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.countdown.css">
    <!-- Preload critical resources -->
    <link rel="preload" href="assets/css/bootstrap.min.css" as="style">
    <link rel="preload" href="assets/css/style.css" as="style">
    <link rel="preload" href="assets/js/jquery.min.js" as="script">
    <link rel="preload" href="assets/js/bootstrap.bundle.min.js" as="script">
    <!-- DNS prefetch for external resources -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <style>
        :root {
            --primary-color: #ff6200; /* Vibrant orange inspired by Jumia */
            --secondary-color: #1a1a1a; /* Dark for contrast */
            --accent-color: #ffffff; /* White for text/buttons */
            --highlight-color: #ffd700; /* Bright yellow for highlights */
            --neutral-light: #f5f5f5; /* Light background */
            --neutral-medium: #e0e0e0; /* Medium gray for borders */
            --text-dark: #1a1a1a; /* Dark text */
            --text-light: #ffffff; /* Light text */
            --gradient: linear-gradient(135deg, var(--primary-color) 0%, #e64a19 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--neutral-light);
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        body.menu-open {
            overflow: hidden;
            position: fixed;
            width: 100%;
        }

        .page-wrapper {
            width: 100%;
            min-height: 100vh;
            position: relative;
        }

        /* Header Styles */
        .header {
            background: var(--gradient);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-middle .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 0;
            flex-wrap: wrap;
        }

        .header-left, .header-center, .header-right {
            flex: 1;
            min-width: 0;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo img {
            width: 120px;
            height: auto;
        }

        .header-center {
            flex-grow: 2;
            padding: 0 20px;
        }

        .header-search-wrapper {
            position: relative;
            max-width: 500px;
            margin: 0 auto;
        }

        .header-search-wrapper input {
            width: 100%;
            padding: 12px 50px 12px 20px;
            border: 1px solid var(--neutral-medium);
            border-radius: 25px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
        }

        .header-search-wrapper input:focus {
            border-color: var(--primary-color);
        }

        .header-search-wrapper button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: var(--primary-color);
            font-size: 20px;
            cursor: pointer;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
            justify-content: flex-end;
        }

        .user-btn, .login-btn {
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: var(--text-light);
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .user-btn:hover, .login-btn:hover {
            background-color: #e64a19;
        }

        .cart-dropdown {
            position: relative;
        }

        .cart-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 5px;
            color: var(--text-light);
            text-decoration: none;
        }

        .cart-count {
            background: var(--highlight-color);
            color: var(--text-dark);
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 12px;
        }

        .dropdown-menu {
            background: var(--accent-color);
            border: 1px solid var(--neutral-medium);
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            min-width: 250px;
            padding: 15px;
        }

        .dropdown-cart-total {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-weight: 600;
        }

        .dropdown-cart-action .btn {
            display: block;
            text-align: center;
            padding: 10px;
            margin: 5px 0;
            border-radius: 25px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--text-light);
        }

        .btn-outline-primary {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #e64a19;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: var(--text-light);
        }

        /* Navigation */
        .main-nav .menu {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 10px 0;
        }

        .main-nav .menu > li {
            position: relative;
        }

        .main-nav .menu > li > a {
            color: var(--text-light);
            font-weight: 500;
            text-decoration: none;
            padding: 10px;
            transition: color 0.3s;
        }

        .main-nav .menu > li:hover > a {
            color: var(--highlight-color);
        }

        .main-nav .menu > li > ul {
            display: none;
            position: absolute;
            background: var(--accent-color);
            border-radius: 8px;
            padding: 10px;
            min-width: 200px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .main-nav .menu > li:hover > ul {
            display: block;
        }

        .main-nav .menu > li > ul > li > a {
            color: var(--text-dark);
            padding: 8px 15px;
            display: block;
            text-decoration: none;
        }

        .main-nav .menu > li > ul > li > a:hover {
            color: var(--primary-color);
        }

        /* Mobile Menu */
        .mobile-menu-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            display: none;
            justify-content: center;
            align-items: center;
            transition: opacity 0.3s ease-in-out;
        }

        .mobile-menu-container.visible {
            display: flex;
            opacity: 1;
        }

        .mobile-menu-wrapper {
            width: 90%;
            max-width: 320px;
            background: var(--accent-color);
            border-radius: 12px;
            padding: 20px;
            max-height: 80vh;
            overflow-y: auto;
            transform: scale(0.8);
            transition: transform 0.3s ease-in-out;
        }

        .mobile-menu-container.visible .mobile-menu-wrapper {
            transform: scale(1);
        }

        .mobile-menu-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 20px;
            color: var(--text-dark);
            cursor: pointer;
        }

        .mobile-nav .mobile-menu {
            list-style: none;
            padding: 0;
        }

        .mobile-nav .mobile-menu > li > a {
            display: block;
            padding: 15px;
            color: var(--text-dark);
            font-weight: 500;
            text-decoration: none;
        }

        .mobile-nav .mobile-menu > li > a:hover,
        .mobile-nav .mobile-menu > li.active > a {
            color: var(--primary-color);
            background: var(--neutral-light);
        }

        .mobile-nav .mobile-menu > li.has-submenu > a::after {
            content: '\f107';
            font-family: 'FontAwesome';
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        .mobile-nav .mobile-menu > li.active > a::after {
            content: '\f106';
        }

        .mobile-nav .mobile-menu > li > ul {
            display: none;
            list-style: none;
            padding: 0 0 0 20px;
        }

        .mobile-nav .mobile-menu > li.active > ul {
            display: block;
        }

        .mobile-nav .mobile-menu > li > ul > li > a {
            padding: 10px 15px;
            color: var(--text-dark);
            font-size: 14px;
        }

        /* Slider */
        .intro-slider-container {
            margin-bottom: 40px;
        }

        .intro-slider .intro-slide img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .owl-carousel .owl-nav button {
            background: var(--primary-color);
            color: var(--text-light);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 20px;
        }

        .owl-carousel .owl-nav button:hover {
            background: #e64a19;
        }

        /* Categories */
        .cat-blocks-container .col-6 {
            padding: 10px;
        }

        .cat-block {
            background: var(--accent-color);
            border-radius: 8px;
            text-align: center;
            padding: 15px;
            transition: transform 0.3s;
        }

        .cat-block:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .cat-block img {
            max-width: 100%;
            border-radius: 8px;
        }

        .cat-block-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
            margin-top: 10px;
        }

        /* Products */
        .product {
            background: var(--accent-color);
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .product-media img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-body {
            padding: 15px;
        }

        .product-title a {
            color: var(--text-dark);
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
        }

        .product-title a:hover {
            color: var(--primary-color);
        }

        .product-price {
            color: var(--primary-color);
            font-size: 18px;
            font-weight: 600;
        }

        .ratings-container {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            color: var(--text-dark);
        }

        .ratings-val {
            background: var(--highlight-color);
            height: 10px;
        }

        /* Banners */
        .banner {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
        }

        .banner img {
            width: 100%;
            height: auto;
        }

        .banner-content {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .banner-title {
            font-size: 24px;
            font-weight: 700;
        }

        .banner-subtitle {
            font-size: 16px;
            font-weight: 500;
        }

        .banner-link {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
        }

        .banner-link:hover {
            color: var(--highlight-color);
        }

        /* CTA */
        .cta {
            background-size: cover;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }

        .cta-content {
            color: var(--text-light);
        }

        .cta-text p {
            font-size: 18px;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .main-nav {
                display: none !important;
            }

            .mobile-menu-toggler {
                display: block;
                background: none;
                border: none;
                font-size: 24px;
                color: var(--text-light);
            }

            .header-search-wrapper {
                max-width: 100%;
            }

            .header-right {
                gap: 10px;
            }

            .header-center {
                display: none;
            }

            .mobile-search {
                display: block;
                margin: 10px 0;
            }

            .mobile-search input {
                width: 100%;
                padding: 10px 40px 10px 15px;
                border-radius: 25px;
            }

            .mobile-search button {
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
            }
        }

        @media (max-width: 767px) {
            .logo img {
                width: 100px;
            }

            .product-media img {
                height: 150px;
            }

            .product-title {
                font-size: 14px;
            }

            .product-price {
                font-size: 16px;
            }

            .banner-title {
                font-size: 18px;
            }

            .banner-subtitle {
                font-size: 14px;
            }
        }
    </style>
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu Toggle
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

            // Mobile Submenu Toggle
            const mobileMenuItems = document.querySelectorAll('.mobile-nav .mobile-menu > li.has-submenu > a');
            mobileMenuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parentLi = this.parentElement;
                    parentLi.classList.toggle('active');
                    document.querySelectorAll('.mobile-nav .mobile-menu > li.has-submenu').forEach(li => {
                        if (li !== parentLi) li.classList.remove('active');
                    });
                });
            });

            // Dynamic Promo Banners
            const promoContainer = document.querySelector('.row.justify-content-center[data-promo-container]');
            const promos = [
                {
                    image: 'assets/images/demos/demo-4/banners/banner-1.png',
                    subtitle: 'Smart Offer',
                    title: 'Save ₦150 on Samsung Galaxy Note9',
                    link: 'category.php?category=all'
                },
                {
                    image: 'assets/images/demos/demo-4/banners/banner-2.jpg',
                    subtitle: 'Time Deals',
                    title: 'Bose SoundSport - 30% Off',
                    link: 'category.php?category=all'
                },
                {
                    image: 'assets/images/demos/demo-4/banners/banner-3.png',
                    subtitle: 'Clearance',
                    title: 'GoPro Fusion 360 - Save ₦70',
                    link: 'category.php?category=all'
                }
            ];

            if (promoContainer) {
                promoContainer.innerHTML = promos.map(promo => `
                    <div class="col-md-6 col-lg-4">
                        <div class="banner banner-overlay banner-overlay-light">
                            <a href="${promo.link}">
                                <img src="${promo.image}" alt="Banner">
                            </a>
                            <div class="banner-content">
                                <h4 class="banner-subtitle"><a href="${promo.link}">${promo.subtitle}</a></h4>
                                <h3 class="banner-title"><a href="${promo.link}">${promo.title}</a></h3>
                                <a href="${promo.link}" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                `).join('');
            }

            // Cart Update
            const cartCount = document.querySelector('.cart-count');
            const cartTotalPrice = document.querySelector('.cart-total-price');
            const cartProducts = document.querySelector('.dropdown-cart-products');
            let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];

            function updateCart() {
                cartCount.textContent = cartItems.length;
                const total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);
                cartTotalPrice.textContent = `₦${total.toFixed(2)}`;
                cartProducts.innerHTML = cartItems.map(item => `
                    <div class="product">
                        <div class="product-cart-details">
                            <h4 class="product-title"><a href="product.php?product=${item.slug}">${item.name}</a></h4>
                            <span class="cart-product-info">
                                <span class="cart-product-qty">${item.quantity}</span> x ₦${item.price.toFixed(2)}
                            </span>
                        </div>
                    </div>
                `).join('');
            }

            document.querySelectorAll('.btn-cart').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const product = this.closest('.product');
                    const name = product.querySelector('.product-title a').textContent;
                    const price = parseFloat(product.querySelector('.product-price').textContent.replace('₦', ''));
                    const slug = product.querySelector('.product-title a').getAttribute('href').split('=')[1];
                    cartItems.push({ name, price, slug, quantity: 1 });
                    localStorage.setItem('cartItems', JSON.stringify(cartItems));
                    updateCart();
                });
            });

            updateCart();

            // Prevent Double Tap on Touch Devices
            let lastTouchEnd = 0;
            document.addEventListener('touchend', function(event) {
                const now = new Date().getTime();
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
                    <button class="mobile-menu-close"><i class="icon-close"></i></button>
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
                            <li class="has-submenu">
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
                            <li class="has-submenu">
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
                        <img src="assets/images/demos/demo-4/slider/slider2.png" alt="TECNO POP 10C">
                    </div>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/slider3.png" alt="TECNO POP 10">
                    </div>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/slider4.png" alt="VIVO Y04">
                    </div>
                    <div class="intro-slide">
                        <img src="assets/images/demos/demo-4/slider/slider5.png" alt="ZTE BLADE A35">
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
                                    <a class="nav-link" id="trending-best-link" data-toggle="tab" href="#trending-best-tab" role="tab">Best Selling</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="trending-sale-link" data-toggle="tab" href="#trending-sale-tab" role="tab">On Sale</a>
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
                                        <img src="images/logoh.png" class="logo" alt="logo" width="60" height="15">
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
</html>"
