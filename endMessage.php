<?php
// Start the session if needed
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send In-Game Mail</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional: Link to your CSS file -->
</head>
<body>
    <h1>Send In-Game Mail</h1>
    <form action="processMessage.php" method="POST">
        <label for="recipient">Recipient:</label>
        <input type="text" id="recipient" name="recipient" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</body>
</html>
