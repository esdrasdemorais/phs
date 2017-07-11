<?php

#namespace _app\Controller;

#use _app\helpers\View as View;

abstract class Controller
{
    private $url;
    private $baseUrl;
    private $controllerName;
    private $actionName;
    private $params;//@Todo
    private $title;        

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];//retorna url

        $this->baseUrl = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], '/index.php'));//retorna a raiz

        //$baseUrl = começa em PHS e vai até
        $queryString = substr($this->url, strpos($this->url, '/index.php') + strlen('/index.php'));

        $this->params = array_filter(explode('/', $queryString));

        $this->controllerName = ucfirst(array_shift($this->params)) . 'Controller';
        $this->actionName = strtolower(array_shift($this->params)) . 'Action';
    }

    public function getRequest()
    {
        return $_POST;
    }
    
    public function getParams() 
    {
        $request = array();
        foreach ($this->params as $value) {
            $request[array_shift($this->params)] = array_shift($this->params);
        }
        return array_filter($request);
    }
    
    public function indexAction()
    {
        $this->title = 'Terceiro Elemento';

        View::Load('view/default/index');
        View::Show(array());
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
    }
}
