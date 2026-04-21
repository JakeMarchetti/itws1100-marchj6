Planning (generative AI chat gpt 5.4)

Prompt 1:

In this section, you will use AI (ChatGPT, Claude, Copilot, or any AI tool of your choice) to build a real, working, full-stack feature on your personal website. This is not about whether AI can write code — it can. This is about whether you can direct it, evaluate its output, catch its mistakes, and understand what it built. Build one of the following features and deploy it to your Azure server. Each option requires PHP, MySQL, and client-side code working together: 

Option C: Quiz/Trivia Game A multi-question quiz on any topic you choose. Questions stored in MySQL, served by PHP, answered interactively in the browser with JavaScript. Tracks and displays the user’s score. I want to make an NFL trivia game, I want some fun ideas with a sub 4 hour development time and a scope that matches that time constraint.

Prompt 2:
I like the sudden death NFL trivia idea. I want this implemented alongside a general NFL trivia with league wide questions such as "who was the 2025 season receiving yards leader", "how many superbowl rings does matt stafford have?", "who was the 2025 season rushing yards leader", "what team is this player on", "who was the 2025 offensive rookie of the year". I need you to breakdown what dataset tables I would need to create in my MySQL quiz3 database as well as their attributes. How I can attain this data for it to be manipulated by a chatbot and easily stored in my database to be called on for questions. I like the score tracking idea so I think that is a good way to go about replay ability. There should be varying difficulty levels, easy/hard mode and I like the end screen titles to evaluate the user's performance once reaching a certain threshold of correct answers on a select mode (all-pro and hall of fam only achievable on hard mode). First lets refine this plan by having you asking me any conceptual clarity questions to make your response as effective as possible.

Prompt 3:
1.a prewritten question bank that still offers variation in quizzes and good replay ability. 
2.A fixed 2025 season snapshot to avoid getting out of hand with the scope 
3.I'd like to prioritize sudden death mode and implement the general mode as an addition 
4.Easier facts vs. deeper facts. Easy mode only contains easy and hard mode only contians hard mode questions. 
5.name and difficulty 
6.separate by difficulty but the highest number of correctly answered questions in each mode is at the top of that respective leaderboard 
7.10 questions 
8.add on history questions to the question types 
9.Building inital dataset/questions 
10.a clean simple schema is acceptable 
11.yes simple hidden PHP pages are necessary 
12.yes that works 
Now that you have this info, I want a codex prompt ready project plan that will get me as close to what I want to achieve as possible when I give the prompt to codex.

Development (agentic AI chat gpt 5.4 Codex)

Prompt 4:
You are helping me build a real working full-stack feature for my quiz 3: an NFL trivia game. 

Project goal:
Build a PHP + MySQL + JavaScript NFL trivia app for my Azure-hosted website. The app must support:
1. Sudden Death mode (priority feature)
2. General mode as an additional mode
3. Easy and Hard difficulty
4. Score tracking with leaderboards
5. A fixed 2025 NFL season snapshot so the content does not need live updates

Important scope constraints:
- Keep the implementation simple enough for a student project and realistic to finish quickly
- Use a clean, minimal schema
- Use hidden PHP utility/admin pages for seeding/importing data
- Use vanilla JS or very light jQuery only if helpful
- Use PHP + MySQLi or PDO consistently
- Organize files cleanly and comment the code with concise student-style comments

Functional requirements:
- Home page lets the user:
  - enter their name
  - choose mode: Sudden Death or General
  - choose difficulty: Easy or Hard
  - start the quiz
- Sudden Death mode:
  - question-by-question play
  - game ends immediately on first wrong answer
  - display how many were answered correctly before elimination
- General mode:
  - exactly 10 questions
  - display final score out of 10
- Difficulty:
  - Easy mode only pulls easy questions
  - Hard mode only pulls hard questions
- Question bank:
  - prewritten question bank stored in MySQL
  - enough variation to support replayability
  - fixed 2025 snapshot
  - question types include:
    - stat leader questions
    - award winner questions
    - player-to-team questions
    - ring/count questions
    - NFL history questions
- Questions should be multiple choice with 4 options
- Questions should be randomized each game
- Avoid repeating a question within a single playthrough
- End screen titles:
  - Easy mode titles: Benchwarmer, Starter, Pro Bowler
  - Hard mode titles: Starter, Pro Bowler, All-Pro, Hall of Fame
  - All-Pro and Hall of Fame should only exist in hard mode
