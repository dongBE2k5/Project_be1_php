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
                            <td><?php echo htmlspecialchars($detail['orderId']); ?></td>
                            <td><?php echo htmlspecialchars($detail['productId']); ?></td>
                            <td><?php echo htmlspecialchars($detail['productName']); ?></td>
                            <td><?php echo number_format($detail['price']); ?></td>
                            <td><?php echo htmlspecialchars($detail['quantity']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Không có chi tiết đơn hàng.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="manageOrders.php" class="btn btn-secondary">Quay Lại</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
