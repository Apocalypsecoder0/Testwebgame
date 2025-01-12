class Game {
    public $loggedIn = false; // Example property
    public $queryCount = 0; // Example property
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function updatePower($userId) {
        // Update power logic here
    }

    public function getActID($id) {
        $stmt = $this->db->prepare("SELECT * FROM actions WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->queryCount++;

        return $result->num_rows > 0; // Returns true if exists
    }

    public function __destruct() {
        $this->db->close();
    }
}<?php
include_once("../config.php");

$pagegen = new page_gen();
$pagegen->round_to = 4;
$pagegen->start();

$s = new Game();
if (!$s->loggedIn) {
    header("Location: https://realmbattles.org/SGWnew/index.php?");
    exit();
}

$s->updatePower($_SESSION['userid']);

if (isset($_GET['id'])) {
    $actionId = intval($_GET['id']); // Sanitize input
    if (!$s->getActID($actionId)) {
        echo "Sorry, the Action ID you entered does not exist.<br>";
    }
}

echo "Query Count: " . $s->queryCount . "<br>";
$pagegen->stop();
print('Page generation time: ' . $pagegen->gen());
?>
