<?php
$mysqli = new mysqli("localhost", "user", "password", "game_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch player data
$result = $mysqli->query("SELECT * FROM players");
while ($row = $result->fetch_assoc()) {
    echo "Player: " . $row['username'] . "<br>";
}

$mysqli->close();
?>
