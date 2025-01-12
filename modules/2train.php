<?php
include_once("../config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_SESSION['userid'];
    $miners = intval($_POST['miners']);
    $atk = intval($_POST['atk']);
    $uberAtk = intval($_POST['uberAtk']);
    $def = intval($_POST['def']);
    $uberDef = intval($_POST['uberDef']);
    $cov = intval($_POST['cov']);
    $uberCov = intval($_POST['uberCov']);
    $anti = intval($_POST['anti']);
    $uberAnti = intval($_POST['uberAnti']);

    // Fetch costs from the database
    $query = "SELECT attackCost, superAttackCost, defenseCost, superDefenseCost, covertCost, superCovertCost, anticovertCost, superAnticovertCost FROM training_costs";
    $result = mysqli_query($conn, $query);
    $costs = mysqli_fetch_assoc($result);

    // Calculate total cost
    $totalCost = ($miners * 1500) + 
                 ($atk * $costs['attackCost']) + 
                 ($uberAtk * $costs['superAttackCost']) + 
                 ($def * $costs['defenseCost']) + 
                 ($uberDef * $costs['superDefenseCost']) + 
                 ($cov * $costs['covertCost']) + 
                 ($uberCov * $costs['superCovertCost']) + 
                 ($anti * $costs['anticovertCost']) + 
                 ($uberAnti * $costs['superAnticovertCost']);

    // Check user balance (assuming you have a balance column in users table)
    $userQuery = "SELECT balance FROM users WHERE userid = ?";
    $stmt = $conn->prepare($userQuery);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $stmt->bind_result($balance);
    $stmt->fetch();
    $stmt->close();

    if ($balance >= $totalCost) {
        // Deduct cost and update user balance
        $newBalance = $balance - $totalCost;
        $updateQuery = "UPDATE users SET balance = ? WHERE userid = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("di", $newBalance, $userid);
        $stmt->execute();
        $stmt->close();

        // Here you would add the training logic (e.g., updating personnel stats)
        echo "Training successful!";
    } else {
        echo "Insufficient balance!";
    }
}
?>
