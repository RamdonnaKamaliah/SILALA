<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @include('layout_dashboard.partial_dashboard.link')
  <title>SILALA - Riwayat Pinjam</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('assets_user/css/dashboard.css') }}">
</head>
<body class="min-h-screen overflow-x-hidden font-[Ubuntu,sans-serif] bg-white">
  @include('layout_dashboard.partial_dashboard.header')

  <main
  class="pt-8 pb-6 px-6 bg-cream
  relative top-[90px] mb-24
  md:ml-[320px] md:mr-3
  md:rounded-3xl transition-all duration-300 z-30
  flex flex-col overflow-y-auto overflow-x-hidden max-w-full shadow-inner">

    <!-- Filter -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
      <div class="flex flex-col sm:flex-row gap-6">

        <div class="flex flex-col gap-2">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="riwayat" id="pinjam"
              class="accent-[#626F47]"
              @if(request()->is('riwayatbuku')) checked @endif
              onclick="window.location.href='/riwayatbuku'">
            <span class="text-[#626F47] font-semibold text-sm">Riwayat Pinjam</span>
          </label>

          <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="riwayat" id="baca"
              class="accent-[#626F47]"
              @if(request()->is('riwayatbaca')) checked @endif
              onclick="window.location.href='/riwayatbaca'">
            <span class="text-[#626F47] font-semibold text-sm">Riwayat Baca</span>
          </label>
        </div>
      </div>

      <!-- Input Pencarian -->
      <div class="relative w-full md:w-64">
        <input type="text" placeholder="Cari Buku..."
          class="w-full rounded-full bg-white border border-[#E0D6B8] pl-4 pr-10 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#C5B78B]" />
        <span class="iconify absolute right-3 top-1/2 -translate-y-1/2 text-[#626F47]" data-icon="mdi:magnify" style="font-size:20px;"></span>
      </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

  @for($i=1; $i<=10; $i++)
  <div class="transition-transform duration-300 hover:scale-105">

    <img src="{{ asset('assets/buku1.jpg') }}" 
         class="w-[75%] mx-auto rounded-lg transition-all duration-300 object-contain">

    <p class="text-[#2E2E2E] text-center font-semibold text-sm mt-2">Pulang</p>
    <p class="text-[#2E2E2E] text-center text-xs">By Tere Liye</p>

    <div class="flex justify-center mt-1 text-yellow-400">
      <i class="fa-solid fa-star"></i>
      <i class="fa-solid fa-star"></i>
      <i class="fa-solid fa-star"></i>
      <i class="fa-solid fa-star-half-stroke"></i>
      <i class="fa-regular fa-star"></i>
    </div>

    <button class="bg-green hover:bg-primary text-white font-semibold text-xs 
                   px-4 py-1 rounded-full mx-auto block mt-3 shadow transition-colors duration-200">
      Baca
    </button>

  </div>
  @endfor

</div>
  </main>

  @include('layout_dashboard.partial_dashboard.footer')

  <script src="{{asset('assets_user/js/dashboard.js')}}"></script>
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
  <script>
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', function () {
      dropdownMenu.classList.toggle('hidden');
      dropdownButton.querySelector('.iconify').classList.toggle('rotate-180');
    });

    // Klik di luar dropdown → tutup
    document.addEventListener('click', function (e) {
      if (!document.getElementById('dropdownWrapper').contains(e.target)) {
        dropdownMenu.classList.add('hidden');
        dropdownButton.querySelector('.iconify').classList.remove('rotate-180');
      }
    });
  </script>
</body>
</html>
