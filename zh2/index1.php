<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Hírek</h1>
        <p>Mint Béla, NEPTUN</p>
    </header>
    <main>
        <div id="content">
        <?php
// Database connection using PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=news_site', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch news and comments from the database
$query = $pdo->query("
    SELECT n.id, n.title, n.content, n.publish_date, 
    (SELECT COUNT(*) FROM comments WHERE news_id = n.id) AS comment_count
    FROM news n
    ORDER BY n.publish_date DESC
");

$news = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News List</title>
</head>
<body>
    <?php foreach ($news as $item): ?>
        <article>
            <h2><?= htmlspecialchars($item['title']) ?></h2>
            <p><?= htmlspecialchars($item['content']) ?></p>
            <small>Published: <?= htmlspecialchars($item['publish_date']) ?></small>
            <p>Comments: <?= $item['comment_count'] > 0 ? $item['comment_count'] : "No comments yet" ?></p>
        </article>
    <?php endforeach; ?>
</body>
</html>
        </div>
    </main>
</body>
</html>



