<?php
require __DIR__.'/includes/auth.php'; require_login();
require __DIR__.'/config/db.php';

$book_id = (int)($_POST['book_id'] ?? 0);
$rating  = (int)($_POST['rating'] ?? 0);
$review  = trim($_POST['review'] ?? '');

if ($book_id && $rating >=1 && $rating <=5) {
  $stmt = $pdo->prepare("INSERT INTO reviews (user_id,book_id,rating,review)
                         VALUES (?,?,?,?)
                         ON DUPLICATE KEY UPDATE rating=VALUES(rating), review=VALUES(review)");
  $stmt->execute([ current_user()['id'], $book_id, $rating, $review ?: null ]);
}
header('Location: /ReadTrack/book.php?id=' . $book_id);
