<?php
// plants.php

// Include necessary files
require_once 'config.php'; // Configuration settings
require_once 'database.php'; // Database connection

// Function to get all plants
function getAllPlants() {
    global $db;
    $query = "SELECT * FROM plants";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to add a new plant
function addPlant($name, $type, $growthTime) {
    global $db;
    $query = "INSERT INTO plants (name, type, growth_time) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$name, $type, $growthTime]);
    return $db->lastInsertId();
}

// Example usage
$plants = getAllPlants();
foreach ($plants as $plant) {
    echo "Plant Name: " . $plant['name'] . ", Type: " . $plant['type'] . "\n";
}

// Adding a new plant
$newPlantId = addPlant('Sunflower', 'Flower', 7);
echo "New Plant ID: " . $newPlantId . "\n";
?>
