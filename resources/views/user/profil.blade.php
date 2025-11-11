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

  <div class="min-h-screen bg-[#F3EED9] py-10 px-6">
  <!-- Kartu Header -->
 <div class="bg-white rounded-2xl shadow-md px-8 py-6 flex justify-between items-center max-w-4xl mx-auto -mt-6">
    <div>
      <h1 class="text-xl font-bold text-[#2E2E2E]">Hi, Rifdatul Aisya!</h1>
      <p class="text-sm text-[#626F47] mt-1">Bergabung Sejak 27 Oktober 2025</p>
    </div>

    <div class="w-20 h-20 rounded-full bg-[#F3F7EE] border border-[#C9DABF] flex items-center justify-center overflow-hidden">
      <img src="{{ asset('assets/Profile.jpg') }}" class="w-full h-full object-cover" />
    </div>
  </div>

  <!-- Kartu Informasi -->
  <div class="bg-white rounded-2xl shadow-md mt-10 px-8 py-8 max-w-4xl mx-auto">
    <h2 class="text-center text-xl font-bold text-[#2E2E2E] mb-8">Informasi Tentang Anda!</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

      <!-- Input -->
      <div class="flex items-center gap-3 border border-[#C9DABF] rounded-lg px-3 py-2">
        <i class="fa-solid fa-user text-[#626F47]"></i>
        <input type="text" value="Rifdatul Aisya" class="w-full outline-none text-sm text-[#2E2E2E]" readonly />
      </div>

      <div class="flex items-center gap-3 border border-[#C9DABF] rounded-lg px-3 py-2">
        <i class="fa-solid fa-envelope text-[#626F47]"></i>
        <input type="text" value="rifdatul.a12@gmail.com" class="w-full outline-none text-sm text-[#2E2E2E]" readonly />
      </div>

      <div class="flex items-center gap-3 border border-[#C9DABF] rounded-lg px-3 py-2">
        <i class="fa-solid fa-phone text-[#626F47]"></i>
        <input type="text" value="089567884234" class="w-full outline-none text-sm text-[#2E2E2E]" readonly />
      </div>

      <div class="flex items-center gap-3 border border-[#C9DABF] rounded-lg px-3 py-2">
        <i class="fa-solid fa-briefcase text-[#626F47]"></i>
        <input type="text" value="Magang" class="w-full outline-none text-sm text-[#2E2E2E]" readonly />
      </div>

      <div class="flex items-center gap-3 border border-[#C9DABF] rounded-lg px-3 py-2">
        <i class="fa-solid fa-venus text-[#626F47]"></i>
        <input type="text" value="Wanita" class="w-full outline-none text-sm text-[#2E2E2E]" readonly />
      </div>

      <div class="flex items-center gap-3 border border-[#C9DABF] rounded-lg px-3 py-2">
        <i class="fa-solid fa-calendar text-[#626F47]"></i>
        <input type="text" value="Tanggal Lahir Belum Diisi" class="w-full outline-none text-sm text-[#2E2E2E]" readonly />
      </div>
    </div>

    <!-- Button Edit -->
    <div class="flex justify-center mt-8">
      <button class="bg-[#A4B465] hover:bg-[#8EA653] text-white font-medium px-8 py-2 rounded-full flex items-center gap-2 transition">
        <i class="fa-solid fa-pen"></i> Edit
      </button>
    </div>

  </div>
</div>

</main>

<script src="{{asset('assets_user/js/dashboard.js')}}"></script>
</body>
</html>