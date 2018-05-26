<?php

namespace Model;
class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=db_blog;charset=utf8', 'root', '');
        return $db;
    }
}