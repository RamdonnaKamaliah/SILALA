@extends('layout_admin.admin')
@section('pageTitle', 'Admin Dashboard - Data Arsip')

@section('content')
    <h1 class="text-primary font-bold text-center mb-4">Data Buku Terarsip</h1>

    <table id="dataTable" class="min-w-full border border-gray-300 text-sm text-gray-800">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-2 border-b">No</th>
                <th class="px-4 py-2 border-b">Foto Buku</th>
                <th class="px-4 py-2 border-b">Judul</th>
                <th class="px-4 py-2 border-b">Penulis</th>
                <th class="px-4 py-2 border-b">Penerbit</th>
                <th class="px-4 py-2 border-b">Tahun Terbit</th>
                <th class="px-4 py-2 border-b">Kategori</th>
                <th class="px-4 py-2 border-b">Edisi</th>
                <th class="px-4 py-2 border-b">Stok</th>
                <th class="px-4 py-2 border-b">File Buku</th>
                <th class="px-4 py-2 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($buku_arsip as $index => $buku)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border-b border-gray-300">
                        @if ($buku->foto_buku)
                            <div class="w-16 h-20 overflow-hidden rounded-lg border-2 mx-auto">
                                <img src="{{ $buku->foto_url }}" alt="Foto Buku {{ $buku->foto_buku }}"
                                    class="w-full h-full object-cover"
                                    onerror="this.onerror=null; this.src='{{ asset('images/default-book.jpg') }}';">
                            </div>
                        @else
                            <div
                                class="w-16 h-20 bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg border mx-auto">
                                <img src="{{ asset('assets/image_default/image_default_book.jpeg') }}"
                                    alt="Foto default buku" class="w-full h-full object-cover">
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $buku->judul_buku }}</td>
                    <td class="px-4 py-2">{{ $buku->penulis }}</td>
                    <td class="px-4 py-2">{{ $buku->penerbit }}</td>
                    <td class="px-4 py-2">{{ $buku->tahun_terbit }}</td>
                    <td class="px-4 py-2 border-b border-gray-300">
                        @if ($buku->kategoris->count())
                            {{ $buku->kategoris->pluck('nama_kategori')->join(', ') }}
                        @else
                            <span class="text-gray-500 italic">Tidak Ada Kategori</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $buku->edisi }}</td>
                    <td class="px-4 py-2 text-center">{{ $buku->stok }}</td>
                    <td class="px-4 py-2 border-b border-gray-300 text-center">
                        @if ($buku->file_buku)
                            <a href="{{ asset($buku->file_buku) }}" target="_blank"
                                class="inline-block bg-blue-600 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 transition text-xs">
                                Lihat File
                            </a>
                        @else
                            <span class="text-gray-400 italic text-xs">Tidak ada file</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-center">
                        <form action="{{ route('admin.data_buku.restore', ['id' => $buku->id]) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-green-600 hover:bg-green-700 px-3 py-1 rounded-lg text-white">
                                Pulihkan
                            </button>
                        </form>
                        <a href="{{ route('admin.data_arsip.show', $buku->id) }}"
                            class="bg-yellow-400 hover:bg-green-700 text-white px-3 py-1 rounded-lg">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center py-3 text-gray-500">Belum ada buku terarsip</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
