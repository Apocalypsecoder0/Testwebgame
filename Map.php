<?php
// Start the session
session_start();

// Include database connection
include('db_connection.php');

// Fetch galaxy data from the database
$query = "SELECT * FROM galaxies";
$result = mysqli_query($conn, $query);

// Display the map
echo "<h1>Galaxy Map</h1>";
echo "<div class='galaxy-map'>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='star' style='left: {$row['x_position']}px; top: {$row['y_position']}px;'>";
    echo "<a href='star_info.php?id={$row['id']}'>{$row['name']}</a>";
    echo "</div>";
}

echo "</div>";
?>
