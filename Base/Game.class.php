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
$q = $this->query($query);
    $atk = $this->query($atkq);
    $def = $this->query($defq);
    $cov = $this->query($covq);
    $anti = $this->query($antq);
    $upS = $this->query($upQ);
    $incS = $this->query($incQ);
    $uids = $this->query($uidq);
    $rankings = $this->query($rankQ);
    $users = array();
    while($data = mysql_fetch_object($q))
    {
        /*Gives Naq*/
        $query = "UPDATE `bank` SET `onHand` =(`onHand`+$data->Income) WHERE `uid` =$data->user LIMIT 1 ";
        $this->query($query);
        /*Gives Turns*/
        $query = "UPDATE `userdata` SET `actionTurns` = (`actionTurns` + 3) WHERE `uid` =$data->user LIMIT 1";
        $this->query($query);
        /*Gives UU*/
        $query = "UPDATE `units` SET `untrained` = (`untrained` + $data->up) WHERE `uid` =$data->user LIMIT 1";
        $this->query($query);
    }
    $counter = 1;
    while ($data = mysql_fetch_object($atk))
    {
        $users[$data->uid]["atk"] = $counter;
        echo "$data->uid Atk Rank is $counter <br>";
        $counter++;
        
    }
    $counter = 1;
    while ($data = mysql_fetch_object($def))
    {
        $users[$data->uid]["def"] = $counter;
        echo "$data->uid Def Rank is $counter <br>";
        $counter++;
    }
    $counter = 1;
    while ($data = mysql_fetch_object($cov))
    {
        $users[$data->uid]["cov"] = $counter;
        echo "$data->uid Cov Rank is $counter <br>";
        $counter++;
    }
    $counter = 1;
    while ($data = mysql_fetch_object($anti))
    {
        $users[$data->uid]["anti"] = $counter;
        echo "$data->uid Anti Rank is $counter <br>";
        $counter++;
    }
    $counter = 1;
    while ($data = mysql_fetch_object($upS))
    {
        $users[$data->uid]["up"] = $counter;
        echo "$data->uid Unit Production Rank is $counter <br>";
        $counter++;
    }
    $counter = 1;
    while ($data = mysql_fetch_object($incS))
    {
        $users[$data->uid]["inc"] = $counter;
        echo "$data->uid Inc Rank is $counter <br>";
        $counter++;
    }
    $counter = 1;
    while ($data = mysql_fetch_object($rankings))
    {
        $users[$data->uid]["overall"] = $counter;
        echo "$data->uname overall Rank is $counter <br>";
        $counter++; 
    }
    $counter = 1;
    while ($data = mysql_fetch_object($uids))
    {
        $query = "UPDATE rank SET `mil_atk`=".$users[$data->uid]["atk"].", `mil_def`=".$users[$data->uid]["def"].", `mil_cov`=".$users[$data->uid]["cov"].", `mil_anti`=".$users[$data->uid]["anti"].", `up`= ".$users[$data->uid]["up"].", `income`=".$users[$data->uid]["inc"].", `mil_total`=".$counter.", `overall`=".$users[$data->uid]["overall"]." WHERE uid=$data->uid LIMIT 1";
        echo $query."<br>";
        $this->query($query);
        $counter++;
    }
    
    return true;
}

function delOld()
{
    /*Deletes Old Users*/
    $thrdays = time() - (30 * 24 * 60 * 60);
    $old = date('F jS', $thrdays);
    
    $query  = "SELECT users.lastLogin,users.uid FROM users";
    $q = $this->query($query);
    while($data = mysql_fetch_object($q))
    {
    if ($data->lastLogin == $old)
        {
            $query = "DELETE FROM users WHERE uid=$data->uid";
            $this->query($query);
            $query = "DELETE FROM bank WHERE uid=$data->uid";
            $this->query($query);
            $query = "DELETE FROM planets WHERE uid=$data->uid";
            $this->query($query);
            $query = "DELETE FROM power WHERE uid=$data->uid";
            $this->query($query);
            $query = "DELETE FROM rank WHERE uid=$data->uid";
            $this->query($query);
            $query = "DELETE FROM technology WHERE uid=$data->uid";
            $this->query($query);
            $query = "DELETE FROM units WHERE uid=$data->uid";
            $this->query($query);
            $query = "DELETE FROM userdata WHERE uid=$data->uid";
            $this->query($query);
            $query = "DELETE FROM weapons WHERE uid=$data->uid";
            $this->query($query);
            
        }
    }
}

function viewTech()
{
    $query="SELECT unitProd,uppl,income,attack,auSteal,auEffect,auRes,defense,duSteal,duEffect,duRes,covert,cuEffect,cuRes,anticovert,acuEffect,acuRes,galaxy,pDef,puCap,pmCap, ascend ,  cov_lvl, anti_lvl, SUM(attack+duSteal+auEffect+auRes+defense+duSteal+duEffect+duRes+covert+cuEffect+cuRes+anticovert+acuEffect+acuRes+pDef+1) AS ttl FROM `technology` WHERE `uid`=".$_SESSION['userid']." GROUP BY uid";
    $q = $this->query($query);
    $data = mysql_fetch_object($q);
    return $data;
}

/*I have the next to functions to stop people from tampering with the form data.*/
/*Its Salts the field then md5 encrypts it like tha passwords.*/
function fieldtocrypt()
{
    $data = $this->fields;
    $counter=0;
    foreach($data as $x)
    {
        $data[$counter] = $this->salt($x);
        $counter++;
    }
    return $data;
}

