<?php

/** TestWebGame
 * Apocalypsecoder0
 *  
 * For the full copyright and license information, please view the LICENSE
 *
 * @package TestWebGame
 * @author Apocalypsecoder0
 * @copyright Apocalypsecoder0
 * @copyright 
 * @licence 
 * @version 0.1.5
 * @link https://github.com/jkroepke/2Moons
 */

// Generate a random token for locking fleet events
$token = getRandomString();

// Get the database connection
$db = Database::get();

// Update fleet events to lock them with the generated token
$fleetResult = $db->update(
    "UPDATE %%FLEETS_EVENT%% 
     SET `lock` = :token 
     WHERE `lock` IS NULL AND `time` <= :time;", 
    array(
        ':time'  => TIMESTAMP, // Current timestamp
        ':token' => $token     // The generated token
    )
);

// Check if any rows were affected (i.e., any fleets were locked)
if ($db->rowCount() !== 0) {
    // Include the FlyingFleetHandler class to manage fleet operations
    require 'includes/classes/class.FlyingFleetHandler.php';
    
    // Create an instance of FlyingFleetHandler
    $fleetObj = new FlyingFleetHandler();
    
    // Set the token for the fleet object
    $fleetObj->setToken($token);
    
    // Execute the fleet handling process
    $fleetObj->run();

    // Unlock the fleet events by setting the lock back to NULL
    $db->update(
        "UPDATE %%FLEETS_EVENT%% 
         SET `lock` = NULL 
         WHERE `lock` = :token;", 
        array(
            ':token' => $token // Use the same token to unlock
        )
    );
}
