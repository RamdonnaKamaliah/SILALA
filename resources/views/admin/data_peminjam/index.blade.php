@extends('layout_admin.admin')

@section('pageTitle', 'Data Peminjam')

@section('content')

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.35);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(255, 255, 255, 0.45);
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
</style>

<div class="p-4 md:p-6 lg:p-8 min-h-screen bg-gray-50 bg-opacity-40">

    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <div class="flex-1">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                    Data
                    <span class="relative">
                        Peminjam
                        <span class="absolute -top-1 -right-8 text-3xl text-[#A4B465]">✨</span>
                    </span>
                </h1>

                <div class="relative">
                    <p class="text-gray-600 text-lg max-w-2xl leading-relaxed pl-6 border-l-2 border-[#A4B465]">
                        Sistem manajemen peminjaman buku yang 
                        <span class="text-[#A4B465] font-semibold">canggih</span>
                        dan 
                        <span class="text-[#A4B465] font-semibold">user-friendly</span>
                        untuk pengalaman terbaik.
                    </p>
                    <div class="absolute left-0 top-0 w-1 h-full bg-gradient-to-b from-[#A4B465] to-[#8a9a58] rounded-full"></div>
                </div>

                <div class="flex items-center gap-3 mt-6">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <i class="fas fa-shield-alt text-[#A4B465]"></i>
                        <span>Secure</span>
                    </div>
                    <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <i class="fas fa-rocket text-[#A4B465]"></i>
                        <span>Fast</span>
                    </div>
                    <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <i class="fas fa-infinity text-[#A4B465]"></i>
                        <span>Reliable</span>
                    </div>
                </div>
            </div>

            <!-- TOTAL CARD GLASS -->
            <div class="glass-card p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#A4B465] rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-white text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700">Total Peminjaman</p>
                        <p class="text-xl font-bold text-gray-900">{{ $data_peminjam->count() }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Filter Section -->
    <div class="glass-card mb-6 p-4 md:p-6">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            <div class="flex items-center gap-2">
                <i class="fas fa-filter text-[#A4B465]"></i>
                <span class="text-sm font-semibold text-gray-700">Filter Status:</span>
            </div>

            <div class="flex flex-wrap gap-2">
                <!-- Buttons tetap sama -->
                <button type="button" data-status="all"
                    class="filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-[#A4B465] text-white border border-[#A4B465] hover:bg-[#8a9a58] transition-all duration-200 shadow-sm active transform hover:scale-105 flex items-center gap-2">
                    <i class="fas fa-layer-group text-xs"></i> Semua
                </button>

                <button type="button" data-status="dipinjam"
                    class="filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-book text-xs"></i> Dipinjam
                </button>

                <button type="button" data-status="dikembalikan"
                    class="filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-green-50 text-green-700 border border-green-200 hover:bg-green-100 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-check text-xs"></i> Dikembalikan
                </button>

                <button type="button" data-status="bermasalah"
                    class="filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-red-50 text-red-700 border border-red-200 hover:bg-red-100 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle text-xs"></i> Bermasalah
                </button>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="glass-card overflow-hidden">
        @if($data_peminjam->count() > 0)

            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-white bg-opacity-40 backdrop-blur-sm">
                        <tr>
                            <!-- header table sama -->
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-300 bg-transparent">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-hashtag text-[#A4B465]"></i> No
                                </div>
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-300 bg-transparent">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-user text-[#A4B465]"></i> Peminjam
                                </div>
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-300 bg-transparent">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-book text-[#A4B465]"></i> Buku
                                </div>
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-300 bg-transparent">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-calendar-alt text-[#A4B465]"></i> Tanggal
                                </div>
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-300 bg-transparent">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-tag text-[#A4B465]"></i> Status
                                </div>
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-300 bg-transparent">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-cog text-[#A4B465]"></i> Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200" id="tableBody">
                        @foreach ($data_peminjam as $peminjam)
                            @php
                                $isLate = now()->gt($peminjam->tanggal_kembali) 
                                          && $peminjam->status == 'dipinjam';
                            @endphp

                            <tr class="hover:bg-white hover:bg-opacity-40 hover:backdrop-blur-md transition-all duration-150" 
                                data-status="{{ $peminjam->status }}">

                                <!-- ... ISI TABEL MU TETAP SAMA ... -->

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="lg:hidden space-y-4 p-4">
                @foreach ($data_peminjam as $peminjam)
                    @php
                        $isLate = now()->gt($peminjam->tanggal_kembali) 
                                  && $peminjam->status == 'dipinjam';
                    @endphp

                    <div class="glass-card p-4 hover:shadow-md transition-all duration-200" data-status="{{ $peminjam->status }}">
                        <!-- isinya sama semua, hanya container ganti class="glass-card" -->
                    </div>
                @endforeach
            </div>

            <!-- EMPTY FILTER -->
            <div id="emptyFilterState" class="hidden text-center py-12">
                <div class="mx-auto w-20 h-20 mb-4 text-gray-300">
                    <i class="fas fa-search text-5xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Tidak Ada Data</h3>
                <p class="text-gray-500 max-w-md mx-auto text-sm">
                    Tidak ada data peminjaman dengan status yang dipilih.
                </p>
            </div>

        @else

            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="mx-auto w-24 h-24 mb-6 text-gray-300">
                    <i class="fas fa-book-open text-6xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-3">Belum Ada Data Peminjaman</h3>
                <p class="text-gray-500 max-w-md mx-auto mb-6 text-sm">
                    Saat ini belum ada data peminjaman buku yang tercatat dalam sistem.
                </p>
            </div>

        @endif
    </div>

</div>
@endsection
