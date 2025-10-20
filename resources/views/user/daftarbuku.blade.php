<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @include('layout_dashboard.partial_dashboard.link')
  <title>SILALA</title>
  <!-- vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- style -->
 <link rel="stylesheet" href="{{ asset('assets_user/css/dashboard.css') }}">
</head>
<body class="min-h-screen overflow-hidden font-[Ubuntu,sans-serif] bg-white">
  @include('layout_dashboard.partial_dashboard.header')

  <main
  class="pt-4 pb-14 px-4 md:px-6 bg-cream
    absolute top-[90px] left-0 right-0 bottom-3 md:left-[320px] md:right-3
    rounded-3xl transition-all duration-300 z-30
    flex flex-col overflow-y-auto shadow-inner">

  <!-- Filter & Search -->
  <div class="flex flex-col md:flex-row justify-between items-center px-4 md:px-6 py-3 mb-6 -mt-2 gap-4">
    
    <!-- Tombol Filter -->
    <div class="flex justify-center md:justify-start flex-wrap md:flex-nowrap gap-2 md:gap-3 w-full md:w-auto">
      <button class="px-2.5 py-1 text-xs md:px-4 md:py-2 md:text-base bg-primary text-white rounded-full shadow-md font-semibold transition-all duration-300 hover:bg-kuning hover:scale-105">
        Semua
      </button>
      <button class="px-2.5 py-1 text-xs md:px-4 md:py-2 md:text-base bg-primary text-white rounded-full shadow-md font-semibold transition-all duration-300 hover:bg-kuning hover:scale-105">
        Kimia
      </button>
      <button class="px-2.5 py-1 text-xs md:px-4 md:py-2 md:text-base bg-primary text-white rounded-full shadow-md font-semibold transition-all duration-300 hover:bg-kuning hover:scale-105">
        Kesehatan
      </button>
      <button class="px-2.5 py-1 text-xs md:px-4 md:py-2 md:text-base bg-primary text-white rounded-full shadow-md font-semibold transition-all duration-300 hover:bg-kuning hover:scale-105">
        Peternakan
      </button>
    </div>

    <!-- Pencarian -->
    <div class="relative w-full sm:w-auto flex justify-center md:justify-end">
      <input type="text" placeholder="Cari Buku..." 
             class="px-4 py-2 w-full sm:w-56 md:w-72 rounded-full border border-gray-200 
                    focus:ring-2 focus:ring-[#A4B465] outline-none 
                    pl-10 text-gray-700 transition-all duration-300 hover:shadow-md
                    text-sm md:text-base" />
      <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-[#A4B465] text-sm md:text-base"></i>
    </div>
  </div>

 <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8 px-2 md:px-4">

  <!-- Card Buku -->
  <div
    class="group bg-[#f5ecd6] border border-[#e8dec0] rounded-2xl shadow-md overflow-hidden 
           transition-all duration-700 ease-in-out hover:shadow-lg hover:scale-[1.03] hover:bg-[#faf3df] cursor-pointer">

    <!-- Cover Buku -->
    <div class="relative w-full h-44 md:h-52 overflow-hidden">
      <img src="{{ asset('assets/buku1.jpg') }}" alt="Buku 1"
           class="w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-[1.05]">
      <!-- Efek punggung buku -->
      <div class="absolute right-0 top-0 w-2 h-full bg-[#d6d6d6]"></div>
    </div>

    <!-- Detail Buku -->
    <div class="p-4 flex flex-col items-center text-center space-y-1 transition-all duration-700 ease-in-out">

      <!-- Judul -->
      <h3 class="font-bold text-[#1E1E1E] text-sm md:text-base leading-snug transition-all duration-500 ease-in-out">
        Budidaya Peternakan
      </h3>

      <!-- Penulis & Rating -->
      <div
        class="transition-all duration-700 ease-in-out group-hover:opacity-0 group-hover:translate-y-2">
        <p class="text-xs md:text-sm text-gray-600">By Indah Hanaco</p>
        <div class="flex justify-center text-yellow-400 text-xs md:text-sm space-x-1 mt-1">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star-half-stroke"></i>
          <i class="fa-regular fa-star"></i>
        </div>
      </div>

      <!-- Tombol Lihat Detail (fade in halus saat hover) -->
      <button
        class="opacity-0 translate-y-3 group-hover:opacity-100 group-hover:translate-y-0 
               transition-all duration-700 ease-in-out delay-200 
               bg-[#8CA86C] text-white text-xs md:text-sm px-5 py-1.5 rounded-full 
               hover:bg-[#6e8a50] hover:scale-105 mt-2">
        Lihat Detail
      </button>
    </div>
  </div>

</div>
</main>

<!-- script -->
<script src="{{asset('assets_user/js/dashboard.js')}}"></script>

</body>
</html>