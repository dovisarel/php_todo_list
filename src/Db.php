<?php

namespace TodoTest;

use \PDO;

class Db{
    private $con = null;

    public function __construct($dsn, $user = '', $password = '', $port = 3306){
        $this->con = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }

    public function select($sql, $params = []){
        $stmt = $this->con->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($sql, $params = []){
        $stmt = $this->con->prepare($sql);

        $stmt->execute($params);

        return $this->con->lastInsertId();
    }

    public function update($sql, $params = []){
        $stmt = $this->con->prepare($sql);

        $stmt->execute($params);

        return $stmt->rowCount();
    }

    public function delete($sql, $params = []){
        $stmt = $this->con->prepare($sql);

        $stmt->execute($params);

        return $stmt->rowCount();
    }
}
