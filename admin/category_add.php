<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $name = trim($_POST['name'] ?? '');
    $subcategories = trim($_POST['subcategories'] ?? '');

    if (empty($name)) {
        $_SESSION['error'] = 'Category name is required';
    } else {
        $conn = $pdo->open();

        // Check if category name exists
        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM category WHERE name = :name");
        $stmt->execute(['name' => $name]);
        $row = $stmt->fetch();

        if ($row['numrows'] > 0) {
            $_SESSION['error'] = 'Category already exists';
        } else {
            try {
                // Start transaction
                $conn->beginTransaction();

                // Insert category
                $cat_slug = strtolower(str_replace(' ', '-', $name));
                $stmt = $conn->prepare("INSERT INTO category (name, cat_slug) VALUES (:name, :cat_slug)");
                $stmt->execute(['name' => $name, 'cat_slug' => $cat_slug]);
                $category_id = $conn->lastInsertId();

                // Process subcategories
                if (!empty($subcategories)) {
                    $subcat_array = array_map('trim', explode(',', $subcategories));
                    $subcat_array = array_filter($subcat_array); // Remove empty entries
                    foreach ($subcat_array as $subcat_name) {
                        if (!empty($subcat_name)) {
                            // Check if subcategory exists
                            $stmt = $conn->prepare("SELECT id FROM subcategory WHERE name = :name AND category_id = :category_id");
                            $stmt->execute(['name' => $subcat_name, 'category_id' => $category_id]);
                            $subcat_row = $stmt->fetch();

                            if (!$subcat_row) {
                                // Insert new subcategory
                                $subcat_slug = strtolower(str_replace(' ', '-', $subcat_name));
                                $stmt = $conn->prepare("INSERT INTO subcategory (category_id, name, subcat_slug) VALUES (:category_id, :name, :subcat_slug)");
                                $stmt->execute(['category_id' => $category_id, 'name' => $subcat_name, 'subcat_slug' => $subcat_slug]);
                            }
                        }
                    }
                }

                // Commit transaction
                $conn->commit();
                $_SESSION['success'] = 'Category and subcategories added successfully';
            } catch (PDOException $e) {
                $conn->rollBack();
                $_SESSION['error'] = 'Error adding category: ' . htmlspecialchars($e->getMessage());
            }
        }

        $pdo->close();
    }
} else {
    $_SESSION['error'] = 'Fill up category form first';
}

header('location: category.php');
exit;
?>
