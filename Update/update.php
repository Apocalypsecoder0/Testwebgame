<?php
// update.php

// Include necessary modules
include 'database.php'; // Database connection
include 'gameLogic.php'; // Game logic functions

// Function to update game data
function updateGameData($newData) {
    // Connect to the database
    $db = connectDatabase();

    // Update game data in the database
    foreach ($newData as $key => $value) {
        $query = "UPDATE game_data SET value = :value WHERE key = :key";
        $stmt = $db->prepare($query);
        $stmt->execute([':value' => $value, ':key' => $key]);
    }

    echo "Game data updated successfully!";
}

// Example new data to update
$newData = [
    'level1' => 'new_value',
    'character1' => 'updated_character'
];

// Call the function
updateGameData($newData);
?>
