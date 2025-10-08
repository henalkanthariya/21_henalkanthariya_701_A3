<?php
session_start();
if(empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
?>
<!doctype html><html><head><meta charset="utf-8"><title>Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="p-4">
<div class="container">
  <h1>Admin Dashboard</h1>
  <a href="manage_category.php" class="btn btn-sm btn-secondary">Manage Categories</a>
  <a href="manage_product.php" class="btn btn-sm btn-secondary">Manage Products</a>
  <a href="logout.php" class="btn btn-sm btn-danger">Logout</a>
</div>
</body></html>
