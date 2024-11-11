<?php
session_start();

// if (!isset($_SESSION['user_id']) || !isset($_SESSION['quiz_data'])) {
//     header("Location: login.php");
//     exit();
// }

$quiz_data = $_SESSION['quiz_data'];
$servername = "localhost";
$username = "root";
$password = "root123";
$dbname = "quiz_generator";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id']; // Assuming you have a user session
    foreach ($_POST as $question_id => $selected_option) {
        $stmt = $conn->prepare("INSERT INTO user_responses (user_id, question_id, selected_option) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $question_id, $selected_option);
        $stmt->execute();
    }

    // Redirect to a results page or show the result here
    header("Location: results.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-bold text-center mb-8">Video Quiz</h1>
            <form id="quizForm" method="POST" class="space-y-8">
                <?php foreach ($quiz_data as $index => $question): ?>
                <div class="question-container">
                    <h2 class="text-lg font-semibold mb-4">
                        Question <?php echo $index + 1; ?>: <?php echo htmlspecialchars($question['question']); ?>
                    </h2>
                    <div class="space-y-2">
                        <?php foreach ($question['options'] as $optionIndex => $option): ?>
                        <div class="flex items-center">
                            <input type="radio" 
                                   id="q<?php echo $index; ?>_<?php echo $optionIndex; ?>" 
                                   name="q<?php echo $index; ?>" 
                                   value="<?php echo $optionIndex; ?>"
                                   class="h-4 w-4 text-blue-600">
                            <label for="q<?php echo $index; ?>_<?php echo $optionIndex; ?>" 
                                   class="ml-2 block text-gray-700">
                                <?php echo htmlspecialchars($option); ?>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <div class="mt-8 flex justify-center">
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Submit Quiz
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
