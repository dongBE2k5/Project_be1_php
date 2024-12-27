<?php
class User extends  Database{
    public function register($username, $password,$email) {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare('INSERT INTO `users`(`username`, `password`,`email`) VALUES (?, ?, ?)');
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql->bind_param('sss', $username, $password,$email);

        // 3 & 4
        return $sql->execute();
    }

    public function login($username, $password) {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare('SELECT * FROM `users` WHERE `username`=?');        
        $sql->bind_param('s', $username);
        $user = parent::select($sql);

        if(count($user) > 0) {
            if(password_verify($password, $user[0]['password'])) {
                return $user[0];
            }     
        }
        // 3 & 4
        return false;
    }

    public function updateUser($id, $fullName, $address, $phone) {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("UPDATE `users` SET `fullName` = ?, `address` = ?, `phone` = ? WHERE `id` = ?");
        
        // Ràng buộc các tham số
        $sql->bind_param('sssi', $fullName, $address, $phone, $id);
        
        // 3 & 4: Thực thi câu query và trả về kết quả
        return $sql->execute();
    }

    public function findUserById($id) {
        $sql = parent::$connection->prepare('SELECT * FROM `users` WHERE `id`=?');        
        $sql->bind_param('i', $id);
        return parent::select($sql)[0];
    }

    public function changePassword($id, $passwordNew) {
        // 2. Tạo câu query
        $sql = parent::$connection->prepare("UPDATE `users` SET `password` = ?  WHERE `id` = ?");
        $password = password_hash($passwordNew, PASSWORD_DEFAULT);
        // Ràng buộc các tham số
        $sql->bind_param('si', $password, $id);
        
        // 3 & 4: Thực thi câu query và trả về kết quả
        return $sql->execute();
    }


    public function changeAdrresss($id, $fullname, $province, $ward, $district, $addressDetail) {

        $address  = $province . "-" . $ward . "-" . $district  . "-" . $addressDetail;
            $sql = parent::$connection->prepare("UPDATE `users` SET `fullname` = ?, `address` = ? WHERE `id` = ?");
            
            // Ràng buộc các tham số
            $sql->bind_param('ssi', $fullname, $address , $id);
            
            // 3 & 4: Thực thi câu query và trả về kết quả
            return $sql->execute();
        }
        
       
    }


    
