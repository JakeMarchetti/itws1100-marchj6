<?php
// Returns leaderboard rows for one mode and difficulty.

require_once __DIR__ . '/../includes/db.php';

$validModes = ['sudden_death', 'general'];
$validDifficulties = ['easy', 'hard'];

$mode = strtolower($_GET['mode'] ?? 'general');
$difficulty = strtolower($_GET['difficulty'] ?? 'easy');
$limit = filter_var($_GET['limit'] ?? 10, FILTER_VALIDATE_INT);

if (!in_array($mode, $validModes, true) || !in_array($difficulty, $validDifficulties, true)) {
    send_json(['success' => false, 'message' => 'Invalid leaderboard filter.'], 400);
}

if ($limit === false || $limit < 1 || $limit > 50) {
    $limit = 10;
}

try {
    $pdo = get_pdo();

    $stmt = $pdo->prepare(
        "SELECT player_name, mode, difficulty, score, total_questions,
                performance_title, played_at
         FROM scores
         WHERE mode = :mode
           AND difficulty = :difficulty
         ORDER BY score DESC, played_at DESC
         LIMIT $limit"
    );
    $stmt->execute([
        'mode' => $mode,
        'difficulty' => $difficulty
    ]);

    send_json([
        'success' => true,
        'mode' => $mode,
        'difficulty' => $difficulty,
        'entries' => $stmt->fetchAll()
    ]);
} catch (PDOException $e) {
    send_json(['success' => false, 'message' => 'Database error loading leaderboard.'], 500);
}
?>
