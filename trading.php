<?php
$mysqli = new mysqli("localhost", "user", "password", "game_db");

// Handle trading
$result = $mysqli->query("SELECT * FROM trades");
while ($row = $result->fetch_assoc()) {
    echo "Trade: " . $row['item'] . " - Price: " . $row['price'] . "<br>";
}

$mysqli->close();
?>
