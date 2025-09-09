<?php
require __DIR__.'/includes/auth.php'; require_login();
require __DIR__.'/config/db.php';

$book_id = (int)($_POST['book_id'] ?? 0);
if ($book_id) {
  $stmt = $pdo->prepare("DELETE FROM tbr WHERE user_id=? AND book_id=?");
  $stmt->execute([ current_user()['id'], $book_id ]);
}
header('Location: /ReadTrack/tbr.php');
