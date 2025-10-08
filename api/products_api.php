<?php
// Simple JSON REST - list products
require_once __DIR__ . '/../includes/config.php';
header('Content-Type: application/json');
$rows = $pdo->query('SELECT * FROM products')->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows);
?>