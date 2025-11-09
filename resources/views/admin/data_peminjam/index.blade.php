@extends('layout_admin.admin')

@section('pageTitle', 'Data Peminjam')

@section('content')
<div class="p-4 md:p-6 overflow-x-auto">
    <!-- Judul Halaman -->
    <div class="text-left mb-6">
        <h1 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-2">
            Selamat datang di Dashboard Data Peminjam 🎉
        </h1>
        <p class="text-gray-600">
            Lihat dan pantau seluruh data peminjaman buku perpustakaan.
        </p>
    </div>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-[#A4B465]">Data Peminjaman Buku</h2>
    </div>

    <!-- Tabel Data -->
    <div class="overflow-x-auto mt-4 bg-white rounded-lg shadow-sm border border-gray-200">
        <table id="dataTable" class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-700">
                <tr>
                    <th class="w-16 px-4 py-3 border-b border-gray-200 text-center">No</th>
                    <th class="px-4 py-3 border-b border-gray-200 text-left">Nama Peminjam</th>
                    <th class="px-4 py-3 border-b border-gray-200 text-left">Judul Buku</th>
                    <th class="px-4 py-3 border-b border-gray-200 text-center">Tanggal Pinjam</th>
                    <th class="px-4 py-3 border-b border-gray-200 text-center">Tanggal Kembali</th>
                    <th class="px-4 py-3 border-b border-gray-200 text-center">Status</th>
                    <th class="px-4 py-3 border-b border-gray-200 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($data_peminjam as $peminjam)
                    @php
                        $isLate = now()->gt($peminjam->tanggal_kembali) && $peminjam->status == 'dipinjam';
                    @endphp
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3 text-center font-medium text-gray-600">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900">{{ $peminjam->user->name ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $peminjam->user->email ?? '' }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900">{{ $peminjam->buku->judul_buku ?? '-' }}</div>
                            <div class="text-xs text-gray-500">oleh {{ $peminjam->buku->penulis ?? '-' }}</div>
                        </td>
                        <td class="px-4 py-3 text-center text-gray-600">
                            {{ \Carbon\Carbon::parse($peminjam->tanggal_pinjam)->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="text-gray-600 {{ $isLate ? 'text-red-600 font-semibold' : '' }}">
                                {{ \Carbon\Carbon::parse($peminjam->tanggal_kembali)->translatedFormat('d M Y') }}
                            </div>
                            @if($isLate)
                                <div class="text-xs text-red-500 mt-1">
                                    Terlambat {{ now()->diffInDays($peminjam->tanggal_kembali) }} hari
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($peminjam->status == 'menunggu_konfirmasi')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                    <i class="fas fa-clock mr-1"></i>
                                    Menunggu Konfirmasi
                                </span>
                            @elseif($peminjam->status == 'dipinjam')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $isLate ? 'bg-red-100 text-red-800 border border-red-200' : 'bg-blue-100 text-blue-800 border border-blue-200' }}">
                                    <i class="fas {{ $isLate ? 'fa-exclamation-triangle' : 'fa-book' }} mr-1"></i>
                                    {{ $isLate ? 'Terlambat' : 'Dipinjam' }}
                                </span>
                            @elseif($peminjam->status == 'dikembalikan')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                    <i class="fas fa-check mr-1"></i>
                                    Dikembalikan
                                </span>
                            @elseif($peminjam->status == 'bermasalah')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    Bermasalah
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex flex-col sm:flex-row gap-2 justify-center items-center">
                                @if ($peminjam->status == 'menunggu_konfirmasi')
                                    <!-- Konfirmasi Pinjam -->
                                    <form action="{{ route('admin.data_peminjam.konfirmasi', $peminjam->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="bg-green-600 text-white px-3 py-1.5 rounded-lg hover:bg-green-700 text-xs font-medium transition-colors flex items-center gap-1"
                                            title="Konfirmasi Peminjaman">
                                            <i class="fas fa-check text-xs"></i>
                                            Setujui
                                        </button>
                                    </form>
                                    
                                    <!-- Batalkan Pinjam -->
                                    <form action="{{ route('admin.data_peminjam.batalkan', $peminjam->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1.5 rounded-lg hover:bg-red-700 text-xs font-medium transition-colors flex items-center gap-1"
                                            title="Batalkan Peminjaman"
                                            onclick="return confirm('Yakin ingin membatalkan peminjaman ini?')">
                                            <i class="fas fa-times text-xs"></i>
                                            Tolak
                                        </button>
                                    </form>
                                    
                                @elseif ($peminjam->status == 'dipinjam')
                                    <!-- Konfirmasi Kembali -->
                                    <form action="{{ route('admin.data_peminjam.kembalikan', $peminjam->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700 text-xs font-medium transition-colors flex items-center gap-1"
                                            title="Konfirmasi Pengembalian">
                                            <i class="fas fa-undo text-xs"></i>
                                            Kembalikan
                                        </button>
                                    </form>
                                    
                                    <!-- Laporkan Masalah -->
                                    <form action="{{ route('admin.data_peminjam.masalah', $peminjam->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1.5 rounded-lg hover:bg-red-700 text-xs font-medium transition-colors flex items-center gap-1"
                                            title="Laporkan Masalah"
                                            onclick="return confirm('Yakin melaporkan masalah pada peminjaman ini?')">
                                            <i class="fas fa-exclamation-triangle text-xs"></i>
                                            Masalah
                                        </button>
                                    </form>
                                    
                                @elseif ($peminjam->status == 'dikembalikan')
                                    <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Selesai
                                    </span>
                                @elseif ($peminjam->status == 'bermasalah')
                                    <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        Bermasalah
                                    </span>
                                @endif

                                <!-- Tombol Detail -->
                                <a href="{{ route('admin.data_peminjam.show', $peminjam->id) }}"
                                    class="bg-gray-600 text-white px-3 py-1.5 rounded-lg hover:bg-gray-700 text-xs font-medium transition-colors flex items-center gap-1"
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
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        language: { 
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" 
        },
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        order: [[3, 'desc']], // Urutkan berdasarkan tanggal pinjam terbaru
        columnDefs: [
            { orderable: false, targets: [6] }, // Kolom aksi tidak bisa diurutkan
            { searchable: false, targets: [6] }  // Kolom aksi tidak bisa dicari
        ],
        responsive: true,
        autoWidth: false
    });
});
</script>
@endpush