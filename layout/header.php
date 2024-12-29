<?php
  
require_once 'config/database.php';
spl_autoload_register(function ($className) {
    require_once "app/models/$className.php";
});
$productModel = new Product();
$products = $productModel->all();

$categoriesModel = new Category();
$categories = $categoriesModel->all();

$userModel = new User();



?>
<header class="text-gray-600 body-font w-screen">
    <?php if (isset($_SESSION['userId'])) : ?>
        <input id="userID" type="hidden" name="userID" value="<?php echo $_SESSION['userId'] ?>">
    <?php endif ?>

    <div class="container mx-auto flex flex-wrap p-3 flex-col md:flex-row items-center">
        <a href="index.php" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <img class="w-18 h-18" src="http://thepizzacompany.vn/images/thumbs/000/0003940_logo%20den.png" alt="">
            <!-- <span class="ml-3 text-lg font-mono">Pizza Store</span> -->
        </a>
        <form action="search.php" method="get">
            <div class="flex justify-center items-center md:w-[400px] w-[90%]  md:pl-8">
                <div class="space-y-10  ">
                    <div class="flex items-center p-1 space-x-6 h-[40px] bg-white rounded-xl shadow-lg ">
                        <div class="flex bg-gray-100 flex items-center px-2 h-[35px] md:w-72 w-52 space-x-4 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-30" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input class="bg-gray-100 outline-none placeholder:text-sm" type="text" name="q"
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
                <?php if (!isset($_SESSION['isLoggedIn'])) : ?>
                    <div class="account flex items-center">
                        <div href="/info" class="icon pr-2"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg></div>
                        <div class="login-and-register">
                            <a href="login.php" class="login">Đăng nhập</a>
                            <!-- <span>/</span>
                        <a href="register.php" class="login">Tạo tài khoản</a> -->
                        </div>
                    </div>
                <?php else : ?>
                    <div class="account flex items-center">
                        <div  class="inforCustomer group relative icon pr-2"><svg xmlns="http://www.w3.org/2000/svg" width="25"
                                height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>

                            <div class="hidden  group-hover:block bg-gray-300 p-2 absolute w-40 top-[25px] rounded-md">
                                <p class="text-black"><a href="inforCustomer.php"> Thông Tin Cá  Nhân</a></p>
                                <p class="text-black"><a href="orderHistory.php"> Đơn hàng của bạn</p>
                            </div>
                        
                        </div>
                        <div class="login-and-register">
                            <p>Xin chào <?php echo $_SESSION['username'] ?></p>
                        </div>
                        <div><a class="ml-3 border rounded-md p-2 bg-green-800 text-white" href="logout.php">Logout</a></div>
                    </div>
                <?php endif ?>
            </div>
        </nav>
    </div>
    <nav
        class="md:w-11/12 overflow-x-auto w-full mx-auto py-2 mb-3 bg-[#00603c] md:rounded-xl md:ml-auto flex items-center text-white flex-row flex md:text-base text-sm ">
        <?php
        foreach ($categories as $category) :
        ?>
            <a class="mr-5 ml-5 hover:text-gray-900" href="product.php?id=<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a>
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
                class="text-black minicart bg-white p-4 w-72 mx-auto  rounded-lg shadow-lg z-50 absolute right-[5%]  hidden group-hover:block">
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
                        <a href="cart.php"><input type="button" value="View Cart Details"
                                class="w-full h-10 font-semibold bg-black text-white border-none cursor-pointer hover:bg-gray-800">
                    </div></a>


                </div>

            </div>



        </div>

        </div>



        </div>
    </nav>
</header>
<script>
    const userId = document.querySelector("#userID").value

    function updateMiniCart() {
        var mini = document.querySelector('ul');
        var total = document.querySelector('.minicart--subtotal-amount');
        const miniCart = JSON.parse(localStorage.getItem(`miniCartss_${userId}`)) || [];

        var cartHTML = '';
        var total1 = 0;
        miniCart.forEach(product => {

            let formattedNumber = product.price.toLocaleString('en-US', {
                style: 'decimal',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0,
            });
           
            total1 = total1 + (product.price * product.quantity);

                
                cartHTML += `
    <li class="minicart--item flex mb-5">
        <div class="w-20 h-26 mr-4">
            <img class="object-cover object-center" src="${product.image}" alt="product">
        </div>
        <div class="content flex-1">
            <h1 class="text-sm font-bold mb-2">${product.name}</h1>
            <p class="text-sm">
                <span class="font-bold text-sm">Giá:</span> ${formattedNumber}đ  
                <span>${product.quantity}x</span>
            </p>
            <p class="text-sm"><span class="font-bold text-sm">Size:</span> ${product.size}</p>
            <p class="text-sm"><span class="font-bold text-sm">Đế:</span> ${product.crust}</p>
            <button class="remove-btn text-xs text-red-500 hover:underline flex" data-product-id="${product.id}" 
            data-product-size="${product.size}" 
                data-product-crust="${product.crust}" data-user-id="${userId}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                </svg>
                <p class="ml-2">Remove from cart</p>
            </button>
        </div>
    </li>
    `;

        });

        // let formattedNumber = total1.toLocaleString('en-US', {
        //     style: 'decimal',
        //     minimumFractionDigits: 0,
        //     maximumFractionDigits: 0,
        // });
        total.innerHTML = total1;
        mini.innerHTML = cartHTML;


        const itemCount = document.querySelector('.minicart--item-count');
        itemCount.textContent = miniCart.length;


    }
    updateMiniCart()

    function remove(productId, size, crust, userId) {
        // Lấy danh sách giỏ hàng từ localStorage
        let miniCart = JSON.parse(localStorage.getItem(`miniCartss_${userId}`)) || [];

        // Tìm và loại bỏ sản phẩm trùng khớp với tất cả thông tin
        miniCart = miniCart.filter(product =>
            !(product.id == productId && product.size == size && product.crust == crust)
        );

        // Lưu lại giỏ hàng mới vào localStorage
        localStorage.setItem(`miniCartss_${userId}`, JSON.stringify(miniCart));

        // Cập nhật lại giao diện giỏ hàng
        updateMiniCart();
    }

    document.addEventListener("DOMContentLoaded", () => {
    const miniCartList = document.querySelector("ul.minicart");

    // Lắng nghe sự kiện click trên danh sách giỏ hàng
    miniCartList.addEventListener("click", function (event) {
        const target = event.target.closest(".remove-btn"); // Xác định nút xóa bị click
        if (target) {
            const productId = target.getAttribute("data-product-id");
            const size = target.getAttribute("data-product-size");
            const crust = target.getAttribute("data-product-crust");
            const userId = target.getAttribute("data-user-id");

            remove(productId, size, crust, userId); // Gọi hàm remove để xóa sản phẩm
        }
    });
});

</script>