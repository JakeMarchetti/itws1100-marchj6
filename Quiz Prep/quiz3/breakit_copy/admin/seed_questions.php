<?php
// Hidden utility page to create tables and load starter questions.

require_once __DIR__ . '/../includes/db.php';

$sqlFile = __DIR__ . '/../sql/quiz3.sql';
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!file_exists($sqlFile)) {
            throw new RuntimeException('Could not find sql/quiz3.sql.');
        }

        $sql = file_get_contents($sqlFile);
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        $pdo = get_pdo(false);

        foreach ($statements as $statement) {
            if ($statement !== '') {
                $pdo->exec($statement);
            }
        }

        $message = 'Database was created and starter questions were seeded.';
    } catch (Exception $e) {
        $error = 'Seed failed: ' . $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Seed NFL Trivia Questions</title>
</head>
<body>
    <h1>Seed NFL Trivia Questions</h1>
    <p>This hidden page imports <code>sql/quiz3.sql</code>.</p>

    <?php if ($message): ?>
        <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="post">
        <button type="submit">Run Seed Script</button>
    </form>
</body>
</html>
