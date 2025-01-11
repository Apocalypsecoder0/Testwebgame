<?php
$mysqli = new mysqli("localhost", "user", "password", "game_db");

// Display technology tree
$result = $mysqli->query("SELECT * FROM technologies");
while ($row = $result->fetch_assoc()) {
    echo "Technology: " . $row['name'] . "<br>";
}

$mysqli->close();
?>
