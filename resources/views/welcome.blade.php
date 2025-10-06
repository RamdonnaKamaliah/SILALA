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
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">

    <style>
     .nav-link{
  position: relative;
  display: inline-block;    /* penting supaya ::after ukurannya akurat */
  padding-bottom: 6px;      /* beri ruang untuk garis */
  line-height: 1;           /* pastikan tinggi teks konsisten */
}

/* garis bawah (pseudo-element) */
.nav-link::after{
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;                /* nempel di bawah teks */
  height: 2px;
  width: 0;
  background: #16a34a;      /* warna hijau */
  transition: width .25s ease;
  transform-origin: left;
}

/* saat hover atau link aktif (class .active ditambahkan via JS) */
.nav-link:hover::after,
.nav-link.active::after{
  width: 100%;
}


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
        .wave-text span {
  display: inline-block;
  animation: wave 1.2s forwards; /* cuma sekali */
  animation-delay: calc(0.1s * var(--i));
}

@keyframes wave {
  0%, 60%, 100% {
    transform: translateY(0);
  }
  30% {
    transform: translateY(-10px);
  }
}

/* Assign index ke tiap huruf */
.wave-text span:nth-child(1) { --i: 0; }
.wave-text span:nth-child(2) { --i: 1; }
.wave-text span:nth-child(3) { --i: 2; }
.wave-text span:nth-child(4) { --i: 3; }
.wave-text span:nth-child(5) { --i: 4; }
.wave-text span:nth-child(6) { --i: 5; }
.wave-text span:nth-child(7) { --i: 6; }
.wave-text span:nth-child(8) { --i: 7; }
.wave-text span:nth-child(9) { --i: 8; }
.wave-text span:nth-child(10){ --i: 9; }
.wave-text span:nth-child(11){ --i: 10; }

.hero-image {
  animation: float 3s ease-in-out infinite;
}

@keyframes float {
  0% {
    transform: translateY(0) rotate(0deg);
  }
  25% {
    transform: translateY(-10px) rotate(-2deg);
  }
  50% {
    transform: translateY(-15px) rotate(1deg);
  }
  75% {
    transform: translateY(-10px) rotate(-1deg);
  }
  100% {
    transform: translateY(0) rotate(0deg);
  }
}

.recommend-card {
  --card-delay: 0ms;
  opacity: 0;
  transform: translateY(18px) scale(.995);
  transition: transform .6s cubic-bezier(.2,.9,.3,1) var(--card-delay),
              opacity .6s var(--card-delay),
              box-shadow .25s;
  will-change: transform, opacity;
  perspective: 1200px;
}

/* Ketika terlihat (IntersectionObserver menambahkan class is-visible) */
.recommend-card.is-visible {
  opacity: 1;
  transform: translateY(0) scale(1);
}

/* Hover 3D effect hanya di device yang mendukung hover */
@media (hover: hover) and (pointer: fine) {
  .recommend-card:hover {
    transform: translateY(-10px) rotateX(4deg) scale(1.02);
    box-shadow: 0 18px 40px rgba(10,10,10,0.12);
  }

  .recommend-card .cover {
    transform: rotateY(-8deg) translateZ(0);
    transition: transform .45s cubic-bezier(.2,.9,.3,1);
  }
  .recommend-card:hover .cover {
    transform: rotateY(-10deg) translateZ(28px) scale(1.03);
  }
}

