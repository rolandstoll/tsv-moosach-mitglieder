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
$json = file_get_contents("system.json");
$system = json_decode($json, true);

// registrations
Flight::register('db', 'PDO', array('mysql:host=' . $system['host'] . ';dbname=' . $system['db'], $system['user'], $system['password'] ));
Flight::register('mailer', 'mailer');

// routes
$index = new \classes\index($system, $config);
Flight::route('/', array($index, 'index'));

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

Flight::start();
