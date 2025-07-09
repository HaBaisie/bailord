<?php
include 'includes/session.php';

// Enable error reporting for debugging
ini_set('display_errors', 0); // Disable for production
error_reporting(E_ALL);

// Log request
error_log('subcategory_fetch.php accessed at ' . date('Y-m-d H:i:s') . ' with POST: ' . json_encode($_POST));

$output = '';

if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {
    $category_id = trim($_POST['category_id']);
    
    try {
        $conn = $pdo->open();
        error_log('Database connection opened for category_id: ' . $category_id);
        $stmt = $conn->prepare("SELECT id, name FROM subcategory WHERE category_id = :category_id ORDER BY name");
        $stmt->execute(['category_id' => $category_id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        error_log('Subcategories fetched for category_id ' . $category_id . ': ' . json_encode($rows));
        
        if (empty($rows)) {
            $output = "<option value='' disabled>No subcategories available</option>";
        } else {
            foreach ($rows as $row) {
                $output .= "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</option>";
            }
        }
        $pdo->close();
    } catch (PDOException $e) {
        $output = "<option value=''>Database error: " . htmlspecialchars($e->getMessage()) . "</option>";
        error_log('Subcategory fetch PDO error: ' . $e->getMessage());
    } catch (Exception $e) {
        $output = "<option value=''>Error: " . htmlspecialchars($e->getMessage()) . "</option>";
        error_log('Subcategory fetch error: ' . $e->getMessage());
    }
} else {
    $output = "<option value='' disabled>No category selected</option>";
    error_log('No category_id provided in POST');
}

header('Content-Type: application/json');
echo json_encode($output);
?>
