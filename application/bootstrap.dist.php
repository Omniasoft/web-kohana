<?php defined('SYSPATH') or die('No direct script access.');

// Some global configuration
date_default_timezone_set('Europe/Amsterdam');
setlocale(LC_ALL, 'en_US.utf-8');
I18n::lang('en-us');

// Initialize kohana
Kohana::init([
	'base_url'   => '/',
	'index_file' => false,
	'errors' => Kohana::$environment != Kohana::PRODUCTION,
]);

// Load sugar module (this includes some config and log enhancements)
Kohana::modules([
	'sugar'         => MODPATH.'sugar',
]);

// Attach config and log to kohana
Kohana::$log->attach(new Log_File(APPPATH.'logs'));
Kohana::$config->attach(new Config_Environment);

// Load all modules
Kohana::modules([
	'sugar'         => MODPATH.'sugar',
]);

// Set some things from config
Cookie::$salt = Kohana::$config->load('general.salt');

// Load all routes for this application
foreach (Kohana::list_files('routes', [dirname(__FILE__).DIRECTORY_SEPARATOR]) as $routeFile)
{
	require_once($routeFile);
}