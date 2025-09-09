<?php
require __DIR__.'/config/db.php';
require __DIR__.'/includes/auth.php';

$msg = '';
if (isset($_GET['registered'])) $msg = 'Registration successful. Please log in.';
$error = '';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $email = trim($_POST['email'] ?? '');
  $pass = $_POST['password'] ?? '';
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
  $stmt->execute([$email]);
  $user = $stmt->fetch();
  if ($user && $pass === $user['password_hash']) {
    $_SESSION['user'] = [
      'id'=>$user['id'],
      'name'=>$user['name'],
      'email'=>$user['email'],
      'role'=>$user['role'],
      'bio'=>$user['bio'],
      'avatar'=>$user['avatar'],
    ];
    header('Location: /ReadTrack/index.php');
    exit;
  } else $error = 'Invalid email or password';
}
include __DIR__.'/includes/header.php';
?>
<h2>Login</h2>
<?php if ($msg): ?><div class="notice"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
<form method="post">
  <label>Email <input required type="email" name="email"></label>
  <label>Password <input required type="password" name="password"></label>
  <button type="submit">Login</button>
</form>
<?php include __DIR__.'/includes/footer.php'; ?>

