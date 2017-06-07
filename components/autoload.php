<?php

spl_autoload_register(function($class) {
    $path = ROOT.'/app/models/'.$class.'.php';

    if ( is_file($path) ) {
        require_once $path;
    }
});

spl_autoload_register(function($class) {
    $path = ROOT.'/components/core/'.$class.'.php';;

    if ( is_file($path) ) {
        require_once $path;
    }
});

spl_autoload_register(function($class) {
    $path = ROOT.'/app/controllers/'.$class.'.php';;

    if ( is_file($path) ) {
        require_once $path;
    }
});

spl_autoload_register(function($class) {
    $path = ROOT.'/components/'.$class.'.php';;

    if ( is_file($path) ) {
        require_once $path;
    }
});

