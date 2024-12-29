
<?php 
      session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<?php include("./layout/header.php") ?>

<body>
    <!-- Slide -->
    <!-- navbar -->
    <section class="text-gray-600 body-font">
        <div class="container pb-24 mx-auto">
            <!-- show product -->
            <section class="text-gray-600 body-font">
                <div class="container pb-24  mx-auto">
                    <?php
                    foreach ($categories as $category) :

                    ?>
                        <div class="mb-6">
                            <div class="bg-[#00603c] mt-10 mb-5 rounded-xl">
                                <h1 class="text-xl font-bold text-center text-white "><?php echo $category['name'] ?></h1>
                            </div>

                            <div class="flex flex-wrap ">
                                <?php
                                foreach ($products as $product) :
                                    if ($product['category_id'] == $category['id']) :
                                ?>

                                        <div
                                            class="md:w-1/4 w-full md:p-3 md:border-0 md:py-0 md: my-0 py-3 my-4 border-b-[1px] border-gray-300 ">
                                            <div
                                                class="h-full border-gray-200 md:flex-col flex border-opacity-60 rounded-lg overflow-hidden">
                                                <a href="productDetail.php?id=<?php echo $product['id'] ?>">
                                                    <div class="w-3/5 md:w-full md:p-0 ">
                                                        <img class="object-cover object-center hover:rotate-[10deg] transition duration-450 ease-out hover:ease-in img-fluid img-thumbnail"
                                                            src="<?php echo $product['image'] ?>" alt="blog">
                                                    </div>
                                                    <div class="w-3/5 md:w-full md:px-0 md:px-0 px-2">
                                                        <h1 class="title-font text-lg font-bold text-gray-900 mb-3"><?php echo $product['name'] ?>
                                                        </h1>
                                                        <p class="leading-relaxed text-xs mb-3">Description</p>
                                                        <div class=" items-center flex justify-between ">
                                                            <p class="text-sm">Giá Chỉ Từ <br> <span
                                                                    class="md:text-xl text-base text-black font-extrabold"><?php echo $product['price'] ?></span>
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
                                    endif;
                                endforeach;
                                ?>

                            </div>


                        </div>
                    <?php endforeach; ?>
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


</script>
<!-- <script src="/public/js/app.js"></script> -->
<!-- <script src="/build/js/slide.js"></script> -->

<script>
    
</script>
</body>

</html>




</html>