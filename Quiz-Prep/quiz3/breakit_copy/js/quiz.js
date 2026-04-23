// Intentionally vulnerable copy for the break-it exercise.
// Do not deploy this file.

const setupPanel = document.querySelector('#setupPanel');
const quizPanel = document.querySelector('#quizPanel');
const endPanel = document.querySelector('#endPanel');
const setupForm = document.querySelector('#setupForm');
const setupMessage = document.querySelector('#setupMessage');
const quizMessage = document.querySelector('#quizMessage');
const saveMessage = document.querySelector('#saveMessage');

const playerNameInput = document.querySelector('#playerName');
const modeSelect = document.querySelector('#modeSelect');
const difficultySelect = document.querySelector('#difficultySelect');

const scoreText = document.querySelector('#scoreText');
const progressText = document.querySelector('#progressText');
const modeText = document.querySelector('#modeText');
const categoryText = document.querySelector('#categoryText');
const questionText = document.querySelector('#questionText');
const answers = document.querySelector('#answers');

const endEyebrow = document.querySelector('#endEyebrow');
const endTitle = document.querySelector('#endTitle');
const finalScoreText = document.querySelector('#finalScoreText');
const playAgainButton = document.querySelector('#playAgainButton');
const showLeaderboardButton = document.querySelector('#showLeaderboardButton');

const leaderboardMode = document.querySelector('#leaderboardMode');
const leaderboardDifficulty = document.querySelector('#leaderboardDifficulty');
const leaderboardBody = document.querySelector('#leaderboardBody');
const refreshLeaderboardButton = document.querySelector('#refreshLeaderboardButton');
const leaderboardPanel = document.querySelector('#leaderboardPanel');

let game = {
    playerName: '',
    mode: 'sudden_death',
    difficulty: 'easy',
    questions: [],
    currentIndex: 0,
    score: 0,
    finished: false
};

setupForm.addEventListener('submit', startGame);
playAgainButton.addEventListener('click', resetToSetup);
showLeaderboardButton.addEventListener('click', () => {
    leaderboardPanel.scrollIntoView({ behavior: 'smooth' });
});
refreshLeaderboardButton.addEventListener('click', loadLeaderboard);
leaderboardMode.addEventListener('change', loadLeaderboard);
leaderboardDifficulty.addEventListener('change', loadLeaderboard);

loadLeaderboard();

async function startGame(event) {
    event.preventDefault();

    const playerName = playerNameInput.value.trim().replace(/\s+/g, ' ');
    const mode = modeSelect.value;
    const difficulty = difficultySelect.value;

    if (!playerName) {
        showMessage(setupMessage, 'Please enter your name first.', 'error');
        return;
    }

    showMessage(setupMessage, 'Loading questions...');

    try {
        const response = await fetch(`api/get_questions.php?mode=${encodeURIComponent(mode)}&difficulty=${encodeURIComponent(difficulty)}`);
        const data = await response.json();

        if (!data.success) {
            throw new Error(data.message || 'Could not load questions.');
        }

        game = {
            playerName,
            mode,
            difficulty,
            questions: data.questions,
            currentIndex: 0,
            score: 0,
            finished: false
        };

        setupPanel.classList.add('hidden');
        endPanel.classList.add('hidden');
        quizPanel.classList.remove('hidden');
        showMessage(setupMessage, '');
        showQuestion();
    } catch (error) {
        showMessage(setupMessage, error.message, 'error');
    }
}

function showQuestion() {
    const question = game.questions[game.currentIndex];
    const questionNumber = game.currentIndex + 1;
    const totalText = game.mode === 'general' ? ` of 10` : '';

    scoreText.textContent = game.score;
    progressText.textContent = `Question ${questionNumber}${totalText}`;
    modeText.textContent = formatMode(game.mode);
    categoryText.textContent = question.category;
    questionText.textContent = question.question_text;
    answers.innerHTML = '';
    showMessage(quizMessage, '');

    const options = [
        ['A', question.option_a],
        ['B', question.option_b],
        ['C', question.option_c],
        ['D', question.option_d]
    ];

    options.forEach(([letter, text]) => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'answer-button';
        button.textContent = `${letter}. ${text}`;
        button.addEventListener('click', () => chooseAnswer(letter, button));
        answers.appendChild(button);
    });
}

