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
  class="pt-4 pb-6 px-4 md:px-6 bg-cream
    absolute top-[90px] left-0 right-0 bottom-3 md:left-[320px] md:right-3
    rounded-3xl transition-all duration-300 z-30
    flex flex-col shadow-inner overflow-hidden">

  <!-- Filter & Search (tetap di atas, tanpa garis) -->
  <div class="bg-cream px-4 md:px-6 py-3 sticky top-0 z-40">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">

      <!-- Tombol Filter -->
    <div class="flex justify-center md:justify-start flex-wrap md:flex-nowrap gap-2 md:gap-3 w-full md:w-auto">
      <button class="px-2.5 py-1 text-xs md:px-6 md:py-2 md:text-base bg-primary text-white rounded-xl shadow-md font-semibold transition-all duration-300 hover:bg-kuning hover:text-gray-700 hover:scale-105">
        Semua
      </button>
      <button class="px-2.5 py-1 text-xs md:px-4 md:py-2 md:text-base bg-primary text-white rounded-xl shadow-md font-semibold transition-all duration-300 hover:bg-kuning hover:text-gray-700 hover:scale-105">
        Kimia
      </button>
      <button class="px-2.5 py-1 text-xs md:px-4 md:py-2 md:text-base bg-primary text-white rounded-xl shadow-md font-semibold transition-all duration-300 hover:bg-kuning hover:text-gray-700 hover:scale-105">
        Kesehatan
      </button>
      <button class="px-2.5 py-1 text-xs md:px-4 md:py-2 md:text-base bg-primary text-white rounded-xl shadow-md font-semibold transition-all duration-300 hover:bg-kuning hover:text-gray-700 hover:scale-105">
        Peternakan
      </button>
    </div>

      <!-- Pencarian -->
      <div class="relative w-full sm:w-auto flex justify-center md:justify-end">
        <input type="text" placeholder="Cari Buku..." 
               class="px-5 py-2 w-full sm:w-56 md:w-72 rounded-full 
                      bg-white text-gray-900 placeholder-gray-900
                      focus:outline-none focus:ring-2 focus:ring-[#8CA86C]
                      pr-10 text-sm md:text-base transition-all duration-300"/>
        <i class="fa-solid fa-magnifying-glass absolute right-3 top-2.5 text-gray-900 text-sm md:text-base"></i>
      </div>
    </div>
  </div>

  <!-- Area scroll untuk daftar buku -->
  <div class="flex-1 overflow-y-auto px-2 md:px-4 pt-4 pb-6">
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
      @foreach ($data_bukus as $buku)
      <!-- Card Buku 8 -->
      <div class="group bg-[#f5ecd6] border border-[#e8dec0] rounded-2xl shadow-md overflow-hidden 
            transition-all duration-700 ease-in-out hover:shadow-lg hover:scale-[1.03] hover:bg-[#faf3df] cursor-pointer flex flex-col items-center pt-4">

        <!-- Cover Buku -->
        <div class="relative w-[85%] h-44 md:h-52 bg-white rounded-xl shadow-sm overflow-hidden">
          @if ($buku->foto_buku)
          <img src="{{ asset($buku->foto_buku) }}" alt="Buku 1" class="w-full h-full object-cover rounded-lg transition-transform duration-700 ease-in-out">
          @else
          <img src="{{ asset('assets/default-cover.jpg') }}" alt="Default Cover" class="w-full h-full object-cover rounded-lg transition-transform duration-700 ease-in-out">
          <div class="absolute right-0 top-0 w-[6px] h-full bg-[#d6d6d6] shadow-inner"></div>
          @endif
        </div>
      
        <!-- Detail Buku -->
        <div class="p-4 flex flex-col items-center text-center space-y-1 transition-all duration-700 ease-in-out">
          <h3 class="font-bold text-[#1E1E1E] text-sm md:text-base leading-snug">{{ $buku->judul_buku }}</h3>
          <div class="transition-all duration-700 ease-in-out group-hover:opacity-0 group-hover:translate-y-2">
            <p class="text-xs md:text-sm text-gray-600">{{ $buku->penulis }}</p>
            <div class="flex justify-center text-yellow-400 text-xs md:text-sm space-x-1 mt-1">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half-stroke"></i>
              <i class="fa-regular fa-star"></i>
            </div>
          </div>
          <a href="{{ route('user.detailbuku', $buku->id) }}">
            <button
              class="opacity-0 translate-y-3 group-hover:opacity-100 group-hover:translate-y-0 
                    transition-all duration-700 ease-in-out delay-200 
                    bg-[#8CA86C] text-white text-xs md:text-sm px-5 py-1.5 rounded-full 
                    hover:bg-[#6e8a50] hover:scale-105 mt-2">
              Lihat Detail
            </button>
          </a>
        </div>
      </div>
      @endforeach
    </div>
</div>
</main>

<!-- script -->
<script src="{{asset('assets_user/js/dashboard.js')}}"></script>

</body>
</html>