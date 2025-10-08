<?php
session_start();
require_once __DIR__ . '/../includes/config.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $user = $_POST['username']; $pass = $_POST['password'];
    $stmt = $pdo->prepare('SELECT * FROM admin WHERE username = ? AND password = ?');
    $stmt->execute([$user, md5($pass)]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    if($admin){
        $_SESSION['admin_id']=$admin['id'];
        header('Location: dashboard.php'); exit;
    } else {
        $err = 'Invalid credentials';
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Admin Login</title></head><body>
<div style="width:320px;margin:40px auto">
  <h3>Admin Login</h3>
  <?php if(!empty($err)) echo '<div style="color:red">'.htmlspecialchars($err).'</div>'; ?>
  <form method="post">
    <div><input name="username" placeholder="username" class="form-control"></div><br>
    <div><input name="password" type="password" placeholder="password" class="form-control"></div><br>
    <div><button class="btn btn-primary">Login</button></div>
  </form>
</div>
</body></html>
