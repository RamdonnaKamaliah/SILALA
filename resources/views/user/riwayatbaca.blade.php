@extends('layout_user.user')

@section('title', 'riwayat baca User')

@section('content')
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

      <!-- Input Pencarian Riwayat Baca -->
      <div class="relative w-full md:w-64">
        <input type="text" 
               placeholder="Cari di riwayat baca..."
               id="search-riwayat"
               class="w-full rounded-full bg-white border border-[#E0D6B8] pl-4 pr-10 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#C5B78B]" />
        <span class="iconify absolute right-3 top-1/2 -translate-y-1/2 text-[#626F47]" 
              data-icon="mdi:magnify" 
              style="font-size:20px;"></span>
      </div>
    </div>

    <!-- Grid Buku -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6" id="riwayat-container">
      @forelse($riwayat as $data)
      <a href="{{ route('user.detailbuku', ['id' => $data->buku->id, 'from' => 'riwayatbaca']) }}" 
         class="riwayat-card transition-transform duration-300 hover:scale-105 bg-white rounded-xl p-3 shadow-sm block hover:no-underline group"
         data-judul="{{ strtolower($data->buku->judul_buku ?? '') }}"
         data-penulis="{{ strtolower($data->buku->penulis ?? '') }}">
        <div class="aspect-[3/4] w-full overflow-hidden rounded-lg bg-gray-100">
          <img src="{{ asset($data->buku->foto_buku ?? 'assets/default-cover.jpg') }}" 
               alt="{{ $data->buku->judul_buku }}" 
               class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
        </div>

        <p class="text-[#2E2E2E] text-center font-semibold text-sm mt-2 group-hover:text-[#626F47] transition-colors duration-200">
          {{ $data->buku->judul_buku ?? '-' }}
        </p>
        <p class="text-[#2E2E2E] text-center text-xs">
          By {{ $data->buku->penulis ?? '-' }}
        </p>

        <div class="flex justify-center mt-1 text-yellow-400 text-xs">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= floor($data->buku->average_rating))
                    <i class="fa-solid fa-star"></i>
                @elseif($i - 0.5 <= $data->buku->average_rating)
                    <i class="fa-solid fa-star-half-stroke"></i>
                @else
                    <i class="fa-regular fa-star"></i>
                @endif
            @endfor
            @if($data->buku->total_ratings > 0)
                <span class="text-gray-600 text-xs ml-1">({{ number_format($data->buku->average_rating, 1) }})</span>
            @endif
        </div>

        <p class="text-center text-xs text-gray-500 mt-1">
          Terakhir dibaca: {{ $data->terakhir_dibaca ? $data->terakhir_dibaca->diffForHumans() : '-' }}
        </p>

        <!-- 🔗 Tombol "Lanjutkan Baca" -->
        <button onclick="event.stopPropagation(); window.open('{{ asset($data->buku->file_buku) }}', '_blank');"
          class="bg-green hover:bg-primary text-white font-semibold text-xs px-4 py-1 rounded-full mx-auto block mt-3 shadow transition-colors duration-200">
          Lanjutkan Baca
        </button>
      </a>
      @empty
        <!-- Tampilan default saat tidak ada riwayat -->
        <div class="no-riwayat-default text-center py-12 col-span-full">
          <div class="text-[#626F47] text-lg font-semibold mb-2">
            Belum ada riwayat baca
          </div>
          <p class="text-gray-500 text-sm">Silakan baca buku terlebih dahulu</p>
        </div>
      @endforelse
      
      <!-- Tampilan saat pencarian tidak menemukan hasil -->
      <div id="no-search-results" class="hidden text-center py-12 col-span-full">
        <div class="text-[#626F47] text-lg font-semibold mb-2">
          Tidak ada buku yang sesuai
        </div>
        <p class="text-gray-500 text-sm">Coba gunakan kata kunci lain</p>
      </div>
    </div>
  
@endsection