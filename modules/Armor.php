<?php
include_once("../config.php");

$pagegen = new page_gen();
$pagegen->round_to = 4;
$pagegen->start();

$s = new Game();
if (!$s->loggedIn || !isset($_GET['time'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $s->updatePower($_SESSION['userid']);
}

$weapons = $s->getWeapons($_SESSION['userid']);

if ($_REQUEST['atype'] === "repair") {
    $id = $_REQUEST['id'];
    $query = "UPDATE `weapons` SET `strength` = (SELECT weaponPower FROM armory WHERE wid = $id) WHERE uid = {$_SESSION['userid']} AND wid = $id";
    $s->query($query);
    echo "Weapon Repaired";
}

if ($_REQUEST['atype'] === "sellweps") {
    $id = $_REQUEST['id'];
    $wid = $_REQUEST['subject'];
    $query = "SELECT armory.wid, armory.weaponName, weapons.strength, armory.weaponPower, 
                     armory.cash_cost, armory.isDefense, weapons.quanity
              FROM `armory`, `weapons`, `userdata`
              WHERE weapons.uid = {$_SESSION['userid']} AND weapons.wid = $wid
              AND armory.wid = weapons.wid
              AND userdata.uid = weapons.uid
              AND armory.rid = userdata.rid
              LIMIT 1000";
    $q = mysql_query($query);
    $weaps = mysql_fetch_object($q);

    $costtosell = $id * ($weaps->cash_cost * ($weaps->strength / $weaps->weaponPower)) * 0.80;

    if ($id > $weaps->quanity) {
        echo "You don't have that many weapons";
        exit;
    } elseif ($id < 0) {
        echo "You cannot sell negative weapons.";
        exit;
    } else {
        $query = "UPDATE `weapons` SET `quanity` = `quanity` - '$id' WHERE `uid` = {$_SESSION['userid']} AND `wid` = $wid LIMIT 1";
        mysql_query($query);

        $query = "UPDATE `bank` SET `onHand` = `onHand` + '$costtosell' WHERE `uid` = {$_SESSION['userid']} LIMIT 1";
        mysql_query($query);
        echo "Weapons sold for " . number_format($costtosell) . " Naquadah.";

        $query = "DELETE FROM `weapons` WHERE `uid` = {$_SESSION['userid']} AND `wid` = $wid AND `quanity` = '0' LIMIT 1";
        mysql_query($query);
    }
}

if (isset($_POST['submit2']) && $_POST['submit2'] !== "Submit") {
    $posted = [];
    foreach (array_merge($weapons['atk'], $weapons['def']) as $weapon) {
        $posted[$weapon['fieldname']] = $_POST[$weapon['fieldname']] ?? 0;
    }
    $s->buyWeapons($posted);
    $s->updatePower($_SESSION['userid']);
}

$inv = $s->getWeaponInventory($_SESSION['userid']);
?>
<table width="100%" border="0">
    <tr>
        <td colspan="2">
            <table width="100%" border="0">
                <tr>
                    <td colspan="5" align="center" valign="middle">Current Weapon Inventory</td>
                </tr>
                <tr>
                    <td width="22%" align="left" valign="middle">Attack Weapons</td>
                    <td width="27%" align="center" valign="middle">Quantity</td>
                    <td width="16%" align="center" valign="middle">Strength</td>
                    <td width="13%" align="center" valign="middle">Repair</td>
                    <td width="22%" align="center" valign="middle">Scrap / Sell</td>
                </tr>
                <?php foreach ($inv['atk'] as $weapon): ?>
                    <tr>
                        <td align="left" valign="middle"><?= $weapon['name']; ?></td>
                        <td align="center" valign="middle"><?= $weapon['quanity']; ?></td>
                        <td align="center" valign="middle"><?= $weapon['strength'] . "/" . $weapon['power']; ?></td>
                        <td align="center" valign="middle">
                            <a href="javascript:void(0)" onclick="sendData('armory','get','<?= $weapon['wid']; ?>','repair'); return false;"><?= $weapon['perpoint']; ?></a>
                        </td>
                        <td align="center" valign="middle">
                            <input name="<?= $weapon['fieldname']; ?>" id="<?= $weapon['fieldname']; ?>" type="text" value="0" size="10" />
                            <a href="javascript:void(0)" onclick="sendData('armory','post',<?= $weapon['fieldname']; ?>.value,'sellweps','<?= $weapon['wid']; ?>');"> for <?= $weapon['sell']; ?> each</a>
                        </td>
                        <td colspan="4" align="right" valign="bottom">
                            <input type="submit" name="buyweaps" value="for <?= $weapon['sell']; ?> each" onclick="this.value='Selling Weapons...'; this.disabled=true; sendData('armory','post',<?= $weapon['fieldname']; ?>.value,'sellweps','<?= $weapon['wid']; ?>')"/>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td align="left" valign="middle">Defense Weapons</td>
                    <td align="center" valign="middle">Quantity</td>
                    <td align="center" valign="middle">Strength</td>
                    <td align="center" valign="middle">Repair</td>
                    <td align="center" valign="middle">Scrap / Sell</td>
                </tr>
                <?php foreach ($inv['def'] as $weapon): ?>
                    <tr>
                        <td align="left" valign="middle"><?= $weapon['name']; ?></td>
                        <td align="center" valign="middle"><?= $weapon['quanity']; ?></td>
                        <td align="center" valign="middle"><?= $weapon['strength'] . "/" . $weapon['power']; ?></td>
                        <td align="center" valign="middle">
                            <a href="javascript:void(0)" onclick="sendData('armory','get','<?= $weapon['wid']; ?>','repair'); return false;"><?= $weapon['perpoint']; ?></a>
                        </td>
                        <td align="center" valign="middle">
                            <input name="<?= $weapon['fieldname']; ?>" id="<?= $weapon['fieldname']; ?>" type="text" value="0" size="10" />
                            <a href="javascript:void(0)" onclick="sendData('armory','post',<?= $weapon['fieldname']; ?>.value,'sellweps','<?= $weapon['wid']; ?>');"> for <?= $weapon['sell']; ?> each</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr><td>&nbsp;</td></tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="37%" align="left" valign="top"><?php include_once('mil_rank.php'); echo "<br>"; include_once('personnel.php'); ?><br /></td>
        <td width="63%" align="right" valign="top">
            <form action="javascript:void(0)">
                <table width="90%" border="0">
                    <tr>
                        <td colspan="4" align="center" valign="top">Weapons</td>
                    </tr>
                    <tr>
                        <td width="26%" align="left" valign="top">Attack Weapons</td>
                        <td width="18%" align="right">Power</td>
                        <td width="40%" align="right">Cost</td>
                        <td width="16%" align="right">Quantity</td>
                    </tr>
                    <?php foreach ($weapons['atk'] as $weapon): ?>
                        <tr>
                            <td width="26%" align="left" valign="top"><?= $weapon['name']; ?></td>
                            <td width="18%" align="right" valign="top"><?= $weapon['power']; ?></td>
                            <td width="40%" align="right" valign="top"><?= $weapon['cashcost'] ? $weapon['cashcost'] . ' naquadrea' : $weapon['unitcost'] . ' untrained units'; ?></td>
                            <td width="16%" align="right" valign="bottom"><input name="<?= $weapon['fieldname']; ?>" type="text" value="0" size="10" /></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td width="26%" align="left" valign="top">Defense Weapons</td>
                        <td width="18%" align="right">Power</td>
                        <td width="40%" align="right">Cost</td>
                        <td width="16%" align="right" valign="bottom">Quantity</td>
                    </tr>
                    <?php foreach ($weapons['def'] as $weapon): ?>
                        <tr>
                            <td width="26%" align="left" valign="top"><?= $weapon['name']; ?></td>
                            <td width="18%" align="right" valign="top"><?= $weapon['power']; ?></td>
                            <td width="40%" align="right" valign="top"><?= $weapon['cashcost'] ? $weapon['cashcost'] . ' naquadrea' : $weapon['unitcost'] . ' untrained units'; ?></td>
                            <td width="16%" align="right" valign="bottom"><input name="<?= $weapon['fieldname']; ?>" type="text" value="0" size="10" /></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td colspan="4" align="right" valign="bottom">
                            <input type="submit" name="buyweaps" value="Submit" onclick="this.value='Buying Weapons...'; this.disabled=true; sendData('armory','post','<?= $s->uid; ?>')"/>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>
<?php
echo "Query Count: " . $s->queryCount . "<br>";
$pagegen->stop();
print('Page generation time: ' . $pagegen->gen());
?>
