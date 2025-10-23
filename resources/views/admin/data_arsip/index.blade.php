@extends('layout_admin.admin')
@section('pageTitle', 'Admin Dashboard - Data Arsip')

@section('content')
    <h2 class="text-primary font-bold text-center mb-4">Data Buku Terarsip</h2>

    <table class="min-w-full border border-gray-300 text-sm text-gray-800">
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
                    <td class="px-4 py-2 text-center">
                        @if ($buku->foto_buku)
                            <img src="{{ asset('storage/foto_buku/' . $buku->foto_buku) }}" alt="Foto Buku"
                                class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-400 italic">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $buku->judul }}</td>
                    <td class="px-4 py-2">{{ $buku->penulis }}</td>
                    <td class="px-4 py-2">{{ $buku->penerbit }}</td>
                    <td class="px-4 py-2">{{ $buku->tahun_terbit }}</td>
                    <td class="px-4 py-2">{{ $buku->kategori }}</td>
                    <td class="px-4 py-2">{{ $buku->edisi }}</td>
                    <td class="px-4 py-2 text-center">{{ $buku->stok }}</td>
                    <td class="px-4 py-2">{{ $buku->file_buku }}</td>
                    <td class="px-4 py-2 text-center">
                        <form action="{{ route('admin.data_buku.restore', ['id' => $buku->id]) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-green-600 hover:bg-green-700 px-3 py-1 rounded-lg text-white">
                                Pulihkan
                            </button>
                        </form>
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
