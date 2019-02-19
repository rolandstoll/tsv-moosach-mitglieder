<?php
require 'flight/Flight.php';

// autoloader classes
function autoloader($class)
{
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    include_once $filename;
}

spl_autoload_register('autoloader');


// routes
$home = new \classes\home();
Flight::route('/', array($home, 'index'));

$antrag = new \classes\antrag();
Flight::route('POST /antrag', array($antrag, 'post'));
Flight::route('/antrag', array($antrag, 'index'));

Flight::start();
