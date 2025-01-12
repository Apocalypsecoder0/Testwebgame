<?php 
include("../config.php");

$pagegen = new page_gen();
$pagegen->round_to = 4;
$pagegen->start();

$s = new Game();
if (!$s->loggedIn || !isset($_GET['time'])) {
    header("Location: https://realmbattles.org/SGWnew/index.php?");
    exit();
}
$s->updatePower($_SESSION['userid']);

// Database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch market items
$sql = "SELECT * FROM market";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Market Items</h2>";
    while($row = $result->fetch_assoc()) {
        echo "Item: " . $row["item_name"]. " - Price: " . $row["price"]. "<br>";
    }
} else {
    echo "No items found in the market.";
}

echo "Query Count: ".$s->queryCount."<br>";
$pagegen->stop();
print('Page generation time: ' . $pagegen->gen());

$conn->close();
?>
