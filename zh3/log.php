<?php
$pdo = new PDO('mysql:host=localhost;dbname=WeatherApp', 'root', '');

// Sanitize input
$cityId = (int)$_POST['city'];
$date = $_POST['date'];
$temperature = (float)$_POST['temperature'];

// Validate city existence
$stmt = $pdo->prepare('SELECT COUNT(*) FROM varosok WHERE id = ?');
$stmt->execute([$cityId]);
if ($stmt->fetchColumn() == 0) {
    die('Invalid city');
}

// Insert log
$stmt = $pdo->prepare('INSERT INTO TemperatureLogs (city_id, log_date, temperature) VALUES (?, ?, ?)');
$stmt->execute([$cityId, $date, $temperature]);

header('Location: index.php');
