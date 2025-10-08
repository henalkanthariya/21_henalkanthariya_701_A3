<?php
require_once __DIR__ . '/../includes/config.php';
$cat = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
$perPage = 5;
$page = isset($_GET['page']) ? max(1,(int)$_GET['page']) : 1;
$offset = ($page-1)*$perPage;

$stmt = $pdo->prepare('SELECT * FROM products WHERE category_id = ? LIMIT ? OFFSET ?');
$stmt->bindValue(1, $cat, PDO::PARAM_INT);
$stmt->bindValue(2, $perPage, PDO::PARAM_INT);
$stmt->bindValue(3, $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

ob_start();
?>
<div class="row">
<?php foreach($products as $p): ?>
  <div class="col-md-4">
    <div class="card mb-3">
      <?php if($p['image']): ?>
        <img src="../uploads/<?= htmlspecialchars($p['image']) ?>" class="card-img-top" style="height:180px;object-fit:cover">
      <?php endif; ?>
      <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
        <p class="card-text"><?= htmlspecialchars($p['description']) ?></p>
        <p class="card-text"><strong>Price:</strong> <?= $p['price'] ?></p>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
<?php
echo ob_get_clean();
?>