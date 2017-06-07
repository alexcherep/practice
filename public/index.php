<?php
error_reporting(E_ALL);
session_start();

define('ROOT', dirname(__DIR__));
define('APP', ROOT.'/'.'app'.'/');
define('VIEW', APP.'views'.'/');
define('SALT', 'smvmermxcvlq303mccz');


require_once ROOT.'/components/autoload.php';

try{
    $obj = new Router();
    $obj->run();
} catch (Exception $e) {
    echo $e->getMessage();
}