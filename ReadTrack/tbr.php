<?php
require __DIR__.'/includes/auth.php'; require_login();
require __DIR__.'/config/db.php';

$sql = "
SELECT b.id, b.title, u.name AS author_name
FROM tbr t
JOIN books b ON b.id=t.book_id
JOIN users u ON u.id=b.author_id
WHERE t.user_id=? AND b.status='approved'
ORDER BY t.added_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([ current_user()['id'] ]);
$items = $stmt->fetchAll();
include __DIR__.'/includes/header.php';
?>
<h2>My TBR</h2>
<div class="cards">
<?php foreach ($items as $bk): ?>
  <div class="card">
    <div class="meta">
      <div class="title"><?php echo htmlspecialchars($bk['title']); ?></div>
      <div class="author">by <?php echo htmlspecialchars($bk['author_name']); ?></div>
      <form method="post" action="/ReadTrack/remove_from_tbr.php">
        <input type="hidden" name="book_id" value="<?php echo (int)$bk['id']; ?>">
        <button type="submit">Remove</button>
      </form>
    </div>
  </div>
<?php endforeach; ?>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
