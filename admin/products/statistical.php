<?php
session_start();
require_once '../../config/database.php';
spl_autoload_register(function ($className) {
    require_once "../../app/models/$className.php";
});

$orderModel = new Order();

// Lấy số liệu thống kê
$totalOrders = $orderModel->getTotalOrders();
$totalRevenue = $orderModel->getTotalRevenue();
$topProducts = $orderModel->getTopProducts();
$topProductsMonth = $orderModel->getTopProductsMonth();


$totalProducts = $orderModel->getTotalProducts();

$monthlyRevenue = $orderModel->getMonthlyRevenue(); // Thêm dữ liệu doanh thu hàng tháng

if (isset($_POST['filter'])) {
    $monthlyProductStatistics = $orderModel->getMonthlyYearProductStatistics($_POST['month'],$_POST['year']);
}else{
    $monthlyProductStatistics = $orderModel->getMonthlyProductStatistics();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống Kê Đơn Hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<style>
    /* Thẻ canvas chứa biểu đồ */
    canvas {
        display: block;
        margin: 20px auto; /* Căn giữa */
        width: 100%; /* Đặt chiều rộng tối đa */
        max-width: 800px; /* Giới hạn chiều rộng tối đa */
        height: auto; /* Tự động điều chỉnh chiều cao */
        border-radius: 12px; /* Bo góc biểu đồ */
        background: linear-gradient(145deg, #f3f4f6, #ffffff);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 -2px 4px rgba(255, 255, 255, 0.6) inset;
        padding: 30px;
    }


    /* Card container */
    .card {
        background: linear-gradient(135deg, #ffffff, #f9fafb);
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1), 0 -5px 8px rgba(255, 255, 255, 0.5) inset;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 15px 20px rgba(0, 0, 0, 0.2), 0 -8px 12px rgba(255, 255, 255, 0.7) inset;
    }

    /* Header của card */
    .card-header {
        background: linear-gradient(145deg, #007bff, #0056b3);
        color: #fff;
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        padding: 15px 20px;
        text-transform: uppercase;
        border-bottom: 3px solid #0056b3;
    }

    /* Body của card */
    .card-body {
        padding: 30px 15px;
    }

    /* Hiệu ứng hover vào canvas */
    canvas:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15), 0 -5px 8px rgba(255, 255, 255, 0.6) inset;
        transition: all 0.3s ease;
    }
</style>


<body>
<div class="container mt-5">

        <h1 class="text-center">Thống Kê Đơn Hàng</h1>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header">Tổng Số Đơn Hàng</div>
                    <div class="card-body">
                        <h2><?php echo $totalOrders; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header">Tổng Doanh Thu (VND)</div>
                    <div class="card-body">
                        <h2><?php echo number_format($totalRevenue); ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header">Sản Phẩm Bán Chạy</div>
                    <div class="card-body">
                        <h4><?php echo $topProducts['name']; ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
    <div class="card text-center">
        <div class="card-header bg-primary text-white">
            <h2>Tổng Sản Phẩm</h2>
        </div>
        <div class="card-body">
            <h1 class="display-4"><?php echo number_format($totalProducts); ?></h1>
            <p class="card-text">Tổng số lượng sản phẩm đã bán từ tất cả các đơn hàng.</p>
        </div>
    </div>
</div>

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Doanh Thu Hàng Tháng</div>
                    <div class="card-body">
                        <canvas id="monthlyRevenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
<br>

<form action="statistical.php" method="post">
<label class="mt-4 block"> <input type="radio"
					name="filterOption" value="month" id="yearRadio"> Lọc theo
					tháng năm
				</label>
				<select name="month" id="monthYearPicker"
					class="block mt-2 hidden">
					<option value="" disabled selected>Chọn tháng</option>
					<!-- Không thể chọn và không gửi -->
					<option value="1">Tháng 1</option>
					<option value="2">Tháng 2</option>
					<option value="3">Tháng 3</option>
					<option value="4">Tháng 4</option>
					<option value="5">Tháng 5</option>
					<option value="6">Tháng 6</option>
					<option value="7">Tháng 7</option>
					<option value="8">Tháng 8</option>
					<option value="9">Tháng 9</option>
					<option value="10">Tháng 10</option>
					<option value="11">Tháng 11</option>
					<option value="12">Tháng 12</option>
				</select>
				<select name="year" id="yearPicker" class="block mt-2 hidden">
				<option value="" disabled selected>Chọn năm</option>
					<option value="2024">Năm 2024</option>
					<option value="2023">Năm 2023</option>
					<option value="2022">Năm 2022</option>
					<option value="2021">Năm 2021</option>
					<option value="2020">Năm 2020</option>
					<option value="2019">Năm 2019</option>
					<option value="2018">Năm 2018</option>
				</select>
                <br>
                <button type="submit" name="filter"
					class="mt-4 px-6 py-2 bg-blue-500  rounded-lg hover:bg-blue-600 btn btn-outline-info">
					Lọc</button>
                </form>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Tổng Sản Phẩm Hàng Tháng</div>
                    <div class="card-body">
                        <canvas id="productMonthlyRevenueChart" width="900" height="500"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <a href="index.php" class="d-flex justify-content-around link-offset-2 link-underline link-underline-opacity-0" ><button class="btn btn-outline-success">Back home</button></a>
    <script>
        const ctx = document.getElementById('monthlyRevenueChart').getContext('2d');
        const monthlyRevenueData = <?php echo json_encode($monthlyRevenue); ?>;
        const labels = monthlyRevenueData.map(item => item.month);
        const data = monthlyRevenueData.map(item => item.monthlyRevenue);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh Thu (VND)',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        const ctx2 = document.getElementById('productMonthlyRevenueChart').getContext('2d');
const productMonthlyRevenueData = <?php echo json_encode($monthlyProductStatistics); ?>;

// Dữ liệu
const labels2 = productMonthlyRevenueData.map(item => item.name);
const data2 = productMonthlyRevenueData.map(item => item.total);

new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: labels2, // Tên sản phẩm
        datasets: [{
            label: 'Số Sản Phẩm',
            data: data2, // Tổng số lượng sản phẩm
            backgroundColor: [
                'rgba(75, 192, 192, 0.7)',
                'rgba(255, 99, 132, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)'
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Số Lượng'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Sản Phẩm'
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return `Số lượng: ${tooltipItem.raw}`;
                    }
                }
            },
            legend: {
                display: false // Không cần hiển thị legend trong Bar Chart
            }
        }
    }
});




