<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @include('layout_dashboard.partial_dashboard.link')
  <title>SILALA</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('assets_user/css/dashboard.css') }}">
  <style>
    :root {
      --green: #A4B465;
      --white: #ffffff;
    }

    /* Hover efek melengkung kanan */
    .nav-item:hover a::before {
      content: '';
      position: absolute;
      right: 0;
      top: -50px;
      width: 50px;
      height: 50px;
      border-radius: 9999px;
      background-color: var(--green);
      box-shadow: 35px 35px 0 10px var(--white);
      pointer-events: none;
    }

    .nav-item:hover a::after {
      content: '';
      position: absolute;
      right: 0;
      bottom: -50px;
      width: 50px;
      height: 50px;
      border-radius: 9999px;
      background-color: var(--green);
      box-shadow: 35px -35px 0 10px var(--white);
      pointer-events: none;
    }

   .menu-item.active {
  background-color: #ffffff !important;  /* warna dasar putih */
  border-color: #ffffff !important;       /* border putih */
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);  /* sedikit bayangan biar menonjol */
  color: #626F47 !important;              /* warna teks hijau tua */
  transform: scale(1.02);                 /* sedikit efek klik */
}

.menu-item.active i,
.menu-item.active span {
  color: #626F47 !important;
}

.menu-item:hover {
  background-color: #ffffff;
  border-color: #ffffff;
  transition: all 0.3s ease;
}



    .sidebar {
      transition: transform 0.4s ease, opacity 0.4s ease;
    }
 
  #hamburger {
  transition: all 0.3s ease;
  z-index: 50;
}
#hamburger span {
  transform-origin: center; /* biar rotasi X seimbang */
}
#hamburger.open span:nth-child(1) {
  transform: rotate(45deg) translate(4px, 4px);
}
#hamburger.open span:nth-child(2) {
  opacity: 0;
}
#hamburger.open span:nth-child(3) {
  transform: rotate(-45deg) translate(4px, -4px);
}

/* Efek navbar menggelap di mobile saat sidebar muncul */
.navbar-dim {
  background-color: rgba(247, 237, 214, 0.6) !important;
  backdrop-filter: brightness(0.8) blur(2px);
}

  </style>
</head>

<body class="min-h-screen overflow-hidden font-[Ubuntu,sans-serif] bg-white">
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
            class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start shadow-md transition-all duration-300 group-hover:bg-white group-hover:border-white">
            <i class="fa-solid fa-chart-line text-xl"></i>
            <span class="whitespace-nowrap text-base font-bold">Dashboard</span>
          </div>
        </a>
      </li>

      <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
        <a href="#" class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
          <div
            class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start shadow-md transition-all duration-300 group-hover:bg-white group-hover:border-white">
            <i class="fa-solid fa-book text-xl"></i>
            <span class="whitespace-nowrap text-base font-bold">Buku</span>
          </div>
        </a>
      </li>

      <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
        <a href="#" class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
          <div
            class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start shadow-md transition-all duration-300 group-hover:bg-white group-hover:border-white">
            <i class="fa-solid fa-lock ml-[-6px] text-[10px]"></i>
            <span class="whitespace-nowrap text-base font-bold">Riwayat</span>
          </div>
        </a>
      </li>

      <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
        <a href="#" class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
          <div
            class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start shadow-md transition-all duration-300 group-hover:bg-white group-hover:border-white">
            <i class="fa-solid fa-heart ml-[-6px] text-[10px]"></i>
            <span class="whitespace-nowrap text-base font-bold">Favorit</span>
          </div>
        </a>
      </li>

      <!-- Garis pembatas -->
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

<!-- Navbar -->
<nav id="navbar"
  class="fixed top-0 left-0 md:left-[320px] right-0 md:right-3 z-40 bg-[#f7edd6]
  rounded-b-3xl shadow-sm flex justify-between items-center
  px-4 md:px-6 py-4 md:py-6 transition-all duration-300">

  <!-- Judul -->
  <h1
    class="absolute left-1/2 transform -translate-x-1/2 text-lg md:text-xl font-semibold text-[#626F47]
    md:static md:transform-none md:translate-x-0">
    Dashboard
  </h1>

  <div class="flex items-center gap-4 ml-auto relative">
