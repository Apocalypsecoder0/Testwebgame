<?php

class Player {
    public $name;
    public $untrainedUnits;
    public $minersLifers;
    public $raceBonus; // as a percentage (e.g., 25 for Goa'uld)
    public $commanderIncomeRate; // income rate of the commander
    public $hasCommander; // boolean to check if the player has a commander
    public $defConRate; // Def Con Rate (low, medium, high, critical)

    public function __construct($name, $untrainedUnits, $minersLifers, $raceBonus, $commanderIncomeRate, $hasCommander, $defConRate) {
        $this->name = $name;
        $this->untrainedUnits = $untrainedUnits;
        $this->minersLifers = $minersLifers;
        $this->raceBonus = $raceBonus;
        $this->commanderIncomeRate = $commanderIncomeRate;
        $this->hasCommander = $hasCommander;
        $this->defConRate = $defConRate;
    }

    public function calculateNaturalIncome() {
        // Calculate Natural Income
        $naturalIncome = ($this->untrainedUnits * 20) + ($this->minersLifers * 80 * ($this->raceBonus / 100));
        return $naturalIncome;
    }

    public function calculateBonusesAndDeductions($naturalIncome) {
        // Calculate Bonuses
        $bonus = 0;
        if (!$this->hasCommander) {
            $bonus += $naturalIncome * 0.10; // 10% more for having no commander
        }
        if ($this->commanderIncomeRate > 0) {
            $bonus += $this->commanderIncomeRate * (rand(10, 30) / 100); // 10-30% from commander's income
        }

        // Calculate Deductions based on Def Con Rate
        $deduction = 0;
        switch ($this->defConRate) {
            case 'low':
                $deduction = $naturalIncome * 0.10; // -10%
                break;
            case 'medium':
                $deduction = $naturalIncome * 0.20; // -20%
                break;
            case 'high':
                $deduction = $naturalIncome * 0.40; // -40%
                break;
            case 'critical':
                $deduction = $naturalIncome * 0.70; // -70%
                break;
            default:
                $deduction = 0; // No deduction if defcon rate is not recognized
                break;
        }

        // Additional deduction from officer income rate
        if ($this->commanderIncomeRate > 0) {
            $deduction += $this->commanderIncomeRate * (rand(10, 30) / 100); // 10-30% from officer income rate
        }

        // Final income after bonuses and deductions
        $finalIncome = $naturalIncome + $bonus - $deduction;
        return $finalIncome;
    }

    public function calculateBankCapacity($naturalIncome) {
        // Calculate Bank Capacity
        $bankCapacity = 0.75 * $naturalIncome * 48 * 2;
        return $bankCapacity;
    }
}

// Example usage
$players = [
    new Player("Player1", 100, 10, 25, 200, false, 'low'),
    new Player("Player2", 50, 5, 25, 150, true, 'medium'),
    new Player("Player3", 200, 20, 25, 300, false, 'high'),
];

// Calculate and display income and bank capacity for each player
foreach ($players as $player) {
    $naturalIncome = $player->calculateNaturalIncome();
    $finalIncome = $player->calculateBonusesAndDeductions($naturalIncome);
    $bankCapacity = $player->calculateBankCapacity($naturalIncome);

    echo "Player: " . $player->name . "\n";
    echo "Natural Income: $" . number_format($naturalIncome, 2) . "\n";
    echo "Final Income after Bonuses and Deductions: $" . number_format($finalIncome, 2) . "\n";
    echo "Bank Capacity: $" . number_format($bankCapacity, 2) . "\n\n";
}
?>
