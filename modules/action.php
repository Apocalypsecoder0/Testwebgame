<?php
include_once("../config.php");

$pagegen = new page_gen();
$pagegen->round_to = 4;
$pagegen->start();

$s = new Game();
$actionType = $_GET['atype'] ?? null;
$touid = $_GET['id'] ?? null;

if ($actionType && $touid) {
    $time = null;

    switch ($actionType) {
        case "attack":
        case "raid":
            $time = $s->attack_raid($actionType, $touid, '15');
            break;
        case "spy":
            $time = $s->spy($touid, '1');
            break;
    }

    if ($time) {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("Location: http://$host$uri/actionLogs.php?id=" . $time . "&time=" . microtime());
        exit;
    }
}
?>