function crypttofield($crypt)
{
    $data = $this->fields;
    $counter = 0;
    $data2 = $this->fieldtocrypt();
    foreach($data2 as $dat)	
    {
        if($dat == $crypt)
        {
            return $data[$counter];
        }else{
            $counter++;
        }

    }
    return false;
}
/*End of Field Crypt Functions*/

function buytech($crypt,$quanity=1)
{
    if(!$type = $this->crypttofield($crypt))
    {
        echo "Error With Crypt $crypt <br>";
        exit;
    }
    $query = "SELECT bank.onHand,bank.inBank,puCap,pmCap,unitProd,uppl,income,galaxy,anti_lvl,cov_lvl,ascend , SUM(attack+duSteal+auEffect+auRes+defense+duSteal+duEffect+duRes+covert+cuEffect+cuRes+anticovert+acuEffect+acuRes+pDef+1) AS ttl FROM `technology`,`bank` WHERE bank.`uid`=".$_SESSION['userid']." AND technology.uid=bank.uid GROUP BY bank.uid LIMIT 1";
    $techQ = $this->query($query);
    $tech = mysql_fetch_object($techQ);
    $data = $this->level($tech->ascend);
    $data["z"] = $data["y"]*$tech->ttl;
    $money = (number_format($tech->onHand,0,'','') + number_format($tech->inBank,0,'',''));
    $cost = 0;
    $max = 0;
    
    switch($type)
    {
        case "unitProd":
            for($x=0;$x<$quanity;$x++)
            {
                $cost += ((($tech->ascend+1)*5000000)*($tech->unitProd+$x));
            }
            $max = (($tech->ascend+1)*500);
            break;
        case "uppl":
            for($x=0;$x<$quanity;$x++)
            {
                $cost += ((($tech->ascend+1)*50000000)*($tech->uppl+1+$x));
            }
            $max = ($tech->ascend+1)*10;
            break;
        case "income":
            for($x=0;$x<$quanity;$x++)
            {
                $cost += ((($tech->ascend+1)*10000000)*($tech->income+1+$x));
            }
            $max = ($tech->ascend+1)*10;
            break;	
        case "ascend":
            echo "Ascension is not Ready Yet";		
            break;
        case "cov_lvl":
            $cost = 15000;
            for ($x=0; $x<$tech->cov_lvl; $x++) { $cost *=2; }
            $max = 100000;
            break;
        case "anti_lvl":
            $cost = 15000;
            for ($x=0; $x<$tech->anti_lvl; $x++) { $cost *=2; }
            $max = 100000;
            break;
        default:
            for($x=0;$x<$quanity;$x++)
            {
                $cost += ($data["y"] * ($tech->ttl+$x));
            }
            $max = $data["x"];
            break;
    }
    $selectQ = "SELECT `$type` FROM `technology` WHERE `uid`=".$_SESSION['userid']." LIMIT 1";
    $select = $this->query($selectQ);
    $sel = mysql_fetch_row($select);
    if ($quanity <= 0) { exit; }
    if ($quanity+$sel[0] <= $max)
    {
        if (number_format($cost,0,'','') <= number_format($money,0,'',''))
        {
            $query = "UPDATE `technology` SET `$type`=`$type`+$quanity WHERE `uid`=".$_SESSION['userid']." LIMIT 1";
            if($this->query($query))
            {
                if($tech->onHand>=$cost)
                {
                    $query = "UPDATE `bank` SET `onHand`=`onHand`-$cost WHERE `uid`=".$_SESSION['userid']." LIMIT 1";
                    if(!$this->query($query)){ echo "SQL Error Check Debug <font> $query</font>"; exit; }
                }else{
                    $left = $cost - $tech->onHand;
                    $query = "UPDATE `bank` SET `onHand`=0 AND `inBank`=`inBank`-$left WHERE `uid`=".$_SESSION['userid']." LIMIT 1";
                    if(!$this->query($query)){ echo "SQL Error Check Debug<br><font> $query</font>"; exit; }
                }
                echo "You Spent (".number_format($cost).") on $type Technology<br>";
            }else{ echo "SQL Error Check Debug<font> $query</font>"; exit; }
        }else{
            echo "Not Enough Cash (".number_format($cost).")<br>";
        }
    }else{
        echo "$type would be Above Max";
    }
} 

function level($type)
{
    switch ($type){
        case '0':
            $data["str"] = "Non Ascended";
            $data["y"] = 500000;
            $data["x"] = 15;
            $data["ascend"] = 0;
            break;
        case '1':
            $data["str"] = "Prior";
            $data["y"] = 1000000;
            $data["x"] = 20;
            $data["ascend"] = 0;
            break;
        case '2':
            $data["str"] = "Prophet";
            $data["y"] = 5000000;
            $data["x"] = 25;
            $data["ascend"] = 0;
            break;
        case '3':
            $data["str"] = "Messiah";
            $data["y"] = 10000000;
            $data["x"] = 30;
            $data["ascend"] = 0;
            break;
        case '4':
            $data["str"] = "Incarnate";
            $data["y"] = 50000000;
            $data["x"] = 35;
            $data["ascend"] = 0;
            break;
        case '5':
            $data["str"] = "Living God";
            $data["y"] = 100000000;
            $data["x"] = 40;
            $data["ascend"] = 0;
            break;
        case '6':
            $data["str"] = "Fully Ascended";
            $data["y"] = 500000000;
            $data["x"] = 45;
            $data["ascend"] = 0;
            break;
    }
    return $data;
}

