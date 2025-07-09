<?php
include 'includes/session.php';
require '../vendor/autoload.php'; // Load Composer dependencies
use Cloudinary\Cloudinary;

if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $conn = $pdo->open();

    try {
        // Fetch product to get name and photo
        $stmt = $conn->prepare("SELECT name, photo FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            $_SESSION['error'] = 'Product not found';
        } else {
            // Delete product from database
            $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
            $stmt->execute(['id' => $id]);

            // Delete image from Cloudinary if exists
            if (!empty($product['photo'])) {
                try {
                    // Extract public_id from Cloudinary URL
                    // Example: https://res.cloudinary.com/<cloud_name>/image/upload/v1234567890/products/<slug>_<timestamp>.<ext>
                    $url_parts = parse_url($product['photo']);
                    $path = pathinfo($url_parts['path']);
                    $public_id = 'products/' . $path['filename']; // e.g., products/slug_1234567890

                    $cloudinary = new Cloudinary();
                    $cloudinary->uploadApi()->destroy($public_id, ['resource_type' => 'image']);
                } catch (Exception $e) {
                    // Log error, don't fail deletion
                    error_log('Cloudinary delete error: ' . $e->getMessage());
                }
            }

            $_SESSION['success'] = 'Product "' . htmlspecialchars($product['name']) . '" deleted successfully';
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
    } catch (Exception $e) {
        $_SESSION['error'] = 'Error: ' . $e->getMessage();
    }

    $pdo->close();
} else {
    $_SESSION['error'] = 'Invalid request';
}

header('location: products.php');
exit;
?>
