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
            .intro-slider-container {
                height: 180px;
                padding: 0 10px;
            }
            .intro-slide {
                background-size: cover;
                background-position: center;
                height: 180px;
                border-radius: 8px;
            }
            .intro-content {
                padding: 8px;
            }
            .intro-title {
                font-size: 16px;
                line-height: 1.2;
            }
            .intro-subtitle {
                font-size: 11px;
            }
            .intro-price {
                font-size: 13px;
            }
            .intro-price sup {
                font-size: 9px;
            }
            .btn-round {
                padding: 5px 10px;
                font-size: 11px;
            }
            .product {
                margin-bottom: 10px;
            }
            .product-media img {
                max-width: 100%;
                height: auto;
                max-height: 120px;
                object-fit: contain;
            }
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
            .intro-slider-container {
                height: 250px;
                padding: 0 15px;
            }
            .intro-slide {
                height: 250px;
                border-radius: 8px;
            }
            .intro-title {
                font-size: 20px;
            }
            .intro-subtitle {
                font-size: 13px;
            }
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
<?php include 'includes/session.php'; ?>
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
        // Handle "All Products" case
        $stmt = $conn->prepare("SELECT * FROM products");
        $page_title = "All Products";
        $show_all_products = true;
    } else {
        // Existing category code
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

if (isset($_GET['category']) && !empty($_GET['category']) && $_GET['category'] !== 'all') {
    $category_slug = htmlspecialchars($_GET['category']);
    $stmt = $conn->prepare("SELECT id, name FROM category WHERE cat_slug = :slug");
    $stmt->execute(['slug' => $category_slug]);
    $category = $stmt->fetch();
    if ($category) {
        $category_name = htmlspecialchars($category['name']);
        $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :category_id");
        $stmt->execute(['category_id' => $category['id']]);
        $products = $stmt->fetchAll();
    } else {
        $error_message = 'Category not found.';
    }
}
?>
<?php include 'includes/header.php'; ?>
<style>
  /* Main Color Scheme */
  body {
    --dominant-color: #3498db;       /* Blue - 60% */
    --secondary-color: #2ecc71;      /* Green - 30% */
    --accent-color: #e67e22;         /* Orange - 10% */
    --neutral-light: #f8f9fa;        /* Light gray background */
    --neutral-dark: #343a40;         /* Dark gray for text */
    --text-color: #333;              /* Main text color */
    --text-light: #fff;              /* Light text for dark backgrounds */
    
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--neutral-light);
    color: var(--text-color);
    line-height: 1.6;
  }

  /* Wrapper and Layout */
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
  }

  /* Header/Navbar */
  .skin-blue .navbar {
    background-color: var(--dominant-color);
    border-color: #2980b9;
  }

  .navbar a {
    color: var(--text-light);
  }

  .navbar a:hover {
    color: #ecf0f1;
    background-color: rgba(255, 255, 255, 0.1);
  }

  /* Page Header */
  .page-header {
    color: var(--dominant-color);
    border-bottom: 2px solid var(--secondary-color);
    padding-bottom: 10px;
    margin-top: 0;
  }

  /* Product Grid */
  .row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -10px;
  }

  .col-sm-4 {
    padding: 10px;
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
    background-color: var(--neutral-light);
    padding: 10px 15px;
    border-top: 1px solid #eee;
    font-weight: bold;
    color: var(--dominant-color);
  }

  /* Product Links */
  .prod-body h5 a {
    color: var(--neutral-dark);
    text-decoration: none;
    transition: color 0.2s;
  }

  .prod-body h5 a:hover {
    color: var(--accent-color);
  }

  /* Thumbnail Images */
  .thumbnail {
    object-fit: cover;
    border-radius: 3px;
    margin-bottom: 10px;
  }

  /* Alerts */
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

  /* Sidebar */
  .col-sm-3 {
    padding: 0 15px;
  }

  /* Buttons */
  .btn-primary {
    background-color: var(--dominant-color);
    border-color: #2980b9;
  }

  .btn-primary:hover {
    background-color: #2980b9;
  }

  .btn-success {
    background-color: var(--secondary-color);
    border-color: #27ae60;
  }

  .btn-success:hover {
    background-color: #27ae60;
  }

  /* Footer */
  .footer {
    background-color: var(--neutral-dark);
    color: var(--text-light);
    padding: 20px 0;
    text-align: center;
  }

  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .col-sm-9, .col-sm-3 {
      width: 100%;
    }
    
    .col-sm-4 {
      width: 50%;
    }
  }

  @media (max-width: 480px) {
    .col-sm-4 {
      width: 100%;
    }
  }
</style>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
    <?php include 'includes/navbar.php'; ?>
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
                            $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/noimage.jpg'; // Cloudinary-hosted default

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
                                                <div class='box-body prod-body'>
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
                                // Close row if not already closed
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
