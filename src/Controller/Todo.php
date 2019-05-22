<?php

namespace TodoTest\Controller;

use TodoTest\models\Todo AS TodoModel;

class Todo extends Base{

    public function before(){
        parent::before();

        $this->breadcrumb_items[] = [
            'text' => 'Todo list',
            'href' => '/index.php/todo/',
        ];
    }

    public function indexAction(){
        $items = (new TodoModel($this->app))->getAll();

        $this->response =  $this->app->get('view')->render('todo/list', [
            'items' => $items,
        ]);
    }

    public function editAction(){
        $todoModel = new TodoModel($this->app);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $todoModel->update($_POST['id'], [
                'title' => $_POST['title'],
                'text' => $_POST['text'],
            ]);
        }

        $item = $todoModel->get($_GET['id']);

        $this->response = $this->app->get('view')->render('todo/edit', [
            'item' => $item,
        ]);

        $this->breadcrumb_items[] = [
            'text' => 'item ' . $item['id'],
            'href' => '#',
        ];

        $this->breadcrumb_items[] = [
            'text' => 'edit',
            'href' => '#',
        ];
    }

    public function createAction(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $todoModel = new TodoModel($this->app);

            $newItemId = $todoModel->create([
                'title' => $_POST['title'],
                'text' => $_POST['text'],
            ]);

            if ($newItemId) {
                $this->app->redirectTo('/index.php/todo/edit?id=' . $newItemId);
            }
        }

        $this->response = $this->app->get('view')->render('todo/create');

        $this->breadcrumb_items[] = [
            'text' => 'create new',
            'href' => '#',
        ];
    }

    public function deleteAction(){
        $todoModel = new TodoModel($this->app);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $todoModel->delete($_POST['id']);

            $this->app->redirectTo('/index.php/todo/');
        }

        $item = $todoModel->get($_GET['id']);

        $this->response = $this->app->get('view')->render('todo/delete', [
            'item' => $item,
        ]);

        $this->breadcrumb_items[] = [
            'text' => 'item ' . $item['id'],
            'href' => '#',
        ];

        $this->breadcrumb_items[] = [
            'text' => 'delete',
            'href' => '#',
        ];
    }
}
