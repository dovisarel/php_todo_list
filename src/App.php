<?php

namespace TodoTest;

use TodoTest\Controller\Base AS BaseController;

class App{

    private $services = [];

    private $config = [
        'db.dsn' => 'mysql:dbname=todo_app;host=mysql;',
        'db.user' => 'todo_app',
        'db.password' => '123456',
    ];

    public function get($service){
        if( ! array_key_exists($service, $this->services) ){
            throw new Exception("service not found.", 1);
        }

        return $this->services[$service];
    }

    private function getConfig($key, $default = null){
        return $this->config[$key] ?? $default;
    }

    private function initServises(){
        $this->services = [
            'view' => new View(),
            'db' => new Db($this->getConfig('db.dsn'), $this->getConfig('db.user'), $this->getConfig('db.password')),
        ];
    }

    private function getRoute(){
        $pathInfo = trim($_SERVER['PATH_INFO'], '/');

        $pathParts = explode('/', $pathInfo, 2);

        $controllerName = 'TodoTest\\Controller\\' . ucfirst($pathParts[0] ?? 'home');

        $methodNmae = ( $pathParts[1] ?? 'index' ) . 'Action';

        if( ! class_exists($controllerName) ){
            throw new \Exception("class not found.", 1);
        }

        if( ! is_a($controllerName, BaseController::class, true) ){
            throw new \Exception("class not extends Controller\Base.", 1);
        }

        $route = [$controllerName, $methodNmae];

        if( ! is_callable($route) ){
            throw new \Exception("method not found.", 1);
        }

        return $route;
    }

    public function run(){
        $this->initServises();

        $route = $this->getRoute();

        $controllerName = $route[0];
        $method = $route[1];

        $controller = new $controllerName($this);

        call_user_func([$controller, 'before']);

        call_user_func([$controller, $method]);

        call_user_func([$controller, 'after']);

        $response = call_user_func([$controller, 'getResponse']);

        echo $response;
    }

    public function redirectTo($uri, $httpCode = 302){
        header('Location: ' . $uri, true, $httpCode);
        die;
    }
}
