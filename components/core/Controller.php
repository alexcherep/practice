<?php

class Controller
{
    protected $vars = [];
    protected $view, $page;
    protected $layout = 'default';

    public function __construct()
    {
        $obj = new Router();

        $this->view = $obj->getController();
        $this->page = $obj->getAction();
    }

    public function getView()
    {
        $obj = new View($this->view, $this->page, $this->layout);
        $obj->render($this->vars);
    }

    public function set($vars)
    {
        $this->vars = $vars;
    }
}