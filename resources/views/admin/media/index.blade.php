@extends('layout_admin.admin')

@section('pageTitle', 'Data Media Buku')

@section('content')
    <div class="p-4 md:p-6 overflow-x-auto">
        <!-- Header Section -->
        <div class="text-left mb-8 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center space-x-4 mb-3">
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-images text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl lg:text-4xl font-bold mb-2 text-white">Galeri Media Buku</h1>
                    <p class="text-white text-lg">Kelola foto dan gambar buku perpustakaan</p>
                </div>
            </div>
            <div class="flex items-center space-x-2 text-sm text-white">
                <i class="fas fa-chart-line"></i>
                <span>Total Media: <strong>{{ $media->count() }}</strong></span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                <i class="fas fa-list-alt text-[#A4B465] mr-3"></i>
                Daftar Media Buku
            </h2>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.data_buku.create') }}"
                    class="bg-[#A4B465] hover:bg-[#8AA24F] text-white px-5 py-2.5 rounded-xl transition-all duration-200 flex items-center space-x-2 shadow-md hover:shadow-lg">
                    <i class="fas fa-plus-circle"></i>
                    <span>Upload Media</span>
                </a>
            </div>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mt-6">
            <div class="overflow-x-auto">
                <table id="dataTableMedia" class="w-full text-sm">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 text-gray-700 border-b border-gray-200">
                        <tr>
                            <th class="w-20 px-4 py-4 text-center font-semibold">No</th>
                            <th class="px-6 py-4 text-left font-semibold">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-image text-[#A4B465]"></i>
                                    <span>Preview</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left font-semibold">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-file text-[#A4B465]"></i>
                                    <span>Nama File</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left font-semibold">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-book text-[#A4B465]"></i>
                                    <span>Buku Terkait</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center font-semibold w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($media as $item)
                            <tr class="hover:bg-gray-50/80 transition-colors duration-150 group">
                                <td class="px-4 py-4 text-center text-gray-600 font-medium">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-16 h-16 rounded-lg overflow-hidden shadow-sm border border-gray-200">
                                        @if ($item->path_file && Storage::disk('public')->exists($item->path_file))
                                            <img src="{{ asset('storage/' . $item->path_file) }}"
                                                class="w-full h-full object-cover" alt="{{ $item->nama_file }}">
                                        @else
                                            <img src="{{ asset('assets/image_default/image_default_book.jpeg') }}"
                                                class="w-full h-full object-cover opacity-60" alt="Default image">
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-[#A4B465] to-[#8AA24F] rounded-lg flex items-center justify-center">
                                            <i class="fas fa-file-image text-white text-sm"></i>
                                        </div>
                                        <span class="font-medium text-gray-800">{{ $item->nama_file }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->buku)
                                        <span class="text-gray-700">{{ $item->buku->judul_buku }}</span>
                                    @else
                                        <span class="text-gray-400 italic text-sm">Belum digunakan</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ asset('storage/' . $item->path_file) }}" target="_blank"
                                            class="bg-blue-50 hover:bg-blue-100 text-blue-600 p-3 rounded-xl transition-all duration-200 group relative"
                                            title="Lihat Media">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button"
                                            class="bg-red-50 hover:bg-red-100 text-red-600 p-3 rounded-xl transition-all duration-200 delete-btn group relative"
                                            title="Hapus Media" data-id="{{ $item->id }}"
                                            data-name="{{ $item->nama_file }}">
                                            <i class="fas fa-trash"></i>
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

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .tooltip-text {
            visibility: hidden;
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: #333;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .group:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        .dataTables_wrapper {
            padding: 0 !important;
        }

        .dataTables_filter input {
            border: 1px solid #d1d5db !important;
            border-radius: 8px !important;
            padding: 8px 12px !important;
        }

        .dataTables_length select {
            border: 1px solid #d1d5db !important;
            border-radius: 8px !important;
            padding: 6px 12px !important;
        }

        table.dataTable tbody tr:hover {
            background-color: #f9fafb !important;
        }

        /* DataTables custom styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            margin: 0 2px;
            border: 1px solid #e5e7eb !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #A4B465 !important;
            color: white !important;
            border: 1px solid #A4B465 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #8AA24F !important;
            color: white !important;
            border: 1px solid #8AA24F !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#dataTableMedia').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"<"mb-4 md:mb-0"l><"flex items-center"f>>rt<"flex flex-col md:flex-row justify-between items-center mt-4"<"mb-4 md:mb-0"i><"flex"p>>',
                columnDefs: [{
                        targets: 1, // Kolom preview
                        orderable: false,
                        searchable: false
                    },
                    {
                        targets: 4, // Kolom aksi
                        orderable: false,
                        searchable: false
                    }
                ],
                initComplete: function() {
                    $('.dataTables_filter input').attr('placeholder', 'Cari media...');
                }
            });

            // Individual delete confirmation
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var mediaId = $(this).data('id');
                var mediaName = $(this).data('name');
                var deleteUrl = "{{ route('admin.media.destroy', ':id') }}".replace(':id', mediaId);

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `Apakah Anda yakin ingin menghapus media ini?`,
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
                    text: 'Berhasil menghapus media.',
                    icon: 'success',
                    confirmButtonColor: '#A4B465',
                    timer: 3000
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: 'Gagal menghapus media.',
                    icon: 'error',
                    confirmButtonColor: '#ef4444'
                });
            @endif
        });
    </script>
@endpush
