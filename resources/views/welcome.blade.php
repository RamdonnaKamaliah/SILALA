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
</head>
<body class="bg-gray-50 font-sans text-slate-700">

    <!-- Navbar -->
<header class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50">
  <div class="flex items-center space-x-4">
    
    <!-- Container Navbar -->
    <div class="flex items-center bg-white shadow-md rounded-full px-8 py-3">
      <nav class="flex items-center space-x-6 text-sm font-semibold">
        <a href="/" class="text-green-600 underline underline-offset-4">Beranda</a>
        <a href="#tentang" class="hover:text-green-500">Tentang</a>
        <a href="#rekomendasi" class="hover:text-green-500">Rekomendasi</a>
        <a href="#panduan" class="hover:text-green-500">Panduan</a>

        @auth
          <a href="{{ url('/dashboard') }}" class="hover:text-green-500">
            Dashboard
          </a>
        @else
          <a href="{{ route('register') }}" class="hover:text-green-500">
            Register
          </a>
          <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
            Login
          </a>
        @endauth
      </nav>
    </div>

    <!-- Tombol Icon Kanan (TERPISAH) -->
    <button id="toggle-theme" class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-full shadow hover:bg-gray-200 transition">
      <!-- Ikon Font Awesome -->
      <i class="fas fa-sun text-yellow-500 text-lg dark:hidden"></i>
      <i class="fas fa-moon text-gray-700 text-lg hidden dark:inline"></i>
    </button>

  </div>
</header>

<!-- Hero Section -->
<section class="pt-32 pb-40 relative bg-cover bg-center" 
  style="background-image: url('{{ asset('assets/background.png') }}');">
  <div class="max-w-5xl mx-auto flex flex-col items-center text-center px-6">
    
    <!-- Judul + Icon -->
    <h1 class="flex items-center justify-center text-4xl font-Inknut font-bold text-black">
      <span class="mr-2">
        <img src="{{ asset('assets/logo 1.png') }}" alt="Ilustrasi Buku" class="w-12 h-12">
      </span> 
      Perpustakaan
    </h1>

    <!-- BPMSPH + Deskripsi sejajar -->
    <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-center gap-3 md:gap-6 max-w-2xl text-gray-600 text-center md:text-left">
      <!-- BPMSPH -->
      <span class="italic font-serif text-lg whitespace-nowrap">BPMSPH</span>

      <!-- Deskripsi -->
      <p class="text-sm leading-relaxed">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </p>
    </div>

    <!-- Gambar di batas section -->
    <div class="absolute left-1/2 transform -translate-x-1/2 bottom-0 translate-y-1/2">
      <img 
        src="{{ asset('assets/hero1.png') }}" 
        alt="Ilustrasi Buku" 
        class="w-72 h-auto md:w-80 md:h-auto object-contain">
    </div>

  </div>
</section>

<!-- Section Hijau -->
<section class="bg-[#A4B465] rounded-t-3xl pt-32 pb-16 px-0">
  <div class="max-w-7xl mx-auto space-y-12">

    <!-- Quote Box -->
    <div class="flex justify-center">
      <div class="relative bg-white rounded-xl shadow-lg px-8 py-6 max-w-3xl w-full text-center border border-gray-200">
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
      <div class="flex items-start justify-between gap-4 px-4">
        <!-- Card Buku -->
        <div class="bg-white shadow-lg rounded-xl p-5 flex flex-1 gap-4 w-full">
          <img src="{{asset('assets/buku1.jpg')}}" class="w-28 h-40 object-cover rounded-lg" alt="Buku">
          <div>
            <h4 class="text-2xl font-extrabold text-gray-900">Statistika Peternakan</h4>
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
        <div class="bg-white rounded-md shadow px-4 py-3 font-bold text-lg leading-snug text-center">
          Rekomendasi<br>Buku Novel<br>Best Seller
        </div>
      </div>

      <!-- Card 2 -->
      <div class="flex items-start justify-between gap-4 px-4">
        <!-- Label -->
        <div class="bg-white rounded-md shadow px-4 py-3 font-bold text-lg leading-snug text-center">
          Rekomendasi<br>Buku Novel<br>Best Seller
        </div>
        <!-- Card Buku -->
        <div class="bg-white shadow-lg rounded-xl p-5 flex flex-1 gap-4 w-full">
          <div class="flex-1">
            <h4 class="text-2xl font-extrabold text-gray-900">Buku Saku Pelaksanaan KIE</h4>
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
          <img src="{{asset('assets/buku2.jpg')}}" class="w-28 h-40 object-cover rounded-lg" alt="Buku">
        </div>
      </div>

      <!-- Card 3 -->
      <div class="flex items-start justify-between gap-4 px-4">
        <!-- Card Buku -->
        <div class="bg-white shadow-lg rounded-xl p-5 flex flex-1 gap-4 w-full">
          <img src="{{asset('assets/buku3.jpg')}}" class="w-28 h-40 object-cover rounded-lg" alt="Buku">
          <div>
            <h4 class="text-2xl font-extrabold text-gray-900">Statistika Peternakan</h4>
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
        <div class="bg-white rounded-md shadow px-4 py-3 font-bold text-lg leading-snug text-center">
          Rekomendasi<br>Buku Novel<br>Best Seller
        </div>
      </div>

      <!-- Card 4 -->
      <div class="flex items-start justify-between gap-4 px-4">
        <!-- Label -->
        <div class="bg-white rounded-md shadow px-4 py-3 font-bold text-lg leading-snug text-center">
          Rekomendasi<br>Buku Novel<br>Best Seller
        </div>
        <!-- Card Buku -->
        <div class="bg-white shadow-lg rounded-xl p-5 flex flex-1 gap-4 w-full">
          <div class="flex-1">
            <h4 class="text-2xl font-extrabold text-gray-900">Buku Saku Pelaksanaan KIE</h4>
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
          <img src="{{asset('assets/buku4.jpg')}}" class="w-28 h-40 object-cover rounded-lg" alt="Buku">
        </div>
      </div>

    </div>
  </div>
</section>
<!-- Footer -->
<footer class="bg-white border-t border-gray-200">
  <div class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">

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
  const toggleTheme = document.getElementById('toggle-theme');
  toggleTheme.addEventListener('click', () => {
    document.documentElement.classList.toggle('dark');
  });
</script>

</body>
</html>
