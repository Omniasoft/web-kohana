<?php
// Where to find the different places
$application = 'application';
$modules = 'modules';
$system = 'kohana';
$vendor = 'vendor';

// Enable error reporting
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

// Set the full path to the docroot and some other defines
define('EXT', '.php');
define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

// Make the directories relative to the docroot, for symlink'd index.php
if ( ! is_dir($application) && is_dir(DOCROOT.$application))
	$application = DOCROOT.$application;
if ( ! is_dir($modules) && is_dir(DOCROOT.$modules))
	$modules = DOCROOT.$modules;
if ( ! is_dir($system) && is_dir(DOCROOT.$system))
	$system = DOCROOT.$system;
if ( ! is_dir($vendor) && is_dir(DOCROOT.$vendor))
	$vendor = DOCROOT.$vendor;

// Define the absolute paths for configured directories
define('APPPATH', realpath($application).DIRECTORY_SEPARATOR);
define('MODPATH', realpath($modules).DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system).DIRECTORY_SEPARATOR);
define('VENPATH', realpath($vendor).DIRECTORY_SEPARATOR);

// Clean up the configuration vars
unset($application, $modules, $system, $vendor);

// Define the memory usage and start time at the start of the application, used for profiling.
if ( ! defined('KOHANA_START_TIME'))
	define('KOHANA_START_TIME', microtime(true));
if ( ! defined('KOHANA_START_MEMORY'))
	define('KOHANA_START_MEMORY', memory_get_usage());

// Load the core Kohana class
require(SYSPATH.'classes/Kohana/Core'.EXT);
if (is_file(APPPATH.'classes/Kohana'.EXT))
	require(APPPATH.'classes/Kohana'.EXT);
else
	require(SYSPATH.'classes/Kohana'.EXT);

// Register autoloads
spl_autoload_register(['Kohana', 'auto_load']);
ini_set('unserialize_callback_func', 'spl_autoload_call');

// Register composer autoloader if it exists
if (is_file(VENPATH.'autoload'.EXT))
	require_once(VENPATH.'autoload'.EXT);

// Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
if (isset($_SERVER['KOHANA_ENV']))
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
else
	Kohana::$environment = Kohana::DEVELOPMENT;

// Bootstrap the application
require(APPPATH.'bootstrap'.EXT);

if (PHP_SAPI == 'cli') // Try and load minion
{
	class_exists('Minion_Task') OR die('Please enable the Minion module for CLI support.');
	set_exception_handler(['Minion_Exception', 'handler']);
	Minion_Task::factory(Minion_CLI::options())->execute();
}
else
{
	// Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
	// If no source is specified, the URI will be automatically detected.
	echo Request::factory(true, [], false)
		->execute()
		->send_headers(true)
		->body();
}
