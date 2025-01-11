<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient = htmlspecialchars($_POST['recipient']);
    $message = htmlspecialchars($_POST['message']);

    // Here you would typically save the message to a database or send it to the game server
    // For demonstration, we'll just echo the values
    echo "Message sent to: " . $recipient . "<br>";
    echo "Your message: " . $message;

    // Redirect back to the SendMessage page or show a success message
    // header("Location: SendMessage.php");
    // exit();
}
?>
