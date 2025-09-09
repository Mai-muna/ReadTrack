<?php
require __DIR__.'/includes/auth.php'; require_login();
require __DIR__.'/config/db.php';

$u = current_user();
$year = (int)($_GET['year'] ?? date('Y'));
$msg = $err = '';

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $year = (int)($_POST['year'] ?? date('Y'));
  $target = max(0, (int)($_POST['target'] ?? 0));
  $progress = max(0, (int)($_POST['progress'] ?? 0));
  $stmt = $pdo->prepare("INSERT INTO reading_goals (user_id,year,target,progress)
                         VALUES (?,?,?,?)
                         ON DUPLICATE KEY UPDATE target=VALUES(target), progress=VALUES(progress)");
  $stmt->execute([$u['id'],$year,$target,$progress]);
  $msg = "Saved goal for $year";
}

$stmt = $pdo->prepare("SELECT * FROM reading_goals WHERE user_id=? AND year=?");
$stmt->execute([$u['id'],$year]);
$goal = $stmt->fetch();

include __DIR__.'/includes/header.php';
?>
<h2>Reading Goals</h2>
<?php if ($msg): ?><div class="notice"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
<?php if ($err): ?><div class="alert"><?php echo htmlspecialchars($err); ?></div><?php endif; ?>

<form method="post">
  <label>Year <input type="number" name="year" value="<?php echo $year; ?>" min="2000" max="2100"></label>
  <label>Target books <input type="number" name="target" min="0" value="<?php echo (int)($goal['target'] ?? 0); ?>"></label>
  <label>Progress <input type="number" name="progress" min="0" value="<?php echo (int)($goal['progress'] ?? 0); ?>"></label>
  <button type="submit">Save</button>
</form>

<?php if ($goal): 
$target = (int)$goal['target']; $progress = (int)$goal['progress'];
$percent = $target ? min(100, round($progress*100/$target)) : 0;
?>
<div class="goalbar"><div style="width: <?php echo $percent; ?>%"></div></div>
<p><?php echo $progress; ?> / <?php echo $target; ?> books (<?php echo $percent; ?>%)</p>
<?php endif; ?>
<?php include __DIR__.'/includes/footer.php'; ?>
