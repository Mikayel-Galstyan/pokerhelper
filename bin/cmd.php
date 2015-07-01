<?php
/**
 * cmd.php - Entry point for CLI operations
 */

// Set the error reporting to E_ALL|E_STRICT to show all possible errors, warnings and notices
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors',true);

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
	realpath(dirname(__FILE__) . '/../library'),
    get_include_path(),
)));

// Define path to application directory
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'import'));

// Define path to application directory
defined('ROOT_PATH') || define('ROOT_PATH', realpath(dirname(__FILE__) . '/..'));

// Loads Zend Application
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

parse_str(implode('&', array_slice($argv, 1)), $_POST);

$application->bootstrap()->run();
