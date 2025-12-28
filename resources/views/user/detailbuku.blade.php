@extends('layout_user.detail')

@section('title', 'Detail Buku User')

@section('content')
    <div class="max-w-4xl mx-auto px-4">

        <!-- ====== FIXED TOMBOL BACA/PINJAM/FAVORIT ====== -->
        <div class="fixed left-0 right-0 md:left-[320px] md:right-3 z-10 bg-white pt-3 mb-24">
            <div class="max-w-full px-4 md:px-6">
                <div class="flex items-center justify-between mb-2 md:px-0">

                    <div class="flex items-center gap-3 md:ml-[350px]">

                        {{-- Tombol Baca --}}
                        @if ($buku->file_buku && $buku->id)
                            <button id="button" type="button" data-url="{{ route('user.baca', $buku->id) }}" 
                                class="open-pdf bg-primary hover:bg-green text-white font-semibold text-sm px-8 py-1.5 rounded-full shadow-md">
                                Baca
                            </button>
                        @else
                            <button
                                class="bg-gray-400 text-white font-semibold text-sm px-8 py-1.5 rounded-full shadow-md cursor-not-allowed"
                                disabled>
                                Baca
                            </button>
                        @endif

                        {{-- Tombol Pinjam --}}
                        @if ($userBorrow || $stokHabis)
                            <button
                                class="bg-gray-400 text-white font-semibold text-sm px-8 py-1.5 rounded-full shadow-md cursor-not-allowed"
                                disabled>
                                Sedang Dipinjam
                            </button>
                        @else
                            <button id="openPinjamModal"
                                class="bg-kuning text-gray-800 hover:bg-amber-200 font-semibold text-sm px-8 py-1.5 rounded-full shadow-md transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
                                Pinjam
                            </button>
                        @endif
                    </div>

                    {{-- Tombol Favorit --}}
                    <div class="flex items-center">
                        <button id="loveBtn"
                            class="group flex items-center justify-center text-red-400 w-9 h-9 shadow-none bg-transparent transition-all duration-300 transform hover:-translate-y-0.5 hover:scale-110 mr-2 md:mr-[60px]">
                            @if ($isFavorited)
                                <i id="heartIcon"
                                    class="fa-solid fa-heart text-red-500 text-base transition-transform duration-300 group-hover:scale-125"></i>
                            @else
                                <i id="heartIcon"
                                    class="fa-regular fa-heart text-base transition-transform duration-300 group-hover:scale-125"></i>
                            @endif
                        </button>
                    </div>

                </div>

                {{-- Garis bawah --}}
                <div class="w-full">
                    <div class="mx-auto md:ml-[350px] md:mr-[60px] border-t border-gray-300"></div>
                </div>
            </div>
        </div>

        <!-- ====== MODAL PINJAM ====== -->
        <div id="pinjamModal"
            class="fixed inset-0 z-[1050] items-center justify-center bg-black/40 p-4
         {{ $showpinjamModal ?? false ? 'flex' : 'hidden' }}">
            <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden relative">
                <div class="bg-green text-white text-center py-3 font-semibold text-lg">
                    Pinjam Buku
                </div>

                <div class="p-6 space-y-4 text-sm text-gray-800 max-h-[80vh] overflow-y-auto">
                    <div>
                        <label class="font-semibold mb-1 block">Judul Buku</label>
                        <input type="text" value="{{ $buku->judul_buku }}" readonly
                            class="w-full bg-yellow-200 rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
                    </div>

                    <div>
                        <label class="font-semibold mb-1 block">Penulis Buku</label>
                        <input type="text" value="{{ $buku->penulis }}" readonly
                            class="w-full bg-yellow-200 rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
                    </div>

                    <div>
                        <label class="font-semibold mb-1 block">Stok Buku</label>
                        <input type="text" value="{{ $buku->stok ?? '-' }}" readonly
                            class="w-full bg-yellow-200 rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="font-semibold mb-1 block">Tanggal Pinjam</label>
                            <input type="date" id="tglPinjamInput" readonly
                                class="w-full bg-yellow-200 rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
                        </div>

                        <div>
                            <label for="tglKembaliInput" class="font-semibold mb-1 block">Tanggal Kembali</label>
                            <input type="date" id="tglKembaliInput"
                                class="w-full bg-yellow-200 rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
                        </div>
                    </div>

                    <div class="text-[13px] space-y-1">
                        <p class="text-red-600 flex items-center gap-1">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            Maksimal peminjaman <span class="font-semibold">7 hari</span>.
                        </p>
                        <p class="text-red-600 flex items-center gap-1">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            Denda <span class="font-semibold">Rp 1.000/hari</span> jika terlambat.
                        </p>
                        <p class="text-red-600 flex items-center gap-1">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            Maksimal <span class="font-semibold">3 buku</span> yang bisa dipinjam.
                        </p>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 sticky bottom-0 bg-white">
                        <button id="closeModalBtn"
                            class="bg-red-600 text-white font-semibold text-sm px-5 py-1.5 rounded-full shadow-md hover:opacity-90 transition">
                            Batal
                        </button>
                        <button id="konfirmasiPinjam"
                            class="bg-primary text-gray-800 font-semibold text-sm px-5 py-1.5 rounded-full shadow-md hover:opacity-90 transition flex items-center gap-1">
                            <i class="fa-solid fa-check text-gray-800"></i>
                            Konfirmasi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ====== MODAL PDF ====== -->
        <div id="pdfModal"
            class=" fixed inset-0 bg-black/50 backdrop-blur-md z-[99999] flex items-center justify-center p-4 {{ $showPdfModal ?? false ? '' : 'hidden' }} ">
            <div
                class="bg-white w-full max-w-6xl h-[93vh] rounded-[32px] shadow-2xl overflow-hidden flex flex-col border border-gray-300 sm:p-0 p-2">
                <div
                    class="w-full bg-gradient-to-r from-gray-50 to-gray-200 px-6 py-4 border-b flex justify-between items-center shadow-sm">
                    <h2 class="text-xl font-bold text-gray-700 flex items-center gap-3">
                        <span class="iconify" data-icon="mdi:file-document-outline" data-width="26"></span>
                        Preview Dokumen
                    </h2>
                    <button id="closePdfModal" class="p-2 text-[22px] text-gray-600 hover:text-red-600 transition">
                        <span class="iconify" data-icon="mdi:close" data-width="22"></span>
                    </button>
                </div>

                <div class="w-full bg-white border-b px-6 py-3 flex items-center gap-6 shadow-sm">
                    <div class="flex items-center gap-3">
                        <button id="zoomOut"
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-200 hover:bg-gray-300 transition shadow-sm text-gray-700">
                            <span class="iconify" data-icon="mdi:magnify-minus-outline" data-width="22"></span>
                        </button>
                        <button id="zoomIn"
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-200 hover:bg-gray-300 transition shadow-sm text-gray-700">
                            <span class="iconify" data-icon="mdi:magnify-plus-outline" data-width="22"></span>
                        </button>
                        <span id="zoomLabel" class="font-semibold text-gray-700 text-sm ml-2">100%</span>
                    </div>
                    <span class="ml-auto text-sm text-gray-700 bg-gray-100 px-3 py-1.5 rounded-lg shadow-inner">
                        Halaman: <span id="pageCurrent" class="font-bold">1</span> / <span id="pageTotal"
                            class="font-bold">0</span>
                    </span>
                </div>

                <div id="pdfViewer" class="flex-1 overflow-y-auto bg-gray-50 scroll-smooth p-4"></div>
            </div>
        </div>

        <!-- ====== DESKRIPSI BUKU ====== -->
        <div class="pt-6">
            <div class="pr-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 pt-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-3">Deskripsi</h3>
                        <p class="text-sm leading-relaxed text-green">{{ $buku->deskripsi }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-y-3 text-sm text-green">
                        <div>
                            <p class="font-semibold text-gray-800">Penerbit</p>
                            <p>{{ $buku->penulis }}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Tahun Terbit</p>
                            <p>{{ $buku->tahun_terbit }}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Bahasa</p>
                            <p>{{ $buku->bahasa }}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Kategori</p>
                            <p>
                                @if ($buku->kategoris->isNotEmpty())
                                    {{ $buku->kategoris->pluck('nama_kategori')->join(', ') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Jumlah Halaman</p>
                            <p>{{ $buku->jumlah_halaman }}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Edisi</p>
                            <p>{{ $buku->edisi }}</p>
                        </div>
                    </div>
                </div>

                {{-- RATING --}}
                @if (($hasRead || $userBorrow) && Schema::hasTable('ratings'))
                    <div class="w-full flex justify-center mt-8">
                        <div class=" bg-cream_muda p-6 rounded-2xl shadow-lg border border-cream w-[320px] md:w-[420px]">

                            <!-- Judul -->
                            <p class="text-xl font-bold text-gray-700 text-center mb-1">
                                @if ($userRating)
                                    Ubah Rating Buku Ini
                                @else
                                    Beri Rating Buku Ini
                                @endif
                            </p>

                            <p class="text-sm text-gray-500 text-center mb-4">
                                Seberapa bagus buku ini menurutmu?
                            </p>

                            <!-- Bintang -->
                            <div id="starContainer" class="flex items-center justify-center gap-3 mb-5"
                                data-buku-id="{{ $buku->id }}" data-rating-url="{{ route('user.rating.store') }}"
                                data-csrf="{{ csrf_token() }}" data-user-rating="{{ $userRating?->rating ?? 0 }}">

                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="rating-star text-4xl cursor-pointer" data-star="{{ $i }}">
                                        <span class="iconify text-yellow-500"
                                            data-icon="material-symbols:star-outline-rounded"></span>
                                    </span>
                                    </span>
                                @endfor
                            </div>

                            <!-- Tombol -->
                            <div class="flex justify-center mt-4">
                                <button id="submitRating"
                                    data-default-text="{{ $userRating ? 'Update Rating' : 'Kirim Rating' }}"
                                    class="bg-primary hover:bg-green active:scale-95 text-white text-sm font-medium px-7 py-2.5 rounded-xl transition-all shadow opacity-50 cursor-not-allowed"
                                    disabled>
                                    {{ $userRating ? 'Update Rating' : 'Kirim Rating' }}
                                </button>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
