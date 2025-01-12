<?php
include_once("../config.php");

$s = new Game();
$array = $s->spy(21, 1);

// Check if $array is an array before echoing
if (is_array($array)) {
    echo json_encode($array); // Convert array to JSON for better readability
} else {
    echo $array; // Echo directly if not an array
}

// Uncomment to use weapons function
// $weapQ = $s->spyWeapons(21);
?>
