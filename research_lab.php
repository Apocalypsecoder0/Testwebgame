<?php
$mysqli = new mysqli("localhost", "user", "password", "game_db");

// Manage research
$result = $mysqli->query("SELECT * FROM research");
while ($row = $result->fetch_assoc()) {
    echo "Research: " . $row['name'] . "<br>";
}

$mysqli->close();
?>
