<?php
require 'flight/Flight.php';

// autoloader classes
function autoloader($class)
{
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    include_once $filename;
}

spl_autoload_register('autoloader');

// load configs
$json = file_get_contents("config.json");
$config = json_decode($json, true);
include_once ("system.php");
$system = json_decode($json, true);

// registrations
Flight::register('db', '\classes\db', array(
    'mysql:host=' . $system['database']['host'] . ';dbname=' . $system['database']['dbname'],
    $system['database']['user'],
    $system['database']['password']
));

// routes
$index = new \classes\index($system, $config);
Flight::route('/', array($index, 'index'));
Flight::route('/test', array($index, 'test'));

$antrag = new \classes\antrag($system, $config);
Flight::route('POST /antrag', array($antrag, 'post'));
Flight::route('POST /antrag/2', array($antrag, 'post2'));
Flight::route('POST /antrag/3', array($antrag, 'post3'));
Flight::route('POST /antrag/4', array($antrag, 'post4'));
Flight::route('/antrag', array($antrag, 'index'));
Flight::route('/antrag/2', array($antrag, 'index2'));
Flight::route('/antrag/3', array($antrag, 'index3'));
Flight::route('/antrag/4', array($antrag, 'index4'));
Flight::route('/antrag/abschluss', array($antrag, 'abschluss'));
Flight::route('/antrag/bestaetigung', array($antrag, 'bestaetigung'));

$admin = new \classes\admin($system, $config);
Flight::route('/admin/login', array($admin, 'login'));
Flight::route('/admin/dashboard', array($admin, 'dashboard'));

Flight::start();
