<?php

class App
{
    private static $router;

    public static function getRouter()
    {
        return self::$router;
    }

    public static function dispatch()
    {
        self::$router = new Router();

        $controllerName = ucfirst(self::$router->getController()).'Controller';
        $actionName = ucfirst(self::$router->getAction());

        var_dump($controllerName, $actionName);


    }
}