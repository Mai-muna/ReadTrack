<?php
require __DIR__.'/config/db.php';
require __DIR__.'/includes/auth.php';
include __DIR__.'/includes/header.php';

$sort = $_GET['sort'] ?? '';
$orderSql = "b.created_at DESC";
if ($sort==='rating_desc') $orderSql = "avg_rating DESC NULLS LAST, b.title ASC";
elseif ($sort==='title_asc') $orderSql = "b.title ASC";

$sql = "
SELECT b.*, u.name AS author_name, g.name AS genre_name,
       (SELECT ROUND(AVG(r.rating),2) FROM reviews r WHERE r.book_id=b.id) AS avg_rating,
       (SELECT COUNT(*) FROM reviews r WHERE r.book_id=b.id) AS rating_count
FROM books b
JOIN users u ON u.id=b.author_id
JOIN genres g ON g.id=b.genre_id
WHERE b.status='approved'
ORDER BY $orderSql
LIMIT 50";
$books = $pdo->query($sql)->fetchAll();
?>
<h2>Discover books</h2>
<div class="cards">
<?php foreach ($books as $bk): ?>
  <a class="card" href="/ReadTrack/book.php?id=<?php echo (int)$bk['id']; ?>">
    <div class="meta">
      <div class="title"><?php echo htmlspecialchars($bk['title']); ?></div>
      <div class="author">by <?php echo htmlspecialchars($bk['author_name']); ?></div>
      <div class="genre"><?php echo htmlspecialchars($bk['genre_name']); ?></div>
      <div class="rating">★ <?php echo number_format($bk['avg_rating'] ?? 0, 2); ?> (<?php echo (int)$bk['rating_count']; ?>)</div>
    </div>
  </a>
<?php endforeach; ?>
</div>
<?php include __DIR__.'/includes/footer.php'; ?>
