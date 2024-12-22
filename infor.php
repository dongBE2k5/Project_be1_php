<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <section >
        
        <div class="container mx-auto">
            <div class="md:flex">
                <div>
                    <div>
                        <div class=" m-3  shadow-2xl rounded-xl  ">
                            <div class="box1 bg-white w-full  rounded-xl">
                                <h1 class="p-3 text-xl font-bold border-b-[1px] border-black-500">Thông Tin Nhận Hàng</h1>
                                <h1 class="px-3 pt-3 pb-2 text-[#006a32] font-bold" >Giao hàng tới <span class="text-red-500 font-bold"> - Donguyentoan - 0344842232</span></h1>
                                <p class="px-3 pb-2">Tổ Dân Phố 12 Thị Trấn Pongdrang krongbuk DakLak Tổ Dân Phố 12 Thị Trấn Pongdrang krongbuk DakLak</p>
                                <p class="px-3 font-bold">Hướng dẫn cho nhân viên giao hàng</p>
                                <textarea class="mx-3 border-[1px] border-black-500 w-11/12" name="" id="" cols="50" rows="5" placeholder="Nội dung....."></textarea>
                                <h1 class="px-3 pt-3 pb-2 text-[#006a32] font-bold" >Thời gian nhận hàng dữ kiến <span class="text-red-500 font-bold">- 5/10/2023 17:05</span></h1>

                            </div>
                        </div>
                        <div class=" m-3  shadow-2xl rounded-xl  ">
                            <div class="box2 bg-white rounded-xl">
                                <h1 class="p-3 text-xl font-bold border-b-[1px] border-black-500">Phương thức thanh toán</h1>
                                <h1 class="px-3 pt-3 pb-2 text-[#006a32] font-bold" >Phương thức thanh toán</h1>
                            </div>
                            <form action="/checkout/receivingIformation" method="post">
                            @csrf
                                <div class="box-item">
                                    <div class="p-4 flex items-center justify-between border border-black-500 ">
                                        <div class="flex items-center ">
                                        
                                        
                                            <input
                                            class=" relative float-left  mr-1 mt-0.5 h-5 w-5 appearance-none rounded-full border-2 border-solid border-neutral-300 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:border-neutral-600 dark:checked:border-primary dark:checked:after:border-primary dark:checked:after:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:border-primary dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"
                                            type="radio"
                                            name="payment_method"
                                            value="cod"
                                            id="radioDefault01" />
                                            <img class="w-28" src="/image/cod.jpeg" alt="">
                
                                        
                                        </div>
                                    <h1>Thanh Toán Khi Nhận Hàng  </h1>
                                    
                                    </div>
                                    <div class="p-4 flex items-center justify-between  border border-black-500">
                                        <div class="flex items-center ">
                                        
                                        
                                            <input
                                            class="relative float-left  mr-1 mt-0.5 h-5 w-5 appearance-none rounded-full border-2 border-solid border-neutral-300 before:pointer-events-none before:absolute before:h-4 before:w-4 before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] after:absolute after:z-[1] after:block after:h-4 after:w-4 after:rounded-full after:content-[''] checked:border-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:left-1/2 checked:after:top-1/2 checked:after:h-[0.625rem] checked:after:w-[0.625rem] checked:after:rounded-full checked:after:border-primary checked:after:bg-primary checked:after:content-[''] checked:after:[transform:translate(-50%,-50%)] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:border-primary checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:border-neutral-600 dark:checked:border-primary dark:checked:after:border-primary dark:checked:after:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:border-primary dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"
                                            type="radio"
                                            name="payment_method"
                                            value="vnpay"
                                            id="radioDefault01" />
                                            <img class="w-28" src="/image/vnpay.png" alt="">  
                                            
                                        </div>
                                    <h1>Thanh Toán VN Pay </h1>
                                    
                                    </div>
                                
                                </div>
                                
                                
                                </div>  
                            
                                
                       

                        </div>
                    </div>

                        
                  
                    <div class="md:w-1/3  w-11/12 ">
                        <div class="m-3  w-full shadow-2xl rounded-xl  ">
                            <div class="box1 bg-white w-full rounded-xl p-3 ">
                                <h1 class="p-3 text-xl font-bold border-b-[1px] border-black-500">Đơn Hàng Của Bạn</h1>
                                <div class="order">
                                    <div class="flex justify-between pt-3">
                                    <p class="text-lg font-medium">Pizza Hải Sản Cao Cấp</p>
                                    <span class="text-sm">x1</span>

                                    </div>
                              
                                    <p> <span class="text-lg font-medium">Kích thước :</span> nhỏ</p>
                                    <p> <span class="text-lg font-medium">Đế :</span> Dày</p>
                                    <div class="flex pb-4 justify-end border-b-[1px] border-black-500">
                                        <p class="text-lg font-medium ">149.000đ</p>
                                    </div>

                                </div>
                         
                           
 
                               
                                <div class="border-b border-black-500 py-3">
                                    <div class="flex justify-between">
                                        <p class="text-sm">Tạm Tính</p>
                                        <p class="text-lg font-medium ">0đ</p>
                                    </div>
                                    <div class="flex justify-between">
                                        <p class="text-sm">Phụ Thu</p>
                                        <p class="text-lg font-medium ">0đ</p>
                                    </div>
                                    <div class="flex justify-between">
                                        <p class="text-sm">Giảm Giá</p>
                                        <p class="text-lg font-medium ">0đ</p>
                                    </div>
                                    <div class="flex justify-between">
                                        <p class="text-sm">Thuế</p>
                                        <p class="text-lg font-medium ">0đ</p>
                                    </div>
                                    <div class="flex justify-between">
                                        <p class="text-sm">Phí Giao Hàng</p>
                                        <p class="text-lg font-medium ">25.000đ</p>
                                    </div>

                                </div>
                                <div class="flex justify-between pt-3">
                                    <p class="text-lg font-medium">Tổng Tiền</p>
                                    <p id="total_price" class="text-lg font-medium  ">25.000đ</p>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
            </div>
            <div class=" md:w-2/3 w-full ml-3 p-2 py-5 md:flex justify-end">
                   
                    <input type="hidden" id="totalOrder" name="totalOrder" value="">
                    <input type="hidden" id="miniCartData"  name="miniCartData" value="">
                    <input type="submit" class="md:w-full  w-11/12 bg-gradient-to-r from-cyan-500 to-blue-500 px-20 py-2 rounded-lg md:ml-2 mt-2   " value="Quay Về">
                    <input type="submit" class="md:w-full w-11/12 bg-gradient-to-r from-cyan-500 to-blue-500 px-20 py-2 rounded-lg md:ml-2 mt-2 " value="Thanh Toán">
              
            </div>
            </form>
           
        </div>
    </section>
</body>
</html>