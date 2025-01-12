<tr><td><?= $byMe->time;?> </td><td align="center">
                <a href="javascript:void(0)" onclick="sendData('user','get','<?= $byMe->uid; ?>'); return false">
                <?= $byMe->user; ?></td>
                <td align="center"><? if($byMe->success == 0 ) { echo "Attack Defended"; } else { echo number_format($byMe->stolen)." Cash Stolen"; } ?></td>
                <td align="center"><?= $byMe->turnsUsed; ?></td>
                <td align="center"><?= $byMe->thereDead; ?></td>
                <td align="center"><?= $byMe->myDead; ?></td>
                <td align="center"><?= number_format($byMe->attackPower); ?></td>
                <td align="center"><?= number_format($byMe->defensePower); ?></td>
                <td align="center">
                <a href="javascript:void(0)" onclick="sendData('actionLogs' , 'get' , '<?= $byMe->actID; ?>','atk'  )">Details
                </a></td>
                </tr>
        <?
            }
            echo "<tr><td colspan='9' align='center'>Attacks On You</td></tr><tr><td>Time</td><td>Enemy</td><td>Result</td>
                <td>Turns</td><td>Enemy Losses</td><td>Your Losses</td>
                <td> Damage By You</td><td>Damage To You</td></tr>";
            while ($toMe = mysql_fetch_object($toMeQ))
            {
                ?>
                
                <tr><td><?= $toMe->time;?> </td><td align="center">
                <a href="javascript:void(0)" onclick="sendData('user','get','<?= $toMe->uid; ?>'); return false">
                <?= $toMe->user; ?></td>
                <td align="center"><? if($toMe->success == 0 ) { echo "Attack Defended"; } else { echo number_format($toMe->stolen)." Cash Stolen"; } ?> </td>
                <td align="center"><?= $toMe->turnsUsed; ?></td>
                <td align="center"><?= $toMe->thereDead; ?></td>
                <td align="center"><?= $toMe->myDead; ?></td>
                <td align="center"><?= number_format($toMe->defensePower); ?></td>
                <td align="center"><?= number_format($toMe->attackPower); ?></td>
                <td align="center">
                <a href="javascript:void(0)" onclick="sendData('actionLogs' , 'get' , '<?= $toMe->actID; ?>', 'atk' )">Details
                </a></td>
                </tr>
        <?
            }
            echo "</table></center>";						
            break;
        case "raid":
            print "<center><table border=0><tr><td colspan='9' align='center'>Raids By You</td></tr><tr><td>Time</td><td>Enemy</td><td>Result</td>
                <td>Turns</td><td>Enemy Losses</td><td>Your Losses</td>
                <td> Damage By You</td><td>Damage To You</td></tr>";
            while ($byMe = mysql_fetch_object($byMeQ))
            {
                ?>
                
                <tr><td><?= $byMe->time;?> </td><td align="center">
                <a href="javascript:void(0)" onclick="sendData('user','get','<?= $byMe->uid; ?>'); return false">
                <?= $byMe->user; ?></td>
                <td align="center"><?= number_format($byMe->stolen); ?> Untrained Units Stolen</td>
                <td align="center"><?= $byMe->turnsUsed; ?></td>
                <td align="center"><?= $byMe->thereDead; ?></td>
                <td align="center"><?= $byMe->myDead; ?></td>
                <td align="center"><?= number_format($byMe->attackPower); ?></td>
                <td align="center"><?= number_format($byMe->defensePower); ?></td>
                <td align="center">
                <a href="javascript:void(0)" onclick="sendData('actionLogs' , 'get' , '<?= $byMe->actID; ?>', 'atk' )">Details
                </a></td>
                </tr>
        <?
            }
            print "<tr><td colspan='9' align='center'>Raids On You</td></tr><tr><td>Time</td><td>Enemy</td><td>Result</td>
                <td>Turns</td><td>Enemy Losses</td><td>Your Losses</td>
                <td> Damage By You</td><td>Damage To You</td></tr>";
            while ($toMe = mysql_fetch_object($toMeQ))
            {
                ?>
                
                <tr><td><?= $toMe->time;?> </td><td align="center">
                <a href="javascript:void(0)" onclick="sendData('user','get','<?= $toMe->uid; ?>'); return false">
                <?= $byMe->user; ?></td>
                <td align="center"><?= number_format($toMe->stolen); ?> Untrained Units Stolen</td>
                <td align="center"><?= $toMe->turnsUsed; ?></td>
                <td align="center"><?= $toMe->thereDead; ?></td>
                <td align="center"><?= $toMe->myDead; ?></td>
                <td align="center"><?= number_format($toMe->attackPower); ?></td>
                <td align="center"><?= number_format($toMe->defensePower); ?></td>
                <td align="center">
                <a href="javascript:void(0)" onclick="sendData('actionLogs' , 'get' , '<?= $toMe->actID; ?>', 'atk' )">Details
                </a></td>
                </tr>
                <?
            }
            echo "</table></center>";						
            break;
        case "spy":
            print "<center><table border=0><tr><td colspan='9' align='center'>Spys By You</td></tr><tr><td>Time</td><td>Enemy</td><td>Result</td></tr>";
            while ($byMe = mysql_fetch_object($byMeQ))
            {
                ?>
                
                <tr><td><?= $byMe->time;?> </td><td align="center">
                <a href="javascript:void(0)" onclick="sendData('user','get','<?= $byMe->uid; ?>'); return false">
                <?= $byMe->user; ?></td>
                <td align="center">Covert Operation</td>
                <td align="center">
                <a href="javascript:void(0)" onclick="sendData('actionLogs' , 'get' , '<?= $byMe->actID; ?>', 'atk' )">Details
                </a></td>
                </tr>
        <?
            }
            print "<tr><td colspan='9' align='center'>Spys On You</td></tr><tr><td>Time</td><td>Enemy</td><td>Result</td></tr>";
            while ($toMe = mysql_fetch_object($toMeQ))
            {
                ?>
                
                <tr><td><?= $toMe->time;?> </td><td align="center">
                <a href="javascript:void(0)" onclick="sendData('user','get','<?= $toMe->uid; ?>'); return false">
                <?= $byMe->user; ?></td>
                <td align="center">Covert Operation</td>
                <td align="center">
                <a href="javascript:void(0)" onclick="sendData('actionLogs' , 'get' , '<?= $toMe->actID; ?>', 'atk' )">Details
                </a></td>
                </tr>
                <?
            }
            echo "</table></center>";
            break;						
    }
}

