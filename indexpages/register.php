<?php
include_once("../config.php");
$s = new Game();

if (!$s->loggedIn) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize and validate input
        $username = htmlspecialchars(trim($_POST['user']));
        $hpname = htmlspecialchars(trim($_POST['hpname']));
        $password = password_hash(trim($_POST['pass']), PASSWORD_DEFAULT);
        $email = htmlspecialchars(trim($_POST['email']));
        $raceId = intval($_POST['rid']);
        $captcha = htmlspecialchars(trim($_POST['number']));

        // Validate captcha (implement your own captcha validation logic)
        if (validateCaptcha($captcha)) {
            // MySQL connection
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO users (username, hpname, password, email, race_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $username, $hpname, $password, $email, $raceId);

            // Execute and check
            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close connections
            $stmt->close();
            $conn->close();
        } else {
            echo "Invalid captcha.";
        }
    }
?>
<form method="post" action="index.php">
    <table border="0">
        <tr>
            <td align="center" valign="middle"><font color="black">Username:</font></td>
        </tr>
        <tr>
            <td align="center" valign="middle"><input type="text" name="user" required /></td>
        </tr>
        <tr>
            <td align="center" valign="middle"><font color="black">Home Planet Name:</font></td>
        </tr>
        <tr>
            <td align="center" valign="middle"><input type="text" name="hpname" required /></td>
        </tr>
        <tr>
            <td align="center" valign="middle"><font color="black">Password</font></td>
        </tr>
        <tr>
            <td align="center" valign="middle"><input type="password" name="pass" required /></td>
        </tr>
        <tr>
            <td align="center" valign="middle"><font color="black">E-mail Address:</font></td>
        </tr>
        <tr>
            <td align="center" valign="middle"><input type="email" name="email" required /></td>
        </tr>
        <tr>
            <td align="center" valign="middle"><font color="black">Race</font></td>
        </tr>
        <tr>
            <td align="center" valign="middle">
                <select name="rid" required>
                    <?php
                    $list = $s->getRaces();
                    foreach ($list as $race) {
                        echo "<option value='{$race["id"]}'>{$race["name"]}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <strong><font>Please enter the string shown in the image in the form.<br> The possible characters are letters from A to Z in capitalized form and the numbers from 0 to 9.</font></strong>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2"><input name="number" type="text" id="number" required></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><img src="image.php?mt=<?= microtime(); ?>"></td>
        </tr>
        <tr>
            <td align="center" valign="middle"><input type="submit" name="submit" value="Register" /></td>
        </tr>
    </table>
</form>
<?php
} else {
    echo "You are logged in. You can register another account; it's against the rules.";
}
?>
