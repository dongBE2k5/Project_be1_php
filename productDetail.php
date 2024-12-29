<?php
session_start();
require_once 'config/database.php';
spl_autoload_register(function ($className) {
    require_once "app/models/$className.php";
});
$id = $_GET['id'];

$productModel = new Product();
$product = $productModel->find($id);

$categoriesModel = new Category();
$categories = $categoriesModel->all();
// $category = $categoriesModel->findByID($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/css/foundation.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

    <style>
        <?php include 'public/css/style.css' ?>
    </style>
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>


    </style>

</head>
<style>

</style>
<?php include("./layout/header.php") ?>

<body>
    <!-- Slide -->
    <!-- navbar -->

    <div class="container">

    </div>
    <section class="text-gray-600 body-font">
        <div class="container pb-24 mx-auto">




            <!-- show product -->
            <section class="product">
                <div class="row">
                    <div class="col-6">
                        <div class="product__photo">

                            <img id="" src="<?php echo $product['image'] ?>" alt="green apple slice">
                            <input type="hidden" name="image" value="<?php echo $product['image'] ?>" id="productImage">
                            <input type="hidden" name="id" value="<?php echo $product['id'] ?>" id="productID">
                        </div>
                    </div>
                    <div class="col-6">
                        <form method="post">
                            <input type="text" name="productId" value="<?php echo $product['id'] ?>" id="note" class="hidden">
                            <div class="product__info">
                                <div class="title">
                                    <h1 class="text-3xl py-2 font-bold text-black" id="productName"><?php echo $product['name'] ?></h1>
                                    <h4 class="py-2">Thông tin sản phẩm</h4>
                                    <h4>
                                        <?php echo $product['description'] ?>
                                    </h4>
                                </div>
                                <div class="price text-xl font-bold text-black py-2">
                                    Giá: <span class="productPrice "><?= $product['price'] ?> </span>VND

                                </div>
                                <div class="flex items-center">
                                    <label class="text-md pr-4 text-black font-bold py-2" for="">Số lượng</label>
                                    <div class="quantity my-2">
                                        <button type="button" class="minus" aria-label="Decrease">&minus;</button>
                                        <input type="number" class="input-box" value="1" min="1" max="10">
                                        <button type="button" class="plus" aria-label="Increase">&plus;</button>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <?php if ($product['category_id'] != 3) : ?>
                                        <div>
                                            <h1 class="title-font text-lg font-bold text-black mb-3">Size </h1>
                                            <div class="size text-black">
                                                <label class="pr-3">
                                                    <input type="radio" class="size" name="size" value="small" data-price="0"> Size nhỏ
                                                    (+$0)
                                                </label>
                                                <label class="pr-3">
                                                    <input type="radio" class="size" name="size" value="medium" data-price="100000"> Size
                                                    trung bình (+$2)
                                                </label>
                                                <label class="pr-3">
                                                    <input type="radio" class="size" name="size" value="large" data-price="200000"> Size lớn
                                                    (+$4)
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($product['category_id'] == 1) : ?>
                                        <div>
                                            <h1 class="title-font text-lg font-bold text-black mb-3">Đế</h1>
                                            <div class="toppng">
                                                <label class="pr-2">
                                                    <input type="checkbox" class="topping mr-2" value="Dày" data-topping="100">Dày
                                                </label>
                                                <label class="pr-2">
                                                    <input type="checkbox" class="topping" value="Mỏng Giòn" data-topping="105"> Mỏng giòn
                                                </label>
                                                <label class="pr-2">
                                                    <input type="checkbox" class="topping" value="Viền Phô Mai" data-topping="110"> Viền phô
                                                    mai
                                                </label>
                                                <label class="pr-2">
                                                    <input type="checkbox" class="topping" value="Viền Phô Mai Xúc Xích" data-topping="115">
                                                    Viền phô mai xúc xích
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="comment">
                                    <h1 class="title-font text-lg font-bold text-[#007d43] mb-3">Ghi Chú</h1>
                                    <textarea class="border-2 border-gray-200" name="ghichu" id="" cols="55" rows="5"></textarea>
                                </div>
                                <button onclick="addToMiniCart()" type="button" class="addtoCart text-white mt-3 w-full py-2 btn border rounded-md bg-green-800 btn-outline-success">Add to Cart</button>

                            </div>
                        </form>
                    </div>
                </div>



            </section>


        </div>
    </section>


</body>
<!-- footer -->
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

</footer>

