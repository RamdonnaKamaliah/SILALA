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
<body class="min-h-screen flex flex-col font-[Ubuntu,sans-serif] bg-white">

  @include('layout_dashboard.partial_dashboard.header')
  
  <!-- Konten Utama Dashboard -->
  <main class="pt-8 pb-6 px-4 md:px-6 bg-cream relative top-[90px] mb-24 md:ml-[320px] md:mr-3 md:rounded-3xl transition-all duration-300 z-30 flex flex-col overflow-y-auto overflow-x-hidden max-w-full shadow-inner">
    
  <!-- Pencarian -->
<div class="w-full">
  <div class="relative w-full mb-8">
    <input id="searchBuku" type="text" placeholder="Cari Buku..." 
      class="w-full bg-white border border-white rounded-full py-3 px-5 
             text-sm text-[#626F47] focus:outline-none shadow-sm">
    <span class="absolute right-4 top-3 text-[#626F47] text-lg">
      <i class="fa-solid fa-magnifying-glass"></i>
    </span>
  </div>
</div>

<!-- Grid Buku -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

  <!-- Card 1 -->
  <div class="book-card bg-white rounded-xl shadow-md border border-[#E0D6B8] overflow-hidden p-3 flex gap-3 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
    <img src="{{ asset('assets/buku1.jpg') }}" class="w-16 h-24 object-cover shadow-md rounded-md flex-shrink-0">

    <div class="flex flex-col justify-between flex-grow">
      <div>
        <p class="book-title text-[#2E2E2E] text-sm font-semibold leading-tight">Pergi</p>
        <p class="text-[#626F47] text-xs font-semibold mt-1">Tere Liye</p>
      </div>

      <div class="border-t border-[#E0D6B8] my-2"></div>
      <div class="flex items-center justify-between">
        <button class="bg-green hover:bg-primary text-white text-xs font-semibold px-6 py-[5px] rounded-full transition">Baca</button>
        <button class="text-red-500 text-lg hover:scale-110 transition"><i class="fa-solid fa-heart"></i></button>
      </div>
    </div>
  </div>

  <!-- Copy Card 1 ke bawah lalu ganti isinya sesuai kebutuhan -->

  <div class="book-card bg-white rounded-xl shadow-md border border-[#E0D6B8] overflow-hidden p-3 flex gap-3 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
    <img src="{{ asset('assets/buku1.jpg') }}" class="w-16 h-24 object-cover shadow-md rounded-md flex-shrink-0">
    <div class="flex flex-col justify-between flex-grow">
      <div>
        <p class="book-title text-[#2E2E2E] text-sm font-semibold leading-tight">bulan</p>
        <p class="text-[#626F47] text-xs font-semibold mt-1">Penulis Buku</p>
      </div>
      <div class="border-t border-[#E0D6B8] my-2"></div>
      <div class="flex items-center justify-between">
        <button class="bg-green hover:bg-primary text-white text-xs font-semibold px-6 py-[5px] rounded-full transition">Baca</button>
        <button class="text-red-500 text-lg hover:scale-110 transition"><i class="fa-solid fa-heart"></i></button>
      </div>
    </div>
  </div>

   <div class="book-card bg-white rounded-xl shadow-md border border-[#E0D6B8] overflow-hidden p-3 flex gap-3 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
    <img src="{{ asset('assets/buku1.jpg') }}" class="w-16 h-24 object-cover shadow-md rounded-md flex-shrink-0">
    <div class="flex flex-col justify-between flex-grow">
      <div>
        <p class="book-title text-[#2E2E2E] text-sm font-semibold leading-tight">bumi</p>
        <p class="text-[#626F47] text-xs font-semibold mt-1">Penulis Buku</p>
      </div>
      <div class="border-t border-[#E0D6B8] my-2"></div>
      <div class="flex items-center justify-between">
        
        <button class="bg-green hover:bg-primary text-white text-xs font-semibold px-6 py-[5px] rounded-full transition">Baca</button>
        <button class="text-red-500 text-lg hover:scale-110 transition"><i class="fa-solid fa-heart"></i></button>
      </div>
    </div>
  </div>

   <div class="book-card bg-white rounded-xl shadow-md border border-[#E0D6B8] overflow-hidden p-3 flex gap-3 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
    <img src="{{ asset('assets/buku1.jpg') }}" class="w-16 h-24 object-cover shadow-md rounded-md flex-shrink-0">
    <div class="flex flex-col justify-between flex-grow">
      <div>
        <p class="book-title text-[#2E2E2E] text-sm font-semibold leading-tight">kimia</p>
        <p class="text-[#626F47] text-xs font-semibold mt-1">Penulis Buku</p>
      </div>
      <div class="border-t border-[#E0D6B8] my-2"></div>
      <div class="flex items-center justify-between">
        
        <button class="bg-green hover:bg-primary text-white text-xs font-semibold px-6 py-[5px] rounded-full transition">Baca</button>
        <button class="text-red-500 text-lg hover:scale-110 transition"><i class="fa-solid fa-heart"></i></button>
      </div>
    </div>
  </div>

   <div class="book-card bg-white rounded-xl shadow-md border border-[#E0D6B8] overflow-hidden p-3 flex gap-3 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
    <img src="{{ asset('assets/buku1.jpg') }}" class="w-16 h-24 object-cover shadow-md rounded-md flex-shrink-0">
    <div class="flex flex-col justify-between flex-grow">
      <div>
        <p class="book-title text-[#2E2E2E] text-sm font-semibold leading-tight">fisika</p>
        <p class="text-[#626F47] text-xs font-semibold mt-1">Penulis Buku</p>
      </div>
      <div class="border-t border-[#E0D6B8] my-2"></div>
      <div class="flex items-center justify-between">
        <button class="bg-green hover:bg-primary text-white text-xs font-semibold px-6 py-[5px] rounded-full transition">Baca</button>
        <button class="text-red-500 text-lg hover:scale-110 transition"><i class="fa-solid fa-heart"></i></button>
      </div>
    </div>
  </div>

   <div class="book-card bg-white rounded-xl shadow-md border border-[#E0D6B8] overflow-hidden p-3 flex gap-3 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
    <img src="{{ asset('assets/buku1.jpg') }}" class="w-16 h-24 object-cover shadow-md rounded-md flex-shrink-0">
    <div class="flex flex-col justify-between flex-grow">
      <div>
        <p class="book-title text-[#2E2E2E] text-sm font-semibold leading-tight">bla</p>
        <p class="text-[#626F47] text-xs font-semibold mt-1">Penulis Buku</p>
      </div>
      <div class="border-t border-[#E0D6B8] my-2"></div>
      <div class="flex items-center justify-between">
        <button class="bg-green hover:bg-primary text-white text-xs font-semibold px-6 py-[5px] rounded-full transition">Baca</button>
        <button class="text-red-500 text-lg hover:scale-110 transition"><i class="fa-solid fa-heart"></i></button>
      </div>
    </div>
  </div>

</div>
</main>
@include('layout_dashboard.partial_dashboard.footer')
<script src="{{asset('assets_user/js/dashboard.js')}}"></script>
<script>
document.getElementById('searchBuku').addEventListener('keyup', function() {
  let keyword = this.value.toLowerCase();
  let cards = document.querySelectorAll('.book-card');

  cards.forEach(card => {
    let title = card.querySelector('.book-title').textContent.toLowerCase();
    
    if(title.includes(keyword)) {
      card.style.display = "flex"; 
    } else {
      card.style.display = "none";
    }
  });
});
</script>


</body>
</html>