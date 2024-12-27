<?php
session_start();
require_once 'config/database.php';
spl_autoload_register(function ($className) {
    require_once "app/models/$className.php";
});
$userModel = new User();
$orderModel = new Order();
$orderDetailModel = new OrderDetail();
if (isset($_SESSION['userId'])) {

    $userID = $_SESSION['userId'];

    $user = $userModel->findUserById($userID);
    $order = $orderModel->findByUserID($userID);
    $orderDetail = $orderDetailModel->findByOrderId($order['id']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>

</head>
<?php include("./layout/header.php") ?>


<body>
    <div class="p-10">
        <div class="text-3xl">
            <strong>Chi tiết đơn hàng #ID</strong>
        </div>
        <div class="py-8">
            <div class="px-8 rounded-lg py-1 bg-[#e7f7ec]">
                <div class="flex">
                    <div class="flex-1 text-left text-blue-800">
                        <strong>
                            ĐÃ XÁC NHẬN
                        </strong>
                    </div>
                    <div class="flex-1 text-right text-slate-500">
                        Ngày đặt hàng: 05/10/2023 3:48:11 CN
                    </div>
                </div>
            </div>
        </div>
        <div class="md:flex container">
            <div class="flex-1  p-6">
                <div class="rounded-lg border-2 shadow-lg h-full ">
                    <div class="px-8 py-4">
                        <div class="text-emerald-600">
                            <STRong>ĐỊA CHỈ NHÂN HÀNG</STRong>
                        </div>
                        <div class="py-2">
                            <strong>
                                Địa chỉ
                            </strong>
                            <br><?php echo $user['address'] ?>
                        </div>
                        <strong>
                            Điện thoại
                        </strong>
                        <br><?php echo $user['phone'] ?>
                    </div>
                </div>
            </div>
            <div class="flex-1 p-6">
                <div class="rounded-lg border-2 shadow-lg h-full ">
                    <div class="px-8 py-4">
                        <div class="text-emerald-600">
                            <STRong>
                                HÌNH THỨC ĐẶT HÀNG
                            </STRong>
                        </div>
                        <div class="py-2">
                            <strong>
                                Phương thức đặt hàng
                            </strong>
                            <br>Giao hàng tận nơi
                        </div>
                        <strong>
                            Phí vận chuyển
                        </strong>
                        <br>25.000đ
                    </div>
                </div>
            </div>
            <div class="flex-1  p-6">
                <div class="rounded-lg border-2 shadow-lg  h-full">
                    <div class="px-8 py-4">
                        <div class="text-emerald-600">
                            <STRong>
                                HÌNH THỨC THANH TOÁN
                            </STRong>
                        </div>
                        <div class="py-2">
                            Thanh toán khi nhận hàng
                                <br><a href="#" class="text-green-400"><?php echo ($order['status'] == 0 ) ? "Chờ xử lí" : (($order['status'] == 1) ? "Đang vận chuyển" : "Đã giao" )?></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-8 text-xs">
            <div class="border-2 shadow-lg rounded-xl">
                <div class="flex p-4 rounded-t-lg  bg-zinc-300">
                    <div class=" w-8/12">
                        <strong>
                            Sản phẩm
                        </strong>
                    </div>
                    <div class="md:w-1/12 w-20 text-right	">
                        <strong>
                            Giá
                        </strong>
                    </div>
                    <div class=" md:w-1/12 w-20 text-center	">
                        <strong>
                            Số lượng
                        </strong>
                    </div>
                    <div class=" md:w-1/6  w-20 text-right	">
                        <strong>
                            Tạm tính
                        </strong>
                    </div>
                </div>
                <?php foreach ($orderDetail as $item) : ?>
                    <div class="flex p-4">
                        <div class="w-8/12 md:flex container">
                            <div class=" mr-4 text-center">
                                <img class="size-20" src="<?php echo $item['image'] ?>" alt="">
                            </div>
                            <div class=" md:w-5/12">
                                <strong class=""><?php echo $item['name'] ?></strong>
                                <br>Kích thước - Nhỏ 6"
                                <br>Đế - Dày
                            </div>
                        </div>

                        <div class=" md:w-1/12 w-20  text-center	">
                            <?php echo $item['price'] ?>đ
                        </div>
                        <div class=" md:w-1/12 w-20 text-center	">
                            x<?php echo $item['quantity'] ?>
                        </div>
                        <div class=" md:w-1/6  w-20 text-center	">
                            <strong><?php echo ($item['quantity'] * $item['price']) ?></strong>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="py-8">
            <div class="md:flex container">
                <div class="flex pb-4">
                    <div class="w-2/10 pr-4">
                        <button type="submit" class="bg-slate-800 text-white rounded-lg">
                            <div class="flex p-2">
                                <div class="p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                                    </svg>
                                </div>
                                Quay lại
                            </div>
                        </button>
                    </div>
                    <div class="w-2/10 pr-4">
                        <button type="submit" class="bg-slate-800 text-white rounded-lg">
                            <div class="flex p-2">
                                <div class="p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                                    </svg>
                                </div>
                                Tiếp tục đặt hàng
                            </div>
                        </button>
                    </div>
                </div>
                <div class="md:w-1/2 w-full pr-4 border-2">
                    <div class="p-4 ">
                        <div class="flex">
                            <div class="w-1/2">Tạm tính (x1)</div>
                            <div class="w-1/2 text-right	"><strong>199.000đ</strong></div>

                        </div>
                        <div class="flex">
                            <div class="w-1/2">Giảm giá</div>
                            <div class="w-1/2 text-right	"><strong>0đ</strong></div>

                        </div>
                        <div class="flex border-b-4 ">
                            <div class="w-1/2">Phí giao hàng </div>
                            <div class="w-1/2 pb-4 text-right	"><strong>0đ</strong></div>

                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex">
                            <div class="w-1/2"><strong>Tổng tiền</strong></div>
                            <div class="w-1/2 text-right text-red-600"><strong>119.000đ</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>


</html>