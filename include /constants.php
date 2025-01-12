<?php




// Set Timezone (if server timezone is not correct)
// date_default_timezone_set('America/Chicago');

// TEMPLATES DEFAULT SETTINGS
define('DEFAULT_THEME', 'gow');
define('HTTPS', isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on');
define('PROTOCOL', HTTPS ? 'https://' : 'http://');

// Determine request URL based on server environment
if (PHP_SAPI === 'cli') {
    $requestUrl = str_replace(array(dirname(dirname(__FILE__)), '\\'), array('', '/'), $_SERVER["PHP_SELF"]);

    // Debug mode
    define('HTTP_BASE', str_replace(array('\\', '//'), '/', dirname($_SERVER['SCRIPT_NAME']) . '/'));
    define('HTTP_ROOT', str_replace(basename($_SERVER['SCRIPT_FILENAME']), '', parse_url($requestUrl, PHP_URL_PATH)));
    define('HTTP_FILE', basename($_SERVER['SCRIPT_NAME']));
    define('HTTP_HOST', '127.0.0.1');
    define('HTTP_PATH', PROTOCOL . HTTP_HOST . HTTP_ROOT);
} else {
    define('HTTP_BASE', str_replace(array('\\', '//'), '/', dirname($_SERVER['SCRIPT_NAME']) . '/'));
    define('HTTP_ROOT', str_replace(basename($_SERVER['SCRIPT_FILENAME']), '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
    define('HTTP_FILE', basename($_SERVER['SCRIPT_NAME']));
    define('HTTP_HOST', $_SERVER['HTTP_HOST']);
    define('HTTP_PATH', PROTOCOL . HTTP_HOST . HTTP_ROOT);
}

// Define paths for AJAX chat and cache
if (!defined('AJAX_CHAT_PATH')) {
    define('AJAX_CHAT_PATH', ROOT_PATH . 'chat/');
}

if (!defined('CACHE_PATH')) {
    define('CACHE_PATH', ROOT_PATH . 'cache/');
}

// Combat engine definition
define('COMBAT_ENGINE', 'xnova');

// Default language for the application
define('DEFAULT_LANG', 'de');

// Support for wildcard domains
define('UNIS_WILDCAST', false);

// Fields configuration for lunar bases and terraformers
define('FIELDS_BY_MOONBASIS_LEVEL', 3);
define('FIELDS_BY_TERRAFORMER', 5);

// Time settings for inactivity
define('INACTIVE', 604800); // 7 days
define('INACTIVE_LONG', 2419200); // 28 days

// Shipyard settings
define('FACTOR_CANCEL_SHIPYARD', 0.6); // Fee for canceling queue
define('MIN_FLEET_TIME', 5); // Minimum fleet time

// Phalanx costs
define('PHALANX_DEUTERIUM', 5000); // Cost in deuterium

// Username change time limit
define('USERNAME_CHANGETIME', 604800); // 7 days

// Search and message settings
define('SEARCH_LIMIT', 25); // Max results in search page
define('MESSAGES_PER_PAGE', 10); // Messages per page
define('BANNED_USERS_PER_PAGE', 25); // Banned users per page

// IP comparison settings
define('COMPARE_IP_BLOCKS', 2); // How much IP block will be checked

// Combat settings
define('MAX_ATTACK_ROUNDS', 6); // Max rounds in combats
define('ENABLE_SIMULATOR_LINK', true); // Enable one-click simulation on spy reports

// User session settings
define('SESSION_LIFETIME', 43200); // Max user session in seconds
define('ENABLE_MULTIALERT', true); // Enable multi-alert on sending fleets

// UTF-8 support for names
define('UTF8_SUPPORT', true);

// Spy difficulty settings
define('SPY_DIFFENCE_FACTOR', 1); // Difficulty factor for spying
define('SPY_VIEW_FACTOR', 1); // View factor for spying

// Bash settings
define('BASH_ON', false); // Enable bash
define('BASH_COUNT', 6); // Bash count
define('BASH_TIME', 86400); // Bash time in seconds

// Bash rules on wars
define('BASH_WAR', 0); // 0 = normal, 1 = on war, bash rule inactive

// Fleet log age
define('FLEETLOG_AGE', 86400); // Minimum fleet time must be higher than bash time

// Root IDs
define('ROOT_UNI', 1); // Root universe ID
define('ROOT_USER', 1); // Root user ID

// Authorization levels
define('AUTH_ADM', 3); // Admin level
define('AUTH_OPS', 2); // Operator level
define('AUTH_MOD', 1); // Moderator level
define('AUTH_USR', 0); // User level

// Module definitions
define('MODULE_AMOUNT', 43);
define('MODULE_ALLIANCE', 0);
define('MODULE_BANLIST', 21);
define('MODULE_BANNER', 37);
define('MODULE_BATTLEHALL', 12);
define('MODULE_BUDDYLIST', 6);
define('MODULE_BUILDING', 2);
define('MODULE_CHAT', 7);
define('MODULE_DMEXTRAS', 8);
define('MODULE_FLEET_EVENTS', 10);
define('MODULE_FLEET_TABLE', 9);
define('MODULE_FLEET_TRADER', 38);
define('MODULE_GALAXY', 11);
define('MODULE_IMPERIUM', 15);
define('MODULE_INFORMATION', 14);
define('MODULE_MESSAGES', 16);
define('MODULE_MISSILEATTACK', 40);
define('MODULE_MISSION_ATTACK', 1);
define('MODULE_MISSION_ACS', 42);
define('MODULE_MISSION_COLONY', 35);
define('MODULE_MISSION_DARKMATTER', 31);
define('MODULE_MISSION_DESTROY', 29);
define('MODULE_MISSION_EXPEDITION', 30);
define('MODULE_MISSION_HOLD', 33);
define('MODULE_MISSION_RECYCLE', 32);
define('MODULE_MISSION_SPY', 24);
define('MODULE_MISSION_STATION', 36);
define('MODULE_MISSION_TRANSPORT', 34);
define('MODULE_NOTICE', 17);
define('MODULE_OFFICIER', 18);
define('MODULE_PHALANX', 19);
define('MODULE_PLAYERCARD', 20);
define('MODULE_RECORDS', 22);
define('MODULE_RESEARCH', 3);
define('MODULE_RESSOURCE_LIST', 23);
define('MODULE_SEARCH', 26);
define('MODULE_SHIPYARD_FLEET', 4);
define('MODULE_SHIPYARD_DEFENSIVE', 5);
define('MODULE_SHORTCUTS', 41);
define('MODULE_SIMULATOR', 39);
define('MODULE_STATISTICS', 25);
define('MODULE_SUPPORT', 27);
define('MODULE_TECHTREE', 28);
define('MODULE_TRADER', 13);

// Fleet states
define('FLEET_OUTWARD', 0);
define('FLEET_RETURN', 1);
define('FLEET_HOLD', 2);

// Element flags
define('ELEMENT_BUILD', 1); // ID 0 - 99
define('ELEMENT_TECH', 2); // ID 101 - 199
define('ELEMENT_FLEET', 4); // ID 201 - 399
define('ELEMENT_DEFENSIVE', 8); // ID 401 - 599
define('ELEMENT_OFFICIER', 16); // ID 601 - 699
define('ELEMENT_BONUS', 32); // ID 701 - 799
define('ELEMENT_RACE', 64); // ID 801 - 899
define('ELEMENT_PLANET_RESOURCE', 128); // ID 901 - 949
define('ELEMENT_USER_RESOURCE', 256); // ID 951 - 999

// Additional element flags
define('ELEMENT_PRODUCTION', 65536);
define('ELEMENT_STORAGE', 131072);
define('ELEMENT_ONEPERPLANET', 262144);
define('ELEMENT_BOUNS', 524288);
define('ELEMENT_BUILD_ON_PLANET', 1048576);
define('ELEMENT_BUILD_ON_MOONS', 2097152);
define('ELEMENT_RESOURCE_ON_TF', 4194304);
define('ELEMENT_RESOURCE_ON_FLEET', 8388608);
define('ELEMENT_RESOURCE_ON_STEAL', 16777216);

?>
