<?php
$host = 'localhost';
$user = 'username';
$pass = 'password';
$db = 'database_name';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "OPTIMIZE TABLE your_table_name"; // Specify your table here
$conn->query($sql);
$conn->close();
echo "Optimization completed for: your_table_name";
?>
