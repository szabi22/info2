<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=idojaras_jelentes', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

//Fetch cities
$query = $pdo->query("
    SELECT v.id, v.nev, v.lakossag, 
           COALESCE(AVG(i.homerseklet), 0) AS atlag_homerseklet, 
           COUNT(i.id) AS homerseklet_naplok 
    FROM varosok v
    LEFT JOIN idojaras i ON v.id = i.varos_id
    //ORDER BY v.lakossag DESC
");


//fetch logs


$varosok = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather Data</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Név</th>
                <th>Lakosság (millió fő)</th>
                <th>Átlaghőmérséklet</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($varosok as $varos): ?>
                <tr>
                    <td><?= htmlspecialchars($varos['nev']) ?></td>
                    <td><?= htmlspecialchars($varos['lakossag']) ?></td>
                    <td><?= htmlspecialchars($varos['atlag_homerseklet'] ?? 'Nincs adat') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Hőmérséklet naplózása</h2>
    <?php foreach ($logs as $log): ?>
        <p><?= htmlspecialchars($log['city']) ?> - <?= htmlspecialchars($log['log_date']) ?>: <?= htmlspecialchars($log['temperature']) ?>°C</p>
    <?php endforeach; ?>
    
    
</body>
</html>
