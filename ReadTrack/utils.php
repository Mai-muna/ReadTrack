<?php
function sanitize_filename($name) {
    $name = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $name);
    return substr($name, 0, 120);
}
/** Returns [avg, count] for a book */
function rating_summary(PDO $pdo, int $book_id) {
    $stmt = $pdo->prepare("SELECT ROUND(AVG(rating),2) AS avg_rating, COUNT(*) AS cnt FROM reviews WHERE book_id=?");
    $stmt->execute([$book_id]);
    $r = $stmt->fetch();
    return [$r['avg_rating'] ?: 0, (int)$r['cnt']];
}
