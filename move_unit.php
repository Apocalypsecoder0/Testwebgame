<?php
// Example function to move a unit
function moveUnit($unitId, $newX, $newY) {
    // Database connection
    $conn = new mysqli('localhost', 'username', 'password', 'game_db');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update unit position
    $stmt = $conn->prepare("UPDATE units SET posX = ?, posY = ? WHERE id = ?");
    $stmt->bind_param("iii", $newX, $newY, $unitId);
    
    if ($stmt->execute()) {
        echo "Unit moved successfully.";
    } else {
        echo "Error moving unit: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

// Example usage
moveUnit(1, 5, 10);
?>
