<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger animated bounceIn'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		
	        		<!-- Hero Carousel Section -->
	        		<div class="hero-section">
		        		<div id="main-carousel" class="carousel slide" data-ride="carousel">
			                <ol class="carousel-indicators">
			                  <li data-target="#main-carousel" data-slide-to="0" class="active"></li>
			                  <li data-target="#main-carousel" data-slide-to="1"></li>
			                  <li data-target="#main-carousel" data-slide-to="2"></li>
			                </ol>
			                <div class="carousel-inner">
			                  <div class="item active">
			                    <img src="images/im2.jpg" alt="Summer Collection">
			                    <div class="carousel-caption animated fadeInUp">
			                    	<h2>Tech Summer Collection</h2>
			                    	<p>Discover our hottest gadgets for the season</p>
			                    	<a href="category.php?category=" class="btn btn-primary btn-lg pulse">Shop Now</a>
			                    </div>
			                  </div>
			                  <div class="item">
			                    <img src="images/im11.png" alt="Limited Offer">
			                    <div class="carousel-caption animated fadeInUp">
			                    	<h2>Limited Time Offer</h2>
			                    	<p>Get 30% off on selected laptops & tablets</p>
			                    	<a href="category.php?category=desktop-pc" class="btn btn-danger btn-lg pulse">Grab the Deal</a>
			                    </div>
			                  </div>
			                  <div class="item">
			                    <img src="images/img3.jpg" alt="New Arrivals">
			                    <div class="carousel-caption animated fadeInUp">
			                    	<h2>New Tech Arrivals</h2>
			                    	<p>Fresh gadgets just added to our store</p>
			                    	<a href="category.php?category=laptops" class="btn btn-success btn-lg pulse">Explore</a>
			                    </div>
			                  </div>
			                </div>
			                <a class="left carousel-control" href="#main-carousel" data-slide="prev">
			                  <span class="fa fa-angle-left"></span>
			                </a>
			                <a class="right carousel-control" href="#main-carousel" data-slide="next">
			                  <span class="fa fa-angle-right"></span>
			                </a>
			            </div>
		            </div>
		            
		            <!-- Featured Categories -->
		            <div class="featured-categories">
		            	<h3 class="section-title">Shop by Category</h3>
		            	<div class="row">
		            		<div class="col-sm-4">
		            			<div class="category-card animated fadeInLeft">
		            				<img src="images/sm1.jpg" alt="Smartphones" class="img-responsive">
		            				<div class="category-overlay">
		            					<h4>Smartphones</h4>
		            					<a href="category.php?category=smartphones" class="btn btn-sm btn-default">View Products</a>
		            				</div>
		            			</div>
		            		</div>
		            		<div class="col-sm-4">
		            			<div class="category-card animated fadeInUp">
		            				<img src="images/lap1.jpg" alt="Laptops" class="img-responsive">
		            				<div class="category-overlay">
		            					<h4>Laptops</h4>
		            					<a href="category.php?category=laptops" class="btn btn-sm btn-default">View Products</a>
		            				</div>
		            			</div>
		            		</div>
		            		<div class="col-sm-4">
		            			<div class="category-card animated fadeInRight">
		            				<img src="images/tab1.png" alt="Tablets" class="img-responsive">
		            				<div class="category-overlay">
		            					<h4>Tablets</h4>
		            					<a href="category.php?category=tablets" class="btn btn-sm btn-default">View Products</a>
		            				</div>
		            			</div>
		            		</div>
		            	</div>
		            </div>
		            
		            <!-- Featured Gadgets Section -->
		            <div class="featured-products">
		            	<h3 class="section-title">Featured Gadgets <small><a href="products.php" class="view-all">View All</a></small></h3>
		            	<div class="row">
		            		<?php
		            			$conn = $pdo->open();
		            			try{
		            				$stmt = $conn->prepare("SELECT * FROM products WHERE category_id IN (SELECT id FROM category WHERE name IN ('Laptops', 'Smartphones', 'Tablets', 'Gadgets')) ORDER BY date_viewed DESC LIMIT 6");
		            				$stmt->execute();
		            				foreach ($stmt as $row) {
		            					$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
		            					echo "
		            						<div class='col-sm-4'>
		            							<div class='product-card animated zoomIn'>
			            							<div class='product-badge'>".($row['price'] < 500 ? "HOT DEAL" : "NEW")."</div>
			            							<div class='product-image'>
			            								<img src='".$image."' class='img-responsive'>
			            								<div class='product-overlay'>
			            									<a href='product.php?product=".$row['slug']."' class='btn btn-primary'>View Details</a>
			            									<button class='btn btn-default add-to-cart' data-id='".$row['id']."'><i class='fa fa-shopping-cart'></i> Add to Cart</button>
			            								</div>
			            							</div>
			            							<div class='product-info'>
			            								<h4><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h4>
			            								<div class='product-price'>
			            									<span class='price'>$".number_format($row['price'], 2)."</span>
			            									<span class='old-price'>".($row['price'] < 500 ? "$".number_format($row['price']*1.3, 2) : "")."</span>
			            									<span class='discount'>".($row['price'] < 500 ? "30% OFF" : "")."</span>
			            								</div>
			            								<div class='product-specs'>
			            									<span><i class='fa fa-microchip'></i> ".$row['processor']."</span>
			            									<span><i class='fa fa-memory'></i> ".$row['ram']."</span>
			            									<span><i class='fa fa-hdd'></i> ".$row['storage']."</span>
			            								</div>
			            							</div>
		            							</div>
		            						</div>
		            					";
		            				}
		            			}
		            			catch(PDOException $e){
		            				echo "There is some problem in connection: " . $e->getMessage();
		            			}
		            			$pdo->close();
		            		?>
		            	</div>
		            </div>
					<!-- Laptop Showcase -->
		            <div class="laptop-showcase">
		            	<h3 class="section-title">Premium Smart Phones <small>For Professionals & Gamers</small></h3>
		            	<div class="row">
		            		<?php
		            			$conn = $pdo->open();
		            			try{
		            				$stmt = $conn->prepare("SELECT * FROM products WHERE category_id IN (SELECT id FROM category WHERE name = 'Smart Phones') ORDER BY RAND() LIMIT 10");
		            				$stmt->execute();
		            				foreach ($stmt as $row) {
		            					$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
		            					echo "
		            						<div class='col-sm-4'>
		            							<div class='laptop-card animated flipInX'>
			            							<div class='laptop-image'>
			            								<img src='".$image."' class='img-responsive'>
			            								<div class='laptop-overlay'>
			            									<a href='product.php?product=".$row['slug']."' class='btn btn-primary'>View Details</a>
			            								</div>
			            							</div>
			            							<div class='laptop-info'>
			            								<h4><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h4>
			            								<div class='laptop-price'>
			            									<span class='price'>$".number_format($row['price'], 2)."</span>
			            									<button class='btn btn-warning add-to-cart' data-id='".$row['id']."'><i class='fa fa-shopping-cart'></i> Add to Cart</button>
			            								</div>
			            							</div>
		            							</div>
		            						</div>
		            					";
		            				}
		            			}
		            			catch(PDOException $e){
		            				echo "There is some problem in connection: " . $e->getMessage();
		            			}
		            			$pdo->close();
		            		?>
		            	</div>
		            </div>
		            <!-- Laptop Showcase -->
		            <div class="laptop-showcase">
		            	<h3 class="section-title">Premium Tablets <small>For Professionals & Gamers</small></h3>
		            	<div class="row">
		            		<?php
		            			$conn = $pdo->open();
		            			try{
		            				$stmt = $conn->prepare("SELECT * FROM products WHERE category_id IN (SELECT id FROM category WHERE name = 'tablets') ORDER BY RAND() LIMIT 10");
		            				$stmt->execute();
		            				foreach ($stmt as $row) {
		            					$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
		            					echo "
		            						<div class='col-sm-4'>
		            							<div class='laptop-card animated flipInX'>
			            							<div class='laptop-image'>
			            								<img src='".$image."' class='img-responsive'>
			            								<div class='laptop-overlay'>
			            									<a href='product.php?product=".$row['slug']."' class='btn btn-primary'>View Details</a>
			            								</div>
			            							</div>
			            							<div class='laptop-info'>
			            								<h4><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h4>
			            								<div class='laptop-price'>
			            									<span class='price'>$".number_format($row['price'], 2)."</span>
			            									<button class='btn btn-warning add-to-cart' data-id='".$row['id']."'><i class='fa fa-shopping-cart'></i> Add to Cart</button>
			            								</div>
			            							</div>
		            							</div>
		            						</div>
		            					";
		            				}
		            			}
		            			catch(PDOException $e){
		            				echo "There is some problem in connection: " . $e->getMessage();
		            			}
		            			$pdo->close();
		            		?>
		            	</div>
		            </div>
		            <!-- Laptop Showcase -->
		            <div class="laptop-showcase">
		            	<h3 class="section-title">Premium Laptops <small>For Professionals & Gamers</small></h3>
		            	<div class="row">
		            		<?php
		            			$conn = $pdo->open();
		            			try{
		            				$stmt = $conn->prepare("SELECT * FROM products WHERE category_id IN (SELECT id FROM category WHERE name = 'Laptops') ORDER BY RAND() LIMIT 10");
		            				$stmt->execute();
		            				foreach ($stmt as $row) {
		            					$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
		            					echo "
		            						<div class='col-sm-4'>
		            							<div class='laptop-card animated flipInX'>
			            							<div class='laptop-image'>
			            								<img src='".$image."' class='img-responsive'>
			            								<div class='laptop-overlay'>
			            									<a href='product.php?product=".$row['slug']."' class='btn btn-primary'>View Details</a>
			            								</div>
			            							</div>
			            							<div class='laptop-info'>
			            								<h4><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h4>
			            								<div class='laptop-price'>
			            									<span class='price'>$".number_format($row['price'], 2)."</span>
			            									<button class='btn btn-warning add-to-cart' data-id='".$row['id']."'><i class='fa fa-shopping-cart'></i> Add to Cart</button>
			            								</div>
			            							</div>
		            							</div>
		            						</div>
		            					";
		            				}
		            			}
		            			catch(PDOException $e){
		            				echo "There is some problem in connection: " . $e->getMessage();
		            			}
		            			$pdo->close();
		            		?>
		            	</div>
		            </div>
		            <!-- Monthly Top Sellers -->
		            <div class="top-sellers">
		            	<h3 class="section-title">Monthly Top Sellers <small>Most Popular This Month</small></h3>
		            	<div class="row">
		            		<?php
		            			$month = date('m');
		            			$conn = $pdo->open();
		            			try{
		            				$stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 3");
		            				$stmt->execute();
		            				foreach ($stmt as $row) {
		            					$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
		            					echo "
		            						<div class='col-sm-4'>
		            							<div class='top-product animated slideInUp'>
			            							<div class='top-badge'><i class='fa fa-trophy'></i> Top Seller</div>
			            							<div class='product-image'>
			            								<img src='".$image."' class='img-responsive'>
			            								<div class='product-overlay'>
			            									<a href='product.php?product=".$row['slug']."' class='btn btn-primary'>View Details</a>
			            								</div>
			            							</div>
			            							<div class='product-info'>
			            								<h4><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h4>
			            								<div class='product-price'>
			            									<span class='price'>$".number_format($row['price'], 2)."</span>
			            									<span class='sold'>".$row['total_qty']." sold this month</span>
			            								</div>
			            								<div class='product-rating'>
			            									<i class='fa fa-star'></i>
			            									<i class='fa fa-star'></i>
			            									<i class='fa fa-star'></i>
			            									<i class='fa fa-star'></i>
			            									<i class='fa fa-star-half-o'></i>
			            									<span class='reviews'>(24 reviews)</span>
			            								</div>
			            							</div>
		            							</div>
		            						</div>
		            					";
		            				}
		            			}
		            			catch(PDOException $e){
		            				echo "There is some problem in connection: " . $e->getMessage();
		            			}
		            			$pdo->close();
		            		?>
		            	</div>
		            </div>
		            
		            <!-- Tech News Banner -->
		            <div class="tech-news-banner animated pulse">
		            	<div class="row">
		            		<div class="col-sm-8">
		            			<h3>Tech News & Updates</h3>
		            			<p>Stay updated with the latest in technology and gadget world</p>
		            		</div>
		            		<div class="col-sm-4 text-right">
		            			<a href="blog.php" class="btn btn-info">Read Our Blog</a>
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
</div>

