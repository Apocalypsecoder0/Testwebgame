<?php
$mysqli = new mysqli("localhost", "user", "password", "game_db");

// Manage planes
$result = $mysqli->query("SELECT * FROM planes");
while ($row = $result->fetch_assoc()) {
    echo "Plane: " . $row['name'] . "<br>";
}

$mysqli->close();
?>
