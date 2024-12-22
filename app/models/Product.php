<?php 
class Product extends  Database
{
    function all() {
        $sql=parent::$connection->prepare('SELECT * FROM `products`');
       return parent::select($sql);
    }
    function find($id) {
        $sql=parent::$connection->prepare("SELECT `products`.*  FROM `products` LEFT JOIN `categories` ON `products`.`category_id`=`categories`.`id` WHERE `products`.`id`=?");
        $sql->bind_param("i",$id);
       return parent::select($sql)[0];
    }
    function findProductById($id) {
        $sql=parent::$connection->prepare("SELECT * FROM `products` LEFT JOIN `categories` ON `products`.`category_id`=`categories`.`id` WHERE `products`.`category_id`=?");
        $sql->bind_param("i",$id);
       return parent::select($sql);
    }
    public function findByKeyWord($keyword)
    {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("SELECT * FROM `products` WHERE `name` LIKE ?");
        $keyword = "%{$keyword}%";
        $sql->bind_param('s', $keyword);
        // 3 & 4
        return parent::select($sql);
    }
}
