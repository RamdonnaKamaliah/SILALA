@extends('layout_admin.admin')
@php
    use Illuminate\Support\Str;
@endphp

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

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-[#A4B465]">Data Buku</h2>

            <div x-data="{ open: false }" class="flex justify-between items-center mb-6">
                <!-- Tombol Import Excel -->
                <button @click="open = true"
                    class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition ml-20">
                    📥 Import Excel
                </button>

                <!-- Modal Import -->
                <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                    <div @click.away="open = false"
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md p-6 relative">
                        <!-- Header -->
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-bold text-gray-800 dark:text-white">Upload Excel Buku</h2>
                            <button @click="open = false"
                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                ✖
                            </button>
                        </div>

                        <!-- Body -->
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Gunakan template dibawah ini untuk format yang benar
                        </p>

                        <!-- Tombol Download Template -->
                        <a href="{{ asset('uploads/template/TEMPLATE_INPUT_DATA_BUKU_SILALA_NEW.xlsx') }}"
                            class="block w-full bg-red-500 hover:bg-red-600 text-white text-center py-2 rounded-lg mb-4 transition"
                            download>
                            ⬇️ Download Template
                        </a>

                        <!-- Form Upload -->
                        <form action="{{ route('admin.data_buku.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" accept=".xlsx,.xls" required
                                class="block w-full text-gray-700 dark:text-gray-300 file:mr-4 file:py-2 file:px-4
                           file:rounded-l-lg file:border-0 file:text-sm file:font-semibold
                           file:bg-gray-200 file:text-gray-700
                           hover:file:bg-gray-300 dark:file:bg-gray-700 dark:file:text-white
                           mb-4 rounded-lg border border-gray-300 dark:border-gray-600">

                            <!-- Tombol Aksi -->
                            <div class="flex justify-end gap-2">
                                <button type="button" @click="open = false"
                                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg transition">
                                    Close
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.data_buku.create') }}"
                    class="bg-blue-500 text-black px-4 py-2 rounded-lg hover:bg-[#8AA24F] transition duration-200">
                    + Tambah Buku
                </a>
                <button id="bulkDeleteBtn"
                    class="bg-gray-400 text-white px-4 py-2 rounded-lg transition duration-200 cursor-not-allowed opacity-50"
                    disabled>
                    Hapus Data Terpilih
                </button>
                {{-- Tombol Arsipkan --}}
                <form id="bulkArchiveForm" action="{{ route('admin.data_buku.bulkArchive') }}" method="POST">
                    @csrf
                    <input type="hidden" name="selected_ids" id="selectedIdsArchive">
                    <button type="submit" id="bulkArchiveBtn" disabled
                        class="px-4 py-2 text-white rounded-lg opacity-50 bg-gray-400 cursor-not-allowed">Arsipkan Data
                        Terpilih</button>
                </form>


            </div>
        </div>


        <!-- Tabel Data Buku -->
        {{-- Form untuk Bulk Delete --}}

        <form id="bulkDeleteForm" action="{{ route('admin.data_buku.bulk-delete') }}" method="POST"> @csrf
            @method('DELETE')
            <div class="overflow-x-auto">
                <table id="dataTable" class="w-full border border-gray-300 rounded-lg text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="w-12 px-2 py-2 border-b border-gray-300 text-center">
                                <input type="checkbox" id="selectAll" name="selected_ids[]" class="w-4 h-4 row-checkbox">
                            </th>
                            <th class="px-4
                                    py-2 border-b border-gray-300 text-left">No
                            </th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Foto Buku</th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Judul Buku</th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Penulis</th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Penerbit</th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Tahun Terbit</th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Kategori</th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Edisi</th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Stok</th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">File Buku</th>
                            <th class="px-4 py-2 border-b border-gray-300 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_buku->where('status', 'aktif') as $buku)
                            <tr class="hover:bg-gray-50">
                                <td class="px-2 py-2 border-b border-gray-300 text-center">
                                    <input type="checkbox" name="selected_ids[]" value="{{ $buku->id }}"
                                        class="row-checkbox w-4 h-4">
                                </td>
                                <td class="px-2 py-2 border-b border-gray-300 text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300">
                                    @if ($buku->foto_buku)
                                        <div class="w-16 h-20 overflow-hidden rounded-lg border-2 mx-auto">
                                            <img src="/storage/{{ $buku->foto_buku }}"
                                                alt="Foto Buku {{ $buku->judul_buku }}" class="w-full h-full object-cover"
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

                                <td class="px-4 py-2 border-b border-gray-300">{{ $buku->judul_buku }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $buku->penulis }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $buku->penerbit }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $buku->tahun_terbit }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">
                                    @if ($buku->kategoris->count())
                                        {{ $buku->kategoris->pluck('nama_kategori')->join(', ') }}
                                    @else
                                        <span class="text-gray-500 italic">Tidak Ada Kategori</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $buku->edisi }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $buku->stok }}</td>
                                <td class="px-4 py-2 border-b border-gray-300 text-center">
                                    @php
                                        $path = $buku->file_buku;

                                        // Rapikan jika path lama masih mengandung 'storage/'
                                        $path = str_replace('storage/', '', $path);
                                        $path = str_replace('public/', '', $path);
                                    @endphp

                                    <a href="{{ asset('storage/' . $path) }}" target="_blank"
                                        class="inline-block bg-blue-600 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-700 text-xs">
                                        Lihat File
                                    </a>

                                </td>
                                <td class="px-4 py-2 border-b border-gray-300">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.data_buku.show', $buku->id) }}"
                                            class="text-green-600 hover:text-green-800 hover:underline">
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.data_buku.edit', $buku->id) }}"
                                            class="text-blue-600 hover:text-blue-800 hover:underline">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.data_buku.destroy', $buku->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 hover:underline"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.data_buku.archive', ['id' => $buku->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                onclick="return confirm('Arsipkan buku ini?')">Arsipkan</button>
                                        </form>


                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection
