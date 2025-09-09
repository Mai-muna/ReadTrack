<?php
require __DIR__.'/includes/auth.php'; require_login();
if (!is_author() && !is_admin()) { http_response_code(403); die("Authors only"); }
require __DIR__.'/config/db.php';

$err=$ok='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $title = trim($_POST['title'] ?? '');
  $syn   = trim($_POST['synopsis'] ?? '');
  $genre = (int)($_POST['genre_id'] ?? 0);

  if ($title==='' || $syn==='' || !$genre) $err='All fields required';

  if (!$err) {
    $stmt = $pdo->prepare("INSERT INTO books (title,synopsis,genre_id,author_id,status)
                           VALUES (?,?,?,?, 'pending')");
    $stmt->execute([$title,$syn,$genre,current_user()['id']]);
    $ok='Book submitted for approval';
  }
}
include __DIR__.'/includes/header.php';
?>
<h2>Upload a Book (requires admin approval)</h2>
<?php if ($err): ?><div class="alert"><?php echo htmlspecialchars($err); ?></div><?php endif; ?>
<?php if ($ok): ?><div class="notice"><?php echo htmlspecialchars($ok); ?></div><?php endif; ?>
<form method="post">
  <label>Title <input name="title" required></label>
  <label>Genre
    <select name="genre_id" required>
      <option value="">Select genre</option>
      <?php foreach ($pdo->query("SELECT id,name FROM genres ORDER BY name") as $g): ?>
        <option value="<?php echo (int)$g['id']; ?>"><?php echo htmlspecialchars($g['name']); ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Synopsis <textarea name="synopsis" rows="6" required></textarea></label>
  <button type="submit">Submit</button>
</form>
<?php include __DIR__.'/includes/footer.php'; ?>
