<?php

class Player {
    public $name;
    public $dailyUnitProduction;
    public $turnsPerDay;
    public $weaponStrengthSuperUnits;
    public $weaponStrengthNormalUnits;
    public $defenseWeaponStrengthSuperUnits;
    public $defenseWeaponStrengthNormalUnits;
    public $spyLevel;
    public $spies;
    public $techIncrease;
    public $raceBonus; // as a percentage (e.g., 25 for Goa'uld)
    public $totalMothershipShields;
    public $shieldStrength;
    public $totalMothershipWeapons;
    public $weaponStrength;
    public $defConPercent; // Defcon percentage
    public $covertAction; // Your Covert Action
    public $theirCovertAction; // Their Covert Action
    public $antiCovertPower; // Your Anti-Covert Power
    public $theirCovertPower; // Their Covert Power
    public $totalWeaponPower; // Total Weapon Power

    public function __construct($name, $dailyUnitProduction, $turnsPerDay, $weaponStrengthSuperUnits, $weaponStrengthNormalUnits, 
                                $defenseWeaponStrengthSuperUnits, $defenseWeaponStrengthNormalUnits, $spyLevel, $spies, 
                                $techIncrease, $raceBonus, $totalMothershipShields, $shieldStrength, 
                                $totalMothershipWeapons, $weaponStrength, $defConPercent, $covertAction, 
                                $theirCovertAction, $antiCovertPower, $theirCovertPower, $totalWeaponPower) {
        $this->name = $name;
        $this->dailyUnitProduction = $dailyUnitProduction;
        $this->turnsPerDay = $turnsPerDay;
        $this->weaponStrengthSuperUnits = $weaponStrengthSuperUnits;
        $this->weaponStrengthNormalUnits = $weaponStrengthNormalUnits;
        $this->defenseWeaponStrengthSuperUnits = $defenseWeaponStrengthSuperUnits;
        $this->defenseWeaponStrengthNormalUnits = $defenseWeaponStrengthNormalUnits;
        $this->spyLevel = $spyLevel;
        $this->spies = $spies;
        $this->techIncrease = $techIncrease;
        $this->raceBonus = $raceBonus / 100; // Convert percentage to decimal
        $this->totalMothershipShields = $totalMothershipShields;
        $this->shieldStrength = $shieldStrength;
        $this->totalMothershipWeapons = $totalMothershipWeapons;
        $this->weaponStrength = $weaponStrength;
        $this->defConPercent = $defConPercent / 100; // Convert percentage to decimal
        $this->covertAction = $covertAction;
        $this->theirCovertAction = $theirCovertAction;
        $this->antiCovertPower = $antiCovertPower;
        $this->theirCovertPower = $theirCovertPower;
        $this->totalWeaponPower = $totalWeaponPower;
    }

    public function calculateUntrainedUnitsPerTurn() {
        return $this->dailyUnitProduction / $this->turnsPerDay;
    }

    public function calculateStrikeAction() {
        return ($this->weaponStrengthSuperUnits * 10 + $this->weaponStrengthNormalUnits * 5) * $this->raceBonus;
    }

    public function calculateDefenseAction() {
        return ($this->defenseWeaponStrengthSuperUnits * 10 + $this->defenseWeaponStrengthNormalUnits * 5) * $this->raceBonus;
    }

    public function calculateCovertAction() {
        return ((sqrt(pow(2, $this->spyLevel)) * $this->spies * $this->techIncrease * $this->raceBonus) + $this->spies) * 10;
    }

    public function calculateAntiCovertAction() {
        return ((sqrt(pow(2, $this->spyLevel + 2)) * $this->spies * $this->techIncrease * $this->raceBonus) + $this->spies) * 10;
    }

    public function calculateMothershipAction() {
        return ($this->totalMothershipShields * $this->shieldStrength) + ($this->totalMothershipWeapons * $this->weaponStrength);
    }

    public function calculateSpySuccess() {
        return $this->covertAction > (($this->theirCovertAction * $this->defConPercent - 100) / ($this->spyLevel + 2)) / 2;
    }

    public function calculateSabotageSuccess() {
        return $this->covertAction > $this->theirCovertAction * $this->defConPercent;
    }

    public function calculateSabotageDamage() {
        return max($this->covertAction - ($this->theirCovertAction * $this->defConPercent), 5900, 0.02 * $this->totalWeaponPower);
    }

    public function calculateAttackSuccess($theirDefenseAction) {
        return $this->calculateStrikeAction() > $theirDefenseAction;
    }

    public function calculateAntiIntelligencePower() {
        return $this->antiCovertPower - $this->theirCovertPower;
    }

    public function calculateEnemyAgentKills() {
        return $this->antiCovertPower / ($this->theirCovertPower / $this->spies);
    }
}

// Example usage
$players = [
    new Player("Player1", 1000, 10, 50, 30, 40, 20, 5, 100, 1.5, 25, 200, 10, 150, 5, 0.8, 0.6, 30, 20, 5000),
    new Player("Player2", 800, 8, 60, 25, 35, 15, 4, 80, 1.2, 20, 180, 12, 120, 6, 0.7, 0.5, 25, 15, 6000),
];

// Calculate and display results for each player
foreach ($players as $player) {
    echo "Player: " . $player->name . "\n";
    echo "Untrained Units Per Turn: " . $player->calculateUntrainedUnitsPerTurn() . "\n";
    echo "Strike Action: " . $player->calculateStrikeAction() . "\n";
    echo "Defense Action: " . $player->calculateDefenseAction() . "\n";
    echo "Covert Action: " . $player->calculateCovertAction() . "\n";
    echo "Anti-Covert Action: " . $player->calculateAntiCovertAction() . "\n";
    echo "Mothership Action: " . $player->calculateMothershipAction() . "\n";
    echo "Spy Success: " . ($player->calculateSpySuccess() ? "Successful" : "Failed") . "\n";
    echo "Sabotage Success: " . ($player->calculateSabotageSuccess() ? "Successful" : "Failed") . "\n";
    echo "Sabotage Damage: " . $player->calculateSabotageDamage() . "\n";
    echo "Attack Success: " . ($player->calculateAttackSuccess($player->calculateDefenseAction()) ? "Successful" : "Failed") . "\n";
    echo "Anti-Intelligence Power: " . $player->calculateAntiIntelligencePower() . "\n";
    echo "Enemy Agent Kills: " . $player->calculateEnemyAgentKills() . "\n\n";
}
?>
