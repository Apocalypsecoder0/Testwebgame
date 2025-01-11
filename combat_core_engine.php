<?php
function calculateCombat($attacker, $defender) {
    // Basic combat logic
    return $attacker['power'] > $defender['power'] ? "Attacker wins!" : "Defender wins!";
}
?>