<?php include 'includes/scripts.php'; ?>

<!-- Add this before </body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
	new WOW().init();
</script>

<style>
/* Custom Styles for Enhanced Design */
.hero-section {
	margin-bottom: 30px;
	border-radius: 4px;
	overflow: hidden;
	box-shadow: 0 5px 15px rgba(0,0,0,0.1);
	transition: all 0.3s ease;
}

.hero-section:hover {
	box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

#main-carousel .carousel-inner img {
	width: 100%;
	height: 450px;
	object-fit: cover;
}

#main-carousel .carousel-caption {
	background: rgba(0,0,0,0.7);
	padding: 25px;
	border-radius: 4px;
	bottom: 100px;
	left: 10%;
	right: 10%;
	text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
}

#main-carousel .carousel-caption h2 {
	font-size: 36px;
	font-weight: 700;
	margin-bottom: 15px;
	text-transform: uppercase;
}

#main-carousel .carousel-caption p {
	font-size: 18px;
	margin-bottom: 20px;
}

.section-title {
	border-bottom: 2px solid #eee;
	padding-bottom: 10px;
	margin-top: 40px;
	margin-bottom: 25px;
	position: relative;
	font-size: 24px;
	color: #333;
}

.section-title:after {
	content: '';
	position: absolute;
	left: 0;
	bottom: -2px;
	width: 70px;
	height: 3px;
	background: #337ab7;
}

