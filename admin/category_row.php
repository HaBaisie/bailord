<?php
include 'includes/session.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    $conn = $pdo->open();
    try {
        $stmt = $conn->prepare("SELECT c.id, c.name, GROUP_CONCAT(s.name ORDER BY s.name SEPARATOR ', ') AS subcat_names FROM category c LEFT JOIN subcategory s ON c.id = s.category_id WHERE c.id = :id GROUP BY c.id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        
        if ($row) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'Category not found']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    
    $pdo->close();
} else {
    echo json_encode(['error' => 'No ID provided']);
}
?>