function turnUpdate()
{
    /*Queries Users From Database and Last Time THey Logged in*/
    $query  = "SELECT users.uid AS user, 
                ((units.miners *(80+technology.income)) + ( units.lifers *(80+technology.income) ) + ( SUM( planets.income_bonus ) ) + (race.income_bonus*((units.miners *(80+technology.income))) + ( units.lifers *(80+technology.income)))) AS Income,
                ((technology.unitProd*(3+technology.uppl))+SUM( planets.up_bonus )+(race.up_bonus*(technology.unitProd*(3+technology.uppl)))) AS up, bank.onHand
                FROM users
                INNER JOIN units ON users.uid = units.uid
                INNER JOIN userdata ON users.uid = userdata.uid
                INNER JOIN race ON userdata.rid = race.rid
                INNER JOIN planets ON users.uid = planets.uid
                INNER JOIN bank ON users.uid = bank.uid
                INNER JOIN technology ON users.uid = technology.uid
                GROUP BY users.uid";
    $atkq = "SELECT `uid` FROM power ORDER BY `mil_atk` DESC";
    $defq = "SELECT `uid` FROM power ORDER BY `mil_def` DESC";
    $covq = "SELECT `uid` FROM power ORDER BY `mil_cov` DESC";
    $antq = "SELECT `uid` FROM power ORDER BY `mil_anti` DESC";
    $uidq = "SELECT users.`uname` , power . uid , SUM(power.mil_cov +power.mil_def +power.mil_atk +power.mil_anti )as averaged FROM power , users WHERE users . uid =power . uid GROUP BY uid  ORDER BY `averaged`  DESC";
    $upQ  = "SELECT technology.`uid`, ((technology.unitProd*(3+technology.uppl))+SUM( planets.up_bonus )+(race.up_bonus*(technology.unitProd*(3+technology.uppl)))) AS up FROM technology
