<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'config/database.php';
spl_autoload_register(function ($className) {
    require_once "app/models/$className.php";
});

//kiểm tra nếu form dược gửi
if (isset($_POST['submit'])) {
    //kiểm tra xem có tồn tại tài khoản hay email không
    if (isset($_POST['username']) && isset($_POST['email'])) {
        $userModel = new User();

        $username = $_POST['username'];
        $email = $_POST['email'];

        $result = $userModel->sendOTP($username, $email);

        var_dump($result);
        if ($result) {
            $_SESSION['username'] = $username;

            $_SESSION['thongbao'] = 'OTP đã được gửi qua email của bạn';
            header('Location: http://localhost/Project_be1_php/verifyotp.php');
            exit();
        } else {
            $_SESSION['thongbao'] = 'Tài khoản hoặc email không tồn tại';
        }
    } else {
        $_SESSION['thongbao'] = 'Vui lòng nhập đầy đủ thông tin';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Your Password</title>
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
    </style>
</head>

<body>
    <div class="container">
        <h4>Forgot Your Password?</h4>
        <form action="forgotPassword.php" method="post">
            <div class="form-group mb-3">
                <input type="text" name="username" class="form-style" placeholder="Enter your username" required>
            </div>
            <div class="form-group mb-3">
                <input type="email" name="email" class="form-style" placeholder="Enter your email" required>
            </div>
            <button type="submit" class="btn" name="submit">Reset Password</button>
        </form>
        <p class="mt-4">
            <a href="login.php" class="link">Back to Login</a>
        </p>
    </div>
</body>

</html>