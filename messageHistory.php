<?php
session_start();
require 'db.php'; // Include the database connection

$sender = $_SESSION['username']; // Assuming the sender's username is stored in the session

// Fetch messages sent to and from the user
$stmt = $pdo->prepare("SELECT * FROM messages WHERE sender = ? OR recipient = ? ORDER BY timestamp DESC");
$stmt->execute([$sender, $sender]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message History</title>
</head>
<body>
    <h1>Message History</h1>
    <table>
        <tr>
            <th>Sender</th>
            <th>Recipient</th>
            <th>Message</th>
            <th>Timestamp</th>
        </tr>
        <?php foreach ($messages as $message): ?>
        <tr>
            <td><?php echo htmlspecialchars($message['sender']); ?></td>
            <td><?php echo htmlspecialchars($message['recipient']); ?></td>
            <td><?php echo htmlspecialchars($message['message']); ?></td>
            <td><?php echo htmlspecialchars($message['timestamp']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
