
CREATE TABLE users (
    userid INT PRIMARY KEY,
    balance DECIMAL(10, 2) NOT NULL
);
CREATE TABLE training_costs (
    attackCost DECIMAL(10, 2),
    superAttackCost DECIMAL(10, 2),
    defenseCost DECIMAL(10, 2),
    superDefenseCost DECIMAL(10, 2),
    covertCost DECIMAL(10, 2),
    superCovertCost DECIMAL(10, 2),
    anticovertCost DECIMAL(10, 2),
    superAnticovertCost DECIMAL(10, 2)
);
CREATE TABLE game_actions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action_type ENUM('attack', 'raid', 'spy') NOT NULL,
    target_id INT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
);
MySQL Table Structures
users
CREATE TABLE `users` (
    `uid` INT PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(255),
    `password` VARCHAR(255),
    `onHand` DECIMAL(10, 2)
);
weapons
CREATE TABLE `weapons` (
    `wid` INT PRIMARY KEY AUTO_INCREMENT,
    `uid` INT,
    `strength` INT,
    `quanity` INT,
    FOREIGN KEY (uid) REFERENCES users(uid)
);
armory
CREATE TABLE `armory` (
    `wid` INT PRIMARY KEY,
    `weaponName` VARCHAR(255),
    `weaponPower` INT,
    `cash_cost` DECIMAL(10, 2),
    `isDefense` BOOLEAN
);
bank
CREATE TABLE `bank` (
    `uid` INT PRIMARY KEY,
    `onHand` DECIMAL(10, 2),
    FOREIGN KEY (uid) REFERENCES users(uid)
);
Example Queries
Repair Weapon
UPDATE `weapons` 
SET `strength` = (SELECT weaponPower FROM armory WHERE wid = $id) 
WHERE uid = {$_SESSION['userid']} AND wid = $id;
Sell Weapons
SELECT armory.wid, armory.weaponName, weapons.strength, armory.weaponPower, 
       armory.cash_cost, armory.isDefense, weapons.quanity
FROM `armory`, `weapons`, `userdata`
WHERE weapons.uid = {$_SESSION['userid']} AND weapons.wid = $wid
  AND armory.wid = weapons.wid
  AND userdata.uid = weapons.uid
  AND armory.rid = userdata.rid
LIMIT 1000;

UPDATE `weapons` 
SET `quanity` = `quanity` - '$id' 
WHERE `uid` = {$_SESSION['userid']} AND `wid` = $wid LIMIT 1;

UPDATE `bank` 
SET `onHand` = `onHand` + '$costtosell' 
WHERE `uid` = {$_SESSION['userid']} LIMIT 1;

DELETE FROM `weapons` 
WHERE `uid` = {$_SESSION['userid']} AND `wid` = $wid AND `quanity` = '0' LIMIT 1;
Buy Weapons
INSERT INTO `weapons` (uid, strength, quanity) 
VALUES ({$_SESSION['userid']}, $strength, $quantity);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    onHand DECIMAL(10, 2) DEFAULT 0,
    inBank DECIMAL(10, 2) DEFAULT 0,
    capacity DECIMAL(10, 2) DEFAULT 1000
);
-- Create database
CREATE DATABASE IF NOT EXISTS game_db;

USE game_db;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    uid INT AUTO_INCREMENT PRIMARY KEY,
    uname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create alliances table
CREATE TABLE IF NOT EXISTS alliances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    url VARCHAR(255),
    allow_new_members TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(uid) ON DELETE CASCADE
);
UPDATE users 
SET power = power + ? 
WHERE id = ?;
CREATE TABLE action_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action_type ENUM('attack', 'raid', 'spy', 'sab') NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);-- Delete a specific message by ID
DELETE FROM messages WHERE mid = ?;

-- Delete messages from a specific user to the current user
DELETE FROM messages WHERE fromUID = ? AND toUID = ?;

-- View messages (select all messages)
SELECT * FROM messages WHERE toUID = ?;  -- Assuming you want messages for the current user

-- Count the number of queries executed (not directly in SQL)
-- This would typically be handled in application logic, not SQL.
CREATE TABLE military_effectiveness (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    mil_atk INT NOT NULL,
    mil_atk_rank INT NOT NULL,
    mil_def INT NOT NULL,
    mil_def_rank INT NOT NULL,
    mil_cov INT NOT NULL,
    mil_cov_rank INT NOT NULL,
    mil_anti INT NOT NULL,
    mil_anti_rank INT NOT NULL,
    mil_total INT NOT NULL,
    mil_rank INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) -- Assuming there's a users table
);
CREATE TABLE personnel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    attackName VARCHAR(255),
    attackCount INT DEFAULT 0,
    superAttackName VARCHAR(255),
    superAttackCount INT DEFAULT 0,
    attackMercName VARCHAR(255),
    attackMercCount INT DEFAULT 0,
    defenseName VARCHAR(255),
    defenseCount INT DEFAULT 0,
    superDefenseName VARCHAR(255),
    superDefenseCount INT DEFAULT 0,
    defenseMercName VARCHAR(255),
    defenseMercCount INT DEFAULT 0,
    uuCount INT DEFAULT 0,
    minerCount INT DEFAULT 0,
    liferCount INT DEFAULT 0,
    covertName VARCHAR(255),
    covertCount INT DEFAULT 0,
    superCovertName VARCHAR(255),
    superCovertCount INT DEFAULT 0,
    anticovertName VARCHAR(255),
    anticovertCount INT DEFAULT 0,
    superAnticovertName VARCHAR(255),
    superAnticovertCount INT DEFAULT 0,
    ttlarmysize INT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id) -- Assuming there's a users table
);
-- Create a database
CREATE DATABASE progress_db;

