<?php
session_start();
require 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient = htmlspecialchars(trim($_POST['recipient']));
    $message = htmlspecialchars(trim($_POST['message']));
    $sender = $_SESSION['username']; // Assuming the sender's username is stored in the session

    // Validation checks
    if (empty($recipient) || empty($message)) {
        echo "Recipient and message cannot be empty.";
        exit();
    }

    // Check if recipient exists (you may need to adjust this based on your user table)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$recipient]);
    if ($stmt->fetchColumn() == 0) {
        echo "Recipient does not exist.";
        exit();
    }

    // Insert the message into the database
    $stmt = $pdo->prepare("INSERT INTO messages (sender, recipient, message) VALUES (?, ?, ?)");
    if ($stmt->execute([$sender, $recipient, $message])) {
        echo "Message sent to: " . $recipient;
    } else {
        echo "Failed to send message.";
    }
}
?>
