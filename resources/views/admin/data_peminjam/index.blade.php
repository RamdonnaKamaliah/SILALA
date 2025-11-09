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
    <div class="overflow-x-auto mt-4">
        <table id="dataTable" class="w-full border border-gray-300 rounded-lg text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="w-16 px-2 py-2 border-b border-gray-300 text-center">No</th>
                    <th class="px-4 py-2 border-b border-gray-300 text-left">Nama Peminjam</th>
                    <th class="px-4 py-2 border-b border-gray-300 text-left">Judul Buku</th>
                    <th class="px-4 py-2 border-b border-gray-300 text-center">Tanggal Pinjam</th>
                    <th class="px-4 py-2 border-b border-gray-300 text-center">Tanggal Kembali</th>
                    <th class="px-4 py-2 border-b border-gray-300 text-center">Status</th>
                    <th class="px-4 py-2 border-b border-gray-300 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_peminjam as $peminjam)
                    <tr class="hover:bg-gray-50">
                        <td class="px-2 py-2 border-b border-gray-300 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-4 py-2 border-b border-gray-300">
                            {{ $peminjam->user->name ?? '-' }}
                        </td>
                        <td class="px-4 py-2 border-b border-gray-300">
                            {{ $peminjam->buku->judul_buku ?? '-' }}
                        </td>
                        <td class="px-4 py-2 border-b border-gray-300 text-center">
                            {{ $peminjam->tanggal_pinjam }}
                        </td>
                        <td class="px-4 py-2 border-b border-gray-300 text-center">
                            {{ $peminjam->tanggal_kembali }}
                        </td>
                        <td class="px-4 py-2 border-b border-gray-300 text-center">
                            <span class="px-3 py-1 rounded-full text-white 
                                {{ $peminjam->status == 'dipinjam' ? 'bg-yellow-500' : 'bg-green-600' }}">
                                {{ ucfirst($peminjam->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border-b border-gray-300 text-center">
    @if ($peminjam->status == 'menunggu_konfirmasi')
        <form action="{{ route('admin.data_peminjam.kembalikan', $peminjam->id) }}" method="POST" class="inline">
            @csrf
            @method('PUT')
            <button type="submit"
                class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                Konfirmasi Kembali
            </button>
        </form>
        <form action="{{ route('admin.data_peminjam.masalah', $peminjam->id) }}" method="POST" class="inline ml-2">
            @csrf
            @method('PUT')
            <button type="submit"
                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                Laporkan Masalah
            </button>
        </form>
    @elseif ($peminjam->status == 'dikembalikan')
        <span class="text-green-600 font-semibold">Selesai</span>
    @elseif ($peminjam->status == 'bermasalah')
        <span class="text-red-600 font-semibold">Bermasalah</span>
    @else
        <span class="text-gray-500">Masih Dipinjam</span>
    @endif

    <a href="{{ route('admin.data_peminjam.show', $peminjam->id) }}"
        class="ml-2 text-green-600 hover:text-green-800 hover:underline">
        Detail
    </a>
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
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        language: { url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" },
        pageLength: 5,
        columnDefs: [
            { orderable: false, targets: [6] },
            { searchable: false, targets: [6] }
        ]
    });
});
</script>
@endpush
