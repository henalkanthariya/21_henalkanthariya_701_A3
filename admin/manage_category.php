<?php
session_start();
require_once __DIR__ . '/../includes/config.php';
if(empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }

if(isset($_POST['add'])){
  $name = $_POST['name'] ?? '';
  $stmt = $pdo->prepare('INSERT INTO categories (name) VALUES (?)');
  $stmt->execute([$name]);
}
if(isset($_GET['delete'])){
  $id = (int)$_GET['delete'];
  $pdo->prepare('DELETE FROM categories WHERE id=?')->execute([$id]);
}
$cats = $pdo->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Categories</title></head><body class="p-4">
<div class="container">
  <h2>Categories</h2>
  <form method="post" class="mb-3">
    <input name="name" placeholder="Category name" required>
    <button name="add">Add</button>
  </form>
  <ul>
  <?php foreach($cats as $c): ?>
    <li><?= htmlspecialchars($c['name']) ?> - <a href="?delete=<?= $c['id'] ?>">Delete</a></li>
  <?php endforeach; ?>
  </ul>
  <p><a href="dashboard.php">Back</a></p>
</div>
</body></html>
