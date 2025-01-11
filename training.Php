<?php
session_start();

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

// Initialize player data
if (!isset($_SESSION['player'])) {
    $_SESSION['player'] = [
        'name' => 'Player1',
        'turns' => 5,
        'resources' => 100,
        'units' => $units
    ];
}

// Function to add a unit to a specific category
function addUnit($category, $unitName) {
    global $units;
    if (array_key_exists($category, $units)) {
        $_SESSION['player']['units'][$category][] = $unitName;
    } else {
        echo "Category does not exist.";
    }
}

// Function to display all units
function displayUnits() {
    $units = $_SESSION['player']['units'];
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

// Function to perform an action
function performAction($action) {
    if ($_SESSION['player']['turns'] > 0) {
        switch ($action) {
            case 'train':
                addUnit("Training", "Troop " . (count($_SESSION['player']['units']['Training']) + 1));
                echo "Training a new troop.<br>";
                break;
            case 'gather':
                $_SESSION['player']['resources'] += 10;
                echo "Gathered resources. Total resources: " . $_SESSION['player']['resources'] . "<br>";
                break;
            case 'endTurn':
                $_SESSION['player']['turns']--;
                echo "Turn ended. Remaining turns: " . $_SESSION['player']['turns'] . "<br>";
                break;
            default:
                echo "Invalid action.<br>";
        }
    } else {
        echo "No turns left. Please end your turn.<br>";
    }
}

// Handle actions based on user input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        performAction($_POST['action']);
    }
}

// Display player information and units
echo "<h1>Welcome, " . $_SESSION['player']['name'] . "</h1>";
echo "<p>Turns remaining: " . $_SESSION['player']['turns'] . "</p>";
echo "<p>Resources: " . $_SESSION['player']['resources'] . "</p>";
displayUnits();
?>

<form method="post">
    <button name="action" value="train">Train Unit</button>
    <button name="action" value="gather">Gather Resources</button>
    <button name="action" value="endTurn">End Turn</button>
</form>
