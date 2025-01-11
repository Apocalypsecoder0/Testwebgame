<?php
// Admin functions (e.g., ban player)
function banPlayer($playerId) {
    global $mysqli;
    $stmt = $mysqli->prepare("UPDATE players SET banned = 1 WHERE id = ?");
    $stmt->bind_param("i", $playerId);
    $stmt->execute();
}
?>
