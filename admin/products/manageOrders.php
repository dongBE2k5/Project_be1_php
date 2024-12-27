<?php
session_start();
require_once '../../config/database.php';
spl_autoload_register(function ($className) {
    require_once "../../app/models/$className.php";
});
$orderModel = new Order();

if (isset($_POST['status'])&&$_POST['orderId']) {
    if ($orderModel->updateStatus($_POST['status'],$_POST['orderId'])) {
        $_SESSION['notification'] = "Update is success";

    }
}
$orders = $orderModel->all();
// var_dump($_POST['changeStatus']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đơn Hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
<?php
        if(!empty($_SESSION['notification'])) {
            echo '<div class="alert alert-success" role="alert">'. $_SESSION['notification'] . '</div>';
            $_SESSION['notification'] = '';
        }
        ?>
    <div class="container mt-5">
        <h1 class="text-center">Quản Lý Đơn Hàng</h1>
        <table class="table table-striped table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID Đơn Hàng</th>
                    <th>ID Khách Hàng</th>
                    <th>Phương Thức Thanh Toán</th>
                    <th>Trạng Thái</th>
                    <th>Tổng Tiền (VND)</th>
                    <th>Ngày Tạo</th>
                    <th>Cập Nhật Trạng Thái</th>
                    <th>Hành Động</th>
                    <th>Xem Chi Tiết</th>
                </tr>
            </thead>
         <!-- HTML -->
<tbody id="order-table-body">
    <?php foreach ($orders as $order): ?>
        <tr>
            <td class="id_order"><?php echo $order['id']; ?></td>
            <td><?php echo $order['userId']; ?></td>
            <td><?php echo $order['paymentMethod']; ?></td>
            <td>
                <span class="badge"><?php
                    $num = $order['status'];
                    switch ($num) {
                        case "3": echo "Đã Giao"; break;
                        case "2": echo "Đang Giao"; break;
                        case "1": echo "Đang Xử Lý"; break;
                        case "0": echo "Đã Hủy"; break;
                    }
                ?></span>
            </td>
            <td><?php echo number_format($order['totalAmount']); ?></td>
            <td><?php echo $order['created_at']; ?></td>
            <td>
                <?php 
                 if ($order['status'] != 0):
                ?>
                <select class="form-select form-select-sm change-status" name="changeStatus" >
                    <option value="">Trạng thái</option>
                    <option value="3" <?php if ($order['status'] == 3) echo 'selected'; ?>>Đã Giao</option>
                    <option value="2" <?php if ($order['status'] == 2) echo 'selected'; ?>>Đang Vận Chuyển</option>
                    <option value="1" <?php if ($order['status'] == 1) echo 'selected'; ?>>Đang Xử Lý</option>
                    <!-- <option value="0" <?php if ($order['status'] == 0) echo 'selected'; ?>>Đã Hủy</option> -->
                </select>
                <?php 
                endif;
                ?>
            </td>
            <td>
                <button type="button" class="btn btn-primary btn-sm save-status btnSubmit"<?php echo ($order['status'] == 0 )? "disabled" : ""?> name="save" form="form">Lưu Trạng Thái</button>
            </td>
            <td>
                <a href="orderDetail.php?order_id=<?php echo $order['id']; ?>" class="btn btn-info btn-sm">Chi Tiết</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <a href="index.php"><button class="btn btn-primary">Back</button></a>
    
    <form action="manageOrders.php" method="post" id ="form" ></form>
</tbody>


    <script>

const form = document.getElementById("form");
const btns = document.querySelectorAll(".btnSubmit");

btns.forEach((button) => {
    button.addEventListener("click", function () {
        // Lấy hàng tr (dòng) tương ứng với nút bấm
        const row = button.closest("tr");
        const id_order = row.querySelector(".id_orders");
        // Lấy giá trị trạng thái từ dropdown trong dòng tương ứng
        const select = row.querySelector(".change-status");
        const newStatus = select.value;
        button.value = select.value;
        if (!newStatus) {
            alert("Vui lòng chọn trạng thái trước khi lưu!");
            return;
        }

        // Tạo một input ẩn để gửi dữ liệu qua form
        const hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "status";
        hiddenInput.value = newStatus;

        // Gắn giá trị ID đơn hàng
        const orderIdInput = document.createElement("input");
        orderIdInput.type = "hidden";
        orderIdInput.name = "orderId";
        orderIdInput.value = row.children[0].textContent.trim();

        // Xóa các input ẩn cũ trong form (nếu có)
        form.innerHTML = "";

        // Thêm input vào form
        form.appendChild(hiddenInput);
        form.appendChild(orderIdInput);

        // Gửi form
        form.submit();
    });
});

        const changeState = document.querySelectorAll(".badge");

        changeState.forEach(element => {
            switch (element.textContent) {
                case "Đã Giao":
                    element.classList.add("bg-success");
                    break;
                case "Đang Giao":
                    element.classList.add("bg-warning");
                    break;
                case "Đang Xử Lý":
                    element.classList.add("bg-info");
                    break;
                case "Đã Hủy":
                    element.classList.add("bg-danger");
                    break;
            }

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>