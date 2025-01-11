<?php
session_start();

// Set timeout duration (in seconds)
$timeoutDuration = 600; // 10 minutes
$warningDuration = 120; // 2 minutes before timeout

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

// Calculate the time left until timeout
$timeLeft = $timeoutDuration - (time() - $_SESSION['LAST_ACTIVITY']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Timeout Management</title>
    <script>
        // Set the timeout duration and warning duration
        const timeoutDuration = <?php echo $timeoutDuration; ?> * 1000; // Convert to milliseconds
        const warningDuration = <?php echo $warningDuration; ?> * 1000; // Convert to milliseconds

        // Calculate the time left until timeout
        let timeLeft = timeoutDuration - <?php echo time() - $_SESSION['LAST_ACTIVITY']; ?> * 1000;

        // Function to start the countdown
        function startCountdown() {
            const countdownElement = document.getElementById('countdown');
            const warningElement = document.getElementById('warning');

            const countdownInterval = setInterval(() => {
                timeLeft -= 1000; // Decrease time left by 1 second

                // Update the countdown display
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                countdownElement.innerHTML = `Time left: ${minutes}m ${seconds}s`;

                // Check if the warning duration is reached
                if (timeLeft <= warningDuration) {
                    warningElement.style.display = 'block';
                }

                // Check if the session has timed out
                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    alert("Your session has timed out. You will be redirected.");
                    window.location.href = "Game_Setup.php?timeout=true"; // Redirect to game setup
                }
            }, 1000); // Update every second
        }

        // Start the countdown when the page loads
        window.onload = startCountdown;
    </script>
</head>
<body>
    <h1>Welcome to the Game!</h1>
    <p>Hello, <?php echo $_SESSION['player']['name']; ?>!</p>
    <p>You have <?php echo $_SESSION['player']['turns']; ?> turns and <?php echo $_SESSION['player']['resources']; ?> resources.</p>
    <p>Your session will time out after <?php echo $timeoutDuration / 60; ?> minutes of inactivity.</p>
    
    <div id="countdown"></div>
    <div id="warning" style="display: none; color: red;">
        <p>Warning: Your session will expire soon! Please take action to keep your session alive.</p>
        <button onclick="window.location.reload();">Stay Logged In</button>
    </div>
    
    <a href="?logout=true">Logout</a>
</body>
</html>
