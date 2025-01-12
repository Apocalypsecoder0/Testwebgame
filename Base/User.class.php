<?php
// Base::User.class.php

class User extends Chive
{
    var $userName = null;
    var $password = null;
    var $access = 0;
    var $loggedIn = false;
    var $userid = null;

    /**
     * Constructor for Chive
     * @param String $name Name of user
     * @param String $password Password of user
     */
    function __construct($userName = "", $password = "DoodleCakes and Rofl Sundae4278vsid")
    {
        parent::__construct();
        if (!empty($userName) || isset($_SESSION['username'])) {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                $this->userName = $_SESSION['username'];
                $this->password = $_SESSION['password'];
                $this->access = $_SESSION['access'];
                $this->userid = $_SESSION['userid'];
                $this->raceID = $_SESSION['raceID'];
            } else {
                $this->userName = $this->clean_sql($userName);
                $this->password = $this->clean_sql($this->salt($password));
            }

            if ($this->isRealUser()) {
                $this->loggedIn = true;
                $_SESSION['username'] = $this->userName;
                $_SESSION['password'] = $this->password;
                $_SESSION['access'] = $this->access;
                $_SESSION['userid'] = $this->userid;
                $_SESSION['raceID'] = $this->raceID;
                $_SESSION['progress'] = $this->progress;

                $time = date("F jS");
                $query = "UPDATE users SET lastLogin=? WHERE uid=? LIMIT 1";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("si", $time, $this->userid);
                if ($stmt->execute()) {
                    Debug::printMsg(__CLASS__, __FUNCTION__, "UserID is:".$this->userid." lastLogin Updated");
                } else {
                    Debug::printMsg(__CLASS__, __FUNCTION__, "UserID is:".$this->userid." lastLogin Not Updated");
                }

                Debug::printMsg(__CLASS__, __FUNCTION__, "UserID is:".$this->userid);
                Debug::printMsg(__CLASS__, __FUNCTION__, "Logged In");
            } else {
                $this->loggedIn = false;
                $this->access = 0;
            }
        } else {
            $this->loggedIn = false;
            $this->access = 0;
        }
        Debug::printMsg(__CLASS__, __FUNCTION__, "Class created with <b>\$userName</b> ".$this->userName);
    }

    /**
     * Checks if the user is authentic
     *
     * @return bool
     */
    function isRealUser()
    {
        $query = "SELECT alevel FROM ".$this->db_prefix."users WHERE email=? AND password=? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $this->userName, $this->password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows) {
            $row = $result->fetch_row();
            $this->access = $row[0];
            Debug::printMsg(__CLASS__, __FUNCTION__, "Validated '$this->userName'");

            $query = "SELECT users.uid, userdata.rid, userdata.progress as prog FROM ".$this->db_prefix."users, userdata WHERE users.email=? AND users.password=? LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $this->userName, $this->password);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_object();

            $this->userid = $row->uid; // SETS USER ID
            $this->raceID = $row->rid;
            $this->progress = $row->prog;
            return true;
        }
        Debug::printMsg(__CLASS__, __FUNCTION__, "Could not validate user '$this->userName'");
        return false;
    }

    function isAllowed($reqAcc)
    {
        return (int)$reqAcc & $this->access;
    }

    /**
     * Logs out user
     */
    function logOut()
    {
        session_unset();
        session_destroy();
    }

    /**
     * Puts a salt on the encryption method
     *
     * @param String $value
     * @return String
     */
    function salt($value)
    {
        return md5(crypt($value, '.u55ybcbC,ufzQu2'));
    }

    /**
     * Adds user to the database
     *
     * @param String $userName
     * @param String $password
     * @param int $access
     * @return bool
     */
    function addUser($userName, $password, $access = 1, $email, $rid, $hpname, $ip)
    {
        $userName = $this->clean_sql($userName);
        $password = $this->clean_sql($this->salt($password));
        $hpname = $this->clean_sql($hpname);
        $email = $this->clean_sql($email);
        $rid = $this->clean_sql($rid);
        $ip = $this->clean_sql($ip);

        $query = "SELECT `uname` FROM `users` WHERE `ip`=? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $ip);
        $stmt->execute();
        $result = $stmt->get_result();
        $chk = $result->fetch_row();

        if (!$chk[0]) {
            if (is_numeric($access)) {
                $query = "INSERT INTO ".$this->db_prefix."users (uname, password, alevel, email, ip) VALUES (?, ?, ?, ?, ?)";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("ssiss", $userName, $password, $access, $email, $ip);
                $stmt->execute();

                $query = "SELECT `uid` FROM `users` WHERE `uname`=? LIMIT 1";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param("s", $userName);
                $stmt->execute();
                $result = $stmt->get_result();
                $x = $result->fetch_object();

                $queries = [
                    "INSERT INTO ".$this->db_prefix."bank (uid, onHand) VALUES (?, 250000)",
                    "INSERT INTO ".$this->db_prefix."units (uid, untrained) VALUES (?, 250)",
                    "INSERT INTO ".$this->db_prefix."technology (uid, unitProd) VALUES (?, 1)",
                    "INSERT INTO ".$this->db_prefix."power (uid) VALUES (?)",
                    "INSERT INTO ".$this->db_prefix."rank (uid) VALUES (?)",
                    "INSERT INTO ".$this->db_prefix."planets (uid, plnt_name, isHome) VALUES (?, ?, 1)",
                    "INSERT INTO ".$this->db_prefix."userdata (uid, rid, actionTurns, link) VALUES (?, ?, 250, ?)"
                ];

                foreach ($queries as $query) {
                    $stmt = $this->db->prepare($query);
                    if (strpos($query, 'plnt_name') !== false) {
                        $stmt->bind_param("iss", $x->uid, $hpname, $this->genUniqueLink());
                    } else {
                        $stmt->bind_param("i", $x->uid);
                    }
                    $stmt->execute();
                }
                echo "Registration Complete";
            }
        } else {
            echo "Your IP is used by another account; only 1 account per IP allowed.";
        }
    }

    function genUniqueLink()
    {
        $time = time();
        $uniqID = "";
        for ($i = 0; $i < strlen($time) / 2; $i++) {
            $uniqID .= chr(rand(ord('a'), ord('z')));
        }
        $uniqID .= $time;
        return $this->clean_sql($uniqID);
    }
}
?>
