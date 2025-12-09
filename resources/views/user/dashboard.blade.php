@extends('layout_user.user')

@section('title', 'Beranda User')

@section('content')

  <!-- Kartu Sambutan -->
<section class="relative bg-gradient-to-r from-green to-[#A4B465] text-white 
  px-3 py-3 sm:px-4 sm:py-3 md:px-8 md:py-3 rounded-2xl shadow-md 
  flex items-center justify-between overflow-hidden flex-shrink-0">

  <!-- Bintang kiri atas -->
  <img src="{{ asset('assets/logo_bintang.png') }}" alt="star" 
       class="absolute top-1.5 left-3 w-4 sm:w-5 md:w-7 opacity-90 z-20">  

  <!-- Bintang kanan atas -->
  <img src="{{ asset('assets/logo_bintang.png') }}" alt="star" 
       class="absolute top-1.5 right-3 w-4 sm:w-5 md:w-7 opacity-90 z-20"> 

  <!-- Teks sambutan -->
  <div class="z-10 max-w-[70%] sm:max-w-[65%] md:max-w-none">
    <h2 class="text-base sm:text-lg md:text-3xl font-medium text-[#F7EDD6] font-mochiy leading-tight">
      Hallo Rifdah,
    </h2> 
    <p class="text-xs sm:text-sm md:text-base mt-1 text-[#F7EDD6]/90 leading-snug">
      Selamat datang di perpustakaan BPMSPH.<br> 
      Mari jelajahi dunia lewat membaca 
      <img src="{{ asset('assets/emoji_bumi.png') }}" alt="Globe" 
           class="inline w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 align-text-bottom">
    </p> 
  </div>

  <!-- Gambar buku -->
  <div class="z-10 w-20 sm:w-24 md:w-36 lg:w-40 relative flex-shrink-0 ml-2 sm:ml-4"> 
    <img src="{{ asset('assets/logo_buku.png') }}" alt="Welcome" 
         class="w-full drop-shadow-lg"> 
  </div> 

  <!-- Efek lembut -->
  <div class="absolute inset-0 bg-gradient-to-r from-[#A4B465]/20 to-transparent 
              backdrop-blur-[1px] rounded-2xl"></div> 
</section>

<!-- CARD STATISTIK -->
<section class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mt-6 px-2">

  <!-- Sedang Dipinjam -->
  <div class="bg-green px-6 pt-2 pb-4 rounded-2xl shadow-md relative overflow-hidden">
    <span class="iconify absolute left-2 -top-2 text-[70px] text-cream"
      data-icon="mdi:book-plus" ></span>
    <div class="ml-[78px] mt-[4px] leading-tight">
      <p class="text-sm text-white font-medium">Sedang dipinjam</p>
      <h3 class="text-lg font-mochiy text-white">{{ $dipinjam }} Buku</h3>
    </div>
  </div>

  <!-- Telat -->
  <div class="bg-green px-6 pt-2 pb-4 rounded-2xl shadow-md relative overflow-hidden">
    <span class="iconify absolute left-2 -top-2 text-[70px] text-cream"
      data-icon="mdi:book-alert"></span>
    <div class="ml-[78px] mt-[4px] leading-tight">
      <p class="text-sm text-white font-medium">Telat Pengembalian</p>
      <h3 class="text-lg font-mochiy text-white">{{ $telat }} Buku</h3>
    </div>
  </div>

  <!-- Favorit -->
  <div class="bg-green px-6 pt-2 pb-4 rounded-2xl shadow-md relative overflow-hidden">
    <span class="iconify absolute left-2 -top-2 text-[70px] text-cream"
      data-icon="mdi:book-heart"></span>
    <div class="ml-[78px] mt-[4px] leading-tight">
      <p class="text-sm text-white font-medium">Favorit</p>
      <h3 class="text-lg font-mochiy text-white">{{ $favorit }} Buku</h3>
    </div>
  </div>

</section>


  <!-- BAGIAN KONTEN YANG SCROLL -->
  <div class="mt-6 overflow-y-auto scrollbar-hide flex-1 pr-2 
    pb-10 md:rounded-b-3xl">
    <!-- Rekomendasi -->
<section class="pb-8">
    <h2 class="text-lg md:text-xl font-medium text-black mb-4 ml-2">Rekomendasi</h2>
    
    @if($bukuRatingTertinggi->isEmpty())
        <p class="text-gray-500 ml-2">Belum ada buku dengan rating.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($bukuRatingTertinggi as $buku)
                <!-- Card Buku -->
                <div class="flex items-start bg-transparent p-3 hover:scale-[1.03] transition-transform duration-300">
                    <div class="relative w-32 h-44 flex-shrink-0">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#00000020] to-transparent rounded-lg shadow-md"></div>
                          @if($buku->foto_buku)
                                <img src="{{ asset($buku->foto_buku) }}" alt="{{ $buku->judul_buku }}"
                                     class="w-full h-full object-cover rounded-lg shadow-lg border border-[#e6e6e6]">
                            @else
                                <img src="{{ asset('assets/default-cover.jpg') }}" alt="{{ $buku->judul_buku }}"
                                     class="w-full h-full object-cover rounded-lg shadow-lg border border-[#e6e6e6]">
                          @endif
                        <div class="absolute right-0 top-0 w-1 h-full bg-[#d1cfcf] rounded-r-lg"></div>
                    </div>
                    
                    <div class="ml-4 flex flex-col justify-between h-full">
                        <div>
                            <h3 class="font-bold text-[#1E1E1E] text-base leading-snug">{{ $buku->judul_buku }}</h3>
                            <p class="text-sm text-gray-600 mb-2">By {{ $buku->penulis }}</p>
                            
                            <!-- Rating Bintang -->
                            @php
                                // Hitung rating rata-rata
                                $avgRating = $buku->ratings()->avg('rating') ?? 0;
                                $fullStars = floor($avgRating);
                                $hasHalfStar = ($avgRating - $fullStars) >= 0.5;
                                $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                            @endphp
                            
                            <div class="flex text-yellow-400 text-sm space-x-1 mb-2">
                                @for($i = 0; $i < $fullStars; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                
                                @if($hasHalfStar)
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                @endif
                                
                                @for($i = 0; $i < $emptyStars; $i++)
                                    <i class="fa-regular fa-star"></i>
                                @endfor
                                
                                <span class="text-gray-500 text-xs ml-1">
                                    ({{ number_format($avgRating, 1) }})
                                </span>
                            </div>
                            
                            <p class="text-xs text-gray-500 mb-1">
                                {{ $buku->penerbit }} • {{ $buku->tahun_terbit }}
                            </p>
                        </div>
                        
                        <a href="{{ route('user.detailbuku', $buku->id) }}" 
                           class="bg-[#626F47] text-white text-xs px-5 py-1.5 rounded-full hover:bg-[#4e5d38] transition w-fit text-center">
                            Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
  </div>
@endsection