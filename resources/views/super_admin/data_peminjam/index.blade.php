@extends('layout_superAdmin.super_admin')

@section('title', 'data peminjaman')

@section('content')

    {{-- NOTIFIKASI DENGAN Z-INDEX TERTINGGI DAN AUTO DISMISS --}}
    @if (session('success'))
        <div id="successNotification" style="background-color: #22c55e !important; opacity: 1 !important;"
            class="fixed top-20 right-4 z-[99999] text-white px-6 py-4 rounded-lg shadow-2xl flex items-center gap-3 border-2 border-green-400 animate-fade-in">
            <i class="fas fa-check-circle text-xl"></i>
            <span class="font-medium">{{ session('success') }}</span>
            <button type="button" onclick="this.parentElement.remove()"
                class="ml-2 text-2xl font-bold hover:text-green-100 transition-colors">×</button>
        </div>
    @endif

    @if (session('error'))
        <div id="errorNotification" style="background-color: #ef4444 !important; opacity: 1 !important;"
            class="fixed top-20 right-4 z-[99999] text-white px-6 py-4 rounded-lg shadow-2xl flex items-center gap-3 border-2 border-red-400 animate-fade-in">
            <i class="fas fa-exclamation-circle text-xl"></i>
            <span class="font-medium">{{ session('error') }}</span>
            <button type="button" onclick="this.parentElement.remove()"
                class="ml-2 text-2xl font-bold hover:text-red-100 transition-colors">×</button>
        </div>
    @endif

    <!-- Header Section -->
    <div class="text-left mb-8 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center space-x-4 mb-3">
            <div class="bg-white/20 p-3 rounded-full">
                <i class="fa-solid fa-id-card text-lg"></i>
            </div>
            <div>
                <h1 class="text-3xl lg:text-4xl font-bold mb-2 text-white">Data Peminjam Buku</h1>
                <p class="text-white text-lg">Kelola data peminjam buku perpustakaan</p>
            </div>
        </div>
        <div class="flex items-center space-x-2 text-sm text-white">
            <i class="fas fa-chart-line"></i>
            <span>Total Peminjam: <strong>{{ $data_peminjam->count() }}</strong></span>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        @if ($data_peminjam->count() > 0)
            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto">
                <table id="dataPeminjamTable" class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-hashtag text-[#A4B465]"></i>
                                    No
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-user text-[#A4B465]"></i>
                                    Peminjam
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-book text-[#A4B465]"></i>
                                    Buku
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-calendar-alt text-[#A4B465]"></i>
                                    Tanggal
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-tag text-[#A4B465]"></i>
                                    Status
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-camera text-[#A4B465]"></i>
                                    Foto Bukti
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-cog text-[#A4B465]"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="tableBody">
                        @foreach ($data_peminjam as $peminjam)
                            @php
                                $isLate =
                                    now()
                                        ->startOfDay()
                                        ->gt(\Carbon\Carbon::parse($peminjam->tanggal_kembali)->startOfDay()) &&
                                    $peminjam->status == 'dipinjam';
                                $isWaiting = $peminjam->status == 'menunggu_konfirmasi';
                                $hasPhoto = !empty($peminjam->foto_bukti_pengembalian);
                                $isMandiri = $peminjam->metode_pengembalian == 'mandiri';

                                // Tambahkan kondisi untuk menampilkan tombol teguran
                                $showTeguranButton = $isWaiting && $isMandiri && $hasPhoto;
                            @endphp
                            @php
                                $isLate =
                                    now()
                                        ->startOfDay()
                                        ->gt(\Carbon\Carbon::parse($peminjam->tanggal_kembali)->startOfDay()) &&
                                    $peminjam->status == 'dipinjam';
                                $isWaiting = $peminjam->status == 'menunggu_konfirmasi';
                                $hasPhoto = !empty($peminjam->foto_bukti_pengembalian);
                                $isMandiri = $peminjam->metode_pengembalian == 'mandiri';
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors duration-150"
                                data-status="{{ $peminjam->status }}">
                                <!-- No -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 text-center">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>

                                <!-- Peminjam -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-[#A4B465] rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-white text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $peminjam->user->name ?? '-' }}
                                            </div>
                                            <div class="text-xs text-gray-500">{{ $peminjam->user->email ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Buku -->
                                <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        <div class="font-semibold text-gray-900 truncate">
                                            {{ $peminjam->buku->judul_buku ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">oleh {{ $peminjam->buku->penulis ?? '-' }}</div>
                                    </div>
                                </td>

                                <!-- Tanggal -->
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <i class="fas fa-sign-out-alt text-[#A4B465] text-xs"></i>
                                            {{ \Carbon\Carbon::parse($peminjam->tanggal_pinjam)->translatedFormat('d M Y') }}
                                        </div>
                                        <div
                                            class="flex items-center gap-2 text-sm {{ $isLate ? 'text-red-600 font-semibold' : 'text-gray-600' }}">
                                            <i class="fas fa-sign-in-alt text-[#A4B465] text-xs"></i>
                                            {{ \Carbon\Carbon::parse($peminjam->tanggal_kembali)->translatedFormat('d M Y') }}
                                            @if ($isLate && $peminjam->status == 'dipinjam')
                                                <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">
                                                    Telat {{ $peminjam->hari_telat }} hari
                                                </span>
                                            @endif
                                        </div>
                                        @if ($peminjam->waktu_pengembalian_aktual)
                                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                                <i class="fas fa-history text-[#A4B465] text-xs"></i>
                                                Dikembalikan:
                                                {{ \Carbon\Carbon::parse($peminjam->waktu_pengembalian_aktual)->translatedFormat('d M Y') }}
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @if ($peminjam->status == 'dipinjam')
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold {{ $isLate ? 'bg-red-100 text-red-800 border border-red-200' : 'bg-blue-100 text-blue-800 border border-blue-200' }}">
                                            <i
                                                class="fas {{ $isLate ? 'fa-exclamation-triangle' : 'fa-book' }} mr-1.5"></i>
                                            {{ $isLate ? 'Terlambat' : 'Dipinjam' }}
                                        </span>
                                    @elseif($peminjam->status == 'menunggu_konfirmasi')
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                            <i class="fas fa-clock mr-1.5"></i>
                                            Menunggu Konfirmasi
                                            @if ($isMandiri)
                                                <span class="ml-1 text-xs bg-[#A4B465] text-white px-2 py-0.5 rounded-full">
                                                    Mandiri
                                                </span>
                                            @endif
                                        </span>
                                    @elseif($peminjam->status == 'dikembalikan')
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                            <i class="fas fa-check mr-1.5"></i>
                                            Dikembalikan
                                            @if ($peminjam->metode_pengembalian == 'mandiri')
                                                <span class="ml-1 text-xs bg-[#A4B465] text-white px-2 py-0.5 rounded-full">
                                                    Mandiri
                                                </span>
                                            @endif
                                        </span>
                                    @endif
                                </td>

                                <!-- Foto Bukti -->
                                <td class="px-6 py-4">
                                    @if ($hasPhoto)
                                        <button type="button"
                                            onclick="lihatFoto('{{ asset('storage/' . $peminjam->foto_bukti_pengembalian) }}', '{{ $peminjam->buku->judul_buku }}')"
                                            class="bg-[#A4B465] text-white px-3 py-1.5 rounded-lg hover:bg-[#8a9a58] text-xs font-semibold transition-all duration-200 flex items-center gap-2 shadow-sm transform hover:scale-105">
                                            <i class="fas fa-eye text-xs"></i>
                                            Lihat Foto
                                        </button>
                                    @else
                                        <span class="text-xs text-gray-500 italic">Tidak ada foto</span>
                                    @endif
                                </td>

                                <!-- Aksi Desktop -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        @if ($peminjam->status == 'dipinjam')
                                            <!-- Konfirmasi Kembali -->
                                            <form action="{{ route('admin.data_peminjam.kembalikan', $peminjam->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="bg-[#A4B465] text-white px-3 py-2 rounded-lg hover:bg-[#8a9a58] text-xs font-semibold transition-all duration-200 flex items-center gap-2 shadow-sm transform hover:scale-105"
                                                    onclick="return confirm('Konfirmasi pengembalian buku?')">
                                                    <i class="fas fa-undo text-xs"></i>
                                                    Dikembalikan
                                                </button>
                                            </form>
                                        @elseif ($peminjam->status == 'menunggu_konfirmasi')
                                            @if ($showTeguranButton)
                                                <!-- Tombol Teguran -->
                                                <button type="button"
                                                    onclick="showTeguranModal({{ $peminjam->id }}, '{{ addslashes($peminjam->user->name) }}')"
                                                    class="bg-yellow-500 text-white px-3 py-2 rounded-lg hover:bg-yellow-600 text-xs font-semibold transition-all duration-200 flex items-center gap-2 shadow-sm transform hover:scale-105"
                                                    title="Kirim Teguran">
                                                    <i class="fas fa-exclamation-triangle text-xs"></i>
                                                    Teguran
                                                </button>
                                            @endif

                                            <!-- Konfirmasi Pengembalian dari User -->
                                            <form action="{{ route('admin.data_peminjam.konfirmasi', $peminjam->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="bg-green text-white px-3 py-2 rounded-lg hover:bg-green-700 text-xs font-semibold transition-all duration-200 flex items-center gap-2 shadow-sm transform hover:scale-105"
                                                    onclick="return confirm('Konfirmasi pengembalian buku dari user?')">
                                                    <i class="fas fa-check text-xs"></i>
                                                    Konfirmasi
                                                </button>
                                            </form>
                                        @elseif ($peminjam->status == 'dikembalikan')
                                            <span
                                                class="inline-flex items-center px-3 py-2 bg-green-100 text-green-800 rounded-lg text-xs font-semibold">
                                                <i class="fas fa-check-circle mr-1.5"></i>
                                                Selesai
                                            </span>

                                            <!-- Tombol Batalkan Teguran jika ada teguran -->
                                            @if ($peminjam->keterangan && str_contains($peminjam->keterangan, 'Teguran:'))
                                                <form
                                                    action="{{ route('admin.data_peminjam.batalkan-teguran', $peminjam->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-gray-500 text-white px-3 py-2 rounded-lg hover:bg-gray-600 text-xs font-semibold transition-all duration-200 flex items-center gap-2 shadow-sm transform hover:scale-105"
                                                        onclick="return confirm('Batalkan teguran ini?')">
                                                        <i class="fas fa-times text-xs"></i>
                                                        Batalkan Teguran
                                                    </button>
                                                </form>
                                            @endif
                                        @endif

                                        <!-- Tombol Detail -->
                                        <a href="{{ route('superadmin.data_peminjam.show', $peminjam->id) }}"
                                            class="bg-gray-600 text-white px-3 py-2 rounded-lg hover:bg-gray-700 text-xs font-semibold transition-all duration-200 flex items-center gap-2 shadow-sm transform hover:scale-105"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye text-xs"></i>
                                            Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="lg:hidden space-y-4 p-4">
                @foreach ($data_peminjam as $peminjam)
                    @php
                        $isLate =
                            now()
                                ->startOfDay()
                                ->gt(\Carbon\Carbon::parse($peminjam->tanggal_kembali)->startOfDay()) &&
                            $peminjam->status == 'dipinjam';
                        $isWaiting = $peminjam->status == 'menunggu_konfirmasi';
                        $hasPhoto = !empty($peminjam->foto_bukti_pengembalian);
                        $isMandiri = $peminjam->metode_pengembalian == 'mandiri';
                    @endphp
                    <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm hover:shadow-md transition-all duration-200"
                        data-status="{{ $peminjam->status }}">
                        <!-- Header Card -->
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-[#A4B465] rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $peminjam->user->name ?? '-' }}</h3>
                                    <p class="text-xs text-gray-500">{{ $peminjam->user->email ?? '' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                @if ($peminjam->status == 'dipinjam')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $isLate ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                        <i class="fas {{ $isLate ? 'fa-exclamation-triangle' : 'fa-book' }} mr-1"></i>
                                        {{ $isLate ? 'Terlambat' : 'Dipinjam' }}
                                    </span>
                                @elseif($peminjam->status == 'menunggu_konfirmasi')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        Menunggu
                                        @if ($isMandiri)
                                            <span class="ml-1 text-xs bg-[#A4B465] text-white px-1 py-0.5 rounded-full">
                                                M
                                            </span>
                                        @endif
                                    </span>
                                @elseif($peminjam->status == 'dikembalikan')
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>
                                        Dikembalikan
                                        @if ($isMandiri)
                                            <span class="ml-1 text-xs bg-[#A4B465] text-white px-1 py-0.5 rounded-full">
                                                M
                                            </span>
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Book Info -->
                        <div class="mb-3">
                            <h4 class="font-semibold text-gray-900 text-sm mb-1">{{ $peminjam->buku->judul_buku ?? '-' }}
                            </h4>
                            <p class="text-xs text-gray-600">oleh {{ $peminjam->buku->penulis ?? '-' }}</p>
                        </div>

                        <!-- Dates -->
                        <div class="mb-4 space-y-2">
                            <div class="flex justify-between">
                                <p class="text-xs text-gray-500">Tanggal Pinjam:</p>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($peminjam->tanggal_pinjam)->translatedFormat('d M Y') }}
                                </p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-xs text-gray-500">Tanggal Kembali:</p>
                                <p
                                    class="text-sm font-medium {{ $isLate && $peminjam->status == 'dipinjam' ? 'text-red-600' : 'text-gray-900' }}">
                                    {{ \Carbon\Carbon::parse($peminjam->tanggal_kembali)->translatedFormat('d M Y') }}
                                    @if ($isLate && $peminjam->status == 'dipinjam')
                                        <span class="text-xs bg-red-100 text-red-800 px-1.5 py-0.5 rounded-full ml-1">
                                            +{{ $peminjam->hari_telat }} hari
                                        </span>
                                    @endif
                                </p>
                            </div>
                            @if ($peminjam->waktu_pengembalian_aktual)
                                <div class="flex justify-between">
                                    <p class="text-xs text-gray-500">Dikembalikan:</p>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($peminjam->waktu_pengembalian_aktual)->translatedFormat('d M Y H:i') }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Foto Bukti -->
                        @if ($hasPhoto)
                            <div class="mb-4">
                                <button type="button"
                                    onclick="lihatFoto('{{ asset('storage/' . $peminjam->foto_bukti_pengembalian) }}', '{{ $peminjam->buku->judul_buku }}')"
                                    class="w-full bg-[#A4B465] text-white px-3 py-2 rounded-lg hover:bg-[#8a9a58] text-xs font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                                    <i class="fas fa-eye text-xs"></i>
                                    Lihat Foto Bukti Pengembalian
                                </button>
                            </div>
                        @endif

                        <!-- Actions Mobile -->
                        <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-200">
                            @if ($peminjam->status == 'dipinjam')
                                <form action="{{ route('admin.data_peminjam.kembalikan', $peminjam->id) }}"
                                    method="POST" class="flex-1 min-w-[120px]">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="w-full bg-[#A4B465] text-white px-3 py-2 rounded-lg hover:bg-[#8a9a58] text-xs font-semibold transition-all duration-200 flex items-center justify-center gap-2"
                                        onclick="return confirm('Konfirmasi pengembalian buku?')">
                                        <i class="fas fa-undo text-xs"></i>
                                        Kembalikan
                                    </button>
                                </form>
                            @elseif ($peminjam->status == 'menunggu_konfirmasi')
                                <!-- Hanya tampilkan tombol teguran jika metode pengembalian mandiri -->
                                @if ($peminjam->metode_pengembalian == 'mandiri' && $hasPhoto)
                                    <!-- Teguran Button Mobile -->
                                    <button type="button"
                                        onclick="showTeguranModal({{ $peminjam->id }}, '{{ addslashes($peminjam->user->name) }}')"
                                        class="flex-1 min-w-[100px] bg-yellow-500 text-white px-3 py-2 rounded-lg hover:bg-yellow-600 text-xs font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                                        <i class="fas fa-exclamation-triangle text-xs"></i>
                                        Teguran
                                    </button>
                                @endif

                                <!-- Konfirmasi Pengembalian dari User -->
                                <form action="{{ route('admin.data_peminjam.konfirmasi', $peminjam->id) }}"
                                    method="POST" class="flex-1 min-w-[120px]">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="w-full bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700 text-xs font-semibold transition-all duration-200 flex items-center justify-center gap-2"
                                        onclick="return confirm('Konfirmasi pengembalian buku dari user?')">
                                        <i class="fas fa-check text-xs"></i>
                                        Konfirmasi
                                    </button>
                                </form>
                            @elseif ($peminjam->status == 'dikembalikan')
                                <span
                                    class="inline-flex items-center px-3 py-2 bg-green-100 text-green-800 rounded-lg text-xs font-semibold w-full justify-center">
                                    <i class="fas fa-check-circle mr-1.5"></i>
                                    Selesai
                                </span>

                                <!-- Batalkan Teguran Button Mobile -->
                                @if ($peminjam->keterangan && str_contains($peminjam->keterangan, 'Teguran:'))
                                    <form action="{{ route('admin.data_peminjam.batalkan-teguran', $peminjam->id) }}"
                                        method="POST" class="flex-1 min-w-[120px]">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full bg-gray-500 text-white px-3 py-2 rounded-lg hover:bg-gray-600 text-xs font-semibold transition-all duration-200 flex items-center justify-center gap-2"
                                            onclick="return confirm('Batalkan teguran ini?')">
                                            <i class="fas fa-times text-xs"></i>
                                            Batalkan Teguran
                                        </button>
                                    </form>
                                @endif
                            @endif

                            <a href="{{ route('superadmin.data_peminjam.show', $peminjam->id) }}"
                                class="flex-1 min-w-[80px] bg-gray-600 text-white px-3 py-2 rounded-lg hover:bg-gray-700 text-xs font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                                <i class="fas fa-eye text-xs"></i>
                                Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Empty State untuk Filter -->
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
                <div class="text-gray-400 text-4xl">
                    <i class="fas fa-inbox"></i>
                </div>
            </div>
        @endif
    </div>
    </div>

    <!-- Modal untuk Melihat Foto -->
    <div id="fotoModal" class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black/70 p-4">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden w-full max-w-sm sm:max-w-md md:max-w-lg">
            <!-- Header -->
            <div class="flex justify-between items-center bg-[#4C6444] text-white px-4 py-3">
                <h3 class="text-base font-semibold truncate text-white" id="fotoModalTitle">Foto Bukti</h3>
                <button type="button" onclick="tutupFotoModal()" class="text-white hover:text-gray-200 text-lg">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Content -->
            <div class="p-4">
                <!-- Book Info -->
                <div class="text-center mb-3">
                    <p class="text-gray-600 text-sm truncate" id="fotoModalSubtitle"></p>
                </div>

                <!-- Photo -->
                <div class="flex justify-center mb-4">
                    <img id="fotoModalImage" src="" alt="Foto Bukti"
                        class="w-full max-h-[40vh] object-contain rounded-lg border border-gray-200">
                </div>

                <!-- Buttons -->
                <div class="flex justify-center gap-2">
                    <button type="button" onclick="tutupFotoModal()"
                        class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 text-sm font-medium transition-colors duration-200 flex items-center gap-1">
                        <i class="fas fa-times text-xs"></i>
                        Tutup
                    </button>
                    <button type="button" onclick="downloadFoto()"
                        class="bg-[#A4B465] text-white px-4 py-2 rounded-lg hover:bg-[#8a9a58] text-sm font-medium transition-colors duration-200 flex items-center gap-1">
                        <i class="fas fa-download text-xs"></i>
                        Download
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal untuk Kirim Teguran - VERSI FORM BIASA -->
    <div id="teguranModal" class="hidden fixed inset-0 z-[10000] flex items-center justify-center bg-black/70 p-4">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden w-full max-w-md">
            <!-- Header -->
            <div class="flex justify-between items-center bg-yellow-500 text-white px-4 py-3">
                <h3 class="text-base font-semibold truncate text-white">Kirim Teguran</h3>
                <button type="button" onclick="tutupTeguranModal()" class="text-white hover:text-gray-200 text-lg">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Content - FORM BIASA -->
            <form id="teguranForm" method="POST" action="" class="p-4">
                @csrf

                <!-- Info Peminjam -->
                <div class="mb-4">
                    <p class="text-sm text-gray-600 mb-1">Untuk: <span id="teguranNamaPeminjam"
                            class="font-semibold text-gray-900"></span></p>
                    <input type="hidden" name="peminjaman_id" id="peminjaman_id">
                </div>

                <!-- Pesan Teguran -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-exclamation-triangle text-yellow-500 mr-1"></i>
                        Pesan Teguran
                    </label>

                    <!-- Quick Teguran Buttons -->
                    <div class="grid grid-cols-2 gap-2 mb-3">
                        <button type="button" onclick="setTeguranMessage('Buku tidak terfoto dengan jelas')"
                            class="text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 px-3 py-2 rounded-lg hover:bg-yellow-100 transition-colors">
                            Buku tidak terfoto
                        </button>
                        <button type="button" onclick="setTeguranMessage('Foto tidak jelas / blur')"
                            class="text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 px-3 py-2 rounded-lg hover:bg-yellow-100 transition-colors">
                            Foto tidak jelas
                        </button>
                        <button type="button" onclick="setTeguranMessage('Buku terlihat rusak')"
                            class="text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 px-3 py-2 rounded-lg hover:bg-yellow-100 transition-colors">
                            Buku rusak
                        </button>
                        <button type="button" onclick="setTeguranMessage('Foto tidak sesuai dengan buku')"
                            class="text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 px-3 py-2 rounded-lg hover:bg-yellow-100 transition-colors">
                            Foto tidak sesuai
                        </button>
                    </div>

                    <!-- Textarea untuk pesan custom -->
                    <textarea name="pesan_teguran" id="pesan_teguran" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 text-sm"
                        placeholder="Tulis pesan teguran atau pilih salah satu template di atas..." required></textarea>
                    <p class="text-xs text-gray-500 mt-1">Teguran akan muncul di riwayat peminjaman user</p>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="tutupTeguranModal()"
                        class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 text-sm font-medium transition-colors duration-200 flex items-center gap-1">
                        <i class="fas fa-times text-xs"></i>
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 text-sm font-medium transition-colors duration-200 flex items-center gap-1">
                        <i class="fas fa-paper-plane text-xs"></i>
                        Kirim Teguran
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#dataPeminjamTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                searching: true,
                info: true,
                dom: '<"flex flex-col sm:flex-row justify-between items-center gap-4 mb-4 px-4 pt-4"lf>rt<"flex flex-col sm:flex-row justify-between items-center gap-4 mt-4 px-4 pb-4"ip>',
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "›",
                        previous: "‹"
                    }
                },
                columnDefs: [{
                        orderable: false,
                        targets: [5, 6]
                    } // Foto & Aksi tidak bisa di-sort
                ]
            });

            // Custom styling untuk DataTables elements
            $('.dataTables_length select').addClass(
                'px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465]'
                );
            $('.dataTables_filter input').addClass(
                'px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] ml-2'
                );
            $('.dataTables_length label, .dataTables_filter label').addClass('text-sm text-gray-700 font-medium');
            $('.dataTables_info').addClass('text-sm text-gray-600');
            $('.dataTables_paginate').addClass('flex gap-1');
            $('.paginate_button').addClass(
                'px-3 py-1 border border-gray-300 rounded-lg text-sm hover:bg-[#A4B465] hover:text-white hover:border-[#A4B465] transition-colors'
                );
            $('.paginate_button.current').addClass('bg-[#A4B465] text-white border-[#A4B465]');
            $('.paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');
        });

        function lihatFoto(fotoUrl, judulBuku) {
            const modal = document.getElementById('fotoModal');
            const modalImage = document.getElementById('fotoModalImage');
            const modalTitle = document.getElementById('fotoModalTitle');
            const modalSubtitle = document.getElementById('fotoModalSubtitle');

            modalTitle.textContent = 'Foto Bukti Pengembalian';
            modalSubtitle.textContent = `Buku: ${judulBuku}`;
            modalImage.src = fotoUrl;
            modalImage.alt = `Foto bukti pengembalian buku ${judulBuku}`;

            // Simpan URL untuk download
            modalImage.dataset.downloadUrl = fotoUrl;

            modal.classList.remove('hidden');
        }

        // Fungsi untuk menutup modal foto
        function tutupFotoModal() {
            document.getElementById('fotoModal').classList.add('hidden');
        }

        // Fungsi untuk download foto
        function downloadFoto() {
            const fotoUrl = document.getElementById('fotoModalImage').dataset.downloadUrl;
            const judulBuku = document.getElementById('fotoModalSubtitle').textContent.replace('Buku: ', '');

            if (fotoUrl) {
                const link = document.createElement('a');
                link.href = fotoUrl;
                link.download = `bukti-pengembalian-${judulBuku.toLowerCase().replace(/\s+/g, '-')}-${Date.now()}.jpg`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }

        // Close modal when clicking outside
        document.getElementById('fotoModal').addEventListener('click', function(e) {
            if (e.target.id === 'fotoModal') {
                tutupFotoModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                tutupFotoModal();
            }
        });

        // Fungsi untuk menampilkan modal teguran - VERSI SIMPLE
        function showTeguranModal(peminjamanId, namaPeminjam) {
            const modal = document.getElementById('teguranModal');
            const form = document.getElementById('teguranForm');
            const peminjamField = document.getElementById('teguranNamaPeminjam');
            const peminjamIdField = document.getElementById('peminjaman_id');

            // Set data
            peminjamField.textContent = namaPeminjam;
            peminjamIdField.value = peminjamanId;

            // Set form action langsung
            form.action = `/admin/data_peminjam/${peminjamanId}/teguran`;

            // Reset textarea
            document.getElementById('pesan_teguran').value = '';

            modal.classList.remove('hidden');
        }

        // Fungsi untuk mengatur pesan teguran dari template
        function setTeguranMessage(message) {
            document.getElementById('pesan_teguran').value = message;
            document.getElementById('pesan_teguran').focus();
        }

        // Fungsi untuk menutup modal teguran
        function tutupTeguranModal() {
            document.getElementById('teguranModal').classList.add('hidden');
        }

        // Tidak perlu event listener submit karena pakai form biasa

        // Close modal when clicking outside
        document.getElementById('teguranModal').addEventListener('click', function(e) {
            if (e.target.id === 'teguranModal') {
                tutupTeguranModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                tutupTeguranModal();
            }
        });
    </script>
@endpush
