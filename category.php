<?php include 'includes/session.php'; ?>
<?php
// Check if category parameter exists
if(!isset($_GET['category'])) {
    header('location: index.php');
    exit;
}

$slug = $_GET['category'];
$conn = $pdo->open();

try {
    if($slug == 'all') {
        // Handle "All Products" case
        $stmt = $conn->prepare("SELECT * FROM products");
        $page_title = "All Products";
        $show_all_products = true;
    } else {
        // Existing category code
        $stmt = $conn->prepare("SELECT * FROM category WHERE cat_slug = :slug");
        $stmt->execute(['slug' => $slug]);
        $cat = $stmt->fetch();
        
        if(!$cat) {
            $_SESSION['error'] = 'Category not found';
            header('location: index.php');
            exit;
        }
        
        $catid = $cat['id'];
        $page_title = $cat['name'];
        $show_all_products = false;
    }
} catch(PDOException $e) {
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

  /* Buttons (if included in scripts) */
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
                        <h1 class="page-header"><?php echo $page_title; ?></h1>
                        <?php
                            $conn = $pdo->open();
                            try {
                                $inc = 3;
                                
                                if($show_all_products) {
                                    $stmt = $conn->prepare("SELECT * FROM products");
                                    $stmt->execute();
                                } else {
                                    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
                                    $stmt->execute(['catid' => $catid]);
                                }
                                
                                if($stmt->rowCount() > 0) {
                                    foreach ($stmt as $row) {
                                        $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
                                        $inc = ($inc == 3) ? 1 : $inc + 1;
                                        if($inc == 1) echo "<div class='row'>";
                                        echo "
                                            <div class='col-sm-4'>
                                                <div class='box box-solid'>
                                                    <div class='box-body prod-body'>
                                                        <img src='".$image."' width='100%' height='230px' class='thumbnail'>
                                                        <h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
                                                    </div>
                                                    <div class='box-footer'>
                                                        <b>&#36; ".number_format($row['price'], 2)."</b>
                                                    </div>
                                                </div>
                                            </div>
                                        ";
                                        if($inc == 3) echo "</div>";
                                    }
                                    // Close row if not already closed
                                    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
                                    if($inc == 2) echo "<div class='col-sm-4'></div></div>";
                                } else {
                                    echo "<div class='alert alert-info'>No products found.</div>";
                                }
                            } catch(PDOException $e) {
                                echo "<div class='alert alert-danger'>Error loading products: ".$e->getMessage()."</div>";
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