function sendMessage($toUID,$subject="None",$message)
{
    $gameTime 	= date("F jS H:i:s");
    $query = "INSERT INTO `messages` ( `fromUID` , `toUID` , `isDeleted` , `timeSent` ,`subject`, `message` )
                VALUES ( '".$_SESSION['userid']."', '$toUID', '0', ".$this->clean_sql($gameTime).", '$subject','$message')";
    if($this->query($query)) { return true; } else { return false; }
}

function create_allliance($UID,$name,$desc,$forumadd, $isclosed)
{
    if($name==''){
echo "Invalid Alliance Name";
return false;
}else{
$q="SELECT * FROM `alliances` WHERE `allyname` = '$name'";
$v=mysql_query($q);
$rcount=mysql_num_rows($v);
if($rcount==0){
$q="INSERT INTO `alliances` (`allyid`,`allyname`,`desc`,`forumadd`,`isclosed`,`allybank`,`founder`) VALUES ('','$name','$desc','$forumadd','$isclosed','0','".$UID."')";
mysql_query($q);
//now to bring it around to the user
$q="SELECT * FROM `alliances` WHERE `allyname` = '$name'";
$v=mysql_query($q);
$c=mysql_fetch_array($v);
$q="UPDATE `users` SET `allyid` = '".$c['allyid']."', `arank` = '2' WHERE `uid` = '".$UID."'";
mysql_query($q);
echo "alliance Created";
return true;
}else{
echo "alliance already exists";
return false;
}
    
}
}
function viewMessages()
{
    $query = "SELECT messages.`mid`, messages.fromUID, users.uname as user, messages.subject, messages.message, messages.timeSent FROM messages,users WHERE messages.toUID =".$_SESSION['userid']." AND users.uid = messages.fromUID";
    $q = $this->query($query);
    return $q;
}

function deleteMessage($mid)
{
    if ($mid == "all") { 
        $query = "DELETE FROM messages WHERE toUID=".$_SESSION['userid'];
    }elseif(is_numeric($mid)){
        $query = "DELETE FROM messages WHERE `mid`=$mid AND toUID=".$_SESSION['userid'];
    }
    if($this->query($query))
    {
        return true;
    }
    return false;
}

function bank($type="view",$ammount=0)
{
    switch($type)
    {
        case "view":
            $query = "SELECT bank.onHand,`bank`.`inBank` , ((
                        sum( planets.uid ) * ( 72 * ( units.miners * ( 80 + technology.income ) ) + ( units.lifers * ( 80 + technology.income ) ) 
                        + ( SUM( planets.income_bonus ) ) + ( race.income_bonus * ( (
                        units.miners * ( 80 + technology.income ) ) ) + ( units.lifers * ( 80 + technology.income ) ) )
                        ))*(technology.ascend+1)) AS cap FROM `bank`
                        INNER JOIN `userdata` ON bank.uid = userdata.uid
                        INNER JOIN `race` ON userdata.rid = race.rid
                        LEFT OUTER JOIN `units` ON userdata.uid = units.uid
                        LEFT OUTER JOIN `planets` ON userdata.uid = planets.uid
                        LEFT OUTER JOIN `users` users_1 ON userdata.cid = users_1.uid
                        LEFT OUTER JOIN `planetsize` ON planets.plnt_size = planetsize.size
                        LEFT OUTER JOIN `technology` ON userdata.uid = technology.uid
                        WHERE bank.uid =".$_SESSION['userid']."
                        GROUP BY bank.uid";
            $q = $this->query($query);
            $data = mysql_fetch_object($q);
            $data->left = abs($data->cap - $data->inBank);
            return $data;
            break;
        case "deposit":
            if (number_format($ammount,0,'','') > 0)
            {
                $data = $this->bank();
                if(number_format($data->left,0,'','') < number_format($ammount,0,'',''))
                {
                    $ammount = abs(number_format($data->left,0,'',''));
                }					
                    $query = "UPDATE `bank` SET `inbank`=(`inbank`+(".number_format($ammount,0,'','')."*.95)) , `onHand`=(`onHand`-".number_format($ammount,0,'','').") WHERE `uid`=".$_SESSION['userid']." LIMIT 1";
                if(!$this->query($query))
                { echo $query; } else { echo "Deposited: ".number_format($ammount); }
            }
            break;
        case "withdrawl":
            if (number_format($ammount,0,'','') > 0)
            {
                $data = $this->bank();
                if(number_format($data->inBank,0,'','') < number_format($ammount,0,'',''))
                {
                    $ammount = number_format($data->inBank,0,'','');
                }					
                $query = "UPDATE `bank` SET `inbank`=(`inbank`-(".number_format($ammount,0,'','').")) , `onHand`=(`onHand`+".number_format($ammount,0,'','').") WHERE `uid`=".$_SESSION['userid']." LIMIT 1";
                if(!$this->query($query))
                { echo $query; } else { echo "Withdrew: ".number_format($ammount); }
                return null;
            }
    }
}

