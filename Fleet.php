<?php
$mysqli = new mysqli("localhost", "user", "password", "game_db");

// Manage fleets
$result = $mysqli->query("SELECT * FROM fleets");
while ($row = $result->fetch_assoc()) {
    echo "Fleet: " . $row['name'] . "<br>";
}

$mysqli->close();
?>
