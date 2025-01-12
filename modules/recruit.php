<?include_once("../config.php");
$pagegen = new page_gen();
$pagegen->round_to = 4;
$pagegen->start();
$s = new Game();
Function Definition:
function getRecruiter($link) {
    $q = "SELECT * FROM `userdata`";
    $v = mysql_query($q);
    while ($row = mysql_fetch_array($v)) {
        $q2 = "SELECT * FROM `userdata` WHERE `link` = '".$row['link']."'";
        $v2 = mysql_query($q2);
        $temp = mysql_fetch_array($v2);
        $r = "SELECT * FROM `recruit_ips` WHERE `uid` = '".$temp['uid']."' AND `ip` = '".$_SERVER['REMOTE_ADDR']."'";
        $r2 = mysql_query($r);
        $count = mysql_num_rows($r2);
        if ($count <= 0) {
            $q4 = "INSERT INTO `recruit_ips` (`recruitID`,`uid`,`ip`) VALUES ('','".$temp['uid']."','".$_SERVER['REMOTE_ADDR']."');";
            $q3 = "UPDATE `units` SET `untrained` = `untrained` + 4 WHERE `uid` = '".$temp['uid']."'";
            mysql_query($q3);
            mysql_query($q4);
            return $temp;
        } else {
            return "Error";
        }
    }
}
Recruitment Handling:
$recruit = $_GET['id'];
$recruiter = getRecruiter($recruit);
if ($recruiter == "Error") {
    // header("Location: index.php?strErr=user with that recruit link does not exist!");
}
$msg = $_GET['strErr'];
HTML Output:
<html>
<head>
</head>
<body>
<center>
<table width=100% cellspacing=1 cellpadding=5>
<tr>
<div align="left">
    <?php print("<center><b><i>".$msg."</i></b></center>"); ?>
    <p><br>
    <?if($recruiter=="Error") {
        // header("Location: index.php?strErr=user with that recruit link does not exist!");
    ?>
        <strong>Welcome To <?=$subs['{TITLE}'] ?> NewCommer! </strong></p>
        <p>It is a pleasure to have you here. Although I regret to inform you <br>
        That your IP has already clicked this link.<br>
        How about you join up, if not already, get others to click your link.<br>
        <a href="index.php">Join Now</a><br>
        </p>
    <?} else { ?>
        <strong>Welcome To <?=$subs['{TITLE}'] ?> NewCommer! </strong></p>
        <p>It is a pleasure to have you here. By clicking this enlistment link you have recruited<br>
        4 troops into the armies of <?php print($recruiter['uname']); ?>.<br>
        If you would like to continue to form your empire click the link below.<br>
        <a href="index.php">Join Now</a><br>
        </p>
    <?} ?>
</div>
</td>
</tr>
</table><br>
<?echo "Query Count: ".$s->queryCount."<br>"; $pagegen->stop(); print('page generation time: ' . $pagegen->gen()); ?>
