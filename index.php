<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bailord</title>
    <meta name="keywords" content="eCommerce, Bailord, Shopping">
    <meta name="description" content="Bailord - Your one-stop eCommerce platform">
    <meta name="author" content="Your Name">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x16" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.webmanifest">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#ff6200">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Bailord">
    <meta name="application-name" content="Bailord">
    <meta name="msapplication-TileColor" content="#ff6200">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/skins/skin-demo-4.css">
    <link rel="stylesheet" href="assets/css/demos/demo-4.css">
    <link rel="preload" href="assets/css/bootstrap.min.css" as="style">
    <link rel="preload" href="assets/css/style.css" as="style">
    <style>
        :root {
            --dominant-color: #ff6200; /* Bright orange like Jumia */
            --secondary-color: #28a745;
            --accent-color: #ffffff;
            --complementary-orange: #e65100;
            --light-neutral: #ffffff;
            --medium-neutral: #f1f3f5;
            --dark-neutral: #343a40;
            --text-dark: #212529;
            --text-light: #ffffff;
            --orange-gradient: linear-gradient(135deg, var(--dominant-color) 0%, var(--complementary-orange) 100%);
        }
        body {
            background-color: var(--light-neutral);
            color: var(--text-dark);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }
        .header {
            background: var(--orange-gradient);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header-middle .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 15px;
        }
        .logo img {
            max-height: 40px;
        }
        .header-search-wrapper {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header-search input {
            border: none;
            padding: 10px 15px;
            font-size: 14px;
        }
        .btn-primary {
            background: var(--dominant-color);
            border-color: var(--dominant-color);
            border-radius: 20px;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: var(--complementary-orange);
            border-color: var(--complementary-orange);
            transform: translateY(-2px);
        }
        .user-btn, .login-btn {
            background: var(--dominant-color);
            color: var(--text-light);
            border-radius: 20px;
            padding: 8px 15px;
            transition: all 0.3s ease;
        }
        .user-btn:hover, .login-btn:hover {
            background: var(--complementary-orange);
            transform: translateY(-2px);
        }
        .cart-dropdown .dropdown-toggle {
            color: var(--text-light);
        }
        .intro-slider img {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.5s ease;
        }
        .intro-slider .owl-item.active img {
            transform: scale(1.05);
        }
        .banner {
            border-radius: 10px;
            overflow: hidden;
            animation: fadeIn 1s ease-in;
        }
        .banner-content {
            background: rgba(0,0,0,0.5);
            padding: 20px;
            border-radius: 10px;
        }
        .product {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .product:hover {
            transform: translateY(-5px);
        }
        .product-image {
            border-radius: 10px 10px 0 0;
            object-fit: cover;
            height: 200px;
            width: 100%;
        }
        .mobile-menu-container {
            background: rgba(0,0,0,0.8);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        .mobile-menu-container.visible {
            transform: translateX(0);
        }
        .mobile-menu-wrapper {
            background: var(--light-neutral);
            border-radius: 0;
            transform: none !important;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 767px) {
            .header-search.d-none.d-lg-block {
                display: none !important;
            }
            .mobile-search-toggle {
                display: block !important;
            }
            .product-image {
                height: 150px;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mobile Menu
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggler');
            const mobileMenuContainer = document.querySelector('.mobile-menu-container');
            const mobileMenuClose = document.querySelector('.mobile-menu-close');
            if (mobileMenuToggle && mobileMenuContainer) {
                mobileMenuToggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    mobileMenuContainer.classList.toggle('visible');
                    document.body.classList.toggle('menu-open');
                });
            }
            if (mobileMenuClose && mobileMenuContainer) {
                mobileMenuClose.addEventListener('click', (e) => {
                    e.preventDefault();
                    mobileMenuContainer.classList.remove('visible');
                    document.body.classList.remove('menu-open');
                });
            }
            // Search Toggle
            const mobileSearchToggle = document.querySelector('.mobile-search-toggle');
            const mobileSearchForm = document.querySelector('.mobile-search');
            if (mobileSearchToggle && mobileSearchForm) {
                mobileSearchToggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    mobileSearchForm.classList.toggle('visible');
                });
            }
            // Promo Banner Rotator
            const promos = [
                { img: 'assets/images/demos/demo-4/banners/banner-1.png', title: 'Smart Offer', subtitle: 'Save ₦150 on Samsung Galaxy Note9', link: 'category.php?category=all' },
                { img: 'assets/images/demos/demo-4/banners/banner-2.jpg', title: 'Time Deals', subtitle: 'Bose SoundSport -30%', link: 'category.php?category=all' },
                { img: 'assets/images/demos/demo-4/banners/banner-3.png', title: 'Clearance', subtitle: 'GoPro Fusion 360 - Save ₦70', link: 'category.php?category=all' }
            ];
            let currentPromo = 0;
            const promoContainer = document.querySelector('.promo-banners');
            if (promoContainer) {
                const renderPromo = () => {
                    promoContainer.innerHTML = `
                        <div class="banner banner-overlay banner-overlay-light fade-in">
                            <a href="${promos[currentPromo].link}">
                                <img src="${promos[currentPromo].img}" alt="Promo Banner" loading="lazy">
                            </a>
                            <div class="banner-content">
                                <h4 class="banner-subtitle"><a href="${promos[currentPromo].link}">${promos[currentPromo].title}</a></h4>
                                <h3 class="banner-title"><a href="${promos[currentPromo].link}">${promos[currentPromo].subtitle}</a></h3>
                                <a href="${promos[currentPromo].link}" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                            </div>
                        </div>`;
                };
                renderPromo();
                setInterval(() => {
                    currentPromo = (currentPromo + 1) % promos.length;
                    renderPromo();
                }, 5000);
            }
            // Cart Update
            const cartCount = document.querySelector('.cart-count');
            const cartTotal = document.querySelector('.cart-total-price');
            const updateCart = () => {
                const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                cartCount.textContent = cart.length;
                const total = cart.reduce((sum, item) => sum + item.price, 0);
                cartTotal.textContent = `₦${total.toFixed(2)}`;
            };
            updateCart();
            document.querySelectorAll('.btn-cart').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const product = {
                        id: Date.now(),
                        name: btn.closest('.product').querySelector('.product-title').textContent,
                        price: parseFloat(btn.closest('.product').querySelector('.product-price').textContent.replace('₦', ''))
                    };
                    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                    cart.push(product);
                    localStorage.setItem('cart', JSON.stringify(cart));
                    updateCart();
                });
            });
            // Lazy Load Images
            const images = document.querySelectorAll('img[data-src]');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        observer.unobserve(img);
                    }
                });
            });
            images.forEach(img => observer.observe(img));
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
                                <i class="fas fa-sign-out-alt"></i> Logout
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
                                    <span class="cart-total-price">₦0.00</span>
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
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main class="main">
            <div class="intro-slider-container mb-5">
                <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl">
                    <div class="intro-slide"><img src="assets/images/demos/demo-4/slider1.png" alt="ITEL P70" data-src="assets/images/demos/demo-4/slide1.png"></div>
                    <div class="intro-slide"><img src="assets/images/demos/demo-4/slider2.png" alt="TECNO POP 10C" data-src="assets/images/demos/demo-4/slide2.png"></div>
                    <div class="intro-slide"><img src="assets/images/demos/demo-4/slider3.png" alt="TECNO POP 10" data-src="assets/images/demos/demo-4/slide3.png"></div>
                    <div class="intro-slide"><img src="assets/images/demos/demo-4/slider4.png" alt="VIVO Y04" data-src="assets/images/demos/demo-4/slide4.png"></div>
                    <div class="intro-slide"><img src="assets/images/demos/demo-4/slider5.png" alt="ZTE BLADE A35" data-src="assets/images/demos/demo-4/slide5.png"></div>
                </div>
                <span class="slider-loader"></span>
            </div>
            <div class="container">
                <h2 class="title text-center mb-4">Explore Popular Categories</h2>
                <div class="cat-blocks-container">
                    <div class="row">
                        <?php echo htmlspecialchars(render_category_blocks($conn)); ?>
                    </div>
                </div>
            </div>
            <div class="mb-4"></div>
            <div class="container">
                <div class="row justify-content-center promo-banners"></div>
            </div>
            <!-- Retain the rest of your original main content -->
        </main>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/main.js"></script>
    </div>
</body>
</html>