.section-title small {
	font-size: 14px;
	color: #777;
	display: block;
	margin-top: 5px;
}

.section-title small a.view-all {
	float: right;
	font-size: 13px;
	color: #337ab7;
}

.featured-categories {
	margin: 40px 0;
}

.category-card {
	position: relative;
	margin-bottom: 25px;
	border-radius: 6px;
	overflow: hidden;
	box-shadow: 0 3px 10px rgba(0,0,0,0.1);
	transition: all 0.4s ease;
}

.category-card:hover {
	box-shadow: 0 8px 25px rgba(0,0,0,0.15);
	transform: translateY(-8px);
}

.category-card img {
	width: 100%;
	height: 200px;
	object-fit: cover;
	transition: all 0.5s ease;
}

.category-card:hover img {
	transform: scale(1.05);
}

.category-overlay {
	position: absolute;
	bottom: 0;
	left: 0;
	right: 0;
	background: rgba(0,0,0,0.8);
	color: #fff;
	padding: 20px;
	text-align: center;
}

.category-overlay h4 {
	font-size: 18px;
	margin-bottom: 10px;
	text-transform: uppercase;
}

/* Product Cards */
.product-card, .laptop-card, .top-product {
	border: 1px solid #eee;
	border-radius: 6px;
	margin-bottom: 25px;
	transition: all 0.4s ease;
	background: #fff;
	position: relative;
	overflow: hidden;
}

