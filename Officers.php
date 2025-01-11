<?php
// Start the session
session_start();

// Include database connection file
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the officer's details from the form
    $name = $_POST['name'];
    $position = $_POST['position'];
    $email = $_POST['email'];

    // Validate the input
    if (empty($name) || empty($position) || empty($email)) {
        echo "All fields are required.";
    } else {
        // Prepare an SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO officers (name, position, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $position, $email);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New officer added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Officer</title>
</head>
<body>
    <h1>Add New Officer</h1>
    <form method="POST" action="Officers.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Add Officer">
    </form>
</body>
</html>
