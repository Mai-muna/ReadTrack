<?php
require __DIR__.'/includes/auth.php';
require_login();
require __DIR__.'/config/db.php';

$user = current_user();
$errors = $ok = '';

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $name = trim($_POST['name'] ?? '');
  $bio  = trim($_POST['bio'] ?? '');
  if ($name==='') $errors = 'Name required';

  if (!$errors) {
    $stmt = $pdo->prepare("UPDATE users SET name=?, bio=? WHERE id=?");
    $stmt->execute([$name, $bio ?: null, $user['id']]);
    $_SESSION['user']['name']=$name;
    $_SESSION['user']['bio']=$bio;
    $ok = 'Profile updated';
  }
}
include __DIR__.'/includes/header.php';
?>
<h2>My Profile</h2>
<?php if ($errors): ?><div class="alert"><?php echo htmlspecialchars($errors); ?></div><?php endif; ?>
<?php if ($ok): ?><div class="notice"><?php echo htmlspecialchars($ok); ?></div><?php endif; ?>
<div class="profile">
  <form method="post">
    <label>Name <input name="name" required value="<?php echo htmlspecialchars($user['name']); ?>"></label>
    <label>Bio <textarea name="bio" rows="4"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea></label>
    <button type="submit">Save</button>
  </form>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