- Save completed runs to the leaderboard
- Leaderboards:
  - separate leaderboard per mode + difficulty
  - sort by highest score first
  - for ties, show most recent first or earliest first depending on what is simpler
- Display leaderboard on a separate page or section

Technical requirements:
- Build this as a small PHP app that can live inside a folder like /quiz3/
- Use MySQL database named quiz3
- Use a simple schema, likely:
  - questions
  - scores
- Include SQL schema creation
- Include seed data insertion method
- Include hidden admin/utility PHP pages such as:
  - import_questions.php or seed_questions.php
  - optional reset_scores.php
- Admin pages should not be linked in public navigation
- Use PHP endpoints to:
  - fetch randomized questions by difficulty and mode needs
  - save a score
  - fetch leaderboard entries
- Front-end JavaScript should:
  - fetch questions from PHP
  - render one question at a time
  - track current progress and score
  - handle sudden death stopping logic
  - submit score at end
  - render title/rank based on performance

Database design:
Use a simple, practical schema.

questions table:
- id INT AUTO_INCREMENT PRIMARY KEY
- question_text VARCHAR/TEXT
- option_a VARCHAR(255)
- option_b VARCHAR(255)
- option_c VARCHAR(255)
- option_d VARCHAR(255)
- correct_option CHAR(1)
- difficulty ENUM('easy','hard')
- category VARCHAR(100)
- season_year INT DEFAULT 2025
- is_active TINYINT(1) DEFAULT 1

scores table:
- id INT AUTO_INCREMENT PRIMARY KEY
- player_name VARCHAR(100)
- mode ENUM('sudden_death','general')
- difficulty ENUM('easy','hard')
- score INT
- total_questions INT
- performance_title VARCHAR(50)
- played_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

Question content expectations:
- Write a starter bank of high-quality NFL questions using a fixed 2025 snapshot
- Create enough questions for replayability:
  - at least 20 easy questions
  - at least 20 hard questions
- Mix categories
- Make distractors believable
- Keep wording clear
- Do not use live APIs
- Hard questions should be deeper than easy ones, not just trick wording

Implementation details:
Please generate:
1. File/folder structure
2. SQL schema file
3. Seed/import strategy
4. PHP backend files
5. JS front-end logic
6. Basic HTML/CSS structure
7. Instructions for local setup and Azure deployment
8. Suggestions for testing

Desired file structure example:
quiz3/
  index.php
  style.css
  js/
    quiz.js
  includes/
    db.php
  api/
    get_questions.php
    save_score.php
    get_leaderboard.php
  admin/
    seed_questions.php
    reset_scores.php
  sql/
    quiz3.sql

Behavior details:
- General mode fetches 10 random questions for the chosen difficulty
- Sudden death can fetch a randomized pool and stop on wrong answer
- Keep the app state in JS during gameplay
- Save only final completed run results
- Leaderboard queries should filter by mode and difficulty
- Include simple input validation and error handling
- Prevent blank player names
- Sanitize DB input safely

UI expectations:
- Clean sports-themed layout
- Show current score and progress
- Buttons for answer choices
- End screen with performance title
- Leaderboard section with tabs or buttons for different mode/difficulty combinations

Please provide the result in phases:
Phase 1: project architecture and schema
Phase 2: SQL + seed strategy
Phase 3: PHP backend files
Phase 4: front-end HTML/CSS/JS
Phase 5: deployment/testing notes

Also:
- Use concise comments that sound like a student wrote them
- Keep code practical, not overengineered
- Avoid frameworks
- If a design choice is unclear, choose the simplest option that satisfies the requirements

Start with Phase 1 and Phase 2 only.

Give me:
1. the final schema explanation
2. a complete quiz3.sql file
3. sample seed questions for both easy and hard mode
4. a short explanation of why this schema is enough for this project

Prompt 5:
Now generate Phase 3 only.

Create the PHP backend files:
- includes/db.php
- api/get_questions.php
- api/save_score.php
- api/get_leaderboard.php
- admin/seed_questions.php
- admin/reset_scores.php

Use simple PDO or MySQLi consistently.
Add concise student-style comments.
Explain what each file does.

Prompt 6:
Now generate Phase 4 only.

Create:
- index.php
- style.css
- js/quiz.js

Requirements:
- one-question-at-a-time UI
- player name input
- mode and difficulty selectors
- score/progress display
- sudden death ending logic
- general 10-question mode
- end screen with performance title
- leaderboard display

Keep the HTML tags and class names clean and easy to style.