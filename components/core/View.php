<?php

class View
{
    protected $path, $layout;

    public function __construct($controller, $action, $layout)
    {
		$this->layout = $layout;
		
        $path = ROOT.'/app/views/'.$controller.'/'.$action.'.php';

        if (!is_file($path)) {
            throw new Exception('Page not found!');
        }

        $this->path = $path;
    }

    public function render($vars)
    {
        extract($vars);
        ob_start();
        require_once $this->path;
        $content = ob_get_clean();

        require_once ROOT.'/app/views/layouts/'.$this->layout.'.php';
    }
}