<?php
// ascension.php

// Include necessary files
require_once 'config.php'; // Configuration settings
require_once 'database.php'; // Database connection

// Function to get user progression
function getUserProgression($userId) {
    global $db; // Assuming $db is your database connection

    // Query to get user progression data
    $query = "SELECT level, experience FROM users WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Function to upgrade user level
function upgradeUserLevel($userId) {
    global $db;

    // Get current user progression
    $progression = getUserProgression($userId);
    $newLevel = $progression['level'] + 1;

    // Update user level in the database
    $query = "UPDATE users SET level = ?, experience = 0 WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$newLevel, $userId]);

    return $newLevel;
}

// Example usage
$userId = 1; // Example user ID
$currentProgression = getUserProgression($userId);
echo "Current Level: " . $currentProgression['level'] . "\n";

// Upgrade user level
$newLevel = upgradeUserLevel($userId);
echo "New Level: " . $newLevel . "\n";
?>
