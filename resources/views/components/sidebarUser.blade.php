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
        
        @php
          // Ambil nama file dari database
          $sidebarLogo = \App\Models\Setting::getValue('sidebar_logo', 'logo_kementan.png');

          // Tentuin path-nya (cek storage, kalau ga ada fallback ke assets)
          $logoPath = \Illuminate\Support\Facades\Storage::disk('public')->exists('cms/' . $sidebarLogo)
              ? Storage::url('cms/' . $sidebarLogo)
              : asset('assets/logo_kementan.png');
      @endphp

      <img src="{{ $logoPath }}" 
          alt="Logo"
          class="w-12 h-12 rounded-full object-cover shadow-sm" />

        <p class="text-white font-bold text-lg leading-tight">
          PERPUSTAKAAN BPMSPH
        </p>
      </div>
    </div>

    <!-- Profil -->
     <ul id="sidebar-menu" class="space-y-3">
  <li class="relative nav-item rounded-l-[50px] hover:bg-white list-none">
  <a href="{{ route('user.profil') }}" class="group relative flex items-center w-full text-[#626F47] transition-all duration-300">

    <div class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
          group-hover:border-transparent group-hover:bg-white">
      <img src="{{ asset('assets/Profile.jpg') }}" alt="Foto Profil"
        class="w-20 h-20 rounded-full border-2 border-[#626F47] object-cover shadow-md" />
      <div class="leading-tight">
        <p class="font-bold text-[#626F47] text-sm">Rifdatul Aisya</p>
        <p class="text-xs opacity-80 -mt-[2px]">Rifdah@gmail.com</p>
      </div>
    </div>
  </a>
</li>

    <!-- Menu -->
  <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
    <a href="{{ route('dashboard') }}" class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
      <div
        class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
        group-hover:border-transparent group-hover:bg-white">
        <span class="iconify text-[#626F47]" data-icon="mdi:view-grid" data-width="32"></span>
        <span class="whitespace-nowrap text-base font-bold">Dashboard</span>
      </div>
    </a>
  </li>

  <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
    <a href="{{ route('user.daftarbuku') }}" class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
      <div
        class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
        group-hover:border-transparent group-hover:bg-white">
        <span class="iconify text-[#626F47]" data-icon="fa-solid:book" data-width="30"></span>
        <span class="whitespace-nowrap text-base font-bold">Buku</span>
      </div>
    </a>
  </li>

  <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
    <a href="{{ route('user.riwayatbuku')}}" class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
      <div
        class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
        group-hover:border-transparent group-hover:bg-white">
        <span class="iconify text-[#626F47]" data-icon="mdi:book-lock" data-width="32"></span>
        <span class="whitespace-nowrap text-base font-bold">Riwayat</span>
      </div>
    </a>
  </li>

  <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
    <a href="{{ route('user.favorit')}}" class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
      <div
        class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
        group-hover:border-transparent group-hover:bg-white">
        <span class="iconify text-[#626F47]" data-icon="mdi:book-heart" data-width="32"></span>
        <span class="whitespace-nowrap text-base font-bold">Favorit</span>
      </div>
    </a>
  </li>

  <li><div class="h-[1px] bg-gray-300 mx-2 rounded"></div></li>

 <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none"> <form action="{{ route('logout') }}" method="POST"> 
  @csrf 
  <button type="submit" class="group relative flex items-center w-full text-red-600 transition-colors duration-300"> <div class="menu-item flex items-center gap-3 rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300"> 
    <i class="fa-solid fa-bookmark text-xl"></i> 
    <span class="whitespace-nowrap text-base font-bold">Logout</span> 
  </div> 
</button> 
</form> 
</li>
  
</ul>
  </div>
 
