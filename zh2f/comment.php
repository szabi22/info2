<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=news_site', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }

    // Sanitize inputs
    $news_id = intval($_POST['news_id']);
    $author = htmlspecialchars($_POST['author']);
    $content = htmlspecialchars($_POST['content']);

    // Insert the comment into the database
    $stmt = $pdo->prepare("INSERT INTO comments (news_id, author, content) VALUES (?, ?, ?)");
    $stmt->execute([$news_id, $author, $content]);

    // Redirect back to the main page
    header("Location: index.php");
    exit();
}
?>
