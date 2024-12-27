<?php 
class Order extends Database
{
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
