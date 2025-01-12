<?php



// Function to generate random planet data
function generatePlanetData($planetId) {
    switch ($planetId) {
        case 1:
            return array('temp' => mt_rand(220, 260), 'fields' => mt_rand(95, 108), 'image' => array('trocken' => mt_rand(1, 10), 'wuesten' => mt_rand(1, 4)));
        case 2:
            return array('temp' => mt_rand(170, 210), 'fields' => mt_rand(97, 110), 'image' => array('trocken' => mt_rand(1, 10), 'wuesten' => mt_rand(1, 4)));
        case 3:
            return array('temp' => mt_rand(120, 160), 'fields' => mt_rand(98, 137), 'image' => array('trocken' => mt_rand(1, 10), 'wuesten' => mt_rand(1, 4)));
        case 4:
            return array('temp' => mt_rand(70, 110), 'fields' => mt_rand(123, 203), 'image' => array('dschjungel' => mt_rand(1, 10)));
        case 5:
            return array('temp' => mt_rand(60, 100), 'fields' => mt_rand(148, 210), 'image' => array('dschjungel' => mt_rand(1, 10)));
        case 6:
            return array('temp' => mt_rand(50, 90), 'fields' => mt_rand(148, 226), 'image' => array('dschjungel' => mt_rand(1, 10)));
        case 7:
            return array('temp' => mt_rand(40, 80), 'fields' => mt_rand(141, 273), 'image' => array('normaltemp' => mt_rand(1, 7)));
        case 8:
            return array('temp' => mt_rand(30, 70), 'fields' => mt_rand(169, 246), 'image' => array('normaltemp' => mt_rand(1, 7)));
        case 9:
            return array('temp' => mt_rand(20, 60), 'fields' => mt_rand(161, 238), 'image' => array('normaltemp' => mt_rand(1, 7), 'wasser' => mt_rand(1, 9)));
        case 10:
            return array('temp' => mt_rand(10, 50), 'fields' => mt_rand(154, 224), 'image' => array('normaltemp' => mt_rand(1, 7), 'wasser' => mt_rand(1, 9)));
        case 11:
            return array('temp' => mt_rand(0, 40), 'fields' => mt_rand(148, 204), 'image' => array('normaltemp' => mt_rand(1, 7), 'wasser' => mt_rand(1, 9)));
        case 12:
            return array('temp' => mt_rand(-10, 30), 'fields' => mt_rand(136, 171), 'image' => array('normaltemp' => mt_rand(1, 7), 'wasser' => mt_rand(1, 9)));
        case 13:
            return array('temp' => mt_rand(-50, -10), 'fields' => mt_rand(109, 121), 'image' => array('eis' => mt_rand(1, 10)));
        case 14:
            return array('temp' => mt_rand(-90, -50), 'fields' => mt_rand(81, 93), 'image' => array('eis' => mt_rand(1, 10)));
        case 15:
            return array('temp' => mt_rand(-130, -90), 'fields' => mt_rand(65, 74), 'image' => array('eis' => mt_rand(1, 10)));
        default:
            return null; // Return null for invalid planet IDs
    }
}

// Generate data for all planets
$planetData = array();
for ($i = 1; $i <= 15; $i++) {
    $planetData[$i] = generatePlanetData($i);
}

// Print the generated planet data
print_r($planetData);
