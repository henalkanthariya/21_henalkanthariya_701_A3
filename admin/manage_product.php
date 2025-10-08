<?php
session_start();
require_once __DIR__ . '/../includes/config.php';
if(empty($_SESSION['admin_id'])) { header('Location: login.php'); exit; }

$cats = $pdo->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['save'])){
  $name = $_POST['name']; $price = $_POST['price']; $cat = $_POST['category']; $desc = $_POST['description'];
  $imgname = '';
  if(!empty($_FILES['image']['tmp_name'])){
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $imgname = uniqid() .'.'. $ext;
    move_uploaded_file($_FILES['image']['tmp_name'], UPLOADS_DIR.$imgname);
    // Resize - simple GD (maintain width 800)
    $path = UPLOADS_DIR.$imgname;
    list($w,$h) = getimagesize($path);
    $nw = 800; $nh = intval($h * ($nw/$w));
    $src = imagecreatefromstring(file_get_contents($path));
    $dst = imagecreatetruecolor($nw,$nh);
    imagecopyresampled($dst,$src,0,0,0,0,$nw,$nh,$w,$h);
    imagejpeg($dst,$path,85);
    imagedestroy($src); imagedestroy($dst);
  }
  $stmt = $pdo->prepare('INSERT INTO products (category_id,name,price,image,description) VALUES (?,?,?,?,?)');
  $stmt->execute([$cat,$name,$price,$imgname,$desc]);
}
$products = $pdo->query('SELECT p.*, c.name as catname FROM products p LEFT JOIN categories c ON c.id=p.category_id')->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Products</title></head><body class="p-4">
<div class="container">
  <h2>Manage Products</h2>
  <form method="post" enctype="multipart/form-data" class="mb-4">
    <div><input name="name" placeholder="Product name" required></div>
    <div><input name="price" placeholder="Price" required></div>
    <div>
      <select name="category">
        <?php foreach($cats as $c): ?>
          <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div><input type="file" name="image"></div>
    <div><textarea name="description" placeholder="Description"></textarea></div>
    <div><button name="save">Save</button></div>
  </form>

  <h3>All Products</h3>
  <ul>
    <?php foreach($products as $p): ?>
      <li><?= htmlspecialchars($p['name']) ?> (<?= $p['catname'] ?>) - <?= $p['price'] ?></li>
    <?php endforeach; ?>
  </ul>

  <p><a href="dashboard.php">Back</a></p>
</div>
</body></html>
