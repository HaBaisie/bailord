<?php
include 'includes/session.php';

// Enable error reporting for debugging
ini_set('display_errors', 0); // Disable for production
error_reporting(E_ALL);

// Log request
error_log('category_fetch.php accessed at ' . date('Y-m-d H:i:s'));

$output = '';

try {
    $conn = $pdo->open();
    error_log('Database connection opened');
    $stmt = $conn->prepare("SELECT id, name FROM category ORDER BY name");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    error_log('Categories fetched: ' . json_encode($rows));

    if (empty($rows)) {
        $output = "<option value='' disabled>No categories available</option>";
    } else {
        foreach ($rows as $row) {
            $output .= "<option value='" . htmlspecialchars($row['id']) . "' class='append_items'>" . htmlspecialchars($row['name']) . "</option>";
        }
    }
    $pdo->close();
} catch (PDOException $e) {
    $output = "<option value=''>Database error: " . htmlspecialchars($e->getMessage()) . "</option>";
    error_log('Category fetch PDO error: ' . $e->getMessage());
} catch (Exception $e) {
    $output = "<option value=''>Error: " . htmlspecialchars($e->getMessage()) . "</option>";
    error_log('Category fetch error: ' . $e->getMessage());
}

header('Content-Type: application/json');
echo json_encode($output);
?>
