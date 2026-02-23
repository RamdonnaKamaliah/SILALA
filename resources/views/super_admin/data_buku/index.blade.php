@extends('layout_superAdmin.super_admin')
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

                <div class="flex items-center space-x-2">
                    <form id="bulkDeleteForm" action="{{ route('admin.data_buku.bulkDelete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="selected_ids" id="selectedIdsDelete">
                        <button type="submit" id="bulkDeleteBtn" disabled
                            class="px-4 py-2 text-white rounded-lg opacity-50 bg-gray-400 cursor-not-allowed transition">
                            <i class="fa-solid fa-trash mr-1"></i> Hapus Data Terpilih
                        </button>
                    </form>

                    <form id="bulkArchiveForm" action="{{ route('admin.data_buku.bulkArchive') }}" method="POST">
                        @csrf
                        <input type="hidden" name="selected_ids" id="selectedIdsArchive">
                        <button type="submit" id="bulkArchiveBtn" disabled
                            class="px-4 py-2 text-white rounded-lg opacity-50 bg-gray-400 cursor-not-allowed transition">
                            <i class="fa-solid fa-archive mr-1"></i> Arsipkan Data Terpilih
                        </button>
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
                            <th class="px-4 py-3 font-semibold">Penerbit</th>
                            <th class="px-4 py-3 font-semibold">Tahun</th>
                            <th class="px-4 py-3 font-semibold">Kategori</th>
                            <th class="px-4 py-3 font-semibold">Edisi</th>
                            <th class="px-4 py-3 text-center font-semibold">Stok</th>
                            <th class="px-4 py-3 text-center font-semibold">File</th>
                            <th class="px-4 py-3 text-center font-semibold w-32">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach ($bukus as $buku)
                            @if ($buku->status === 'aktif')
                                <tr class="hover:bg-[#F5F7ED] transition">
                                    <td class="px-4 py-3 text-center">
                                        <input type="checkbox" value="{{ $buku->id }}" class="row-checkbox w-4 h-4">
                                    </td>

                                    <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>

                                    <td class="px-4 py-3">
                                        <div class="w-16 h-20 overflow-hidden rounded-lg border mx-auto">
                                            @if ($buku->foto_buku && Storage::disk('public')->exists($buku->foto_buku))
                                                <img src="{{ asset('storage/' . $buku->foto_buku) }}"
                                                    class="w-full h-full object-cover" alt="{{ $buku->judul_buku }}">
                                            @else
                                                <img src="{{ asset('assets/image_default/image_default_book.jpeg') }}"
                                                    class="w-full h-full object-cover" alt="Default Book">
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 font-medium text-slate-800">{{ $buku->judul_buku }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $buku->penulis }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $buku->penerbit }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $buku->tahun_terbit }}</td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $buku->kategoris->pluck('nama_kategori')->join(', ') ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">{{ $buku->edisi ?? '-' }}</td>

                                    <td class="px-4 py-3 text-center">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                            {{ $buku->stok }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        @if ($buku->file_buku)
                                            <a href="{{ asset('storage/' . $buku->file_buku) }}" target="_blank"
                                                class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-700 transition">
                                                Lihat
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endif
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
                                                method="POST" class="inline archive-form">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="text-yellow-600 hover:text-yellow-800 p-2 rounded-full hover:bg-yellow-50 transition"
                                                    title="Arsipkan">
                                                    <i class="fa-solid fa-archive"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.data_buku.destroy', $buku->id) }}"
                                                method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition"
                                                    title="Hapus">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#dataTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                searching: true,
                info: true,
                dom: '<"flex flex-col sm:flex-row justify-between items-center gap-4 mb-4 px-4 pt-4"lf>rt<"flex flex-col sm:flex-row justify-between items-center gap-4 mt-4 px-4 pb-4"ip>',
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "›",
                        previous: "‹"
                    }
                },
                columnDefs: [{
                    orderable: false,
                    targets: [0, 2, 10, 11]
                }]
            });

            // Custom styling untuk DataTables elements
            $('.dataTables_length select').addClass(
                'px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465]'
            );
            $('.dataTables_filter input').addClass(
                'px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] ml-2'
            );
            $('.dataTables_length label, .dataTables_filter label').addClass('text-sm text-gray-700 font-medium');
            $('.dataTables_info').addClass('text-sm text-gray-600');
            $('.dataTables_paginate').addClass('flex gap-1');
            $('.paginate_button').addClass(
                'px-3 py-1 border border-gray-300 rounded-lg text-sm hover:bg-[#A4B465] hover:text-white hover:border-[#A4B465] transition-colors'
            );
            $('.paginate_button.current').addClass('bg-[#A4B465] text-white border-[#A4B465]');
            $('.paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');

            // Select All Checkbox functionality
            $('#selectAll').on('click', function() {
                var rows = table.rows({
                    'search': 'applied'
                }).nodes();
                $('.row-checkbox', rows).prop('checked', this.checked);
                updateBulkButtons();
            });

            // Individual checkbox change
            $(document).on('change', '.row-checkbox', function() {
                updateBulkButtons();

                let totalVisible = table.rows({
                    search: 'applied'
                }).nodes().length;
                let checkedCount = table.$('.row-checkbox:checked').length;

                $('#selectAll').prop('checked', checkedCount === totalVisible);
            });

            // Update bulk action buttons
            function updateBulkButtons() {
                const checkedCount = table.$('.row-checkbox:checked').length;

                if (checkedCount > 0) {
                    // Enable delete button
                    $('#bulkDeleteBtn')
                        .removeClass('opacity-50 bg-gray-400 cursor-not-allowed')
                        .addClass('bg-red-600 hover:bg-red-700')
                        .prop('disabled', false);

                    // Enable archive button
                    $('#bulkArchiveBtn')
                        .removeClass('opacity-50 bg-gray-400 cursor-not-allowed')
                        .addClass('bg-yellow-500 hover:bg-yellow-600')
                        .prop('disabled', false);
                } else {
                    // Disable both buttons
                    $('#bulkDeleteBtn')
                        .addClass('opacity-50 bg-gray-400 cursor-not-allowed')
                        .removeClass('bg-red-600 hover:bg-red-700')
                        .prop('disabled', true);

                    $('#bulkArchiveBtn')
                        .addClass('opacity-50 bg-gray-400 cursor-not-allowed')
                        .removeClass('bg-yellow-500 hover:bg-yellow-600')
                        .prop('disabled', true);
                }
            }

            // Bulk Delete Form Submission
            $('#bulkDeleteForm').on('submit', function(e) {
                e.preventDefault();

                const selectedIds = [];
                table.$('.row-checkbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length === 0) {
                    alert('Pilih minimal satu buku untuk dihapus');
                    return;
                }

                if (confirm(`Apakah Anda yakin ingin menghapus ${selectedIds.length} buku?`)) {
                    $('#selectedIdsDelete').val(selectedIds.join(','));
                    this.submit();
                }
            });

            // Bulk Archive Form Submission
            $('#bulkArchiveForm').on('submit', function(e) {
                e.preventDefault();

                const selectedIds = [];
                table.$('.row-checkbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length === 0) {
                    alert('Pilih minimal satu buku untuk diarsipkan');
                    return;
                }

                if (confirm(`Apakah Anda yakin ingin mengarsipkan ${selectedIds.length} buku?`)) {
                    $('#selectedIdsArchive').val(selectedIds.join(','));
                    this.submit();
                }
            });

            // Single Archive Form Confirmation
            $(document).on('submit', '.archive-form', function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin mengarsipkan buku ini?')) {
                    this.submit();
                }
            });

            // Single Delete Form Confirmation
            $(document).on('submit', '.delete-form', function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
                    this.submit();
                }
            });

            // Uncheck selectAll when changing page
            table.on('page.dt', function() {
                $('#selectAll').prop('checked', false);
            });

            // Reset selectAll when searching
            table.on('search.dt', function() {
                $('#selectAll').prop('checked', false);
            });
        });
    </script>

@endsection
