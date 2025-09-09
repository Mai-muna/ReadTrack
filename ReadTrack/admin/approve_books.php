<?php
require __DIR__.'/../includes/auth.php'; require_login(); require_role('admin');
require __DIR__.'/../config/db.php';

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $id = (int)($_POST['id'] ?? 0);
  $action = $_POST['action'] ?? '';
  if ($id && in_array($action, ['approve','reject'], true)) {
    if ($action==='approve') {
      $stmt = $pdo->prepare("UPDATE books SET status='approved' WHERE id=?");
      $stmt->execute([$id]);
    } else {
      $stmt = $pdo->prepare("DELETE FROM books WHERE id=?");
      $stmt->execute([$id]);
    }
  }
  header('Location: /ReadTrack/admin/approve_books.php');
  exit;
}

$pending = $pdo->query("
SELECT b.*, u.name AS author_name, g.name AS genre_name
FROM books b
JOIN users u ON u.id=b.author_id
JOIN genres g ON g.id=b.genre_id
WHERE b.status='pending'
ORDER BY b.created_at ASC
")->fetchAll();

include __DIR__.'/../includes/header.php';
?>
<h2>Admin: Pending Books</h2>
<?php if (!$pending): ?>
  <p>No pending books.</p>
<?php else: foreach ($pending as $bk): ?>
  <div class="pending">
    <div>
      <h3><?php echo htmlspecialchars($bk['title']); ?></h3>
      <div>Author: <?php echo htmlspecialchars($bk['author_name']); ?> | Genre: <?php echo htmlspecialchars($bk['genre_name']); ?></div>
      <p><?php echo nl2br(htmlspecialchars($bk['synopsis'])); ?></p>
      <form method="post" style="display:inline">
        <input type="hidden" name="id" value="<?php echo (int)$bk['id']; ?>">
        <button name="action" value="approve">Approve</button>
      </form>
      <form method="post" style="display:inline" onsubmit="return confirm('Reject and delete this book?');">
        <input type="hidden" name="id" value="<?php echo (int)$bk['id']; ?>">
        <button name="action" value="reject">Reject</button>
      </form>
    </div>
  </div>
<?php endforeach; endif; ?>
<?php include __DIR__.'/../includes/footer.php'; ?>
