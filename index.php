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

    <!-- Preload critical resources -->
    <link rel="preload" href="assets/css/bootstrap.min.css" as="style">
    <link rel="preload" href="assets/css/style.css" as="style">
    <link rel="preload" href="assets/js/jquery.min.js" as="script">
    <link rel="preload" href="assets/js/bootstrap.bundle.min.js" as="script">

    <!-- DNS prefetch for external resources -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <style>
        :root {
        /* Color Palette */
        --dominant-color: #2a5bd7;       /* Primary blue (60%) */
        --secondary-color: #28a745;      /* Green (30%) */
        --accent-color: #fd7e14;         /* Orange (10%) */
        
        /* Complementary shades */
        --complementary-blue: #1e429f;   /* Darker blue */
        --complementary-orange: #e67700; /* Darker orange */
        
        /* Neutrals */
        --light-neutral: #f8f9fa;
        --medium-neutral: #e9ecef;
        --dark-neutral: #495057;
        
        /* Text colors */
        --text-dark: #212529;
        --text-light: #f8f9fa;
        
        /* Gradients */
        --blue-gradient: linear-gradient(135deg, var(--dominant-color) 0%, var(--complementary-blue) 100%);
        --green-gradient: linear-gradient(135deg, var(--secondary-color) 0%, #1e7e34 100%);
        }

        /* Base Styles */
        body {
            background-color: var(--light-neutral);
            color: var(--text-dark);
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        /* Header */
        .header {
            background: var(--blue-gradient);
            color: var(--text-light);
        }

        .header-top {
            background-color: var(--complementary-blue);
        }

        /* Navigation */
        .main-nav .menu > li > a {
            color: var(--text-light);
        }

        .main-nav .menu > li:hover > a {
            color: var(--accent-color);
        }

        /* Buttons */ 
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

        /* Accent Elements */
        .highlight, .intro-subtitle.text-third, .intro-price .text-third {
            color: var(--accent-color);
        }
        /* Mobile-specific styles */
        @media (max-width: 767px) {
            /* Header adjustments */
            .header-top {
                padding: 5px 0;
            }
            
            .header-contact, .top-menu li a {
                font-size: 12px;
                padding: 5px;
            }
            
            /* Logo size reduction */
            .logo img {
                width: 80px;
                height: auto;
            }
            
            /* Category blocks */
            .cat-blocks-container .col-6 {
                padding: 5px;
            }
            
            .cat-block-title {
                font-size: 12px;
            }
            
            /* Slider text adjustments */
            .intro-content {
                padding: 15px;
            }
            
            .intro-title {
                font-size: 24px;
                line-height: 1.2;
            }
            
            .intro-subtitle {
                font-size: 14px;
            }
            
            /* Product grid adjustments */
            .product {
                margin-bottom: 15px;
            }
            
            .product-title {
                font-size: 14px;
            }
            
            .product-price {
                font-size: 15px;
            }
            
            /* Navigation menu adjustments */
            .mobile-menu-container {
                width: 85%;
                display: none; /* Hidden by default */
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                background-color: var(--light-neutral);
                z-index: 1000;
                overflow-y: auto;
                }
            /* Button sizes */
            .mobile-menu-container.visible {
            display: block; /* Show when visible */
            }
            .btn {
                padding: 8px 15px;
                font-size: 14px;
            }
            
            /* Deal sections */
            .deal {
                min-height: 250px;
            }
            
            .deal-content {
                padding: 15px;
            }
            
            .deal h2 {
                font-size: 18px;
            }
            
            .deal h3 {
                font-size: 16px;
            }
            
            /* Footer adjustments */
            .footer .col-sm-6 {
                margin-bottom: 20px;
            }
            
            /* Hide some elements on mobile */
            .header-right.d-none.d-lg-block,
            .heading-right {
                display: none !important;
            }
        }

        /* Tablet adjustments */
        @media (min-width: 768px) and (max-width: 991px) {
            .intro-title {
                font-size: 36px;
            }
            
            .product {
                margin-bottom: 20px;
            }
            
            .cat-block-title {
                font-size: 14px;
            }
        }
        /* Touch targets */
        .btn, .dropdown-toggle, .mobile-menu-toggler, 
        .mobile-search-toggle, .product-media a {
            min-height: 44px; /* Recommended minimum touch target size */
            min-width: 44px;
            position: relative;
        }

        /* Increase tap area for small elements */
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

        /* Prevent text selection on tap */
        a, button {
            -webkit-tap-highlight-color: transparent;
            -webkit-touch-callout: none;
            user-select: none;
        }
        
        /* New styles for header layout */
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
        /* Add to your existing <style> block */
        .mobile-menu li {
            position: relative;
        }

        .mobile-menu li ul {
            display: none; /* Hide sub-menus by default */
            position: static; /* Stack sub-menus naturally */
            width: 100%;
            padding-left: 20px; /* Indent sub-menu items */
            background-color: var(--medium-neutral); /* Optional: distinguish sub-menu */
        }

        .mobile-menu li.active > ul {
            display: block; /* Show sub-menu when parent has active class */
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggler');
            const mobileMenuContainer = document.querySelector('.mobile-menu-container');
            const mobileMenuClose = document.querySelector('.mobile-menu-close');
            
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileMenuContainer.classList.add('visible');
                });
            }
            
            if (mobileMenuClose) {
                mobileMenuClose.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileMenuContainer.classList.remove('visible');
                });
            }
            
            // Mobile search toggle
            const mobileSearchToggle = document.querySelector('.mobile-search-toggle');
            const mobileSearchForm = document.querySelector('.mobile-search-form');
            
            if (mobileSearchToggle && mobileSearchForm) {
                mobileSearchToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileSearchForm.classList.toggle('visible');
                });
            }
            
            // Close mobile menu when clicking outside
            mobileMenuContainer.addEventListener('click', function(e) {
                if (e.target === mobileMenuContainer) {
                    mobileMenuContainer.classList.remove('visible');
                }
            });
            
            // Make mobile submenus work
            // Replace the existing mobileMenuItems handler
            const mobileMenuItems = document.querySelectorAll('.mobile-nav .mobile-menu > li > a');
            mobileMenuItems.forEach(item => {
                if (item.nextElementSibling && item.nextElementSibling.tagName === 'UL') {
                    item.addEventListener('click', function(e) {
                        e.preventDefault();
                        const parentLi = this.parentElement;
                        const subMenu = this.nextElementSibling;

                        // Toggle active class
                        parentLi.classList.toggle('active');

                        // Toggle sub-menu visibility
                        subMenu.style.display = subMenu.style.display === 'block' ? 'none' : 'block';

                        // Close other open sub-menus to avoid overlap
                        mobileMenuItems.forEach(otherItem => {
                            if (otherItem !== item && otherItem.nextElementSibling && otherItem.nextElementSibling.tagName === 'UL') {
                                otherItem.parentElement.classList.remove('active');
                                otherItem.nextElementSibling.style.display = 'none';
                            }
                        });
                    });
                }
            });
            
            // Make category dropdown work on mobile
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
            
            // Better touch handling for dropdowns
            // Replace the existing dropdownToggles handler
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle:not(.mobile-menu .dropdown-toggle)');
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    if (window.innerWidth < 992) {
                        e.preventDefault();
                        const menu = this.nextElementSibling;
                        if (menu && menu.classList.contains('dropdown-menu')) {
                            if (menu.style.display === 'block') {
                                menu.style.display = 'none';
                            } else {
                                // Close other dropdowns
                                document.querySelectorAll('.dropdown-menu').forEach(m => {
                                    if (m !== menu) m.style.display = 'none';
                                });
                                menu.style.display = 'block';
                            }
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
        });
        
    </script>
