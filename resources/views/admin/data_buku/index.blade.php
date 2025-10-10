@extends('layout_admin.admin')
@section('pageTitle', 'Admin Dashboard - Data Buku')
@section('content')

    <div class="p-4 md:p-6 overflow-x-auto">
        <!-- Judul Halaman -->
        <div class="text-left mb-6">
            <h1 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-2">
                Selamat datang di Dashboard Data Buku 🎉
            </h1>
            <p class="text-gray-600">
                Kelola dan pantau seluruh data buku yang tersedia di perpustakaan.
            </p>
        </div>

        <!-- Tombol Tambah Buku -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-[#A4B465]">Data Buku</h2>
            <a href="{{ route('admin.data_buku.create') }}"
                class="bg-blue-500 text-black px-4 py-2 rounded-lg hover:bg-[#8AA24F] transition duration-200">
                + Tambah Buku
            </a>
        </div>

        <!-- Tabel Data Buku -->
        <div class="overflow-x-auto">
            <table id="dataTable" class="w-full border border-gray-300 rounded-lg text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">Foto Buku</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">Judul Buku</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">Penulis</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">Penerbit</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">Tahun Terbit</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">Bahasa</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">Kategori</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">Jumlah Halaman</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">Edisi</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">Deskripsi</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">Stok</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">File Buku</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_buku as $buku)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b border-gray-300">
                                @if ($buku->foto_buku)
                                    <div class="w-10 h-12 overflow-hidden rounded-lg border border-gray-200">
                                        <img src="{{ asset($buku->foto_buku) }}" alt="Foto Buku"
                                            class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div
                                        class="w-20 h-28 bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg border border-gray-200">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $buku->judul_buku }}</td>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $buku->penulis }}</td>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $buku->penerbit }}</td>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $buku->tahun_terbit }}</td>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $buku->bahasa }}</td>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $buku->kategori }}</td>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $buku->jumlah_halaman }}</td>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $buku->edisi }}</td>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $buku->deskripsi }}</td>
                            <td class="px-4 py-2 border-b border-gray-300">{{ $buku->stok }}</td>
                            <td class="text-center">
                                @if ($buku->file_buku)
                                    <a href="{{ asset($buku->file_buku) }}" target="_blank"
                                        class="inline-block bg-blue-600 text-white px-3 rounded-lg shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 transition">
                                        Lihat File
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">Tidak ada file</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.data_buku.destroy', $buku->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                </form>
                                <a href="{{ route('admin.data_buku.show', $buku->id) }}">
                                    <button class="text-green-600 hover:text-green-800 ml-2">Detail</button>
                                </a>
                                <a href="{{ route('admin.data_buku.edit', $buku->id) }}">
                                    <button class="text-blue-600 hover:text-blue-800 ml-2">Edit</button>
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
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                "pageLength": 5
            });
        });
    </script>
@endpush
