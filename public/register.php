<?php
require_once __DIR__ . '/../includes/config.php';
session_start();
if($_SERVER['REQUEST_METHOD']==='POST'){
  if(strtolower($_POST['captcha'] ?? '') !== strtolower($_SESSION['captcha'] ?? '')){
    $err = 'Invalid captcha';
  } else {
    $stmt = $pdo->prepare('INSERT INTO users (name,email,password) VALUES (?,?,?)');
    $stmt->execute([$_POST['name'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT)]);
    header('Location: login.php'); exit;
  }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Register</title></head><body>
<form method="post">
  <input name="name" placeholder="Name" required><br>
  <input name="email" type="email" placeholder="Email" required><br>
  <input name="password" type="password" placeholder="Password" required><br>
  <img src="captcha.php" alt="captcha"><br>
  <input name="captcha" placeholder="Enter captcha" required><br>
  <button>Register</button>
  <?php if(!empty($err)) echo '<div style="color:red">'.htmlspecialchars($err).'</div>'; ?>
</form>
</body></html>
