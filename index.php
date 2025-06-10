<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bailord - Modern eCommerce</title>
    <meta name="keywords" content="eCommerce, Bailord, Shopping, Electronics">
    <meta name="description" content="Discover the best deals on electronics and more at Bailord. Shop now for exclusive offers and new arrivals!">
    <meta name="author" content="Bailord Team">
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
    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.countdown.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/skins/skin-demo-4.css">
    <link rel="stylesheet" href="assets/css/demos/demo-4.css">
    <!-- Preload critical resources -->
    <link rel="preload" href="assets/css/bootstrap.min.css" as="style">
    <link rel="preload" href="assets/css/style.css" as="style">
    <link rel="preload" href="assets/js/jquery.min.js" as="script">
    <link rel="preload" href="assets/js/bootstrap.bundle.min.js" as="script">
    <!-- DNS prefetch -->
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
        }

        /* Header */
        .header {
            background: var(--blue-gradient);
            color: var(--text-light);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header-middle .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 1rem 0;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .login-btn, .user-btn {
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .login-btn {
            background-color: var(--accent-color);
            color: var(--text-light);
        }

        .login-btn:hover {
            background-color: var(--complementary-orange);
        }

        .user-btn {
            background-color: var(--secondary-color);
        }

        .user-btn:hover {
            background-color: #1e7e34;
        }

        /* Slider */
        .intro-slider-container {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }

        .intro-slide {
            background-size: cover;
            background-position: center;
            min-height: 500px;
            display: flex;
            align-items: center;
        }

        .intro-content {
            background: rgba(0,0,0,0.5);
            padding: 2rem;
            border-radius: 10px;
        }

        .intro-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--text-light);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .intro-subtitle {
            font-size: 1.5rem;
            color: var(--accent-color);
        }

        .intro-price {
            font-size: 2rem;
            color: var(--text-light);
        }

        .intro-price sup {
            font-size: 1.2rem;
            color: var(--medium-neutral);
        }

        /* Category Blocks */
        .cat-blocks-container .cat-block {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
        }

        .cat-block:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .cat-block img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        /* Products */
        .product {
            transition: all 0.3s ease;
            border: 1px solid var(--medium-neutral);
            border-radius: 10px;
            overflow: hidden;
        }

        .product:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-3px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }

        .product-body {
            padding: 1rem;
        }

        /* New Sections */
        .features-section {
            padding: 4rem 0;
            background: var(--medium-neutral);
        }

        .feature-box {
            text-align: center;
            padding: 2rem;
            border-radius: 10px;
            background: var(--light-neutral);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .feature-box:hover {
            transform: translateY(-5px);
        }

        .feature-box i {
            font-size: 2.5rem;
            color: var(--dominant-color);
            margin-bottom: 1rem;
        }

        /* Testimonials */
        .testimonials-section {
            padding: 4rem 0;
            background: var(--light-neutral);
        }

        .testimonial {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .testimonial img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 1rem;
        }

        /* Newsletter */
        .newsletter-section {
            padding: 4rem 0;
            background: var(--blue-gradient);
            color: var(--text-light);
        }

        .newsletter-section .form-control {
            border-radius: 25px 0 0 25px;
        }

        .newsletter-section .btn {
            border-radius: 0 25px 25px 0;
            background: var(--accent-color);
        }

        /* Mobile Styles */
        @media (max-width: 767px) {
            .intro-title {
                font-size: 2rem;
            }
            .intro-slide {
                min-height: 300px;
            }
            .product-image {
                height: 150px;
            }
            .feature-box {
                margin-bottom: 1rem;
            }
        }
    </style>
    <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Mobile menu toggle
                const mobileMenuToggle = document.querySelector('.mobile-menu-toggler');
                const mobileMenuContainer = document.querySelector('.mobile-menu-container');
                const mobileMenuClose = document.querySelector('.mobile-menu-close');
                
                mobileMenuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileMenuContainer.classList.toggle('visible');
                });
                
                mobileMenuClose.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileMenuContainer.classList.remove('visible');
                });

                // Mobile menu sub-menu toggle
                const mobileMenuItems = document.querySelectorAll('.mobile-menu li > a');
                mobileMenuItems.forEach(item => {
                    if (item.nextElementSibling && item.nextElementSibling.tagName === 'UL') {
                        item.addEventListener('click', function(e) {
                            e.preventDefault();
                            const parentLi = this.parentElement;
                            parentLi.classList.toggle('active');
                        });
                    }
                });

                // Mobile search toggle
                const mobileSearchToggle = document.querySelector('.mobile-search-toggle');
                const mobileSearchForm = document.querySelector('.mobile-search');
                mobileSearchToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    mobileSearchForm.classList.toggle('visible');
                });

                // Update cart count dynamically
                function updateCartCount() {
                    fetch('get_cart_count.php')
                        .then(response => response.json())
                        .then(data => {
                            document.querySelector('.cart-count').textContent = data.count || 0;
                            document.querySelector('.cart-total-price').textContent = `₦${(data.total || 0).toFixed(2)}`;
                        });
                }
                updateCartCount();
                setInterval(updateCartCount, 60000); // Update every minute
            });
        </script>
