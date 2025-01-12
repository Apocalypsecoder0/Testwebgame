<?php
include_once("../config.php");

$pagegen = new page_gen();
$pagegen->round_to = 4;
$pagegen->start();

$s = new Game();
if (!$s->loggedIn || !isset($_GET['time'])) {
    header("Location: https://realmbattles.org/SGWnew/index.php?");
    exit;
}
$s->updatePower($_SESSION['userid']);
$base = $s->baseVars();
$allyinfo = ($base->allyid != 0) ? $s->getallyinfo($base->allyid) : null;

$newsQ = mysql_query("SELECT * FROM news ORDER BY id DESC") or die(mysql_error());
?>
<table align="center" border="0" cellpadding="10" cellspacing="0" width="90%">
<?php
while ($news = mysql_fetch_array($newsQ)) {
    $datenews = date('jS M y, G:i', ($news['news_time'] + 3600 * $logged['cas_modif']));
    echo "<tr>
            <td class=\"news1\"><font color=\"yellow\">{$news['news_naslov']}</font> (posted by <font color=\"yellow\">{$news['user_name']}</font> at {$datenews})</td>
          </tr>
          <tr>
            <td class=\"news2\">{$news['news_text']}</td>
          </tr>
          <tr><td></td></tr>";
}
?>
</table>

<table width="100%" border="0">
  <tr>
    <td width="58%" align="center" valign="top">
      <table width="100%" border="0">
        <tr>
          <td width="39%" align="left" valign="top">Name [ID]</td>
          <td width="61%" align="left" valign="top"><?= $base->uname . " [ " . $_SESSION['userid'] . " ]"; ?></td>
        </tr>
        <tr>
          <td align="left" valign="top">E-mail</td>
          <td align="left" valign="top"><?= $base->email; ?></td>
        </tr>
        <tr>
          <td align="left" valign="top">Race</td>
          <td align="left" valign="top"><?= $base->r_name; ?></td>
        </tr>
        <tr>
          <td align="left" valign="top">Commander</td>
          <td align="left" valign="top"><a href="javascript:void(0)" onclick="sendData('user','get','<?= $base->cid; ?>'); return false"><?= $base->cname; ?></a></td>
        </tr>
        <tr>
          <td align="left" valign="top">HomePlanet Name</td>
          <td align="left" valign="top"><?= $base->plnt_name; ?></td>
        </tr>
        <tr>
          <td align="left" valign="top">HomePlanet Size</td>
          <td align="left" valign="top"><?= $base->text; ?></td>
        </tr>
        <tr>
          <td align="left" valign="top">Total Planets Owned</td>
          <td align="left" valign="top"><?= number_format($base->ttlPlanetsOwned); ?></td>
        </tr>
        <tr>
          <td align="left" valign="top">Unit Production</td>
          <td align="left" valign="top"><?= number_format($base->up); ?> a Turn</td>
        </tr>
        <tr>
          <td align="left" valign="top">Turn Income Production</td>
          <td align="left" valign="top"><?= number_format($base->income); ?> Naquadah</td>
        </tr>
        <tr>
          <td colspan="2" align="left" valign="top">Defense and Covert Alert Level *TBC</td>
        </tr>
      </table>
      <br />
      <table width="100%" border="0">
        <tr>
          <td colspan="3" align="left">Alliance Management *TBC</td>
        </tr>
        <tr>
          <td colspan="3" align="left">List of Alliances</td>
        </tr>
        <tr>
          <td width="12%" align="left">Alliance:</td>
          <td width="38%" align="left"><?php if ($base->allyid == 0) { echo "None"; } else { ?><a href="javascript:void(0)" onclick="sendData('ally_mlist','get','<?= $base->allyid; ?>'); return false"><?= $allyinfo->allyname ?></a><?php } ?></td>
          <td width="50%" align="left"><?php if ($base->allyid == 0) { ?><a href="javascript:void(0)" onclick="sendData('c_ally','get','<?= $base->uid; ?>'); return false;">Create Alliance</a><?php } else { ?><input type="submit" name='allyenter' value='Enter Alliance' onclick="this.value='What ever...'; this.disabled=true; sendData('ally_mlist','get','<?= $base->allyid; ?>');" /><?php } ?></td>
        </tr>
      </table>
      <br />
      <table width="100%" border="0">
        <tr>
          <td colspan="5" align="left">Office Management</td>
        </tr>
        <tr>
          <td colspan="2" align="left">Accept New Officers?:</td>
          <td colspan="1.5" align="left">&nbsp;</td>
          <td colspan="1.5" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="left">Name</td>
          <td align="left">Army Size</td>
          <td align="left">Mercenaries</td>
          <td align="left">Race</td>
          <td align="left">Rank</td>
        </tr>
        <?php
        $offi = $s->getOfficers($_SESSION['userid']);
        foreach ($offi as $officer) {
            echo "<tr>
                    <td><a href=\"javascript:void(0)\" onclick=\"sendData('user','get','{$officer['uid']}'); return false\">{$officer['name']}</a></td>
                    <td>" . number_format($officer['size']) . "</td>
                    <td>" . number_format($officer['mercs']) . "</td>
                    <td>{$officer['race']}</td>
                    <td>{$officer['rank']}</td>
                  </tr>";
        }
        echo "<tr><td colspan='5'>Number of Officers: " . count($offi) . "</td></tr>";
        ?>
      </table>
    </td>
    <td width="42%" align="center" valign="top"><?php include_once('mil_rank.php'); ?><br /><?php include_once('./personnel.php'); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle">
      <table width="58%" border="0">
        <tr>
          <td align="center" valign="top">Recruitment</td>
        </tr>
        <tr>
          <td align="center" valign="top">Post this link around to get more players and more army for yourself. Spread the word, a raging war is going on here.</td>
        </tr>
        <tr>
          <td align="center" valign="top"><a href="javascript:void(0)" onclick="sendData('recruit','get','<?= $base->link; ?>'); return false">http://localhost/recruit.php?link=<?= $base->link; ?></a></td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<?php
$pagegen->stop();
echo "Query Count: " . $s->queryCount . "<br>";
print('Page generation time: ' . $pagegen->gen());
?>
