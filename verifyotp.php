<?php 
session_start();

if (isset($_POST['submit'])) {
    if (isset($_POST['otp'])) {
        $enteredOtp = $_POST['otp'];

        // Kiểm tra xem OTP có khớp và chưa hết hạn
        if (isset($_SESSION['otp']) && $_SESSION['otp'] == $enteredOtp) {
            $expiryTime = $_SESSION['otp_expiry'];
            $currentTime = time();

            if ($currentTime < $expiryTime) {
                // OTP hợp lệ
                header('Location: http://localhost/Project_be1_php/ressetpassword.php');
                exit();
            } else {
                // OTP đã hết hạn
                $_SESSION['thongbao'] = "OTP đã hết hạn!";
            }
        } else {
            // OTP sai
            $_SESSION['thongbao'] = "OTP không đúng";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <style>
         @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #c4c3ca;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-style {
            padding: 13px 20px;
            padding-left: 55px;
            height: 48px;
            width: 100%;
            font-weight: 500;
            border-radius: 4px;
            font-size: 14px;
            background-color: #1f2029;
            border: none;
            color: #c4c3ca;
            box-shadow: 0 4px 8px 0 rgba(21, 21, 21, .2);
        }
        .form-group input::-webkit-input-placeholder {
            color: #c4c3ca;
        }
        .btn {
            height: 44px;
            text-transform: uppercase;
            background-color: #ffeba7;
            color: #102770;
            border: none;
            border-radius: 4px;
            width: 100%;
        }
        .btn:hover {
            background-color: #fcd56a;
        }
        .container {
            width: 400px;
            background-color: #1f2029;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .container h4 {
            color: #ffeba7;
            margin-bottom: 20px;
        }
        .link {
            color: #ffeba7;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
        .container p {
            color: #ffeba7;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_SESSION['thongbao'])) {
            echo '<div class="alert alert-info">' . $_SESSION['thongbao'] . '</div>';
            // Xóa thông báo sau khi hiển thị để không bị hiển thị lại trong lần tải trang tiếp theo
            unset($_SESSION['thongbao']);
        }
        ?>
        <p>Please enter the OTP sent to your email.</p>
        <form action="" method="post">
        <label for="otp" style="color: #ffeba7;">Enter OTP:</label>
        <input type="text" name="otp" required>

        <button class="btn mt-4" type="submit" name="submit" ">Verify OTP</button>
    </form>
    </div>
</body>
</html>