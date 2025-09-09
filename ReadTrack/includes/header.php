<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ReadTrack</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="/ReadTrack/assets/style.css">
</head>
<body>
<header class="topbar">
  <div class="container">
    <a class="brand" href="/ReadTrack/index.php">ReadTrack</a>
    <form class="search" method="get" action="/ReadTrack/search.php">
      <input name="q" type="text" placeholder="Search books...">
      <select name="genre">
        <option value="">All genres</option>
        <?php
        require __DIR__ . '/../config/db.php';
        foreach ($pdo->query("SELECT id,name FROM genres ORDER BY name") as $g) {
          $gid = (int)$g['id']; $gn = htmlspecialchars($g['name']);
          echo "<option value=\"$gid\">$gn</option>";
        }
        ?>
      </select>
      <select name="sort">
        <option value="">Sort</option>
        <option value="rating_desc">Top rated</option>
        <option value="newest">Newest</option>
        <option value="title_asc">Title A–Z</option>
      </select>
      <button type="submit">Search</button>
    </form>
    <nav>
      <?php if (!empty($_SESSION['user'])): $u=$_SESSION['user']; ?>
        <a href="/ReadTrack/tbr.php">My TBR</a>
        <a href="/ReadTrack/goals.php">Goals</a>
        <?php if ($u['role']==='author'): ?>
          <a href="/ReadTrack/add_book.php">Upload Book</a>
        <?php endif; ?>
        <?php if ($u['role']==='admin'): ?>
          <a href="/ReadTrack/admin/approve_books.php">Admin</a>
        <?php endif; ?>
        <a href="/ReadTrack/profile.php">Profile</a>
        <a href="/ReadTrack/logout.php">Logout</a>
      <?php else: ?>
        <a href="/ReadTrack/login.php">Login</a>
        <a href="/ReadTrack/register.php">Register</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
<main class="container">
