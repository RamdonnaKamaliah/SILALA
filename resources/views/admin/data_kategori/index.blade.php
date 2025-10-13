@extends('layout_admin.admin')

@section('pageTitle', 'Data Kategori')

@section('content')
    <div class="p-4 md:p-6 overflow-x-auto">
        <!-- Judul Halaman -->
        <div class="text-left mb-6">
            <h1 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-2">
                Selamat datang di Dashboard Data Kategori 🎉
            </h1>
            <p class="text-gray-600">
                Kelola dan pantau seluruh data kategori yang tersedia di perpustakaan.
            </p>
            
        </div>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-[#A4B465]">Data Kategori</h2>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.data_kategori.create') }}"
                    class="bg-blue-500 text-black px-4 py-2 rounded-lg hover:bg-[#8AA24F] transition duration-200">
                    + Tambah Kategori
                </a>
                <button id="bulkDeleteBtn" 
                    class="bg-gray-400 text-white px-4 py-2 rounded-lg transition duration-200 cursor-not-allowed opacity-50"
                    disabled>
                    Hapus Data Terpilih
                </button>
            </div>
        </div>

        {{-- Form untuk Bulk Delete --}}
        <form id="bulkDeleteForm" action="{{ route('admin.data_kategori.bulk-delete') }}" method="POST">
            @csrf
            @method('DELETE')
            
            {{-- Tabel Data Kategori --}}
            <div class="overflow-x-auto mt-4">
                <table id="dataTable" class="w-full border border-gray-300 rounded-lg text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="w-12 px-2 py-2 border-b border-gray-300 text-center">
                                <input type="checkbox" id="selectAll" class="w-4 h-4">
                            </th>
                            <th class="w-16 px-2 py-2 border-b border-gray-300 text-center">No</th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Nama Kategori</th>
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_kategori as $kategori)
                            <tr class="hover:bg-gray-50">
                                <td class="px-2 py-2 border-b border-gray-300 text-center">
                                    <input type="checkbox" name="selected_ids[]" value="{{ $kategori->id }}" 
                                        class="row-checkbox w-4 h-4">
                                </td>
                                 <td class="px-2 py-2 border-b border-gray-300 text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $kategori->nama_kategori }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.data_kategori.show', $kategori->id) }}"
                                            class="text-green-600 hover:text-green-800 hover:underline">
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.data_kategori.edit', $kategori->id) }}"
                                            class="text-blue-600 hover:text-blue-800 hover:underline">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.data_kategori.destroy', $kategori->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="text-red-600 hover:text-red-800 hover:underline"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // DataTable
            var table = $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                "pageLength": 5,
                "columnDefs": [
                    { "orderable": false, "targets": [0, 2] },
                    { "searchable": false, "targets": [0] }
                ]
            });

            // Fungsi Select All
            $('#selectAll').on('click', function() {
                $('.row-checkbox').prop('checked', this.checked);
                updateBulkDeleteButton();
            });

            // Checkbox Semua Baris
            $(document).on('change', '.row-checkbox', function() {
                if (!this.checked) {
                    $('#selectAll').prop('checked', false);
                } else {
                    var allChecked = $('.row-checkbox:checked').length === $('.row-checkbox').length;
                    $('#selectAll').prop('checked', allChecked);
                }
                updateBulkDeleteButton();
            });

            // Button Bulk Delete
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

            // Notifikasi Hapus
            $('#bulkDeleteBtn').on('click', function(e) {
                e.preventDefault();
                
                var selectedIds = $('.row-checkbox:checked').map(function() {
                    return this.value;
                }).get();
                
                if (selectedIds.length > 0) {
                    if (confirm('Apakah Anda yakin ingin menghapus ' + selectedIds.length + ' kategori yang dipilih?')) {
                        $('#bulkDeleteForm').submit();
                    }
                }
            });

            // Filter Button Hapus
            $('.row-checkbox, #selectAll').on('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>
@endpush