.product-card:hover, .laptop-card:hover, .top-product:hover {
	box-shadow: 0 10px 25px rgba(0,0,0,0.1);
	transform: translateY(-5px);
}

.product-badge {
	position: absolute;
	top: 10px;
	right: 10px;
	background: #e74c3c;
	color: white;
	padding: 3px 10px;
	border-radius: 3px;
	font-size: 12px;
	font-weight: bold;
	z-index: 1;
}

.top-badge {
	position: absolute;
	top: 10px;
	left: 10px;
	background: #f39c12;
	color: white;
	padding: 3px 10px;
	border-radius: 3px;
	font-size: 12px;
	font-weight: bold;
	z-index: 1;
}

.product-image, .laptop-image {
	position: relative;
	overflow: hidden;
	height: 200px;
}

.product-image img, .laptop-image img {
	width: 100%;
	height: 100%;
	object-fit: contain;
	background: #f9f9f9;
	padding: 20px;
	transition: all 0.5s ease;
}

.product-card:hover .product-image img, 
.laptop-card:hover .laptop-image img,
.top-product:hover .product-image img {
	transform: scale(1.05);
}

.product-overlay, .laptop-overlay {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background: rgba(0,0,0,0.8);
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	opacity: 0;
	transition: all 0.4s ease;
}

