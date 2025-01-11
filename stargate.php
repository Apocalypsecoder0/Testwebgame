<?php
session_start();

// Sample destinations for stargate travel
$stargateDestinations = [
    "Galaxy X" => ["distance" => 150, "travelTime" => 15],
    "Galaxy Y" => ["distance" => 250, "travelTime" => 25],
    "Galaxy Z" => ["distance" => 350, "travelTime" => 35],
];

// Check if the player is logged in
if (!isset($_SESSION['player'])) {
    echo "You must be logged in to use the stargate.";
    exit;
}

// Handle travel request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['destination'])) {
    $destination = $_POST['destination'];
    if (array_key_exists($destination, $stargateDestinations)) {
        // Calculate travel time and update player status
        $travelTime = $stargateDestinations[$destination]['travelTime'];
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
    <title>Stargate Travel</title>
</head>
<body>
    <h1>Stargate Travel</h1>
    <form method="post">
        <label for="destination">Select Destination:</label>
        <select name="destination" id="destination">
            <?php foreach ($stargateDestinations as $galaxy => $info): ?>
                <option value="<?php echo $galaxy; ?>"><?php echo $galaxy; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Travel</button>
    </form>
</body>
</html>
