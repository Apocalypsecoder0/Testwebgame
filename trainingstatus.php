<?php
// Define an associative array to hold the training status of various units
$units = [
    "Training" => [],
    "Untrained Units" => [],
    "Miner / Lifer" => [],
    "Attack Troops" => [],
    "Super Attack Troops" => [],
    "Defense Troops" => [],
    "Spies/Covert Agents" => [],
    "Anti-Intelligence Agents" => [],
    "Intelligence Level" => 0,
    "Counter-Intelligence Level" => 0,
    "Unit Production" => [],
    "Technology" => [],
    "Siege/Offense" => [],
    "Fortifications/Defense" => [],
    "Covert" => [],
    "Anti-Covert" => [],
    "Unique" => [],
    "Mercenary" => [],
    "Intelligence" => []
];

// Function to add a unit to a specific category
function addUnit($category, $unitName) {
    global $units;
    if (array_key_exists($category, $units)) {
        $units[$category][] = $unitName;
    } else {
        echo "Category does not exist.";
    }
}

// Function to display all units
function displayUnits() {
    global $units;
    foreach ($units as $category => $unitList) {
        echo "<h3>$category</h3>";
        if (empty($unitList)) {
            echo "<p>No units in this category.</p>";
        } else {
            echo "<ul>";
            foreach ($unitList as $unit) {
                echo "<li>$unit</li>";
            }
            echo "</ul>";
        }
    }
}

// Example of adding units
addUnit("Training", "Troop A");
addUnit("Untrained Units", "Troop B");
addUnit("Attack Troops", "Troop C");
addUnit("Defense Troops", "Troop D");

// Display the units
displayUnits();
?>
