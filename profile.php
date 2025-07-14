<?php include 'includes/session.php'; ?>
<?php
    if (!isset($_SESSION['user'])) {
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        /* CSS remains unchanged */
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
            --text-light: #000000;
            --blue-gradient: linear-gradient(135deg, var(--dominant-color) 0%, var(--complementary-blue) 100%);
            --green-gradient: linear-gradient(135deg, var(--secondary-color) 0%, #1e7e34 100%);
        }
        body {
            background-color: var(--light-neutral);
            color: var(--text-dark);
            font-family: 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            margin: 0;
        }
        /* ... Rest of the CSS remains unchanged ... */
    </style>
    <script>
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
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
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
            const editButton = document.querySelector('.edit-profile-btn');
            const editForm = document.querySelector('.edit-form');
            const cancelButton = document.querySelector('.edit-form .btn-default');
            if (editButton && editForm) {
                editButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    editForm.style.display = editForm.style.display === 'block' ? 'none' : 'block';
                });
            }
            if (cancelButton && editForm) {
                cancelButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    editForm.style.display = 'none';
                });
            }
        });
    </script>
</head>
<body class="hold-transition skin-blue layout-top-nav">
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
                        <form action="search.php" method="POST">
                            <div class="header-search-wrapper">
                                <label for="q" class="sr-only">Search</label>
                                <input type="search" class="form-control" name="keyword" id="q" placeholder="Search product..." required>
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
                            <p>Cart</p>
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
                        <?php
                            if (isset($_SESSION['error'])) {
                                echo "<div class='callout callout-danger'>".htmlspecialchars($_SESSION['error'])."</div>";
                                unset($_SESSION['error']);
                            }
                            if (isset($_SESSION['success'])) {
                                echo "<div class='callout callout-success'>".htmlspecialchars($_SESSION['success'])."</div>";
                                unset($_SESSION['success']);
                            }
                        ?>
                        <div class="box box-solid">
                            <div class="box-body">
                                <div class="col-sm-3">
                                    <img src="<?php echo (!empty($user['photo']) && file_exists('images/'.htmlspecialchars($user['photo']))) ? 'images/'.htmlspecialchars($user['photo']) : 'images/profile.jpg'; ?>" width="100%" alt="Profile Photo">
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h4>Name:</h4>
                                            <h4>Email:</h4>
                                            <h4>Contact Info:</h4>
                                            <h4>Address:</h4>
                                            <h4>Member Since:</h4>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4><?php echo htmlspecialchars($user['firstname'].' '.$user['lastname']); ?>
                                                <span class="pull-right">
                                                    <a href="#" class="btn btn-success btn-flat btn-sm edit-profile-btn"><i class="fa fa-edit"></i> Edit</a>
                                                </span>
                                            </h4>
                                            <h4><?php echo htmlspecialchars($user['email']); ?></h4>
                                            <h4><?php echo (!empty($user['contact_info'])) ? htmlspecialchars($user['contact_info']) : 'N/a'; ?></h4>
                                            <h4><?php echo (!empty($user['address'])) ? htmlspecialchars($user['address']) : 'N/a'; ?></h4>
                                            <h4><?php echo date('M d, Y', strtotime($user['created_on'])); ?></h4>
                                        </div>
                                    </div>
                                    <div class="edit-form" style="display: none;">
                                        <form class="form-horizontal" method="POST" action="profile_edit.php" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-sm-3 control-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="col-sm-3 control-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="contact" class="col-sm-3 control-label">Contact Info</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($user['contact_info']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="address" class="col-sm-3 control-label">Address</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" id="address" name="address"><?php echo htmlspecialchars($user['address']); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="photo" class="col-sm-3 control-label">Photo</label>
                                                <div class="col-sm-9">
                                                    <input type="file" id="photo" name="photo" accept="image/*">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label for="curr_password" class="col-sm-3 control-label">Current Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="curr_password" name="curr_password" placeholder="Input current password to save changes" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
                                                    <button type="button" class="btn btn-default btn-flat">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-calendar"></i> <b>Transaction History</b></h4>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th class="hidden"></th>
                                                <th>Date</th>
                                                <th>Transaction#</th>
                                                <th>Amount</th>
                                                <th>Full Details</th>
                                                <th>Track Order</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $conn = $pdo->open();
                                            $total_entries = 0;
                                            try {
                                                $stmt = $conn->prepare("SELECT COUNT(*) as total FROM sales WHERE user_id=:user_id");
                                                $stmt->execute(['user_id' => $user['id']]);
                                                $total_entries = $stmt->fetch()['total'];
                                                
                                                $stmt = $conn->prepare("SELECT sales.*, delivery_tasks.unique_order_id, delivery_tasks.tracking_link FROM sales LEFT JOIN delivery_tasks ON sales.id = delivery_tasks.sales_id WHERE sales.user_id=:user_id ORDER BY sales.sales_date DESC");
                                                $stmt->execute(['user_id' => $user['id']]);
                                                $current_entries = $stmt->rowCount();
                                                foreach ($stmt as $row) {
                                                    $stmt2 = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE sales_id=:id");
                                                    $stmt2->execute(['id' => $row['id']]);
                                                    $total = 0;
                                                    foreach ($stmt2 as $row2) {
                                                        $subtotal = $row2['price'] * $row2['quantity'];
                                                        $total += $subtotal;
                                                    }
                                                    echo "
                                                        <tr>
                                                            <td class='hidden'></td>
                                                            <td data-label='Date'>".date('M d, Y', strtotime($row['sales_date']))."</td>
                                                            <td data-label='Transaction#'>".htmlspecialchars($row['pay_id'])."</td>
                                                            <td data-label='Amount'>$ ".number_format($total, 2)."</td>
                                                            <td data-label='Details'><button class='btn btn-sm btn-flat btn-info transact' data-id='".htmlspecialchars($row['id'])."'><i class='fa fa-search'></i> View</button></td>
                                                            <td data-label='Track Order'><button class='btn btn-sm btn-flat btn-warning track-order' data-id='".htmlspecialchars($row['id'])."' data-unique-order-id='".htmlspecialchars($row['unique_order_id'] ?? '')."' data-tracking-link='".htmlspecialchars($row['tracking_link'] ?? '')."'><i class='fa fa-map-marker'></i> Track</button></td>
                                                        </tr>
                                                    ";
                                                }
                                            } catch (PDOException $e) {
                                                echo "<tr><td colspan='6'>There is some problem in connection: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                                            }
                                            $pdo->close();
                                        ?>
                                        </tbody>
                                    </table>
                                    <div class="dataTables_info">Showing 1 to <?php echo $current_entries; ?> of <?php echo $total_entries; ?> entries</div>
                                    <div class="dataTables_paginate">
                                        <a class="paginate_button previous disabled" href="#">Previous</a>
                                        <a class="paginate_button next" href="#">Next</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <?php include 'includes/sidebar.php'; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/profile_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
    // Disable CKEditor to prevent initialization errors
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR = null;
    }

    $(document).on('click', '.transact', function(e){
        e.preventDefault();
        $('#transaction').modal('show');
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'transaction.php',
            data: {id: id},
            dataType: 'json',
            success: function(response){
                if (response.error) {
                    alert('Error: ' + response.error);
                    return;
                }
                $('#date').html(response.date);
                $('#transid').html(response.transaction);
                $('#detail').prepend(response.list);
                $('#total').html(response.total);
            },
            error: function(xhr, status, error) {
                console.error('Transaction fetch error:', xhr.responseText);
                alert('Failed to load transaction details: ' + error);
            }
        });
    });

    $(document).on('click', '.track-order', function(e){
        e.preventDefault();
        $('#trackOrder').modal('show');
        var id = $(this).data('id');
        var uniqueOrderId = $(this).data('unique-order-id');
        var trackingLink = $(this).data('tracking-link');
        $.ajax({
            type: 'POST',
            url: 'track_order.php',
            data: {id: id, unique_order_id: uniqueOrderId},
            dataType: 'json',
            success: function(response){
                if (response.success) {
                    $('#track_order_id').html(response.unique_order_id);
                    $('#track_link').html('<a href="' + response.tracking_link + '" target="_blank">View Tracking</a>');
                    $('#track_created').html(response.created_at ? new Date(response.created_at).toLocaleString() : 'N/A');
                } else {
                    $('#track_order_id').html(uniqueOrderId || 'N/A');
                    $('#track_link').html('Tracking link not available');
                    $('#track_created').html('N/A');
                }
            },
            error: function(xhr, status, error) {
                console.error('Track order fetch error:', xhr.responseText);
                $('#track_order_id').html(uniqueOrderId || 'N/A');
                $('#track_link').html(trackingLink ? '<a href="' + trackingLink + '" target="_blank">View Tracking</a>' : 'Tracking link not available');
                $('#track_created').html('N/A');
            }
        });
    });

    $("#transaction").on("hidden.bs.modal", function () {
        $('.prepend_items').remove();
    });

    $("#trackOrder").on("hidden.bs.modal", function () {
        $('#track_order_id').html('');
        $('#track_link').html('');
        $('#track_created').html('');
    });
});
</script>
</body>
</html>
