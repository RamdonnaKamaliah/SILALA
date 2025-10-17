<!-- Tombol Hamburger -->
  <button id="hamburger"
    class="fixed top-4 left-4 z-50 flex flex-col justify-between w-8 h-6 focus:outline-none md:hidden">
    <span class="block w-full h-[3px] bg-[#626F47] rounded transition-all duration-300"></span>
    <span class="block w-full h-[3px] bg-[#626F47] rounded transition-all duration-300"></span>
    <span class="block w-full h-[3px] bg-[#626F47] rounded transition-all duration-300"></span>
  </button>

  <!-- Overlay gelap -->
  <div id="sidebar-overlay"
    class="fixed inset-0 bg-black bg-opacity-40 hidden opacity-0 transition-opacity duration-300 z-40 md:hidden"></div>

  <!-- Sidebar -->
  <div id="sidebar"
    class="fixed w-[300px] h-full bg-[var(--green)] border-l-[10px] border-[var(--green)] transition-all duration-500 overflow-hidden transform -translate-x-full md:translate-x-0 z-50 sidebar">
    
    <!-- Header -->
    <div class="flex items-center justify-between px-4 mt-4 mb-6 text-white">
      <div class="flex items-center gap-2">
        <img src="{{asset('assets/logo_kementan.png')}}" alt="Logo" class="w-12 h-12 rounded-full object-cover" />
        <p class="text-white font-bold text-lg leading-tight">
          PERPUSTAKAAN BPMSPH
        </p>
      </div>
    </div>

    <!-- Profil -->
    <div class="mx-3 mb-8 border rounded-full p-2 flex items-center gap-3 bg-[#F5ECD5] profile-card relative z-10 shadow-sm">
      <img src="{{ asset('assets/Profile.jpg') }}" alt="Foto Profil"
        class="w-20 h-20 rounded-full border-2 border-[#626F47] object-cover shadow-md" />
      <div class="text-[#626F47] leading-tight pr-3">
        <p class="font-semibold text-[#626F47]">Rifdatul Aisya</p>
        <p class="text-sm opacity-80">Rifdah@gmail.com</p>
      </div>
    </div>

    <!-- Menu -->
    <ul id="sidebar-menu" class="space-y-3">
  <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
    <a href="#" class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
      <div
        class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start shadow-md transition-all duration-300
        group-hover:border-transparent group-hover:bg-white">
        <i class="fa-solid fa-chart-line text-xl"></i>
        <span class="whitespace-nowrap text-base font-bold">Dashboard</span>
      </div>
    </a>
  </li>

  <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
    <a href="#" class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
      <div
        class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start shadow-md transition-all duration-300
        group-hover:border-transparent group-hover:bg-white">
        <i class="fa-solid fa-book text-xl"></i>
        <span class="whitespace-nowrap text-base font-bold">Buku</span>
      </div>
    </a>
  </li>

  <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
    <a href="#" class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
      <div
        class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start shadow-md transition-all duration-300
        group-hover:border-transparent group-hover:bg-white">
        <i class="fa-solid fa-clock-rotate-left text-xl"></i>
        <span class="whitespace-nowrap text-base font-bold">Riwayat</span>
      </div>
    </a>
  </li>

  <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
    <a href="#" class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
      <div
        class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start shadow-md transition-all duration-300
        group-hover:border-transparent group-hover:bg-white">
        <i class="fa-solid fa-bookmark text-xl"></i>
        <span class="whitespace-nowrap text-base font-bold">Favorit</span>
      </div>
    </a>
  </li>

  <li><div class="h-[1px] bg-gray-300 mx-2 rounded"></div></li>

  <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
    <form method="POST" action="{{ route('logout') }}" class="w-full">
      @csrf
      <button type="submit"
        class="relative flex items-center w-full text-red-600 hover:text-[var(--green)] transition-colors duration-300">
        <span class="block min-w-[60px] h-[60px] leading-[60px] text-center text-xl">
          <i class="fa-solid fa-gear"></i>
        </span>
        <span class="block px-[10px] h-[60px] leading-[60px] whitespace-nowrap">
          Logout
        </span>
      </button>
    </form>
  </li>
</ul>
  </div>
