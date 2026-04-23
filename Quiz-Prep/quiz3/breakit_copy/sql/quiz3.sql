-- Quiz 3 NFL Trivia database
-- Fixed snapshot: 2025 NFL season plus stable NFL history

CREATE DATABASE IF NOT EXISTS quiz3
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE quiz3;

CREATE TABLE IF NOT EXISTS questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question_text VARCHAR(500) NOT NULL,
  option_a VARCHAR(255) NOT NULL,
  option_b VARCHAR(255) NOT NULL,
  option_c VARCHAR(255) NOT NULL,
  option_d VARCHAR(255) NOT NULL,
  correct_option CHAR(1) NOT NULL,
  difficulty ENUM('easy', 'hard') NOT NULL,
  category VARCHAR(100) NOT NULL,
  season_year INT NOT NULL DEFAULT 2025,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  UNIQUE KEY uq_question_snapshot (question_text, season_year),
  INDEX idx_questions_lookup (difficulty, is_active, season_year),
  CHECK (correct_option IN ('A', 'B', 'C', 'D'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS scores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  player_name VARCHAR(100) NOT NULL,
  mode ENUM('sudden_death', 'general') NOT NULL,
  difficulty ENUM('easy', 'hard') NOT NULL,
  score INT NOT NULL,
  total_questions INT NOT NULL,
  performance_title VARCHAR(50) NOT NULL,
  played_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_leaderboard (mode, difficulty, score DESC, played_at DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Starter question bank. INSERT IGNORE keeps reruns from adding duplicates.
INSERT IGNORE INTO questions
(question_text, option_a, option_b, option_c, option_d, correct_option, difficulty, category, season_year, is_active)
VALUES
('Which quarterback won AP NFL MVP for the 2025 season?', 'Josh Allen', 'Matthew Stafford', 'Patrick Mahomes', 'Lamar Jackson', 'B', 'easy', 'award winner', 2025, 1),
('Which team did Matthew Stafford play for in the fixed 2025 snapshot?', 'Los Angeles Rams', 'Detroit Lions', 'Dallas Cowboys', 'Seattle Seahawks', 'A', 'easy', 'player-to-team', 2025, 1),
('Who led the NFL in passing yards during the 2025 regular season?', 'Dak Prescott', 'Jared Goff', 'Matthew Stafford', 'Drake Maye', 'C', 'easy', 'stat leader', 2025, 1),
('Who led the NFL in rushing yards during the 2025 regular season?', 'Derrick Henry', 'James Cook', 'Jonathan Taylor', 'Bijan Robinson', 'B', 'easy', 'stat leader', 2025, 1),
('Who led the NFL in receiving yards during the 2025 regular season?', 'Puka Nacua', 'Ja''Marr Chase', 'Jaxon Smith-Njigba', 'Amon-Ra St. Brown', 'C', 'easy', 'stat leader', 2025, 1),
('Which player won AP Offensive Player of the Year for the 2025 season?', 'Jaxon Smith-Njigba', 'Christian McCaffrey', 'Puka Nacua', 'Bijan Robinson', 'A', 'easy', 'award winner', 2025, 1),
('Which player won AP Defensive Player of the Year for the 2025 season?', 'T.J. Watt', 'Micah Parsons', 'Myles Garrett', 'Nick Bosa', 'C', 'easy', 'award winner', 2025, 1),
('Which team did Myles Garrett play for in the fixed 2025 snapshot?', 'Cleveland Browns', 'Pittsburgh Steelers', 'Houston Texans', 'New York Giants', 'A', 'easy', 'player-to-team', 2025, 1),
('Which player won AP Offensive Rookie of the Year for the 2025 season?', 'Ashton Jeanty', 'Tetairoa McMillan', 'Travis Hunter', 'Cam Ward', 'B', 'easy', 'award winner', 2025, 1),
('Which player won AP Defensive Rookie of the Year for the 2025 season?', 'Abdul Carter', 'Mason Graham', 'Will Johnson', 'Carson Schwesinger', 'D', 'easy', 'award winner', 2025, 1),
('Which NFL team won the Super Bowl for the 2025 season snapshot?', 'Seattle Seahawks', 'Kansas City Chiefs', 'Philadelphia Eagles', 'San Francisco 49ers', 'A', 'easy', 'award/history', 2025, 1),
('Which team does Patrick Mahomes play for?', 'Kansas City Chiefs', 'Buffalo Bills', 'Cincinnati Bengals', 'Baltimore Ravens', 'A', 'easy', 'player-to-team', 2025, 1),
('Which team does Joe Burrow play for?', 'Chicago Bears', 'Cincinnati Bengals', 'New York Jets', 'Tennessee Titans', 'B', 'easy', 'player-to-team', 2025, 1),
('Which team does Lamar Jackson play for?', 'Baltimore Ravens', 'Atlanta Falcons', 'Las Vegas Raiders', 'New Orleans Saints', 'A', 'easy', 'player-to-team', 2025, 1),
('Which team does Josh Allen play for?', 'Buffalo Bills', 'Miami Dolphins', 'Denver Broncos', 'Green Bay Packers', 'A', 'easy', 'player-to-team', 2025, 1),
('How many teams are in the NFL?', '28', '30', '32', '34', 'C', 'easy', 'ring/count', 2025, 1),
('How many points is a touchdown worth before the extra point try?', '3', '6', '7', '8', 'B', 'easy', 'history/rules', 2025, 1),
('What trophy is awarded to the Super Bowl champion?', 'Heisman Trophy', 'Stanley Cup', 'Vince Lombardi Trophy', 'Commissioner''s Trophy', 'C', 'easy', 'history', 2025, 1),
('Which team won the first Super Bowl?', 'Green Bay Packers', 'Dallas Cowboys', 'New York Giants', 'Pittsburgh Steelers', 'A', 'easy', 'history', 2025, 1),
('Which quarterback has won the most Super Bowl rings as a player?', 'Joe Montana', 'Tom Brady', 'Terry Bradshaw', 'Patrick Mahomes', 'B', 'easy', 'ring/count', 2025, 1),

('How many passing yards did Matthew Stafford finish with as the 2025 regular-season passing leader?', '4,394', '4,552', '4,564', '4,707', 'D', 'hard', 'stat leader', 2025, 1),
('Who finished second in 2025 regular-season passing yards?', 'Dak Prescott', 'Drake Maye', 'Jared Goff', 'Patrick Mahomes', 'C', 'hard', 'stat leader', 2025, 1),
('How many rushing yards did James Cook finish with as the 2025 regular-season rushing leader?', '1,478', '1,585', '1,595', '1,621', 'D', 'hard', 'stat leader', 2025, 1),
('Who finished second in 2025 regular-season rushing yards?', 'Derrick Henry', 'Jonathan Taylor', 'Bijan Robinson', 'De''Von Achane', 'A', 'hard', 'stat leader', 2025, 1),
('How many receiving yards did Jaxon Smith-Njigba finish with as the 2025 regular-season receiving leader?', '1,637', '1,715', '1,793', '1,856', 'C', 'hard', 'stat leader', 2025, 1),
('Who led the NFL in receptions during the 2025 regular season?', 'Puka Nacua', 'Trey McBride', 'Ja''Marr Chase', 'Jaxon Smith-Njigba', 'A', 'hard', 'stat leader', 2025, 1),
('Which Browns defensive end won the Deacon Jones Sack Leader Award for the 2025 season?', 'Za''Darius Smith', 'Myles Garrett', 'Alex Wright', 'Ogbo Okoronkwo', 'B', 'hard', 'award winner', 2025, 1),
('Which head coach won AP Coach of the Year for the 2025 season?', 'Mike Macdonald', 'Dan Campbell', 'Mike Vrabel', 'Sean McVay', 'C', 'hard', 'award winner', 2025, 1),
('Which player won AP Comeback Player of the Year for the 2025 season?', 'Joe Burrow', 'Christian McCaffrey', 'Aaron Rodgers', 'Cooper Kupp', 'B', 'hard', 'award winner', 2025, 1),
('Which player won the Walter Payton NFL Man of the Year award for the 2025 season?', 'Bobby Wagner', 'Patrick Mahomes', 'Cameron Heyward', 'Dak Prescott', 'A', 'hard', 'award winner', 2025, 1),
('Which player won the Art Rooney Sportsmanship Award for the 2025 season?', 'Budda Baker', 'Justin Jefferson', 'George Kittle', 'Jalen Hurts', 'A', 'hard', 'award winner', 2025, 1),
('Which offensive lineman won Protector of the Year for the 2025 season?', 'Penei Sewell', 'Trent Williams', 'Joe Thuney', 'Lane Johnson', 'C', 'hard', 'award winner', 2025, 1),
('Which team did Jaxon Smith-Njigba play for in the fixed 2025 snapshot?', 'Seattle Seahawks', 'Los Angeles Rams', 'Cincinnati Bengals', 'Detroit Lions', 'A', 'hard', 'player-to-team', 2025, 1),
('Which team did Tetairoa McMillan play for when he won AP Offensive Rookie of the Year?', 'Carolina Panthers', 'Arizona Cardinals', 'Tennessee Titans', 'New England Patriots', 'A', 'hard', 'player-to-team', 2025, 1),
('Which team did Carson Schwesinger play for when he won AP Defensive Rookie of the Year?', 'Cleveland Browns', 'Chicago Bears', 'Jacksonville Jaguars', 'New York Jets', 'A', 'hard', 'player-to-team', 2025, 1),
('Which player was part of the Pro Football Hall of Fame Class of 2026 announced during the 2025 season honors?', 'Drew Brees', 'Eli Manning', 'Adrian Peterson', 'Rob Gronkowski', 'A', 'hard', 'history', 2025, 1),
('Which team completed the NFL''s only perfect season including a Super Bowl win?', '1985 Chicago Bears', '1972 Miami Dolphins', '2007 New England Patriots', '1999 St. Louis Rams', 'B', 'hard', 'history', 2025, 1),
('Which NFL team lost four straight Super Bowls in the early 1990s?', 'Minnesota Vikings', 'Denver Broncos', 'Buffalo Bills', 'Atlanta Falcons', 'C', 'hard', 'history', 2025, 1),
('Who is the NFL''s all-time rushing yards leader?', 'Walter Payton', 'Barry Sanders', 'Emmitt Smith', 'Adrian Peterson', 'C', 'hard', 'history', 2025, 1),
('Which franchise has the most total NFL championships when counting pre-Super Bowl titles?', 'Green Bay Packers', 'Pittsburgh Steelers', 'New England Patriots', 'Dallas Cowboys', 'A', 'hard', 'ring/count', 2025, 1);
