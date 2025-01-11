<?php
$mysqli = new mysqli("localhost", "user", "password", "game_db");

$result = $mysqli->query("SELECT username, score FROM players ORDER BY score DESC LIMIT 10");
while ($row = $result->fetch_assoc()) {
    echo "Player: " . $row['username'] . " - Score: " . $row['score'] . "<br>";
}

$mysqli->close();
?>
