<?php
require_once __DIR__ . '/../includes/config.php';
$cats = $pdo->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Shop - Categories</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h1>Categories</h1>
    <div class="list-group mb-3">
      <?php foreach($cats as $c): ?>
        <a href="#" class="list-group-item list-group-item-action category-link" data-id="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></a>
      <?php endforeach; ?>
    </div>

    <div id="products"></div>
  </div>

<script>
document.addEventListener('click', function(e){
  if(e.target.classList.contains('category-link')){
    e.preventDefault();
    const id = e.target.dataset.id;
    fetch('../api/get_products.php?category_id='+id)
      .then(r=>r.text()).then(html=> document.getElementById('products').innerHTML = html);
  }
});
</script>
</body>
</html>