//        const ctxs = document.getElementById('productMonthlyRevenueChart').getContext('2d');

// // Dữ liệu từ PHP
// const monthlyProductStatistics =<?php echo json_encode($monthlyProductStatistics); ?>;;

// // Xử lý dữ liệu: Nhóm sản phẩm theo tháng
// const months = Array.from({ length: 12 }, (_, i) => `Tháng ${i + 1}`);
// const datasetMap = {};

// monthlyProductStatistics.forEach(item => {
//     const monthIndex = item.month - 1; // Convert SQL month (1-12) to array index (0-11)
//     if (!datasetMap[item.name]) {
//         datasetMap[item.name] = Array(12).fill(0);
//     }
//     datasetMap[item.name][monthIndex] = item.total;
// });

// const datasets = Object.entries(datasetMap).map(([name, data]) => ({
//     label: name,
//     data,
//     backgroundColor: `rgba(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255}, 0.2)`,
//     borderColor: `rgba(${Math.random() * 255}, ${Math.random() * 255}, ${Math.random() * 255}, 1)`,
//     borderWidth: 1
// }));

// // Tạo biểu đồ
// new Chart(ctxs, {
//     type: 'bar',
//     data: {
//         labels: months,
//         datasets: datasets
//     },
//     options: {
//         responsive: true,
//         scales: {
//             x: { stacked: true },
//             y: { beginAtZero: true, stacked: true }
//         }
//     }
// });

    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
