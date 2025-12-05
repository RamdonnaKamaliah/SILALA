@extends('layout_admin.admin')

@section('pageTitle', 'Detail Peminjaman')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 md:p-6 lg:p-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Breadcrumb & Title -->
            <div class="flex-1">

                <!-- Title -->
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-[#A4B465] rounded-xl flex items-center justify-center">
                        <i class="fas fa-file-alt text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Detail Peminjaman</h1>
                        <p class="text-gray-600 mt-1">Informasi lengkap peminjaman buku</p>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.data_peminjam.index') }}" 
               class="flex items-center gap-3 px-6 py-3 bg-white text-gray-700 rounded-xl border border-gray-300 hover:border-[#A4B465] hover:text-[#A4B465] transition-all duration-200 shadow-sm">
                <i class="fas fa-arrow-left"></i>
                <span class="font-medium">Kembali</span>
            </a>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Left Column - Status & Timeline -->
        <div class="xl:col-span-2 space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-[#A4B465] rounded-lg flex items-center justify-center">
                        <i class="fas fa-info-circle text-white"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Status Peminjaman</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Status Info -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            @if($peminjam->status == 'menunggu_konfirmasi')
                            <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                            </div>
                            <div>
                                <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium border border-yellow-200">
                                    Menunggu Konfirmasi
                                </span>
                                <p class="text-gray-600 text-sm mt-1">Menunggu persetujuan</p>
                            </div>
                            @elseif($peminjam->status == 'dipinjam')
                            <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-book text-blue-600 text-2xl"></i>
                            </div>
                            <div>
                                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium border border-blue-200">
                                    Dipinjam
                                </span>
                                <p class="text-gray-600 text-sm mt-1">Buku sedang dipinjam</p>
                            </div>
                            @elseif($peminjam->status == 'dikembalikan')
                            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check text-green-600 text-2xl"></i>
                            </div>
                            <div>
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium border border-green-200">
                                    Dikembalikan
                                </span>
                                <p class="text-gray-600 text-sm mt-1">Buku sudah dikembalikan</p>
                            </div>
                            @elseif($peminjam->status == 'bermasalah')
                            <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                            </div>
                            <div>
                                <span class="inline-block px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium border border-red-200">
                                    Bermasalah
                                </span>
                                <p class="text-gray-600 text-sm mt-1">Perlu perhatian khusus</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Denda Info -->
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-2">Total Denda</p>
                            <p class="text-2xl font-bold {{ $peminjam->denda > 0 ? 'text-red-600' : 'text-green-600' }} mb-2">
                                Rp {{ number_format($peminjam->denda, 0, ',', '.') }}
                            </p>
                            @if($peminjam->denda > 0)
                            <span class="inline-block px-2 py-1 bg-red-100 text-red-800 rounded text-xs">
                                Perlu pembayaran
                            </span>
                            @else
                            <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded text-xs">
                                Tidak ada denda
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-[#A4B465] rounded-lg flex items-center justify-center">
                        <i class="fas fa-history text-white"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Timeline</h2>
                </div>

                <div class="space-y-4">
                    <!-- Tanggal Pinjam -->
                    <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-sign-out-alt text-white text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Tanggal Pinjam</p>
                            <p class="text-gray-600 text-sm">{{ \Carbon\Carbon::parse($peminjam->tanggal_pinjam)->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>

                    <!-- Batas Kembali -->
                    <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-sign-in-alt text-white text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Batas Pengembalian</p>
                            <p class="text-gray-600 text-sm">{{ \Carbon\Carbon::parse($peminjam->tanggal_kembali)->translatedFormat('d F Y') }}</p>
                            @if(now()->gt($peminjam->tanggal_kembali) && $peminjam->status == 'dipinjam')
                            <p class="text-red-500 text-xs font-medium mt-1">
                                ⚠️ Terlambat {{ now()->diffInDays($peminjam->tanggal_kembali) }} hari
                            </p>
                            @endif
                        </div>
                    </div>

                    <!-- Tanggal Kembali (jika sudah dikembalikan) -->
                    @if($peminjam->status == 'dikembalikan')
                    <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check-circle text-white text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-900">Dikembalikan Pada</p>
                            <p class="text-gray-600 text-sm">{{ \Carbon\Carbon::parse($peminjam->updated_at)->translatedFormat('d F Y H:i') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Peminjam & Aksi -->
        <div class="space-y-6">
            <!-- Info Peminjam -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-[#A4B465] rounded-lg flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Peminjam</h2>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-[#A4B465] rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-user text-white text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 text-lg">{{ $peminjam->user->name ?? '-' }}</h3>
                    <p class="text-gray-600 text-sm">{{ $peminjam->user->email ?? '-' }}</p>
                    
                    <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                        <p class="text-xs text-gray-600">ID Peminjam</p>
                        <p class="font-medium text-gray-900">#{{ $peminjam->user->id ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            @if(in_array($peminjam->status, ['menunggu_konfirmasi', 'dipinjam']))
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-[#A4B465] rounded-lg flex items-center justify-center">
                        <i class="fas fa-bolt text-white"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Aksi Cepat</h2>
                </div>

                <div class="space-y-3">
                    @if ($peminjam->status == 'menunggu_konfirmasi')
                    <form action="{{ route('admin.data_peminjam.konfirmasi', $peminjam->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition-colors flex items-center justify-center gap-2 font-medium">
                            <i class="fas fa-check"></i>
                            Setujui
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.data_peminjam.batalkan', $peminjam->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center gap-2 font-medium"
                            onclick="return confirm('Yakin ingin membatalkan peminjaman ini?')">
                            <i class="fas fa-times"></i>
                            Tolak
                        </button>
                    </form>
                    
                    @elseif ($peminjam->status == 'dipinjam')
                    <form action="{{ route('admin.data_peminjam.kembalikan', $peminjam->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 font-medium">
                            <i class="fas fa-undo"></i>
                            Kembalikan
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.data_peminjam.masalah', $peminjam->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center gap-2 font-medium"
                            onclick="return confirm('Yakin melaporkan masalah pada peminjaman ini?')">
                            <i class="fas fa-exclamation-triangle"></i>
                            Laporkan Masalah
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Informasi Buku -->
    <div class="mt-6 bg-white rounded-xl border border-gray-200 p-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-[#A4B465] rounded-lg flex items-center justify-center">
                <i class="fas fa-book text-white"></i>
            </div>
            <h2 class="text-xl font-semibold text-gray-900">Informasi Buku</h2>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Book Cover -->
            <div class="flex-shrink-0">
                @if($peminjam->buku->foto_buku ?? false)
                <img src="{{ asset($peminjam->buku->foto_buku) }}" 
                     alt="{{ $peminjam->buku->judul_buku }}" 
                     class="w-48 h-64 object-cover rounded-xl shadow-md">
                @else
                <div class="w-48 h-64 bg-gray-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-book-open text-gray-400 text-3xl"></i>
                </div>
                @endif
            </div>
            
            <!-- Book Details -->
            <div class="flex-1">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Column 1 -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Judul Buku</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $peminjam->buku->judul_buku ?? '-' }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Penulis</label>
                            <p class="text-gray-900">{{ $peminjam->buku->penulis ?? '-' }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Penerbit</label>
                            <p class="text-gray-900">{{ $peminjam->buku->penerbit ?? '-' }}</p>
                        </div>
                    </div>
                    
                    <!-- Column 2 -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Tahun Terbit</label>
                            <p class="text-gray-900">{{ $peminjam->buku->tahun_terbit ?? '-' }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">ISBN</label>
                            <p class="text-gray-900">{{ $peminjam->buku->isbn ?? 'Tidak tersedia' }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Kategori</label>
                            <p class="text-gray-900">
                                @if($peminjam->buku->kategoris->isNotEmpty())
                                    {{ $peminjam->buku->kategoris->pluck('nama_kategori')->join(', ') }}
                                @else
                                    Tidak ada kategori
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <label class="block text-sm font-medium text-gray-600 mb-3">Deskripsi</label>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700 text-sm leading-relaxed">
                            {{ $peminjam->buku->deskripsi ?? 'Tidak ada deskripsi yang tersedia untuk buku ini.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
