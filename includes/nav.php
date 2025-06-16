<header class="header header-intro-clearance header-4">
    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
                <a href="index.php" class="logo">
                    <img src="images/logo.png" alt="Bailord Logo" width="105" height="50">
                </a>
            </div>
            <div class="header-center">
                <div class="header-search header-search-extended d-none d-lg-block">
                    <form action="search.php" method="POST">
                        <div class="header-search-wrapper">
                            <label for="navbar-search-input" class="sr-only">Search</label>
                            <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Search for Product" required>
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
                    <?php $image = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg'; ?>
                    <a href="profile.php" class="user-btn" title="User Profile">
                        <img src="<?php echo $image; ?>" class="user-image" alt="User Image" style="width: 24px; height: 24px; border-radius: 50%; margin-right: 5px;">
                        <?php echo htmlspecialchars($user['firstname'].' '.$user['lastname']); ?>
                    </a>
                    <a href="logout.php" class="user-btn" title="Logout">
                        <i class="las la-sign-out-alt"></i> Sign out
                    </a>
                <?php else: ?>
                    <a href="login.php" class="login-btn">
                        <i class="icon-user"></i> Login
                    </a>
                    <a href="signup.php" class="login-btn">
                        <i class="icon-user"></i> Signup
                    </a>
                <?php endif; ?>
                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count label label-success"></span>
                        </div>
                        <p>Cart</p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">
                            <ul class="menu" id="cart_menu"></ul>
                        </div>
                        <div class="dropdown-cart-total">
                            <span>You have <span class="cart_count"></span> item(s) in cart</span>
                        </div>
                        <div class="dropdown-cart-action">
                            <a href="cart_view.php" class="btn btn-primary">Go to Cart</a>
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
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="">ABOUT US</a></li>
                    <li><a href="">CONTACT US</a></li>
                    <li>
                        <a href="#">CATEGORY</a>
                        <ul>
                            <?php
                            $conn = $pdo->open();
                            try {
                                $stmt = $conn->prepare("SELECT * FROM category");
                                $stmt->execute();
                                foreach ($stmt as $row) {
                                    echo '<li><a href="category.php?category='.$row['cat_slug'].'">'.$row['name'].'</a></li>';
                                }
                            } catch(PDOException $e) {
                                echo "<li><a href='#'>There is some problem in connection: ".$e->getMessage()."</a></li>";
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
                <input type="text" class="form-control" name="keyword" id="mobile-search" placeholder="Search for Product" required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="">ABOUT US</a></li>
                    <li><a href="">CONTACT US</a></li>
                    <li>
                        <a href="#">CATEGORY</a>
                        <ul>
                            <?php
                            $conn = $pdo->open();
                            try {
                                $stmt = $conn->prepare("SELECT * FROM category");
                                $stmt->execute();
                                foreach ($stmt as $row) {
                                    echo '<li><a href="category.php?category='.$row['cat_slug'].'">'.$row['name'].'</a></li>';
                                }
                            } catch(PDOException $e) {
                                echo "<li><a href='#'>There is some problem in connection: ".$e->getMessage()."</a></li>";
                            }
                            $pdo->close();
                            ?>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
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
    .header {
        background: var(--blue-gradient);
        color: var(--text-light);
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
    .btn, .dropdown-toggle, .mobile-menu-toggler, 
    .mobile-search-toggle {
        min-height: 44px;
        min-width: 44px;
        position: relative;
    }
    .btn-product-icon:before, 
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
    @media (max-width: 767px) {
        .header-right.d-none.d-lg-block {
            display: none !important;
        }
        .logo img {
            width: 80px;
            height: auto;
        }
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
