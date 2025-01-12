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

$page = isset($_GET['page']) ? $_GET['page'] : '1';
$rankings = $s->Rankings($page);
?>

<table width="100%" border="0">
    <tr>
        <td>Name</td>
        <td>Rank</td>
        <td>Army Size</td>
        <td>Race</td>
        <td>Treasury</td>
        <td>Attack</td>
    </tr>
    <?php foreach ($rankings as $ranking): ?>
        <?php if ($ranking['rank'] != 0): ?>
            <?php $allyinfo = $s->getallyinfo($ranking['allyid']); ?>
            <tr>
                <td>
                    <a href='javascript:void(0)' onclick="sendData('user','get','<?= $ranking['uid']; ?>')"><?= htmlspecialchars($ranking['name']); ?></a>
                    <?php if ($ranking['allyid'] != 0): ?>
                        [<a href="javascript:void(0)" onclick="sendData('ally_mlist','get','<?= $ranking['allyid']; ?>','attack'); return false;"><?= htmlspecialchars($allyinfo->allyname); ?></a>]
                    <?php endif; ?>
                </td>
                <td><?= $ranking['rank']; ?></td>
                <td><?= $ranking['army']; ?></td>
                <td><?= htmlspecialchars($ranking['race']); ?></td>
                <td><?= $ranking['cash']; ?></td>
                <td>
                    <?php if ($ranking['uid'] != $_SESSION['userid']): ?>
                        <a href="javascript:void(0)" onclick="sendData('action','get','<?= $ranking['uid']; ?>','attack'); return false;">Attack</a>
                    <?php else: ?>
                        &nbsp;
                    <?php endif; ?>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>

<?php
echo "Query Count: " . $s->queryCount . "<br>";
$pagegen->stop();
echo 'Page generation time: ' . $pagegen->gen();
?>
