<?php

class Technology {
    public $name;
    public $level;
    public $cost;
    public $requirements;

    public function __construct($name, $level, $cost, $requirements = []) {
        $this->name = $name;
        $this->level = $level;
        $this->cost = $cost;
        $this->requirements = $requirements;
    }

    public function upgrade() {
        // Check if the player meets the requirements
        if ($this->canUpgrade()) {
            $this->level++;
            // Update the cost for the next level
            $this->cost = $this->calculateCost();
            return true; // Upgrade successful
        }
        return false; // Upgrade failed
    }

    private function canUpgrade() {
        // Check if the player has enough resources and meets requirements
        // This is a placeholder; you would need to implement actual checks
        return true;
    }

    private function calculateCost() {
        // Implement your cost calculation logic here
        return $this->cost * 1.5; // Example: increase cost by 50%
    }
}
?>
