@extends('layout_admin.admin')
@section('pageTitle', 'Data Buku')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="p-4 md:p-8 font-[Poppins] text-slate-800 bg-gray-50 min-h-screen">

        <div class="user-dashboard p-4 md:p-6 bg-gray-50">
            <!-- Header Profesional -->
            <div class="text-left mb-8 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center space-x-4 mb-3">
                    <div class="bg-white/20 p-3 rounded-full">
                        <i class="fas fa-tags text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold mb-2 text-white">Manajemen Data Buku</h1>
                        <p class="text-white text-lg">Kelola dan pantau seluruh data buku di perpustakaan</p>
                    </div>
                </div>

            </div>

            <!-- ALERT SUCCESS -->
            @if (session('success'))
                <div
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fa-solid fa-circle-check mr-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.style.display='none'"
                        class="text-green-700 hover:text-green-900">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- ALERT ERROR -->
            @if (session('error'))
                <div
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fa-solid fa-circle-exclamation mr-2"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.style.display='none'"
                        class="text-red-700 hover:text-red-900">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- TOMBOL AKSI -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <div class="flex items-center space-x-2 text-sm text-white">
                    <i class="fas fa-chart-line"></i>
                    <span>Total Data Buku: <strong>{{ $bukus->count() }}</strong></span>
                </div>
                <div x-data="{ open: false }" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                    <!-- Tombol Import -->
                    <button @click="open = true"
                        class="bg-yellow-400 text-black font-medium px-4 py-2 rounded-lg shadow
                        hover:bg-yellow-500 transition flex items-center gap-2">
                        <i class="fa-solid fa-file-import"></i> Import
                    </button>

                    <!-- Modal Import -->
                    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <!-- Card -->
                        <div @click.away="open = false"
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-xl
                   w-full max-w-md p-6 mx-4 relative">
                            <!-- Header -->
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-bold text-gray-800 dark:text-white">
                                    Upload Excel Buku
                                </h2>
                                <button @click="open = false"
                                    class="text-gray-400 hover:text-gray-600
                           dark:hover:text-gray-300 text-xl">
                                    ✖
                                </button>
                            </div>

                            <!-- Body -->
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Gunakan template di bawah ini untuk format yang benar
                            </p>

                            <!-- Download Template -->
                            <a href="{{ asset('uploads/template/TEMPLATE_INPUT_DATA_BUKU_SILALA_NEW.xlsx') }}" download
                                class="w-full bg-red-500 hover:bg-red-600 text-white
                       py-2 rounded-lg mb-4 transition
                       flex items-center justify-center gap-2">
                                <i class="fa-solid fa-download"></i> Download Template
                            </a>

                            <!-- Form Upload -->
                            <form action="{{ route('admin.data_buku.import') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="file" name="file" accept=".xlsx,.xls" required
                                    class="block w-full mb-4 text-gray-700 dark:text-gray-300
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-l-lg file:border-0
                           file:text-sm file:font-semibold
                           file:bg-gray-200 file:text-gray-700
                           hover:file:bg-gray-300
                           dark:file:bg-gray-700 dark:file:text-white
                           rounded-lg border border-gray-300 dark:border-gray-600">

                                <!-- Action Button -->
                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="open = false"
                                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400
                               text-gray-800 rounded-lg transition">
                                        Batal
                                    </button>

                                    <button type="submit"
                                        class="px-4 py-2 bg-[#A4B465] hover:bg-[#8A9A55]
                               text-white rounded-lg transition
                               flex items-center gap-2">
                                        <i class="fa-solid fa-upload"></i> Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <style>
                    [x-cloak] {
                        display: none !important;
                    }
                </style>


                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.data_buku.create') }}"
                        class="bg-[#A4B465] text-white font-medium px-4 py-2 rounded-lg shadow hover:bg-[#8A9A55] transition w-full sm:w-auto text-center flex items-center justify-center gap-2">
                        + Tambah Buku
                    </a>
                    <form id="bulkDeleteForm" action="{{ route('admin.data_buku.bulkDelete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="selected_ids" id="selectedIdsDelete">
                        <button type="submit" id="bulkDeleteBtn" disabled
                            class="px-4 py-2 text-white rounded-lg opacity-50 bg-gray-400 cursor-not-allowed">Hapus Data
                            Terpilih</button>
                    </form>

                    {{-- Tombol Arsipkan --}}
                    <form id="bulkArchiveForm" action="{{ route('admin.data_buku.bulkArchive') }}" method="POST">
                        @csrf
                        <input type="hidden" name="selected_ids" id="selectedIdsArchive">
                        <button type="submit" id="bulkArchiveBtn" disabled
                            class="px-4 py-2 text-white rounded-lg opacity-50 bg-gray-400 cursor-not-allowed">Arsipkan
                            Data
                            Terpilih</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- TABLE -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700" id="dataTable">
                        <thead class="bg-[#A4B465] text-white">
                            <tr>
                                <th class="px-4 py-3 text-center w-12">
                                    <input type="checkbox" id="selectAll" class="w-4 h-4">
                                </th>
                                <th class="px-4 py-3 text-center font-semibold w-12">No</th>
                                <th class="px-4 py-3 text-center font-semibold w-20">Foto</th>
                                <th class="px-4 py-3 font-semibold">Judul</th>
                                <th class="px-4 py-3 font-semibold">Penulis</th>
                                <th class="px-4 py-3 font-semibold hidden md:table-cell">Penerbit</th>
                                <th class="px-4 py-3 font-semibold hidden lg:table-cell">Tahun</th>
                                <th class="px-4 py-3 font-semibold hidden lg:table-cell">Kategori</th>
                                <th class="px-4 py-3 font-semibold hidden xl:table-cell">Edisi</th>
                                <th class="px-4 py-3 text-center font-semibold">Stok</th>
                                <th class="px-4 py-3 text-center font-semibold">File</th>
                                <th class="px-4 py-3 text-center font-semibold w-32">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @foreach ($bukus as $buku)
                                <tr class="hover:bg-[#F5F7ED] transition">
                                    <td class="px-4 py-3 text-center">
                                        <input type="checkbox" value="{{ $buku->id }}"
                                            class="row-checkbox w-4 h-4">
                                    </td>

                                    <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>

                                    <td class="px-4 py-3">
                                        <div class="w-16 h-20 overflow-hidden rounded-lg border mx-auto">
                                            @if ($buku->foto_buku && Storage::disk('public')->exists($buku->foto_buku))
                                                <img src="{{ asset('storage/' . $buku->foto_buku) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <img src="{{ asset('assets/image_default/image_default_book.jpeg') }}"
                                                    class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 font-medium text-slate-800">{{ $buku->judul_buku }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $buku->penulis }}</td>
                                    <td class="px-4 py-3 text-gray-600 hidden md:table-cell">{{ $buku->penerbit }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 hidden lg:table-cell">{{ $buku->tahun_terbit }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 hidden lg:table-cell">
                                        {{ $buku->kategoris->pluck('nama_kategori')->join(', ') ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 hidden xl:table-cell">{{ $buku->edisi ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        {{ $buku->stok }}
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ asset('storage/' . $buku->file_buku) }}" target="_blank"
                                            class="bg-blue-600 text-white px-3 py-1 rounded text-xs">Lihat</a>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('admin.data_buku.show', $buku->id) }}"
                                                class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-50 transition"
                                                title="Detail">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </a>

                                            <a href="{{ route('admin.data_buku.edit', $buku->id) }}"
                                                class="text-green-600 hover:text-green-800 p-2 rounded-full hover:bg-green-50 transition"
                                                title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <form action="{{ route('admin.data_buku.archive', $buku->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" onclick="return confirm('Arsipkan buku ini?')"
                                                    class="text-yellow-600 hover:text-yellow-800 p-2 rounded-full hover:bg-yellow-50 transition"
                                                    title="Arsipkan">
                                                    <i class="fa-solid fa-archive"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.data_buku.destroy', $buku->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')"
                                                    class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition"
                                                    title="Hapus">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
    </div>
    </div>


@endsection
