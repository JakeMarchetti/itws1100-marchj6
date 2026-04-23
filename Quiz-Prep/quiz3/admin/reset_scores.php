<?php
// Hidden utility page to clear leaderboard scores.

require_once __DIR__ . '/../includes/db.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $confirm = trim($_POST['confirm'] ?? '');

    if ($confirm !== 'RESET') {
        $error = 'Type RESET to confirm.';
    } else {
        try {
            $pdo = get_pdo();
            $pdo->exec('DELETE FROM scores');
            $message = 'All leaderboard scores were reset.';
        } catch (PDOException $e) {
            $error = 'Reset failed.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Reset NFL Trivia Scores</title>
</head>
<body>
    <h1>Reset NFL Trivia Scores</h1>
    <p>This hidden page clears the <code>scores</code> table.</p>

    <?php if ($message): ?>
        <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="post">
        <label>
            Type RESET:
            <input type="text" name="confirm">
        </label>
        <button type="submit">Reset Scores</button>
    </form>
</body>
</html>
