<?php
// anti_spy.php

// Include necessary files
require_once 'config.php'; // Configuration settings
require_once 'database.php'; // Database connection

// Function to log suspicious activity
function logSuspiciousActivity($userId, $activity) {
    global $db;
    $query = "INSERT INTO activity_logs (user_id, activity, timestamp) VALUES (?, ?, NOW())";
    $stmt = $db->prepare($query);
    $stmt->execute([$userId, $activity]);
}

// Function to block malicious IPs
function blockMaliciousIP($ipAddress) {
    global $db;
    $query = "INSERT INTO blocked_ips (ip_address, timestamp) VALUES (?, NOW())";
    $stmt = $db->prepare($query);
    $stmt->execute([$ipAddress]);
}

// Function to check if an IP is blocked
function isIPBlocked($ipAddress) {
    global $db;
    $query = "SELECT COUNT(*) FROM blocked_ips WHERE ip_address = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$ipAddress]);
    return $stmt->fetchColumn() > 0;
}

// Function to monitor user activity
function monitorUserActivity($userId, $action) {
    // Example of monitoring specific actions
    if ($action === 'suspicious_login_attempt') {
        logSuspiciousActivity($userId, 'Suspicious login attempt detected.');
    }
}

// Example usage
$userId = 1; // Example user ID
$ipAddress = $_SERVER['REMOTE_ADDR']; // Get the user's IP address

// Check if the user's IP is blocked
if (isIPBlocked($ipAddress)) {
    die("Access denied. Your IP has been blocked.");
}

// Monitor user activity (example action)
monitorUserActivity($userId, 'suspicious_login_attempt');

// Log other activities as needed
logSuspiciousActivity($userId, 'User accessed the dashboard.');
?>
