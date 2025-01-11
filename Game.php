<?php
session_start();
include 'src/db.mysql';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Game logic here
?>
