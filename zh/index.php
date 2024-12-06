<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'film_ratings';
$db = mysqli_connect("localhost", "root", "", "film_ratings");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Fetch movies and their ratings
$movies = $db->query("
    SELECT m.id, m.title, m.release_year, 
           COALESCE(AVG(r.score), 0) AS avg_score, 
           COUNT(r.id) AS num_ratings 
    FROM movies m
    LEFT JOIN ratings r ON m.id = r.movie_id
    GROUP BY m.id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Filmek</title>
</head>
<body>
    <h1>Filmek</h1>
    <div class="movies">
        <?php while ($movie = $movies->fetch_assoc()): ?>
            <div class="movie">
                <h2><?= htmlspecialchars($movie['title']) ?> (<?= $movie['release_year'] ?>)</h2>
                <p>Értékelés: <?= number_format($movie['avg_score'], 2) ?> (<?= $movie['num_ratings'] ?> válasz)</p>
                <?php
                $ratings = $db->query("
                    SELECT user_name, score 
                    FROM ratings 
                    WHERE movie_id = {$movie['id']}
                ");
                if ($ratings->num_rows > 0): ?>
                    <ul>
                        <?php while ($rating = $ratings->fetch_assoc()): ?>
                            <li><?= htmlspecialchars($rating['user_name']) ?>: <?= $rating['score'] ?> / 5</li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>Nincs értékelés</p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Form to add a new rating -->
    <form action="add_rating.php" method="POST">
        <label for="movie">Film:</label>
        <select name="movie_id" id="movie" required>
            <?php
            $movies->data_seek(0); // Reset the result set pointer
            while ($movie = $movies->fetch_assoc()) {
                echo "<option value='{$movie['id']}'>" . htmlspecialchars($movie['title']) . "</option>";
            }
            ?>
        </select>

        <label for="name">Név:</label>
        <input type="text" name="user_name" id="name" required>

        <label for="score">Pontszám:</label>
        <input type="number" name="score" id="score" min="1" max="5" required>

        <button type="submit">Küldés</button>
    </form>
</body>
<script src="script.js"></script>
</html>
