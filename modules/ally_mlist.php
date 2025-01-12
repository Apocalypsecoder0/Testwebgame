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
        // Example: $stmt = $this->db->prepare("UPDATE users SET power = ? WHERE id = ?");
        // $stmt->bind_param("ii", $newPower, $userId);
        // $stmt->execute();
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
}
