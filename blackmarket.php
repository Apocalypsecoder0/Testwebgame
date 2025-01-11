<?php
$mysqli = new mysqli("localhost", "user", "password", "game_db");

// Manage black market
$result = $mysqli->query("SELECT * FROM black_market");
while ($row = $result->fetch_assoc()) {
    echo "Item: " . $row['item'] . " - Price: " . $row['price'] . "<br>";
}

$mysqli->close();
?>
