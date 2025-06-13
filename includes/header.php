<?php include 'includes/session.php'; ?>
<header class="header header-4">
    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="las la-bars"></i>
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
                            <button class="btn btn-primary" type="submit"><i class="las la-search"></i></button>
                        </div>
                    </form>
                </div>
                <a href="#" class="search-toggle mobile-search-toggle d-lg-none" role="button">
                    <i class="las la-search"></i>
                </a>
            </div>
            <div class="header-right">
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="profile.php" class="user-btn" title="User Profile">
                        <i class="las la-user"></i> <?php echo htmlspecialchars($user['firstname']); ?>
                    </a>
                    <a href="logout.php" class="user-btn" title="Logout">
                        <i class="las la-sign-out-alt"></i> Logout
                    </a>
                <?php else: ?>
                    <a href="login.php" class="login-btn">
                        <i class="las la-user"></i> Login/Signup
                    </a>
                <?php endif; ?>
                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="icon">
                            <i class="las la-shopping-cart"></i>
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
                            $conn = $pdo->close();
                            ?>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="las la-times"></i></span>
            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search..." required>
                <button class="btn btn-primary" type="submit"><i class="las la-search"></i></button>
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
                            $conn = $pdo->close();
                            ?>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
