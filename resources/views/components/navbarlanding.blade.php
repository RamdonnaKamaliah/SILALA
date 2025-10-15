 <!-- Navbar -->
  <header class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full px-4">
    <div class="flex items-center justify-between md:justify-center">
      
      <!-- Hamburger -->
      <button id="hamburger" class="md:hidden w-8 h-8 flex flex-col justify-center items-center">
        <span class="block w-5 h-0.5 bg-gray-800 dark:bg-white mb-1.5 rounded transition-all"></span>
        <span class="block w-5 h-0.5 bg-gray-800 dark:bg-white mb-1.5 rounded transition-all"></span>
        <span class="block w-5 h-0.5 bg-gray-800 dark:bg-white rounded transition-all"></span>
      </button>

      <!-- Navbar desktop -->
      <nav
        class="relative hidden md:flex items-center space-x-8 text-base font-semibold
               bg-white text-gray-800 
               shadow-md rounded-full px-10 py-4 border border-gray-200 dark:border-gray-700
               backdrop-blur-md transition-all duration-300 ease-in-out">

        <a href="/" class="nav-link hover:text-green-500 transition-colors">Beranda</a>
        <a href="#tentang" class="nav-link hover:text-green-500 transition-colors">Tentang</a>
        <a href="#rekomendasi" class="nav-link hover:text-green-500 transition-colors">Rekomendasi</a>
        <a href="#panduan" class="nav-link hover:text-green-500 transition-colors">Panduan</a>

        @auth
        <a href="{{ url('/dashboard') }}" class="nav-link hover:text-green-500">Dashboard</a>
        @else
        <a href="{{ route('register') }}" class="nav-link hover:text-green-500">Register</a>
        <a href="{{ route('login') }}" class="nav-link text-blue-500 dark:text-[#1DA1F2] hover:text-green-500">Login</a>
        @endauth
      </nav>

      <!-- Theme toggle -->
      <button id="toggle-theme"
        class="w-10 h-10 ml-4 flex items-center justify-center bg-white rounded-full shadow 
               hover:bg-gray-300 transition-colors duration-200">
        <i class="fas fa-sun text-yellow-500 text-lg"></i>
        <i class="fas fa-moon text-[#192734] text-lg hidden"></i>
      </button>
    </div>
  </header>

  <!-- Overlay -->
  <div id="sidebar-overlay"
    class="sidebar-overlay fixed inset-0 bg-black bg-opacity-40 z-40 md:hidden opacity-0 pointer-events-none transition-opacity duration-300"></div>

  <!-- Sidebar -->
<aside id="sidebar"
  class="sidebar fixed top-0 left-0 h-full w-64 
         bg-white dark:bg-[#192734] 
         text-gray-800 dark:text-gray-100 
         shadow-2xl z-50 md:hidden 
         transform -translate-x-full 
         transition-transform duration-300 ease-in-out">

  <!-- Header -->
  <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
    <span class="font-bold text-lg">Menu</span>
    <button id="closeSidebar" class="text-2xl hover:text-green-400 transition-colors">&times;</button>
  </div>

  <!-- Navigation -->
  <nav class="p-4 space-y-2">
    <ul class="space-y-2">

      <li>
        <a href="/" 
          class="flex items-center px-4 py-3 rounded-lg font-semibold transition-all duration-300 
                 hover:bg-gray-100 dark:hover:bg-[#22303C]
                 hover:shadow-md hover:scale-[1.03]
                 dark:hover:shadow-[0_0_10px_#39FF14]">
          <i class="fas fa-home mr-3"></i>Beranda
        </a>
      </li>

      <li>
        <a href="#tentang" 
          class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 
                 hover:bg-gray-100 dark:hover:bg-[#22303C]
                 hover:shadow-md hover:scale-[1.03]
                 dark:hover:shadow-[0_0_10px_#39FF14]">
          <i class="fas fa-info-circle mr-3"></i>Tentang
        </a>
      </li>

      <li>
        <a href="#rekomendasi" 
          class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 
                 hover:bg-gray-100 dark:hover:bg-[#22303C]
                 hover:shadow-md hover:scale-[1.03]
                 dark:hover:shadow-[0_0_10px_#39FF14]">
          <i class="fas fa-book mr-3"></i>Rekomendasi
        </a>
      </li>

      <li>
        <a href="#panduan" 
          class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 
                 hover:bg-gray-100 dark:hover:bg-[#22303C]
                 hover:shadow-md hover:scale-[1.03]
                 dark:hover:shadow-[0_0_10px_#39FF14]">
          <i class="fas fa-question-circle mr-3"></i>Panduan
        </a>
      </li>
    </ul>

    <!-- Auth Links -->
    <div class="border-t border-gray-200 dark:border-gray-700 mt-6 pt-4 space-y-2">
      @auth
      <a href="{{ url('/dashboard') }}" 
         class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 
                hover:bg-gray-100 dark:hover:bg-[#22303C]
                hover:shadow-md hover:scale-[1.03]
                dark:hover:shadow-[0_0_10px_#39FF14]">
        <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
      </a>
      @else
      <a href="{{ route('register') }}" 
         class="flex items-center px-4 py-3 rounded-lg font-medium transition-all duration-300 
                hover:bg-gray-100 dark:hover:bg-[#22303C]
                hover:shadow-md hover:scale-[1.03]
                dark:hover:shadow-[0_0_10px_#39FF14]">
        <i class="fas fa-user-plus mr-3"></i>Register
      </a>
      <a href="{{ route('login') }}" 
         class="flex items-center px-4 py-3 rounded-lg font-medium text-blue-500 dark:text-[#1DA1F2] transition-all duration-300 
                hover:bg-gray-100 dark:hover:bg-[#22303C]
                hover:shadow-md hover:scale-[1.03]
                dark:hover:shadow-[0_0_10px_#39FF14]">
        <i class="fas fa-sign-in-alt mr-3"></i>Login
      </a>
      @endauth
    </div>
  </nav>
</aside>
