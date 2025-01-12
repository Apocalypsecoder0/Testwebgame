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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleet Docks</title>
</head>
<body>
    <h1>You made it to the fleet docks.</h1>
    <p>Query Count: <?php echo $s->queryCount; ?></p>
</body>
</html>

<?php 
$pagegen->stop();
echo 'Page generation time: ' . $pagegen->gen();
?>
