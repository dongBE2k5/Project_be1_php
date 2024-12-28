<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<?php include("./layout/header.php") ?>

<body>
    <section class=" bg-white">
        <div class="container mx-auto mt-4">
            <div class="grid grid-cols-1  gap-4">
                <div class=" bg-gray-100 rounded p-4">
                    <h1 class="font-bold text-2xl">Giỏ Hàng</h1>
                    <div class="cart_item">
                        <div class="mt-4">
                            <div class="md:flex items-center justify-around border-b border-gray-300 pb-4 mb-4">
                                <div class="flex mt-3 md:justify-between ">
                                    <img src="https://thepizzacompany.vn/images/thumbs/000/0003102_seafood-peach_360.png"
                                        alt="" class="w-20 h-20 object-cover rounded mr-5">
                                    <div class="text-gray-700 flex   items-center">
                                        <div class="text-base w-28 font-semibold">${product.name} <br>
                                            <div class="text-sm font-normal"> ${product.crust}</div>
                                        </div>

                                    </div>
                                </div>
                                <div class="price_plu  flex mt-3">
                                    <div class="flex space-x-2 pr-4">
                                        <button type="button"
                                            class="text-gray-600 hover:text-gray-900 focus:outline-none focus:text-gray-900 decreaseButton">
                                            -
                                        </button>
                                        <input type="text"
                                            class="w-12 h-10 border border-gray-300 rounded text-center quantityInput"
                                            value="1">
                                        <button type="button"
                                            class="text-gray-600 hover:text-gray-900 focus:outline-none focus:text-gray-900 increaseButton">
                                            +
                                        </button>
                                    </div>

                                </div>
                                <div class="text-xl font-semibold flex items-center pr-4 mt-3">${formattedNumber}₫</div>
                                <button class="text-xs text-red-500 hover:underline flex mt-3"
                                    onclick="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                    <p class="ml-2"> Remove from cart</p>
                                </button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="button_dieuhuong flex justify-end  mr-5 mb-5  ">
                <div class="buttom1 mr-2 flex">
                    <a href="/" class="  w-25 px-4 bg-red-500 py-3 flex items-center  ">Tiếp Tục Mua Hàng <svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class=" ml-1  bi bi-arrow-right " viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg></a>

                </div>
                <div class="buttom1 mr-2 flex">
                    <a href="checkout-infor.php" class=" w-25 px-4  bg-red-500 py-3 flex items-center  ">Thanh Toán Đơn
                        Hàng <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class=" ml-1  bi bi-arrow-right " viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg></a>

                </div>

            </div>
        </div>
        <div>

    </section>
</body>
<script>

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
<div class="md:flex items-center justify-around border-b border-gray-300 pb-4 mb-4">
                                <div class="flex mt-3 md:justify-between ">
                                    <img src="${product.image}"
                                        alt="" class="w-20 h-20 object-cover rounded mr-5">
                                    <div class="text-gray-700 flex   items-center">
                                        <div class="text-base w-28 font-semibold">${product.name} <br>
                                            <div class="text-sm font-normal"> ${product.crust}</div>
                                        </div>

                                    </div>
                                </div>
                                <div class="price_plu  flex mt-3">
                                    <div class="flex space-x-2 pr-4">
                                        <button type="button"
                                            class="text-gray-600 hover:text-gray-900 focus:outline-none focus:text-gray-900 decreaseButton">
                                            -
                                        </button>
                                        <input type="text"
                                            class="w-12 h-10 border border-gray-300 rounded text-center quantityInput"
                                            value="${product.quantity}">
                                        <button type="button"
                                            class="text-gray-600 hover:text-gray-900 focus:outline-none focus:text-gray-900 increaseButton">
                                            +
                                        </button>
                                    </div>

                                </div>
                                <div class="text-xl font-semibold flex items-center pr-4 mt-3">${formattedNumber}₫</div>
                                <button class="text-xs text-red-500 hover:underline flex mt-3"
                                    onclick="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                    <p class="ml-2"> Remove from cart</p>
                                </button>
                            </div>
`;
});
let formattedNumber = total1.toLocaleString('en-US', {
style: 'decimal',
minimumFractionDigits: 0,
maximumFractionDigits: 0,
});
const cartItem = document.querySelector(".cart_item")
// total.innerHTML = formattedNumber;
cartItem.innerHTML = cartHTML;

    function updateMiniCart() {
    var mini = document.querySelector('ul');
    var total = document.querySelector('.minicart--subtotal-amount');
    const miniCart = JSON.parse(localStorage.getItem(`miniCartss_${userId}`)) || [];
    
    var cartHTML = '';
    var total1 = 0;
    let lengthCart = 0;
    miniCart.forEach(product => {
    
    let formattedNumber = product.price.toLocaleString('en-US', {
    style: 'decimal',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
    });
    if(product.userID == userId ) {
        lengthCart +=1
    total1 = total1 + (product.price * product.quantity);
    cartHTML += `
    <li class="minicart--item flex mb-5">
    <div class="placeholder w-20 h-26 mr-4 ">  <img class="object-cover object-center hover:rotate-[10deg] transition duration-450 ease-out hover:ease-in" src="/image/${product.image}" alt="product"></div>
    <div class="content flex-1">
      <h1 class="text-sm font-bold mb-2">${product.name}</h1>
      <p class="text-sm"><span class="font-bold text-sm">Giá :</span>  ${formattedNumber}đ  <span> ${product.quantity}x</span></p>
      <p class="text-sm"><span class="font-bold text-sm">size :</span>  ${product.size}</p>
      <p class="text-sm"><span class="font-bold text-sm">Đế  :</span>  ${product.crust}  </p>
      <button class="text-xs text-red-500 hover:underline flex"  onclick="remove(${product.id})" >
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
      <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
      </svg>
      <p class="ml-2">  Remove from cart</p>
      </button>
    </div>
    </li>
    `;
    }
    });
      
    let formattedNumber = total1.toLocaleString('en-US', {
    style: 'decimal',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
    });
    total.innerHTML = formattedNumber;
    mini.innerHTML = cartHTML;
    
    
    const itemCount = document.querySelector('.minicart--item-count');
    itemCount.textContent = miniCart.length;
    
    
    }
    updateMiniCart()
</script>

</html>