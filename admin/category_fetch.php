<?php
include 'includes/session.php';

$output = '';

$conn = $pdo->open();

try {
    $stmt = $conn->prepare("SELECT id, name FROM category ORDER BY name");
    $stmt->execute();

    foreach ($stmt as $row) {
        $output .= "<option value='" . $row['id'] . "' class='append_items'>" . htmlspecialchars($row['name']) . "</option>";
    }
} catch (PDOException $e) {
    $output = "<option value=''>Error loading categories: " . htmlspecialchars($e->getMessage()) . "</option>";
}

$pdo->close();
echo json_encode($output);
?>
