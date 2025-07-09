<?php
include 'includes/session.php';

$output = '';

if (isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];
    
    $conn = $pdo->open();
    try {
        $stmt = $conn->prepare("SELECT id, name FROM subcategory WHERE category_id = :category_id ORDER BY name");
        $stmt->execute(['category_id' => $category_id]);
        
        foreach ($stmt as $row) {
            $output .= "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
        }
        
        if (empty($output)) {
            $output = "<option value='' disabled>No subcategories available</option>";
        }
    } catch (PDOException $e) {
        $output = "<option value=''>Error loading subcategories: " . htmlspecialchars($e->getMessage()) . "</option>";
    }
    
    $pdo->close();
} else {
    $output = "<option value='' disabled>No category selected</option>";
}

echo json_encode($output);
?>