<?php
class Order extends  Database
{
    function all() {
        $sql=parent::$connection->prepare('SELECT * FROM `categories`');
       return parent::select($sql);
    }

    function findByUserID($id) {
        $sql=parent::$connection->prepare('SELECT * FROM `orders` WHERE `userId` = ? ORDER BY `id` DESC' );
        $sql -> bind_param("i",$id);
       return parent::select($sql)[0];
    }
    function saveOrder($paymentMethod, $status, $totalAmount, $userId) {
        $sql = parent::$connection->prepare('INSERT INTO `orders`(`paymentMethod`, `status`,`totalAmount`, `userId`) VALUES (?, ?, ?, ?)');
        
        $sql->bind_param('siii', $paymentMethod, $status, $totalAmount, $userId);

        // 3 & 4
         $sql->execute();
         $last_id = parent::$connection->insert_id;
        $sql=parent::$connection->prepare('SELECT * FROM `orders` WHERE `id` = ?');
        $sql -> bind_param("i",$last_id );
       return parent::select($sql)[0];
    }

    
    
}
