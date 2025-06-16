<header class="main-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.png" alt="Bailord Logo" style="height: 50px; display: inline-block;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="las la-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="">ABOUT US</a></li>
                    <li class="nav-item"><a class="nav-link" href="">CONTACT US</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            CATEGORY <span class="caret"><i class="las la-caret-down"></i></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                            <?php
                            $conn = $pdo->open();
                            try {
                                $stmt = $conn->prepare("SELECT * FROM category");
                                $stmt->execute();
                                foreach ($stmt as $row) {
                                    echo '<a class="dropdown-item" href="category.php?category='.htmlspecialchars($row['cat_slug']).'">'.htmlspecialchars($row['name']).'</a>';
                                }
                            } catch(PDOException $e) {
                                echo '<div class="dropdown-item">Error: '.htmlspecialchars($e->getMessage()).'</div>';
                            }
                            $pdo->close();
                            ?>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="POST" action="search.php">
                    <div class="input-group">
                        <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Search for Product" required>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="las la-search"></i></button>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="cartDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="las la-shopping-cart"></i>
                            <span class="badge badge-success cart_count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="cartDropdown">
                            <div class="dropdown-header">You have <span class="cart_count"></span> item(s) in cart</div>
                            <ul class="list-unstyled" id="cart_menu"></ul>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="cart_view.php">Go to Cart</a>
                        </div>
                    </li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <?php $image = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg'; ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo htmlspecialchars($image); ?>" class="user-image rounded-circle" alt="User Image" style="width: 24px; height: 24px; margin-right: 5px;">
                                <span class="d-none d-lg-inline"><?php echo htmlspecialchars($user['firstname'].' '.$user['lastname']); ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <div class="dropdown-header text-center">
                                    <img src="<?php echo htmlspecialchars($image); ?>" class="img-circle" alt="User Image" style="width: 60px; height: 60px;">
                                    <p>
                                        <?php echo htmlspecialchars($user['firstname'].' '.$user['lastname']); ?>
                                        <small>Member since <?php echo date('M. Y', strtotime($user['created_on'])); ?></small>
                                    </p>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="profile.php">Profile</a>
                                <a class="dropdown-item" href="logout.php">Sign out</a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">LOGIN</a></li>
                        <li class="nav-item"><a class="nav-link" href="signup.php">SIGNUP</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<style>
    :root {
        --dominant-color: #3498db;
        --secondary-color: #2ecc71;
        --accent-color: #e67e22;
        --complementary-blue: #1e429f;
        --complementary-orange: #e67700;
        --neutral-light: #f8f9fa;
        --neutral-dark: #343a40;
        --text-color: #333;
        --text-light: #fff;
        --blue-gradient: linear-gradient(135deg, var(--dominant-color) 0%, var(--complementary-blue) 100%);
    }
    .main-header {
        background: var(--blue-gradient);
        color: var(--text-light);
    }
    .navbar {
        background: var(--blue-gradient);
    }
    .navbar-brand img {
        height: 50px;
    }
    .navbar-nav .nav-link {
        color: var(--text-light);
        font-weight: 500;
        padding: 0.5rem 1rem;
    }
    .navbar-nav .nav-link:hover {
        color: var(--accent-color);
    }
    .dropdown-menu {
        background-color: var(--neutral-light);
        border: 1px solid var(--neutral-dark);
    }
    .dropdown-item {
        color: var(--text-color);
    }
    .dropdown-item:hover {
        background-color: var(--neutral-light);
        color: var(--accent-color);
    }
    .form-inline .input-group {
        width: 200px;
    }
    .btn-primary {
        background-color: var(--dominant-color);
        border-color: var(--dominant-color);
    }
    .btn-primary:hover {
        background-color: var(--complementary-blue);
        border-color: var(--complementary-blue);
    }
    .badge-success {
        background-color: var(--secondary-color);
    }
    .user-image {
        vertical-align: middle;
    }
    .dropdown-header {
        padding: 0.5rem 1rem;
        color: var(--text-color);
    }
    .dropdown-divider {
        border-top: 1px solid var(--neutral-dark);
    }
    @media (max-width: 991px) {
        .navbar-collapse {
            background-color: var(--neutral-light);
            padding: 1rem;
        }
        .navbar-nav .nav-link {
            color: var(--text-color);
        }
        .navbar-nav .nav-link:hover {
            color: var(--accent-color);
        }
        .form-inline .input-group {
            width: 100%;
            margin-bottom: 1rem;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure jQuery is available for Bootstrap dropdowns
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is required for Bootstrap dropdowns.');
        }
        // Handle navbar toggle
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('#navbar-collapse');
        if (navbarToggler && navbarCollapse) {
            navbarToggler.addEventListener('click', function(e) {
                navbarCollapse.classList.toggle('show');
            });
        }
    });
</script>