</head>
<body>
    <div class="page-wrapper">
        <header class="header header-4">
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
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Search for products..." required>
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
                        "nav": true,
                        "autoplay": true,
                        "autoplayTimeout": 5000,
                        "responsive": {
                            "1200": {
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/OPPO.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-third">Deals and Promotions</h3>
                                    <h1 class="intro-title">OPPO A3</h1>
                                    <div class="intro-price">
                                        <sup class="intro-old-price">₦349.95</sup>
                                        <span class="text-third">₦279.99</span>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop Now</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/ITEL_P70.png);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-primary">New Arrival</h3>
                                    <h1 class="intro-title">ITEL P70</h1>
                                    <div class="intro-price">
                                        <sup>Today:</sup>
                                        <span class="text-primary">₦999.99</span>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop Now</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-4/slider/PROMO.jpg);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-accent">Exclusive Offer</h3>
                                    <h1 class="intro-title">Summer Sale</h1>
                                    <div class="intro-price">
                                        <span class="text-accent">Up to 50% Off</span>
                                    </div>
                                    <a href="category.php?category=all" class="btn btn-primary btn-round">
                                        <span>Shop Now</span>
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
                        <?php
                        function renderCategoryBlocks($conn) {
                            try {
                                $stmt = $conn->prepare("SELECT * FROM category LIMIT 6");
                                $stmt->execute();
                                $categories = $stmt->fetchAll();
                                $output = '';
                                foreach ($categories as $category) {
                                    $slug = !empty($category['cat_slug']) ? $category['cat_slug'] : strtolower(str_replace(' ', '-', $category['name']));
                                    $output .= '<div class="col-6 col-sm-4 col-lg-2">
                                        <a href="category.php?category='.$slug.'" class="cat-block">
                                            <figure>
                                                <img src="assets/images/categories/'.htmlspecialchars($category['name']).'.jpg" alt="'.htmlspecialchars($category['name']).'">
                                            </figure>
                                            <h3 class="cat-block-title">'.htmlspecialchars($category['name']).'</h3>
                                        </a>
                                    </div>';
                                }
                                return $output;
                            } catch(PDOException $e) {
                                return '<div class="col-12">Error loading categories</div>';
                            }
                        }
                        echo renderCategoryBlocks($conn);
                        ?>
                    </div>
                </div>
            </div>
            <div class="mb-4"></div>
            <div class="features-section">
                <div class="container">
                    <h2 class="title text-center mb-4">Why Shop With Us</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="feature-box">
                                <i class="las la-shipping-fast"></i>
                                <h3>Fast Shipping</h3>
                                <p>Get your products delivered in record time with our express shipping options.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-box">
                                <i class="las la-shield-alt"></i>
                                <h3>Secure Payments</h3>
                                <p>Shop with confidence using our secure and trusted payment gateways.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-box">
                                <i class="las la-headset"></i>
                                <h3>24/7 Support</h3>
                                <p>Our dedicated support team is available around the clock to assist you.</p>
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
                        <a href="category.php?category=all" class="title-link">View All <i class="icon-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane p-0 fade show active" id="new-all-tab" role="tabpanel">
                        <div class="owl-carousel owl-theme owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": true,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {"items": 1},
                                    "576": {"items": 2},
                                    "768": {"items": 3},
                                    "992": {"items": 4},
                                    "1200": {"items": 5}
                                }
                            }'>
                            <?php
                            $default_image = 'noimage.jpg';
                            $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 10");
                            $stmt->execute();
                            $products = $stmt->fetchAll();
                            foreach ($products as $product) {
                                $image_path = !empty($product['photo']) && file_exists('images/' . $product['photo']) 
                                    ? 'images/' . htmlspecialchars($product['photo']) 
                                    : 'images/' . $default_image;
                                echo '<div class="product">
                                    <figure class="product-media">
                                        <a href="product.php?product='.htmlspecialchars($product['slug']).'">
                                            <img src="'.$image_path.'" alt="'.htmlspecialchars($product['name']).'" class="product-image">
                                        </a>
                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="icon-heart-o"></i></a>
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
            <div class="testimonials-section">
                <div class="container">
                    <h2 class="title text-center mb-4">What Our Customers Say</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="testimonial">
                                <img src="assets/images/testimonials/user1.jpg" alt="Customer">
                                <p>"Amazing shopping experience! The products are top-notch, and delivery was super fast."</p>
                                <h4>Jane Doe</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="testimonial">
                                <img src="assets/images/testimonials/user2.jpg" alt="Customer">
                                <p>"Bailord has the best deals! I saved a lot on my new phone."</p>
                                <h4>John Smith</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="testimonial">
                                <img src="assets/images/testimonials/user3.jpg" alt="Customer">
                                <p>"Great customer service and easy returns. Highly recommend!"</p>
                                <h4>Emily Brown</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="newsletter-section">
                <div class="container">
                    <h2 class="title text-center mb-4">Stay Updated with Our Newsletter</h2>
                    <p class="text-center mb-4">Subscribe to receive exclusive offers and updates on new arrivals!</p>
                    <form action="#" class="d-flex justify-content-center">
                        <input type="email" class="form-control" placeholder="Enter your email" required>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
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
    </div>
</body>
</html>