function spy($uid,$turns=0)
{
    if($turns==0) { echo "No Turns Used. Contact Admin"; exit; }
    $time 	= date("F j H:i:s");
    $this->updatePower($_SESSION['userid']);
    $this->updatePower($uid);
    $query = "SELECT (units.superCovert + units.covert) as units, (mil_cov + mil_anti) AS fromCovert, (SELECT (mil_cov + mil_anti) FROM power WHERE uid =".$uid." ) AS toCovert FROM power,units WHERE units.uid =".$_SESSION['userid']." AND power.uid =".$_SESSION['userid'];
    $q = $this->query($query);
    $pwr = mysql_fetch_object($q);
    $query = "SELECT 
                userdata.actionTurns,
                technology.cov_lvl AS covertLVL,
                technology.anti_lvl AS antiLVL,
                power.mil_atk AS milStrike,
                power.mil_def AS milDefense,
                power.mil_cov AS milCovert,
                power.mil_anti AS milAnti,
                units.attack 		AS attackCount, 
                units.superAttack 	AS superAttackCount, 
                units.attackMercs 	AS attackMercCount,
                units.defense		AS defenseCount,
                units.superDefense	AS superDefenseCount,
                units.defenseMercs	AS defenseMercCount,
                units.untrained		AS uuCount,
                units.miners 		AS minerCount,
                units.lifers		AS liferCount,
                units.covert		AS covertCount,
                units.superCovert	AS superCovertCount,
                units.anticovert	AS anticovertCount,
                units.superAnticovert	AS superAnticovertCount,
                unitnames.attack 	AS attackName, 
                unitnames.superAttack 	AS superAttackName, 
                unitnames.attackMercs 	AS attackMercName,
                unitnames.defense	AS defenseName,
                unitnames.superDefense	AS superDefenseName,
                unitnames.defenseMercs	AS defenseMercName,
                unitnames.covert	AS covertName,
                unitnames.superCovert	AS superCovertName,
                unitnames.anticovert	AS anticovertName,
                unitnames.superAnticovert AS superAnticovertName,
                SUM( units.attack+ units.superAttack+ units.attackMercs+ units.defense+ units.superDefense+ units.defenseMercs+ units.untrained+ units.miners+ units.lifers+ units.covert+ units.superCovert+ units.anticovert+ units.superAnticovert ) AS ttlarmysize,
                ((units.miners *(80+technology.income)) + ( units.lifers *(80+technology.income) ) + ( SUM( planets.income_bonus ) ) + (race.income_bonus*((units.miners *(80+technology.income))) + ( units.lifers *(80+technology.income)))) AS income,
                ((technology.unitProd*(3+technology.uppl))+SUM( planets.up_bonus )+(race.up_bonus*(technology.unitProd*(3+technology.uppl)))) AS up
                FROM `userdata` INNER JOIN `units` ON userdata.uid = units.uid INNER JOIN `unitnames` ON userdata.rid = unitnames.rid INNER JOIN `power` ON userdata.uid = power.uid INNER JOIN `technology` ON userdata.uid = technology.uid INNER JOIN `planets` ON userdata.uid = planets.uid INNER JOIN `race` ON userdata.rid = race.rid WHERE userdata.uid = ".$uid." GROUP BY userdata.uid LIMIT 1";
                if($q = $this->query($query))
                {
                    $data = mysql_fetch_object($q);
                    $ttl = $data->minerCount+$data->liferCount; 
                    switch($pwr->fromCovert){
                        case ($pwr->fromCovert >= 5*$pwr->toCovert):
                            $perc = 1;
                            $suc = 1;
                            break;
                        case ($pwr->fromCovert > 4*$pwr->toCovert):
                            $perc = .8;
                            $suc = 1;
                            break;
                        case ($pwr->fromCovert > 3*$pwr->toCovert):
                            $perc = .6;
                            $suc = 1;
                            break;
                        case ($pwr->fromCovert > 2*$pwr->toCovert):
                            $perc = .4;
                            $suc = 1;
                            break;
                        case ($pwr->fromCovert > $pwr->toCovert):
                            $perc = .2;
                            $suc = 1;
                            break;
                        case ($pwr->fromCovert > .25*$pwr->toCovert):
                            $perc = 0.1;
                            $suc = 1;
                            break;
                        case ($pwr->fromCovert <= .25*$pwr->toCovert):
                            $suc = 0;
                            $perc = 0;
                            break;
                    }
                    $array = array($data->attackName,$data->attackCount,$data->superAttackName,$data->superAttackCount,$data->attackMercName,$data->attackMercCount,$data->defenseName,$data->defenseCount,$data->superDefenseName,$data->superDefenseCount,$data->defenseMercName,$data->defenseMercCount,$data->uuCount,$ttl,$data->liferCount,$data->covertName,$data->covertCount,$data->superCovertName,$data->superCovertCount,$data->anticovertName,$data->anticovertCount,$data->superAnticovertName,$data->superAnticovertCount,$data->ttlarmysize,$data->milStrike,$data->milDefense,$data->milCovert,$data->milAnti,$data->covertLVL,$data->antiLVL,$data->actionTurns,$data->up,$data->income);
                                            
                    $xyz = 20 * (1-$perc);
                    for($x = 0; $x < count($array); $x++)
                    {
                        $arrayQ[$x] = "i";
                    }
                    for ($z=0; $z <$xyz; $z++)
                    {
                        $arrayb[$z] = mt_rand(0,32);
                    }
                    
                    for($x=0; $x < count($arrayb); $x++)
                    {
                            for($y=0; $y < count($arrayb); $y++)
                            {
                                if($y != $x)
                                {
                                    while ($arrayb[$x] == 0 || $arrayb[$x] == 2 || $arrayb[$x] == 4 || $arrayb[$x] == 6 || 
                                            $arrayb[$x] == 8 || $arrayb[$x] == 10 || $arrayb[$x] == 15 || $arrayb[$x] == 17 || 
                                            $arrayb[$x] == 19 || $arrayb[$x] == 21 || $arrayb[$x] == $arrayb[$y])
                                    {
                                        $arrayb[$x] = mt_rand(0,32);
                                    }
                                }
                            }
                        $arrayQ[$arrayb[$x]] = "z";
                    }
                    for($xyz = 0; $xyz < count($array); $xyz++)
                    {
                        if($arrayQ[$xyz] == "z")
                        {
                            $arrayFinal[$xyz] = "??????";
                            
                        }elseif($arrayQ[$xyz] == "i")
                        {
                            if(is_numeric($array[$xyz]))
                            {
                                $arrayFinal[$xyz] = $array[$xyz];
                            }else{
                                $arrayFinal[$xyz] = $array[$xyz];
                            }
                        }
                        
                    }
                    if ($suc == 0) { 
                        $query = "INSERT INTO `actionlog` (`uid`,`to_uid`,`time`,`type`,`atkSent`,`success`,`phrase`) VALUES (".$this->clean_sql($_SESSION['userid']).",".$this->clean_sql($uid).",".$this->clean_sql($time).", 'spy', ".$this->clean_sql($pwr->units).",".$this->clean_sql($suc).",'Covert Operation')";
                        $this->query($query);
                        $query = "UPDATE `units` SET `covert` = (`covert`) , `superCovert`=(`superCovert`) WHERE uid = ".$_SESSION['userid'];
                        $this->query($query);
                        $query = "SELECT `actID` FROM `actionlog` WHERE uid=".$_SESSION['userid']." AND to_uid=$uid AND `time`=".$this->clean_sql($time);
                        $q = $this->query($query);
                        $qa = mysql_fetch_object($q);
                        return $qa->actID;
                    } 
                    
                    $query = "INSERT INTO `actionlog` (`uid`,`to_uid`,`time`,`type`,`atkSent`,`atkWeaponStatus`,`success`,`phrase`) VALUES 
                                (".$this->clean_sql($_SESSION['userid']).",".$this->clean_sql($uid).",".$this->clean_sql($time).", 'spy', 
                                ".$this->clean_sql($pwr->units).",".$this->clean_sql(implode(',',$arrayFinal)).",".$this->clean_sql($suc).",'Covert Operation')";

                    $this->query($query);
                    $query = "SELECT `actID` FROM `actionlog` WHERE uid=".$_SESSION['userid']." AND to_uid=$uid AND `time`=".$this->clean_sql($time);
            
                    $q = $this->query($query);
                    $qa = mysql_fetch_object($q);
                    return $qa->actID;
                }
                echo "Broken Contact Admin";
                return null;
}

