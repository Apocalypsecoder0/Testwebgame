<?php
session_start();

// Function to check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['player']);
}

// Function to log in the user
function login($playerName) {
    $_SESSION['player'] = [
        'name' => htmlspecialchars($playerName),
        'turns' => 5,
        'resources' => 100,
        // Additional player data can be added here
    ];
}

// Function to log out the user
function logout() {
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
}

// Handle login request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $playerName = trim($_POST['player_name']);
    if (!empty($playerName) && strlen($playerName) >= 3) {
        login($playerName);
        header("Location: travel.php"); // Redirect to travel options after login
        exit;
    } else {
        $error = "Player name must be at least 3 characters long.";
    }
}

// Handle logout request
if (isset($_GET['logout'])) {
    logout();
    header("Location: Game_Setup.php"); // Redirect to game setup after logout
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Management</title>
</head>
<body>
    <h1>Session Management</h1>

    <?php if (isLoggedIn()): ?>
        <p>Welcome, <?php echo $_SESSION['player']['name']; ?>!</p>
        <p>You have <?php echo $_SESSION['player']['turns']; ?> turns and <?php echo $_SESSION['player']['resources']; ?> resources.</p>
        <a href="?logout=true">Logout</a>
    <?php else: ?>
        <h2>Login</h2>
        <form method="post">
            <label for="player_name">Enter your player name:</label>
            <input type="text" name="player_name" id="player_name" required>
            <button type="submit" name="login">Login</button>
        </form>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
