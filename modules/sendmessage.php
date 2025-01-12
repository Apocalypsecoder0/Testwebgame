 a concise PHP code snippet based on your provided code:
<?php 
include("../config.php");

$pagegen = new page_gen();
$pagegen->round_to = 4;
$pagegen->start();
$s = new Game();
$s->updatePower($_SESSION['userid']); 

if (isset($_GET['id']) && $_GET['atype'] != "Send") {
    $query = "SELECT `uname` FROM `users` WHERE uid=" . intval($_GET['id']) . " LIMIT 1";
    $q = $s->query($query);
    $data = mysql_fetch_object($q);
    $name = $data->uname;
    $id = $_GET['id'];
}

if ($_REQUEST['atype'] == "Send") {
    if ($s->sendMessage($_GET['id'], $_REQUEST['subject'], $_REQUEST['message'])) {
        echo "Message Sent to " . htmlspecialchars($_REQUEST['toUser']);
    } else {
        echo "Error Sending Message. Contact Admin.";
    }
}
?>

<form action="javascript:void(0)" onSubmit="submit.value='Sending Message'; submit.disabled=true; sendData('sendmessage','post',userID.value,'Send');">
    <center>
        Sending to: <input type="text" disabled="disabled" name="toUser" id="toUser" value="<?= htmlspecialchars($name); ?>" onkeyup="autocomplete(this,event);">
        <input type="hidden" id="userID" name="userID" value="<?= intval($id); ?>">
        <table width="100%" border="0">
            <tr>
                <td align="left" valign="top">Subject:</td>
                <td colspan="3" align="left" valign="top"><input type="text" name="subject"></td>
            </tr>
            <tr>
                <td align="left" valign="top">Message:</td>
                <td colspan="3" align="left" valign="top">
                    <textarea name="message" cols="100" rows="20" wrap="virtual"></textarea>
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" id="submit" value="Send Message">
    </center>
</form>

<?php
echo "Query Count: " . $s->queryCount . "<br>";
$pagegen->stop();
print('Page generation time: ' . $pagegen->gen());
?>
