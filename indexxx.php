<?php include 'includes/session.php'; ?>

<?php
// Render category blocks function
function renderCategoryBlocks($conn) {
    $default_category_image = 'images/noimage.jpg'; // Local fallback image
    $output = '';
    try {
        $stmt = $conn->prepare("SELECT * FROM category LIMIT 6");
        $stmt->execute();
        $categories = $stmt->fetchAll();
        foreach ($categories as $category) {
            $slug = !empty($category['cat_slug']) ? htmlspecialchars($category['cat_slug']) : strtolower(str_replace(' ', '-', $category['name']));
            // Construct image path using category name
            $image_url = 'images/' . strtolower(str_replace(' ', '_', $category['name'])) . '.jpg';
            // Check if the image exists, otherwise use default
            $image_path = __DIR__ . '/' . $image_url;
            $image_url = file_exists($image_path) ? $image_url : $default_category_image;
            $output .= '
                <div class="cat-block">
                    <a href="category.php?category=' . $slug . '">
                        <img src="' . $image_url . '" alt="' . htmlspecialchars($category['name']) . '" loading="lazy">
                        <h3 class="cat-block-title">' . htmlspecialchars($category['name']) . '</h3>
                    </a>
                </div>';
        }
    } catch(PDOException $e) {
        $output .= '<div class="cat-block"><a href="#">Error loading categories</a></div>';
    }
    return $output;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bailord</title>
    <meta name="keywords" content="eCommerce, Bailord, Online Shopping">
    <meta name="description" content="Shop the latest electronics and accessories at Bailord with exclusive deals and discounts.">
    <meta name="author" content="Bailord Team">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="preload" href="assets/css/bootstrap.min.css" as="style">
    <link rel="preload" href="assets/js/jquery.min.js" as="script">
    <link rel="preload" href="assets/js/bootstrap.bundle.min.js" as="script">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <style>
        :root {
            --primary-color: #ff6200;
            --secondary-color: #1a1a1a;
            --accent-color: #ffffff;
            --highlight-color: #ffd700;
            --neutral-light: #f5f5f5;
            --neutral-medium: #e0e0e0;
            --text-dark: #1a1a1a;
            --text-light: #ffffff;
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
        }

        .page-wrapper {
            width: 100%;
            min-height: 100vh;
            position: relative;
        }

        /* Header Styles */
        .header {
            background: var(--gradient);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-middle .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 0;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo img {
            width: 140px;
            height: auto;
        }

        .header-center {
            flex-grow: 2;
            padding: 0 20px;
        }

        .header-search-wrapper {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
        }

        .header-search-wrapper input {
            width: 100%;
            padding: 14px 50px 14px 20px;
            border: 1px solid var(--neutral-medium);
            border-radius: 25px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .header-search-wrapper input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 5px rgba(255, 98, 0, 0.3);
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

        .header-search-wrapper button:hover {
            color: #e64a19;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
            justify-content: flex-end;
        }

        .user-btn, .login-btn {
            padding: 12px 25px;
            background-color: var(--primary-color);
            color: var(--text-light);
            border-radius: 25px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.3s, transform 0.2s;
        }

        .user-btn:hover, .login-btn:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
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
            font-size: 15px;
        }

        .cart-count {
            background: var(--highlight-color);
            color: var(--text-dark);
            border-radius: 50%;
            padding: 4px 10px;
            font-size: 13px;
            font-weight: 600;
        }

        .dropdown-menu {
            background: var(--accent-color);
            border: 1px solid var(--neutral-medium);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 300px;
            padding: 20px;
            margin-top: 10px;
        }

        .dropdown-cart-products .product {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .dropdown-cart-products .product-cart-details {
            flex: 1;
        }

        .dropdown-cart-total {
            display: flex;
            justify-content: space-between;
            margin: 15px 0;
            font-weight: 600;
            font-size: 16px;
        }

        .dropdown-cart-action .btn {
            display: block;
            text-align: center;
            padding: 12px;
            margin: 8px 0;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--text-light);
        }

        .btn-outline-primary {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
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
            gap: 30px;
            margin: 0;
            padding: 15px 0;
            font-size: 16px;
            justify-content: center;
        }

        .main-nav .menu > li {
            position: relative;
        }

        .main-nav .menu > li > a {
            color: var(--text-light);
            font-weight: 600;
            text-decoration: none;
            padding: 10px 15px;
            transition: color 0.3s, background-color 0.3s;
        }

        .main-nav .menu > li:hover > a {
            color: var(--highlight-color);
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .main-nav .menu > li > ul {
            display: none;
            position: absolute;
            background: var(--accent-color);
            border-radius: 8px;
            padding: 15px;
            min-width: 220px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 100;
        }

        .main-nav .menu > li:hover > ul {
            display: block;
        }

        .main-nav .menu > li > ul > li > a {
            color: var(--text-dark);
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .main-nav .menu > li > ul > li > a:hover {
            color: var(--primary-color);
        }

        /* Slider */
        .intro-slider-container {
            margin-bottom: 50px;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 20px;
            position: relative;
        }

        .intro-slider .intro-slide {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .intro-slider .intro-slide img {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 12px;
            image-rendering: -webkit-optimize-contrast;
            filter: brightness(0.95);
        }

        .owl-carousel .owl-nav button {
            background: var(--primary-color);
            color: var(--text-light);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 24px;
            transition: background-color 0.3s;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .owl-carousel .owl-nav .owl-prev {
            left: 20px;
        }

        .owl-carousel .owl-nav .owl-next {
            right: 20px;
        }

        .owl-carousel .owl-nav button:hover {
            background: #e64a19;
        }

        .owl-carousel .owl-dots {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
        }

        .owl-carousel .owl-dot {
            background: var(--neutral-medium);
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 5px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .owl-carousel .owl-dot.active {
            background: var(--primary-color);
        }

        /* Side Promo Banners */
        .side-promo {
            position: fixed;
            top: 20%;
            width: 200px;
            z-index: 999;
            transition: transform 0.3s ease-in-out;
        }

        .side-promo-left {
            left: 20px;
        }

        .side-promo-right {
            right: 20px;
        }

        .side-promo:hover {
            transform: scale(1.05);
        }

        .side-promo .banner {
            background: var(--accent-color);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            text-align: center;
            padding: 20px;
        }

        .side-promo .banner img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .side-promo .banner-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .side-promo .banner-link {
            display: inline-block;
            padding: 10px 20px;
            background: var(--primary-color);
            color: var(--text-light);
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .side-promo .banner-link:hover {
            background: #e64a19;
        }

        /* Categories */
        .cat-blocks-container {
            margin-bottom: 50px;
            padding: 0 20px;
        }

        .cat-blocks-container .row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        .cat-block {
            background: var(--accent-color);
            border-radius: 10px;
            text-align: center;
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 240px;
            min-height: 260px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cat-block:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .cat-block img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .cat-block:hover img {
            transform: scale(1.05);
        }

        .cat-block-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-dark);
            text-transform: capitalize;
            margin: 0;
            padding: 0 10px;
        }

        .cat-block a {
            text-decoration: none;
            color: inherit;
        }

        /* Responsive Adjustments for Categories */
        @media (max-width: 991px) {
            .cat-blocks-container .row {
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            }

            .cat-block {
                max-width: 220px;
                min-height: 240px;
            }

            .cat-block img {
                height: 140px;
            }

            .cat-block-title {
                font-size: 16px;
            }
        }

        @media (max-width: 575px) {
            .cat-blocks-container .row {
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            }

            .cat-block {
                max-width: 180px;
                min-height: 220px;
            }

            .cat-block img {
                height: 120px;
            }

            .cat-block-title {
                font-size: 14px;
            }
        }

        /* Products */
        .products .row {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 30px;
            margin-bottom: 40px;
        }

        .product {
            background: var(--accent-color);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            border: 1px solid var(--neutral-medium);
        }

        .product:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .product-media {
            position: relative;
            overflow: hidden;
        }

        .product-media img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
            image-rendering: -webkit-optimize-contrast;
        }

        .product-label {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--highlight-color);
            color: var(--text-dark);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 600;
        }

        .product-action-vertical, .product-action {
            position: absolute;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .product:hover .product-action-vertical,
        .product:hover .product-action {
            opacity: 1;
        }

        .product-action-vertical {
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .product-action {
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .btn-product-icon, .btn-product {
            background: var(--primary-color);
            color: var(--text-light);
            border-radius: 25px;
            padding: 10px 15px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-product-icon {
            padding: 10px;
        }

        .btn-product-icon:hover, .btn-product:hover {
            background: #e64a19;
        }

        .product-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-title a {
            color: var(--text-dark);
            font-size: 18px;
            font-weight: 600;
            text-decoration: none;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .product-title a:hover {
            color: var(--primary-color);
        }

        .product-price {
            color: var(--primary-color);
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .ratings-container {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--text-dark);
        }

        .ratings-val {
            background: var(--highlight-color);
            height: 10px;
            border-radius: 5px;
        }

        /* Banners */
        .banner {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .banner img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            image-rendering: -webkit-optimize-contrast;
        }

        .banner-content {
            position: absolute;
            top: 50%;
            left: 30px;
            transform: translateY(-50%);
            color: var(--text-light);
            padding: 20px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 8px;
        }

        .banner-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .banner-subtitle {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .banner-link {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 600;
            padding: 12px 25px;
            background: var(--primary-color);
            border-radius: 25px;
            transition: background-color 0.3s;
        }

        .banner-link:hover {
            background: #e64a19;
            color: var(--text-light);
        }

        /* CTA */
        .cta {
            background: var(--gradient);
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            position: relative;
            margin-bottom: 50px;
        }

        .cta-content {
            color: var(--text-light);
        }

        .cta-text p {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .btn-round {
            border-radius: 25px;
            padding: 14px 30px;
            background: var(--accent-color);
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-round:hover {
            background: var(--highlight-color);
            transform: translateY(-2px);
        }

        /* Newsletter Popup */
        .newsletter-popup-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .newsletter-popup-container.show {
            opacity: 1;
            visibility: visible;
        }

        .newsletter-popup-content {
            background: var(--accent-color);
            border-radius: 12px;
            max-width: 500px;
            width: 90%;
            padding: 40px;
            position: relative;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .newsletter-popup-content .logo {
            width: 100px;
            margin-bottom: 20px;
        }

        .newsletter-popup-content .banner-title {
            font-size: 30px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .newsletter-popup-content p {
            font-size: 16px;
            color: var(--text-dark);
            margin-bottom: 20px;
        }

        .newsletter-popup-content .input-group {
            display: flex;
            width: 100%;
            max-width: 400px;
            margin: 0 auto 20px;
        }

        .newsletter-popup-content input {
            flex: 1;
            padding: 14px 20px;
            border: 1px solid var(--neutral-medium);
            border-radius: 25px 0 0 25px;
            font-size: 16px;
            outline: none;
        }

        .newsletter-popup-content .btn {
            padding: 14px 30px;
            border-radius: 0 25px 25px 0;
            background: var(--primary-color);
            color: var(--text-light);
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .newsletter-popup-content .btn:hover {
            background: #e64a19;
        }

        .newsletter-popup-content .custom-control {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            font-size: 14px;
        }

        .newsletter-popup-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--text-dark);
            cursor: pointer;
            transition: color 0.3s;
        }

        .newsletter-popup-close:hover {
            color: var(--primary-color);
        }

        /* Promo Popup */
        .promo-popup-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .promo-popup-container.show {
            opacity: 1;
            visibility: visible;
        }

        .promo-popup-content {
            background: var(--accent-color);
            border-radius: 12px;
            max-width: 600px;
            width: 90%;
            padding: 40px;
            position: relative;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .promo-popup-content img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .promo-popup-content .banner-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .promo-popup-content p {
            font-size: 16px;
            color: var(--text-dark);
            margin-bottom: 20px;
        }

        .promo-popup-content .btn {
            padding: 14px 30px;
            background: var(--primary-color);
            color: var(--text-light);
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .promo-popup-content .btn:hover {
            background: #e64a19;
        }

        .promo-popup-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--text-dark);
            cursor: pointer;
            transition: color 0.3s;
        }

        .promo-popup-close:hover {
            color: var(--primary-color);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Newsletter Popup
            const newsletterPopup = document.querySelector('#newsletter-popup-form');
            const newsletterClose = document.querySelector('.newsletter-popup-close');
            const dontShowAgain = document.querySelector('#register-policy-2');
            const hasSeenNewsletter = localStorage.getItem('newsletterPopupSeen');

            if (newsletterPopup && !hasSeenNewsletter) {
                setTimeout(() => {
                    newsletterPopup.classList.add('show');
                }, 3000);
            }

            if (newsletterClose) {
                newsletterClose.addEventListener('click', () => {
                    newsletterPopup.classList.remove('show');
                    if (dontShowAgain.checked) {
                        localStorage.setItem('newsletterPopupSeen', 'true');
                    }
                });
            }

            // Promo Popups
            const promoPopup = document.querySelector('#promo-popup');
            const promoClose = document.querySelector('.promo-popup-close');
            const hasSeenPromo = localStorage.getItem('promoPopupSeen');

            if (promoPopup && !hasSeenPromo) {
                setTimeout(() => {
                    promoPopup.classList.add('show');
                }, 6000);
            }

            if (promoClose) {
                promoClose.addEventListener('click', () => {
                    promoPopup.classList.remove('show');
                    localStorage.setItem('promoPopupSeen', 'true');
                });
            }

            // Dynamic Promo Banners
            const promoContainer = document.querySelector('.row.promo-banners');
            const promos = [
                {
                    image: 'assets/images/demos/demo-4/banners/banner-1.png',
                    subtitle: 'Smart Offer',
                    title: 'Save ₦150 on Samsung Galaxy Note9',
                    link: 'category.php?category=smartphones'
                },
                {
                    image: 'assets/images/demos/demo-4/banners/banner-2.jpg',
                    subtitle: 'Time Deals',
                    title: 'Bose SoundSport - 30% Off',
                    link: 'category.php?category=audio'
                },
                {
                    image: 'assets/images/demos/demo-4/banners/banner-3.png',
                    subtitle: 'Clearance',
                    title: 'GoPro Fusion 360 - Save ₦70',
                    link: 'category.php?category=cameras'
                }
            ];

            if (promoContainer) {
                promoContainer.innerHTML = promos.map(promo => `
                    <div class="col-md-4">
                        <div class="banner banner-overlay">
                            <a href="${promo.link}">
                                <img src="${promo.image}" alt="Banner" loading="lazy">
                            </a>
                            <div class="banner-content">
                                <h4 class="banner-subtitle">${promo.subtitle}</h4>
                                <h3 class="banner-title">${promo.title}</h3>
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
                    const existingItem = cartItems.find(item => item.slug === slug);
                    if (existingItem) {
                        existingItem.quantity += 1;
                    } else {
                        cartItems.push({ name, price, slug, quantity: 1 });
                    }
                    localStorage.setItem('cartItems', JSON.stringify(cartItems));
                    updateCart();
                });
            });

            updateCart();

            // Lazy Load Images
            document.querySelectorAll('img').forEach(img => {
                img.setAttribute('loading', 'lazy');
            });

            // Smooth Scroll for Anchor Links
            document.querySelectorAll('a[href*="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    if (this.hash !== "") {
                        e.preventDefault();
                        const hash = this.hash;
                        const target = document.querySelector(hash);
                        if (target) {
                            window.scrollTo({
                                top: target.offsetTop - 80,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="page-wrapper">
        <header class="header header-4">
            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <a href="index.php" class="logo">
                            <img src="assets/images/demos/demo-4/logo.png" alt="Bailord Logo" width="140" height="30">
                        </a>
                    </div>
                    <div class="header-center">
                        <div class="header-search header-search-extended">
                            <form action="#" method="get">
                                <div class="header-search-wrapper">
                                    <label for="q" class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Search for products..." required>
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="header-right">
                        <?php if (isset($_SESSION['user'])): ?>
                            <a href="profile.php" class="user-btn" title="User Profile">
                                <i class="fas fa-user"></i> <?php echo htmlspecialchars($user['firstname']); ?>
                            </a>
                            <a href="logout.php" class="user-btn" title="Logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        <?php else: ?>
                            <a href="login.php" class="login-btn">
                                <i class="fas fa-user"></i> Login/Signup
                            </a>
                        <?php endif; ?>
                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
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
                                    <a href="cart_view.php" class="btn btn-outline-primary">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom sticky-header">
                <div class="container">
                    <nav class="main-nav">
                        <ul class="menu">
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="category.php?category=all">Shop</a></li>
                            <li><a href="profile.php">Orders</a></li>
                            <li>
                                <a href="#">Categories</a>
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
                            <li><a href="about.html">About</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main class="main">
            <div class="intro-slider-container">
                <div class="side-promo side-promo-left">
                    <div class="banner">
                        <a href="category.php?category=smartphones">
                            <img src="assets/images/demos/demo-4/banners/banner-1.png" alt="Smartphone Offer" loading="lazy">
                        </a>
                        <h3 class="banner-title">Smartphone Deals</h3>
                        <a href="category.php?category=smartphones" class="banner-link">Shop Now</a>
                    </div>
                </div>
                <div class="side-promo side-promo-right">
                    <div class="banner">
                        <a href="category.php?category=audio">
                            <img src="assets/images/demos/demo-4/banners/banner-2.jpg" alt="Audio Offer" loading="lazy">
                        </a>
                        <h3 class="banner-title">Audio Savings</h3>
                        <a href="category.php?category=audio" class="banner-link">Shop Now</a>
                    </div>
                </div>
                <div class="intro-slider owl-carousel owl-theme owl-nav-inside" data-toggle="owl" 
                    data-owl-options='{
                        "dots": true,
                        "nav": true,
                        "items": 1,
                        "margin": 10,
                        "autoplay": true,
                        "autoplayTimeout": 5000
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
                </div>
            </div>
            <div class="container">
                <h2 class="title text-center mb-4">Explore Popular Categories</h2>
                <div class="cat-blocks-container">
                    <div class="row">
                        <?php
                        $pdo = new Database();
                        $conn = $pdo->open();
                        echo renderCategoryBlocks($conn);
                        $conn = null;
                        ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row promo-banners"></div>
            </div>
            <div class="container new-arrivals">
                <div class="heading heading-flex mb-4">
                    <div class="heading-left">
                        <h2 class="title">New Arrivals</h2>
                    </div>
                    <div class="heading-right">
                        <a href="category.php?category=all" class="title-link">View All <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="products">
                    <div class="row">
                        <?php
                        $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/noimage.jpg';
                        $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 10");
                        $stmt->execute();
                        $products = $stmt->fetchAll();
                        foreach ($products as $product) {
                            $image_url = !empty($product['photo']) 
                                ? htmlspecialchars($product['photo']) 
                                : $default_image;
                            echo '<div>
                                <div class="product">
                                    <figure class="product-media">
                                        <span class="product-label">New</span>
                                        <a href="product.php?product='.htmlspecialchars($product['slug']).'">
                                            <img src="'.$image_url.'" alt="'.htmlspecialchars($product['name']).'" class="product-image">
                                        </a>
                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="fas fa-heart"></i></a>
                                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><i class="fas fa-balance-scale"></i></a>
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
                                </div>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="cta">
                    <div class="cta-content">
                        <div class="cta-text">
                            <p>Exclusive Deals Await! <br><strong>Shop the Latest Tech Today</strong></p>
                        </div>
                        <a href="category.php?category=all" class="btn btn-round"><span>Shop Now</span><i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="container trending-products">
                <div class="heading heading-flex mb-4">
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
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="trending-top-tab" role="tabpanel">
                        <div class="products">
                            <div class="row">
                                <?php
                                $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/noimage.jpg';
                                $stmt = $conn->prepare("SELECT * FROM products ORDER BY counter DESC LIMIT 10");
                                $stmt->execute();
                                $trending = $stmt->fetchAll();
                                foreach ($trending as $product) {
                                    $image_url = !empty($product['photo']) 
                                        ? htmlspecialchars($product['photo']) 
                                        : $default_image;
                                    echo '<div>
                                        <div class="product">
                                            <figure class="product-media">
                                                <span class="product-label">Top</span>
                                                <a href="product.php?product='.htmlspecialchars($product['slug']).'">
                                                    <img src="'.$image_url.'" alt="'.htmlspecialchars($product['name']).'" class="product-image">
                                                </a>
                                                <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="fas fa-heart"></i></a>
                                                    <a href="#" class="btn-product-icon btn-compare" title="Compare"><i class="fas fa-balance-scale"></i></a>
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
                                        </div>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="trending-best-tab" role="tabpanel">
                        <div class="products">
                            <div class="row">
                                <?php
                                $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/noimage.jpg';
                                $stmt = $conn->prepare("SELECT p.* FROM products p JOIN details d ON p.id = d.product_id GROUP BY p.id ORDER BY SUM(d.quantity) DESC LIMIT 10");
                                $stmt->execute();
                                $bestSelling = $stmt->fetchAll();
                                foreach ($bestSelling as $product) {
                                    $image_url = !empty($product['photo']) 
                                        ? htmlspecialchars($product['photo']) 
                                        : $default_image;
                                    echo '<div>
                                        <div class="product">
                                            <figure class="product-media">
                                                <span class="product-label">Best Seller</span>
                                                <a href="product.php?product='.htmlspecialchars($product['slug']).'">
                                                    <img src="'.$image_url.'" alt="'.htmlspecialchars($product['name']).'" class="product-image">
                                                </a>
                                                <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i class="fas fa-heart"></i></a>
                                                    <a href="#" class="btn-product-icon btn-compare" title="Compare"><i class="fas fa-balance-scale"></i></a>
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
                                        </div>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="newsletter-popup-container mfp-hide" id="newsletter-popup-form">
                    <div class="newsletter-popup-content">
                        <button class="newsletter-popup-close"><i class="fas fa-times"></i></button>
                        <img src="assets/images/demos/demo-4/logo.png" class="logo" alt="Bailord Logo" width="100" height="25">
                        <h2 class="banner-title">Get <span>25%</span> Off</h2>
                        <p>Subscribe to Bailord newsletter for exclusive deals and updates!</p>
                        <form action="#">
                            <div class="input-group input-group-round">
                                <input type="email" class="form-control" placeholder="Your Email Address" aria-label="Email Address" required>
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><span>Subscribe</span></button>
                                </div>
                            </div>
                        </form>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="register-policy-2">
                            <label class="custom-control-label" for="register-policy-2">Don't show this again</label>
                        </div>
                    </div>
                </div>
                <div class="promo-popup-container mfp-hide" id="promo-popup">
                    <div class="promo-popup-content">
                        <button class="promo-popup-close"><i class="fas fa-times"></i></button>
                        <img src="assets/images/demos/demo-4/banners/promo-banner.jpg" alt="Promo Banner">
                        <h2 class="banner-title">Flash Sale!</h2>
                        <p>Up to 50% off on selected electronics. Limited time only!</p>
                        <a href="category.php?category=sale" class="btn">Shop Now</a>
                    </div>
                </div>
            </div>
        </main>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/jquery.hoverIntent.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/main.js"></script>
    </div>
</body>
</html>
