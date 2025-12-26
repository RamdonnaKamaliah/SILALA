@extends('layout_admin.admin')
@section('pageTitle', 'Admin Dashboard - Data Arsip')


@section('content')

    <div class="p-4 md:p-6 font-poppins">
        <!-- Header Section -->
        <div class="mb-6 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-xl p-6 text-white shadow-lg">
            <div class="flex items-center space-x-4">
                <div class="bg-white/20 p-3 rounded-lg shadow-md">
                    <i class="fas fa-archive text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold mb-1">Data Buku Terarsip</h1>
                    <p class="text-white/90 text-sm md:text-base">Kelola buku yang telah diarsipkan</p>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-3 mt-4 text-white/80">
                <div class="flex items-center space-x-2 bg-white/10 px-3 py-2 rounded-lg shadow-sm">
                    <i class="fas fa-books text-sm"></i>
                    <span class="text-sm font-medium">Total: <strong>{{ $buku_arsip->count() }}</strong> buku</span>
                </div>
                <div class="flex items-center space-x-2 bg-white/10 px-3 py-2 rounded-lg shadow-sm">
                    <i class="fas fa-clock text-sm"></i>
                    <span class="text-sm font-medium">Terakhir diupdate: {{ now()->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Bulk Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 mb-6">
            <form id="bulkDeleteArchiveForm" action="{{ route('admin.data_arsip.bulkDeleteArchive') }}" method="POST"
                class="flex-1">
                @csrf
                <input type="hidden" name="selected_ids" id="selectedIds">
                <button type="submit" id="bulkDeleteBtn" disabled
                    class="w-full flex items-center justify-center space-x-3 px-4 py-3
                       bg-red-500 text-white rounded-xl font-semibold cursor-not-allowed
                       hover:bg-red-600 transition-all duration-300 text-sm shadow-md
                       transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed
                       disabled:hover:scale-100">
                    <i class="fas fa-trash-alt text-sm"></i>
                    <span>Hapus Data Terpilih</span>
                </button>
            </form>

            <form action="{{ route('admin.data_arsip.bulkRestore') }}" method="POST" id="bulkRestoreForm" class="flex-1">
                @csrf
                <input type="hidden" name="selected_ids" id="selectedIdsRestore">
                <button type="submit" id="bulkRestoreBtn" disabled
                    class="w-full flex items-center justify-center space-x-3 px-4 py-3
                       bg-green-500 text-white rounded-xl font-semibold cursor-not-allowed
                       hover:bg-green-600 transition-all duration-300 text-sm shadow-md
                       transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed
                       disabled:hover:scale-100">
                    <i class="fas fa-undo-alt text-sm"></i>
                    <span>Pulihkan Data Terpilih</span>
                </button>
            </form>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <!-- Table Header -->
            <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 px-4 py-4">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 bg-[#A4B465] rounded-full shadow-sm"></div>
                        <h2 class="text-lg font-bold text-gray-800">Daftar Buku Terarsip</h2>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <div
                            class="flex items-center space-x-2 bg-white px-3 py-2 rounded-lg border border-gray-200 shadow-sm">
                            <i class="fas fa-filter text-gray-500 text-sm"></i>
                            <span class="text-sm text-gray-700 font-medium">{{ $buku_arsip->count() }} data ditemukan</span>
                        </div>
                        <div
                            class="flex items-center space-x-2 bg-white px-3 py-2 rounded-lg border border-gray-200 shadow-sm">
                            <input type="checkbox" id="selectAll"
                                class="w-4 h-4 rounded border-gray-300 text-[#A4B465] focus:ring-[#A4B465] focus:ring-2">
                            <label for="selectAll" class="text-sm text-gray-700 font-medium">Pilih Semua</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead
                        class="bg-gradient-to-r from-[#A4B465]/10 to-[#8AA24F]/10 text-gray-700 border-b border-gray-200">
                        <tr>
                            <th class="w-12 px-3 py-4 text-center">
                            </th>
                            <th class="px-4 py-4 text-center font-bold text-gray-900 text-xs uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-4 py-4 text-center font-bold text-gray-900 text-xs uppercase tracking-wider">
                                Cover Buku
                            </th>
                            <th class="px-4 py-4 text-left font-bold text-gray-900 text-xs uppercase tracking-wider">
                                Informasi Buku
                            </th>
                            <th class="px-4 py-4 text-left font-bold text-gray-900 text-xs uppercase tracking-wider">
                                Penulis
                            </th>
                            <th class="px-4 py-4 text-left font-bold text-gray-900 text-xs uppercase tracking-wider">
                                Penerbit
                            </th>
                            <th class="px-4 py-4 text-center font-bold text-gray-900 text-xs uppercase tracking-wider">
                                Tahun
                            </th>
                            <th class="px-4 py-4 text-left font-bold text-gray-900 text-xs uppercase tracking-wider">
                                Kategori
                            </th>
                            <th class="px-4 py-4 text-center font-bold text-gray-900 text-xs uppercase tracking-wider">
                                Stok
                            </th>
                            <th class="px-4 py-4 text-center font-bold text-gray-900 text-xs uppercase tracking-wider">
                                File
                            </th>
                            <th class="px-4 py-4 text-center font-bold text-gray-900 text-xs uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($buku_arsip as $index => $buku)
                            <tr
                                class="hover:bg-gradient-to-r hover:from-[#A4B465]/5 hover:to-[#8AA24F]/5 transition-all duration-300 group">
                                <td class="px-3 py-4 text-center">
                                    <input type="checkbox" name="selected_ids[]" value="{{ $buku->id }}"
                                        class="row-checkbox w-4 h-4 rounded border-gray-300 text-[#A4B465] focus:ring-[#A4B465] focus:ring-2 transition-all">
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span
                                        class="inline-flex items-center justify-center w-7 h-7 bg-gradient-to-br from-[#A4B465] to-[#8AA24F] text-white rounded-full text-xs font-bold shadow-sm">
                                        {{ $index + 1 }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <div
                                        class="w-14 h-20 overflow-hidden rounded-lg border border-gray-200 mx-auto shadow-md group-hover:shadow-lg transition-shadow">
                                        @if ($buku->foto_buku && Storage::disk('public')->exists($buku->foto_buku))
                                            <img src="{{ asset('storage/' . $buku->foto_buku) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('assets/image_default/image_default_book.jpeg') }}"
                                                class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="max-w-xs">
                                        <p
                                            class="font-bold text-gray-900 text-sm line-clamp-2 group-hover:text-[#A4B465] transition-colors">
                                            {{ $buku->judul_buku }}</p>
                                        @if ($buku->edisi)
                                            <p class="text-gray-500 text-xs mt-1 font-medium">Edisi: {{ $buku->edisi }}
                                            </p>
                                        @endif
                                        @if ($buku->isbn ?? false)
                                            <p class="text-gray-400 text-xs mt-1">ISBN: {{ $buku->isbn }}</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <p class="text-gray-700 text-sm line-clamp-1 font-medium">{{ $buku->penulis }}</p>
                                </td>
                                <td class="px-4 py-4">
                                    <p class="text-gray-600 text-sm line-clamp-1 font-medium">{{ $buku->penerbit }}</p>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span
                                        class="inline-flex items-center justify-center px-3 py-1 bg-gradient-to-br from-blue-100 to-blue-200 text-blue-800 rounded-full text-xs font-bold shadow-sm">
                                        <i class="fas fa-calendar-alt text-xs mr-1"></i>
                                        {{ $buku->tahun_terbit }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    @if ($buku->kategoris->count())
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach ($buku->kategoris->take(2) as $kategori)
                                                <span
                                                    class="inline-block px-2.5 py-1 bg-gradient-to-br from-[#A4B465]/20 to-[#8AA24F]/20 text-[#A4B465] rounded-full text-xs font-bold shadow-sm">
                                                    {{ $kategori->nama_kategori }}
                                                </span>
                                            @endforeach
                                            @if ($buku->kategoris->count() > 2)
                                                <span
                                                    class="inline-block px-2.5 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">
                                                    +{{ $buku->kategoris->count() - 2 }}
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic text-xs font-medium">Tidak ada kategori</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span
                                        class="inline-flex items-center justify-center w-9 h-9 bg-gradient-to-br from-green-100 to-green-200 text-green-800 rounded-full text-xs font-bold shadow-sm">
                                        <i class="fas fa-cubes text-xs mr-1"></i>
                                        {{ $buku->stok }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    @php
                                        $path = $buku->file_buku;
                                        $url = Storage::url($path);
                                    @endphp

                                    <a href="{{ $url }}" target="_blank"
                                        class="inline-block bg-blue-600 text-white px-3 py-3 rounded-lg shadow hover:bg-blue-700 text-xs">
                                        <i class="fas fa-file-pdf text-sm"></i>
                                    </a>

                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- Pulihkan - Hijau -->
                                        <form action="{{ route('admin.data_buku.restore', ['id' => $buku->id]) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-full flex items-center justify-center hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-110 group/tooltip relative"
                                                title="Pulihkan Buku">
                                                <i class="fas fa-undo-alt text-xs"></i>
                                                <div
                                                    class="absolute -top-9 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2.5 py-1.5 rounded-lg opacity-0 group-hover/tooltip:opacity-100 transition-all duration-300 whitespace-nowrap shadow-lg z-10">
                                                    Pulihkan Buku
                                                    <div
                                                        class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-gray-800 rotate-45">
                                                    </div>
                                                </div>
                                            </button>
                                        </form>

                                        <!-- Detail - Primary Color -->
                                        <a href="{{ route('admin.data_arsip.show', $buku->id) }}"
                                            class="w-10 h-10 bg-gradient-to-br from-[#A4B465] to-[#8AA24F] text-white rounded-full flex items-center justify-center hover:from-[#8AA24F] hover:to-[#758742] transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-110 group/tooltip relative"
                                            title="Detail Buku">
                                            <i class="fas fa-eye text-xs"></i>
                                            <div
                                                class="absolute -top-9 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2.5 py-1.5 rounded-lg opacity-0 group-hover/tooltip:opacity-100 transition-all duration-300 whitespace-nowrap shadow-lg z-10">
                                                Detail Buku
                                                <div
                                                    class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-gray-800 rotate-45">
                                                </div>
                                            </div>
                                        </a>

                                        <!-- Hapus Permanen - Merah -->
                                        <form action="{{ route('admin.data_arsip.destroy', $buku->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 text-white rounded-full flex items-center justify-center hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-110 group/tooltip relative delete-permanent-btn"
                                                title="Hapus Permanen" data-title="{{ $buku->judul_buku }}">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                                <div
                                                    class="absolute -top-9 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2.5 py-1.5 rounded-lg opacity-0 group-hover/tooltip:opacity-100 transition-all duration-300 whitespace-nowrap shadow-lg z-10">
                                                    Hapus Permanen
                                                    <div
                                                        class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-gray-800 rotate-45">
                                                    </div>
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400 space-y-3">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center shadow-inner">
                                            <i class="fas fa-inbox text-2xl"></i>
                                        </div>
                                        <p class="text-lg font-semibold">Tidak ada buku terarsip</p>
                                        <p class="text-sm text-gray-500 max-w-md">Semua buku saat ini aktif. Buku yang
                                            diarsipkan akan muncul di halaman ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            @if ($buku_arsip->count() > 0)
                <div class="border-t border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 px-4 py-3">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-3 text-sm text-gray-600">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-info-circle text-[#A4B465]"></i>
                            <span>Menampilkan <strong>{{ $buku_arsip->count() }}</strong> buku terarsip</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-xs">Aksi Pulihkan</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                <span class="text-xs">Aksi Hapus</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
