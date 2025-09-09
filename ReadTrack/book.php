<?php
require __DIR__.'/config/db.php';
require __DIR__.'/includes/auth.php';
require __DIR__.'/utils.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("
SELECT b.*, u.name AS author_name, g.name AS genre_name
FROM books b
JOIN users u ON u.id=b.author_id
JOIN genres g ON g.id=b.genre_id
WHERE b.id=? AND b.status='approved'");
$stmt->execute([$id]);
$book = $stmt->fetch();
if (!$book) { http_response_code(404); die("Book not found"); }

list($avg, $cnt) = rating_summary($pdo, $id);

$r = $pdo->prepare("
SELECT r.*, us.name AS user_name
FROM reviews r JOIN users us ON us.id=r.user_id
WHERE r.book_id=? ORDER BY r.created_at DESC");
$r->execute([$id]);
$reviews = $r->fetchAll();

include __DIR__.'/includes/header.php';
?>
<div class="book-page">
  <h2><?php echo htmlspecialchars($book['title']); ?></h2>
  <div>by <strong><?php echo htmlspecialchars($book['author_name']); ?></strong></div>
  <div>Genre: <?php echo htmlspecialchars($book['genre_name']); ?></div>
  <div>Rating: ★ <?php echo number_format($avg,2); ?> (<?php echo $cnt; ?>)</div>
  <p><?php echo nl2br(htmlspecialchars($book['synopsis'])); ?></p>
  <?php if (current_user()): ?>
    <form method="post" action="/ReadTrack/add_to_tbr.php" style="display:inline;">
      <input type="hidden" name="book_id" value="<?php echo (int)$book['id']; ?>">
      <button type="submit">Add to TBR</button>
    </form>
  <?php endif; ?>
</div>

<?php if (current_user()): ?>
<section>
  <h3>Your rating & review</h3>
  <form method="post" action="/ReadTrack/rate_review.php">
    <input type="hidden" name="book_id" value="<?php echo (int)$book['id']; ?>">
    <label>Rating (1–5) <input type="number" min="1" max="5" name="rating" required></label>
    <label>Review <textarea name="review" rows="4" placeholder="Write your thoughts (optional)"></textarea></label>
    <button type="submit">Submit</button>
  </form>
</section>
<?php endif; ?>

<section>
  <h3>Reviews</h3>
  <?php if (!$reviews): ?>
    <p>No reviews yet.</p>
  <?php else: foreach ($reviews as $rev): ?>
  <div class="review">
    <div class="rev-head">
      <strong><?php echo htmlspecialchars($rev['user_name']); ?></strong>
      <span>★ <?php echo (int)$rev['rating']; ?></span>
      <span class="date"><?php echo htmlspecialchars($rev['created_at']); ?></span>
    </div>
    <div><?php echo nl2br(htmlspecialchars($rev['review'] ?? '')); ?></div>
  </div>
  <?php endforeach; endif; ?>
</section>
<?php include __DIR__.'/includes/footer.php'; ?>
