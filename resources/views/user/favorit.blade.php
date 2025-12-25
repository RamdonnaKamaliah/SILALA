@extends('layout_user.user')

@section('title', 'Favorit User')

@section('content')
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

    <!-- Container untuk buku favorit -->
<div id="favorites-container">

    {{-- GRID FAVORIT --}}
    <div 
        id="favorites-grid"
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"
        @if ($favorites->count() === 0) style="display:none" @endif
    >
        @foreach ($favorites as $fav)
            <div class="book-card bg-white rounded-xl shadow-md border border-[#E0D6B8] overflow-hidden p-3 flex gap-3 
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
                        <p class="book-title text-[#2E2E2E] text-sm font-semibold leading-tight">
                            {{ $fav->buku->judul_buku }}
                        </p>
                        <p class="text-[#626F47] text-xs font-semibold mt-1">
                            {{ $fav->buku->penulis }}
                        </p>
                    </div>

                    <div class="border-t border-[#E0D6B8] my-2"></div>

                    <div class="flex items-center justify-between">
                        <button type="button"
                            class="open-pdf bg-green text-white text-xs font-semibold px-6 py-[5px] rounded-full"
                            data-url="{{ route('user.baca', $fav->buku->id) }}"
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
        <div class="text-[#626F47] text-lg font-semibold mb-2">
            Belum ada buku favorit
        </div>
        <p class="text-gray-500 text-sm">
            Tambahkan buku ke favorit untuk melihatnya di sini
        </p>
    </div>

    <!-- Pesan saat tidak ada hasil pencarian -->
    <div id="no-favorites-search" class="hidden text-center py-12">
        <div class="text-[#626F47] text-lg font-semibold mb-2">
            Tidak ada buku yang sesuai
        </div>
        <p class="text-gray-500 text-sm">
            Coba gunakan kata kunci lain
        </p>
    </div>

</div>

    @csrf
@endsection
