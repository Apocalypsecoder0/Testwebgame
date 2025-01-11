<?php
// Set error reporting level
error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 0); // Do not display errors to users
ini_set('log_errors', 1); // Log errors to a file
ini_set('error_log', 'error_log.txt'); // Specify the error log file

// Custom error handler function
function customError($errno, $errstr, $errfile, $errline) {
    // Create a custom error message
    $errorMessage = "Error: [$errno] $errstr - Error on line $errline in file $errfile" . PHP_EOL;

    // Log the error message to the specified log file
    error_log($errorMessage, 3, 'error_log.txt');

    // Display a user-friendly message
    echo "<div style='color: red;'><strong>Oops! Something went wrong. Please try again later.</strong></div>";
}

// Set the custom error handler
set_error_handler("customError");

// Example of triggering an error
// Uncomment the line below to test the error handling
// echo $undefined_variable; // This will trigger a notice error
?>
