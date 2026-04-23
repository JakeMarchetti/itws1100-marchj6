<?php
// Returns randomized questions for the selected mode and difficulty.

require_once __DIR__ . '/../includes/db.php';

$validDifficulties = ['easy', 'hard'];
$validModes = ['sudden_death', 'general'];

$difficulty = strtolower($_GET['difficulty'] ?? '');
$mode = strtolower($_GET['mode'] ?? 'general');

if (!in_array($difficulty, $validDifficulties, true)) {
    send_json(['success' => false, 'message' => 'Invalid difficulty.'], 400);
}

if (!in_array($mode, $validModes, true)) {
    send_json(['success' => false, 'message' => 'Invalid mode.'], 400);
}

try {
    $pdo = get_pdo();
    if ($mode === 'general') {
        $stmt = $pdo->prepare(
            "SELECT id, question_text, option_a, option_b, option_c, option_d,
                    correct_option, difficulty, category
             FROM questions
             WHERE difficulty = :difficulty
               AND season_year = 2025
               AND is_active = 1
             ORDER BY RAND()
             LIMIT 10"
        );
        $stmt->execute(['difficulty' => $difficulty]);
        $questions = $stmt->fetchAll();

        if (count($questions) < 10) {
            send_json([
                'success' => false,
                'message' => 'Not enough questions found for this difficulty.'
            ], 500);
        }
    } else {
        // Sudden Death uses the full active pool in random order.
        $stmt = $pdo->prepare(
            "SELECT id, question_text, option_a, option_b, option_c, option_d,
                    correct_option, difficulty, category
             FROM questions
             WHERE difficulty = :difficulty
               AND season_year = 2025
               AND is_active = 1
             ORDER BY RAND()"
        );
        $stmt->execute(['difficulty' => $difficulty]);
        $questions = $stmt->fetchAll();

        if (count($questions) < 1) {
            send_json([
                'success' => false,
                'message' => 'No questions found for this difficulty.'
            ], 500);
        }
    }

    send_json([
        'success' => true,
        'mode' => $mode,
        'difficulty' => $difficulty,
        'questions' => $questions
    ]);
} catch (PDOException $e) {
    send_json(['success' => false, 'message' => 'Database error loading questions.'], 500);
}
?>
