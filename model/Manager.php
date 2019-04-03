<?php
namespace LMC\Blog\Model;


class Manager {
    protected function dbConnect() {
        $bd = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        return $bd;
    }
}