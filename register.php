
<?php
  session_start();
  require_once 'config/database.php';
  spl_autoload_register(function ($className) {
      require_once "app/models/$className.php";
  });
  $userModel = new User();
  if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['confirm_password'])) {
    
    if($_POST['confirm_password'] != $_POST['password']) {
      setcookie("error", "Mật khẩu không trùng khớp", time() + 3600);
    }else {
      echo "hello";
      if($userModel->register($_POST['username'], $_POST['password'], $_POST['email'])) {
        setcookie("success", "Đăng kí tài khoản thành công", time() + 3500);
        header("location: http://localhost/Project_be1_phpgit/login.php");
      }
    }
  }
  

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>K-WD Dashboard | Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../build/css/tailwind.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
  </head>
  <body>
    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden'); setColors(color);" :class="{ 'dark': isDark}">
      <!-- Loading screen -->
      
      <div
        class="flex flex-col items-center justify-center min-h-screen p-4 space-y-4 antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light"
      >
        <!-- Brand -->
        <a
          href="../index.html"
          class="inline-block mb-6 text-3xl font-bold tracking-wider uppercase text-primary-dark dark:text-light"
        >
        PIZZA STORE
        </a>
        <main>
          <div class="w-full max-w-sm px-4 py-6 space-y-6 bg-white rounded-md dark:bg-darker">
            <h1 class="text-xl font-semibold text-center">Register</h1>
            <form action="register.php" method="POST" class="space-y-6">
              <input
                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                type="text"
                name="username"
                placeholder="Username"
                required
              />
              <input
                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                type="email"
                name="email"
                placeholder="Email address"
                required
              />
              <input
                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                type="password"
                name="password"
                placeholder="Password"
                required
              />
              <input
                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                type="password"
                name="confirm_password"
                placeholder="Confirm Password"
                required
              />
              <div class="flex items-center justify-between">
                <!-- Remember me toggle -->
                <label class="flex items-center">
                  <div class="relative inline-flex items-center">
                    <input
                      type="checkbox"
                      name="accept_terms"
                      class="w-10 h-4 transition bg-gray-200 border-none rounded-full shadow-inner outline-none appearance-none  checked:bg-primary-light focus:outline-none"
                    />
                    <span
                      class="absolute top-0 left-0 w-4 h-4 transition-all transform scale-150 bg-white rounded-full shadow-sm"
                    ></span>
                  </div>
                  <span class="ml-3 text-sm font-normal text-gray-500 dark:text-gray-400">
                    I accept the
                    <a href="#" class="text-sm text-blue-600 hover:underline">Terms and Conditions</a>
                  </span>
                </label>
              </div>
              <div>
                <button
                  type="submit"
                  class=" bg-[#006a32] w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md bg-primary  focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker"
                >
                  Register
                </button>
              </div>
            </form>

           

          

            <!-- Login link -->
            <div class="text-sm text-gray-600 dark:text-gray-400">
              Already have an account? <a href="login.html" class="text-blue-600 hover:underline">Login</a>
            </div>
          </div>
        </main>
      </div>
      
    </div>

   
  </body>
</html>
