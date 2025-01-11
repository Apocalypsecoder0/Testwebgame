<?php
session_start();

// Sample destinations for jumpgate travel
$jumpgateDestinations = [
    "Planet A" => ["distance" => 100, "travelTime" => 10],
    "Planet B" => ["distance" => 200, "travelTime" => 20],
    "Planet C" => ["distance" => 300, "travelTime" => 30],
];

// Check if the player is logged in
if (!isset($_SESSION['player'])) {
    echo "You must be logged in to use the jumpgate.";
    exit;
}

// Handle travel request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['destination'])) {
    $destination = $_POST['destination'];
    if (array_key_exists($destination, $jumpgateDestinations)) {
        // Calculate travel time and update player status
        $travelTime = $jumpgateDestinations[$destination]['travelTime'];
        echo "Traveling to $destination. Estimated travel time: $travelTime minutes.<br>";
        // Here you would typically update the player's status in the database
    } else {
        echo "Invalid destination.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jumpgate Travel</title>
</head>
<body>
    <h1>Jumpgate Travel</h1>
    <form method="post">
        <label for="destination">Select Destination:</label>
        <select name="destination" id="destination">
            <?php foreach ($jumpgateDestinations as $planet => $info): ?>
                <option value="<?php echo $planet; ?>"><?php echo $planet; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Travel</button>
    </form>
</body>
</html>
