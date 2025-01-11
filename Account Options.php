<?php
session_start();

// Include database connection
include('db_connection.php');

// Fetch user data
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);

// Update user options
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process form data
    // Validate and update user options in the database
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Account Options</title>
</head>
<body>
    <h1>Account Options</h1>
    <form method="POST">
        <!-- Form fields for user options -->
        <input type="text" name="username" value="<?php echo $user_data['username']; ?>">
        <input type="email" name="email" value="<?php echo $user_data['email']; ?>">
        <button type="submit">Update</button>
    </form>
</body>
</html>
