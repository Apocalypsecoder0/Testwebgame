<?php

class TechnologyManager {
    private $technologies = [];

    public function addTechnology($technology) {
        $this->technologies[$technology->name] = $technology;
    }

    public function upgradeTechnology($name) {
        if (isset($this->technologies[$name])) {
            return $this->technologies[$name]->upgrade();
        }
        return false; // Technology not found
    }

    public function getTechnology($name) {
        return $this->technologies[$name] ?? null;
    }
}

// Example usage
$techManager = new TechnologyManager();
$techManager->addTechnology($laserTechnology);
$techManager->addTechnology($ionTechnology);

if ($techManager->upgradeTechnology("Laser Technology")) {
    echo "Laser Technology upgraded!";
} else {
    echo "Upgrade failed.";
}
?>