<!-- Notifikasi -->
<div class="relative">
  <button id="notifBtn" class="text-[#626F47] text-lg focus:outline-none">
    <i class="fa-solid fa-bell"></i>
  </button>

  <!-- Popup Notifikasi kecil -->
  <div id="notifBox"
    class="absolute right-0 mt-2 w-56 max-h-64 overflow-y-auto bg-white border border-gray-200 shadow-lg rounded-xl p-3 z-50
    transition-all duration-500 transform opacity-0 -translate-y-1 pointer-events-none">
    
    <div class="flex items-center justify-between mb-2">
      <h3 class="text-sm font-semibold text-[#626F47]">Notifikasi</h3>
      <button id="closeNotif" class="text-gray-400 hover:text-gray-700 text-xs transition-colors">✕</button>
    </div>

    <div class="space-y-1">
      <div class="bg-[#f7edd6] p-2 rounded-lg hover:bg-[#e2dfc6] transition-colors cursor-pointer shadow-sm">
        <p class="font-semibold text-[#626F47] text-sm">Admin</p>
        <p class="text-xs">Buku <b>Buku Saku</b> berhasil disimpan oleh Wildan.</p>
        <span class="text-[9px] text-gray-500">1 menit yang lalu</span>
      </div>

      <div class="bg-[#f7edd6] p-2 rounded-lg hover:bg-[#e2dfc6] transition-colors cursor-pointer shadow-sm">
        <p class="font-semibold text-[#626F47] text-sm">Sistem</p>
        <p class="text-xs">Perpustakaan diperbarui ke versi terbaru.</p>
        <span class="text-[9px] text-gray-500">10 menit yang lalu</span>
      </div>

      <!-- Bisa tambahkan notif lain -->
      <div class="bg-[#f7edd6] p-2 rounded-lg hover:bg-[#e2dfc6] transition-colors cursor-pointer shadow-sm">
        <p class="font-semibold text-[#626F47] text-sm">Admin</p>
        <p class="text-xs">Notifikasi tambahan untuk testing scroll.</p>
        <span class="text-[9px] text-gray-500">15 menit yang lalu</span>
      </div>
    </div>
  </div>
</div>

    <!-- Pengaturan -->
    <button class="text-[#626F47] text-lg">
      <i class="fa-solid fa-gear"></i>
    </button>
  </div>
</nav>

<!-- Konten Utama Dashboard -->
<main
  class="pt-8 pb-14 px-6 bg-[#F5ECD5] min-h-screen overflow-y-auto
  absolute top-[90px] left-0 right-0 bottom-0 md:left-[320px] md:right-3 md:rounded-t-3xl 
  transition-all duration-300 z-30">

 <!-- Kartu Sambutan --> 
<section class="relative bg-gradient-to-r from-[#626F47] to-[#A4B465] text-white px-3 py-3 md:px-10 md:py-2 rounded-2xl shadow-md flex items-center justify-between overflow-hidden"> 

  <!-- Bintang kiri atas -->
  <img src="{{ asset('assets/logo_bintang.png') }}" alt="star" class="absolute top-2 left-6 w-6 md:w-8 opacity-90 z-20">  

  <!-- Bintang kanan atas -->
  <img src="{{ asset('assets/logo_bintang.png') }}" alt="star" class="absolute top-2 right-6 w-6 md:w-8 opacity-90 z-20"> 

 <!-- Teks sambutan -->
<div class="z-10">
  <!-- Judul dengan font Mochiy Pop One khusus "Hallo Rifdah" -->
  <h2 class="text-2xl md:text-4xl font-medium text-[#F7EDD6] font-mochiy">
    Hallo Rifdah,
  </h2> 

  <!-- Paragraf dengan emoji HD -->
  <p class="text-base md:text-lg mt-1 text-[#F7EDD6]/90">
    Selamat datang di perpustakaan BPMSPH.<br> 
    Mari jelajahi dunia lewat membaca 
    <img src="{{ asset('assets/emoji_bumi.png') }}" alt="Globe" class="inline w-5 h-5 md:w-6 md:h-6">
  </p> 
