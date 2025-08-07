<div class="page-wrapper">
    <!-- Header remains unchanged except for the cart logo -->
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
                                <i class="icon-shopping-cart" style="font-size: 24px; color: #000000; transition: color 0.3s, transform 0.3s;"></i>
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
        <!-- Rest of header unchanged -->
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
                                <br><br>
                                <form class="form-inline" id="productForm">
                                    <div class="form-group">
                                        <div class="input-group col-sm-5">
                                            <div class="input-group-prepend">
                                                <button type="button" id="minus" class="btn btn-default btn-flat btn-lg" style="background-color: #2a5bd7; color: #ffffff; padding: 10px 15px; border: none; font-size: 16px; line-height: 1; display: flex; align-items: center; justify-content: center; min-width: 40px; transition: background-color 0.3s;">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" name="quantity" id="quantity" class="form-control input-lg" value="1" style="height: 46px; text-align: center; border: 1px solid #e9ecef; width: 80px;">
                                            <div class="input-group-append">
                                                <button type="button" id="add" class="btn btn-default btn-flat btn-lg" style="background-color: #2a5bd7; color: #ffffff; padding: 10px 15px; border: none; font-size: 16px; line-height: 1; display: flex; align-items: center; justify-content: center; min-width: 40px; transition: background-color 0.3s;">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" value="<?php echo $product['prodid']; ?>" name="id">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <h1 class="page-header"><?php echo htmlspecialchars($product['prodname']); ?></h1>
                                <h3><b>₦ <?php echo number_format($product['price'], 2); ?></b></h3>
                                <p><b>Category:</b> <a href="category.php?category=<?php echo htmlspecialchars($product['cat_slug']); ?>"><?php echo htmlspecialchars($product['catname']); ?></a></p>
                                <p><b>Description:</b></p>
                                <p><?php echo htmlspecialchars($product['description']); ?></p>
                            </div>
                        </div>
                        <br>
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
    });
    // JavaScript for cart logo hover effect
    document.addEventListener('DOMContentLoaded', function() {
        const cartIcon = document.querySelector('.icon-shopping-cart');
        if (cartIcon) {
            cartIcon.addEventListener('mouseenter', function() {
                this.style.color = '#fd7e14';
                this.style.transform = 'scale(1.2)';
            });
            cartIcon.addEventListener('mouseleave', function() {
                this.style.color = '#000000';
                this.style.transform = 'scale(1)';
            });
        }
    });
    </script>
</div>
