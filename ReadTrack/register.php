<?php
require __DIR__.'/config/db.php';
require __DIR__.'/includes/auth.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $pass = $_POST['password'] ?? '';
  $role = ($_POST['role'] ?? 'reader');
  if (!in_array($role, ['reader','author'], true)) $role = 'reader';

  if ($name==='') $errors[]='Name required';
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[]='Valid email required';
  if (strlen($pass) < 6) $errors[]='Password must be 6+ chars';

  if (!$errors) {
    $stmt = $pdo->prepare("SELECT 1 FROM users WHERE email=?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) $errors[]='Email already registered';
    else {
      $hash = $pass;
      $stmt = $pdo->prepare("INSERT INTO users (name,email,password_hash,role) VALUES (?,?,?,?)");
      $stmt->execute([$name,$email,$hash,$role]);
      header('Location: /ReadTrack/login.php?registered=1');
      exit;
    }
  }
}
include __DIR__.'/includes/header.php';
?>
<h2>Create account</h2>
<?php if ($errors): ?><div class="alert"><?php echo implode('<br>', array_map('htmlspecialchars',$errors)); ?></div><?php endif; ?>
<form method="post">
  <label>Name <input required name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"></label>
  <label>Email <input required type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"></label>
  <label>Password <input required type="password" name="password"></label>
  <label>Register as:
    <select name="role">
      <option value="reader">Reader</option>
      <option value="author">Author</option>
    </select>
  </label>
  <button type="submit">Register</button>
</form>
<?php include __DIR__.'/includes/footer.php'; ?>
