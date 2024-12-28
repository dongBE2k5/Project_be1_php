<?php
session_start();
require_once '../../config/database.php';
spl_autoload_register(function ($className) {
    require_once "../../app/models/$className.php";
});
$orderModel = new Order();

if (isset($_POST['status']) && $_POST['orderId']) {
    if ($orderModel->updateStatus($_POST['status'], $_POST['orderId'])) {
        $_SESSION['notification'] = "Update is success";
    }
}
$orders;
if (isset($_GET['search'])) {
    $q=$_GET['search'];
    $orders = $orderModel->findByIDs($q);
    var_dump($orders);
}else{
    $orders = $orderModel->all();
}
// var_dump($_POST['changeStatus']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đơn Hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>
    .search-container {
        background: #fff;

        height: 30px;
        border-radius: 30px;
        padding: 10px 20px;
        display: flex;
        justify-content: end;
        align-items: center;
        cursor: pointer;
        transition: 0.8s;
        /*box-shadow:inset 2px 2px 2px 0px rgba(255,255,255,.5),
    inset -7px -7px 10px 0px rgba(0,0,0,.1),
   7px 7px 20px 0px rgba(0,0,0,.1),
   4px 4px 5px 0px rgba(0,0,0,.1);
   text-shadow:  0px 0px 6px rgba(255,255,255,.3),
              -4px -4px 6px rgba(116, 125, 136, .2);
  text-shadow: 2px 2px 3px rgba(255,255,255,0.5);*/
        box-shadow: 4px 4px 6px 0 rgba(255, 255, 255, .3),
            -4px -4px 6px 0 rgba(116, 125, 136, .2),
            inset -4px -4px 6px 0 rgba(255, 255, 255, .2),
            inset 4px 4px 6px 0 rgba(0, 0, 0, .2);
    }

    .search-container:hover>.search-input {
        width: 400px;
    }

    .search-container .search-input {
        background: transparent;
        border: none;
        outline: none;
        width: 0px;
        font-weight: 500;
        font-size: 16px;
        transition: 0.8s;

    }

    .search-container .search-btn .fas {
        color: #5cbdbb;
    }

    @keyframes hoverShake {
        0% {
            transform: skew(0deg, 0deg);
        }

        25% {
            transform: skew(5deg, 5deg);
        }

        75% {
            transform: skew(-5deg, -5deg);
        }

        100% {
            transform: skew(0deg, 0deg);
        }
    }

    .search-container:hover {
        /* animation: hoverShake 0.15s linear 3; */
    }
</style>

<body>
    <?php
    if (!empty($_SESSION['notification'])) {
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['notification'] . '</div>';
        $_SESSION['notification'] = '';
    }
    ?>
    <div class="container mt-5">
        <h1 class="text-center">Quản Lý Đơn Hàng</h1>
        <div class="box">
            <form name="search">
                <div class="row">
             
                    <div class="search-container mt-5 col-3">
                      
                        <input type="text" name="search" placeholder="Search order id" class="search-input">
                      <a class="search-btn" name="search">
                        <i class="fas fa-search"></i>
</a>
                       
                    </div>
                </div>
            </form>


        </div>
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
                                                    case "3":
                                                        echo "Đã Giao";
                                                        break;
                                                    case "2":
                                                        echo "Đang Giao";
                                                        break;
                                                    case "1":
                                                        echo "Đang Xử Lý";
                                                        break;
                                                    case "0":
                                                        echo "Đã Hủy";
                                                        break;
                                                }
                                                ?></span>
                        </td>
                        <td><?php echo number_format($order['totalAmount']); ?></td>
                        <td><?php echo $order['created_at']; ?></td>
                        <td>
                            <?php
                            if ($order['status'] != 0):
                            ?>
                                <select class="form-select form-select-sm change-status" name="changeStatus">
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
                            <button type="button" class="btn btn-primary btn-sm save-status btnSubmit" <?php echo ($order['status'] == 0) ? "disabled" : "" ?> name="save" form="form">Lưu Trạng Thái</button>
                        </td>
                        <td>
                            <a href="orderDetail.php?order_id=<?php echo $order['id']; ?>" class="btn btn-info btn-sm">Chi Tiết</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                

                <form action="manageOrders.php" method="post" id="form"></form>
            </tbody>
            <a href="index.php" class="d-flex justify-content-around link-offset-2 link-underline link-underline-opacity-0" ><button class="btn btn-outline-success">Back home</button></a>

            <script>
                const form = document.getElementById("form");
                const btns = document.querySelectorAll(".btnSubmit");

                btns.forEach((button) => {
                    button.addEventListener("click", function() {
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