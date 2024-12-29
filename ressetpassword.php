<?php 
    session_start();
    require_once 'config/database.php';
    spl_autoload_register(function ($className) {
        require_once "app/models/$className.php";
    });

    if(isset($_POST['submit'])){
        $new_password = $_POST['new_password'];

        $username = $_SESSION['username'];

        $user = new User();

        if($user->updatePassword($username, $new_password)){
            $_SESSION['thongbao'] = 'Đổi mật khẩu thành công';
        }else{
            $_SESSION['thongbao'] = 'Đổi mật khẩu thất bại';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
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
            margin-bottom: 10px;
        }
        .container a {
            color: #ffeba7;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h4>Reset Password</h4>
        <?php 
        if(isset($_SESSION['thongbao'])) :
            echo '<div class="alert alert-info">' . $_SESSION['thongbao'] . '</div>';
            unset($_SESSION['thongbao']);
        ?>

        <?php 
        endif ?>
        <p>Create a new password for your account.</p>
        <form action="" method="post">
            <div class="form-group mb-3">
                <input type="password" name="new_password" class="form-control" placeholder="New Password" required>
            </div>
            <button type="submit" class="btn" name="submit">Reset Password</button>
        </form>
        <a href="login.php">Đăng nhập</a>
    </div>
</body>
</html>