/*function spyWeapons($uid)
{
    $this->updatePower($_SESSION['userid']);
    $this->updatePower($uid);
    $query = "SELECT (mil_cov + mil_anti) AS fromCovert, (SELECT (mil_cov + mil_anti) FROM power WHERE uid =".$uid." ) AS toCovert FROM power WHERE uid =".$_SESSION['userid'];
    
    $q = $this->query($query);
    $pwr = mysql_fetch_object($q);
    $query = "SELECT armory.WeaponName as name, armory.WeaponPower as base, armory.isDefense as def, weapons.quanity as quan, weapons.strength as power FROM weapons, userdata, armory WHERE weapons.uid = $uid AND userdata.uid = weapons.uid AND armory.rid = userdata.rid AND weapons.wid = armory.wid ORDER by armory.isDefense ASC";
    if($q = $this->query($query))
    {
        $data = mysql_fetch_object($q);
        $ttl = $data->minerCount+$data->liferCount; 
        switch($pwr->fromCovert){
            case ($pwr->fromCovert >= 5*$pwr->toCovert):
                $perc = 1;
                break;
            case ($pwr->fromCovert > 4*$pwr->toCovert):
                $perc = .8;
                break;
            case ($pwr->fromCovert > 3*$pwr->toCovert):
                $perc = .6;
                break;
            case ($pwr->fromCovert > 2*$pwr->toCovert):
                $perc = .4;
                break;
            case ($pwr->fromCovert > $pwr->toCovert):
                $perc = .2;
                break;
            case ($pwr->fromCovert > .25*$pwr->toCovert):
                $perc = 0.1;
                break;
        }

    return $q;
}*/

function sabotage($uid, $turns = 0) 
{
    if($turns == 0){ echo "no Turns Used<br>"; exit; }
    $query = "SELECT (Select `mil_cov` FROM `power` WHERE `uid`=$uid LIMIT 1) AS toCov, `mil_cov` AS fromCov, `actionTurns` FROM userdata,power WHERE userdata.`uid` =".$_SESSION['userid']." AND power.uid = userdata.uid ";
    $q = $this->query($query);
    $data = mysql_fetch_object($q);
    $fromCov = $data->fromCov;
    $toCov = $data->toCov;
    if ($turns > $data->actionTurns) { echo "You do not have that many turns<br>"; }
    if ($fromCov > $toCov) { 
        echo "Your Men Destroyed weapons and live to sabotage another day<br>"; 
        $query = "SELECT `covert`,`superCovert`,(SELECT `covert` FROM units WHERE `uid`=$uid) as enemy_cov,(SELECT `superCovert` as enemy_superCovert FROM units WHERE `uid`=$uid) as enemy_superCovert FROM units WHERE uid=".$_SESSION['userid'];
        $q = $this->query($query);
        $data2 = mysql_fetch_object($q);
        $data3 = $this->getWeaponInventory($_SESSION['userid']);
        print_r($data3);
    } else { 
        echo "Your Men are Dead<br>"; 
    }	
}
<?php
// Base::Game.class.php

