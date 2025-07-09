<?php
include 'includes/session.php';
include 'includes/slugify.php';
require '../vendor/autoload.php'; // Load Composer dependencies
use Cloudinary\Cloudinary;

if (isset($_POST['add'])) {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $slug = slugify($name);
    $category_id = (int)$_POST['category_id'];
    $subcategory_id = !empty($_POST['subcategory_id']) ? (int)$_POST['subcategory_id'] : null;
    $price = (float)$_POST['price'];
    $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
    $filename = !empty($_FILES['photo']['name']) ? $_FILES['photo']['name'] : '';

    // Validate required fields
    if (empty($name) || empty($category_id) || empty($price) || empty($description)) {
        $_SESSION['error'] = 'Please fill up all required fields';
        $pdo->close();
        header('location: products.php');
        exit;
    }

    $conn = $pdo->open();

    // Check for duplicate slug
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM products WHERE slug = :slug");
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['numrows'] > 0) {
            $_SESSION['error'] = 'Product already exists';
        } else {
            // Validate subcategory_id if provided
            if ($subcategory_id !== null) {
                $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM subcategory WHERE id = :subcategory_id AND category_id = :category_id");
                $stmt->execute(['subcategory_id' => $subcategory_id, 'category_id' => $category_id]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row['numrows'] == 0) {
                    $_SESSION['error'] = 'Invalid subcategory selected';
                    $pdo->close();
                    header('location: products.php');
                    exit;
                }
            }

            // Handle image upload to Cloudinary
            $photo_url = '';
            if (!empty($filename)) {
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                    $_SESSION['error'] = 'Invalid file type. Only JPG, PNG, or GIF allowed.';
                    $pdo->close();
                    header('location: products.php');
                    exit;
                }

                // Initialize Cloudinary (uses CLOUDINARY_URL from Heroku config)
                $cloudinary = new Cloudinary();

                // Upload image to Cloudinary
                $public_id = 'products/' . $slug . '_' . time();
                $upload_result = $cloudinary->uploadApi()->upload($_FILES['photo']['tmp_name'], [
                    'public_id' => $public_id,
                    'folder' => 'products',
                    'format' => $ext,
                    'resource_type' => 'image'
                ]);

                if (isset($upload_result['secure_url'])) {
                    $photo_url = $upload_result['secure_url'];
                } else {
                    $_SESSION['error'] = 'Failed to upload image to Cloudinary';
                    $pdo->close();
                    header('location: products.php');
                    exit;
                }
            }

            // Insert product
            $stmt = $conn->prepare("
                INSERT INTO products (category_id, subcategory_id, name, description, slug, price, photo)
                VALUES (:category_id, :subcategory_id, :name, :description, :slug, :price, :photo)
            ");
            $stmt->execute([
                'category_id' => $category_id,
                'subcategory_id' => $subcategory_id,
                'name' => $name,
                'description' => $description,
                'slug' => $slug,
                'price' => $price,
                'photo' => $photo_url
            ]);
            $_SESSION['success'] = 'Product added successfully';
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
    } catch (Exception $e) {
        $_SESSION['error'] = 'Error: ' . $e->getMessage();
    }

    $pdo->close();
} else {
    $_SESSION['error'] = 'Please fill up the product form';
}

header('location: products.php');
exit;
?>
