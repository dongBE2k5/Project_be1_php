<?php
session_start();
require_once 'config/database.php';
spl_autoload_register(function ($className) {
    require_once "app/models/$className.php";
});
$userModel = new User();
$orderModel = new Order();
$orderDetailModel = new OrderDetail();
echo (isset($_POST['store']));
if (!empty($_POST['orderId']) && isset($_POST['restore'])) {
    $orderModel->restoreOrder($_POST['orderId']);
}
if (!empty($_POST['orderId']) && isset($_POST['delete'])) {
    $orderModel->delete($_POST['orderId']);
}

if (isset($_SESSION['userId'])) {

    $userID = $_SESSION['userId'];

    $user = $userModel->findUserById($userID);
    $orders = $orderModel->findAllByUserID($userID);
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
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Theo dõi đơn hàng</h1>

        <!-- Bảng theo dõi đơn hàng -->
        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-6 text-left font-medium text-gray-700">Mã đơn hàng</th>
                        <th class="py-3 px-6 text-left font-medium text-gray-700">Ngày đặt</th>
                        <th class="py-3 px-6 text-left font-medium text-gray-700">Tổng tiền</th>
                        <th class="py-3 px-6 text-left font-medium text-gray-700">Trạng thái</th>
                        <th class="py-3 px-6 text-left font-medium text-gray-700">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-4 px-6"><?php echo $order['id']; ?></td>
                            <td class="py-4 px-6"><?php echo $order['created_at']; ?></td>
                            <td class="py-4 px-6"><?php echo number_format($order['totalAmount'], 0, ',', '.'); ?> đ</td>
                            <td class="py-4 px-6">
                                <?php
                                $statusText = ($order['status'] == 0) ? "Đã hủy" : (($order['status'] == 1) ? "Đang xử lí" : ($order['status'] == 2 ? "Đang vận chuyển" : "Đã giao"));
                                echo $statusText;
                                ?>
                            </td>
                            <td class="py-4 px-6 flex">
                                <a href="orderDetail1.php?id=<?php echo $order['id']; ?>"
                                    class=" border rounded-md px-2 py-1 bg-green-800 text-white hover:underline">Xem chi tiết</a>
                                <form class="m-0 w-fit" action="orderHistory.php" method="POST">
                                    <input type="hidden" name="orderId" value="<?php echo $order['id'] ?>">
                                    <button name="restore" <?php echo (($order['status'] != 0) ? "disabled" : "" ) ?>
                                        class="rounded-md px-2 text-white bg-green-800 border py-1 ml-2 hover:underline">
                                        Đặt lại
                                    </button>
                                    <button <?php echo (($order['status'] != 0 && $order['status'] != 1) ? "disabled" : "" ) ?> name="delete"
                                        class="rounded-md px-2 py-1 ml-2 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Ghi chú trạng thái -->
        <div class="mt-4 text-sm text-gray-600">
            <p><strong>Chú thích:</strong></p>
            <ul class="list-disc pl-5">
                <li><span class="font-semibold">Chờ xử lý:</span> Đơn hàng đang được xác nhận.</li>
                <li><span class="font-semibold">Đang vận chuyển:</span> Đơn hàng đang trên đường đến bạn.</li>
                <li><span class="font-semibold">Đã giao:</span> Đơn hàng đã được giao thành công.</li>
            </ul>
        </div>
    </div>


</body>

</html>