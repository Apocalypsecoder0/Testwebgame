<?php
$mysqli = new mysqli("localhost", "user", "password", "game_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch galaxies
$result = $mysqli->query("SELECT * FROM galaxies");
while ($row = $result->fetch_assoc()) {
    echo "Galaxy: " . $row['name'] . "<br>";
}

$mysqli->close();
?>
