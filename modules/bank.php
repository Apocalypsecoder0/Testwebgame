<?php
include_once("../config.php");

class Game {
    public $queryCount = 0;

    public function bank($action = null, $amount = null) {
        global $db; // Assuming $db is your database connection

        if ($action === "deposit" && $amount) {
            $this->deposit($amount);
        } elseif ($action === "withdrawl" && $amount) {
            $this->withdraw($amount);
        }

        return $this->getAccountData();
    }

    private function deposit($amount) {
        global $db;
        $userId = $_SESSION['user_id']; // Assuming user ID is stored in session
        $db->query("UPDATE users SET onHand = onHand - ?, inBank = inBank + ? WHERE id = ?", [$amount, $amount, $userId]);
        $this->queryCount++;
    }

    private function withdraw($amount) {
        global $db;
        $userId = $_SESSION['user_id'];
        $db->query("UPDATE users SET onHand = onHand + ?, inBank = inBank - ? WHERE id = ?", [$amount, $amount, $userId]);
        $this->queryCount++;
    }

    private function getAccountData() {
        global $db;
        $userId = $_SESSION['user_id'];
        $result = $db->query("SELECT onHand, inBank, capacity FROM users WHERE id = ?", [$userId]);
        $this->queryCount++;
        return $result->fetch(PDO::FETCH_OBJ);
    }
}

$pagegen = new page_gen();
$pagegen->round_to = 4;
$pagegen->start();
$s = new Game();

if ($_GET['id'] == "deposit" || $_GET['id'] == "withdrawl") {
    $s->bank($_GET['id'], $_GET['atype']);
}

$data = $s->bank();
?>