.product-card:hover .product-overlay, 
.laptop-card:hover .laptop-overlay,
.top-product:hover .product-overlay {
	opacity: 1;
}

.product-info, .laptop-info {
	padding: 15px;
}

.product-info h4, .laptop-info h4 {
	font-size: 16px;
	margin-bottom: 10px;
}

.product-info h4 a, .laptop-info h4 a {
	color: #333;
	transition: all 0.3s ease;
}

.product-info h4 a:hover, .laptop-info h4 a:hover {
	color: #337ab7;
	text-decoration: none;
}

.product-price {
	margin-top: 10px;
	font-size: 18px;
	font-weight: bold;
	color: #e74c3c;
	position: relative;
}

.old-price {
	text-decoration: line-through;
	color: #999;
	font-size: 14px;
	margin-left: 8px;
}

.discount {
	background: #e74c3c;
	color: white;
	font-size: 12px;
	padding: 2px 6px;
	border-radius: 3px;
	margin-left: 8px;
}

.laptop-price {
	margin-top: 15px;
	padding-top: 15px;
	border-top: 1px solid #eee;
	display: flex;
	justify-content: space-between;
	align-items: center;
}

.laptop-price .price {
	font-size: 20px;
	font-weight: bold;
	color: #e74c3c;
}

.product-specs, .laptop-specs {
	margin-top: 10px;
	font-size: 13px;
	color: #666;
}

.product-specs span, .laptop-specs div {
	display: inline-block;
	margin-right: 10px;
	margin-bottom: 5px;
}

.product-specs i, .laptop-specs i {
	color: #337ab7;
	margin-right: 5px;
}

.product-rating {
	margin-top: 10px;
	color: #ffc107;
}

.product-rating .reviews {
	color: #999;
	font-size: 12px;
	margin-left: 5px;
}

.sold {
	font-size: 12px;
	color: #666;
	display: block;
	margin-top: 3px;
}

/* Tech News Banner */
.tech-news-banner {
	background: linear-gradient(135deg, #3498db, #2c3e50);
	color: white;
	padding: 25px;
	border-radius: 6px;
	margin: 40px 0;
	box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.tech-news-banner h3 {
	font-size: 22px;
	margin-bottom: 10px;
}

.tech-news-banner p {
	font-size: 15px;
	opacity: 0.9;
}

/* Animations */
.animated {
	animation-duration: 1s;
}

@keyframes pulse {
	0% { transform: scale(1); }
	50% { transform: scale(1.05); }
	100% { transform: scale(1); }
}

.pulse {
	animation-name: pulse;
	animation-iteration-count: infinite;
	animation-duration: 2s;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
	#main-carousel .carousel-caption {
		bottom: 50px;
	}
	
	#main-carousel .carousel-caption h2 {
		font-size: 28px;
	}
	
	#main-carousel .carousel-caption p {
		font-size: 16px;
	}
}

@media (max-width: 768px) {
	#main-carousel .carousel-caption {
		bottom: 20px;
		padding: 15px;
	}
	
	#main-carousel .carousel-caption h2 {
		font-size: 20px;
		margin-bottom: 5px;
	}
	
	#main-carousel .carousel-caption p {
		font-size: 14px;
		margin-bottom: 10px;
	}
	
	#main-carousel .carousel-caption .btn {
		padding: 5px 10px;
		font-size: 12px;
	}
	
	.section-title {
		font-size: 20px;
	}
}
</style>
</body>
</html>