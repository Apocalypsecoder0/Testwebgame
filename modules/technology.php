<?php 
include("../config.php");

$pagegen = new page_gen();
$pagegen->round_to = 4;
$pagegen->start();

$s = new Game();
if (!$s->loggedIn) {
    header("Location: https://realmbattles.org/SGWnew/index.php?");
}
$s->updatePower($_SESSION['userid']);

if ($_GET['id'] != "mainDisplay") {
    $s->buyTech($_GET['id'], $_GET['atype']);
}

$buy = $s->fieldtocrypt();
$tech = $s->viewTech();

$_SESSION['progress'] = min($tech->ttl, 200);
$data = $s->level($tech->ascend);
$tech->ascend++;
$data["z"] = number_format($data["y"] * $tech->ttl);
$a = 0;

?>
<form action="javascript:void(0)">
<center>
<table border='0'>
  <colgroup id="name"><col width="35%" /><col width="20%" /><col width="10%" /><col width="10%" /><col width="25%" /></colgroup>
<tr>
  <td colspan="4"><?php include_once("progressinfo.php"); ?></td>
</tr>
<tr>
    <td>Name of Upgrade</td>
    <td align="left">Status</td>
    <td align="center">Current Level</td>
    <td align="center">Max Level</td>
    <td align="center">Upgrade</td>
</tr>
<tr>
    <td>Unit Production Per Turn:<br />
        <font>-Standard is 3 Per Level. You Can Increase this by increasing Units Per Unit Production Level</font></td>
    <td align="left"><?php $status = (3 + $tech->uppl) * $tech->unitProd; echo $status; ?> units</td>
    <td align="center"><?= number_format($tech->unitProd); ?></td>
    <td align="center"><?php $upmax = ($tech->ascend * 500); echo number_format($upmax); ?></td>
    <td align="center"><?php if ($tech->unitProd < $upmax) { ?>
        <input name='buyup' type="text" value='1' size="4" maxlength="4">
        <input type="button" name="submit1" value="<?php $upcost = ((($tech->ascend) * 5000000) * ($tech->unitProd)); echo number_format($upcost) . " Naquadah"; ?>" onClick="this.value='Upgrading'; this.disable=true; sendData('technology','post','<?= $buy[$a++]; ?>',buyup.value);"><?php } else { $a++; ?> Capacity Reached. <?php } ?> 
    </td>
</tr>
<!-- Repeat similar structure for other upgrades -->
</table><br /><br />
<table border='0'>
  <colgroup id="name"><col width="35%" /><col width="15%" /><col width="15%" /><col width="35%" /></colgroup>
<tr>
    <td>Name of Upgrade</td>
    <td align="center">Current Level</td>
    <td align="center">Max Level</td>
    <td align="center">Upgrade</td>
</tr>
<tr>
    <td>Attack Unit Strength:<br />
        <font>-Increases Power Per Attack Unit.</font></td>
    <td align="center"><?= number_format($tech->attack); ?></td>
    <td align="center"><?= $data["x"]; ?></td>
    <td align="center"><?php if ($tech->attack < $data["x"]) { ?>
        <input name='buyatk' type="text" id="buyatk" value='1' size="4" maxlength="3" />
        <input type="button" name="submit7" value="<?= $data["z"] . " Naquadah"; ?>" onClick="this.value='Upgrading'; this.disable=true; sendData('technology','post','<?= $buy[$a++]; ?>',buyatk.value);"><?php } else { $a++; ?> Capacity Reached. <?php } ?> 
    </td>
</tr>
<!-- Repeat similar structure for other attack and defense upgrades -->
</table>
</form>
</center>
<?php
echo "Query Count: " . $s->queryCount . "<br>";
$pagegen->stop();
print('page generation time: ' . $pagegen->gen());
?>
