<?php
require 'flight/Flight.php';

// autoloader classes
function autoloader($class)
{
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    include_once $filename;
}

spl_autoload_register('autoloader');

// load config
$json = file_get_contents("config.json");
$config = json_decode($json, true);

//$con = mysqli_connect(
//    $config->database->host,
//    $config->database->user,
//    $config->database->password,
//    $config->database->dbname
//);

// routes
$index = new \classes\index($config);
Flight::route('/', array($index, 'index'));

$antrag = new \classes\antrag($config);
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
