<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "root123";
$dbname = "quiz_generator";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $youtube_link = $_POST['youtube_link'];
    $value = videoToText($youtube_link);
}

$conn->close();

function videoToText($link) {
    $php_path = 'C:\xampp\php\php.exe';
    $download_script = "$php_path ./download_audio.php";
    $command = "$download_script " . escapeshellarg($link);

    $output = shell_exec($command);
    if ($output) {
        parse_str(parse_url($link, PHP_URL_QUERY), $url_params);
        $video_id = $url_params['v'] ?? null;
        if ($video_id) {
            $file_path = "C:\\xampp\\htdocs\\PHP\\project\\" . $video_id . ".webm";
            
            if (file_exists($file_path)) {
                $command = "python transcript.py " . escapeshellarg($file_path) . " 2>&1";
                $transcription_output = shell_exec($command);
                return generateQuiz($transcription_output);
            }
            else {
                $file_pathWAV = "C:\\xampp\\htdocs\\PHP\\project\\" . $video_id . ".wav";
                $command = "python transcript.py " . escapeshellarg($file_pathWAV);
                $transcription_output = shell_exec($command);
                return generateQuiz($transcription_output);
            }
        }
    }
    return false;
}

function generateQuiz($transcription) {
    $apiKey = "AIzaSyAjhIEcc3S5s8Lgz_rjvw5cv4L4miRQjLA";
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=" . $apiKey;
    $data = [
        "contents" => [
            [
                "parts" => [
                    ["text" => "Generate a quiz based on this transcript in JSON format with an array of objects containing 'question' and 'options' (array of 4 choices) and 'correct_answer' (index of correct option). Transcript: $transcription, direct array nothing else"]
                ]
            ]
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
        $responseData = json_decode($response, true);
        if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
            $quiz_content = $responseData['candidates'][0]['content']['parts'][0]['text'];
            $quiz_data = json_decode($quiz_content, true);
            storeQuizInDatabase($quiz_data);
            $_SESSION['quiz_data'] = $quiz_data;
            header("Location: display_quiz.php");
            exit();
        }
    }
    return false;
}

function storeQuizInDatabase($quiz_data) {
    global $conn;
    foreach ($quiz_data as $question) {
        $question_text = $question['question'];
        $option_1 = $question['options'][0];
        $option_2 = $question['options'][1];
        $option_3 = $question['options'][2];
        $option_4 = $question['options'][3];
        $correct_answer = $question['correct_answer'];

        $stmt = $conn->prepare("INSERT INTO quiz_questions (question, option_1, option_2, option_3, option_4, correct_answer) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $question_text, $option_1, $option_2, $option_3, $option_4, $correct_answer);
        $stmt->execute();
    }
}
?>
