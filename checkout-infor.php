<?php
    session_start();
    require_once 'config/database.php';
    spl_autoload_register(function ($className) {
        require_once "app/models/$className.php";
    });
    $userID = $_SESSION['userId'];
    $userModel = new User();
    if(!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['province']) && !empty($_POST['ward']) && !empty($_POST['district']) && !empty($_POST['address-detail'])) {
        $address = $_POST['province'] . "-" . $_POST['ward'] . "-" . $_POST['district'] . "-" . $_POST['address-detail'];
        if($userModel->updateUser($userID, $_POST['name'], $address, $_POST['phone'])) {
        header("location: http://doanbe1.local/infor.php");
        }
    }
    $user = $userModel->findUserById($userID);

    if(!empty($user['fullName']) && !empty($user['phone']) && !empty($user['address'])) {
        header("location: http://doanbe1.local/infor.php");
    }   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script> -->


</head>

<div class="container p-2 mx-auto md:w-10/12 w-full font-medium border-b-2 border-indigo-500">
    <div class="md:flex  justify-center ">
        <form method="POST" action="checkout-infor.php" class="md:flex">
            <div class="ad1  md:w-1/2 w-full md:p-14  md:ps-8">
                <div class="text-xl border-b-2 pb-3 border-gray-500  	">Đặt giao hàng</div>
                <div class="text-2xl pt-10 pb-5 hover:text-[#006a31]">Thông tin nhận hàng</div>
                <input type="hidden" name="">
                <p>Họ và tên *</p>
                <!-- <input type="text" class="" placeholder="Nhập họ và tên"> -->
                <div class="relative mb-4">
                    <input required type="text" id="email" name="name"
                        class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
                <p>Số điện thoại *</p>
                <!-- <input type="text" placeholder="Số điện thoại"> -->
                <div class="relative mb-4">

                    <input required type="text" id="email" name="phone"
                        class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
                <p>Tỉnh/Thành *</p>
                <!-- <input type="text" placeholder="Tỉnh thành"> -->
                <div class="relative mb-4">
                    <input required name="province" id="provinceSelect" class="w-full h-10 border-[1px] border-back-500" />



                </div>
                <p>Quận/Huyện *</p>
                <!-- <input type="text" placeholder="Nhập Quận/Huyện"> -->
                <div class="relative mb-4">
                    <input required name="district" class="w-full h-10 border-[1px] border-back-500" id="districtSelect" />


                </div>
                <p>Phường/Xã *</p>
                <div class="relative mb-4">
                    <input required name="ward" id="wardSelect" class="w-full h-10 border-[1px] border-back-500" />


                </div>
                <p class="w-full">Thông tin chi tiết:</p>
                <p class="w-full text-xs pb-2 mb-3">Vui lòng nhập đủ Hẻm/ Ngõ/ Ngách/ Kiệt/ Thôn/ Ấp/ Chung Cư/ Khu Đô Thị/ Khu Dân Cư/ Số Căn Hộ cụ thể kèm những yêu cầu khác (nếu có) để hướng dẫn cho nhân viên giao hàng.</p>
                <div class="relative mb-4">

                    <input required type="text" id="address-detail" name="address-detail"
                        class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
            </div>


            
    </div>
    <div class="button right-1 flex md:justify-end w-full  mr-10">
        <button class="text-white bg-[#006a31] border-0 md:py-2  md:px-16 md:my-16 md:mx-6 w-full p-2 mr-2 focus:outline-none hover:bg-indigo-600 rounded text-lg flex justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left mt-1.5 mr-1.5" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg>Tiếp tục </button>
        <button class="text-white bg-[#006a31] border-0 md:py-2  md:px-16 md:my-16 md:mx-6 w-full p-2 ml-2 focus:outline-none hover:bg-indigo-600 rounded  text-lg flex justify-center">Thanh toán<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right mt-2 ml-2" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
            </svg></button>

    </div>

</div>
</form>


