<?php

/**
 /*  TestWebGame
 *   by Apocalypsecoder0
 *
 * For the full copyright and license information, please view the LICENSE
 *
 * @package TestWebGame
 * @author Apocalypsecoder0
 * @copyright 2025. Apocalypsecoder0
 * @copyright 
 * @licence 
 * @version 0.1.5
 * @link https://github.com/Apocalypsecoder0/Testwebgame
 */

define('MODE', 'INSTALL');
define('ROOT_PATH', str_replace('\\', '/', dirname(dirname(__FILE__))) . '/');
set_include_path(ROOT_PATH);
chdir(ROOT_PATH);

require 'includes/common.php';

// Set user theme and language
$THEME->setUserTheme('gow');
$LNG = new Language;
$LNG->getUserAgentLanguage();
$LNG->includeData(['L18N', 'INGAME', 'INSTALL', 'CUSTOM']);

// Get installation mode
$mode = HTTP::_GP('mode', '');

// Initialize template
$template = new template();
$template->setCaching(false);
$template->assign([
    'lang'       => $LNG->getLanguage(),
    'Selector'   => $LNG->getAllowedLangs(false),
    'title'      => $LNG['title_install'] . ' &bull; 2Moons',
    'header'     => $LNG['menu_install'],
    'canUpgrade' => file_exists('includes/config.php') && filesize('includes/config.php') !== 0
]);

// Handle installation tool files
$enableInstallToolFile = 'includes/ENABLE_INSTALL_TOOL';
$quickStartFile = 'includes/FIRST_INSTALL';

// Automatically create ENABLE_INSTALL_TOOL if FIRST_INSTALL is present and writable
if (is_file($quickStartFile) && is_writable($quickStartFile) && unlink($quickStartFile)) {
    @touch($enableInstallToolFile);
}

// Check if installation tool can be accessed
if (is_file($enableInstallToolFile) && (time() - filemtime($enableInstallToolFile) > 3600)) {
    $content = file_get_contents($enableInstallToolFile);
    if (trim($content) !== 'KEEP_FILE') {
        unlink($enableInstallToolFile);
    }
}

if (!is_file($enableInstallToolFile)) {
    $message = ($mode === 'upgrade') ? $LNG->getTemplate('locked_upgrade') : $LNG->getTemplate('locked_install');
    $template->message($message, false, 0, true);
    exit;
}

// Set language cookie if provided
$language = HTTP::_GP('lang', '');
if (!empty($language) && in_array($language, $LNG->getAllowedLangs())) {
    setcookie('lang', $language);
}

// Handle different modes
switch ($mode) {
    case 'ajax':
        handleAjaxMode();
        break;
    case 'upgrade':
        handleUpgradeMode();
        break;
    case 'doupgrade':
        handleDoUpgradeMode();
        break;
    case 'install':
        handleInstallMode();
        break;
    default:
        showIntro();
        break;
}

/**
 * Handle AJAX mode
 */
function handleAjaxMode() {
    global $LNG;

    require 'includes/libs/ftp/ftp.class.php';
    require 'includes/libs/ftp/ftpexception.class.php';
    $LNG->includeData(['ADMIN']);

    $connectionConfig = [
        "host"     => $_GET['host'],
        "username" => $_GET['user'],
        "password" => $_GET['pass'],
        "port"     => 21
    ];

    try {
        $ftp = FTP::getInstance();
        $ftp->connect($connectionConfig);
    } catch (FTPException $error) {
        exit($LNG['req_ftp_error_data']);
    }

    if (!$ftp->changeDir($_GET['path'])) {
        exit($LNG['req_ftp_error_dir']);
    }

    $CHMOD = (php_sapi_name() == 'apache2handler') ? 0777 : 0755;
    $ftp->chmod('cache', $CHMOD);
    $ftp->chmod('includes', $CHMOD);
    $ftp->chmod('install', $CHMOD);
}

/**
 * Handle upgrade mode
 */
function handleUpgradeMode() {
    global $LNG, $template;

    try {
        $sql = "SELECT dbVersion FROM %%SYSTEM%%;";
        $dbVersion = Database::get()->selectSingle($sql, [], 'dbVersion');
    } catch (Exception $e) {
        $dbVersion = 0;
    }

    $updates = [];
    $fileRevision = 0;

    $directoryIterator = new DirectoryIterator(ROOT_PATH . 'install/migrations/');
    foreach ($directoryIterator as $fileInfo) {
        if (!$fileInfo->isFile() || !preg_match('/^migration_\d+/', $fileInfo->getFilename())) {
            continue;
        }

        $fileRevision = substr($fileInfo->getFilename(), 10, -4);
        if ($fileRevision <= $dbVersion || $fileRevision > DB_VERSION_REQUIRED) {
            continue;
        }

        $updates[$fileInfo->getPathname()] = makebr(str_replace('%PREFIX%', DB_PREFIX, file_get_contents($fileInfo->getPathname())));
    }

    $template->assign_vars([
        'file_revision' => min(DB_VERSION_REQUIRED, $fileRevision),
        'sql_revision'  => $dbVersion,
        'updates'       => $updates,
        'header'        => $LNG['menu_upgrade']
    ]);

    $template->show('ins_update.tpl');
}

/**
 * Handle do upgrade mode
 */
function handleDoUpgradeMode() {
    global $LNG, $template;

    require 'includes/config.php';

    // Create a Backup
    $sqlTableRaw = Database::get()->nativeQuery("SHOW TABLE STATUS FROM `" . DB_NAME . "`;");
    $prefixCounts = strlen(DB_PREFIX);
    $dbTables = [];

    foreach ($sqlTableRaw as $table) {
        if (DB_PREFIX == substr($table['Name'], 0, $prefixCounts)) {
            $dbTables[] = $table['Name'];
        }
    }

    if (empty($dbTables)) {
        throw new Exception('No tables found for dump.');
    }

    @set_time_limit(600);
    $fileName = 'TestWebGameBackup_' . date('Y_m_d_H_i_s', TIMESTAMP) . '.sql';
    $filePath = 'includes/backups/' . $fileName;
    require 'includes/classes/SQLDumper.class.php';
    $dump = new SQLDumper;
    $dump->dumpTablesToFile($dbTables, $filePath);

    // Upgrade logic...
    // (The rest of the upgrade logic goes here)

    unlink($enableInstallToolFile);
}

/**
 * Handle install mode
 */
function handleInstallMode() {
    global $template;

    $step = HTTP::_GP('step', 0);
    switch ($step) {
        case 1:
            handleLicenseStep();
            break;
        case 2:
            handleRequirementsStep();
            break;
        case 3:
            handleDatabaseConfigStep();
            break;
        case 4:
            handleDatabaseConnectionStep();
            break;
        case 5:
            $template->show('ins_step5.tpl');
            break;
        case 6:
            handleDatabaseInstallationStep();
            break;
        case 7:
            handleAdminAccountStep();
            break;
        case 8:
            handleAdminAccountCreationStep();
            break;
    }
}

/**
 * Show installation intro
 */
function showIntro() {
    global $LNG, $template;

    $template->assign([
        'intro_text'    => $LNG['intro_text'],
        'intro_welcome' => $LNG['intro_welcome'],
        'intro_install' => $LNG['intro_install'],
    ]);
    $template->show('ins_intro.tpl');
}

// Additional functions for each step can be defined here...

?>
