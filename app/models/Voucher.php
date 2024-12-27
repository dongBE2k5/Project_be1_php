<?php
class Voucher extends Database
{
    function add($name,$start_date, $end_date, $percent) {
        $sql =parent::$connection->prepare("INSERT INTO `vouchers`(`name`, `start_date`, `end_date`, `percent`) VALUES (?,?,?,?)");
        $sql->bind_param("sssi",$name,$start_date,$end_date,$percent);
        return $sql->execute();
    }
}