<script>
    // document.addEventListener("DOMContentLoaded", function () {
    const quantityContainer = document.querySelector(".quantity");
    const minusBtn = quantityContainer.querySelector(".minus");
    const plusBtn = quantityContainer.querySelector(".plus");
    const inputBox = quantityContainer.querySelector(".input-box");
    alert
    updateButtonStates();

    // Thêm sự kiện click cho container
    quantityContainer.addEventListener("click", handleButtonClick);

    // Thêm sự kiện khi người dùng nhập trực tiếp số
    inputBox.addEventListener("input", handleQuantityChange);

    // Hàm cập nhật trạng thái các nút
    function updateButtonStates() {
        const value = parseInt(inputBox.value);
        minusBtn.disabled = value <= 1;
        plusBtn.disabled = value >= parseInt(inputBox.max);
    }

    // Xử lý sự kiện click vào nút tăng/giảm
    function handleButtonClick(event) {
        if (event.target.classList.contains("minus")) {
            decreaseValue();
        } else if (event.target.classList.contains("plus")) {
            increaseValue();
        }
    }

    // Giảm giá trị
    function decreaseValue() {
        let value = parseInt(inputBox.value) || 1;
        value = Math.max(value - 1, 1);
        inputBox.value = value;
        updateButtonStates();
        handleQuantityChange();
    }

    // Tăng giá trị
    function increaseValue() {
        let value = parseInt(inputBox.value) || 1;
        value = Math.min(value + 1, parseInt(inputBox.max));
        inputBox.value = value;
        updateButtonStates();
        handleQuantityChange();
    }

    // Xử lý khi thay đổi số lượng
    function handleQuantityChange() {
        let value = parseInt(inputBox.value) || 1;

        // Đảm bảo giá trị nằm trong giới hạn
        if (value < parseInt(inputBox.min)) value = parseInt(inputBox.min);
        if (value > parseInt(inputBox.max)) value = parseInt(inputBox.max);

        inputBox.value = value;

        // Gọi hành động tùy chỉnh khi giá trị thay đổi
        console.log("Quantity changed:", value);
    }
    // });


    const toppingCheckboxes = document.querySelectorAll('.topping');
    const sizeRadios = document.querySelectorAll('.size');
    const totalPriceElement = document.getElementById('modal-product-price');






    function addToMiniCart() {
        // Lấy thông tin sản phẩm từ các phần tử HTML
        const productName = document.getElementById('productName').textContent;
        const productImage = document.getElementById('productImage').value;
        const productPrice = document.querySelector(".productPrice").textContent; // Lấy tổng giá
        const productId = document.getElementById('productID').value;
        const quantity = inputBox.value
        const selectedInput = document.querySelector('input[name="size"]:checked');
        const size = selectedInput ? selectedInput.value : "";
        const crust = getSelectedToppings();
        const notes = document.querySelector('textarea[name="ghichu"]').value;

        // Tạo đối tượng sản phẩm
        const product = {
            id: productId,
            name: productName,
            image: productImage,
            price: productPrice, // Sử dụng giá tính toán từ các lựa chọn
            size: size,
            crust: crust,
            notes: notes,
            quantity: quantity,
            userID: userId
        };


        // Thêm sản phẩm vào giỏ hàng (sử dụng local storage hoặc nơi bạn lưu trữ giỏ hàng)
        const miniCart = JSON.parse(localStorage.getItem(`miniCartss_${userId}`)) || [];

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        const existingProductIndex = miniCart.findIndex(item => (item.id === productId) && (item.size == product.size) && JSON.stringify(item.crust) === JSON.stringify(product.crust));

        if (existingProductIndex !== -1) {
            // Nếu sản phẩm đã tồn tại, tăng quantity lên
            miniCart[existingProductIndex].quantity =
                Number(miniCart[existingProductIndex].quantity) + Number(quantity);
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm vào giỏ hàng
            miniCart.push(product);
        }


        localStorage.setItem(`miniCartss_${userId}`, JSON.stringify(miniCart));

        // Cập nhật số lượng sản phẩm trong mini cart
        const itemCount = document.querySelector('.minicart--item-count');
        itemCount.textContent = miniCart.length;
        updateMiniCart();
        // Đóng modal sau khi thêm sản phẩm thành công
    }

    function getSelectedToppings() {
        const selectedToppings = [];
        toppingCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedToppings.push(checkbox.value);
            }
        });
        return selectedToppings;
    }
</script>
<!-- <script src="public/js/app.js"></script>
<script src="/build/js/slide.js"></script> -->




</html>