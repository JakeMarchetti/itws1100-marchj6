<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NFL Trivia Blitz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="page-shell">
        <header class="site-header">
            <p class="eyebrow">Fixed 2025 NFL Snapshot</p>
            <h1>NFL Trivia Blitz</h1>
            <p class="intro">Pick your mode, answer fast, and chase the leaderboard.</p>
        </header>

        <section class="panel setup-panel" id="setupPanel">
            <h2>Start Game</h2>

            <form class="setup-form" id="setupForm">
                <label for="playerName">Player Name</label>
                <input type="text" id="playerName" name="playerName" maxlength="100" placeholder="Enter your name" required>

                <label for="modeSelect">Mode</label>
                <select id="modeSelect" name="mode">
                    <option value="sudden_death">Sudden Death</option>
                    <option value="general">General</option>
                </select>

                <label for="difficultySelect">Difficulty</label>
                <select id="difficultySelect" name="difficulty">
                    <option value="easy">Easy</option>
                    <option value="hard">Hard</option>
                </select>

                <button type="submit" class="primary-button">Start Quiz</button>
            </form>

            <p class="message" id="setupMessage"></p>
        </section>

        <section class="panel quiz-panel hidden" id="quizPanel">
            <div class="quiz-topbar">
                <div>
                    <span class="small-label">Score</span>
                    <strong id="scoreText">0</strong>
                </div>
                <div>
                    <span class="small-label">Progress</span>
                    <strong id="progressText">Question 1</strong>
                </div>
                <div>
                    <span class="small-label">Mode</span>
                    <strong id="modeText">Sudden Death</strong>
                </div>
            </div>

            <article class="question-card">
                <p class="category-pill" id="categoryText">Category</p>
                <h2 id="questionText">Question text</h2>
                <div class="answers" id="answers"></div>
            </article>

            <p class="message" id="quizMessage"></p>
        </section>

        <section class="panel end-panel hidden" id="endPanel">
            <p class="eyebrow" id="endEyebrow">Final Result</p>
            <h2 id="endTitle">Starter</h2>
            <p class="final-score" id="finalScoreText">You scored 0.</p>
            <p class="message" id="saveMessage"></p>
            <div class="button-row">
                <button type="button" class="primary-button" id="playAgainButton">Play Again</button>
                <button type="button" class="secondary-button" id="showLeaderboardButton">View Leaderboard</button>
            </div>
        </section>

        <section class="panel leaderboard-panel" id="leaderboardPanel">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">Leaderboard</p>
                    <h2>Top Scores</h2>
                </div>
                <button type="button" class="secondary-button" id="refreshLeaderboardButton">Refresh</button>
            </div>

            <div class="leaderboard-controls">
                <select id="leaderboardMode">
                    <option value="sudden_death">Sudden Death</option>
                    <option value="general">General</option>
                </select>
                <select id="leaderboardDifficulty">
                    <option value="easy">Easy</option>
                    <option value="hard">Hard</option>
                </select>
            </div>

            <div class="table-wrap">
                <table class="leaderboard-table">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Score</th>
                            <th>Title</th>
                            <th>Played</th>
                        </tr>
                    </thead>
                    <tbody id="leaderboardBody">
                        <tr>
                            <td colspan="5">Loading scores...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="js/quiz.js"></script>
</body>
</html>
