
updateMiniCart();

function updateMiniCart() {
    var mini = document.querySelector('ul');
    var total = document.querySelector('.minicart--subtotal-amount');
    const miniCart = JSON.parse(localStorage.getItem('miniCartss')) || [];
    var cartHTML = '';
    var total1 = 0;
    miniCart.forEach(product => {
    
    let formattedNumber = product.price.toLocaleString('en-US', {
    style: 'decimal',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
    });
    if(product.userID == userId ) {
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


function remove($id) {
const miniCart = JSON.parse(localStorage.getItem('miniCartss')) || [];

// Duyệt qua danh sách miniCart và loại bỏ sản phẩm có id trùng với productIdToRemove
for (let i = 0; i < miniCart.length; i++) {
if (miniCart[i].id == $id) {
    miniCart.splice(i, 1); // Loại bỏ sản phẩm khỏi miniCart
    break; // Dừng vòng lặp sau khi xóa sản phẩm
}
}

// Cập nhật giỏ hàng trong localStorage sau khi xóa sản phẩm
localStorage.setItem('miniCartss', JSON.stringify(miniCart));

updateMiniCart();


}



/*
I want to thank Paul Rudnitskiy for his idea.
If you need full work version you can download it here  https://github.com/BlackStar1991/CardProduct
*/



// window.onload = function () {

//   //// SLIDER
//   var slider = document.getElementsByClassName("sliderBlock_items");
//   var slides = document.getElementsByClassName("sliderBlock_items__itemPhoto");
//   var next = document.getElementsByClassName("sliderBlock_controls__arrowForward")[0];
//   var previous = document.getElementsByClassName("sliderBlock_controls__arrowBackward")[0];
//   var items = document.getElementsByClassName("sliderBlock_positionControls")[0];
//   var currentSlideItem = document.getElementsByClassName("sliderBlock_positionControls__paginatorItem");

//   var currentSlide = 0;
//   var slideInterval = setInterval(nextSlide, 5000);  /// Delay time of slides

//   function nextSlide() {
//       goToSlide(currentSlide + 1);
//   }

//   function previousSlide() {
//       goToSlide(currentSlide - 1);
//   }


//   function goToSlide(n) {
//       slides[currentSlide].className = 'sliderBlock_items__itemPhoto';
//       items.children[currentSlide].className = 'sliderBlock_positionControls__paginatorItem';
//       currentSlide = (n + slides.length) % slides.length;
//       slides[currentSlide].className = 'sliderBlock_items__itemPhoto sliderBlock_items__showing';
//       items.children[currentSlide].className = 'sliderBlock_positionControls__paginatorItem sliderBlock_positionControls__active';
//   }


//   next.onclick = function () {
//       nextSlide();
//   };
//   previous.onclick = function () {
//       previousSlide();
//   };


//   function goToSlideAfterPushTheMiniBlock() {
//       for (var i = 0; i < currentSlideItem.length; i++) {
//           currentSlideItem[i].onclick = function (i) {
//               var index = Array.prototype.indexOf.call(currentSlideItem, this);
//               goToSlide(index);
//           }
//       }
//   }

//   goToSlideAfterPushTheMiniBlock();


// /////////////////////////////////////////////////////////

// ///// Specification Field


//   var buttonFullSpecification = document.getElementsByClassName("block_specification")[0];
//   var buttonSpecification = document.getElementsByClassName("block_specification__specificationShow")[0];
//   var buttonInformation = document.getElementsByClassName("block_specification__informationShow")[0];

//   var blockCharacteristiic = document.querySelector(".block_descriptionCharacteristic");
//   var activeCharacteristic = document.querySelector(".block_descriptionCharacteristic__active");


//   buttonFullSpecification.onclick = function () {

//       console.log("OK");


//       buttonSpecification.classList.toggle("hide");
//       buttonInformation.classList.toggle("hide");


//       blockCharacteristiic.classList.toggle("block_descriptionCharacteristic__active");


//   };


// /////  QUANTITY ITEMS

//   var up = document.getElementsByClassName('block_quantity__up')[0],
//       down = document.getElementsByClassName('block_quantity__down')[0],
//       input = document.getElementsByClassName('block_quantity__number')[0];

//   function getValue() {
//       return parseInt(input.value);
//   }

//   up.onclick = function (event) {
//       input.value = getValue() + 1;
//   };
//   down.onclick = function (event) {
//       if (input.value <= 1) {
//           return 1;
//       } else {
//           input.value = getValue() - 1;
//       }

//   }


// };
