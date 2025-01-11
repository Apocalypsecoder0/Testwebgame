<?php

class Player {
    public $name;
    public $attack;
    public $defense;
    public $covert;
    public $mothership;

    public function __construct($name, $attack, $defense, $covert, $mothership) {
        $this->name = $name;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->covert = $covert;
        $this->mothership = $mothership;
    }

    public function getStats() {
        return [
            'attack' => $this->attack,
            'defense' => $this->defense,
            'covert' => $this->covert,
            'mothership' => $this->mothership,
        ];
    }
}

function calculateRanks($players) {
    $ranks = [];

    // Calculate ranks for each player
    foreach ($players as $player) {
        $stats = $player->getStats();
        $rank = [];

        // Rank each stat
        foreach ($stats as $stat => $value) {
            $rank[$stat] = 1; // Start with best rank
            foreach ($players as $otherPlayer) {
                if ($otherPlayer !== $player) {
                    if ($otherPlayer->getStats()[$stat] > $value) {
                        $rank[$stat]++;
                    }
                }
            }
        }

        // Calculate total rank and average rank
        $totalRank = array_sum($rank);
        $averageRank = $totalRank / count($rank);
        $ranks[] = [
            'player' => $player,
            'totalRank' => $totalRank,
            'averageRank' => $averageRank,
        ];
    }

    // Sort players by average rank
    usort($ranks, function($a, $b) {
        return $a['averageRank'] <=> $b['averageRank'];
    });

    return $ranks;
}

// Example usage
$players = [
    new Player("Player1", 10, 20, 15, 5),
    new Player("Player2", 15, 10, 20, 0),
    new Player("Player3", 5, 25, 10, 10),
    new Player("Player4", 20, 15, 5, 0),
];

// Calculate and display ranks
$ranks = calculateRanks($players);

echo "Player Rankings:\n";
foreach ($ranks as $rank) {
    echo $rank['player']->name . " - Total Rank: " . $rank['totalRank'] . ", Average Rank: " . number_format($rank['averageRank'], 2) . "\n";
}
?>
