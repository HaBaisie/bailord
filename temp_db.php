<?php
// Set a strong temporary password (change this!)
$admin_password = 'YourSecureTempPass123!';

// Verify password (delete this file after use)
if (!isset($_SERVER['PHP_AUTH_USER']) || 
    $_SERVER['PHP_AUTH_USER'] != 'admin' || 
    $_SERVER['PHP_AUTH_PW'] != $admin_password) {
    header('WWW-Authenticate: Basic realm="Database Admin"');
    header('HTTP/1.0 401 Unauthorized');
    die('Access denied');
}

// Include Adminer
require 'adminer.php';