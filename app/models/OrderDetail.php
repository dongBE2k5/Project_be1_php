<?php
class OrderDetail extends  Database
{
    function all() {
        $sql=parent::$connection->prepare('SELECT * FROM `categories`');
       return parent::select($sql);
    }

    function findByOrderId($id) {
        $sql=parent::$connection->prepare('SELECT * FROM `orderdetail` INNER JOIN `products` ON `orderdetail`.`productId` = `products`.`id`  WHERE `orderId` = ?');
        $sql -> bind_param("i",$id);
       return parent::select($sql);
    }

    function saveOrderDetail($orderId, $price, $productId, $quantity, $attribute) {
        $sql = parent::$connection->prepare('INSERT INTO `orderdetail`(`orderId`, `price`,`productId`, `quantity`, `attribute`) VALUES (?, ?, ?, ?, ?)');
        
        $sql->bind_param('iiiis', $orderId, $price, $productId, $quantity, $attribute);

        // 3 & 4
        return $sql->execute();
    }

   
    
}