class Game extends User
{
    /*Vars*/
    var $gameTime;         // Time In Game
    var $isRank;           // Players Rank out of all active users
    var $actionTurns;      // Number of Action Turns User has to use
    var $inHand;           // Amount of Money On Hand
    var $inBank;           // Amount of Money Banked
    //var $inGuildbank; //Amount of Money in guild bnank  
    var $nextTurn;         // Amount of Time Till Next Turn
    var $numMessages;      // Number of Messages In User's Inbox
    var $uid;              // UserID
    var $rid;              // Race Identifier
    var $fields;           // Field List
    var $guildfields;           // guildField List
    function nextTurn()
    {
        $turnTime = 30;
        $timeIs = date("i");
        $perHr = 60 / $turnTime;
        for ($x = 1; $x <= $perHr; $x++) {
            if ($timeIs >= ($x - 1) * $turnTime && $timeIs <= $x * $turnTime) {
                $this->nextTurn = ($x * $turnTime) - $timeIs;
            }
        }
        return $this->nextTurn;
    }

    function getRaces()
    {
        $query = "SELECT `r_name`, `rid` FROM `race` LIMIT 30";
        $q = $this->query($query);
        $list = [];
        while ($obj = mysql_fetch_object($q)) {
            $list[] = ["name" => $obj->r_name, "id" => $obj->rid];
        }
        return $list;
    }

    function autoLoad()
    {
        $query = "SELECT rank.overall AS isRank, bank.onHand, bank.inBank, userdata.actionTurns, 
                  (SELECT COUNT(messages.toUID) FROM `messages` 
                   RIGHT OUTER JOIN `userdata` ON messages.toUID = userdata.uid 
                   WHERE userdata.uid = {$_SESSION['userid']} GROUP BY userdata.uid) AS messageCount 
                  FROM `bank`, `userdata`, `rank` 
                  WHERE bank.uid = {$_SESSION['userid']} 
                  AND userdata.uid = bank.uid  
                  AND rank.uid = bank.uid LIMIT 1";
        $q = $this->query($query);
        $auto = mysql_fetch_object($q);
        $gameTime = date("F jS H:i:s");
        $str = "new Array(\"" . number_format($auto->onHand) . "\",\"" . number_format($auto->inBank) . "\",\"" . 
               number_format($auto->isRank) . "\",\"" . number_format($auto->actionTurns) . "\",\"" . 
               $gameTime . "\",\"" . number_format($auto->messageCount) . "\",\"" . $this->nextTurn() . " minutes\")";
        $_SESSION['money'] = $auto->onHand;
        return $str;
    }

    function messageCount()
    {
        Debug::printMsg(__CLASS__, __FUNCTION__, "Getting Count of Messages");
        $query = "SELECT COUNT(`message`) FROM `messages` WHERE `toUID` = {$_SESSION['userid']} LIMIT 1000";
        $q = $this->query($query);
        return number_format(mysql_num_rows($q));
    }

