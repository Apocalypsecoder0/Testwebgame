
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
