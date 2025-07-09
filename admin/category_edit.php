<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = trim($_POST['name'] ?? '');
    $subcategories = trim($_POST['subcategories'] ?? '');

    if (empty($name)) {
        $_SESSION['error'] = 'Category name is required';
    } else {
        $conn = $pdo->open();
        try {
            // Start transaction
            $conn->beginTransaction();

            // Update category
            $cat_slug = strtolower(str_replace(' ', '-', $name));
            $stmt = $conn->prepare("UPDATE category SET name = :name, cat_slug = :cat_slug WHERE id = :id");
            $stmt->execute(['name' => $name, 'cat_slug' => $cat_slug, 'id' => $id]);

            // Delete existing subcategories
            $stmt = $conn->prepare("DELETE FROM subcategory WHERE category_id = :category_id");
            $stmt->execute(['category_id' => $id]);

            // Insert new subcategories
            if (!empty($subcategories)) {
                $subcat_array = array_map('trim', explode(',', $subcategories));
                $subcat_array = array_filter($subcat_array); // Remove empty entries
                foreach ($subcat_array as $subcat_name) {
                    if (!empty($subcat_name)) {
                        $subcat_slug = strtolower(str_replace(' ', '-', $subcat_name));
                        $stmt = $conn->prepare("INSERT INTO subcategory (category_id, name, subcat_slug) VALUES (:category_id, :name, :subcat_slug)");
                        $stmt->execute(['category_id' => $id, 'name' => $subcat_name, 'subcat_slug' => $subcat_slug]);
                    }
                }
            }

            // Commit transaction
            $conn->commit();
            $_SESSION['success'] = 'Category and subcategories updated successfully';
        } catch (PDOException $e) {
            $conn->rollBack();
            $_SESSION['error'] = 'Error updating category: ' . htmlspecialchars($e->getMessage());
        }
        
        $pdo->close();
    }
} else {
    $_SESSION['error'] = 'Fill up edit category form first';
}

header('location: category.php');
exit;
?>
