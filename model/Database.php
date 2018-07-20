<?php

namespace Models;
class Database
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=db_blog;charset=utf8', 'root', '');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        return $db;
    }
}