function chooseAnswer(choice, clickedButton) {
    if (game.finished) {
        return;
    }

    const question = game.questions[game.currentIndex];
    const isCorrect = choice === question.correct_option;
    const buttons = answers.querySelectorAll('.answer-button');

    buttons.forEach((button) => {
        button.disabled = true;
        if (button.textContent.startsWith(`${question.correct_option}.`)) {
            button.classList.add('correct');
        }
    });

    if (!isCorrect) {
        clickedButton.classList.add('wrong');
    } else {
        game.score += 1;
        scoreText.textContent = game.score;
    }

    if (game.mode === 'sudden_death' && !isCorrect) {
        showMessage(quizMessage, 'Wrong answer. Sudden Death is over.', 'error');
        setTimeout(() => finishGame(), 900);
        return;
    }

    game.currentIndex += 1;

    if (game.mode === 'general' && game.currentIndex >= 10) {
        setTimeout(() => finishGame(), 700);
        return;
    }

    if (game.currentIndex >= game.questions.length) {
        setTimeout(() => finishGame(), 700);
        return;
    }

    setTimeout(showQuestion, 700);
}

async function finishGame() {
    game.finished = true;

    const totalQuestions = game.mode === 'general' ? 10 : Math.max(game.currentIndex + 1, game.score);
    const title = getPerformanceTitle(game.score, totalQuestions, game.difficulty, game.mode);

    quizPanel.classList.add('hidden');
    endPanel.classList.remove('hidden');

    endEyebrow.textContent = game.mode === 'sudden_death' ? 'Sudden Death Result' : 'Final Result';
    endTitle.textContent = title;

    if (game.mode === 'sudden_death') {
        finalScoreText.textContent = `${game.playerName}, you survived ${game.score} question${game.score === 1 ? '' : 's'}.`;
    } else {
        finalScoreText.textContent = `${game.playerName}, you scored ${game.score} out of 10.`;
    }

    await saveScore(title, totalQuestions);
    leaderboardMode.value = game.mode;
    leaderboardDifficulty.value = game.difficulty;
    loadLeaderboard();
}

async function saveScore(title, totalQuestions) {
    showMessage(saveMessage, 'Saving score...');

    try {
        const response = await fetch('api/save_score.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                player_name: game.playerName,
                mode: game.mode,
                difficulty: game.difficulty,
                score: game.score,
                total_questions: totalQuestions,
                performance_title: title
            })
        });

        const data = await response.json();
        if (!data.success) {
            throw new Error(data.message || 'Score was not saved.');
        }

        showMessage(saveMessage, 'Score saved to the leaderboard.', 'success');
    } catch (error) {
        showMessage(saveMessage, error.message, 'error');
    }
}

async function loadLeaderboard() {
    const mode = leaderboardMode.value;
    const difficulty = leaderboardDifficulty.value;

    leaderboardBody.innerHTML = '<tr><td colspan="5">Loading scores...</td></tr>';

    try {
        const response = await fetch(`api/get_leaderboard.php?mode=${encodeURIComponent(mode)}&difficulty=${encodeURIComponent(difficulty)}`);
        const data = await response.json();

        if (!data.success) {
            throw new Error(data.message || 'Could not load leaderboard.');
        }

        if (data.entries.length === 0) {
            leaderboardBody.innerHTML = '<tr><td colspan="5">No scores yet.</td></tr>';
            return;
        }

        leaderboardBody.innerHTML = '';
        data.entries.forEach((entry, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${entry.player_name}</td>
                <td>${entry.score}/${entry.total_questions}</td>
                <td>${entry.performance_title}</td>
                <td>${formatDate(entry.played_at)}</td>
            `;
            leaderboardBody.appendChild(row);
        });
    } catch (error) {
        leaderboardBody.innerHTML = `<tr><td colspan="5">${escapeHtml(error.message)}</td></tr>`;
    }
}

function getPerformanceTitle(score, totalQuestions, difficulty, mode) {
    const percent = totalQuestions > 0 ? score / totalQuestions : 0;

    if (difficulty === 'easy') {
        if (percent >= 0.8) return 'Pro Bowler';
        if (percent >= 0.4) return 'Starter';
        return 'Benchwarmer';
    }

    if (mode === 'sudden_death') {
        if (score >= 15) return 'Hall of Fame';
        if (score >= 10) return 'All-Pro';
        if (score >= 5) return 'Pro Bowler';
        return 'Starter';
    }

    if (score >= 10) return 'Hall of Fame';
    if (score >= 8) return 'All-Pro';
    if (score >= 5) return 'Pro Bowler';
    return 'Starter';
}

function resetToSetup() {
    endPanel.classList.add('hidden');
    quizPanel.classList.add('hidden');
    setupPanel.classList.remove('hidden');
    showMessage(saveMessage, '');
    showMessage(quizMessage, '');
}

function showMessage(element, text, type = '') {
    element.textContent = text;
    element.className = `message ${type}`.trim();
}

function formatMode(mode) {
    return mode === 'sudden_death' ? 'Sudden Death' : 'General';
}

function formatDate(value) {
    const date = new Date(value.replace(' ', 'T'));
    if (Number.isNaN(date.getTime())) {
        return value;
    }

    return date.toLocaleDateString([], {
        month: 'short',
        day: 'numeric',
        year: 'numeric'
    });
}

function escapeHtml(value) {
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}
