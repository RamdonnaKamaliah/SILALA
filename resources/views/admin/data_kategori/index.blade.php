@extends('layout_admin.admin')

@section('pageTitle', 'Data Kategori')

@section('content')
<div class="p-4 md:p-6 overflow-x-auto">
    <!-- Header Section -->
    <div class="text-left mb-8 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center space-x-4 mb-3">
            <div class="bg-white/20 p-3 rounded-full">
                <i class="fas fa-tags text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl lg:text-4xl font-bold mb-2 text-white">Manajemen Data Kategori</h1>
                <p class="text-white text-lg">Kelola dan pantau seluruh kategori buku di perpustakaan</p>
            </div>
        </div>
        <div class="flex items-center space-x-2 text-sm text-white">
            <i class="fas fa-chart-line"></i>
            <span>Total Kategori: <strong>{{ $data_kategori->count() }}</strong></span>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-list-alt text-[#A4B465] mr-3"></i>
            Daftar Kategori Buku
        </h2>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.data_kategori.create') }}"
               class="bg-[#A4B465] hover:bg-[#8AA24F] text-white px-5 py-2.5 rounded-xl transition-all duration-200 flex items-center space-x-2 shadow-md hover:shadow-lg">
               <i class="fas fa-plus-circle"></i>
               <span>Tambah Kategori</span>
            </a>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mt-6">
        <div class="overflow-x-auto">
            <table id="dataTableKategori" class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                            <div class="flex items-center justify-center gap-2">
                                <i class="fas fa-hashtag text-[#A4B465]"></i>
                                No
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-tag text-[#A4B465]"></i>
                                Nama Kategori
                            </div>
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                            <div class="flex items-center justify-center gap-2">
                                <i class="fas fa-cog text-[#A4B465]"></i>
                                Aksi
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data_kategori as $kategori)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 text-center">
                                    {{ $loop->iteration }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-[#A4B465] to-[#8AA24F] rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-folder text-white text-sm"></i>
                                    </div>
                                    <span class="font-semibold text-gray-900">{{ $kategori->nama_kategori }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.data_kategori.show', $kategori->id) }}"
                                       class="bg-blue-600 text-white p-2.5 rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-sm transform hover:scale-105"
                                       title="Detail Kategori">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                    <a href="{{ route('admin.data_kategori.edit', $kategori->id) }}"
                                       class="bg-green text-white p-2.5 rounded-lg hover:bg-green-700 transition-all duration-200 shadow-sm transform hover:scale-105"
                                       title="Edit Kategori">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <button type="button"
                                        class="bg-red-600 text-white p-2.5 rounded-lg hover:bg-red-700 transition-all duration-200 delete-btn shadow-sm transform hover:scale-105"
                                        title="Hapus Kategori"
                                        data-id="{{ $kategori->id }}"
                                        data-name="{{ $kategori->nama_kategori }}">
                                        <i class="fas fa-trash text-sm"></i>
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

<!-- Delete Confirmation Form -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#dataTableKategori').DataTable({
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
                columnDefs: [
                    { orderable: false, targets: [2] } // Aksi tidak bisa di-sort
                ]
            });

            // Custom styling untuk DataTables elements
            $('.dataTables_length select').addClass('px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465]');
            $('.dataTables_filter input').addClass('px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] ml-2');
            $('.dataTables_length label, .dataTables_filter label').addClass('text-sm text-gray-700 font-medium');
            $('.dataTables_info').addClass('text-sm text-gray-600');
            $('.dataTables_paginate').addClass('flex gap-1');
            $('.paginate_button').addClass('px-3 py-1 border border-gray-300 rounded-lg text-sm hover:bg-[#A4B465] hover:text-white hover:border-[#A4B465] transition-colors');
            $('.paginate_button.current').addClass('bg-[#A4B465] text-white border-[#A4B465]');
            $('.paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');

            // Delete confirmation
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var kategoriId = $(this).data('id');
                var kategoriName = $(this).data('name');
                var deleteUrl = "{{ route('admin.data_kategori.destroy', ':id') }}".replace(':id', kategoriId);

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `Apakah Anda yakin ingin menghapus kategori <strong>${kategoriName}</strong>?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        var deleteForm = $('#deleteForm');
                        deleteForm.attr('action', deleteUrl);
                        deleteForm.submit();
                    }
                });
            });

            // Success message
            @if (session('success'))
                Swal.fire({
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonColor: '#A4B465',
                    timer: 3000
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonColor: '#ef4444'
                });
            @endif
        });
    </script>
@endpush