</div>

  <!-- Gambar buku -->
  <div class="z-10 w-32 md:w-40 lg:w-48 relative"> 
    <img src="{{ asset('assets/logo_buku.png') }}" alt="Welcome" class="w-full drop-shadow-lg"> 
  </div> 

  <!-- Efek lembut -->
  <div class="absolute inset-0 bg-gradient-to-r from-[#A4B465]/20 to-transparent backdrop-blur-[1px] rounded-2xl"></div> 
</section>

<!-- Bacaan Anda -->
<section class="mt-6">
  <h2 class="text-lg md:text-xl font-semibold text-[#626F47] mb-4 ml-2">Bacaan Anda</h2>

  <!-- Container buku - 3 card sejajar -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    
    <!-- Card Buku 1 -->
    <div class="flex items-start bg-transparent p-3 hover:scale-[1.03] transition-transform duration-300">
      <!-- Cover Buku -->
      <div class="relative w-32 h-44 flex-shrink-0">
        <div class="absolute inset-0 bg-gradient-to-r from-[#00000020] to-transparent rounded-lg shadow-md"></div>
        <img src="{{ asset('assets/buku1.jpg') }}" alt="Buku 1"
             class="w-full h-full object-cover rounded-lg shadow-lg border border-[#e6e6e6]">
        <!-- Efek sisi buku -->
        <div class="absolute right-0 top-0 w-1 h-full bg-[#d1cfcf] rounded-r-lg"></div>
      </div>

      <!-- Info Buku -->
      <div class="ml-4 flex flex-col justify-between h-full">
        <div>
          <h3 class="font-bold text-[#1E1E1E] text-base leading-snug">Statistika Peternakan</h3>
          <p class="text-sm text-gray-600 mb-2">By Indah Hanaco</p>

          <!-- Bintang rating -->
          <div class="flex text-yellow-400 text-sm space-x-1 mb-2">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star-half-stroke"></i>
            <i class="fa-regular fa-star"></i>
          </div>
        </div>

        <button class="bg-[#626F47] text-white text-xs px-5 py-1.5 rounded-full hover:bg-[#4e5d38] transition w-fit">
          Baca
        </button>
      </div>
    </div>

    <!-- Card Buku 2 -->
    <div class="flex items-start bg-transparent p-3 hover:scale-[1.03] transition-transform duration-300">
      <!-- Cover Buku -->
      <div class="relative w-32 h-44 flex-shrink-0">
        <div class="absolute inset-0 bg-gradient-to-r from-[#00000020] to-transparent rounded-lg shadow-md"></div>
        <img src="{{ asset('assets/buku2.jpg') }}" alt="Buku 2"
             class="w-full h-full object-cover rounded-lg shadow-lg border border-[#e6e6e6]">
        <div class="absolute right-0 top-0 w-1 h-full bg-[#d1cfcf] rounded-r-lg"></div>
      </div>

      <!-- Info Buku -->
      <div class="ml-4 flex flex-col justify-between h-full">
        <div>
          <h3 class="font-bold text-[#1E1E1E] text-base leading-snug">Buku Saku Pelaksanaan KIE</h3>
          <p class="text-sm text-gray-600 mb-2">By J. Anderson</p>

          <!-- Bintang rating -->
          <div class="flex text-yellow-400 text-sm space-x-1 mb-2">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
          </div>
        </div>

        <button class="bg-[#626F47] text-white text-xs px-5 py-1.5 rounded-full hover:bg-[#4e5d38] transition w-fit">
          Baca
        </button>
      </div>
    </div>

    <!-- Card Buku 3 -->
    <div class="flex items-start bg-transparent p-3 hover:scale-[1.03] transition-transform duration-300">
      <!-- Cover Buku -->
      <div class="relative w-32 h-44 flex-shrink-0">
        <div class="absolute inset-0 bg-gradient-to-r from-[#00000020] to-transparent rounded-lg shadow-md"></div>
        <img src="{{ asset('assets/buku3.jpg') }}" alt="Buku 3"
             class="w-full h-full object-cover rounded-lg shadow-lg border border-[#e6e6e6]">
        <div class="absolute right-0 top-0 w-1 h-full bg-[#d1cfcf] rounded-r-lg"></div>
      </div>

      <!-- Info Buku -->
      <div class="ml-4 flex flex-col justify-between h-full">
        <div>
          <h3 class="font-bold text-[#1E1E1E] text-base leading-snug">Budi Daya Peternakan</h3>
          <p class="text-sm text-gray-600 mb-2">By J. Anderson</p>

          <!-- Bintang rating -->
          <div class="flex text-yellow-400 text-sm space-x-1 mb-2">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
          </div>
        </div>

        <button class="bg-[#626F47] text-white text-xs px-5 py-1.5 rounded-full hover:bg-[#4e5d38] transition w-fit">
          Baca
        </button>
      </div>
    </div>

  </div>
