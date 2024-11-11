CREATE TABLE options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT NOT NULL, -- Foreign key to the `questions` table
    option_text VARCHAR(255) NOT NULL, -- Option text
    is_correct BOOLEAN DEFAULT FALSE, -- Whether this option is correct
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);

CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_text VARCHAR(255) NOT NULL, -- The question text
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE quiz_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT NOT NULL, -- Foreign key to the `quizzes` table
    question_id INT NOT NULL, -- Foreign key to the `questions` table
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);
CREATE TABLE quizzes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL, -- Name of the quiz
    description TEXT, -- Optional description of the quiz
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE user_quiz_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, -- Foreign key to `users` table
    quiz_id INT NOT NULL, -- Foreign key to `quizzes` table
    score INT NOT NULL, -- Score obtained by the user
    total_questions INT NOT NULL, -- Total number of questions in the quiz
    percentage DECIMAL(5, 2) NOT NULL, -- Percentage score
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
);
CREATE TABLE user_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, -- Foreign key to `users` table
    question_id INT NOT NULL, -- Foreign key to `questions` table
    selected_option_id INT NOT NULL, -- Foreign key to `options` table
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
    FOREIGN KEY (selected_option_id) REFERENCES options(id) ON DELETE CASCADE
);
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL, -- Username of the user
    password VARCHAR(255) NOT NULL, -- Password (hashed)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT NOT NULL, -- Foreign key to the `quizzes` table
    video_url VARCHAR(255) NOT NULL, -- URL to the video
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
);

