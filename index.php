<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Log errors to a file
ini_set('log_errors', 1);
ini_set('error_log', 'logs/php_errors.log');

// Include session file with error handling
if (file_exists('includes/session.php')) {
    include 'includes/session.php';
} else {
    error_log("session.php not found in includes directory");
    // Start a basic session as fallback
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Bailord</title>
    <meta name="keywords" content="eCommerce, Bailord, Online Shopping">
    <meta name="description" content="Shop the latest electronics and accessories at Bailord with exclusive deals and discounts.">
    <meta name="author" content="Bailord Team">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x16" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.webmanifest">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#007BFF">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Bailord">
    <meta name="application-name" content="Bailord">
    <meta name="msapplication-TileColor" content="#007BFF">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#007BFF">
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
            --primary-color: #007BFF;
            --secondary-color: #1a1a1a;
            --accent-color: #ffffff;
            --highlight-color: #ffd700;
            --neutral-light: #f5f5f5;
            --neutral-medium: #e0e0e0;
            --text-dark: #1a1a1a;
            --text-light: #ffffff;
            --gradient: linear-gradient(135deg, var(--primary-color) 0%, #0056b3 100%);
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
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
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
            padding: 10px 15px;
            flex-wrap: wrap;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            width: 120px;
            height: auto;
        }

        .header-center {
            flex-grow: 1;
            padding: 10px;
            width: 100%;
            order: 3;
        }

        .header-search-wrapper {
            position: relative;
            max-width: 100%;
        }

        .header-search-wrapper input {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border: 1px solid var(--neutral-medium);
            border-radius: 25px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .header-search-wrapper input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .header-search-wrapper button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: var(--primary-color);
            font-size: 18px;
            cursor: pointer;
        }

        .header-search-wrapper button:hover {
            color: #0056b3;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 10px;
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
            transition: background-color 0.3s, transform 0.2s;
            white-space: nowrap;
        }

        .user-btn:hover, .login-btn:hover {
            background-color: #0056b3;
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
            font-size: 14px;
        }

        .cart-count {
            background: var(--highlight-color);
            color: var(--text-dark);
            border-radius: 50%;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .dropdown-menu {
            background: var(--accent-color);
            border: 1px solid var(--neutral-medium);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 280px;
            padding: 15px;
            margin-top: 8px;
        }

        .dropdown-cart-products .product {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .dropdown-cart-total {
            display: flex;
            justify-content: space-between;
            margin: 12px 0;
            font-weight: 600;
            font-size: 14px;
        }

        .dropdown-cart-action .btn {
            display: block;
            text-align: center;
            padding: 10px;
            margin: 6px 0;
            border-radius:25px;
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
            background-color: #0056b3;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: var(--text-light);
        }

        /* Navigation */
        .main-nav {
            display: none;
        }

        .main-nav.active {
            display: block;
        }

        .main-nav .menu {
            list-style: none;
            margin: 0;
            padding: 10px 0;
            font-size: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .main-nav .menu > li {
            position: relative;
            width: 100%;
            text-align: center;
        }

        .main-nav .menu > li > a {
            color: var(--text-light);
            font-weight: 600;
            text-decoration: none;
            padding: 10px;
            display: block;
            transition: color 0.3s, background-color 0.3s;
        }

        .main-nav .menu > li:hover > a {
            color: var(--highlight-color);
            background-color: rgba(255, 255, 255, 0.1);
        }

        .main-nav .menu > li > ul {
            display: none;
            background: var(--accent-color);
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .main-nav .menu > li:hover > ul,
        .main-nav .menu > li.active > ul {
            display: block;
        }

        .main-nav .menu > li > ul > li > a {
            color: var(--text-dark);
            padding: 8px 10px;
            display: block;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s;
        }

        .main-nav .menu > li > ul > li > a:hover {
            color: var(--primary-color);
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            color: var(--text-light);
            background: none;
            border: none;
            cursor: pointer;
        }

        /* Slider */
        .intro-slider-container {
            margin-bottom: 30px;
            padding: 0 15px;
            position: relative;
        }

        .slider-wrapper {
            max-width: 100%;
            margin: 0 auto;
        }

        .intro-slider .intro-slide {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .intro-slider .intro-slide img {
            width: 100%;
            max-height: 300px;
            object MOUSEOVER cursor: pointer;
            object-fit: cover;
            border-radius: 8px;
            image-rendering: -webkit-optimize-contrast;
            filter: brightness(0.95);
        }

        .owl-carousel .owl-nav button {
            background: var(--primary-color);
            color: var(--text-light);
            width: 40px;
            height: 40px;
            font-size: 20px;
            transition: background-color 0.3s;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .owl-carousel .owl-nav .owl-prev {
            left: 10px;
        }

        .owl-carousel .owl-nav .owl-next {
            right: 10px;
        }

        .owl-carousel .owl-nav button:hover {
            background: #0056b3;
        }

        .owl-carousel .owl-dots {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
        }

        .owl-carousel .owl-dot {
            background: var(--neutral-medium);
            width: 10px;
            height: 10px;
            margin: 0 4px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .owl-carousel .owl-dot.active {
            background: var(--primary-color);
        }

        /* Hide navigation arrows on mobile */
        @media (max-width: 767px) {
            .owl-carousel .owl-nav {
                display: none;
            }
        }

        /* Side Promo Banners */
        .side-promo {
            display: none;
        }

        /* Categories */
        .cat-blocks-container {
            margin-bottom: 30px;
            padding: 0 15px;
        }

        .cat-blocks-container .row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 15px;
            justify-items: center;
        }

        .cat-block {
            background: var(--accent-color);
            border-radius: 8px;
            text-align: center;
            padding: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid var(--neutral-medium);
            width: 100%;
            max-width: 180px;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .cat-block:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .cat-block img {
            width: 100%;
            max-height: 100px;
            object-fit: contain;
            border-radius: 6px;
            margin-bottom: 8px;
            transition: transform 0.3s ease;
        }

        .cat-block:hover img {
            transform: scale(1.05);
        }

        .cat-block-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            text-transform: capitalize;
            margin: 0;
            padding: 0 8px;
            line-height: 1.4;
            word-wrap: break-word;
        }

        .cat-block-link {
            display: inline-block;
            padding: 6px 12px;
            background: var(--primary-color);
            color: var(--text-light);
            text-decoration: none;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            margin-top: 8px;
            transition: background-color 0.3s;
        }

        .cat-block-link:hover {
            background: #0056b3;
        }

        /* Products */
        .products .row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .product {
            background: var(--accent-color);
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            border: 1px solid var(--neutral-medium);
        }

        .product:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .product-media {
            position: relative;
            overflow: hidden;
        }

        .product-media img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
            image-rendering: -webkit-optimize-contrast;
        }

        .product-label {
            position: absolute;
            top: 8px;
            left: 8px;
            background: var(--highlight-color);
            color: var(--text-dark);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .product-action-vertical, .product-action {
            position: absolute;
            opacity: 1;
            transition: opacity 0.3s;
        }

        .product-action-vertical {
            top: 8px;
            right: 8px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .product-action {
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
        }

        .btn-product-icon, .btn-product {
            background: var(--primary-color);
            color: var(--text-light);
            border-radius: 20px;
            padding: 8px 12px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-product-icon {
            padding: 8px;
        }

        .btn-product-icon:hover, .btn-product:hover {
            background: #0056b3;
        }

        .product-body {
            padding: 15px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-title a {
            color: var(--text-dark);
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .product-title a:hover {
            color: var(--primary-color);
        }

        .product-price {
            color: var(--primary-color);
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .ratings-container {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--text-dark);
        }

        .ratings-val {
            background: var(--highlight-color);
            height: 8px;
            border-radius: 4px;
        }

        /* Banners */
        .banner {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .banner img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            image-rendering: -webkit-optimize-contrast;
        }

        .banner-content {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: var(--text-light);
            padding: 15px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 6px;
        }

        .banner-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .banner-subtitle {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .banner-link {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 600;
            padding: 10px 20px;
            background: var(--primary-color);
            border-radius: 20px;
            transition: background-color 0.3s;
        }

        .banner-link:hover {
            background: #0056b3;
        }

        /* CTA */
        .cta {
            background: var(--gradient);
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            position: relative;
            margin-bottom: 30px;
        }

        .cta-content {
            color: var(--text-light);
        }

        .cta-text p {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .btn-round {
            border-radius: 20px;
            padding: 12px 25px;
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
            border-radius: 8px;
            max-width: 90%;
            width: 320px;
            padding: 20px;
            position: relative;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .newsletter-popup-content .logo {
            width: 80px;
            margin-bottom: 15px;
        }

        .newsletter-popup-content .banner-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .newsletter-popup-content p {
            font-size: 14px;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        .newsletter-popup-content .input-group {
            display: flex;
            width: 100%;
            margin: 0 auto 15px;
        }

        .newsletter-popup-content input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid var(--neutral-medium);
            border-radius: 20px 0 0 20px;
            font-size: 14px;
            outline: none;
        }

        .newsletter-popup-content .btn {
            padding: 12px 20px;
            border-radius: 0 20px 20px 0;
            background: var(--primary-color);
            color: var(--text-light);
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .newsletter-popup-content .btn:hover {
            background: #0056b3;
        }

        .newsletter-popup-content .custom-control {
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
            font-size: 12px;
        }

        .newsletter-popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 20px;
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
            border-radius: 8px;
            max-width: 90%;
            width: 320px;
            padding: 20px;
            position: relative;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .promo-popup-content img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .promo-popup-content .banner-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .promo-popup-content p {
            font-size: 14px;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        .promo-popup-content .btn {
            padding: 12px 20px;
            background: var(--primary-color);
            color: var(--text-light);
            border-radius: 20px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .promo-popup-content .btn:hover {
            background: #0056b3;
        }

        .promo-popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 20px;
            color: var(--text-dark);
            cursor: pointer;
            transition: color 0.3s;
        }

        .promo-popup-close:hover {
            color: var(--primary-color);
        }

        /* Responsive Adjustments */
        @media (min-width: 768px) {
            .header-middle .container {
                flex-wrap: nowrap;
            }

            .header-center {
                order: 2;
                width: auto;
                padding: 0 20px;
            }

            .logo img {
                width: 140px;
            }

            .menu-toggle {
                display: none;
            }

            .main-nav {
                display: block;
            }

            .main-nav .menu {
                flex-direction: row;
                justify-content: center;
                gap: 20px;
            }

            .main-nav .menu > li {
                width: auto;
            }

            .main-nav .menu > li > ul {
                position: absolute;
                width: 200px;
            }

            .slider-wrapper {
                max-width: 810px;
                margin: 0 auto;
            }

            .intro-slider .intro-slide img {
                max-height: 120px;
            }

            .cat-blocks-container .row {
                grid-template-columns: repeat(6, 1fr);
            }

            .cat-block {
                max-width: 200px;
                min-height: 240px;
            }

            .cat-block img {
                max-height: 140px;
            }

            .cat-block-title {
                font-size: 16px;
            }

            .products .row {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .product-media img {
                height: 250px;
            }

            .banner img {
                height: 300px;
            }

            .side-promo {
                display: block;
                position: fixed;
                top: 20%;
                width: 180px;
                z-index: 999;
                transition: transform 0.3s ease-in-out;
            }

            .side-promo-left {
                left: 15px;
            }

            .side-promo-right {
                right: 15px;
            }

            .side-promo:hover {
                transform: scale(1.05);
            }

            .side-promo .banner {
                background: var(--accent-color);
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                overflow: hidden;
                text-align: center;
                padding: 15px;
            }

            .side-promo .banner img {
                width: 100%;
                height: 120px;
                object-fit: cover;
                border-radius: 6px;
                margin-bottom: 10px;
            }

            .side-promo .banner-title {
                font-size: 18px;
                font-weight: 700;
                color: var(--primary-color);
                margin-bottom: 8px;
            }

            .side-promo .banner-link {
                padding: 8px 15px;
                background: var(--primary-color);
                color: var(--text-light);
                border-radius: 20px;
                font-weight: 600;
                font-size: 12px;
            }

            .side-promo .banner-link:hover {
                background: #0056b3;
            }

            .newsletter-popup-content {
                max-width: 500px;
                padding: 30px;
            }

            .promo-popup-content {
                max-width: 600px;
                padding: 30px;
            }
        }

        @media (max-width: 767px) {
            .menu-toggle {
                display: block;
            }

            .intro-slider .intro-slide img {
                max-height: 300px;
            }

            .cat-blocks-container .row {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            }

            .cat-block {
                max-width: 160px;
                min-height: 180px;
            }

            .cat-block img {
                max-height: 80px;
            }

            .cat-block-title {
                font-size: 13px;
            }

            .products .row {
                grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            }

            .product-media img {
                height: 180px;
            }

            .banner img {
                height: 150px;
            }

            .cta-text p {
                font-size: 18px;
            }

            .owl-carousel .owl-nav {
                display: none;
            }
        }

        /* Error Message Styling */
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin: 15px;
            border-radius: 8px;
            text-align: center;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menu Toggle
            const menuToggle = document.querySelector('.menu-toggle');
            const mainNav = document.querySelector('.main-nav');
            if (menuToggle && mainNav) {
                menuToggle.addEventListener('click', () => {
                    mainNav.classList.toggle('active');
                });
            }

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
                    if (dontShowAgain && dontShowAgain.checked) {
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
                    <div class="col-12 col-md-4">
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
                if (cartCount && cartTotalPrice && cartProducts) {
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
            }

            document.querySelectorAll('.btn-cart').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const product = this.closest('.product');
                    if (product) {
                        const name = product.querySelector('.product-title a')?.textContent || 'Unknown Product';
                        const priceText = product.querySelector('.product-price')?.textContent || '₦0.00';
                        const price = parseFloat(priceText.replace('₦', '')) || 0;
                        const slug = product.querySelector('.product-title a')?.getAttribute('href')?.split('=')[1] || 'unknown';
                        const existingItem = cartItems.find(item => item.slug === slug);
                        if (existingItem) {
                            existingItem.quantity += 1;
                        } else {
                            cartItems.push({ name, price, slug, quantity: 1 });
                        }
                        localStorage.setItem('cartItems', JSON.stringify(cartItems));
                        updateCart();
                    }
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
                                top: target.offsetTop - 60,
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
                        <button class="menu-toggle"><i class="fas fa-bars"></i></button>
                        <a href="index.php" class="logo">
                            <?php if (file_exists('assets/images/demos/demo-4/logo.png')): ?>
                                <img src="assets/images/demos/demo-4/logo.png" alt="Bailord Logo" width="120" height="25">
                            <?php else: ?>
                                <span class="error-message">Logo image not found</span>
                            <?php endif; ?>
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
                        <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['firstname'])): ?>
                            <a href="profile.php" class="user-btn" title="User Profile">
                                <i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['user']['firstname']); ?>
                            </a>
                            <a href="logout.php" class="user-btn" title="Logout">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        <?php else: ?>
                            <a href="login.php" class="login-btn">
                                <i class="fas fa-user"></i>
                            </a>
                        <?php endif; ?>
                        <div class="dropdown cart-dropdown">
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
                                    try {
                                        $pdo = new Database();
                                        $conn = $pdo->open();
                                        if ($conn) {
                                            $stmt = $conn->prepare("SELECT * FROM category");
                                            $stmt->execute();
                                            $categories = $stmt->fetchAll();
                                            if ($categories) {
                                                foreach ($categories as $category) {
                                                    $slug = !empty($category['cat_slug']) ? $category['cat_slug'] : strtolower(str_replace(' ', '-', $category['name']));
                                                    echo '<li><a href="category.php?category='.htmlspecialchars($slug).'">'.htmlspecialchars($category['name']).'</a></li>';
                                                }
                                            } else {
                                                echo '<li><a href="#">No categories found</a></li>';
                                            }
                                        } else {
                                            echo '<li><a href="#">Database connection failed</a></li>';
                                            error_log("Database connection failed in category fetch");
                                        }
                                    } catch(PDOException $e) {
                                        error_log("Category fetch error: " . $e->getMessage());
                                        echo '<li><a href="#">Error loading categories</a></li>';
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
                            <?php if (file_exists('assets/images/demos/demo-4/banners/banner-1.png')): ?>
                                <img src="assets/images/demos/demo-4/banners/banner-1.png" alt="Smartphone Offer" loading="lazy">
                            <?php else: ?>
                                <span class="error-message">Banner image not found</span>
                            <?php endif; ?>
                        </a>
                        <h3 class="banner-title">Smartphone Deals</h3>
                        <a href="category.php?category=smartphones" class="banner-link">Shop Now</a>
                    </div>
                </div>
                <div class="side-promo side-promo-right">
                    <div class="banner">
                        <a href="category.php?category=audio">
                            <?php if (file_exists('assets/images/demos/demo-4/banners/banner-2.jpg')): ?>
                                <img src="assets/images/demos/demo-4/banners/banner-2.jpg" alt="Audio Offer" loading="lazy">
                            <?php else: ?>
                                <span class="error-message">Banner image not found</span>
                            <?php endif; ?>
                        </a>
                        <h3 class="banner-title">Audio Savings</h3>
                        <a href="category.php?category=audio" class="banner-link">Shop Now</a>
                    </div>
                </div>
                <div class="slider-wrapper">
                    <div class="intro-slider owl-carousel owl-theme owl-nav-inside" data-toggle="owl" 
                        data-owl-options='{
                            "dots": true,
                            "items": 1,
                            "margin": 10,
                            "autoplay": true,
                            "autoplayTimeout": 5000,
                            "responsive": {
                                "0": {
                                    "nav": false
                                },
                                "768": {
                                    "nav": true
                                }
                            }
                        }'>
                        <?php
                        $slides = [
                            ['src' => 'assets/images/demos/demo-4/slider/slider1.png', 'alt' => 'ITEL P70'],
                            ['src' => 'assets/images/demos/demo-4/slider/slider2.png', 'alt' => 'TECNO POP 10C'],
                            ['src' => 'assets/images/demos/demo-4/slider/slider3.png', 'alt' => 'TECNO POP 10'],
                            ['src' => 'assets/images/demos/demo-4/slider/slider4.png', 'alt' => 'TECNO POP 10'],
                            ['src' => 'assets/images/demos/demo-4/slider/slider5.png', 'alt' => 'TECNO POP 10']
                        ];
                        foreach ($slides as $slide) {
                            if (file_exists($slide['src'])) {
                                echo '<div class="intro-slide"><img src="'.htmlspecialchars($slide['src']).'" alt="'.htmlspecialchars($slide['alt']).'"></div>';
                            } else {
                                echo '<div class="intro-slide"><span class="error-message">Slider image not found: '.htmlspecialchars($slide['alt']).'</span></div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <h2 class="title text-center mb-4">Explore Popular Categories</h2>
                <div class="cat-blocks-container">
                    <div class="row">
                        <?php
                        $default_image = 'images/category-default.jpg';
                        try {
                            if ($conn) {
                                $stmt = $conn->prepare("SELECT * FROM category");
                                $stmt->execute();
                                $categories = $stmt->fetchAll();
                                if ($categories) {
                                    foreach ($categories as $category) {
                                        $slug = !empty($category['cat_slug']) ? $category['cat_slug'] : strtolower(str_replace(' ', '-', $category['name']));
                                        $image_name = $slug . '.jpg';
                                        $image_path = file_exists('images/' . $image_name) ? 'images/' . $image_name : 'images/' . $default_image;
                                        if (!file_exists($image_path)) {
                                            $image_path = $default_image;
                                            error_log("Category image not found: images/$image_name");
                                        }
                                        echo '<div class="cat-block">
                                            <a href="category.php?category='.htmlspecialchars($slug).'">
                                                <img src="'.htmlspecialchars($image_path).'" alt="'.htmlspecialchars($category['name']).'" loading="lazy">
                                                <h3 class="cat-block-title">'.htmlspecialchars($category['name']).'</h3>
                                                <span class="cat-block-link">Shop Now</span>
                                            </a>
                                        </div>';
                                    }
                                } else {
                                    echo '<div class="cat-block"><a href="#">No categories found</a></div>';
                                }
                            } else {
                                echo '<div class="error-message">Unable to connect to database for categories</div>';
                            }
                        } catch(PDOException $e) {
                            error_log("Category fetch error: " . $e->getMessage());
                            echo '<div class="error-message">Error loading categories: ' . htmlspecialchars($e->getMessage()) . '</div>';
                        }
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
                        try {
                            if ($conn) {
                                $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 10");
                                $stmt->execute();
                                $products = $stmt->fetchAll();
                                if ($products) {
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
                                } else {
                                    echo '<div class="error-message">No new products found</div>';
                                }
                            } else {
                                echo '<div class="error-message">Unable to connect to database for products</div>';
                            }
                        } catch(PDOException $e) {
                            error_log("Product fetch error: " . $e->getMessage());
                            echo '<div class="error-message">Error loading products: ' . htmlspecialchars($e->getMessage()) . '</div>';
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
                                try {
                                    if ($conn) {
                                        $stmt = $conn->prepare("SELECT * FROM products ORDER BY counter DESC LIMIT 10");
                                        $stmt->execute();
                                        $trending = $stmt->fetchAll();
                                        if ($trending) {
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
                                        } else {
                                            echo '<div class="error-message">No trending products found</div>';
                                        }
                                    } else {
                                        echo '<div class="error-message">Unable to connect to database for trending products</div>';
                                    }
                                } catch(PDOException $e) {
                                    error_log("Trending products fetch error: " . $e->getMessage());
                                    echo '<div class="error-message">Error loading trending products: ' . htmlspecialchars($e->getMessage()) . '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="trending-best-tab" role="tabpanel">
                        <div class="products">
                            <div class="row">
                                <?php
                                try {
                                    if ($conn) {
                                        $stmt = $conn->prepare("SELECT p.* FROM products p JOIN details d ON p.id = d.product_id GROUP BY p.id ORDER BY SUM(d.quantity) DESC LIMIT 10");
                                        $stmt->execute();
                                        $bestSelling = $stmt->fetchAll();
                                        if ($bestSelling) {
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
                                        } else {
                                            echo '<div class="error-message">No best-selling products found</div>';
                                        }
                                    } else {
                                        echo '<div class="error-message">Unable to connect to database for best-selling products</div>';
                                    }
                                } catch(PDOException $e) {
                                    error_log("Best-selling products fetch error: " . $e->getMessage());
                                    echo '<div class="error-message">Error loading best-selling products: ' . htmlspecialchars($e->getMessage()) . '</div>';
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
                        <?php if (file_exists('assets/images/demos/demo-4/banners/promo-banner.jpg')): ?>
                            <img src="assets/images/demos/demo-4/banners/promo-banner.jpg" alt="Promo Banner">
                        <?php else: ?>
                            <span class="error-message">Promo banner image not found</span>
                        <?php endif; ?>
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
