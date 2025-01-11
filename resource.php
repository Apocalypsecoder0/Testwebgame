<?php
$mysqli = new mysqli("localhost", "user", "password", "game_db");

// Resource management
$result = $mysqli->query("SELECT * FROM resources");
while ($row = $result->fetch_assoc()) {
    echo "Resource: " . $row['type'] . " - Amount: " . $row['amount'] . "<br>";
}

$mysqli->close();
?>
