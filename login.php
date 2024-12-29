
<?php
  session_start();
  require_once 'config/database.php';
  spl_autoload_register(function ($className) {
      require_once "app/models/$className.php";
  });
  $userModel = new User();
  if(!empty($_POST['username']) && !empty($_POST['password']) ) {
    $user = $userModel->login($_POST['username'], $_POST['password']);
      if($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['userId'] = $user['id'];
        $_SESSION['isLoggedIn'] = true;
        header("location: http://localhost/Project_be1_php");
      }
    
  }
  

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>K-WD Dashboard | Login</title>
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
      <?php if(isset($_COOKIE['success'])) :
        echo $_COOKIE['success'];
        endif ?>
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
            <h1 class="text-xl font-semibold text-center">Login</h1>
            <form action="login.php" method="post" class="space-y-6">

              <input
                class="w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker"
                type="text"
                name="username"
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
              <div class="flex items-center justify-between">
                <!-- Remember me toggle -->
                <label class="flex items-center">
                  <div class="relative inline-flex items-center">
                    
                  </div>
                  <!-- <span class="ml-3 text-sm font-normal text-gray-500 dark:text-gray-400">Remember me</span> -->
                  <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Remember Me
                </label>
            </div>
                </label>

                <a href="forgotPassword.php" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
              </div>
              <div>
                <button
                  type="submit"
                  class="bg-[#006a32] w-full px-4 py-2 font-medium text-center text-white transition-colors duration-200 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 dark:focus:ring-offset-darker"
                >
                  Login
                </button>
              </div>
            </form>
        
            <!-- Or -->
            <div class="flex items-center justify-center space-x-2 flex-nowrap">
              <span class="w-20 h-px bg-gray-300"></span>
              <span>OR</span>
              <span class="w-20 h-px bg-gray-300"></span>
            </div>

            <!-- Social login links -->
            <!-- Brand icons src https://boxicons.com -->
            <a
              href="http://localhost/Project_be1_php/checkout/orderinfo"
              class="flex items-center justify-center px-4 py-2 space-x-2 text-white transition-all duration-200 bg-[#006a32] rounded-md hover:bg-opacity-80 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-1 dark:focus:ring-offset-darker"
            >
             
              <span> Mua Hàng Không Cần Đăng Nhập </span>
            </a>

            <!-- Register link -->
            <div class="text-sm text-gray-600 dark:text-gray-400">
              Don't have an account yet? <a href="register.php" class="text-blue-600 hover:underline">Register</a>
            </div>
          </div>
        </main>
      </div>
      <!-- Toggle dark mode button -->
      <div class="fixed bottom-5 left-5">
        <button
          aria-hidden="true"
          @click="toggleTheme"
          class="p-2 transition-colors duration-200 rounded-full shadow-md bg-primary hover:bg-primary-darker focus:outline-none focus:ring focus:ring-primary"
        >
          <svg
            x-show="isDark"
            class="w-8 h-8 text-white"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
            />
          </svg>
          <svg
            x-show="!isDark"
            class="w-8 h-8 text-white"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
            />
          </svg>
        </button>
      </div>
    </div>



  </body>
</html>
