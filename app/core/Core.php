<?php

namespace app\core;

class Core{

    private $controller = 'Home';
    private $method = 'home';
    private $param = [];

    public function __construct(){

        $router = $this->url();

        $caminho = "app/controller/";
        $file = ucfirst($router[0]).'.php';
        //echo $caminho.$file;

        if(is_dir($caminho)){
            if(file_exists($caminho.$file)){
               $this->controller = $router[0];
               unset($router[0]);
            }
        }

        $class = "\\app\\controller\\" . ucfirst($this->controller);
        $object = new $class;

        if(isset($router[1]) and method_exists($class, $router[1])){
            $this->method = $router[1];
            unset($router[1]);
        }

        $this->param = $router ? array_values($router): [];

        call_user_func_array([$object, $this->method], $this->param);

    }

    public function url(){

        $parse_url = explode('/', filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL));

        return $parse_url;
    }




}