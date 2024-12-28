<?php
class Category extends  Database
{
    function all() {
        $sql=parent::$connection->prepare('SELECT * FROM `categories`');
       return parent::select($sql);
    }

    function findByID($id) {
        $sql=parent::$connection->prepare('SELECT * FROM `categories` WHERE `id` = ?');
        $sql -> bind_param("i",$id);
       return parent::select($sql)[0];
    }
    
}
