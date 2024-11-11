```markdown
# YouTube Quiz Generator AI

A web application that allows users to generate quizzes based on YouTube videos. This application extracts audio from videos, transcribes the audio content, and generates quiz questions using AI.

## Features and Functionality

- **AI-Powered Questions:** Automatically generates quiz questions from video transcripts.
- **Instant Generation:** Quickly create engaging quizzes from any YouTube video.
- **User Authentication:** Secure login and registration system for users.
- **Responsive Design:** Mobile-friendly interface for quiz generation and display.

## Technology Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Audio Processing:** Python (with `pydub` and `whisper` libraries)
- **YouTube Audio Downloading:** `yt-dlp`
- **AI Integration:** Google Generative Language API

## Project Structure

```
youtube-quiz-generator-ai/
├── display_quiz.php         # Displays the generated quiz
├── download_audio.php       # Downloads audio from a YouTube video
├── login.php                # User login page
├── login_process.php        # Processes login requests
├── process.php              # Handles quiz generation logic
├── quiz.php                 # Main page for inputting YouTube links
├── register.php             # User registration page
├── register_process.php     # Processes registration requests
├── transcript.py            # Python script for transcribing audio
└── styles.css               # (Optional) CSS styles for the application
```

## Prerequisites

To run this application, ensure you have the following installed:

- PHP (7.4 or higher)
- MySQL/MariaDB
- Python (3.6 or higher)
- Required Python libraries: `pydub`, `whisper`
- `yt-dlp` for downloading YouTube audio

## Installation Instructions

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/kbiam/youtube-quiz-generator-ai.git
   cd youtube-quiz-generator-ai
   ```

2. **Set Up the Database:**
   - Create a new MySQL database named `quiz_generator`.
   - Run the following SQL commands to create the required tables:
     ```sql
     CREATE TABLE users (
         id INT AUTO_INCREMENT PRIMARY KEY,
         username VARCHAR(255) NOT NULL UNIQUE,
         password VARCHAR(255) NOT NULL
     );

     CREATE TABLE quiz_questions (
         id INT AUTO_INCREMENT PRIMARY KEY,
         question TEXT NOT NULL,
         option_1 TEXT NOT NULL,
         option_2 TEXT NOT NULL,
         option_3 TEXT NOT NULL,
         option_4 TEXT NOT NULL,
         correct_answer INT NOT NULL
     );

     CREATE TABLE user_responses (
         id INT AUTO_INCREMENT PRIMARY KEY,
         user_id INT NOT NULL,
         question_id INT NOT NULL,
         selected_option INT NOT NULL,
         FOREIGN KEY (user_id) REFERENCES users(id),
         FOREIGN KEY (question_id) REFERENCES quiz_questions(id)
     );
     ```

3. **Configure Database Connection:**
   - Update the database connection details in the PHP files (`login_process.php`, `register_process.php`, `process.php`, etc.):
     ```php
     $servername = "localhost";
     $username = "root"; // Your MySQL username
     $password = "root123"; // Your MySQL password
     $dbname = "quiz_generator"; // Your database name
     ```

4. **Install Required Python Libraries:**
   ```bash
   pip install pydub whisper
   ```

5. **Ensure `yt-dlp` is available:**
   - Download `yt-dlp` and ensure it is in your system's PATH or specify its full path in `download_audio.php`.

6. **Run the Application:**
   - Place the files in your web server's document root (e.g., `htdocs` for XAMPP).
   - Access the application via your web browser at `http://localhost/youtube-quiz-generator-ai/quiz.php`.

## Usage Guide

1. **Register a New Account:**
   - Navigate to the registration page (`register.php`) and fill out the form.

2. **Log In:**
   - After registering, log in using your credentials on the login page (`login.php`).

3. **Generate a Quiz:**
   - Once logged in, paste a YouTube video URL into the input field on the main page (`quiz.php`) and submit the form.

4. **Take the Quiz:**
   - After generating a quiz, you will be redirected to the quiz display page (`display_quiz.php`) where you can answer the questions.

5. **View Results:**
   - After submitting your answers, you can redirect to a results page (implement as needed).

## API Documentation

This project uses the Google Generative Language API to generate quiz content based on transcriptions. Ensure to replace the API key in `process.php` with your own valid API key.

## Contributing Guidelines

Contributions are welcome! Please follow these steps to contribute:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Commit your changes.
4. Push your branch and create a pull request.

## License Information

This project does not have a specified license. Please feel free to use it for personal or educational purposes.

## Contact/Support Information

For any issues or support, please open an issue on the GitHub repository: [youtube-quiz-generator-ai Issues](https://github.com/kbiam/youtube-quiz-generator-ai/issues).

```
