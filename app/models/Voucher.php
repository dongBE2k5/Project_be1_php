<?php
class Voucher extends  Database
{
    function all() {
        $sql=parent::$connection->prepare('SELECT * FROM `categories`');
       return parent::select($sql);
    }

    function findByName($maVoucher) {
        $sql=parent::$connection->prepare('SELECT * FROM `vouchers` WHERE `name` = ?' );
        $sql -> bind_param("s",$maVoucher);
       return parent::select($sql);
    }
    
    function add($name,$start_date, $end_date, $percent) {
        $sql =parent::$connection->prepare("INSERT INTO `vouchers`(`name`, `start_date`, `end_date`, `percent`) VALUES (?,?,?,?)");
        $sql->bind_param("sssi",$name,$start_date,$end_date,$percent);
        return $sql->execute();
    }
}
