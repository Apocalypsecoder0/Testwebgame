<?php
include 'src/db.mysql';

$sql = "CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

$pdo->exec($sql);
echo "Database and tables created successfully.";
?>
