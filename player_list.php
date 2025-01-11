<?php
// Start the session
session_start();

// Include database connection
include('db_connection.php');

// Fetch player data from the database
$query = "SELECT * FROM players ORDER BY score DESC";
$result = mysqli_query($conn, $query);

// Display the player list
echo "<h1>Player List</h1>";
echo "<table>";
echo "<tr><th>Username</th><th>Score</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td><a href='player_profile.php?id={$row['id']}'>{$row['username']}</a></td>";
    echo "<td>{$row['score']}</td>";
    echo "</tr>";
}

echo "</table>";
?>