/* Ukuran & tampilan gambar cover */
.recommend-card .cover {
  border-radius: .5rem;
  overflow: hidden;
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

/* Tambahan detil responsif jika perlu */
.recommend-card .meta h3 {
  line-height: 1.05;
}
    </style>
</head>
<body class="bg-gray-50 font-sans text-slate-700">

    <!-- Navbar Responsif -->
<header class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full px-4">
  <!-- FLEX beda antara mobile & desktop -->
  <div class="flex items-center justify-between md:justify-center">
    
    <!-- HAMBURGER (mobile only) -->
    <button id="hamburger" class="md:hidden w-8 h-8 flex flex-col justify-center items-center">
      <span class="hamburger-line block w-5 h-0.5 bg-gray-700 mb-1.5"></span>
      <span class="hamburger-line block w-5 h-0.5 bg-gray-700 mb-1.5"></span>
      <span class="hamburger-line block w-5 h-0.5 bg-gray-700"></span>
    </button>

    <!-- NAVBAR (desktop only) -->
  <nav class="relative hidden md:flex items-center space-x-8 text-base font-semibold 
     bg-[#A4B465] text-white dark:bg-white dark:text-slate-700 
     shadow-md rounded-full px-8 py-4 transition-colors duration-300">
  <a href="/" class="nav-link text-green-600">Beranda</a>
  <a href="#tentang" class="nav-link">Tentang</a>
  <a href="#rekomendasi" class="nav-link">Rekomendasi</a>
  <a href="#panduan" class="nav-link">Panduan</a>

  @auth
    <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
  @else
    <a href="{{ route('register') }}" class="nav-link">Register</a>
    <a href="{{ route('login') }}" class="nav-link text-blue-500">Login</a>
  @endauth

  <!-- Garis animasi aktif -->
   <span id="active-underline" class="absolute bottom-[4px] h-[2px] bg-green-600 transition-all duration-300 ease-in-out"></span>
</nav>


    <!-- Toggle Theme -->
    <button id="toggle-theme" class="w-10 h-10 ml-4 flex items-center justify-center bg-gray-100 rounded-full shadow hover:bg-gray-200 transition-colors duration-200">
      <i class="fas fa-sun text-yellow-500 text-lg dark:hidden"></i>
<i class="fas fa-moon text-gray-700 text-lg hidden dark:inline"></i>

    </button>
  </div>
</header>

    <!-- Sidebar Mobile -->
<div id="sidebar-overlay" class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden transition-opacity"></div>

<aside id="sidebar" class="sidebar fixed top-0 left-0 h-full w-64 dark:bg-[#2A320F] bg-[#F5ECD5] dark:text-white text-gray-900 shadow-xl z-50 md:hidden transform -translate-x-full transition-transform duration-300">
    <!-- Header Sidebar -->
    <div class="p-6 border-b border-gray-700 flex items-center justify-between">
        <button id="closeSidebar" class="dark:text-white text-gray-900 text-xl">&times;</button>
    </div>
    
    <!-- Menu Sidebar -->
    <nav class="p-4">
        <ul class="space-y-2">
            <li>
                <a href="/" class="flex items-center px-4 py-3 hover:bg-green-700 rounded-lg font-semibold transition-all duration-200 ">
                    <i class="fas fa-home mr-3"></i>
                    Beranda
                </a>
            </li>
            <li>
                <a href="#tentang" class="flex items-center px-4 py-3 hover:bg-green-700 rounded-lg font-medium transition-all duration-200">
                    <i class="fas fa-info-circle mr-3"></i>
                    Tentang
                </a>
            </li>
            <li>
                <a href="#rekomendasi" class="flex items-center px-4 py-3 hover:bg-green-700 rounded-lg font-medium transition-all duration-200">
                    <i class="fas fa-book mr-3"></i>
                    Rekomendasi
                </a>
            </li>
            <li>
                <a href="#panduan" class="flex items-center px-4 py-3 hover:bg-green-700 rounded-lg font-medium transition-all duration-200">
                    <i class="fas fa-question-circle mr-3"></i>
                    Panduan
                </a>
            </li>
        </ul>

        <!-- Auth Links untuk Mobile -->
        <div class="border-t border-gray-700 mt-6 pt-4 space-y-2">
            @auth
                <a href="{{ url('/dashboard') }}" class="flex items-center px-4 py-3 hover:bg-green-700 rounded-lg font-medium transition-all duration-200">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="flex items-center px-4 py-3 hover:bg-green-700 rounded-lg font-medium transition-all duration-200">
                    <i class="fas fa-user-plus mr-3"></i>
                    Register
                </a>
                <a href="{{ route('login') }}" class="flex items-center px-4 py-3 text-blue-400 hover:bg-blue-50 rounded-lg font-medium transition-all duration-200">
                    <i class="fas fa-sign-in-alt mr-3"></i>
                    Login
                </a>
            @endauth
        </div>
    </nav>
</aside>

    <!-- Hero Section -->
    <section class="pt-24 md:pt-32 pb-32 md:pb-40 relative bg-cover bg-center hero-section" id="/" 
  style="background-image: url('{{ asset('assets/background.png') }}');">
  <div class="max-w-5xl mx-auto flex flex-col items-center text-center px-4 md:px-6">
    
    <!-- Judul + Icon -->
   <h1 class="flex items-center justify-center responsive-heading md:text-4xl font-inknut font-bold text-black">
  <span class="mr-2">
    <img src="{{ asset('assets/logo 1.png') }}" alt="Ilustrasi Buku" class="w-10 h-10 md:w-12 md:h-12">
  </span>
  <span class="wave-text">
    P<span>e</span><span>r</span><span>p</span><span>u</span><span>s</span><span>t</span><span>a</span><span>k</span><span>a</span><span>a</span><span>n</span>
  </span>
</h1>


<!-- BPMSPH + Deskripsi sejajar -->
<div class="mt-4 md:mt-6 flex flex-col md:flex-row md:items-center md:justify-center gap-2 md:gap-6 max-w-2xl text-gray-600 text-center md:text-left">
  <!-- BPMSPH -->
  <span class="italic font-serif font-bold text-xl md:text-2xl whitespace-nowrap text-black">
    BPMSPH
  </span>

  <!-- Deskripsi -->
  <p class="text-base md:text-lg leading-relaxed">
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
    <section class="bg-[#F5ECD5] dark:bg-[#A4B465] pt-32 pb-16 px-0 rounded-t-[50px]" id="tentang">
  <div class="max-w-7xl mx-auto space-y-12">                                                                                                                   

       <!-- Quote Box -->
<div class="flex justify-center px-4">
  <div class="quote-box relative bg-white rounded-2xl shadow-xl px-6 md:px-10 py-8 max-w-3xl w-full text-center border-4 border-[#626F47] 
              opacity-0 translate-y-10 transition-all duration-700 ease-out">
    <!-- Icon Quote Atas -->
    <span class="absolute -top-4 right-6 text-black text-3xl">
      <i class="fa-solid fa-quote-left"></i>
    </span>

    <!-- Text -->
    <p class="text-gray-700 text-lg leading-relaxed font-medium italic">
      "Lorem Ipsum is simply dummy text of the printing and typesetting
      industry. Lorem Ipsum has been the industry's standard dummy text
      ever since the 1500s, when an unknown printer took a galley of type
      and scrambled it to make a type specimen book."
    </p>

    <!-- Icon Quote Bawah -->
    <span class="absolute -bottom-4 left-6 text-black text-3xl">
      <i class="fa-solid fa-quote-right"></i>
    </span>
  </div>
</div>

<!-- Judul Section -->
<div class="px-4 md:px-8 mb-8 text-center" id="rekomendasi">
  <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white">
    Rekomendasi Buku Best Seller
  </h2>
  <p class="mt-2 text-gray-600 dark:text-white text-base">
    Pilihan buku terbaik untuk menambah wawasan dan inspirasi
  </p>
</div>

<!-- Container Card (grid responsive) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-4 md:px-8 items-stretch">
  <!-- Card contoh 1 -->
  <article class="recommend-card bg-[#A4B465] dark:bg-white rounded-xl p-6 md:p-8 flex items-center gap-5 w-full h-full">
    <div class="cover w-24 h-36 md:w-32 md:h-44 flex-shrink-0">
      <img src="{{ asset('assets/buku1.jpg') }}" alt="Statistika Peternakan - cover" class="w-full h-full object-cover">
    </div>
    <div class="meta flex-1">
      <h3 class="text-lg md:text-xl font-semibold text-white dark:text-gray-900">Statistika Peternakan</h3>
      <p class="text-sm md:text-base text-gray-100 dark:text-gray-900 mt-1">By Indah Hanaco</p>
      <div class="mt-3 flex items-center gap-3">
        <div class="text-yellow-400 text-base">★★★★☆</div>
        <div class="text-sm text-gray-200 dark:text-gray-900 flex items-center"><i class="fa fa-user mr-1"></i> +20</div>
      </div>
    </div>
  </article>

  <!-- Card contoh 2 -->
  <article class="recommend-card bg-[#A4B465] dark:bg-white rounded-xl p-6 md:p-8 flex items-center gap-5 w-full h-full">
    <div class="cover w-24 h-36 md:w-32 md:h-44 flex-shrink-0">
      <img src="{{ asset('assets/buku2.jpg') }}" alt="Buku Saku Pelaksanaa Kie - cover" class="w-full h-full object-cover">
    </div>
    <div class="meta flex-1">
      <h3 class="text-lg md:text-xl font-semibold text-white dark:text-gray-900">Buku Saku Pelaksanaa Kie</h3>
      <p class="text-sm md:text-base text-gray-100 dark:text-gray-900 mt-1">By J. Anderson</p>
      <div class="mt-3 flex items-center gap-3">
        <div class="text-yellow-400 text-base">★★★★☆</div>
        <div class="text-sm text-gray-200 dark:text-gray-900 flex items-center"><i class="fa fa-user mr-1"></i> +35</div>
      </div>
    </div>
  </article>

  <!-- Card contoh 3 -->
  <article class="recommend-card bg-[#A4B465] dark:bg-white rounded-xl p-6 md:p-8 flex items-center gap-5 w-full h-full">
    <div class="cover w-24 h-36 md:w-32 md:h-44 flex-shrink-0">
      <img src="{{ asset('assets/buku3.jpg') }}" alt="Statistika Peternakan (2) - cover" class="w-full h-full object-cover">
    </div>
    <div class="meta flex-1">
      <h3 class="text-lg md:text-xl font-semibold text-white dark:text-gray-900">Statistika Peternakan</h3>
      <p class="text-sm md:text-base text-gray-100 dark:text-gray-900 mt-1">By Indah Hanaco</p>
      <div class="mt-3 flex items-center gap-3">
        <div class="text-yellow-400 text-base">★★★★★</div>
        <div class="text-sm text-gray-200 dark:text-gray-900 flex items-center"><i class="fa fa-user mr-1"></i> +50</div>
      </div>
    </div>
  </article>

  <!-- Card contoh 4 -->
  <article class="recommend-card bg-[#A4B465] dark:bg-white rounded-xl p-6 md:p-8 flex items-center gap-5 w-full h-full">
    <div class="cover w-24 h-36 md:w-32 md:h-44 flex-shrink-0">
      <img src="{{ asset('assets/buku4.jpg') }}" alt="Budidaya Peternakan - cover" class="w-full h-full object-cover">
    </div>
    <div class="meta flex-1">
      <h3 class="text-lg md:text-xl font-semibold text-white dark:text-gray-900">Budidaya Peternakan</h3>
      <p class="text-sm md:text-base text-gray-100 dark:text-gray-900 mt-1">By J. Anderson</p>
      <div class="mt-3 flex items-center gap-3">
        <div class="text-yellow-400 text-base">★★★★☆</div>
        <div class="text-sm text-gray-200 dark:text-gray-900 flex items-center"><i class="fa fa-user mr-1"></i> +20</div>
      </div>
    </div>
  </article>

  <!-- Card contoh 5 -->
  <article class="recommend-card bg-[#A4B465] dark:bg-white rounded-xl p-6 md:p-8 flex items-center gap-5 w-full h-full">
    <div class="cover w-24 h-36 md:w-32 md:h-44 flex-shrink-0">
      <img src="{{ asset('assets/buku2.jpg') }}" alt="Buku Saku Pelaksanaa Kie (2) - cover" class="w-full h-full object-cover">
    </div>
    <div class="meta flex-1">
      <h3 class="text-lg md:text-xl font-semibold text-white dark:text-gray-900">Buku Saku Pelaksanaa Kie</h3>
      <p class="text-sm md:text-base text-gray-100 dark:text-gray-900 mt-1">By J. Anderson</p>
      <div class="mt-3 flex items-center gap-3">
        <div class="text-yellow-400 text-base">★★★★☆</div>
        <div class="text-sm text-gray-200 dark:text-gray-900 flex items-center"><i class="fa fa-user mr-1"></i> +35</div>
      </div>
    </div>
  </article>

  <!-- Card contoh 6 -->
  <article class="recommend-card bg-[#A4B465] dark:bg-white rounded-xl p-6 md:p-8 flex items-center gap-5 w-full h-full">
    <div class="cover w-24 h-36 md:w-32 md:h-44 flex-shrink-0">
      <img src="{{ asset('assets/buku3.jpg') }}" alt="Statistika Peternakan (3) - cover" class="w-full h-full object-cover">
    </div>
    <div class="meta flex-1">
      <h3 class="text-lg md:text-xl font-semibold text-white dark:text-gray-900">Statistika Peternakan</h3>
      <p class="text-sm md:text-base text-gray-100 dark:text-gray-900 mt-1">By Indah Hanaco</p>
      <div class="mt-3 flex items-center gap-3">
        <div class="text-yellow-400 text-base">★★★★★</div>
        <div class="text-sm text-gray-200 dark:text-gray-900 flex items-center"><i class="fa fa-user mr-1"></i> +50</div>
      </div>
    </div>
  </article>
</div>
    </section>

    <!-- Footer -->
<footer class="dark:bg-white bg-[#A4B465] dark:text-gray-900 text-white border-t border-gray-200">
  <div class="max-w-7xl mx-auto px-8 py-16 grid grid-cols-1 md:grid-cols-3 gap-20"> 
    
    <!-- Logo + Deskripsi -->
    <div class="flex flex-col space-y-5">
      <div class="flex items-center space-x-4">
        <img src="{{asset('assets/logo_kementan.png')}}" alt="Logo" class="w-16 h-16">
        <h3 class="text-lg md:text-xl font-bold leading-snug">
          BALAI PENGUJIAN MUTU <br>
          DAN SERTIFIKASI PRODUK HEWAN
        </h3>
      </div>
      <p class="text-base leading-relaxed opacity-90">
        Lembaga resmi yang berkomitmen menjaga kualitas, mutu, 
        serta memberikan layanan pengujian dan sertifikasi produk hewan 
        dengan standar terbaik.
      </p>
    </div>

    <!-- Layanan -->
    <div class="relative">
  <h4 class="text-xl font-semibold mb-5">Layanan</h4>

  <ul class="space-y-3 text-base">
    <!-- Link langsung -->
    <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/magangpklbimbingan-teknis" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Magang/PKL/Bimbingan Teknis</a></li>
    <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/uji-profisiensi" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Uji Profisiensi</a></li>

    <!-- Dropdown 1 -->
    <li class="relative">
      <button class="flex items-center justify-between w-full transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]" onclick="toggleDropdown('mutuDropdown', this)">
        Pengajuan dan Mutu Produk Hewan
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <ul id="mutuDropdown" class="hidden ml-4 mt-2 space-y-2 text-sm">
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/pelayanan-pengujian-keamanan-dan-mutu-produk-hewan" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Pelayanan Pengujian Keamanan dan Mutu Produk Hewan</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/ivlab--indonesian-veterinary-lab-information-system" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">IVLAB</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/tarif-uji" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Tarif Uji</a></li>
      </ul>
    </li>

    <!-- Dropdown 2 -->
    <li class="relative">
      <button class="flex items-center justify-between w-full transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]" onclick="toggleDropdown('pmkDropdown', this)">
        PMK PHMS
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <ul id="pmkDropdown" class="hidden ml-4 mt-2 space-y-2 text-sm">
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/sebaran-pmk" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Sebaran PMK</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/regulasi-dan-pedoman-pmk" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Regulasi dan Pedoman PMK</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/materi-kie-pmk" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Materi KIE PMK</a></li>
        <li><a href="https://ditjenpkh.pertanian.go.id/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Info Terkait PMK</a></li>
        <li><a href="https://ditjenpkh.pertanian.go.id/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Pekembangan Kasus PMK</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/buku-saku-pencegahan-dan-pengendalian-pmk" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Buku Saku dan Pengendalian PMK</a></li>
      </ul>
    </li>

    <!-- Link langsung -->
    <li><a href="https://ppid.pertanian.go.id/" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Permohonan Informasi Publik</a></li>
    <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/sewa-fasilitas-dan-aset" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Sewa Fasilitas dan Aset</a></li>

    <!-- Dropdown 3 -->
    <li class="relative">
      <button class="flex items-center justify-between w-full transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]" onclick="toggleDropdown('konsulDropdown', this)">
        Konsultasi dan Pengaduan
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <ul id="konsulDropdown" class="hidden ml-4 mt-2 space-y-2 text-sm">
        <li><a href="https://linktr.ee/HALO_BPMSPH?utm_source=linktree_profile_share&amp;amp;amp;amp;amp;amp;amp;amp;amp;ltsid=d080f820-4b42-4fbd-9da1-c8216578eddb" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Konsultasi</a></li>
        <li><a href="" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Kanal Pelaporan</a></li>
        <li><a href="https://bit.ly/Ikmbpmsph" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Form Survei Kepuasan</a></li>
        <li><a href="https://docs.google.com/forms/d/e/1FAIpQLScqWs9Mcze01bl0q0jDT-bUYtBrOCTz6VAxJpv6JBb1o8NG_g/viewform" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Pendaftaran Pelayan Online</a></li>
        <li><a href="" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">WBS</a></li>
      </ul>
    </li>

    <!-- Dropdown 4 -->
    <li class="relative">
      <button class="flex items-center justify-between w-full transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]" onclick="toggleDropdown('internalDropdown', this)">
        Layanan Internal
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <ul id="internalDropdown" class="hidden ml-4 mt-2 space-y-2 text-sm">
        <li><a href="https://sijitumi.bpmsph.org/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Sistem Mangemen Integrasi</a></li>
        <li><a href="https://sijitumi.bpmsph.org/spip" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">SPIP</a></li>
        <li><a href="https://sakti.kemenkeu.go.id/LL-Zg7BviiuXviBn9TvfiA" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">SAKTI</a></li>
        <li><a href="https://srikandi.arsip.go.id/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">SRIKANDI</a></li>
        <li><a href="https://epersonal.pertanian.go.id/login" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">SINERGI</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/waktu-pelayanan" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Waktu Pelayanan</a></li>
        <li><a href="https://repository.pertanian.go.id/home" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Repositori Publikasi</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/kritik-dan-saran" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Kritik dan Saran</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/perpustakaan-digital-kementan" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Perpustakaan Kementan</a></li>
        <li><a href="https://katalog.inaproc.id/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Katalog Elektronik</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/zona-integritas" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Zona Interasi </a></li>
        <li><a href="https://sirup.lkpp.go.id/sirup/home/swakelolaSatker?idSatker=5521" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Integrasi Rencana Umum Penggadaian</a></li>
        <li><a href="https://spse.inaproc.id/pertanian" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">INAPROC</a></li>
        <li><a href="https://lpse.pertanian.go.id/eproc4/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">LPCE</a></li>
        <li><a href="https://elhkpn.kpk.go.id/portal/user/pengumuman_lhkpn/TlZwa1owaHBNRW94WVhrM1JrdFVkMHBvUlVWc2EwZHVhVmh0TVd4d2RXa3hSakZVVmtSc1ZIZFpVbGRTTDFWSVZsQXJLMmhGTldKSVluZERjVXM0VFE9PQ==" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">LHKPN</a></li>
        <li><a href="https://tvtani.co/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">TV Tani</a></li>
        <li><a href="https://jdih.pertanian.go.id/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">JDIH Kementan</a></li>
      </ul>
    </li>
  </ul>
</div>

    <!-- Tautan -->
    <div>
      <h4 class="text-xl font-semibold mb-5">Tautan</h4>
      <ul class="space-y-3 text-base">
        <li><a href="/" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Beranda</a></li>
        <li><a href="#rekomendasi" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Rekomendasi</a></li>
        <li><a href="#panduan" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Panduan</a></li>
      </ul>
    </div>
</div>
</footer>


    <script>
        // Toggle Sidebar Mobile
const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebar-overlay');
const closeSidebar = document.getElementById('closeSidebar');

function toggleSidebar() {
    hamburger.classList.toggle('hamburger-active');
    sidebar.classList.toggle('sidebar-open');
    sidebarOverlay.classList.toggle('sidebar-overlay-open');
    
    // Mencegah scroll body saat sidebar terbuka
    document.body.style.overflow = sidebar.classList.contains('sidebar-open') ? 'hidden' : '';
}

hamburger.addEventListener('click', toggleSidebar);
sidebarOverlay.addEventListener('click', toggleSidebar);
closeSidebar.addEventListener('click', toggleSidebar); // << tambahin ini

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

        
        // Toggle Tema Gelap/Terang dengan penyimpanan localStorage
const toggleTheme = document.getElementById('toggle-theme');
const darkIcon = toggleTheme.querySelector('.fa-sun');
const lightIcon = toggleTheme.querySelector('.fa-moon');

// Fungsi untuk apply tema berdasarkan localStorage atau default
function applyTheme(theme) {
    if(theme === 'dark') {
        document.documentElement.classList.add('dark');
        darkIcon.classList.add('hidden');
        lightIcon.classList.remove('hidden');
    } else {
        document.documentElement.classList.remove('dark');
        darkIcon.classList.remove('hidden');
        lightIcon.classList.add('hidden');
    }
}

// Ambil tema dari localStorage saat load
const storedTheme = localStorage.getItem('theme');
if(storedTheme) {
    applyTheme(storedTheme);
} else {
    // default mode (bisa ganti ke 'dark' kalau mau)
    applyTheme('light');
}

// Toggle tema saat klik
toggleTheme.addEventListener('click', () => {
    const isDark = document.documentElement.classList.contains('dark');
    if(isDark) {
        applyTheme('light');
        localStorage.setItem('theme', 'light');
    } else {
        applyTheme('dark');
        localStorage.setItem('theme', 'dark');
    }
});


     // animasi header
document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('.nav-link');

  links.forEach(link => {
    link.addEventListener('click', () => {
      links.forEach(l => l.classList.remove('active','text-green-600'));
      link.classList.add('active','text-green-600');
      // jangan e.preventDefault() kecuali kamu ingin mencegah navigation
    });
  });

  // Optional: set active berdasarkan hash saat load (jika anchor menuju section)
  const currentHash = location.hash;
  if (currentHash) {
    const match = document.querySelector(`.nav-link[href="${currentHash}"]`);
    if (match) {
      links.forEach(l => l.classList.remove('active','text-green-600'));
      match.classList.add('active','text-green-600');
    }
  }
});

// animasi quotes + card section
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add("opacity-100", "translate-y-0");
      entry.target.classList.remove("opacity-0", "translate-y-10");
    } else {
      entry.target.classList.add("opacity-0", "translate-y-10");
      entry.target.classList.remove("opacity-100", "translate-y-0");
    }
  });
}, { threshold: 0.2 });

// Observe semua elemen
document.querySelectorAll('.quote-box, .card-content, .card-label').forEach(el => observer.observe(el));

//card
document.addEventListener('DOMContentLoaded', () => {
  const cards = Array.from(document.querySelectorAll('.recommend-card'));
  cards.forEach((card, i) => {
    // set delay per card (bisa atur durasi di sini)
    card.style.setProperty('--card-delay', `${i * 80}ms`);
  });

  const io = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target); // hanya sekali
      }
    });
  }, { threshold: 0.12 });

  cards.forEach(card => io.observe(card));
});

//dropdown footer
function toggleDropdown(id, btn) {
    const dropdown = document.getElementById(id);
    const icon = btn.querySelector('svg');
    dropdown.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
  }
    </script>

</body>
</html>