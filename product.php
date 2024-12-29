<?php
session_start();
require_once 'config/database.php';
spl_autoload_register(function ($className) {
    require_once "app/models/$className.php";
});
$id= $_GET['id'];
$productModel = new Product();
$products=$productModel->findProductById($id);
$categoriesModel= new Category();
$categories= $categoriesModel->all();
$category= $categoriesModel->findByID($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<header class="text-gray-600 body-font w-screen">
    <div class="container mx-auto flex flex-wrap p-3 flex-col md:flex-row items-center">
        <a href="home.php" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <img class="w-18 h-18" src="http://thepizzacompany.vn/images/thumbs/000/0003940_logo%20den.png" alt="">
            <!-- <span class="ml-3 text-lg font-mono">Pizza Store</span> -->
        </a>
        <form action="/searchProduct" method="get">
            <div class="flex justify-center items-center md:w-[400px] w-[90%]  md:pl-8">
                <div class="space-y-10  ">
                    <div class="flex items-center p-1 space-x-6 h-[40px] bg-white rounded-xl shadow-lg ">
                        <div class="flex bg-gray-100 flex items-center px-2 h-[35px] md:w-72 w-52 space-x-4 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-30" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input class="bg-gray-100 outline-none placeholder:text-sm" type="text" name="name"
                                placeholder="Article name or keyword..." />
                        </div>
                        <div
                            class="bg-red-600 py-1.5 px-5 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                            <input class="text-sm" type="submit" value="Search">

                        </div>
                    </div>
                </div>
            </div>
        </form>


        <nav class="md:ml-auto flex pt-4 flex-wrap items-center text-base justify-center">
            <div class="right-wrap">
                <div class="account flex items-center">
                    <div href="/info" class="icon pr-2"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg></div>
                    <div class="login-and-register">
                        <a href="login.php" class="register">Đăng nhập</a>
                        <span>/</span>
                        <a href="register.php" class="login">Tạo tài khoản</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <nav
        class="md:w-11/12 overflow-x-auto w-full mx-auto py-2 mb-3 bg-[#00603c] md:rounded-xl md:ml-auto flex items-center text-white flex-row flex md:text-base text-sm ">
        <?php 
        foreach ($categories as $category) :
        ?>
        <a class="mr-5 ml-5 hover:text-gray-900" href="product.php?id=<?php echo $category['id']?>"><?php echo $category['name']?></a>
            <?php 
            endforeach;
            ?>

        <div class="icon_cart ml-auto mr-20 group">
            <div class="w-28 h-6 bg-white rounded-lg flex items-center justify-between">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="blue" class="bi bi-cart3 ml-2"
                    viewBox="0 0 16 16">
                    <path
                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <div class="w-6 h-6 rounded-full bg-red-500 flex justify-center items-center mr-1 ">
                    <span class="minicart--item-count">0</span>
                </div>
            </div>
            <!-- Trong blade template -->
            <div
                class="text-black minicart bg-white p-4 w-72 mx-auto mt-1 rounded-lg shadow-lg z-50 absolute right-[5%]  hidden group-hover:block">
                <div class="minicart--item-container text-xs text-center font-semibold mb-2 ">
                    <p class="text-xl font-bold">Mini Cart</p>
                </div>
                <hr class="mb-4">
                <div class="list_item">
                    <ul class="minicart">




                    </ul>
                    <div>
                        <hr class="my-4">
                        <div class="minicart--subtotal">
                            <p class="minicart--subtotal-title float-left">Subtotal</p>
                            <p class="minicart--subtotal-amount float-right font-bold text-lg">$270.00 USD</p>
                        </div>
                        <a href="/cart"><input type="button" value="View Cart Details"
                                class="w-full h-10 font-semibold bg-black text-white border-none cursor-pointer hover:bg-gray-800">
                    </div></a>


                </div>

            </div>



        </div>

        </div>



        </div>
    </nav>



</header>

<body>
    <!-- Slide -->
<!-- navbar -->
    <section class="text-gray-600 body-font">
        <div class="container pb-24 mx-auto">

            <dialog id="firstModal" class="p-10 border-2 border-gray-300 rounded-xl w-11/12 h-4/5 mx-auto relative">
                <div
                    class="close absolute top-0 right-0 w-7 h-7 rounded-full flex justify-center align-center bg-red-500">
                    <button onclick="firstModal.close()"> X</button>
                </div>
                <div class="grid grid-cols-2 gap-6">
                 
                    <div class=" w-full h-full rounded-md">

                        <img id="modal-product-Image" class="w-10/12" src="" alt="">
                        <input type="hidden" value="190" id="modal-product-image-hidden">
                        <div>
                            <!-- <p class="text-2xl font-bold pr-20 text-center" id="total-price">190.000đ</p> -->
                            <p class="text-2xl font-bold pr-20 text-center pt-20 " id="modal-product-price">1900</p>
                            <input type="hidden" value="190" id="modal-product-price-hidden">
                            <!-- <input id="price_hidden" type="hidden" value="1900" > -->
                        </div>
                        <p id="price" class="text-xl font-bold pr-20 text-center"> </p>
                    </div>

                    <div class="flex flex-col gap-4">
                        <p id="modal-product-name" class="text-xl font-bold pr-20 ">Tên Sản Phẩm</p>
                        <p class="hidden" id="modal-product-id"></p>
                        <input type="hidden" value="Tên Sản Phẩm" id="modal-product-name-hidden">
                        <input type="hidden" value="Tên Sản Phẩm" id="modal-product-id-hidden">
                        <p class="text-[#007d43]">Kích thước nhỏ 6``</p>
                        <p class="leading-relaxed text-base mb-3">Tôm, Đào hoà quyện bùng nổ cùng sốt Thousand Island
                        </p>
                        <h1 class="title-font text-lg font-bold text-[#007d43] mb-3">Kích Thước </h1>
                        <div class="size">
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
                        <h1 class="title-font text-lg font-bold text-[#007d43] mb-3">Đế</h1>
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

                        <div class="comment">
                            <h1 class="title-font text-lg font-bold text-[#007d43] mb-3">Ghi Chú</h1>
                            <textarea class="border-2 border-gray-200" name="ghichu" id="" cols="55" rows="5">
                  </textarea>
                        </div>

                        <!-- <button onclick="addItemToCart('Pizza Hải Sản', 190.000)"  class="bg-[#007d43] hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 w-full border border-gray-400 rounded-xl shadow"> -->

                        <button onclick="addToMiniCart()"
                            class="text-center text-white add-to-cart-btn bg-[#007d43] font-semibold py-2 px-4 w-full border border-gray-400 rounded-xl shadow">
                            THÊM VÀO GIỎ HÀNG</button>
                    </div>
                    <div>
                    </div>
            </dialog>


            <!-- show product -->
            <section class="text-gray-600 body-font">
                <div class="container pb-24  mx-auto">
            
                    <div class="mb-6">
                        <div class="bg-[#00603c] mt-10 mb-5 rounded-xl">
                            <h1 class="text-xl font-bold text-center text-white "><?php echo $category['name']?></h1>
                        </div>

                        <div class="flex flex-wrap ">
                        <?php
                    foreach ($products as $product) :
                        
                    ?>
                            <div
                                class="md:w-1/4 w-full md:p-3 md:border-0 md:py-0 md: my-0 py-3 my-4 border-b-[1px] border-gray-300 ">
                                <div
                                    class="h-full border-gray-200 md:flex-col flex border-opacity-60 rounded-lg overflow-hidden">
                                    <a href="productDetail.php?id=<?php echo $product['id'] ?>">
                                    <div class="w-2/5 md:w-full md:p-0 ">
                                        <img class="object-cover object-center hover:rotate-[10deg] transition duration-450 ease-out hover:ease-in"
                                            src="<?php echo $product['image']?>" alt="blog">
                                    </div>
                                    <div class="w-3/5 md:w-full md:px-0 md:px-0 px-2">
                                        <h1 class="title-font text-lg font-bold text-gray-900 mb-3"><?php echo $product['name']?>
                                        </h1>
                                        <p class="leading-relaxed text-xs mb-3">Description</p>
                                        <div class=" items-center flex justify-between ">
                                            <p class="text-sm">Giá Chỉ Từ <br> <span
                                                    class="md:text-xl text-base text-black font-extrabold"><?php echo $product['price']?></span>
                                            </p>
                                            <div
                                                class="flex items-center border-green-500 border-[1px] md:px-2 px-2 py-1 mr-1  rounded-lg text-green-500">
                                                <input type="button" value="Mua Ngay"> <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    fill="currentColor" class="bi bi-arrow-right md:ml-2 ml-1 "
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>


                            <?php
                          
                            endforeach;
                            ?>

                        </div>


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
    <div class="bg-gray-400">
        <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
            <p class="text-gray-500 text-sm text-center sm:text-left">© 2023 Le Phu Vinh —
                <a href="https://twitter.com/knyttneve" rel="noopener noreferrer" class="text-gray-600 ml-1"
                    target="_blank">@gmail.com</a>
            </p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                <a class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                        <path stroke="none"
                            d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                        </path>
                        <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
            </span>
        </div>
    </div>
</footer>

<script src="/public/js/app.js"></script>
<script src="/build/js/slide.js"></script>


</body>

</html>




</html>