<?php

class CombatUnit {
    protected $name;
    protected $health;
    protected $attackPower;

    public function __construct($name, $health, $attackPower) {
        $this->name = $name;
        $this->health = $health;
        $this->attackPower = $attackPower;
    }

    public function attack() {
        return $this->attackPower;
    }

    public function takeDamage($damage) {
        $this->health -= $damage;
        if ($this->health < 0) $this->health = 0;
    }

    public function getHealth() {
        return $this->health;
    }
}

class AttackUnit extends CombatUnit {
    public function __construct($name, $health, $attackPower) {
        parent::__construct($name, $health, $attackPower);
    }
}

class DefenseUnit extends CombatUnit {
    private $defensePower;

    public function __construct($name, $health, $attackPower, $defensePower) {
        parent::__construct($name, $health, $attackPower);
        $this->defensePower = $defensePower;
    }

    public function takeDamage($damage) {
        $damage -= $this->defensePower;
        if ($damage < 0) $damage = 0;
        parent::takeDamage($damage);
    }
}

class SpyUnit extends CombatUnit {
    private $stealth;

    public function __construct($name, $health, $attackPower, $stealth) {
        parent::__construct($name, $health, $attackPower);
        $this->stealth = $stealth;
    }

    public function gatherIntelligence() {
        return "Gathering intelligence with stealth level: " . $this->stealth;
    }
}

// Example usage
$attackUnit = new AttackUnit("Warrior", 100, 20);
$defenseUnit = new DefenseUnit("Guardian", 150, 10, 5);
$spyUnit = new SpyUnit("Shadow", 80, 5, 10);

echo $attackUnit->attack(); // Outputs: 20
$defenseUnit->takeDamage(30);
echo $defenseUnit->getHealth(); // Outputs: 125
echo $spyUnit->gatherIntelligence(); // Outputs: Gathering intelligence with stealth level: 10

?>
