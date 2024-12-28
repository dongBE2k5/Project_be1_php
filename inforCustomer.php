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
    $user = $userModel->findUserById($userID);

}
       
  
   

    // var_dump($user);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
</head>
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


<?php include("./layout/header.php") ?>

<body>
    <div class="info-customer mt-10 mb-20">
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
                                    <li class="border-b py-3 items-menu active text-[#00b041]"><a href="#">Thông
                                            tin khách hàng</a></li>
                                    
                                    <li class="border-b py-3 items-menu hover:text-[#00b041]"><a href="/orderHistory.php">Lịch sử mua
                                            hàng</a></li>
                                    <li class="border-b py-3 items-menu hover:text-[#00b041]"><a href="changePassword.php">Đổi mật
                                            khẩu</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-2/3 mt-5 w-full center-2 inset-y-0 right-0 static ">
                        <h2 class="text-3xl font-bold hover:text-[#006a31]">Thông tin chung</h2>
                        <div class="table table-address shadow mt-8 rounded-lg w-full">
                            <table class="p-6 rounded-lg w-full">
                                <tbody>
                                    <tr class="border-0">
                                        <td class="no-underline font-bold text-xl text-[#006a31]" colspan="2">Thông tin
                                            tài khoản</td>

                                    </tr>
                                    <tr class="border-0">
                                        <td class="no-underline td-titles">Tên tài khoản</td>
                                        <td class="no-underline" colspan="2"><?= $user['username'] ?></td>
                                    </tr>
                                    <tr class="border-0">
                                        <td class="no-underline td-titles">Số điện thoại</td>
                                        <td class="no-underline" colspan="2"><?= $user['phone'] ?></td>
                                    </tr>
                                    <tr class="border-0">
                                        <td class="no-underline td-titles">Email</td>
                                        <td class="no-underline" colspan="2"><?= $user['email'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table table-address shadow mt-8 rounded-lg w-full">
                            <table class="p-6 rounded-lg w-full">
                                <tbody>
                                    <tr class="border-0">
                                        <td class="no-underline font-bold text-xl text-[#006a31]" colspan="2">Sổ Địa Chỉ
                                        </td>
                                        <td class="no-underline edit-wrapper td-edit text-right flex justify-end text-[#068fdd]">
                                            <a class="edit flex" href="customerAddress.php"><em class=""></em> <svg class="fill-[#068fdd]" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                                    <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                                </svg>Chỉnh sửa</a>
                                        </td>
                                    </tr>

                                    <tr class="border-0">
                                        <td class="no-underline td-titles">Địa Chỉ</td>
                                        <td class="no-underline" colspan="2"> 
                                        <?= $user['address'] ?>
                                        </td>
                                    </tr>
                                    <tr class="border-0">
                                        <td class="no-underline td-titles">Điện Thoại</td>
                                        <td class="no-underline" colspan="2"><?= $user['phone'] ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-gray-600 body-font bg-[#006a31] w-full">
    <div class="py-8 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col">
        <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left">
            <img src="/image/gt-removebg-preview.png" width="200px">
        </div>
        <div class="flex-grow flex flex-wrap md:mt-0 mt-10 md:text-left text-center">
            <div class="lg:w-1/3 md:w-1/2 w-full px-4">
                <h2 class="title-font text-white font-black text-lg tracking-widest mb-3">GIỚI THIỆU</h2>
                <nav class="list-none mb-10">
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm ">Hệ thống nhà hàng</a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Câu chuyện thương
                            hiệu</a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Ưu đãi thành viên</a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Tin tức & sự kiện</a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Tuyển dụng</a>
                    </li>
                </nav>
                <h2 class="title-font text-white font-black text-lg tracking-widest mb-3">VĂN PHÒNG ĐẠI DIỆN</h2>
                <nav class="list-none mb-10">
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Công ty Cổ phần Pizza
                            Ngon 77 Trần Nhân Tôn, Phường 9, Quận 5, Thành phố Hồ Chí Minh </a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">SĐT: +84 (028) 7308
                            3377 </a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">MST: 0104115527 </a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Cấp lần đầu ngày 17
                            tháng 08 năm 2009 và có thể được sửa đổi vào từng thời điểm</a>
                    </li>
                </nav>
            </div>
            <div class="lg:w-1/3 md:w-1/2 w-full px-4">
                <h2 class="title-font text-white font-black text-lg tracking-widest mb-3">LIÊN HỆ</h2>
                <nav class="list-none mb-10">
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Liên hệ</a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Hướng dẫn mua hàng</a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Chính sách giao
                            hàng</a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Chính sách bảo mật</a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Điều khoản và Điều
                            kiện</a>
                    </li>
                </nav>
                <h2 class="title-font text-white font-black text-lg tracking-widest mb-3">TỔNG ĐÀI HỖ TRỢ</h2>
                <nav class="list-none mb-10">
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Đặt hàng: 1900 6066
                            (9:30 – 21:30)</a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Tổng đài CSKH: 1900 633
                            606 (9:30 - 21:30)</a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Third Link</a>
                    </li>
                    <li>
                        <a class=" text-white font-light hover:underline cursor-pointer text-sm">Fourth Link</a>
                    </li>
                </nav>
            </div>

            <div class="lg:w-1/3 md:w-1/2 w-full px-4">
                <h2 class="title-font font-medium  text-white font-bold tracking-widest text-sm mb-3">SUBSCRIBE</h2>
                <div
                    class="flex xl:flex-nowrap md:flex-nowrap lg:flex-wrap flex-wrap justify-center items-end md:justify-start">
                    <div class="relative w-40 sm:w-auto xl:mr-4 lg:mr-0 sm:mr-4 mr-2">
                        <label for="footer-field" class="leading-7 text-sm  text-white font-bold">Placeholder</label>
                        <input type="text" id="footer-field" name="footer-field"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <button
                        class="lg:mt-2 xl:mt-0 flex-shrink-0 inline-flex text-white font-bold bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Button</button>
                </div>

            </div>
        </div>
    </div>
    <div class="bg-gray-400">
        <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
            <p class="text-gray-500 text-sm text-center sm:text-left">© 2023 Le Phu Vinh —
                <a href="https://twitter.com/knyttneve" rel="noopener noreferrer" class="text-gray-600 ml-1"
                    target="_blank">@gmail.com</a>
            </p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                <a class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                        <path stroke="none"
                            d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                        </path>
                        <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
            </span>
        </div>
    </div>
</footer>
</body>


</html>