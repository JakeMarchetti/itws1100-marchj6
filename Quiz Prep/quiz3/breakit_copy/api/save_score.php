<?php
// Intentionally vulnerable copy for the break-it exercise.
// Do not deploy this file.

require_once __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    send_json(['success' => false, 'message' => 'POST required.'], 405);
}

$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input)) {
    $input = $_POST;
}

$validModes = ['sudden_death', 'general'];
$validDifficulties = ['easy', 'hard'];
$validTitles = ['Benchwarmer', 'Starter', 'Pro Bowler', 'All-Pro', 'Hall of Fame'];

$playerName = clean_player_name($input['player_name'] ?? '');
$mode = strtolower($input['mode'] ?? '');
$difficulty = strtolower($input['difficulty'] ?? '');
$score = filter_var($input['score'] ?? null, FILTER_VALIDATE_INT);
$totalQuestions = filter_var($input['total_questions'] ?? null, FILTER_VALIDATE_INT);
$performanceTitle = trim($input['performance_title'] ?? '');

if ($playerName === '') {
    send_json(['success' => false, 'message' => 'Player name is required.'], 400);
}

if (!in_array($mode, $validModes, true) || !in_array($difficulty, $validDifficulties, true)) {
    send_json(['success' => false, 'message' => 'Invalid mode or difficulty.'], 400);
}

if ($score === false || $totalQuestions === false || $score < 0 || $totalQuestions < 1 || $score > $totalQuestions) {
    send_json(['success' => false, 'message' => 'Invalid score data.'], 400);
}

if ($mode === 'general' && $totalQuestions !== 10) {
    send_json(['success' => false, 'message' => 'General mode must have 10 questions.'], 400);
}

if (!in_array($performanceTitle, $validTitles, true)) {
    send_json(['success' => false, 'message' => 'Invalid performance title.'], 400);
}

if ($difficulty === 'easy' && in_array($performanceTitle, ['All-Pro', 'Hall of Fame'], true)) {
    send_json(['success' => false, 'message' => 'That title is only for hard mode.'], 400);
}

try {
    $pdo = get_pdo();

    // This is the unsafe version. User input is pasted right into the SQL string.
    $sql = "INSERT INTO scores (player_name, mode, difficulty, score, total_questions, performance_title) VALUES ('"
        . $playerName . "', '"
        . $mode . "', '"
        . $difficulty . "', '"
        . $score . "', '"
        . $totalQuestions . "', '"
        . $performanceTitle . "')";

    $pdo->exec($sql);

    send_json([
        'success' => true,
        'message' => 'Score saved.',
        'score_id' => $pdo->lastInsertId()
    ]);
} catch (PDOException $e) {
    send_json(['success' => false, 'message' => 'Database error saving score.'], 500);
}
?>
