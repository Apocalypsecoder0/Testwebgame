<?php

class Player {
    public $name;
    public $covertAction; // Your Covert Action
    public $theirCovertAction; // Their Covert Action
    public $defConRate; // Def Con Rate (low, medium, high, critical)
    public $untrainedUnits; // Your untrained units
    public $totalWeaponPower; // Total Weapon Power
    public $strikeAction; // Your Strike Action
    public $defenseAction; // Their Defense Action
    public $mothershipAction; // Your Mothership Action
    public $antiCovertPower; // Your Anti-Covert Power
    public $theirAntiCovertPower; // Their Anti-Covert Power
    public $covertCapacity; // Covert capacity available
    public $covertCapacityRegeneration; // Covert capacity regeneration per turn
    public $covertActivityCount; // Count of covert activities on the target

    public function __construct($name, $covertAction, $theirCovertAction, $defConRate, $untrainedUnits, 
                                $totalWeaponPower, $strikeAction, $defenseAction, $mothershipAction, 
                                $antiCovertPower, $theirAntiCovertPower, $covertCapacity, 
                                $covertCapacityRegeneration, $covertActivityCount) {
        $this->name = $name;
        $this->covertAction = $covertAction;
        $this->theirCovertAction = $theirCovertAction;
        $this->defConRate = $defConRate;
        $this->untrainedUnits = $untrainedUnits;
        $this->totalWeaponPower = $totalWeaponPower;
        $this->strikeAction = $strikeAction;
        $this->defenseAction = $defenseAction;
        $this->mothershipAction = $mothershipAction;
        $this->antiCovertPower = $antiCovertPower;
        $this->theirAntiCovertPower = $theirAntiCovertPower;
        $this->covertCapacity = $covertCapacity;
        $this->covertCapacityRegeneration = $covertCapacityRegeneration;
        $this->covertActivityCount = $covertActivityCount;
    }

    public function canSpy() {
        // Check if the player can spy based on covert capacity and activity count
        return $this->covertCapacity > 0 && $this->covertActivityCount < 3; // Limit to 3 activities
    }

    public function spySuccess() {
        // Calculate if the spy action is successful
        return $this->covertAction > (($this->theirCovertAction * $this->getDefConMultiplier() - 100) / ($this->covertAction + 2)) / 2;
    }

    public function getDefConMultiplier() {
        switch ($this->defConRate) {
            case 'low':
                return 0.5;
            case 'medium':
                return 0.75;
            case 'high':
                return 1.0;
            case 'critical':
                return 1.25;
            default:
                return 1.0; // Default multiplier
        }
    }

    public function sabotageSuccess() {
        // Calculate if the sabotage action is successful
        return $this->covertAction > $this->theirCovertAction * $this->getDefConMultiplier();
    }

    public function sabotageDamage() {
        // Calculate the damage from sabotage
        return max($this->covertAction - ($this->theirCovertAction * $this->getDefConMultiplier()), 5900, 0.02 * $this->totalWeaponPower);
    }

    public function attackSuccess($theirDefenseAction) {
        // Determine if the attack is successful
        return $this->strikeAction > $theirDefenseAction;
    }

    public function raidSuccess() {
        // Calculate the success of a raid
        return $this->attackSuccess($this->defenseAction);
    }

    public function raidUnits() {
        // Calculate the number of untrained units that can be raided
        $baseRaidAmount = floor($this->untrainedUnits * 0.015); // 1.5% of untrained units
        if ($this->isAtWar()) {
            $baseRaidAmount += floor($baseRaidAmount * 0.5); // Add 50% if at war
        }
        return $baseRaidAmount;
    }

    public function isAtWar() {
        // Check if the player is at war (this is a placeholder, implement your own logic)
        return false; // Change this based on your game logic
    }

    public function regenerateCovertCapacity() {
        // Regenerate covert capacity each turn
        $this->covertCapacity += $this->covertCapacityRegeneration;
    }
}

// Example usage
$players = [
    new Player("Player1", 100, 80, 'medium', 1000, 5000, 120, 100, 200, 50, 30, 10, 2, 1),
    new Player("Player2", 90, 70, 'high', 800, 4000, 110, 90, 180, 40, 25, 8, 1, 2),
];

// Simulate actions for each player
foreach ($players as $player) {
    echo "Player: " . $player->name . "\n";

    // Spy Action
    if ($player->canSpy()) {
        if ($player->spySuccess()) {
            echo "Spy Action: Successful\n";
        } else {
            echo "Spy Action: Failed\n";
        }
    } else {
        echo "Spy Action: Cannot spy (capacity or activity limit reached)\n";
    }

    // Sabotage Action
    if ($player->sabotageSuccess()) {
        $damage = $player->sabotageDamage();
        echo "Sabotage Action: Successful, Damage: " . $damage . "\n";
    } else {
        echo "Sabotage Action: Failed\n";
    }

    // Attack Action
    if ($player->attackSuccess($player->defenseAction)) {
        echo "Attack Action: Successful\n";
    } else {
        echo "Attack Action: Failed\n";
    }

    // Raid Action
    if ($player->raidSuccess()) {
        $raidedUnits = $player->raidUnits();
        echo "Raid Action: Successful, Raided Units: " . $raidedUnits . "\n";
    } else {
        echo "Raid Action: Failed\n";
    }

    echo "\n";
}
?>
