<?php
// DB config
$DB_HOST = '127.0.0.1';
$DB_NAME = 'shopping_cart';
$DB_USER = 'root';
$DB_PASS = 'root';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("DB connection failed: " . $e->getMessage());
}

// Upload folder
define('UPLOADS_DIR', __DIR__ . '/../uploads/');
if (!is_dir(UPLOADS_DIR)) mkdir(UPLOADS_DIR, 0755, true);
?>
