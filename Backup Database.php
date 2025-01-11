<?php
$host = 'localhost';
$user = 'username';
$pass = 'password';
$db = 'database_name';
$backup_file = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

$command = "mysqldump --opt -h $host -u $user -p$pass $db > $backup_file";
system($command);
echo "Backup completed: $backup_file";
?>
