<?php
class Comment extends Database
{
    public function add($content, $user_id,$productId){
        $sql = parent::$connection->prepare("INSERT INTO `comment`(`content`,`user_id`,`product_id`) VALUES (?,?,?)");
        $sql->bind_param('sii', $content, $user_id,$productId);
      
        return $sql->execute();
    }
    public function all()
    {
        // 2. Tạo câu query
        // $sql = parent::$connection->prepare('SELECT * from `products`');
        $sql = parent::$connection->prepare('SELECT * FROM `comment` INNER JOIN `users`ON `comment`.`user_id`=`users`.`id`');
        // 3 & 4
        return parent::select($sql);
    }
}

