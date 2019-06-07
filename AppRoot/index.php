<?php

use Kernel\Dispatcher;

/**
 * This constant containts the relative value of the current script according to the root
 * for instance if the script is index.php and the folder is something 
 * like C:/xampp/htdocs/MyApp/index.php
 * then the APPROOT will be / since MyApp/index.php has been removed with str_replace
 */
define('APPROOT', str_replace("AppRoot/index.php", "", $_SERVER["SCRIPT_NAME"]));

/**
 * This constant containts the abosulte value of the current script
 * for instance if the script is index.php and the folder is something 
 * like C:/xampp/htdocs/MyApp/index.php
 * then the ROOT will be C:/xampp/htdocs/ since MyApp/index.php has been removed with str_replace
 */
define('ROOT', str_replace("AppRoot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

/**
 * Import of the require files
 */
require(ROOT . 'Config/App.php');
require(ROOT . 'Kernel/Router.php');
require(ROOT . 'Routes/routes.php');
require(ROOT . 'Kernel/Request.php');
require(ROOT . 'Kernel/Dispatcher.php');

/**
 * Launch the app by instanciating the Dispatcher Class
 */
$dispatch = new Dispatcher();

$dispatch->dispatch();
?>