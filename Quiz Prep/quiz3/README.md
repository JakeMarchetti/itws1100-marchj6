Github ID: JakeMarchetti
Repo Name: itws1100-marchj6
FDQN: http://marchj6rpi.eastus.cloudapp.azure.com/iit
Discord: jeg481

Question 3 Overview:
The application is a full-stack web app that lets users test their NFL knowledge through two modes: General mode, which gives a fixed set of 10 random questions, and Sudden Death, which pulls from the entire question bank in random order until the user gets one wrong or completes it perfectly. The app uses a MySQL database to store questions and leaderboard scores, a PHP backend with PDO to securely fetch questions and save results, and a JavaScript frontend to handle gameplay, scoring, and dynamic UI updates like shuffled answer choices and progress tracking. It also includes a scalable question bank (currently 40 easy and 40 hard questions), percentage-based performance titles, and leaderboard filtering by mode and difficulty. Overall, the design separates logic cleanly between frontend and backend while maintaining security through prepared statements and escaped output, making it both functional and safe for users.


Question 3 FDQN: http://marchj6rpi.eastus.cloudapp.azure.com/iit/Quiz-Prep/quiz3
