<?php
session_start();

// Check if the player is already registered
if (isset($_SESSION['player'])) {
    echo "You are already registered as " . $_SESSION['player']['name'] . ".<br>";
    echo "<a href='travel.php'>Go to Travel Options</a>";
    exit;
}

// Handle player registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get player name from the form
    $playerName = trim($_POST['player_name']);
    
    // Basic validation
    if (empty($playerName)) {
        echo "Player name cannot be empty.<br>";
    } elseif (strlen($playerName) < 3) {
        echo "Player name must be at least 3 characters long.<br>";
    } else {
        // Initialize player session data
        $_SESSION['player'] = [
            'name' => htmlspecialchars($playerName),
            'turns' => 5,
            'resources' => 100,
            'units' => [
                "Training" => [],
                "Untrained Units" => [],
                "Attack Troops" => [],
                "Defense Troops" => [],
                "Spies/Covert Agents" => [],
                "Anti-Intelligence Agents" => [],
                "Intelligence Level" => 0,
                "Counter-Intelligence Level" => 0,
                "Unit Production" => [],
                "Technology" => [],
                "Siege/Offense" => [],
                "Fortifications/Defense" => [],
                "Covert" => [],
                "Anti-Covert" => [],
                "Unique" => [],
                "Mercenary" => [],
                "Intelligence" => []
            ]
        ];
        
        echo "Welcome, " . $_SESSION['player']['name'] . "! You have been registered.<br>";
        echo "<a href='travel.php'>Go to Travel Options</a>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Setup</title>
</head>
<body>
    <h1>Game Setup</h1>
    <form method="post">
        <label for="player_name">Enter your player name:</label>
        <input type="text" name="player_name" id="player_name" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>
