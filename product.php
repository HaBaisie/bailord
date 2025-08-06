<?php include 'includes/session.php'; ?>
<?php
$conn = $pdo->open();
$slug = $_GET['product'];

try {
    $stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname, products.id AS prodid FROM products LEFT JOIN category ON category.id=products.category_id WHERE slug = :slug");
    $stmt->execute(['slug' => $slug]);
    $product = $stmt->fetch();
    if (!$product) {
        $_SESSION['error'] = 'Product not found';
        header('location: index.php');
        exit;
    }
} catch (PDOException $e) {
    $_SESSION['error'] = 'Database error: ' . htmlspecialchars($e->getMessage());
    header('location: index.php');
    exit;
}

// Page view counter
$now = date('Y-m-d');
if ($product['date_view'] == $now) {
    $stmt = $conn->prepare("UPDATE products SET counter=counter+1 WHERE id=:id");
    $stmt->execute(['id' => $product['prodid']]);
} else {
    $stmt = $conn->prepare("UPDATE products SET counter=1, date_view=:now WHERE id=:id");
    $stmt->execute(['id' => $product['prodid'], 'now' => $now]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bailord | <?php echo htmlspecialchars($product['prodname']); ?></title>
    <meta name="keywords" content="Bailord, eCommerce, <?php echo htmlspecialchars($product['catname']); ?>">
    <meta name="description" content="<?php echo htmlspecialchars(substr($product['description'], 0, 150)); ?>...">
    <meta name="author" content="Bailord Team">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.webmanifest">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#2a5bd7">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Bailord">
    <meta name="application-name" content="Bailord">
    <meta name="msapplication-TileColor" content="#2a5bd7">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- CSS -->
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
            --text-light: #ffffff;
            --blue-gradient: linear-gradient(135deg, var(--dominant-color) 0%, var(--complementary-blue) 100%);
            --green-gradient: linear-gradient(135deg, var(--secondary-color) 0%, #1e7e34 100%);
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        body {
            background-color: var(--light-neutral);
            color: var(--text-dark);
            font-family: 'Inter', 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            margin: 0;
            font-size: 16px;
        }
        .page-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content-wrapper {
            flex: 1;
            background-color: #ffffff;
            padding: 40px 0;
        }
        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .header {
            background: var(--blue-gradient);
            color: var(--text-light);
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .header-middle .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
        }
        .header-left, .header-center, .header-right {
            flex: 1;
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .header-right {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
        }
        .header-center {
            flex-grow: 2;
            padding: 0 20px;
        }
        .logo img {
            width: 120px;
            height: auto;
            transition: transform 0.3s ease;
        }
        .logo img:hover {
            transform: scale(1.05);
        }
        .header-search-extended {
            max-width: 600px;
            margin: 0 auto;
        }
        .header-search-wrapper {
            display: flex;
            border: 1px solid var(--medium-neutral);
            border-radius: 8px;
            overflow: hidden;
            background-color: #ffffff;
        }
        .header-search-wrapper .form-control {
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            flex: 1;
        }
        .header-search-wrapper .btn {
            background-color: var(--dominant-color);
            color: var(--text-light);
            padding: 12px 20px;
            border-radius: 0 8px 8px 0;
            transition: background-color 0.3s ease;
        }
        .header-search-wrapper .btn:hover {
            background-color: var(--complementary-blue);
        }
        .search-toggle {
            color: var(--text-light);
            font-size: 24px;
            cursor: pointer;
        }
        .user-btn, .login-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background-color: var(--secondary-color);
            color: var(--text-light);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .login-btn {
            background-color: var(--dominant-color);
        }
        .user-btn:hover, .login-btn:hover {
            background-color: var(--complementary-blue);
            transform: translateY(-2px);
        }
        .cart-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
        }
        .cart-dropdown .icon {
            position: relative;
            font-size: 28px;
        }
        .cart-dropdown .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--accent-color);
            color: var(--text-light);
            border-radius: 50%;
            padding: 4px 8px;
            font-size: 12px;
            font-weight: bold;
        }
        .cart-dropdown .dropdown-menu {
            width: 320px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: var(--shadow);
        }
        .header-bottom {
            background-color: var(--complementary-blue);
            padding: 10px 0;
        }
        .main-nav .menu {
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .main-nav .menu > li > a {
            color: var(--text-light);
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 500;
            text-transform: uppercase;
            transition: color 0.3s ease;
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
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        .mobile-menu-container.visible {
            transform: translateX(0);
        }
        .mobile-menu-wrapper {
            width: 80%;
            max-width: 320px;
            height: 100%;
            background-color: #ffffff;
            overflow-y: auto;
            padding: 20px;
        }
        .mobile-menu-close {
            position: absolute;
            top: 15px;
            right: 15px;
            cursor: pointer;
            font-size: 24px;
            color: var(--text-dark);
        }
        .mobile-menu li a {
            color: var(--text-dark);
            padding: 12px 15px;
            display: block;
            font-size: 16px;
            font-weight: 500;
        }
        .mobile-menu li a:hover {
            color: var(--accent-color);
            background-color: var(--light-neutral);
        }
        .mobile-menu li ul {
            padding-left: 20px;
            background-color: var(--medium-neutral);
        }
        .mobile-search .form-control {
            padding: 12px 15px;
            border-radius: 8px 0 0 8px;
            border: none;
        }
        .mobile-search .btn {
            border-radius: 0 8px 8px 0;
            background-color: var(--dominant-color);
            color: var(--text-light);
        }
        .page-header {
            color: var(--dominant-color);
            border-bottom: 3px solid var(--accent-color);
            padding-bottom: 12px;
            margin: 0 0 30px;
            font-size: 28px;
            font-weight: 700;
        }
        .row {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 20px;
            margin: 0;
        }
        .col-sm-9 { grid-column: span 9; }
        .col-sm-6 { grid-column: span 6; }
        .col-sm-3 { grid-column: span 3; }
        .col-sm-4 { grid-column: span 4; }
        .callout {
            padding: 20px;
            margin-bottom: 30px;
            border: none;
            border-radius: 8px;
            background-color: var(--light-neutral);
            box-shadow: var(--shadow);
        }
        .callout .close {
            top: 15px;
            right: 15px;
            font-size: 24px;
            color: var(--text-dark);
        }
        .zoom {
            width: 100%;
            max-height: 450px;
            object-fit: cover;
            border-radius: 12px;
            transition: transform 0.3s ease;
        }
        .zoom:hover {
            transform: scale(1.02);
        }
        .form-inline .form-group {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
        }
        .input-group {
            display: flex;
            align-items: center;
            border: 1px solid var(--medium-neutral);
            border-radius: 8px;
            overflow: hidden;
        }
        .input-group-btn .btn {
            background-color: var(--light-neutral);
            color: var(--text-dark);
            padding: 12px;
            border: none;
        }
        .input-group-btn .btn:hover {
            background-color: var(--medium-neutral);
        }
        .form-control.input-lg {
            height: 48px;
            width: 80px;
            text-align: center;
            border: none;
            font-size: 16px;
        }
        .btn-primary {
            background-color: var(--dominant-color);
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: var(--complementary-blue);
            transform: translateY(-2px);
        }
        .fb-comments {
            margin-top: 30px;
            background-color: var(--light-neutral);
            padding: 20px;
            border-radius: 8px;
        }
        .box {
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }
        .box:hover {
            transform: translateY(-5px);
        }
        .prod-body {
            padding: 20px;
        }
        .box-footer {
            background-color: var(--light-neutral);
            padding: 15px 20px;
            border-top: none;
            font-weight: 600;
            color: var(--dominant-color);
        }
        .thumbnail {
            object-fit: cover;
            border-radius: 8px;
            width: 100%;
            height: 250px;
        }
        .alert {
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
            font-size: 16px;
        }
        .alert-info {
            background-color: #e7f3fe;
            border-color: #b6d4fe;
            color: #31708f;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c2c7;
            color: #842029;
        }
        .product-details {
            padding: 20px;
        }
        .product-details h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .product-details p {
            margin: 10px 0;
            font-size: 16px;
            line-height: 1.8;
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
                width: 100px;
            }
            .col-sm-9, .col-sm-6, .col-sm-3, .col-sm-4 {
                grid-column: span 12;
            }
            .zoom {
                max-height: 350px;
            }
            .page-header {
                font-size: 24px;
            }
            .thumbnail {
                height: 200px;
            }
        }
        @media (max-width: 767px) {
            .header-middle .container {
                flex-direction: column;
                gap: 15px;
            }
            .header-middle .header-left {
                width: 100%;
                justify-content: space-between;
            }
            .header-middle .header-right {
                display: none;
            }
            .form-inline .form-group {
                flex-direction: column;
                align-items: stretch;
            }
            .input-group {
                width: 100%;
            }
            .btn-primary.btn-lg {
                width: 100%;
            }
            .zoom {
                max-height: 300px;
            }
            .thumbnail {
                height: 180px;
            }
            .mobile-search {
                display: block;
                margin: 15px 0;
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
</head>
<body class="hold-transition skin-blue layout-top-nav">
<script>
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
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
                        <img src="assets/images/demos/demo-4/logo.png" alt="Bailord Logo" width="120" height="30">
                    </a>
                </div>
                <div class="header-center">
                    <div class="header-search header-search-extended d-none d-lg-block">
                        <form action="search.php" method="POST">
                            <div class="header-search-wrapper">
                                <label for="q" class="sr-only">Search</label>
                                <input type="search" class="form-control" name="keyword" id="q" placeholder="Search for products..." required>
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
                            <span>Cart</span>
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
                    <div class="col-sm-9">
                        <div class="callout" id="callout" style="display:none">
                            <button type="button" class="close"><span aria-hidden="true">×</span></button>
                            <span class="message"></span>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php
                                $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/noimage.jpg';
                                $image_url = !empty($product['photo'])
                                    ? htmlspecialchars($product['photo'])
                                    : $default_image;
                                $large_image_url = !empty($product['photo'])
                                    ? htmlspecialchars(str_replace('/upload/', '/upload/w_800,h_800,c_fill,f_auto,q_auto/', $product['photo']))
                                    : $default_image;
                                ?>
                                <img src="<?php echo $image_url; ?>" width="100%" class="zoom" data-magnify-src="<?php echo $large_image_url; ?>" alt="<?php echo htmlspecialchars($product['prodname']); ?>">
                                <form class="form-inline" id="productForm">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" id="minus" class="btn btn-default btn-flat btn-lg"><i class="fa fa-minus"></i></button>
                                            </span>
                                            <input type="text" name="quantity" id="quantity" class="form-control input-lg" value="1">
                                            <span class="input-group-btn">
                                                <button type="button" id="add" class="btn btn-default btn-flat btn-lg"><i class="fa fa-plus"></i></button>
                                            </span>
                                            <input type="hidden" value="<?php echo $product['prodid']; ?>" name="id">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <h1 class="page-header"><?php echo htmlspecialchars($product['prodname']); ?></h1>
                                <div class="product-details">
                                    <h3>₦ <?php echo number_format($product['price'], 2); ?></h3>
                                    <p><b>Category:</b> <a href="category.php?category=<?php echo htmlspecialchars($product['cat_slug']); ?>"><?php echo htmlspecialchars($product['catname']); ?></a></p>
                                    <p><b>Description:</b></p>
                                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="fb-comments" data-href="https://bailord-0b4b2667ca4f.herokuapp.com/product.php?product=<?php echo htmlspecialchars($slug); ?>" data-numposts="10" width="100%"></div>
                    </div>
                    <div class="col-sm-3">
                        <?php include 'includes/sidebar.php'; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php $pdo->close(); ?>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
    <script>
    $(function(){
        $('#add').click(function(e){
            e.preventDefault();
            var quantity = $('#quantity').val();
            quantity++;
            $('#quantity').val(quantity);
        });
        $('#minus').click(function(e){
            e.preventDefault();
            var quantity = $('#quantity').val();
            if(quantity > 1){
                quantity--;
            }
            $('#quantity').val(quantity);
        });

        // Magnific Popup for image zoom
        $('.zoom').magnificPopup({
            type: 'image',
            mainClass: 'mfp-zoom',
            zoom: {
                enabled: true,
                duration: 300
            }
        });
    });

    // Enhanced mobile menu and dropdown handling
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
</div>
</body>
</html>
