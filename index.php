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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/skins/skin-demo-4.css">
    <link rel="stylesheet" href="assets/css/demos/demo-4.css">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" as="style">
    <link rel="preload" href="assets/css/style.css" as="style">
    <style>
        :root {
            --dominant-color: #ff6200;
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
            width: 100%;
            height: auto;
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
        .error-message {
            text-align: center;
            color: #dc3545;
            padding: 20px;
            font-size: 16px;
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
        /* Forced Colors Support */
        @media (forced-colors: active) {
            body {
                background: Window;
                color: WindowText;
            }
            .header, .btn-primary, .user-btn, .login-btn {
                background: ButtonFace;
                color: ButtonText;
                border-color: ButtonText;
            }
            .intro-slider img, .product-image {
                border: 1px solid ButtonText;
            }
            .banner, .product {
                border: 1px solid ButtonText;
            }
        }
    </style>
    <script>
        // CDN fallbacks for critical scripts
        window.jQuery || document.write('<script src="https://code.jquery.com/jquery-3.6.0.min.js"><\/script>');
        document.addEventListener('DOMContentLoaded', () => {
            // Check for jQuery and Owl Carousel
            if (typeof jQuery === 'undefined') {
                console.error('jQuery not loaded. Critical functionality may be affected.');
            }
            if (typeof jQuery.fn.owlCarousel === 'undefined') {
                console.error('Owl Carousel not loaded. Sliders and carousels will not function.');
                document.querySelectorAll('.owl-carousel').forEach(carousel => {
                    carousel.innerHTML = '<p class="error-message">Carousel failed to load. Please try again later.</p>';
                });
            } else {
                console.log('Owl Carousel loaded successfully.');
            }
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
                                <img src="${promos[currentPromo].img}" alt="Promo Banner" loading="lazy" onerror="this.src='https://via.placeholder.com/1200x400?text=Promo+Image+Not+Found';">
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
            } else {
                console.error('Promo banners container not found.');
            }
            // Cart Update
            const cartCount = document.querySelector('.cart-count');
            const cartTotal = document.querySelector('.cart-total-price');
            const updateCart = () => {
                const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                if (cartCount) cartCount.textContent = cart.length;
                const total = cart.reduce((sum, item) => sum + (item.price || 0), 0);
                if (cartTotal) cartTotal.textContent = `₦${total.toFixed(2)}`;
            };
            updateCart();
            document.querySelectorAll('.btn-cart').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const productElement = btn.closest('.product');
                    if (!productElement) {
                        console.error('Product element not found for cart button');
                        return;
                    }
                    const product = {
                        id: Date.now(),
                        name: productElement.querySelector('.product-title')?.textContent || 'Unknown Product',
                        price: parseFloat(productElement.querySelector('.product-price')?.textContent.replace('₦', '') || 0)
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
                        img.onerror = () => {
                            img.src = 'https://via.placeholder.com/1200x400?text=Image+Not+Found';
                        };
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
                            <img src="assets/images/demos/demo-4/logo.png" alt="Bailord Logo" width="105" height="25" onerror="this.src='https://via.placeholder.com/105x25?text=Logo';">
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
                                    try {
                                        $pdo = new Database();
                                        $conn = $pdo->open();
                                        $stmt = $conn->prepare("SELECT * FROM category");
                                        $stmt->execute();
                                        $categories = $stmt->fetchAll();
                                        if (empty($categories)) {
                                            echo '<li><a href="#">No categories available</a></li>';
                                        } else {
                                            foreach ($categories as $category) {
                                                $slug = !empty($category['cat_slug']) ? $category['cat_slug'] : strtolower(str_replace(' ', '-', $category['name']));
                                                echo '<li><a href="category.php?category='.htmlspecialchars($slug).'">'.htmlspecialchars($category['name']).'</a></li>';
                                            }
                                        }
                                    } catch (PDOException $e) {
                                        echo '<li><a href="#">Error loading categories: '.htmlspecialchars($e->getMessage()).'</a></li>';
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
                                        if (empty($categories)) {
                                            echo '<li><a href="#">No categories available</a></li>';
                                        } else {
                                            foreach ($categories as $category) {
                                                $slug = !empty($category['cat_slug']) ? $category['cat_slug'] : strtolower(str_replace(' ', '-', $category['name']));
                                                echo '<li><a href="category.php?category='.htmlspecialchars($slug).'">'.htmlspecialchars($category['name']).'</a></li>';
                                            }
                                        }
                                    } catch (PDOException $e) {
                                        echo '<li><a href="#">Error loading categories: '.htmlspecialchars($e->getMessage()).'</a></li>';
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
            <div class="container">
                <h2 class="title text-center mb-4">Debug Information</h2>
                <div class="row">
                    <div class="col-12">
                        <?php
                        try {
                            $pdo = new Database();
                            $conn = $pdo->open();
                            $stmt = $conn->prepare("SELECT 1");
                            $stmt->execute();
                            echo '<p class="text-success">Database connection successful.</p>';
                        } catch (PDOException $e) {
                            echo '<p class="error-message">Database connection failed: '.htmlspecialchars($e->getMessage()).'</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="intro-slider-container mb-5">
                <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" data-owl-options='{
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
                        <img data-src="assets/images/demos/demo-4/slider/slider1.png" alt="ITEL P70" loading="lazy" onerror="this.src='https://via.placeholder.com/1200x400?text=Slider+Image+Not+Found';">
                    </div>
                    <div class="intro-slide">
                        <img data-src="assets/images/demos/demo-4/slider/slider2.png" alt="TECNO POP 10C" loading="lazy" onerror="this.src='https://via.placeholder.com/1200x400?text=Slider+Image+Not+Found';">
                    </div>
                    <div class="intro-slide">
                        <img data-src="assets/images/demos/demo-4/slider/slider3.png" alt="TECNO POP 10" loading="lazy" onerror="this.src='https://via.placeholder.com/1200x400?text=Slider+Image+Not+Found';">
                    </div>
                    <div class="intro-slide">
                        <img data-src="assets/images/demos/demo-4/slider/slider4.png" alt="VIVO Y04" loading="lazy" onerror="this.src='https://via.placeholder.com/1200x400?text=Slider+Image+Not+Found';">
                    </div>
                    <div class="intro-slide">
                        <img data-src="assets/images/demos/demo-4/slider/slider5.png" alt="ZTE BLADE A35" loading="lazy" onerror="this.src='https://via.placeholder.com/1200x400?text=Slider+Image+Not+Found';">
                    </div>
                </div>
                <span class="slider-loader"></span>
            </div>
            <div class="container">
                <h2 class="title text-center mb-4">Explore Popular Categories</h2>
                <div class="cat-blocks-container">
                    <div class="row">
                        <?php
                        try {
                            $categoryBlocks = render_category_blocks($conn);
                            if (empty($categoryBlocks)) {
                                echo '<p class="error-message">No categories found. Please check the database.</p>';
                            } else {
                                echo htmlspecialchars($categoryBlocks);
                            }
                        } catch (Exception $e) {
                            echo '<p class="error-message">Error loading categories: '.htmlspecialchars($e->getMessage()).'</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="mb-4"></div>
            <div class="container">
                <div class="row justify-content-center promo-banners"></div>
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
                            $default_image = 'https://via.placeholder.com/200x200?text=No+Image';
                            try {
                                $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 15");
                                $stmt->execute();
                                $products = $stmt->fetchAll();
                                if (empty($products)) {
                                    echo '<p class="error-message">No products found in the database.</p>';
                                } else {
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
                                                        <img src="'.$image_url.'" alt="'.htmlspecialchars($product['name']).'" class="product-image" loading="lazy" onerror="this.src=\''.$default_image.'\';">
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
                                }
                            } catch (PDOException $e) {
                                echo '<p class="error-message">Error fetching products: '.htmlspecialchars($e->getMessage()).'</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/main.js"></script>
    </div>
</body>
</html>
