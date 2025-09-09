<?php
require __DIR__.'/config/db.php';
require __DIR__.'/includes/auth.php';

$q = trim($_GET['q'] ?? '');
$genre = (int)($_GET['genre'] ?? 0);
$sort = $_GET['sort'] ?? '';

// Sorting options
$orderSql = "b.created_at DESC";

if ($sort==='rating_desc') {
    // push unrated books (NULL avg_rating) to the bottom
    $orderSql = "avg_rating IS NULL, avg_rating DESC, b.title ASC";
} elseif ($sort==='title_asc') {
    $orderSql = "b.title ASC";
} elseif ($sort==='newest') {
    $orderSql = "b.created_at DESC";
}

// Build WHERE conditions
$where = ["b.status='approved'"];
$params = [];

if ($q !== '') {
    $where[] = "b.title LIKE ?";
    $params[] = "%$q%";
}
if ($genre > 0) {
    $where[] = "b.genre_id = ?";
    $params[] = $genre;
}

$sql = "
SELECT b.*, u.name AS author_name, g.name AS genre_name,
       (SELECT ROUND(AVG(r.rating),2) FROM reviews r WHERE r.book_id=b.id) AS avg_rating,
       (SELECT COUNT(*) FROM reviews r WHERE r.book_id=b.id) AS rating_count
FROM books b
JOIN users u ON u.id=b.author_id
JOIN genres g ON g.id=b.genre_id
WHERE " . implode(' AND ', $where) . "
ORDER BY $orderSql
LIMIT 100";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$books = $stmt->fetchAll();

include __DIR__.'/includes/header.php';
?>
<h2>Search results</h2>
<p>Found <?php echo count($books); ?> book(s)</p>
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
