<?php
class Voucher extends  Database
{
    function all() {
        $sql=parent::$connection->prepare('SELECT * FROM `categories`');
       return parent::select($sql);
    }

    function findByName($maVoucher) {
        $sql=parent::$connection->prepare('SELECT * FROM `vouchers` WHERE `maVoucher` = ?' );
        $sql -> bind_param("s",$maVoucher);
       return parent::select($sql);
    }
    
}
