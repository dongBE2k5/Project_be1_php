<?php 
session_start();
require_once 'config/database.php';
spl_autoload_register(function ($className) {
    require_once "app/models/$className.php";
});
$userModel = new User();

if(isset($_SESSION['userId'])){

    $userID = $_SESSION['userId'];
    $userModel = new User();
    


    



    if (!empty($_POST['name']) || !empty($_POST['province']) ||  !empty($_POST['ward']) ||  !empty($_POST['district']) ||  !empty($_POST['addressDetail'])) {
     $userModel->changeAdrresss($userID , $_POST['name'] ,  $_POST['province'] , $_POST['ward'] ,  $_POST['district'] , $_POST['addressDetail']  );

   
    }
    $user = $userModel->findUserById($userID);
    $adressCustommer[] = explode("-" , $user['address'] ) ;
}
       
  
   

    // var_dump($user);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>customer-addresses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./build/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <style>
        .center-2 .table {
            padding: 15px;
        }

        .td-titles {
            width: 30%;
        }

        .items-menu {
            position: relative;
        }

        .items-menu:hover::before {
            position: absolute;
            content: "";
            display: block;
            /* Hiển thị pseudo-element */
            border-left: 3px solid #00b041;
            /* Đường viền bên trái */
            height: 100%;
            /* Chiều cao của pseudo-element bằng với phần tử chính */
            left: -15px;
            /* Đặt vị trí bên trái */
            top: 0;
            /* Đặt vị trí bên trên */
        }

        .active::before {
            position: absolute;
            content: "";
            display: block;
            /* Hiển thị pseudo-element */
            border-left: 3px solid #00b041;
            /* Đường viền bên trái */
            height: 100%;
            /* Chiều cao của pseudo-element bằng với phần tử chính */
            left: -15px;
            /* Đặt vị trí bên trái */
            top: 0;
            /* Đặt vị trí bên trên */
        }

        .pen-edit {
            width: 15px;
            height: 15px;
            margin-right: 5px;
        }
    </style>
</head>


<body>
    <div class="info-customer">
        <div class="container mx-auto">
            <div class="">
                <div class="md:flex w-full mb-10">
                    <div class="md:w-1/3 mt-5 w-full menu p-15 box-border inset-y-0 left-0 static mr-20">
                        <div class="shadow">
                            <div class="headbox bg-neutral-300 rounded-t-lg pl-5 py-3 pr-20 w-full">
                                <p class="text-xl">Tài Khoản Của</p>
                                <p class="font-bold	text-2xl"><?= $user['fullName'] ?></p>
                            </div>
                            <div class="list-menu p-3 ">
                                <ul>
                                    <li class="border-b py-3 items-menu hover:text-[#00b041]"><a class="" href="/inforCustomer">Thông
                                            tin khách hàng</a></li>
                                    <li class="border-b py-3 items-menu active text-[#00b041]"><a href="#">Sổ địa chỉ</a>
                                    </li>
                                    <li class="border-b py-3 items-menu hover:text-[#00b041]"><a href="/orderHistory">Lịch sử mua
                                            hàng</a></li>
                                    <li class="border-b py-3 items-menu hover:text-[#00b041]"><a href="/customerChangepassword">Đổi mật
                                            khẩu</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-2/3 mt-5 w-full center-2 inset-y-0 right-0 static ">
                     
                        <!-- <div id="success-message" class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 mb-5 shadow-md" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                    </svg></div>
                                <div>
                                    <p class="font-bold">Message ^.^</p>
                                    <p class="text-sm">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div> -->
                       
                        <h2 class="text-3xl font-bold hover:text-[#006a31] pb-3">Sổ địa chỉ</h2>
                        <form action="customerAddress.php" method="post">
                          
                            <label class="block py-2">
                                <span class="after:content-['*'] py-2 after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                    Họ và tên
                                </span>
                                <input type="text" name="name" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Họ và tên" value="<?= $user['fullName'] ?>" />
                            </label>
                            <label class="block py-2">
                                <span class="after:content-['*'] py-2 after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                    Tỉnh/Thành
                                </span>
                                <input type="text" name="province" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Họ và tên" value="<?= $adressCustommer[0][0] ?>" />
                            </label>
                            <label class="block py-2">
                                <span class="after:content-['*'] py-2 after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                    Quận/Huyện
                                </span>
                              
                                <input type="text" name="district" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Họ và tên" value="<?= $adressCustommer[0][1] ?>" />
                              
                    </label>
                            <label class="block py-2">
                                <span class="after:content-['*'] py-2 after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                    Phường/Xã
                                </span>
                                <input type="text" name="ward" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Họ và tên" value="<?= $adressCustommer[0][2] ?>" />
                            </label>
                            
                            <label class="block py-2">
                                <span class="after:content-['*'] py-2 after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Thông tin chi tiết
                                </span>
                                <input type="text" name="addressDetail" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Thông tin chi tiết" value="<?= $adressCustommer[0][3] ?>"/>
                            </label>
                            <div class="flex justify-end pt-2">
                                <button type="submit" class="inline-flex justify-center px-10 py-2 text-sm font-medium text-[#fff] bg-[#006a31] border border-transparent rounded-md hover:bg-[#fff] hover:text-[#006a31] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#006a31]">
                                    Cập Nhật
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>