</section>

</main>


<script>
 const menuItems = document.querySelectorAll("#sidebar-menu .menu-item");

menuItems.forEach(item => {
  item.addEventListener("click", () => {
    // hapus 'active' dari semua menu-item
    menuItems.forEach(el => el.classList.remove("active"));

    // tambahkan ke menu yang diklik
    item.classList.add("active");
  });
});


  const hamburger = document.getElementById("hamburger");
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("sidebar-overlay");
  const navbar = document.getElementById("navbar"); // ✅ pastikan ini ada!

  hamburger.addEventListener("click", () => {
    const isHidden = sidebar.classList.contains("-translate-x-full");

    if (isHidden) {
      // Buka sidebar
      sidebar.classList.remove("-translate-x-full");
      overlay.classList.remove("hidden");
      setTimeout(() => overlay.classList.add("opacity-100"), 10);

      // Navbar ikut menggelap (khusus mobile)
      navbar.classList.add("navbar-dim");

      // Ubah jadi X dan posisikan di kanan sidebar
      hamburger.classList.add("open");
      hamburger.style.position = "fixed";
      hamburger.style.left = "295px";
      hamburger.style.top = "16px";
      hamburger.style.zIndex = "9999";
    } else {
      // Tutup sidebar
      sidebar.classList.add("-translate-x-full");
      overlay.classList.remove("opacity-100");
      setTimeout(() => overlay.classList.add("hidden"), 300);

      // Navbar kembali normal
      navbar.classList.remove("navbar-dim");

      hamburger.classList.remove("open");
      hamburger.style.position = "";
      hamburger.style.left = "";
      hamburger.style.top = "";
      hamburger.style.zIndex = "";
    }
  });

  overlay.addEventListener("click", () => {
    sidebar.classList.add("-translate-x-full");
    overlay.classList.remove("opacity-100");
    setTimeout(() => overlay.classList.add("hidden"), 300);

    navbar.classList.remove("navbar-dim");

    hamburger.classList.remove("open");
    hamburger.style.position = "";
    hamburger.style.left = "";
    hamburger.style.top = "";
    hamburger.style.zIndex = "";
  });

  //notivication
  const notifBtn = document.getElementById('notifBtn');
const notifBox = document.getElementById('notifBox');
const closeNotif = document.getElementById('closeNotif');

function showNotif() {
  notifBox.classList.remove('opacity-0', '-translate-y-1', 'pointer-events-none');
  notifBox.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
}

function hideNotif() {
  notifBox.classList.add('opacity-0', '-translate-y-1', 'pointer-events-none');
  notifBox.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
}

notifBtn.addEventListener('click', (e) => {
  e.stopPropagation();
  if (notifBox.classList.contains('opacity-0')) {
    showNotif();
  } else {
    hideNotif();
  }
});

closeNotif.addEventListener('click', hideNotif);

document.addEventListener('click', (e) => {
  if (!notifBox.contains(e.target) && !notifBtn.contains(e.target)) {
    hideNotif();
  }
});

</script>


</body>
</html>
