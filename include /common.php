<?php

/**
 *  2Moons 
 *   by Jan-Otto Kröpke 2009-2016
 *
 * For the full copyright and license information, please view the LICENSE
 *
 * @package 2Moons
 * @author Jan-Otto Kröpke <slaver7@gmail.com>
 * @copyright 2009 Lucky
 * @copyright 2016 Jan-Otto Kröpke <slaver7@gmail.com>
 * @licence MIT
 * @version 1.8.0
 * @link https://github.com/jkroepke/2Moons
 */

// Prevent external modification of the GLOBALS array
if (isset($_POST['GLOBALS']) || isset($_GET['GLOBALS'])) {
    exit('You cannot set the GLOBALS-array from outside the script.');
}

// Load Composer autoloader
$composerAutoloader = __DIR__ . '/../vendor/autoload.php';
if (file_exists($composerAutoloader)) {
    require $composerAutoloader;
}

// Set internal encoding to UTF-8 if the function exists
if (function_exists('mb_internal_encoding')) {
    mb_internal_encoding("UTF-8");
}

// Configure error handling and user abort settings
ignore_user_abort(true);
error_reporting(E_ALL & ~E_STRICT);
date_default_timezone_set(@date_default_timezone_get());
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=UTF-8');
define('TIMESTAMP', time());

// Load constants and error logging
require 'includes/constants.php';
ini_set('log_errors', 'On');
ini_set('error_log', 'includes/error.log');

// Load general functions and set exception/error handlers
require 'includes/GeneralFunctions.php';
set_exception_handler('exceptionHandler');
set_error_handler('errorHandler');

// Load necessary classes
require 'includes/classes/ArrayUtil.class.php';
require 'includes/classes/Cache.class.php';
require 'includes/classes/Database.class.php';
require 'includes/classes/Config.class.php';
require 'includes/classes/class.FleetFunctions.php';
require 'includes/classes/HTTP.class.php';
require 'includes/classes/Language.class.php';
require 'includes/classes/PlayerUtil.class.php';
require 'includes/classes/Session.class.php';
require 'includes/classes/Universe.class.php';
require 'includes/classes/class.theme.php';
require 'includes/classes/class.template.php';

// Set P3P header for third-party cookies
HTTP::sendHeader('P3P', 'CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
define('AJAX_REQUEST', HTTP::_GP('ajax', 0));

// Initialize theme
$THEME = new Theme();

// Check installation mode
if (MODE === 'INSTALL') {
    return;
}

// Redirect to installation if config file is missing or empty
if (!file_exists('includes/config.php') || filesize('includes/config.php') === 0) {
    HTTP::redirectTo('install/index.php');
}

// Check database version
try {
    $sql = "SELECT dbVersion FROM %%SYSTEM%%;";
    $dbVersion = Database::get()->selectSingle($sql, [], 'dbVersion');
    $dbNeedsUpgrade = $dbVersion < DB_VERSION_REQUIRED;
} catch (Exception $e) {
    $dbNeedsUpgrade = true;
}

// Redirect to upgrade if needed
if ($dbNeedsUpgrade) {
    HTTP::redirectTo('install/index.php?mode=upgrade');
}

// Handle old database version
if (defined('DATABASE_VERSION') && DATABASE_VERSION === 'OLD') {
    require 'includes/classes/Database_BC.class.php';
    $DATABASE = new Database_BC();
    
    $dbTableNames = Database::get()->getDbTableNames();
    $dbTableNames = array_combine($dbTableNames['keys'], $dbTableNames['names']);
    
    foreach ($dbTableNames as $dbAlias => $dbName) {
        define(substr($dbAlias, 2, -2), $dbName);
    }
}

// Load configuration and set timezone
$config = Config::get();
date_default_timezone_set($config->timezone);

// Handle different modes
if (MODE === 'INGAME' || MODE === 'ADMIN' || MODE === 'CRON') {
    $session = Session::load();

    // Validate session
    if (!$session->isValidSession()) {
        $session->delete();
        HTTP::redirectTo('index.php?code=3');
    }

    require 'includes/vars.php';
    require 'includes/classes/class.BuildFunctions.php';
    require 'includes/classes/class.PlanetRessUpdate.php';

    // Load fleet handler if not an AJAX request and in-game mode
    if (!AJAX_REQUEST && MODE === 'INGAME' && isModuleAvailable(MODULE_FLEET_EVENTS)) {
        require('includes/FleetHandler.php');
    }

    $db = Database::get();

    // Fetch user data and message count
    $sql = "SELECT user.*, COUNT(message.message_id) as messages
            FROM %%USERS%% as user
            LEFT JOIN %%MESSAGES%% as message ON message.message_owner = user.id AND message.message_unread = :unread
            WHERE user.id = :userId
            GROUP BY message.message_owner;";
    
    $USER = $db->selectSingle($sql, [
        ':unread' => 1,
        ':userId' => $session->userId
    ]);

    // Redirect if user data is empty
    if (empty($USER)) {
        HTTP::redirectTo('index.php?code=3');
    }

    // Initialize language and theme
    $LNG = new Language($USER['lang']);
    $LNG->includeData(['L18N', 'INGAME', 'TECH', 'CUSTOM']);
    $THEME->setUserTheme($USER['dpath']);

    // Check if the game is closed
    if ($config->game_disable == 0 && $USER['authlevel'] == AUTH_USR) {
        ShowErrorPage::printError($LNG['sys_closed_game'] . '<br><br>' . $config->close_reason, false);
    }

    // Check if the user is banned
    if ($USER['bana'] == 1) {
        ShowErrorPage::printError("<font size=\"6px\">" . $LNG['css_account_banned_message'] . "</font><br><br>" . sprintf($LNG['css_account_banned_expire'], _date($LNG['php_tdformat'], $USER['banaday'], $USER['timezone'])) . "<br><br>" . $LNG['css_goto_homeside'], false);
    }

    // Handle in-game mode
    if (MODE === 'INGAME') {
        $universeAmount = count(Universe::availableUniverses());
        if (Universe::current() != $USER['universe'] && $universeAmount > 1) {
            HTTP::redirectToUniverse($USER['universe']);
        }

        $session->selectActivePlanet();

        // Fetch planet data
        $sql = "SELECT * FROM %%PLANETS%% WHERE id = :planetId;";
        $PLANET = $db->selectSingle($sql, [':planetId' => $session->planetId]);

        // Redirect or throw an error if the planet does not exist
        if (empty($PLANET)) {
            $sql = "SELECT * FROM %%PLANETS%% WHERE id = :planetId;";
            $PLANET = $db->selectSingle($sql, [':planetId' => $USER['id_planet']]);
            
            if (empty($PLANET)) {
                throw new Exception("Main Planet does not exist!");
            } else {
                $session->planetId = $USER['id_planet'];
            }
        }

        // Set user factors and planets
        $USER['factor'] = getFactors($USER);
        $USER['PLANETS'] = getPlanets($USER);
    } elseif (MODE === 'ADMIN') {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $USER['rights'] = unserialize($USER['rights']);
        $LNG->includeData(['ADMIN', 'CUSTOM']);
    }
} elseif (MODE === 'LOGIN') {
    $LNG = new Language();
    $LNG->getUserAgentLanguage();
    $LNG->includeData(['L18N', 'INGAME', 'PUBLIC', 'CUSTOM']);
} elseif (MODE === 'CHAT') {
    $session = Session::load();

    // Validate session for chat mode
    if (!$session->isValidSession()) {
        HTTP::redirectTo('index.php?code=3');
    }
}
