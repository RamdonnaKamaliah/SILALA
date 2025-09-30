<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Animasi hamburger menu */
        .hamburger-line {
            transition: all 0.3s ease;
        }
        
        .hamburger-active > span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }
        
        .hamburger-active > span:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger-active > span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }
        
        /* Animasi sidebar */
        .sidebar {
            transform: translateX(-100%);
            transition: transform 0.4s ease-in-out;
        }
        
        .sidebar-open {
            transform: translateX(0);
        }
        
        /* Overlay untuk sidebar */
        .sidebar-overlay {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        
        .sidebar-overlay-open {
            opacity: 1;
            visibility: visible;
        }
        
        /* Efek backdrop blur untuk sidebar */
        .backdrop-blur-sidebar {
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }
        
        /* Menambahkan padding untuk konten agar tidak tertutup navbar */
        .content-padding {
            padding-top: 100px;
        }
        
        /* Menyesuaikan layout untuk mobile */
        @media (max-width: 768px) {
            .hero-image {
                width: 200px !important;
                height: auto;
            }
            
            .card-flex {
                flex-direction: column !important;
            }
            
            .card-label {
                order: 2;
                margin-top: 1rem;
                align-self: center;
            }
            
            .card-content {
                order: 1;
            }
            
            .footer-grid {
                grid-template-columns: 1fr !important;
                gap: 2rem !important;
            }
            
            /* Menyembunyikan logo di navbar mobile */
            .mobile-logo {
                display: none;
            }
            
            /* Mengatur ukuran navbar mobile */
            .mobile-navbar {
                width: auto;
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans text-slate-700">

    <!-- Navbar Responsif -->
<header class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full px-4">
  <div class="flex items-center justify-between md:justify-center">
    
    <!-- HAMBURGER (mobile only) -->
    <button id="hamburger" class="md:hidden w-8 h-8 flex flex-col justify-center items-center">
      <span class="hamburger-line block w-5 h-0.5 bg-gray-700 mb-1.5"></span>
      <span class="hamburger-line block w-5 h-0.5 bg-gray-700 mb-1.5"></span>
      <span class="hamburger-line block w-5 h-0.5 bg-gray-700"></span>
    </button>

    <!-- NAVBAR (desktop only) -->
    <nav class="relative hidden md:flex items-center space-x-8 text-base font-semibold bg-white shadow-md rounded-full px-8 py-4">
      <a href="/" class="relative nav-link after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-green-600 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">
  Beranda
</a>
<a href="#tentang" class="relative nav-link after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-green-600 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">
  Tentang
</a>
      <a href="#rekomendasi" class="relative nav-link after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-green-600 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">
  Rekomendasi
</a>
<a href="#Panduan" class="relative nav-link after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-green-600 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">
  Panduan
</a>
      @auth
        <a href="{{ url('/dashboard') }}" class="relative nav-link after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-green-600 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">Dashboard</a>
      @else
        <a href="{{ route('register') }}" class="relative nav-link after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-green-600 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300">Register</a>
        <a href="{{ route('login') }}" class="relative nav-link after:content-[''] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-green-600 after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:duration-300 text-blue-500">Login</a>
      @endauth
    </nav>

    <!-- Toggle Theme -->
    <button id="toggle-theme" class="w-10 h-10 ml-4 flex items-center justify-center bg-gray-100 rounded-full shadow hover:bg-gray-200 transition-colors duration-200">
      <i class="fas fa-sun text-yellow-500 text-lg dark:hidden"></i>
      <i class="fas fa-moon text-gray-700 text-lg hidden dark:inline"></i>
    </button>
  </div>
</header>

    <!-- Sidebar Mobile -->
    <div id="sidebar-overlay" class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"></div>
    
    <aside id="sidebar" class="sidebar fixed top-0 left-0 h-full w-64 bg-[#21260D] shadow-lg z-50 md:hidden">
        <!-- Header Sidebar -->
        <div class="p-6 border-b border-gray-200"></div>
        
        <!-- Menu Sidebar -->
        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="/" class="flex items-center px-4 py-3 text-white bg-green-50 rounded-lg font-semibold transition-colors duration-200">
                        <i class="fas fa-home mr-3"></i>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="#tentang" class="flex items-center px-4 py-3 text-white hover:bg-gray-100 rounded-lg font-medium transition-colors duration-200">
                        <i class="fas fa-info-circle mr-3"></i>
                        Tentang
                    </a>
                </li>
                <li>
                    <a href="#rekomendasi" class="flex items-center px-4 py-3 text-white hover:bg-gray-100 rounded-lg font-medium transition-colors duration-200">
                        <i class="fas fa-book mr-3"></i>
                        Rekomendasi
                    </a>
                </li>
                <li>
                    <a href="#panduan" class="flex items-center px-4 py-3 text-white hover:bg-gray-100 rounded-lg font-medium transition-colors duration-200">
                        <i class="fas fa-question-circle mr-3"></i>
                        Panduan
                    </a>
                </li>
                
                <!-- Auth Links untuk Mobile -->
                <div class="border-t border-gray-200 mt-4 pt-4">
                    @auth
                        <li>
                            <a href="{{ url('/dashboard') }}" class="flex items-center px-4 py-3 text-white hover:bg-gray-100 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('register') }}" class="flex items-center px-4 py-3 text-white hover:bg-gray-100 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-user-plus mr-3"></i>
                                Register
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class="flex items-center px-4 py-3 text-blue-500 hover:bg-blue-50 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-sign-in-alt mr-3"></i>
                                Login
                            </a>
                        </li>
                    @endauth
                </div>
            </ul>
        </nav>
    </aside>

    <!-- Hero Section -->
    <section class="pt-24 md:pt-32 pb-32 md:pb-40 relative bg-cover bg-center hero-section" 
  style="background-image: url('{{ asset('assets/background.png') }}');">
  <div class="max-w-5xl mx-auto flex flex-col items-center text-center px-4 md:px-6">
    
    <!-- Judul + Icon -->
    <h1 class="flex items-center justify-center responsive-heading md:text-4xl font-Inknut font-bold text-black">
      <span class="mr-2">
        <img src="{{ asset('assets/logo 1.png') }}" alt="Ilustrasi Buku" class="w-10 h-10 md:w-12 md:h-12">
      </span> 
      Perpustakaan
    </h1>

    <!-- BPMSPH + Deskripsi sejajar -->
    <div class="mt-4 md:mt-6 flex flex-col md:flex-row md:items-center md:justify-center gap-2 md:gap-6 max-w-2xl text-gray-600 text-center md:text-left">
      <!-- BPMSPH -->
      <span class="italic font-serif responsive-subheading whitespace-nowrap">BPMSPH</span>

      <!-- Deskripsi -->
      <p class="responsive-text leading-relaxed">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </p>
    </div>

    <!-- Gambar di batas section -->
    <div class="absolute left-1/2 transform -translate-x-1/2 bottom-0 translate-y-1/2">
      <img 
        src="{{ asset('assets/hero1.png') }}" 
        alt="Ilustrasi Buku" 
        class="hero-image w-48 md:w-72 h-auto md:w-80 md:h-auto object-contain">
    </div>

  </div>
</section>

    <!-- Section Hijau -->
    <section class="bg-[#A4B465] pt-32 pb-16 px-0 rounded-t-[50px]">
  <div class="max-w-7xl mx-auto space-y-12">                                                                                                                   

        <!-- Quote Box -->
        <div class="flex justify-center px-4">
          <div class="relative bg-white rounded-xl shadow-lg px-6 md:px-8 py-6 max-w-3xl w-full text-center border border-gray-200">
            <!-- Icon Quote Atas -->
            <span class="absolute -top-3 right-4 text-black text-2xl">
              <i class="fa-solid fa-quote-left"></i>
            </span>

            <!-- Text -->
            <p class="text-gray-700 text-base leading-relaxed">
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
              Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
              when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
              It has survived not only five centuries, but also the leap into electronic typesetting, 
              remaining essentially unchanged.
            </p>

            <!-- Icon Quote Bawah -->
            <span class="absolute -bottom-3 left-4 text-black text-2xl">
              <i class="fa-solid fa-quote-right"></i>
            </span>
          </div>
        </div>

        <!-- Card Section -->
        <div class="space-y-10">

          <!-- Card 1 -->
          <div class="flex flex-col md:flex-row items-start justify-between gap-4 px-4 card-flex">
            <!-- Card Buku -->
            <div class="bg-white shadow-lg rounded-xl p-5 flex flex-col md:flex-row gap-4 w-full card-content">
              <img src="{{asset('assets/buku1.jpg')}}" class="w-full md:w-28 h-40 object-cover rounded-lg" alt="Buku">
              <div>
                <h4 class="text-xl md:text-2xl font-extrabold text-gray-900">Statistika Peternakan</h4>
                <p class="text-base text-gray-700 mt-1">By Indah Hanaco</p>
                <div class="mt-3 text-yellow-400 text-lg">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-regular fa-star"></i>
                </div>
                <div class="mt-4 flex items-center text-gray-600 text-sm gap-2">
                  <i class="fa-solid fa-user-group text-lg"></i>
                  <span>+80</span>
                </div>
              </div>
            </div>
            <!-- Label -->
            <div class="bg-white rounded-md shadow px-4 py-3 font-bold text-lg leading-snug text-center card-label">
              Rekomendasi<br>Buku Novel<br>Best Seller
            </div>
          </div>

          <!-- Card 2 -->
          <div class="flex flex-col md:flex-row items-start justify-between gap-4 px-4 card-flex">
            <!-- Label -->
            <div class="bg-white rounded-md shadow px-4 py-3 font-bold text-lg leading-snug text-center card-label md:order-1">
              Rekomendasi<br>Buku Novel<br>Best Seller
            </div>
            <!-- Card Buku -->
            <div class="bg-white shadow-lg rounded-xl p-5 flex flex-col md:flex-row gap-4 w-full card-content md:order-2">
              <div class="flex-1">
                <h4 class="text-xl md:text-2xl font-extrabold text-gray-900">Buku Saku Pelaksanaan KIE</h4>
                <p class="text-base text-gray-700 mt-1">By J. Anderson</p>
                <div class="mt-3 text-yellow-400 text-lg">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
                <div class="mt-4 flex items-center text-gray-600 text-sm gap-2">
                  <i class="fa-solid fa-user-group text-lg"></i>
                  <span>+40</span>
                </div>
              </div>
              <img src="{{asset('assets/buku2.jpg')}}" class="w-full md:w-28 h-40 object-cover rounded-lg" alt="Buku">
            </div>
          </div>

          <!-- Card 3 -->
          <div class="flex flex-col md:flex-row items-start justify-between gap-4 px-4 card-flex">
            <!-- Card Buku -->
            <div class="bg-white shadow-lg rounded-xl p-5 flex flex-col md:flex-row gap-4 w-full card-content">
              <img src="{{asset('assets/buku3.jpg')}}" class="w-full md:w-28 h-40 object-cover rounded-lg" alt="Buku">
              <div>
                <h4 class="text-xl md:text-2xl font-extrabold text-gray-900">Statistika Peternakan</h4>
                <p class="text-base text-gray-700 mt-1">By Indah Hanaco</p>
                <div class="mt-3 text-yellow-400 text-lg">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-regular fa-star"></i>
                </div>
                <div class="mt-4 flex items-center text-gray-600 text-sm gap-2">
                  <i class="fa-solid fa-user-group text-lg"></i>
                  <span>+20</span>
                </div>
              </div>
            </div>
            <!-- Label -->
            <div class="bg-white rounded-md shadow px-4 py-3 font-bold text-lg leading-snug text-center card-label">
              Rekomendasi<br>Buku Novel<br>Best Seller
            </div>
          </div>

          <!-- Card 4 -->
          <div class="flex flex-col md:flex-row items-start justify-between gap-4 px-4 card-flex">
            <!-- Label -->
            <div class="bg-white rounded-md shadow px-4 py-3 font-bold text-lg leading-snug text-center card-label md:order-1">
              Rekomendasi<br>Buku Novel<br>Best Seller
            </div>
            <!-- Card Buku -->
            <div class="bg-white shadow-lg rounded-xl p-5 flex flex-col md:flex-row gap-4 w-full card-content md:order-2">
              <div class="flex-1">
                <h4 class="text-xl md:text-2xl font-extrabold text-gray-900">Buku Saku Pelaksanaan KIE</h4>
                <p class="text-base text-gray-700 mt-1">By J. Anderson</p>
                <div class="mt-3 text-yellow-400 text-lg">
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                  <i class="fa-solid fa-star"></i>
                </div>
                <div class="mt-4 flex items-center text-gray-600 text-sm gap-2">
                  <i class="fa-solid fa-user-group text-lg"></i>
                  <span>+40</span>
                </div>
              </div>
              <img src="{{asset('assets/buku4.jpg')}}" class="w-full md:w-28 h-40 object-cover rounded-lg" alt="Buku">
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200">
      <div class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-8 footer-grid">

        <!-- Logo + Deskripsi -->
        <div class="flex flex-col space-y-4">
          <div class="flex items-center space-x-3">
            <img src="{{asset('assets/logo-kementan (1).png')}}" alt="Logo" class="w-14 h-14">
            <h3 class="text-sm font-bold text-gray-800 leading-tight">
              BALAI PENGUJIAN MUTU <br>
              DAN SERTIFIKASI PRODUK HEWAN
            </h3>
          </div>
          <p class="text-sm text-gray-600 leading-relaxed">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
          </p>
        </div>

        <!-- Layanan -->
        <div>
          <h4 class="text-lg font-semibold text-[#5F7045] mb-3">Layanan</h4>
          <ul class="space-y-2 text-sm text-gray-700">
            <li><a href="#" class="hover:text-[#A4B465]">Lorem ipsum</a></li>
            <li><a href="#" class="hover:text-[#A4B465]">Lorem ipsum</a></li>
            <li><a href="#" class="hover:text-[#A4B465]">Lorem ipsum</a></li>
            <li><a href="#" class="hover:text-[#A4B465]">Lorem ipsum</a></li>
          </ul>
        </div>

        <!-- Tautan -->
        <div>
          <h4 class="text-lg font-semibold text-[#5F7045] mb-3">Tautan</h4>
          <ul class="space-y-2 text-sm text-gray-700">
            <li><a href="/" class="hover:text-[#A4B465]">Beranda</a></li>
            <li><a href="#rekomendasi" class="hover:text-[#A4B465]">Rekomendasi</a></li>
            <li><a href="#panduan" class="hover:text-[#A4B465]">Panduan</a></li>
          </ul>
        </div>

      </div>
    </footer>

    <script>
        // Toggle Sidebar Mobile
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        
        function toggleSidebar() {
            hamburger.classList.toggle('hamburger-active');
            sidebar.classList.toggle('sidebar-open');
            sidebarOverlay.classList.toggle('sidebar-overlay-open');
            
            // Mencegah scroll body saat sidebar terbuka
            document.body.style.overflow = sidebar.classList.contains('sidebar-open') ? 'hidden' : '';
        }
        
        hamburger.addEventListener('click', toggleSidebar);
        
        // Tutup sidebar saat mengklik overlay
        sidebarOverlay.addEventListener('click', toggleSidebar);
        
        // Tutup sidebar saat mengklik link di dalamnya
        const sidebarLinks = document.querySelectorAll('#sidebar a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    toggleSidebar();
                }
            });
        });
        
        // Tutup sidebar saat resize window ke ukuran desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('sidebar-open');
                sidebarOverlay.classList.remove('sidebar-overlay-open');
                hamburger.classList.remove('hamburger-active');
                document.body.style.overflow = '';
            }
        });
        
        // Toggle Tema Gelap/Terang
        const toggleTheme = document.getElementById('toggle-theme');
        
        toggleTheme.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
        });

        // animasi header
        document.addEventListener("DOMContentLoaded", function() {
  const links = document.querySelectorAll(".nav-link");
  const underline = document.getElementById("active-underline");
  const nav = document.querySelector("nav");

  let activeLink = links[0]; // default aktif pertama (Beranda)

  // Fungsi untuk update posisi underline
  const updateUnderline = (link) => {
    const rect = link.getBoundingClientRect();
    const navRect = nav.getBoundingClientRect();

    underline.style.width = `${rect.width}px`;
    underline.style.left = `${rect.left - navRect.left}px`;
  };

  // Set awal
  updateUnderline(activeLink);
  activeLink.classList.add("text-green-600");

  // Event klik tiap link
  links.forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();

      // Reset warna sebelumnya
      activeLink.classList.remove("text-green-600");

      // Set link baru aktif
      activeLink = link;
      activeLink.classList.add("text-green-600");

      // Geser underline ke link baru
      updateUnderline(activeLink);

      // Scroll halus ke section (jika pakai anchor #id)
      const targetId = activeLink.getAttribute("href");
      if (targetId.startsWith("#")) {
        document.querySelector(targetId)?.scrollIntoView({ behavior: "smooth" });
      }
    });
  });

  // Update ulang posisi underline kalau window di-resize
  window.addEventListener("resize", () => {
    updateUnderline(activeLink);
  });
});

    </script>

</body>
</html>