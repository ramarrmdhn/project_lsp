<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| This file specifies which systems should be loaded by default.
|
| In order to keep the framework light, only the absolute minimal resources
| are loaded by default. For example, the database is not connected to
| automatically since no assumption is made regarding whether you intend to
| use it.  This file lets you globally define which systems you would like
| loaded with every request.
|
| -------------------------------------------------------------------
| Instructions
| -------------------------------------------------------------------
|
| These are the things you can load automatically:
|
|	packages	CodeIgniter packages can be loaded automatically.
|
|	'libraries'	These are the classes located in the system/libraries folder
|				or in your application/libraries folder.
|
|	'drivers'	These are the classes located in the system/libraries folder
|				or in your application/libraries folder.
|
|	helper files	These are helper files, located in the system/helpers folder
|				or in your application/helpers folder.
|
|	config files	These are config files, located in the system/config folder
|				or in your application/config folder.
|
|	language files	These are language files, located in the system/language folder
|				or in your application/language folder.
|
|	models		These are model files, located in the system/models folder
|				or in your application/models folder.
|
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
|
|
| $autoload['libraries'] = array('user_agent' => 'agent');
|
|
| $autoload['drivers'] = array('session');
|
|
| $autoload['helper'] = array('url', 'file');
|
|
| $autoload['config'] = array('config1', 'config2');
|
|
| $autoload['language'] = array('lang1', 'lang2');
|
|
| $autoload['model'] = array('first_model' => 'first');
|
| -------------------------------------------------------------------
| You can also supply an associative array where the key is the alias
| and the value is the true name. For example:
|
|	$autoload['model'] = array('user_model' => 'user');
|
| -------------------------------------------------------------------
*/

$autoload['packages'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in the system/libraries folder
| or in your application/libraries folder.
|
| Prototype:
|
|	$autoload['libraries'] = array('database', 'email', 'session');
|
| You can also supply an associative array where the key is the alias
| and the value is the true name. For example:
|
|	$autoload['libraries'] = array('user_agent' => 'agent');
*/
$autoload['libraries'] = array('database', 'session', 'form_validation');

/*
| -------------------------------------------------------------------
|  Auto-load Drivers
| -------------------------------------------------------------------
| These are the classes located in the system/libraries folder
| or in your application/libraries folder.
|
| Prototype:
|
|	$autoload['drivers'] = array('cache');
|
| You can also supply an associative array where the key is the alias
| and the value is the true name. For example:
|
|	$autoload['drivers'] = array('cache' => 'cch');
*/
$autoload['drivers'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Helper Files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['helper'] = array('url', 'file');
*/
$autoload['helper'] = array('url', 'form', 'file', 'security');

/*
| -------------------------------------------------------------------
|  Auto-load Config files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['config'] = array('config1', 'config2');
|
| NOTE: This item is intended for use ONLY if you have created custom
| config files.  Otherwise, leave it blank.
|
*/
$autoload['config'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Language files
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['language'] = array('lang1', 'lang2');
|
| NOTE: Do not include the "_lang" part of your file.  For example
| "codeigniter_lang.php" would be referenced as array('codeigniter');
|
*/
$autoload['language'] = array();

/*
| -------------------------------------------------------------------
|  Auto-load Models
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload['model'] = array('first_model' => 'first');
|
| You can also supply an associative array where the key is the alias
| and the value is the true name. For example:
|
|	$autoload['model'] = array('user_model' => 'user');
|
*/
$autoload['model'] = array();
