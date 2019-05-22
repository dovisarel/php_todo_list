<?php

namespace TodoTest\Controller;

use TodoTest\App;

class Base{

    protected $app;

    protected $layout = 'layout/normal';

    protected $response = '';

    protected $breadcrumb_items = [];

    public function __construct(App $app){
        $this->app = $app;
    }

    public function before(){
        $this->breadcrumb_items[] = [
            'text' => 'Home',
            'href' => '/index.php/todo/',
        ];
    }

    public function after(){
        if( ! empty($this->layout) ){
            $this->response = $this->app->get('view')->render($this->layout, [
                'response' => $this->response,
                'breadcrumb_items' => $this->breadcrumb_items,
            ]);
        }
    }

    public function getResponse(){
        return $this->response;
    }
}
