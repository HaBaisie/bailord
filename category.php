<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'includes/session.php';

// Check if category parameter exists
if (!isset($_GET['category'])) {
    header('location: index.php');
    exit;
}

$slug = $_GET['category'];
$conn = $pdo->open();

try {
    if ($slug == 'all') {
        $stmt = $conn->prepare("SELECT * FROM products");
        $page_title = "All Products";
        $show_all_products = true;
    } else {
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - Bailord</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Line Awesome Icons -->
    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Custom Styles -->
    <style>
        :root {
            --dominant-color: #3498db;       /* Blue - 60% */
            --secondary-color: #2ecc71;      /* Green - 30% */
            --accent-color: #e67e22;         /* Orange - 10% */
            --complementary-blue: #1e429f;
            --complementary-orange: #e67700;
            --neutral-light: #f8f9fa;        /* Light gray background */
            --neutral-dark: #343a40;         /* Dark gray for text */
            --text-color: #333;              /* Main text color */
            --text-light: #fff;              /* Light text for dark backgrounds */
            --blue-gradient: linear-gradient(135deg, var(--dominant-color) 0%, var(--complementary-blue) 100%);
            --green-gradient: linear-gradient(135deg, var(--secondary-color) 0%, #1e7e34 100%);
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--neutral-light);
            color: var(--text-color);
            line-height: 1.6;
        }
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
        .page-header {
            color: var(--dominant-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-top: 0;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        .col-sm-4, .col-sm-9, .col-sm-3 {
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
        .prod-body h5 a {
            color: var(--neutral-dark);
            text-decoration: none;
            transition: color 0.2s;
        }
        .prod-body h5 a:hover {
            color: var(--accent-color);
        }
        .thumbnail {
            object-fit: cover;
            border-radius: 3px;
            margin-bottom: 10px;
        }
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
        .btn-primary {
            background-color: var(--dominant-color);
            border-color: var(--dominant-color);
        }
        .btn-primary:hover {
            background-color: var(--complementary-blue);
            border-color: var(--complementary-blue);
        }
        .btn-success {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        .btn-success:hover {
            background-color: #27ae60;
        }
        .footer {
            background-color: var(--neutral-dark);
            color: var(--text-light);
            padding: 20px 0;
            text-align: center;
        }
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
        /* Ensure mobile menu is hidden by default */
        .mobile-menu-container {
            transform: translateX(-100%);
        }
    </style>
</head>
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
                        if (isset($_SESSION['error'])) {
                            echo "<div class='alert alert-danger'>".htmlspecialchars($_SESSION['error'])."</div>";
                            unset($_SESSION['error']);
                        }
                        $conn = $pdo->open();
                        try {
                            $inc = 3;
                            $default_image = 'https://res.cloudinary.com/hipnfoaz7/image/upload/v1234567890/noimage.jpg';
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
<!-- JavaScript Dependencies -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
