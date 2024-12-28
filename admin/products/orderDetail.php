<?php
session_start();
require_once '../../config/database.php';
spl_autoload_register(function ($className) {
    require_once "../../app/models/$className.php";
});

$orderModel = new Order();
$orderDetails = [];
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];
    $orderDetails = $orderModel->getOrderDetails($orderId);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
    /* Container của phần thông tin khách hàng */
    .customer-info {
        background: linear-gradient(145deg, #ffffff, #f3f4f6);
        padding: 20px 30px;
        border-radius: 12px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 -5px 10px rgba(255, 255, 255, 0.6) inset;
        margin: 20px auto;
        max-width: 600px;
        font-family: 'Arial', sans-serif;
        color: #333;
    }

    /* Tiêu đề chính */
    .customer-info h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #007bff;
        text-transform: uppercase;
        margin-bottom: 20px;
        letter-spacing: 1px;
        text-align: center;
    }

    /* Danh sách thông tin khách hàng */
    .customer-info ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    /* Mỗi mục thông tin */
    .customer-info li {
        font-size: 1.2rem;
        margin: 10px 0;
        color: #555;
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
    }

    /* Nhãn thông tin */
    .customer-info .label {
        font-weight: bold;
        color: #333;
    }

    /* Hiệu ứng hover */
    .customer-info li:hover {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }
</style>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Chi Tiết Đơn Hàng</h1>
        <table class="table table-striped table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID Đơn Hàng</th>
                    <th>ID Sản Phẩm</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá (VND)</th>
                    <th>Số Lượng </th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orderDetails)): ?>
                    <?php foreach ($orderDetails as $detail): ?>
                        <tr>
                            <td><?php echo ($detail['orderId']); ?></td>
                            <td><?php echo ($detail['productId']); ?></td>
                            <td><?php echo ($detail['productName']); ?></td>
                            <td><?php echo number_format($detail['price']); ?></td>
                            <td><?php echo ($detail['quantity']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Không có chi tiết đơn hàng.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="customer-info">
            <?php if (!empty($orderDetails)): ?>
                <h1>Thông Tin Khách Hàng</h1>
                <ul>
                    <li><span class="label">Tên: </span><?php echo htmlspecialchars($orderDetails[0]['userName']); ?></li>
                    <li><span class="label">Địa Chỉ: </span><?php echo htmlspecialchars($orderDetails[0]['address']); ?></li>
                    <li><span class="label">Số Điện Thoại: </span><?php echo htmlspecialchars($orderDetails[0]['phone']); ?></li>
                </ul>
        </div>
    <?php endif; ?>
    <div class="text-center mt-4">
        <a href="manageOrders.php" class="btn btn-secondary">Quay Lại</a>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>