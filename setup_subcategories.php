<?php
include 'config.php';
require_once 'includes/session.php';

$conn = $pdo->open();
header('Content-Type: text/html; charset=UTF-8');

$message = '';
$alert_class = '';

try {
    // Start a transaction
    $conn->beginTransaction();

    // SQL to create checkout_sessions table
    $sql_create = "
        CREATE TABLE IF NOT EXISTS checkout_sessions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            location TEXT NOT NULL,
            checkout_token VARCHAR(255) NOT NULL,
            created_at DATETIME NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";
    $conn->exec($sql_create);

    // SQL to remove temporary sales and associated delivery_tasks records
    $sql_cleanup_temp = "
        -- Delete delivery_tasks linked to temporary sales
        DELETE dt FROM delivery_tasks dt
        JOIN sales s ON dt.sales_id = s.id
        WHERE s.pay_id LIKE 'TEMP_%';
        
        -- Delete temporary sales records
        DELETE FROM sales WHERE pay_id LIKE 'TEMP_%';
    ";
    $conn->exec($sql_cleanup_temp);

    // SQL to delete all transaction-related records
    $sql_cleanup_all = "
        -- Delete all details records
        DELETE FROM details;
        -- Delete all delivery_tasks records
        DELETE FROM delivery_tasks;
        -- Delete all kwik_jobs records
        DELETE FROM kwik_jobs;
        -- Delete all sales records
        DELETE FROM sales;
    ";
    $conn->exec($sql_cleanup_all);

    // Commit the transaction
    $conn->commit();
    
    $message = 'Table `checkout_sessions` created, temporary sales and delivery_tasks records removed, and all transactions deleted successfully.';
    $alert_class = 'alert-success';
} catch (PDOException $e) {
    // Roll back the transaction on error
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    $message = 'Error processing request: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    $alert_class = 'alert-danger';
    error_log("Table creation or cleanup error: " . $e->getMessage());
}

$pdo->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Checkout Sessions Table and Delete Transactions</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        :root {
            --dominant-color: #2a5bd7;
            --secondary-color: #28a745;
            --light-neutral: #f8f9fa;
            --text-dark: #212529;
        }
        body {
            background-color: var(--light-neutral);
            color: var(--text-dark);
            font-family: 'Segoe UI', Roboto, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .page-header {
            color: var(--dominant-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
        .btn-primary {
            background-color: var(--dominant-color);
            border-color: var(--dominant-color);
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary:hover {
            background-color: #1e429f;
            border-color: #1e429f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="page-header">Create Checkout Sessions Table and Delete Transactions</h1>
        <?php if ($message): ?>
            <div class="alert <?php echo $alert_class; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <p>This page creates the <code>checkout_sessions</code> table, removes temporary <code>sales</code> and <code>delivery_tasks</code> records, and deletes all transactions from the database.</p>
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
</body>
</html>
