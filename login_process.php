<?php
session_start();

$servername = "localhost";
$username = "root"; // your database username
$password = "root123"; // your database password
$dbname = "quiz_generator";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id; // Store user ID in session
            header("Location: quiz.php"); // Redirect to main page (or quiz generation page)
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that username!";
    }

    $stmt->close();
}

$conn->close();
?>