-- Use the created database
USE progress_db;

-- Create a table to store progress data
CREATE TABLE progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    done INT NOT NULL,
    total INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Example insert statement
INSERT INTO progress (user_id, done, total) VALUES (1, 50, 200);
SELECT 
    u.id AS uid,
    u.name,
    r.rank,
    r.army,
    u.race,
    u.cash,
    r.allyid
FROM 
    users u
JOIN 
    rankings r ON u.id = r.userid
WHERE 
    r.rank != 0
ORDER BY 
    r.rank
LIMIT 
    :offset, :limit;  -- Use pagination parameters for offset and limit
Get Ally Information:
SELECT 
    allyname 
FROM 
    allies 
WHERE 
    id = :allyid;
function getRecruiter($link, $mysqli) {
    $q = "SELECT * FROM `userdata`";
    $result = $mysqli->query($q);

    while ($row = $result->fetch_assoc()) {
        $q2 = "SELECT * FROM `userdata` WHERE `link` = '".$mysqli->real_escape_string($row['link'])."'";
        $v2 = $mysqli->query($q2);
        $temp = $v2->fetch_assoc();

        $r = "SELECT * FROM `recruit_ips` WHERE `uid` = '".$mysqli->real_escape_string($temp['uid'])."' AND `ip` = '".$_SERVER['REMOTE_ADDR']."'";
        $r2 = $mysqli->query($r);
        $count = $r2->num_rows;

        if ($count <= 0) {
            $q4 = "INSERT INTO `recruit_ips` (`recruitID`, `uid`, `ip`) VALUES (NULL, '".$mysqli->real_escape_string($temp['uid'])."', '".$_SERVER['REMOTE_ADDR']."')";
            $q3 = "UPDATE `units` SET `untrained` = `untrained` + 4 WHERE `uid` = '".$mysqli->real_escape_string($temp['uid'])."'";
            $mysqli->query($q3);
            $mysqli->query($q4);
            return $temp;
        } else {
            return "Error";
        }
    }
}

$mysqli = new mysqli("host", "user", "password", "database");
$recruiter = getRecruiter($_GET['id'], $mysqli);
-- Query to get the username of a user by their ID
SELECT `uname` FROM `users` WHERE uid = 1 LIMIT 1;

-- Query to send a message (assuming you have a messages table)
INSERT INTO `messages` (sender_id, receiver_id, subject, message, sent_at) 
VALUES (1, 2, 'Subject Here', 'Message content here', NOW());
CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    player_id INT NOT NULL,
    game_state JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- 1. Select User
SELECT * FROM users WHERE userid = :userid;

-- 2. Update User Power
UPDATE users SET power = :new_power WHERE userid = :userid;

-- 3. Buy Technology
INSERT INTO user_technologies (userid, tech_id, type) VALUES (:userid, :tech_id, :type);

-- 4. Get Technology Data
SELECT * FROM technologies WHERE userid = :userid;

-- 5. Get Level Data
SELECT * FROM levels WHERE ascend = :ascend;

-- 6. Calculate Upgrade Costs
SELECT (ascend * 5000000 * unitProd) AS upgrade_cost FROM technologies WHERE userid = :userid;

-- 7. Update Technology Levels
UPDATE technologies SET unitProd = unitProd + :increment WHERE userid = :userid;

-- 8. Count Queries
SELECT COUNT(*) AS query_count FROM queries WHERE userid = :userid;
-- 1. Update User Power
UPDATE users 
SET power = power + ? 
WHERE userid = ?;

-- 2. Untrain Units
UPDATE units 
SET quantity = quantity - ? 
WHERE userid = ? AND unit_type = 'attacker';

UPDATE units 
SET quantity = quantity - ? 
WHERE userid = ? AND unit_type = 'defender';

UPDATE units 
SET quantity = quantity - ? 
WHERE userid = ? AND unit_type = 'cover';

UPDATE units 
SET quantity = quantity - ? 
WHERE userid = ? AND unit_type = 'anti';

UPDATE units 
SET quantity = quantity - ? 
WHERE userid = ? AND unit_type = 'miner';

-- 3. Train Units
INSERT INTO units (userid, unit_type, quantity) 
VALUES (?, 'attacker', ?), (?, 'defender', ?), (?, 'cover', ?), (?, 'anti', ?), (?, 'miner', ?)
ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity);

-- 4. Check User Login Status
SELECT * FROM users 
WHERE userid = ? AND logged_in = 1;

-- 5. Count Queries
INSERT INTO query_log (userid, query_count) 
VALUES (?, ?) 
ON DUPLICATE KEY UPDATE query_count = query_count + 1;

-- 1. User Information Retrieval
SELECT userName, cmdrName, cmdrID, race, rank, armySize, onHand 
FROM users 
WHERE userID = ?;  -- Replace ? with the actual user ID

-- 2. Officers Retrieval
SELECT uid, name, race, rank 
FROM officers 
WHERE userID = ?;  -- Replace ? with the actual user ID

-- 3. Update User Power
UPDATE users 
SET power = ? 
WHERE userID = ?;  -- Replace ? with the new power value and user ID

-- 4. Count Query
SELECT COUNT(*) AS officerCount 
FROM officers 
WHERE userID = ?;  -- Replace ? with the actual user ID
