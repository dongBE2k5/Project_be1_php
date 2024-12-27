<?php
class Order extends  Database
{

    function findByUserID($id) {
        $sql=parent::$connection->prepare('SELECT * FROM `orders` WHERE `userId` = ? and `status` != 0 ORDER BY `id` DESC' );
        $sql -> bind_param("i",$id);
       return parent::select($sql);
    }

    function findByID($id) {
        $sql=parent::$connection->prepare('SELECT * FROM `orders` WHERE `id` = ? ' );
        $sql -> bind_param("i",$id);
       return parent::select($sql)[0];
    }

    function findAllByUserID($id) {
        $sql=parent::$connection->prepare('SELECT * FROM `orders` WHERE `userId` = ? ORDER BY `id` DESC' );
        $sql -> bind_param("i",$id);
       return parent::select($sql);
    }

    function saveOrder($paymentMethod, $status, $totalAmount, $userId, ) {
        $sql = parent::$connection->prepare('INSERT INTO `orders`(`paymentMethod`, `status`,`totalAmount`, `userId`) VALUES (?, ?, ?, ?)');
        
        $sql->bind_param('siii', $paymentMethod, $status, $totalAmount, $userId);

        // 3 & 4
         $sql->execute();
         $last_id = parent::$connection->insert_id;
        $sql=parent::$connection->prepare('SELECT * FROM `orders` WHERE `id` = ?');
        $sql -> bind_param("i",$last_id );
       return parent::select($sql)[0];
    }
    public function deleteOrder($orderId)
    {
   
        $sql = parent::$connection->prepare("UPDATE `orders` SET `status`= 0 WHERE `id`=?");
        $sql->bind_param('i', $orderId);
        // 3 & 4
        $sql->execute();

        $sql = parent::$connection->prepare("UPDATE `orderdetail` SET `status`= 0 WHERE `orderId`=?");
        $sql->bind_param('i', $orderId);
        return $sql->execute();

    }

    public function restoreOrder($orderId)
    {
   
        $sql = parent::$connection->prepare("UPDATE `orders` SET `status`= 1 WHERE `id`=?");
        $sql->bind_param('i', $orderId);
        // 3 & 4
        $sql->execute();

        $sql = parent::$connection->prepare("UPDATE `orderdetail` SET `status`= 1 WHERE `orderId`=?");
        $sql->bind_param('i', $orderId);
        return $sql->execute();

    }

    public function delete($orderId)
    {
   
        $sql = parent::$connection->prepare("DELETE FROM `orders` WHERE `id`=?");
        $sql->bind_param('i', $orderId);
        // 3 & 4
        $sql->execute();

        $sql = parent::$connection->prepare("DELETE FROM `orderdetail` WHERE `orderId`=?");
        $sql->bind_param('i', $orderId);
        return $sql->execute();

    }
    

    function all(){
        $sql = parent::$connection->prepare("SELECT * FROM `orders` ORDER BY (`orders`.`created_at`) DESC");
        
        return parent::select($sql);
    }
    function updateStatus($status,$id){
        $sql= parent::$connection->prepare("UPDATE `orders` SET `status`=? WHERE `id`=?");
        $sql->bind_param("ii",$status,$id);
        return $sql->execute();
    }
    function getOrderDetails($id){
        $sql = parent::$connection->prepare("SELECT *,`products`.`name` AS 'productName' 
                                            FROM `orderdetail` JOIN `products` ON `orderdetail`.`productId`=`products`.`id` 
                                            WHERE `orderId`=?");
        $sql->bind_param("i",$id);
        return parent::select($sql);
    }
}
