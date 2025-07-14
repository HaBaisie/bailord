<?php
include 'config.php';
require_once 'includes/session.php';

$conn = $pdo->open();
header('Content-Type: text/html; charset=UTF-8');

$message = '';
$alert_class = '';

try {
    // SQL to create delivery_tasks table
    $sql = "
        CREATE TABLE IF NOT EXISTS delivery_tasks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            sales_id INT,
            user_id INT,
            job_id INT,
            job_hash VARCHAR(255),
            job_token VARCHAR(255),
            unique_order_id VARCHAR(255),
            tracking_link VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ";

    $conn->exec($sql);
    $message = 'Table `delivery_tasks` created successfully.';
    $alert_class = 'alert-success';
} catch (PDOException $e) {
    $message = 'Error creating table: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    $alert_class = 'alert-danger';
    error_log("Table creation error: " . $e->getMessage());
}

$pdo->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Delivery Tasks Table</title>
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
        <h1 class="page-header">Create Delivery Tasks Table</h1>
        <?php if ($message): ?>
            <div class="alert <?php echo $alert_class; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <p>This page creates the <code>delivery_tasks</code> table in the database.</p>
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
</body>
</html>
