<?php

namespace TodoTest\models;

use TodoTest\App;

class Todo{
    protected $app;

    public function __construct(App $app){
        $this->app = $app;
    }

    public function getAll(){
        $q = "
            SELECT
                *
            FROM todo_items
            ORDER BY updated_at DESC
        ";

        return $this->app->get('db')->select($q);
    }

    public function get($id){
        $q = "
            SELECT
                *
            FROM todo_items
            WHERE
                id = :id
        ";

        $items = $this->app->get('db')->select($q, [':id' => $id]);

        return $items[0] ?? false;
    }

    public function create($data){
        $q = "
            INSERT INTO todo_items(id, updated_at, title, text)
            VALUES (NULL, NOW(), :title, :text)
        ";

        $fixedData = [
            ':title' => $data['title'],
            ':text' => $data['text'],
        ];

        return $this->app->get('db')->insert($q, $fixedData);
    }

    public function update($id, $data){
        $q = "
            UPDATE todo_items
            SET
                updated_at = NOW(),
                title = :title,
                text = :text
            WHERE
                id = :id
        ";

        $fixedData = [
            ':id' => $id,
            ':title' => $data['title'],
            ':text' => $data['text'],
        ];

        return $this->app->get('db')->update($q, $fixedData);
    }

    public function delete($id){
        $q = "
            DELETE FROM todo_items
            WHERE
                id = :id
        ";

        $fixedData = [
            ':id' => $id,
        ];

        return $this->app->get('db')->delete($q, $fixedData);
    }
}
