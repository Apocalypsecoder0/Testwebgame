<?php
include_once("config.php");
$s = new Game();

if (isset($_GET['logout'])) {
    User::logOut();
}

if (isset($_POST['submit']) && $_POST['submit'] === "Login") {
    $s = new User($_POST['user'], $_POST['pass']);
}

if (!$s->loggedIn || isset($_GET['logout'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codename: Lantea</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="js/main.js"></script>
    <script src="js/auto.js"></script>
    <script src="js/train.js"></script>
    <script src="js/images.js"></script>
    <script src="js/bbfix.js"></script>
</head>
<body background="images/stars.jpg" onload="mainUpdate('login','Login'); MM_preloadImages('images/galaxy1-2.jpg','images/galaxy2-2.jpg','images/galaxy3-2.jpg'); autoclear(); bb_init('divBody', false);">
    <div id="divBody">
        <table>
            <tr>
                <td colspan="2" align="left">
                    <a href="javascript:void(0)" onclick="mainUpdate('login','Login'); return false">
                        <img src="images/galaxy1.jpg" width="373" height="188" onmouseover="MM_swapImage('Image12','','images/galaxy1-2.jpg',1)" onmouseout="MM_swapImgRestore()">
                    </a>
                </td>
                <td colspan="2"></td>
                <td align="center">
                    <a href="javascript:void(0)" onclick="mainUpdate('register','Register To Play'); return false">
                        <img src="images/galaxy2.jpg" width="202" height="78" onmouseover="MM_swapImage('Image11','','images/galaxy2-2.jpg',1)" onmouseout="MM_swapImgRestore()">
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="up2date"></div>
                </td>
                <td colspan="3" align="center">
                    <h1>Codename: Lantea</h1>
                    <h2><div id="rollover"></div></h2>
                    <?php
                    if (isset($_POST['submit']) && $_POST['submit'] === "Register") {
                        $number = $_POST['number'];
                        if (md5($number) !== $_SESSION['image_value']) {
                            echo 'Validation string not valid! Please try again!<br>';
                        } else {
                            $s->addUser($_POST['user'], $_POST['pass'], 1, $_POST['email'], $_POST['rid'], $_POST['hpname'], $_SERVER["REMOTE_ADDR"]);
                        }
                    }
                    ?>
                    <div id="mainDisplay"></div>
                    <span>Graphics Done by Apocalypsecoder0</span><br>
                    <a href="http://www.icra.org/sitelabel/" target="_blank">
                        <img src="images/icra.gif">
                    </a>
                </td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <a href="javascript:void(0)" onclick="mainUpdate('updates','Updates'); return false">
                        <img src="images/galaxy3.JPG" width="366" height="126" onmouseover="MM_swapImage('Image13','','images/galaxy3-2.jpg',1)" onmouseout="MM_swapImgRestore()">
                    </a>
                </td>
                <td colspan="3"></td>
            </tr>
        </table>
    </div>
</body>
</html>
<?php
} else {
    showPage();
}
?>
