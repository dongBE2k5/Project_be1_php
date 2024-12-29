<?php
    session_start();
require_once 'config/database.php';
spl_autoload_register(function ($className) {
    require_once "app/models/$className.php";
});
$userID = $_SESSION['userId'];
$userModel = new User();
$orderModel = new Order();
$orderDetailModel = new OrderDetail();
$voucherModel = new Voucher();
$totalOrder = 0;
$priceVoucher = 0;
$currentDate = date('Y-m-d');
if(!empty($_POST['voucher'])) {
    $voucher = $voucherModel->findByName($_POST['voucher']);
    if($voucher[0]['end_date'] >= $currentDate && $voucher[0]['start_date'] <= $currentDate ) {
    $totalOrder = (int)$_POST['totalOrderVoucher'] * ((100 - $voucher[0]['percent']) / 100);
    $priceVoucher = (int)$_POST['totalOrderVoucher'] - $totalOrder;
    }else {
        setcookie("expire", "Voucher đã hết hạn", time() + 3600);
        $noti = $_COOKIE['expire'];
    }
}


$user = $userModel->findUserById($userID);
if (!empty($_POST['payment_method'])) {
    $totalOrder = (int)$_POST['totalOrder'];
    $order = $orderModel->saveOrder($_POST['payment_method'], 1, $totalOrder , $user['id']);
    if ($order != null) {
        $carts =  json_decode($_POST['miniCartData'], true);
        foreach ($carts as $cart) {
            $attribute = $cart['size'] . '-' . implode(',', $cart['crust']);
            $orderDetailModel->saveOrderDetail($order['id'], $cart['price'], $cart['id'], $cart['quantity'], $attribute);
        }
        header("location: http://localhost/Project_be1_php/orderSuccess.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<?php include("./layout/header.php") ?>

<body>
    <section>

        <div class="container mx-auto">
            <div class="md:flex">
                <div class="w-2/3">
                    <div>
                        <div class=" m-3  shadow-2xl rounded-xl  ">
                            <div class="box1 bg-white w-full  rounded-xl">
                                <h1 class="p-3 text-xl font-bold border-b-[1px] border-black-500">Thông Tin Nhận Hàng</h1>
                                <h1 class="px-3 pt-3 pb-2 text-[#006a32] font-bold">Giao hàng tới <span class="text-red-500 font-bold">- <?php echo $user['fullName'] . " - " . $user['phone']  ?></span></h1>
                                <p class="px-3 pb-2"><?php echo $user['fullName'] ?>  </p>
                                <p class="px-3 font-bold mb-3">Hướng dẫn cho nhân viên giao hàng</p>
                                <textarea class="ml-3 my-3 px-2 border-[1px] border-black-500 w-11/12" name="" id="" cols="50" rows="5" placeholder="Nội dung....."></textarea>

                            </div>
                        </div>
                        <div class=" m-3  shadow-2xl rounded-xl  ">
                            <div class="box2 bg-white rounded-xl">
                                <h1 class="p-3 text-xl font-bold border-b-[1px] border-black-500">Phương thức thanh toán</h1>
                                <h1 class="px-3 pt-3 pb-2 text-[#006a32] font-bold">Phương thức thanh toán</h1>
                            </div>
                            <form action="infor.php" method="post">

                                <div class="box-item">
                                    <div class="p-4 flex items-center justify-between border border-black-500 ">
                                        <div class="flex items-center ">
                                            <input
                                                class=" relative float-left  mr-1 mt-0.5 h-5 w-5  rounded-full border-2 border-solid border-neutral-300"
                                                type="radio"
                                                name="payment_method"
                                                value="cod"
                                                id="radioDefault01" required />
                                            <img class="w-28" src="https://static.vecteezy.com/system/resources/thumbnails/035/026/415/small_2x/cash-on-delivery-or-cod-icon-design-for-shipping-coupon-bonus-logo-seal-tag-sign-seal-symbol-badge-stamp-sticker-template-website-apps-illustration-free-vector.jpg" alt="">


                                        </div>
                                        <h1>Thanh Toán Khi Nhận Hàng </h1>

                                    </div>
                                    

                                </div>
                                <div class="w-full p-2 py-5 md:flex justify-between">

                                    <input type="hidden" id="<?php echo (($totalOrder == 0)) ? "totalOrder" : "total"?>" name="totalOrder" value="<?php echo $totalOrder  ?>">
                                    <input type="hidden" id="miniCartData" name="miniCartData" value="">
                                    <div class="flex justify-between w-full">
                                    <input type="submit" class="md:w-full  w-11/12 bg-gradient-to-r from-cyan-500 to-blue-500 px-20 py-2 rounded-lg md:ml-2 mt-2   " value="Quay Về">
                                    <input type="submit" class="md:w-full w-11/12 bg-gradient-to-r from-cyan-500 to-blue-500 px-20 py-2 rounded-lg md:ml-2 mt-2 " value="Thanh Toán">
                                    </div>

                                </div>
                            </form>

                        </div>




                    </div>
                </div>



                <div class="md:w-1/3  w-11/12 ">
                    <div class="m-3  w-full shadow-2xl rounded-xl  ">
                        <div class="box1 bg-white w-full rounded-xl p-3 ">
                            <h1 class="p-3 text-xl font-bold border-b-[1px] border-black-500">Đơn Hàng Của Bạn</h1>
                            <div class="order">
                                <div class="orderDetail"></div>

                            </div>
                            <div class="flex justify-between pt-3">
                                <p class="text-lg font-medium">Tổng Tiền</p>
                                <p id="total_price" class="text-lg font-medium  ">0</p>
                            </div>
                            <?php if($totalOrder) : ?>
                            <div class="flex justify-between pt-3">
                                <p class="text-lg font-medium">Đã giảm giá</p>
                                <p id="price_voucher" class="text-lg font-medium  "> - <?php echo $priceVoucher ?></p>
                            </div>
                            <div class="flex justify-between pt-3">
                                <p class="text-lg font-medium">Sau khi giảm giá</p>
                                <p id="total_price_voucher" class="text-lg font-medium"><?php echo $totalOrder ?></p>
                            </div>
                            <?php endif ?>
                            <form class="mt-4" action="infor.php" method="POST">
                                <div>
                                <input type="hidden" id="totalOrderVoucher" name="totalOrderVoucher" value=`${totalAmount}`>
                                    <p>Nhập Voucher giảm giá</p>
                                    <input class="bg-white w-full rounded-sm p-2 mt-2 border-2" placeholder="Nhập mã giảm giá" type="text" name="voucher">
                                    <button class="border mt-4 rounded-xl bg-green-800 text-white p-3 w-full mt-2" type="submit">Áp dụng</button>
                                </div>
                                <?php if(isset($noti)) {
                                    echo "<p class='text-red-500'>" .$noti . "</p>";
                                } ?>
                            </form>


                        </div>
                    </div>
                </div>
            </div>



        </div>
    </section>
</body>
<script>
    var total = document.querySelector('#total_price');
    var totalVoucher = document.querySelector('#totalOrderVoucher');
    var totalOrder = document.querySelector('#totalOrder');
    var mini = document.querySelector('.orderDetail');
    const miniCart = JSON.parse(localStorage.getItem(`miniCartss_${userId}`)) || [];
    let totalAmount = 0;
    let cartHTML = "";
    miniCart.forEach(product => {
        totalAmount = Number(totalAmount) + Number(product.price);
        cartHTML += ` <div class="flex justify-between pt-3">
                                    <p class="text-lg font-medium">${product.name}</p>
                                    <span class="text-sm">x${product.quantity}</span>

                                </div>

                                <p> <span class="text-lg font-medium">Kích thước :</span> ${product.size}</p>
                                <p> <span class="text-lg font-medium">Đế :</span> ${product.crust}</p>
                                <div class="flex pb-4 justify-end border-b-[1px] border-black-500">
                                    <p class="text-lg font-medium ">${product.price}đ</p>
                                </div>`
    })
    total.innerHTML = totalAmount
    mini.innerHTML = cartHTML;

    if(totalOrder) {
    totalOrder.setAttribute("value", totalAmount)
    }
    totalVoucher.setAttribute("value", totalAmount)

    document.getElementById('miniCartData').setAttribute("value", JSON.stringify(miniCart))
    document.getElementById('miniCartData').value = JSON.stringify(miniCart);

    
</script>

</html>