@extends('layout_user.user')

@section('title', 'Favorit User')

@section('content')
    <!-- Pencarian -->
    <div class="w-full">
        <div class="relative w-full mb-8">
            <input id="searchBuku" type="text" placeholder="Cari Buku..."
                class="w-full bg-white border border-white rounded-full py-3 px-5 
             text-sm text-green focus:outline-none shadow-sm">
            <span class="absolute right-4 top-3 text-green text-lg">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
        </div>
    </div>

    <!-- Container untuk buku favorit -->
<div id="favorites-container">

    {{-- GRID FAVORIT --}}
    <div 
        id="favorites-grid"
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"
        @if ($favorites->count() === 0) style="display:none" @endif
    >
        @foreach ($favorites as $fav)
            <div class="book-card bg-white rounded-xl shadow-md border border-white overflow-hidden p-3 flex gap-3 
                hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer"
                data-url="{{ route('user.detailbuku', $fav->buku->id) }}"
                data-book-id="{{ $fav->buku->id }}"
                data-judul="{{ strtolower($fav->buku->judul_buku) }}"
                data-penulis="{{ strtolower($fav->buku->penulis) }}"
            >
                <img src="{{ $fav->buku->foto_buku 
                    ? asset('storage/' . $fav->buku->foto_buku) 
                    : asset('assets/default-cover.jpg') }}"
                    class="w-16 h-24 object-cover shadow-md rounded-md flex-shrink-0"
                >

                <div class="flex flex-col justify-between flex-grow">
                    <div>
                        <p class="book-title text-gray-800 text-sm font-semibold leading-tight">
                            {{ $fav->buku->judul_buku }}
                        </p>
                        <p class="text-green text-xs font-semibold mt-1">
                            {{ $fav->buku->penulis }}
                        </p>
                    </div>

                    <div class="border-t border-gray-400 my-2"></div>

                    <div class="flex items-center justify-between">
                        <button type="button"
                            class="open-pdf bg-green text-white text-xs font-semibold px-6 py-[5px] rounded-full"
                            data-url="{{ route('user.baca', $fav->buku->id) }}"
                            data-title="{{ $fav->buku->judul_buku }}"
                            onclick="event.stopPropagation()"
                        >
                            Baca
                        </button>

                        <button type="button"
                            class="favorite-btn text-red-500 text-lg"
                            data-book-id="{{ $fav->buku->id }}"
                            data-favorit-route="{{ route('user.favorit.toggle') }}"
                        >
                            <i class="fa-solid fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pesan default saat tidak ada favorit sama sekali -->
    <div 
        id="no-favorites-default"
        class="text-center py-12 {{ $favorites->count() > 0 ? 'hidden' : '' }}"
    >
        <div class="text-green text-lg font-semibold mb-2">
            Belum ada buku favorit
        </div>
        <p class="text-gray-500 text-sm">
            Tambahkan buku ke favorit untuk melihatnya di sini
        </p>
    </div>

    <!-- Pesan saat tidak ada hasil pencarian -->
    <div id="no-favorites-search" class="hidden text-center py-12">
        <div class="text-green text-lg font-semibold mb-2">
            Tidak ada buku yang sesuai
        </div>
        <p class="text-gray-500 text-sm">
            Coba gunakan kata kunci lain
        </p>
    </div>

</div>
 <!-- ====== MODAL PDF ====== -->
  <div
  id="pdfModal"
  class="
    fixed inset-0 bg-black/50 backdrop-blur-md z-[99999] flex items-center justify-center p-4 {{ $showPdfModal ?? false ? '' : 'hidden' }} ">
    <div class="bg-white w-full max-w-6xl h-[93vh] rounded-[32px] shadow-2xl overflow-hidden flex flex-col border border-gray-300 sm:p-0 p-2">
      <div class="w-full bg-gradient-to-r from-gray-50 to-gray-200 px-6 py-4 border-b flex justify-between items-center shadow-sm">
        <h2 id="pdfTitle" class="text-xl font-bold text-gray-700 flex items-center gap-3">
          <span class="iconify" data-icon="mdi:file-document-outline" data-width="26"></span>
          Preview Dokumen
        </h2>
        <button id="closePdfModal" class="p-2 text-[22px] text-gray-600 hover:text-red-600 transition">
          <span class="iconify" data-icon="mdi:close" data-width="22"></span>
        </button>
      </div>

      <div class="w-full bg-white border-b px-6 py-3 flex items-center gap-6 shadow-sm">
        <div class="flex items-center gap-3">
          <button id="zoomOut" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-200 hover:bg-gray-300 transition shadow-sm text-gray-700">
            <span class="iconify" data-icon="mdi:magnify-minus-outline" data-width="22"></span>
          </button>
          <button id="zoomIn" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-200 hover:bg-gray-300 transition shadow-sm text-gray-700">
            <span class="iconify" data-icon="mdi:magnify-plus-outline" data-width="22"></span>
          </button>
          <span id="zoomLabel" class="font-semibold text-gray-700 text-sm ml-2">100%</span>
        </div>
        <span class="ml-auto text-sm text-gray-700 bg-gray-100 px-3 py-1.5 rounded-lg shadow-inner">
          Halaman: <span id="pageCurrent" class="font-bold">1</span> / <span id="pageTotal" class="font-bold">0</span>
        </span>
      </div>

      <div id="pdfViewer" class="flex-1 overflow-y-auto bg-gray-50 scroll-smooth p-4"></div>
    </div>
  </div>


    @csrf
@endsection
