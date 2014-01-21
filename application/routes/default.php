<?php defined('SYSPATH') or die('No direct script access.');

Route::add(Rights::NONE, 'page-home', '', 'Page', 'index');
Route::add(Rights::NONE, 'page-about', 'about', 'Page', 'about');
