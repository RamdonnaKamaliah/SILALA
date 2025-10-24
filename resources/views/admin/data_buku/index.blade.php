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
            </div>
        </div>


        <!-- Tabel Data Buku -->
        {{-- Form untuk Bulk Delete --}}
        <form id="bulkDeleteForm" action="{{ route('admin.data_buku.bulk-delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="overflow-x-auto">
                <table id="dataTable" class="w-full border border-gray-300 rounded-lg text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="w-12 px-2 py-2 border-b border-gray-300 text-center">
                                <input type="checkbox" id="selectAll" class="w-4 h-4">
                            </th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">No</th>
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
                                    @if ($buku->file_buku)
                                        <a href="{{ asset($buku->file_buku) }}" target="_blank"
                                            class="inline-block bg-blue-600 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 transition text-xs">
                                            Lihat File
                                        </a>
                                    @else
                                        <span class="text-gray-400 italic text-xs">Tidak ada file</span>
                                    @endif
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

@push('styles')
    <style>
        #bulkDeleteBtn:enabled {
            background-color: #ef4444;
            cursor: pointer;
            opacity: 1;
        }

        #bulkDeleteBtn:enabled:hover {
            background-color: #dc2626;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Select All functionality
        $('#selectAll').on('click', function() {
            var isChecked = this.checked;
            $('.row-checkbox').each(function() {
                $(this).prop('checked', isChecked);
            });
            updateBulkDeleteButton();
        })

        // Individual checkbox change
        $(document).on('change', '.row-checkbox', function() {
            var totalCheckboxes = $('.row-checkbox').length;
            var checkedCheckboxes = $('.row-checkbox:checked').length;

            $('#selectAll').prop('checked', totalCheckboxes === checkedCheckboxes);
            updateBulkDeleteButton();
        });

        // Update bulk delete button state
        function updateBulkDeleteButton() {
            var checkedCount = $('.row-checkbox:checked').length;
            var bulkDeleteBtn = $('#bulkDeleteBtn');

            if (checkedCount > 0) {
                bulkDeleteBtn.prop('disabled', false);
                bulkDeleteBtn.text('Hapus (' + checkedCount + ') Data Terpilih');
            } else {
                bulkDeleteBtn.prop('disabled', true);
                bulkDeleteBtn.text('Hapus Data Terpilih');
            }
        }

        // Bulk delete form submission
        $('#bulkDeleteBtn').on('click', function(e) {
            e.preventDefault();

            var selectedIds = $('.row-checkbox:checked').map(function() {
                return this.value;
            }).get();

            if (selectedIds.length > 0) {
                if (confirm('Apakah Anda yakin ingin menghapus ' + selectedIds.length +
                        ' buku yang dipilih?')) {
                    $('#bulkDeleteForm').submit();
                }
            }
        });

        // Update button state on page load
        updateBulkDeleteButton();
    </script>
@endpush
