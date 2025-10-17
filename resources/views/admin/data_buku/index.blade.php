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

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-[#A4B465]">Data Buku</h2>
            <!-- Tombol di halaman utama -->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal">
                Import Excel
            </button>

            <!-- Modal -->
            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content p-3">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importModalLabel">Upload Excel Buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <p>Silakan upload file Excel buku pada field di bawah ini.</p>

                            <a href="{{ asset('uploads/template/TEMPLATE_INPUT_DATA_BUKU_SILALA_NEW.xlsx') }}"
                                class="btn btn-danger w-full" download>
                                Download Template
                            </a>


                            <form action="{{ route('admin.data_buku.import') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" accept=".xlsx,.xls" class="form-control mb-3" required>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </form>
                        </div>
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
                            <th class="px-4 py-2 border-b border-gray-300 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_buku as $buku)
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
            // Initialize DataTable
            var table = $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                "pageLength": 5,
                "columnDefs": [{
                        "orderable": false,
                        "targets": [0, 1, 9, 10]
                    }, // Kolom checkbox, foto, file, aksi
                    {
                        "searchable": false,
                        "targets": [0, 1, 9]
                    } // Kolom checkbox, foto, file
                ]
            });

            // Select All functionality
            $('#selectAll').on('click', function() {
                var isChecked = this.checked;
                $('.row-checkbox').each(function() {
                    $(this).prop('checked', isChecked);
                });
                updateBulkDeleteButton();
            });

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
        });
    </script>
@endpush
