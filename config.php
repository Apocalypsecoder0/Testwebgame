<?php
define('GAME_NAME', 'Galactic Conquest');
define('VERSION', '1.0');
define('DEBUG_MODE', true);
?>

<?php
// Database configuration
define('DB_HOST', 'localhost'); // Database host
define('DB_USER', 'root');      // Database username
define('DB_PASS', 'your_password'); // Database password
define('DB_NAME', 'your_database'); // Database name

// Create a connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
