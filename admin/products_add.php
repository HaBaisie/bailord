<?php
include 'includes/session.php';
include 'includes/slugify.php';
require 'vendor/autoload.php';

use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Resize;

define('BASE_DIR', dirname(__DIR__));
define('IMAGE_DIR', BASE_DIR . '/images/');

if (isset($_POST['add'])) {
    if (empty($_POST['name']) || empty($_POST['category']) || empty($_POST['price']) || empty($_POST['description'])) {
        $_SESSION['error'] = 'All fields are required';
        header('location: products.php');
        exit;
    }

    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $slug = slugify($name);
    $category = (int)$_POST['category'];
    $price = (float)$_POST['price'];
    $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
    $filename = !empty($_FILES['photo']['name']) ? $_FILES['photo']['name'] : '';

    $conn = $pdo->open();

    try {
        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM products WHERE slug = :slug");
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['numrows'] > 0) {
            $_SESSION['error'] = 'Product already exists';
            $pdo->close();
            header('location: products.php');
            exit;
        }

        $new_filename = '';
        if (!empty($filename)) {
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                $_SESSION['error'] = 'Invalid file type. Only JPG, PNG, or GIF allowed.';
                $pdo->close();
                header('location: products.php');
                exit;
            }
            if (!file_exists($_FILES['photo']['tmp_name']) || !is_uploaded_file($_FILES['photo']['tmp_name'])) {
                $_SESSION['error'] = 'No valid file uploaded';
                $pdo->close();
                header('location: products.php');
                exit;
            }
            $new_filename = $slug . '_' . time() . '.' . $ext;

            if (getenv('CLOUDINARY_URL')) {
                $cloudinary = new Cloudinary();
                try {
                    $result = $cloudinary->uploadApi()->upload($_FILES['photo']['tmp_name'], [
                        'public_id' => 'products/' . pathinfo($new_filename, PATHINFO_FILENAME),
                        'resource_type' => 'image',
                        'transformation' => [
                            ['width' => 400, 'height' => 400, 'crop' => 'fill']
                        ]
                    ]);
                    $new_filename = $result['secure_url'];
                    error_log('Image uploaded to Cloudinary: ' . $new_filename);
                } catch (Exception $e) {
                    error_log('Cloudinary upload failed: ' . $e->getMessage());
                    $_SESSION['error'] = 'Failed to upload image to Cloudinary';
                    $pdo->close();
                    header('location: products.php');
                    exit;
                }
            } else {
                $upload_path = IMAGE_DIR . $new_filename;
                if (!is_dir(IMAGE_DIR)) {
                    if (!mkdir(IMAGE_DIR, 0755, true)) {
                        error_log('Failed to create directory: ' . IMAGE_DIR);
                        $_SESSION['error'] = 'Failed to create images directory';
                        $pdo->close();
                        header('location: products.php');
                        exit;
                    }
                }
                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path)) {
                    error_log('Local upload failed: ' . $_FILES['photo']['error']);
                    $_SESSION['error'] = 'Failed to upload image locally';
                    $pdo->close();
                    header('location: products.php');
                    exit;
                }
                $new_filename = '/images/' . $new_filename;
                error_log('Image uploaded locally: ' . $upload_path);
            }
        }

        $stmt = $conn->prepare("INSERT INTO products (category_id, name, description, slug, price, photo) VALUES (:category, :name, :description, :slug, :price, :photo)");
        $stmt->execute([
            'category' => $category,
            'name' => $name,
            'description' => $description,
            'slug' => $slug,
            'price' => $price,
            'photo' => $new_filename
        ]);
        $_SESSION['success'] = 'Product added successfully';

    } catch (PDOException $e) {
        error_log('Database error: ' . $e->getMessage());
        $_SESSION['error'] = 'Database error';
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
        $_SESSION['error'] = 'Error uploading product';
    }

    $pdo->close();
} else {
    $_SESSION['error'] = 'Please fill up the product form';
}

header('location: products.php');
exit;
?>