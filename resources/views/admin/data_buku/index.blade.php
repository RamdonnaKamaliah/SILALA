@extends('layout_admin.admin')
@section('pageTitle', 'Data Buku')

@section('content')
<!-- FONT & ICON -->
<div class="p-4 md:p-8 font-[Inter] text-slate-800 bg-gray-50 min-h-screen">

    <!-- HEADER -->
    <div class="text-center mb-8">
        <h1 class="text-2xl md:text-4xl font-bold text-slate-800 mb-2 flex items-center justify-center gap-2 flex-wrap">
            <i class="fa-solid fa-book text-green-700"></i>
            Data Buku Perpustakaan
        </h1>
        <p class="text-gray-500 text-sm md:text-base">
            Kelola dan pantau seluruh koleksi buku dengan mudah dan cepat.
        </p>
    </div>

    <!-- TOMBOL AKSI -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h2 class="text-lg md:text-xl font-semibold text-green-700 flex items-center gap-2">
            <i class="fa-solid fa-list"></i> Daftar Buku
        </h2>
        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <a href="#" class="bg-yellow-400 text-black font-medium px-4 py-2 rounded-lg shadow hover:bg-yellow-500 transition w-full sm:w-auto text-center">
                <i class="fa-solid fa-file-import mr-1"></i> Import
            </a>
            <a href="{{ route('admin.data_buku.create') }}"
               class="bg-green-700 text-white font-medium px-4 py-2 rounded-lg shadow hover:bg-green-800 transition w-full sm:w-auto text-center">
                <i class="fa-solid fa-plus mr-1"></i> Tambah Buku
            </a>
            <button id="bulkDeleteBtn"
                class="bg-gray-400 text-white font-medium px-4 py-2 rounded-lg shadow transition cursor-not-allowed opacity-50 w-full sm:w-auto text-center"
                disabled>
                <i class="fa-solid fa-trash"></i> Hapus Data Terpilih
            </button>
        </div>
    </div>

    <!-- DATA TABLE CONTROL -->
    <div id="datatable-controls"
        class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white border border-gray-200 rounded-2xl shadow p-4 mb-4 gap-3">
        <div class="flex items-center gap-2 text-sm">
            <label for="entries" class="text-gray-700">Show</label>
            <select id="entries" class="border rounded-lg px-2 py-1 focus:ring-2 focus:ring-green-500">
                <option>5</option>
                <option selected>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            <span class="text-gray-700">entries</span>
        </div>
        <div class="flex items-center gap-2 text-sm w-full sm:w-auto">
            <label for="search" class="text-gray-700">Search:</label>
            <input type="text" id="search"
                class="border rounded-lg px-3 py-1 focus:ring-2 focus:ring-green-500 w-full sm:w-auto"
                placeholder="Cari buku...">
        </div>
    </div>

    <!-- TABLE -->
    <form id="bulkDeleteForm" method="POST" action="{{ route('admin.data_buku.bulk-delete') }}">
        @csrf
        <!-- 🔥 GANTI INI KE POST SESUAI ROUTE -->
        {{-- @method('DELETE') --}}

        <div class="bg-white border border-gray-200 rounded-2xl shadow-xl p-0 overflow-hidden">
            <div class="rounded-2xl overflow-hidden">
                <div class="overflow-x-auto p-4 md:p-6">
                    <table id="dataTable" class="w-full text-sm divide-y divide-gray-200 min-w-[1000px]">
                        <thead class="bg-green-700 text-white">
                            <tr>
                                <th class="px-3 py-3 text-center"><input type="checkbox" id="selectAll" class="w-4 h-4"></th>
                                <th class="px-4 py-3 text-center font-semibold">No</th>
                                <th class="px-4 py-3 text-center font-semibold">Foto</th>
                                <th class="px-4 py-3 text-left font-semibold">Judul</th>
                                <th class="px-4 py-3 text-left font-semibold">Penulis</th>
                                <th class="px-4 py-3 text-left font-semibold">Penerbit</th>
                                <th class="px-4 py-3 text-left font-semibold">Tahun Terbit</th>
                                <th class="px-4 py-3 text-left font-semibold">Bahasa</th>
                                <th class="px-4 py-3 text-left font-semibold">Kategori</th>
                                <th class="px-4 py-3 text-left font-semibold">Jumlah Halaman</th>
                                <th class="px-4 py-3 text-left font-semibold">Edisi</th>
                                <th class="px-4 py-3 text-left font-semibold">Stok</th>
                                <th class="px-4 py-3 text-left font-semibold">File</th>
                                <th class="px-4 py-3 text-left font-semibold">Deskripsi</th>
                                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700">
                            @foreach ($data_buku as $buku)
                            <tr class="hover:bg-green-50 transition">
                                <td class="px-3 py-3 text-center">
                                    <input type="checkbox" name="selected_ids[]" value="{{ $buku->id }}" class="row-checkbox w-4 h-4">
                                </td>
                                <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="w-14 h-14 rounded-lg overflow-hidden mx-auto shadow-sm">
                                        @if ($buku->foto_buku)
                                            <img src="{{ asset($buku->foto_buku) }}" class="w-full h-full object-cover hover:scale-110 transition">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                                <i class="fa-solid fa-image text-xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3 font-medium text-slate-800">{{ $buku->judul_buku }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $buku->penulis }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $buku->penerbit }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $buku->tahun_terbit }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $buku->bahasa }}</td>
                                <td class="px-4 py-3 text-gray-600">
                                    @if ($buku->kategoris->count())
                                        {{ $buku->kategoris->pluck('nama_kategori')->join(', ') }}
                                    @else
                                        <span class="italic text-gray-400">Tidak Ada</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ $buku->jumlah_halaman }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $buku->edisi }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $buku->stok }}</td>
                                <td class="px-4 py-3 text-gray-600">
                                    @if ($buku->file_buku)
                                        <a href="{{ asset($buku->file_buku) }}" target="_blank" class="text-green-700 hover:underline">Lihat</a>
                                    @else
                                        <span class="text-gray-400 italic">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ $buku->deskripsi }}</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('admin.data_buku.show', $buku->id) }}" class="text-green-700 hover:text-green-900" title="Detail">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </a>
                                        <a href="{{ route('admin.data_buku.edit', $buku->id) }}" class="text-green-600 hover:text-green-800" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button type="button" class="text-red-600 hover:text-red-800 delete-btn" data-id="{{ $buku->id }}" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
@endsection

@push('styles')
@include('layout_admin.partial_admin.link')
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/assets_admin/js/index-databuku.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endpush