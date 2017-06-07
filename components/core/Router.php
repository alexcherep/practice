<?php

class Router
{
    protected $routes = [];
    protected $controller, $action, $params, $category;

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include $routesPath;

        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~^$uriPattern$~", $uri)) {
                $path = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $path);

                $this->controller = array_shift($segments);
                $this->action = array_shift($segments);
                $this->params = $segments;
			}
        }
    }
    
    private function getURI()
    {
        return trim(strtolower($_SERVER['REQUEST_URI']), '/');
    }

    public function run()
    {
        $controllerName = ucfirst($this->controller) . 'Controller';
        $actionName = ucfirst($this->action);
        
        $controllerObj = new $controllerName();
        if (method_exists($controllerObj, $actionName)) {
            $result = call_user_func_array([$controllerObj, $actionName], $this->params);
            $controllerObj->getView();
        }
    }
        
}