    function baseVars()
    {
        $query = "SELECT users.uid, users.uname, users.email, users.allyid, userdata.link, race.r_name, 
                  users_1.uid AS cid, users_1.uname AS cname, planetsize.text, planets.plnt_name,
                  (SELECT COUNT(planets.pid) FROM planets 
                   RIGHT OUTER JOIN `userdata` ON planets.uid = userdata.uid 
                   WHERE userdata.uid = {$_SESSION['userid']} GROUP BY userdata.uid) AS `ttlPlanetsOwned`,
                  ((units.miners * (80 + technology.income)) + (units.lifers * (80 + technology.income)) + 
                   (SUM(planets.income_bonus)) + (race.income_bonus * ((units.miners * (80 + technology.income))) + 
                   (units.lifers * (80 + technology.income)))) AS income,
                  ((technology.unitProd * (3 + technology.uppl)) + SUM(planets.up_bonus) + 
                   (race.up_bonus * (technology.unitProd * (3 + technology.uppl)))) AS up
                  FROM `users` 
                  INNER JOIN `userdata` ON users.uid = userdata.uid
                  INNER JOIN `race` ON userdata.rid = race.rid 
                  LEFT OUTER JOIN `units` ON userdata.uid = units.uid 
                  LEFT OUTER JOIN `planets` ON userdata.uid = planets.uid 
                  LEFT OUTER JOIN `users` users_1 ON userdata.cid = users_1.uid 
                  LEFT OUTER JOIN `planetsize` ON planets.plnt_size = planetsize.size
                  LEFT OUTER JOIN `technology` ON userdata.uid = technology.uid
                   LEFT OUTER JOIN researchedblib` ON userdata.uid = researchedlib.uid
                  WHERE users.uid = {$_SESSION['userid']} GROUP BY users.uid";
        $q = $this->query($query);
        return mysql_fetch_object($q);
    }

    function getRanks()
    {
        $query = "SELECT rank.overall AS rank, rank.mil_atk AS milAtkRank, rank.mil_def AS milDefRank, 
                  rank.mil_cov AS milCovRank, rank.mil_anti AS milAntiRank, rank.mil_total AS milRank, 
                  power.mil_atk AS milAtk, power.mil_def AS milDef, power.mil_cov AS milCov, 
                  power.mil_anti AS milAnti, SUM(rank.mil_atk + rank.mil_def + rank.mil_cov + rank.mil_anti) AS mil
                  FROM rank, power
                  WHERE rank.uid = {$_SESSION['userid']} AND power.uid = rank.uid GROUP BY rank.uid LIMIT 1";
        $q = $this->query($query);
        return mysql_fetch_object($q);
    }

    function getPersonnel($uid)
    {
        $query = "SELECT units.attack AS attackCount, units.superAttack AS superAttackCount, 
                  units.attackMercs AS attackMercCount, units.defense AS defenseCount, 
                  units.superDefense AS superDefenseCount, units.defenseMercs AS defenseMercCount, 
                  units.untrained AS uuCount, units.miners AS minerCount, units.lifers AS liferCount, 
                  units.covert AS covertCount, units.superCovert AS superCovertCount, 
                  units.anticovert AS anticovertCount, units.superAnticovert AS superAnticovertCount, 
                  unitnames.attack AS attackName, unitnames.superAttack AS superAttackName, 
                  unitnames.attackMercs AS attackMercName, unitnames.defense AS defenseName, 
                  unitnames.superDefense AS superDefenseName, unitnames.defenseMercs AS defenseMercName, 
                  unitnames.covert AS covertName, unitnames.superCovert AS superCovertName, 
                  unitnames.anticovert AS anticovertName, unitnames.superAnticovert AS superAnticovertName, 
                  unitcost.attack AS attackCost, unitcost.superAttack AS superAttackCost, 
                  unitcost.defense AS defenseCost, unitcost.superDefense AS superDefenseCost, 
                  unitcost.covert AS covertCost, unitcost.superCovert AS superCovertCost, 
                  unitcost.anticovert AS anticovertCost, unitcost.superAnticovert AS superAnticovertCost, 
                  SUM(units.attack + units.superAttack + units.attackMercs + units.defense + 
                  units.superDefense + units.defenseMercs + units.untrained + units.miners + 
                  units.lifers + units.covert + units.superCovert + units.anticovert + 
                  units.superAnticovert) AS ttlarmysize
                  FROM `units`, `unitnames`, `userdata`, `unitcost` 
                  WHERE userdata.uid = {$uid} AND unitnames.rid = userdata.rid 
                  AND units.uid = userdata.uid AND unitcost.rid = userdata.rid 
                  GROUP BY userdata.uid LIMIT 1";
        $q = $this->query($query);
        return mysql_fetch_object($q);
    }

    function getOfficers($uid)
    {
        Debug::printMsg(__CLASS__, __FUNCTION__, "Retrieving Officers");
        $query = "SELECT userdata.uid, userdata.uname, race.r_name, rank.overall, 
                  (SELECT SUM(units.attack + units.superAttack + units.attackMercs + units.defense + 
                  units.superDefense + units.defenseMercs + units.untrained + units.miners + 
                  units.lifers + units.covert + units.superCovert + units.anticovert + 
                  units.superAnticovert) FROM `units` WHERE uid = {$uid}) AS ttlarmy, 
                  (SELECT SUM(units.attackMercs + units.defenseMercs) FROM `units` WHERE uid = {$uid}) AS mercs
                  FROM `userdata`, `users`, `race`, `rank`
                  WHERE userdata.cid = {$uid} AND users.uid = userdata.uid 
                  AND userdata.rid = race.rid AND userdata.uid = rank.uid
                  ORDER BY `overall` ASC LIMIT 100";
        $q = $this->query($query);
        $officers = [];
        while ($offlist = mysql_fetch_assoc($q)) {
            $officers[] = [
                "uid" => $offlist["uid"],
                "name" => $offlist["uname"],
                "rank" => $offlist["overall"],
                "race" => $offlist["r_name"],
                "size" => $offlist["ttlarmy"],
                "mercs" => $offlist["mercs"]
            ];
        }
        return $officers;
    }

    function Rankings($pnum = 1)
    {
        Debug::printMsg(__CLASS__, __FUNCTION__, "Retrieving Ranks");
        $rankings = [];
        $perpage = 25;
        $page = [1, $perpage]; // Selects Page
        $page[0] = 0 + (($pnum - 1) * $perpage);
        $page[1] = ($pnum * $perpage) - 1;
        $counter = 0; // So it can just keep adding to array
        $query = "SELECT SUM(mil_cov + mil_anti) AS covact FROM `power` WHERE uid = {$_SESSION['userid']}";
        $q = $this->query($query);
        $userStats = mysql_fetch_object($q);

        $query = "SELECT rank.overall, users.uid, users.allyid, bank.onHand, power.mil_cov, 
                  power.mil_anti, race.r_name, users.uname,
                  SUM(units.attack + units.superAttack + units.attackMercs + units.defense + 
                  units.superDefense + units.defenseMercs + units.untrained + units.miners + 
                  units.lifers + units.covert + units.superCovert + units.anticovert + 
                  units.superAnticovert) AS armySize
                  FROM `rank`, `users`, `userdata`, `race`, `bank`, `power`, `units`
                  WHERE userdata.rid = race.rid	
                  AND users.uid = userdata.uid 
                  AND userdata.uid = power.uid 
                  AND power.uid = users.uid 
                  AND users.uid = bank.uid 
                  AND rank.uid = bank.uid
                  AND units.uid = rank.uid
                  GROUP BY users.uid
                  ORDER BY rank.overall ASC";
        $q = $this->query($query);
        while ($rank = mysql_fetch_object($q)) {
            $xfact = $rank->mil_cov + $rank->mil_anti; // Covert Defense See if You Can see stats
            $rankings[$counter]['uid'] = $rank->uid;
            $rankings[$counter]['allyid'] = $rank->allyid;
            $rankings[$counter]['name'] = $rank->uname;
            $rankings[$counter]['rank'] = number_format($rank->overall);

            if ($userStats->covact < .2 * $xfact) {
                $rankings[$counter]['army'] = "??????";
            } else {
                $rankings[$counter]['army'] = number_format($rank->armySize);
            }

            $rankings[$counter]['race'] = $rank->r_name;

            if ($userStats->covact < .25 * $xfact) {
                $rankings[$counter]['cash'] = "??????";
            } else {
                $rankings[$counter]['cash'] = number_format($rank->onHand);
            }

            $counter++;
        }
        return $rankings;
    }

    function allyRankings($pnum = 1, $allyid)
    {
        Debug::printMsg(__CLASS__, __FUNCTION__, "Retrieving alliance Rankings");
        $rankings = [];
        $perpage = 25;
        $page = [1, $perpage]; // Selects Page
        $page[0] = 0 + (($pnum - 1) * $perpage);
        $page[1] = ($pnum * $perpage) - 1;
        $counter = 0; // So it can just keep adding to array
        $query = "SELECT SUM(mil_cov + mil_anti) AS covact FROM `power` WHERE uid = {$_SESSION['userid']}";
        $q = $this->query($query);
        $userStats = mysql_fetch_object($q);

        $query = "SELECT rank.overall, users.uid, users.allyid, bank.onHand, power.mil_cov, 
                  power.mil_anti, race.r_name, users.uname,
                  SUM(units.attack + units.superAttack + units.attackMercs + units.defense + 
                  units.superDefense + units.defenseMercs + units.untrained + units.miners + 
                  units.lifers + units.covert + units.superCovert + units.anticovert + 
                  units.superAnticovert) AS armySize
                  FROM `rank`, `users`, `userdata`, `race`, `bank`, `power`, `units`
                  WHERE userdata.rid = race.rid	
                  AND users.uid = userdata.uid 
                  AND userdata.uid = power.uid 
                  AND power.uid = users.uid 
                  AND users.uid = bank.uid 
                  AND rank.uid = bank.uid
                  AND units.uid = rank.uid
                  AND users.allyid = '$allyid' 
                  GROUP BY users.uid
                  ORDER BY rank.overall ASC";
        $q = $this->query($query);
        while ($rank = mysql_fetch_object($q)) {
            $xfact = $rank->mil_cov + $rank->mil_anti; // Covert Defense See if You Can see stats
            $rankings[$counter]['uid'] = $rank->uid;
            $rankings[$counter]['name'] = $rank->uname;
            $rankings[$counter]['rank'] = number_format($rank->overall);
            $rankings[$counter]['allyid'] = $rank->allyid;

            if ($userStats->covact < .2 * $xfact) {
                $rankings[$counter]['army'] = "??????";
            } else {
                $rankings[$counter]['army'] = number_format($rank->armySize);
            }

            $rankings[$counter]['race'] = $rank->r_name;

            if ($userStats->covact < .25 * $xfact) {
                $rankings[$counter]['cash'] = "??????";
            } else {
                $rankings[$counter]['cash'] = number_format($rank->onHand);
            }

            $counter++;
        }
        return $rankings;
    }

    function getallyinfo($allyid)
    {
        Debug::printMsg(__CLASS__, __FUNCTION__, "Retrieving alliance info");
        $query = "SELECT * FROM alliances WHERE alliances.allyid = {$allyid} LIMIT 1";
        $q = $this->query($query);
        return mysql_fetch_object($q);
    }

    function getUserInfo($uid)
    {
        $query = "SELECT SUM(mil_cov + mil_anti) AS covact FROM `power` WHERE uid = {$_SESSION['userid']}";
        $q = $this->query($query);
        $myStats = mysql_fetch_object($q);

        $query = "SELECT users.uname AS userName, rank.overall AS rank, 
                  SUM(power.mil_cov + power.mil_anti) AS `covPro`,
                  (SELECT users.uname FROM users, userdata WHERE userdata.uid = {$uid} AND users.uid = userdata.cid) AS `cmdrName`,
                  userdata.cid AS `cmdrID`,
                  (SELECT r_name FROM race WHERE rid = (SELECT rid FROM userdata WHERE uid = {$uid})) AS race,
                  bank.onHand,
                  SUM(units.attack + units.superAttack + units.attackMercs + units.defense + 
                  units.superDefense + units.defenseMercs + units.untrained + units.miners + 
                  units.lifers + units.covert + units.superCovert + units.anticovert + 
                  units.superAnticovert) AS armySize
                  FROM users, units, bank, userdata, power, rank
                  WHERE userdata.uid = {$uid} AND users.uid = userdata.uid
                  AND bank.uid = userdata.uid AND units.uid = userdata.uid
                  AND power.uid = userdata.uid AND rank.uid = userdata.uid
                  GROUP BY users.uid LIMIT 1";
        $q = $this->query($query);
        $userStats = mysql_fetch_object($q);
        if ($myStats->covact < .2 * $userStats->covPro) {
            $userStats->armySize = "??????";
        } else {
            $userStats->armySize = number_format($userStats->armySize);
        }

        if ($myStats->covact < .25 * $userStats->covPro) {
            $userStats->onHand = "??????";
        } else {
            $userStats->onHand = number_format($userStats->onHand);
        }

        if ($userStats->cmdrName == "") {
            $userStats->cmdrName = "None";
        }

        return $userStats;
    }

    function getWeapons()
    {
        Debug::printMsg(__CLASS__, __FUNCTION__, "Retrieving Weapons Currently buyable by player");
        $query = "SELECT `isDefense`, `cash_cost`, `unit_cost`, `weaponName`, `weaponPower`, `wid`
                  FROM `armory`
                  WHERE armory.rid = {$_SESSION['raceID']}
                  ORDER BY `weaponPower` ASC LIMIT 100";
        $q = $this->query($query);
        $weapons = ['def' => [], 'atk' => []];
        while ($weaps = mysql_fetch_object($q)) {
            if ($weaps->isDefense == 1) {
                $weapons['def'][] = [
                    'name' => $weaps->weaponName,
                    'power
    
