<?php
session_start();

// Check if the player is logged in
if (!isset($_SESSION['player'])) {
    echo "You must be logged in to travel.";
    exit;
}

// Display travel options
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel Options</title>
</head>
<body>
    <h1>Travel Options</h1>
    <p>Select a travel method:</p>
    <ul>
        <li><a href="jumpgate.php">Jumpgate Travel</a></li>
        <li><a href="stargate.php">Stargate Travel</a></li>
    </ul>
</body>
</html>
