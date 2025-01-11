<?php
// mothership.php

// Include configuration and necessary files
require_once 'config.php'; // Configuration settings
require_once 'database.php'; // Database connection
require_once 'router.php'; // Routing logic

// Start the session
session_start();

// Function to handle requests
function handleRequest() {
    // Get the requested URL path
    $requestUri = $_SERVER['REQUEST_URI'];
    
    // Route the request to the appropriate handler
    $response = routeRequest($requestUri);
    
    // Output the response
    echo $response;
}

// Call the request handler
handleRequest();
?>
