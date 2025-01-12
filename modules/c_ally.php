<?php 
include("../config.php");

$pagegen = new page_gen();
$pagegen->round_to = 4;
$pagegen->start();
$s = new Game();
$s->updatePower($_SESSION['userid']); 

$id = $_GET['id'] ?? null;
$atype = $_GET['atype'] ?? null;

if ($id && $atype != "Send") {
    $query = "SELECT `uname` FROM `users` WHERE uid = ? LIMIT 1";
    $stmt = $s->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_object();
    $name = $data->uname;
}

if ($atype == "Send") {
    $subject = $_REQUEST['subject'];
    $message = $_REQUEST['message'];
    $url = $_REQUEST['url'];
    $allow = $_REQUEST['allow'] ? 1 : 0;

    if ($s->create_allliance($id, $subject, $message, $url, $allow)) {
        echo ",Thank you";
    } else {
        echo ",If problem persists, contact Admin";
    }
}
?>

<form action="javascript:void(0)" onSubmit="submit.value='Sending Message'; submit.disabled=true; sendData('c_ally','post',userID.value,'Send');">
    <center>
        <input type="hidden" id="userID" name="userID" value="<?= htmlspecialchars($id); ?>">
        <table width="100%" border="0">
            <tr>
                <td align="left" valign="top">Alliance Name:</td>
                <td colspan="3" align="left" valign="top"><input type="text" name="subject" required></td>
            </tr>
            <tr>
                <td align="left" valign="top">Alliance Description:</td>
                <td colspan="3" align="left" valign="top">
                    <textarea name="message" cols="100" rows="20" wrap="virtual" required></textarea>
                </td>
            </tr>
            <tr>
                <td><div align="center">Alliance URL: http:// </div></td>
                <td><input name="url" type="text" id="url" value="http://"></td>
            </tr>
            <tr>
                <td><div align="center">Don't Allow New Members?</div></td>
                <td><input name="allow" type="checkbox" id="allow" value="1"></td>
            </tr>
        </table>
        <input type="submit" name="submit" id="submit" value="Create Alliance">
    </center>
</form>

<?php
echo "Query Count: " . $s->queryCount . "<br>";
$pagegen->stop();
print('Page generation time: ' . $pagegen->gen());
?>
