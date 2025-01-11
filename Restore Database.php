<?php
$host = 'localhost';
$user = 'username';
$pass = 'password';
$db = 'database_name';
$backup_file = 'backup_file.sql'; // Specify your backup file here

$command = "mysql -h $host -u $user -p$pass $db < $backup_file";
system($command);
echo "Restore completed from: $backup_file";
?>
