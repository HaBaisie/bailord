<?php
include 'includes/session.php';
include 'includes/slugify.php';

if (isset($_POST['add'])) {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $slug = slugify($name);
    $category = (int)$_POST['category'];
    $price = (float)$_POST['price'];
    $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
    $filename = !empty($_FILES['photo']['name']) ? $_FILES['photo']['name'] : '';

    $conn = $pdo->open();

    // Check for duplicate slug
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM products WHERE slug = :slug");
        $stmt->execute(['slug' => $slug]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['numrows'] > 0) {
            $_SESSION['error'] = 'Product already exists';
        } else {
            // Handle image upload
            $new_filename = '';
            if (!empty($filename)) {
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                    $_SESSION['error'] = 'Invalid file type. Only JPG, PNG, or GIF allowed.';
                    $pdo->close();
                    header('location: products.php');
                    exit;
                }
                $new_filename = $slug . '_' . time() . '.' . $ext;
                $upload_path = '../images/' . $new_filename;
                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path)) {
                    $_SESSION['error'] = 'Failed to upload image';
                    $pdo->close();
                    header('location: products.php');
                    exit;
                }
            }

            // Insert product
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
