<?php
session_start();

// Set timeout duration (in seconds)
$timeoutDuration = 600; // 10 minutes

// Check if the user is logged in
if (isset($_SESSION['player'])) {
    // Check if the last activity timestamp is set
    if (isset($_SESSION['LAST_ACTIVITY'])) {
        // Calculate the session duration
        $sessionDuration = time() - $_SESSION['LAST_ACTIVITY'];
        
        // If the session duration exceeds the timeout duration, log the user out
        if ($sessionDuration > $timeoutDuration) {
            session_unset(); // Remove all session variables
            session_destroy(); // Destroy the session
            header("Location: Game_Setup.php?timeout=true"); // Redirect to game setup with timeout message
            exit;
        }
    }
    
    // Update the last activity timestamp
    $_SESSION['LAST_ACTIVITY'] = time();
} else {
    // If not logged in, redirect to the game setup page
    header("Location: Game_Setup.php");
    exit;
}

// Handle logout request
if (isset($_GET['logout'])) {
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    header("Location: Game_Setup.php"); // Redirect to game setup after logout
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Timeout Management</title>
</head>
<body>
    <h1>Welcome to the Game!</h1>
    <p>Hello, <?php echo $_SESSION['player']['name']; ?>!</p>
    <p>You have <?php echo $_SESSION['player']['turns']; ?> turns and <?php echo $_SESSION['player']['resources']; ?> resources.</p>
    <p>Your session will time out after <?php echo $timeoutDuration / 60; ?> minutes of inactivity.</p>
    <a href="?logout=true">Logout</a>
</body>
</html>
