<?php
// options.php

// Define some default options
$options = [
    'site_name' => 'My Website',
    'admin_email' => 'admin@example.com',
    'posts_per_page' => 10,
];

// Function to get an option
function get_option($key) {
    global $options;
    return isset($options[$key]) ? $options[$key] : null;
}

// Function to set an option
function set_option($key, $value) {
    global $options;
    $options[$key] = $value;
}

// Example usage
echo get_option('site_name'); // Outputs: My Website
set_option('posts_per_page', 5);
echo get_option('posts_per_page'); // Outputs: 5
?>
