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

// Load modules
Kohana::modules([
	//'example'         => MODPATH.'example',
]);

// Attach config and log to kohana
Kohana::$log->attach(new Log_File(APPPATH.'logs'));
Kohana::$config->attach(new Config_Environment);

// Set some things from config
Cookie::$salt = Kohana::$config->load('general.salt');