<script>
    // Lấy tham chiếu đến các radio button
    // Lấy tham chiếu đến các radio button
    const radioNow = document.getElementById('default-radio-1');
    const radioSelectTime = document.getElementById('default-radio-2');

    // Thêm sự kiện click listener cho radio button "Ngay bây giờ"
    radioNow.addEventListener('click', function() {
        if (radioNow.checked) {

            radioSelectTime.checked = false;
        }
    });

    // Thêm sự kiện click listener cho radio button "Chọn thời gian"
    radioSelectTime.addEventListener('click', function() {
        if (radioSelectTime.checked) {
            // Radio "Chọn thời gian" đã được chọn, hãy đảm bảo bỏ chọn radio "Ngay bây giờ"
            radioNow.checked = false;
        }
    });


    document.addEventListener("DOMContentLoaded", function() {
        const radioButtons = document.querySelectorAll('input[type="radio"]');
        const resultDiv = document.getElementById('result');
        const hiddenParagraph = document.getElementById('hiddenParagraph');
        const day = document.getElementById('day');

        // Đặt sự kiện change cho mỗi radio button
        radioButtons.forEach(function(radio) {
            radio.addEventListener('change', function() {
                // Kiểm tra xem nút radio "Ngay bây giờ" được chọn
                if (radio.id === 'default-radio-1' && radio.checked) {
                    // Hiển thị đoạn văn bản ẩn
                    hiddenParagraph.style.display = 'block';
                } else {
                    // Ẩn đoạn văn bản nếu nút radio khác được chọn
                    hiddenParagraph.style.display = 'none';
                }
            });
            radio.addEventListener('change', function() {
                // Kiểm tra xem nút radio "Ngay bây giờ" được chọn
                if (radio.id === 'default-radio-2' && radio.checked) {
                    // Hiển thị đoạn văn bản ẩn
                    day.style.display = 'block';
                } else {
                    // Ẩn đoạn văn bản nếu nút radio khác được chọn
                    day.style.display = 'none';
                }
            });
        });
    });



    const provinceSelect = document.getElementById('provinceSelect');
    const districtSelect = document.getElementById('districtSelect');
    const wardSelect = document.getElementById('wardSelect');

    // Lấy danh sách tỉnh từ API
    fetch('/get-provinces')
        .then(response => response.json())
        .then(data => {
            const provinces = data.provinces;
            provinces.forEach(province => {
                const option = document.createElement('option');
                option.value = province.Id; // Thay 'Id' bằng trường dữ liệu tương ứng trong JSON
                option.text = province.Name;
                option.name = "provinces"; // Thay 'Name' bằng trường dữ liệu tương ứng trong JSON
                provinceSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Lỗi khi lấy danh sách tỉnh: ', error);
        });

    // Xử lý sự kiện khi người dùng chọn tỉnh
    provinceSelect.addEventListener('change', () => {
        const selectedProvinceId = provinceSelect.value;
        if (selectedProvinceId) {
            // Lấy danh sách quận huyện từ API dựa trên tỉnh đã chọn

            fetch(`/get-districts/${selectedProvinceId}`)
                .then(response => response.json())
                .then(data => {
                    // Xóa tất cả các lựa chọn quận huyện trước đó
                    districtSelect.innerHTML = '<option value="">-- Select District --</option>';

                    const districts = data.districts;
                    districts.forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.Id; // Thay 'Id' bằng trường dữ liệu tương ứng trong JSON
                        option.text = district.Name;
                        option.name = "district"; // Thay 'Name' bằng trường dữ liệu tương ứng trong JSON
                        districtSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Lỗi khi lấy danh sách quận huyện: ', error);
                });
        }
    });

    // Xử lý sự kiện khi người dùng chọn quận huyện
    districtSelect.addEventListener('change', () => {
        const selectedDistrictId = districtSelect.value;
        if (selectedDistrictId) {
            // Lấy danh sách xã từ API dựa trên quận huyện đã chọn
            fetch(`/get-wards/${selectedDistrictId}`)
                .then(response => response.json())
                .then(data => {
                    // Xóa tất cả các lựa chọn xã trước đó
                    wardSelect.innerHTML = '<option value="">-- Select Ward --</option>';

                    const wards = data.wards;
                    wards.forEach(ward => {
                        const option = document.createElement('option');
                        option.value = ward.Id; // Thay 'Id' bằng trường dữ liệu tương ứng trong JSON
                        option.text = ward.Name;
                        option.name = "ward";
                        // Thay 'Name' bằng trường dữ liệu tương ứng trong JSON
                        wardSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Lỗi khi lấy danh sách xã: ', error);
                });
        }
    });
</script>