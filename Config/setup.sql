-- Create the necessary tables for the game database

CREATE DATABASE IF NOT EXISTS game_db;
USE game_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    uid INT AUTO_INCREMENT PRIMARY KEY,
    uname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    onHand DECIMAL(10, 2) DEFAULT 0,
    inBank DECIMAL(10, 2) DEFAULT 0,
    capacity DECIMAL(10, 2) DEFAULT 1000
);

-- Training costs table
CREATE TABLE IF NOT EXISTS training_costs (
    attackCost DECIMAL(10, 2),
    superAttackCost DECIMAL(10, 2),
    defenseCost DECIMAL(10, 2),
    superDefenseCost DECIMAL(10, 2),
    covertCost DECIMAL(10, 2),
    superCovertCost DECIMAL(10, 2),
    anticovertCost DECIMAL(10, 2),
    superAnticovertCost DECIMAL(10, 2)
);

-- Weapons table
CREATE TABLE IF NOT EXISTS weapons (
    wid INT PRIMARY KEY AUTO_INCREMENT,
    uid INT,
    strength INT,
    quantity INT,
    FOREIGN KEY (uid) REFERENCES users(uid)
);

-- Armory table
CREATE TABLE IF NOT EXISTS armory (
    wid INT PRIMARY KEY,
    weaponName VARCHAR(255),
    weaponPower INT,
    cash_cost DECIMAL(10, 2),
    isDefense BOOLEAN
);

-- Bank table
CREATE TABLE IF NOT EXISTS bank (
    uid INT PRIMARY KEY,
    onHand DECIMAL(10, 2),
    FOREIGN KEY (uid) REFERENCES users(uid)
);

-- Game actions table
CREATE TABLE IF NOT EXISTS game_actions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action_type ENUM('attack', 'raid', 'spy') NOT NULL,
    target_id INT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Action logs table
CREATE TABLE IF NOT EXISTS action_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action_type ENUM('attack', 'raid', 'spy', 'sab') NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(uid)
);

-- Military effectiveness table
CREATE TABLE IF NOT EXISTS military_effectiveness (
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
    FOREIGN KEY (user_id) REFERENCES users(uid)
);

-- Personnel table
CREATE TABLE IF NOT EXISTS personnel (
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
    FOREIGN KEY (user_id) REFERENCES users(uid)
);

-- Progress table
CREATE TABLE IF NOT EXISTS progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    done INT NOT NULL,
    total INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Alliances table
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
