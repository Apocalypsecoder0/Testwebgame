<?php

$laserTechnology = new Technology("Laser Technology", 1, 200);
$ionTechnology = new Technology("Ion Technology", 1, 400, ["Laser Technology" => 1]);

// Example of upgrading a technology
if ($laserTechnology->upgrade()) {
    echo "Laser Technology upgraded to level " . $laserTechnology->level;
} else {
    echo "Upgrade failed for Laser Technology.";
}
?>