</head>

<body>
    <div class="page-wrapper">      
        <header class="header header-intro-clearance header-4">
            <!-- Header Middle (Logo, Search, Cart) -->
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
                        <!-- Desktop Search (hidden on mobile) -->
                        <div class="header-search header-search-extended d-none d-lg-block">
                            <form action="#" method="get">
                                <div class="header-search-wrapper">
                                    <label for="q" class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Search product..." required>
                                    <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Mobile Search Toggle (visible on mobile) -->
                        <a href="#" class="search-toggle mobile-search-toggle d-lg-none" role="button">
                            <i class="icon-search"></i>
                        </a>
                    </div>

                    <div class="header-right">
                        <!-- Login/Signup Button -->
                        <a href="login.html" class="login-btn">
                            <i class="icon-user"></i> Login/Signup
                        </a>
                        
                        <!-- Cart Dropdown -->
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
                                    <a href="cart.html" class="btn btn-primary">View Cart</a>
                                    <a href="checkout.html" class="btn btn-outline-primary-2">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Bottom (Navigation) -->
            <div class="header-bottom sticky-header">
                <div class="container">
                    <nav class="main-nav d-none d-lg-block">
                        <ul class="menu">
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="category.php?category=all">Shop</a></li>
                            
                            <!-- Browse Categories Dropdown (now part of main nav) -->
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
                            
                            <!-- Pages Dropdown -->
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

            <!-- Mobile Menu Container -->
            <div class="mobile-menu-container">
                <div class="mobile-menu-wrapper">
                    <span class="mobile-menu-close"><i class="icon-close"></i></span>
                    
                    <!-- Mobile Search -->
                    <form action="#" method="get" class="mobile-search">
                        <label for="mobile-search" class="sr-only">Search</label>
                        <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search..." required>
                        <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                    </form>
                    
                    <!-- Mobile Navigation (Updated) -->
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="category.php?category=all">Shop</a></li>
                            
                            <!-- Browse Categories Dropdown (now part of main mobile menu) -->
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
                            
                            <!-- Pages Dropdown -->
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
                    
                    <!-- Removed the separate mobile-cats section since it's now integrated -->
                </div>
            </div>
        </header>

        <!-- Rest of your HTML content remains the same -->
        <main class="main">
            <div class="intro-slider-container mb-5">
                <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" 
                    data-owl-options='{
                        "dots": true,
                        "nav": false, 
                        "responsive": {
                            "1200": {
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/bailord.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-third">Deals and Promotions</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title">VIVO</h1>
                                    <h1 class="intro-title">YO 3t</h1><!-- End .intro-title -->

                                    <div class="intro-price">
                                        <sup class="intro-old-price">$349,95</sup>
                                        <span class="text-third">
                                            $279<sup>.99</sup>
                                        </span>
                                    </div><!-- End .intro-price -->

                                    <a href="category.html" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .col-lg-11 offset-lg-1 -->
                            </div><!-- End .row -->
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->

                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/slide-2.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-primary">New Arrival</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title">VIVO V19 </h1><!-- End .intro-title -->

                                    <div class="intro-price">
                                        <sup>Today:</sup>
                                        <span class="text-primary">
                                            $999<sup>.99</sup>
                                        </span>
                                    </div><!-- End .intro-price -->

                                    <a href="category.html" class="btn btn-primary btn-round">
                                        <span>Shop More</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .col-md-6 offset-md-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->
                </div><!-- End .intro-slider owl-carousel owl-simple -->

                <span class="slider-loader"></span><!-- End .slider-loader -->
            </div><!-- End .intro-slider-container -->
            <div class="container">
                    <h2 class="title text-center mb-4">Explore Popular Categories</h2><!-- End .title text-center -->
                    
                    <div class="cat-blocks-container">
                        <div class="row">
                            <?php
                            
                            // Define a default image in case category image doesn't exist
                            $default_image = 'category-default.jpg';
                            
                            try {
                                $stmt = $conn->prepare("SELECT * FROM category");
                                $stmt->execute();
                                $categories = $stmt->fetchAll();
                                
                                foreach ($categories as $category) {
                                    $slug = !empty($category['cat_slug']) ? $category['cat_slug'] : strtolower(str_replace(' ', '-', $category['name']));
                                    
                                    // Create image path - check if you want to use ID, slug, or name
                                    //$image_name = 'category-' . $category['id'] . '.jpg'; // Using ID
                                    $image_name = $slug . '.jpg'; // Using slug
                                    
                                    // Check if image exists, otherwise use default
                                    $image_path = file_exists('images/' . $image_name) 
                                            ? 'images/' . $image_name 
                                            : 'images/' . $default_image;
                                    
                                    echo '
                                    <div class="col-6 col-sm-4 col-lg-2">
                                        <a href="category.php?slug='.$slug.'" class="cat-block">
                                            <figure>
                                                <span>
                                                    <img src="'.$image_path.'" alt="'.$category['name'].'">
                                                </span>
                                            </figure>
                                            <h3 class="cat-block-title">'.$category['name'].'</h3>
                                        </a>
                                    </div>';
                                }
                                
                                $pdo->close();
                            }
                            catch(PDOException $e) {
                                echo "There is some problem in connection: " . $e->getMessage();
                            }
                            ?>
                        </div><!-- End .row -->
                    </div><!-- End .cat-blocks-container -->
                </div><!-- End .container -->

            <div class="mb-4"></div><!-- End .mb-4 -->

            <div class="container">
                <div class="row justify-content-center">
                    <!-- Promo banners will be dynamically loaded here -->
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-3"></div><!-- End .mb-5 -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="banner banner-overlay banner-overlay-light">
                            <a href="#">
                                <img src="assets/images/demos/demo-4/banners/banner-1.png" alt="Banner">
                            </a>

                            <div class="banner-content">
                                <h4 class="banner-subtitle"><a href="#">Smart Offer</a></h4><!-- End .banner-subtitle -->
                                <h3 class="banner-title"><a href="#">Save $150 <strong>on Samsung <br>Galaxy Note9</strong></a></h3><!-- End .banner-title -->
                                <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                    </div><!-- End .col-md-4 -->

                    <div class="col-md-6 col-lg-4">
                        <div class="banner banner-overlay banner-overlay-light">
                            <a href="#">
                                <img src="assets/images/demos/demo-4/banners/banner-2.jpg" alt="Banner">
                            </a>

                            <div class="banner-content">
                                <h4 class="banner-subtitle"><a href="#">Time Deals</a></h4><!-- End .banner-subtitle -->
                                <h3 class="banner-title"><a href="#"><strong>Bose SoundSport</strong> <br>Time Deal -30%</a></h3><!-- End .banner-title -->
                                <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                    </div><!-- End .col-md-4 -->

                    <div class="col-md-6 col-lg-4">
                        <div class="banner banner-overlay banner-overlay-light">
                            <a href="#">
                                <img src="assets/images/demos/demo-4/banners/banner-3.png" alt="Banner">
                            </a>

                            <div class="banner-content">
                                <h4 class="banner-subtitle"><a href="#">Clearance</a></h4><!-- End .banner-subtitle -->
                                <h3 class="banner-title"><a href="#"><strong>GoPro - Fusion 360</strong> <br>Save $70</a></h3><!-- End .banner-title -->
                                <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                    </div><!-- End .col-lg-4 -->
                </div><!-- End .row -->
            </div><!-- End .container -->

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
                            "margin": 10,
                            "loop": false,
                            "responsive": {
                                "0": {"items":1},
                                "400": {"items":2},
                                "576": {"items":3},
                                "768": {"items":4},
                                "992": {"items":5},
                                "1200": {"items":5}
                            }
                        }'>
                            <?php
                            $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 15"); // 15 products for 3 slides of 5
                            $stmt->execute();
                            $products = $stmt->fetchAll();
                            
                            // Group products into sets of 5
                            $productGroups = array_chunk($products, 5);
                            
                            foreach ($productGroups as $group) {
                                echo '<div class="products-slide d-flex">';  
                                foreach ($group as $product) {
                                    echo '<div class="product" style="width: 20%; flex: 0 0 20%; padding: 0 10px;">  <!-- Force 5 items per row -->
                                        <figure class="product-media">
                                            <a href="product.php?slug='.htmlspecialchars($product['slug']).'">
                                                <img src="images/'.htmlspecialchars($product['photo']).'" alt="'.htmlspecialchars($product['name']).'" class="product-image">
                                            </a>
                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                            </div>
                                            <div class="product-action">
                                                <a href="#" class="btn-product btn-cart" title="Add to cart">Add to Cart</a>
                                            </div>
                                        </figure>
                                        <div class="product-body">
                                            <h3 class="product-title"><a href="product.php?slug='.htmlspecialchars($product['slug']).'">'.htmlspecialchars($product['name']).'</a></h3>
                                            <div class="product-price">$'.number_format($product['price'], 2).'</div>
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
                                </div><!-- End .cta-text -->
                                <a href="#" class="btn btn-primary btn-round"><span>Shop Now - $429.99</span><i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .cta-content -->
                        </div><!-- End .col-md-12 -->
                    </div><!-- End .row -->
                </div><!-- End .cta -->
            </div><!-- End .container -->
            <div class="container">
                <div class="heading text-center mb-3">
                    <h2 class="title">Deals & Outlet</h2><!-- End .title -->
                    <p class="title-desc">Today's deal and more</p><!-- End .title-desc -->
                </div><!-- End .heading -->

                <div class="row">
                    <?php
                    // Get two most recent products
                    $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 2");
                    $stmt->execute();
                    $deals = $stmt->fetchAll();
                    
                    // First deal (Deal of the Day)
                    if (isset($deals[0])) {
                        $product1 = $deals[0];
                        echo '<div class="col-lg-6 deal-col">
                            <div class="deal" style="background-image: url(\'images/'.htmlspecialchars($product1['photo']).'\');">
                                <div class="deal-top">
                                    <h2>Deal of the Day.</h2>
                                    <h4>Limited quantities. </h4>
                                </div><!-- End .deal-top -->

                                <div class="deal-content">
                                    <h3 class="product-title"><a href="product.php?slug='.htmlspecialchars($product1['slug']).'">'.htmlspecialchars($product1['name']).'</a></h3><!-- End .product-title -->

                                    <div class="product-price">
                                        <span class="new-price">$'.number_format($product1['price'] * 0.9, 2).'</span>
                                        <span class="old-price">Was $'.number_format($product1['price'], 2).'</span>
                                    </div><!-- End .product-price -->

                                    <a href="product.php?slug='.htmlspecialchars($product1['slug']).'" class="btn btn-link"><span>Shop Now</span><i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .deal-content -->

                                <div class="deal-bottom">
                                    <div class="deal-countdown daily-deal-countdown" data-until="+10h"></div><!-- End .deal-countdown -->
                                </div><!-- End .deal-bottom -->
                            </div><!-- End .deal -->
                        </div><!-- End .col-lg-6 -->';
                    }
                    
                    // Second deal (Exclusive Offer)
                    if (isset($deals[1])) {
                        $product2 = $deals[1];
                        echo '<div class="col-lg-6 deal-col">
                            <div class="deal" style="background-image: url(\'images/'.htmlspecialchars($product2['photo']).'\');">
                                <div class="deal-top">
                                    <h2>Your Exclusive Offers.</h2>
                                    <h4>Sign in to see amazing deals.</h4>
                                </div><!-- End .deal-top -->

                                <div class="deal-content">
                                    <h3 class="product-title"><a href="product.php?slug='.htmlspecialchars($product2['slug']).'">'.htmlspecialchars($product2['name']).'</a></h3><!-- End .product-title -->

                                    <div class="product-price">
                                        <span class="new-price">$'.number_format($product2['price'] * 0.85, 2).'</span>
                                    </div><!-- End .product-price -->

                                    <a href="login.html" class="btn btn-link"><span>Sign In and Save money</span><i class="icon-long-arrow-right"></i></a>
                                </div><!-- End .deal-content -->

                                <div class="deal-bottom">
                                    <div class="deal-countdown offer-countdown" data-until="+11d"></div><!-- End .deal-countdown -->
                                </div><!-- End .deal-bottom -->
                            </div><!-- End .deal -->
                        </div><!-- End .col-lg-6 -->';
                    }
                    ?>
                </div><!-- End .row -->

                <div class="more-container text-center mt-1 mb-5">
                    <a href="category.php?deal=1" class="btn btn-outline-dark-2 btn-round btn-more"><span>Shop more Outlet deals</span><i class="icon-long-arrow-right"></i></a>
                </div><!-- End .more-container -->
            </div><!-- End .container -->

            <div class="container">
                <hr class="mb-0">
                <div class="owl-carousel mt-5 mb-5 owl-simple" data-toggle="owl" 
                data-owl-options='{
                    "nav": true, 
                    "dots": true,
                    "margin": 10,
                    "loop": false,
                    "responsive": {
                        "0": {"items":1},
                        "400": {"items":2},
                        "576": {"items":3},
                        "768": {"items":4},
                        "992": {"items":5},
                        "1200": {"items":5}
                    }
                }'
                    }'>
                    <img src="assets/images/brands/brand1.png" alt="Brand">
                    <img src="assets/images/brands/brand2.png" alt="Brand">
                    <img src="assets/images/brands/brand3.png" alt="Brand">
                    <img src="assets/images/brands/brand4.png" alt="Brand">
                    <img src="assets/images/brands/brand5.png" alt="Brand">
                    <img src="assets/images/brands/brand6.png" alt="Brand">
                </div>
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
                                    <a href="category.php" class="banner-link">Shop Now <i class="icon-long-arrow-right"></i></a>
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
                                        "margin": 10,
                                        "loop": false,
                                        "responsive": {
                                            "0": {"items":1},
                                            "400": {"items":2},
                                            "576": {"items":3},
                                            "768": {"items":4},
                                            "992": {"items":5},
                                            "1200": {"items":5}
                                        }
                                    }'>
                                        <?php
                                        $stmt = $conn->prepare("SELECT * FROM products ORDER BY counter DESC LIMIT 8");
                                        $stmt->execute();
                                        $trending = $stmt->fetchAll();
                                        
                                        foreach ($trending as $product) {
                                            echo '<div class="product">
                                                <figure class="product-media">
                                                    <a href="product.php?slug='.htmlspecialchars($product['slug']).'">
                                                        <img src="images/'.htmlspecialchars($product['photo']).'" alt="'.htmlspecialchars($product['name']).'" class="product-image">
                                                    </a>
                                                </figure>
                                                <div class="product-body">
                                                    <h3 class="product-title"><a href="product.php?slug='.htmlspecialchars($product['slug']).'">'.htmlspecialchars($product['name']).'</a></h3>
                                                    <div class="product-price">$'.number_format($product['price'], 2).'</div>
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
                                        "margin": 10,
                                        "loop": false,
                                        "responsive": {
                                            "0": {"items":1},
                                            "400": {"items":2},
                                            "576": {"items":3},
                                            "768": {"items":4},
                                            "992": {"items":5},
                                            "1200": {"items":5}
                                        }
                                    }'>
                                        <?php
                                        $stmt = $conn->prepare("SELECT p.* FROM products p JOIN details d ON p.id = d.product_id GROUP BY p.id ORDER BY SUM(d.quantity) DESC LIMIT 8");
                                        $stmt->execute();
                                        $bestSelling = $stmt->fetchAll();
                                        
                                        foreach ($bestSelling as $product) {
                                            echo '<div class="product">
                                                <!-- Same product structure as above -->
                                            </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="tab-pane p-0 fade" id="trending-sale-tab" role="tabpanel" aria-labelledby="trending-sale-link">
                                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                                    data-owl-options='{
                                        "nav": true, 
                                        "dots": true,
                                        "margin": 10,
                                        "loop": false,
                                        "responsive": {
                                            "0": {"items":1},
                                            "400": {"items":2},
                                            "576": {"items":3},
                                            "768": {"items":4},
                                            "992": {"items":5},
                                            "1200": {"items":5}
                                        }
                                    }'>
                                        <?php
                                        $stmt = $conn->prepare("SELECT * FROM products WHERE price < (SELECT AVG(price) FROM products) ORDER BY RAND() LIMIT 8");
                                        $stmt->execute();
                                        $onSale = $stmt->fetchAll();
                                        
                                        foreach ($onSale as $product) {
                                            echo '<div class="product">
                                                <!-- Same product structure as above -->
                                            </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5"></div>

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
                        $stmt = $conn->prepare("SELECT * FROM products ORDER BY RAND() LIMIT 6");
                        $stmt->execute();
                        $recommended = $stmt->fetchAll();
                        
                        foreach ($recommended as $product) {
                            echo '<div class="col-6 col-md-4 col-lg-2">
                                <div class="product">
                                    <figure class="product-media">
                                        <a href="product.php?slug='.htmlspecialchars($product['slug']).'">
                                            <img src="images/'.htmlspecialchars($product['photo']).'" alt="'.htmlspecialchars($product['name']).'" class="product-image">
                                        </a>
                                    </figure>
                                    <div class="product-body">
                                        <h3 class="product-title"><a href="product.php?slug='.htmlspecialchars($product['slug']).'">'.htmlspecialchars($product['name']).'</a></h3>
                                        <div class="product-price">$'.number_format($product['price'], 2).'</div>
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
                                    <img src="images/logo.png" class="logo" alt="logo" width="60" height="15">
                                    <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                                    <p>Subscribe to Bailord newsletter to receive timely updates from your favorite products.</p>
                                    <form action="#">
                                        <div class="input-group input-group-round">
                                            <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                            <div class="input-group-append">
                                                <button class="btn" type="submit"><span>go</span></button>
                                            </div><!-- .End .input-group-append -->
                                        </div><!-- .End .input-group -->
                                    </form>
                                    <div class="custom-control custom-checkbox" style="text-align: left;">
                                        <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                        <label class="custom-control-label" for="register-policy-2">Do not show this again</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2-5col col-lg-5 ">
                                <img src="images/img-1.jpg" class="newsletter-img" alt="newsletter">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Plugins JS File -->
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
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/demos/demo-4.js"></script>
</body>
</html>
