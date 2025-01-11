<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from request
$userId = $_GET['id'];

// Prepare and bind
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);

// Execute the statement
if ($stmt->execute()) {
    echo "User deleted successfully.";
} else {
    echo "Error deleting user: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
