<?php


// VARS DB -> SCRIPT WRAPPER

// Retrieve cache instance
$cache = Cache::get();

// Add 'vars' to the cache with a specific key
$cache->add('vars', 'VarsBuildCache');

// Extract variables from the cached data
extract($cache->getData('vars'));

// Define resources with their corresponding IDs
$resource = [
    901 => 'metal',
    902 => 'crystal',
    903 => 'deuterium',
    911 => 'energy',
    921 => 'darkmatter',
];

// Define resource lists
$reslist = [
    'ressources' => [901, 902, 903, 911, 921], // List of all resources
    'resstype' => [
        1 => [901, 902, 903], // Type 1 resources (metal, crystal, deuterium)
        2 => [911],           // Type 2 resources (energy)
        3 => [921],           // Type 3 resources (darkmatter)
    ],
];

?>
