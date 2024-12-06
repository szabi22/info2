<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'film_ratings';
$db = new mysqli($host, $user, $password, $database);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_id = $_POST['movie_id'];
    $user_name = $_POST['user_name'];
    $score = $_POST['score'];

    // Validate inputs
    if (is_numeric($score) && $score >= 1 && $score <= 5) {
        $stmt = $db->prepare("INSERT INTO ratings (movie_id, user_name, score) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $movie_id, $user_name, $score);
        $stmt->execute();
        $stmt->close();
    }
}

// Redirect back to the main page
header("Location: index.php");
exit;
?>
