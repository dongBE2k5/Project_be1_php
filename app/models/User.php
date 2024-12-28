<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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
        
       
    
    public function sendOTP($username, $email) {
        // 1. Kết nối database và kiểm tra tài khoản
        $sql = parent::$connection->prepare('SELECT * FROM `users` WHERE `username` = ? AND `email` = ?');
    $sql->bind_param('ss', $username, $email);
    $sql->execute();
    $result = $sql->get_result();
    $user = $result->fetch_assoc();

    
    if ($user) {
        // 3. Tạo OTP
        $otp = rand(100000, 999999);

        // 4. Lưu OTP vào session (hoặc cookie) thay vì lưu vào database
        // Lưu username và OTP vào session
        session_start();
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_expiry'] = time() + 600; // Hết hạn sau 10 phút

        // 5. Gửi OTP qua email sử dụng PHPMailer
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'quanka052@gmail.com';
            $mail->Password = 'wgop yfca pvbm vgjj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Thiết lập người gửi và người nhận
            $mail->setFrom('yivictor2005@gmail.com', 'Quyện');
            $mail->addAddress($email, $username); // Người nhận

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'OTP của bạn';
            $mail->Body = "OTP của bạn là: <b>$otp</b>. Nó có hiệu lực trong 10 phút.";

            // Gửi email
            $mail->send();
            return true; // Gửi OTP thành công
        } catch (Exception $e) {
            // Lỗi khi gửi email
            return false;
        }
    }
        // 6. Trả về false nếu không thành công
        return false;
    }

    //cập nhật lại password
    public function updatePassword($username,$newPassword){
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = parent::$connection->prepare('UPDATE `users` set `password` = ? where `username` = ?');
        $sql->bind_param('ss',$newPasswordHash,$username);

        return $sql->execute();
    }


}
