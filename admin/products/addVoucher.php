<?php
session_start();
require_once '../../config/database.php';
spl_autoload_register(function ($className) {
    require_once "../../app/models/$className.php";
});
$categoryModel = new Category();
$categories = $categoryModel->all();

$voucherModel= new Voucher();

if (isset($_POST['name']) && isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['percent']) ) {

    $name=$_POST['name'];
    $start_date=$_POST['start_date'];
    $end_date=$_POST['end_date'];
    $percent=$_POST['percent'];
    $voucherModel->add($name,$start_date,$end_date,$percent);
    $_SESSION['notification'] = "Them thanh cong";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
<?php
        if(!empty($_SESSION['notification'])) {
            echo '<div class="alert alert-success" role="alert">'. $_SESSION['notification'] . '</div>';
            $_SESSION['notification'] = '';
        }
        ?>
    <div class="container">
        <h1>Add Voucher</h1>
        <form action="addVoucher.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="percent" class="form-label">Percent</label>
                <input type="number" min="1" max ="100" class="form-control" id="percent" name="percent">
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">start_date</label>
                <input type="date" class="form-control" id="start_date" name="start_date">
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End date</label>
                <input type="datetime-local" class="form-control" id="end_date" name="end_date">
            </div>
            <div class="mb-3">
                <p>Loại sản phẩm </p>
                <label for="category-id" class="form-label">Tất cả</label>
                <input type="radio" id="category-id" name="category-id" value="0">
            </div>

            <div class="mb-3">
                <label for="category-id" class="form-label">Chọn loại cụ thể</label>
                <input type="radio" name="category-id">
            </div>

            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <?php
                foreach ($categories as $category) :
                ?>
                <input type="checkbox" class="btn-check"  id="category-<?php echo $category['id'] ?>" autocomplete="off" value="<?php echo $category['id'] ?>" name="category-id[]">
                <label class="btn btn-outline-success" for="category-<?php echo $category['id'] ?>"><?php echo $category['name'] ?></label>

              
                <?php
                endforeach;
                ?>
                
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</body>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Lấy các phần tử cần thiết
    const allProductsRadio = document.querySelector('input[type="radio"][value="0"]');
    const specificProductsRadio = document.querySelector('input[type="radio"]:not([value="0"])');
    const categoryCheckboxes = document.querySelectorAll('input[type="checkbox"][name="category-id[]"]');

    // Hàm cập nhật trạng thái của các checkbox
    function updateCategoryCheckboxes() {
        if (specificProductsRadio.checked) {
            categoryCheckboxes.forEach(checkbox => {
                checkbox.disabled = false;
            });
        } else {
            categoryCheckboxes.forEach(checkbox => {
                checkbox.disabled = true;
                checkbox.checked = false; // Bỏ chọn nếu đang được chọn
            });
        }
    }

    // Lắng nghe sự kiện thay đổi của radio "Tất cả" và "Chọn loại cụ thể"
    allProductsRadio.addEventListener("change", updateCategoryCheckboxes);
    specificProductsRadio.addEventListener("change", updateCategoryCheckboxes);

    // Gọi hàm cập nhật trạng thái ban đầu
    updateCategoryCheckboxes();
});


</script>
</html>