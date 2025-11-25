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
            <button id="bulkDeleteBtn" 
                class="bg-gray-400 text-white px-5 py-2.5 rounded-xl transition-all duration-200 flex items-center space-x-2 cursor-not-allowed opacity-50"
                disabled>
                <i class="fas fa-trash-alt"></i>
                <span>Hapus Terpilih</span>
            </button>
        </div>
    </div>

    <!-- Bulk Delete Form -->
    <form id="bulkDeleteForm" action="{{ route('admin.data_kategori.bulk-delete') }}" method="POST">
        @csrf
        @method('DELETE')

        <!-- Table Container -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mt-6">
            <div class="overflow-x-auto">
                <table id="dataTableKategori" class="w-full text-sm">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 text-gray-700 border-b border-gray-200">
                        <tr>
                            <th class="w-14 px-4 py-4 text-center">
                                <input type="checkbox" id="selectAll" class="w-4 h-4 rounded border-gray-300 text-[#A4B465] focus:ring-[#A4B465]">
                            </th>
                            <th class="w-20 px-4 py-4 text-center font-semibold">No</th>
                            <th class="px-6 py-4 text-left font-semibold">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-tag text-[#A4B465]"></i>
                                    <span>Nama Kategori</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center font-semibold w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($data_kategori as $kategori)
                            <tr class="hover:bg-gray-50/80 transition-colors duration-150 group">
                                <td class="px-4 py-4 text-center">
                                    <input type="checkbox" name="selected_ids[]" value="{{ $kategori->id }}" 
                                           class="row-checkbox w-4 h-4 rounded border-gray-300 text-[#A4B465] focus:ring-[#A4B465]">
                                </td>
                                <td class="px-4 py-4 text-center text-gray-600 font-medium">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-[#A4B465] to-[#8AA24F] rounded-lg flex items-center justify-center">
                                            <i class="fas fa-folder text-white text-sm"></i>
                                        </div>
                                        <span class="font-medium text-gray-800">{{ $kategori->nama_kategori }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.data_kategori.show', $kategori->id) }}"
                                           class="bg-blue-50 hover:bg-blue-100 text-blue-600 p-3 rounded-xl transition-all duration-200 group relative"
                                           title="Detail Kategori">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.data_kategori.edit', $kategori->id) }}"
                                           class="bg-green-50 hover:bg-green-100 text-green-600 p-3 rounded-xl transition-all duration-200 group relative"
                                           title="Edit Kategori">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.data_kategori.destroy', $kategori->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="bg-red-50 hover:bg-red-100 text-red-600 p-3 rounded-xl transition-all duration-200 delete-btn group relative"
                                                title="Hapus Kategori"
                                                data-id="{{ $kategori->id }}"
                                                data-name="{{ $kategori->nama_kategori }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <i class="fas fa-inbox text-4xl mb-3"></i>
                                        <p class="text-lg">Tidak ada data kategori</p>
                                        <p class="text-sm mt-1">Mulai dengan menambahkan kategori baru</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </form>
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

#bulkDeleteBtn:enabled {
    background-color: #ef4444;
    cursor: pointer;
    opacity: 1;
}

#bulkDeleteBtn:enabled:hover {
    background-color: #dc2626;
    transform: translateY(-1px);
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
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#dataTableKategori').DataTable({
        language: { 
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" 
        },
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"<"mb-4 md:mb-0"l><"flex items-center"f>>rt<"flex flex-col md:flex-row justify-between items-center mt-4"<"mb-4 md:mb-0"i><"flex"p>>',
        columnDefs: [
            { orderable: false, targets: [0, 3] },
            { searchable: false, targets: [0, 3] }
        ],
        initComplete: function() {
            $('.dataTables_filter input').attr('placeholder', 'Cari kategori...');
        }
    });

    // Select All functionality
    $('#selectAll').on('click', function() {
        var isChecked = this.checked;
        $('.row-checkbox').prop('checked', isChecked);
        updateBulkDeleteButton();
    });

    // Individual checkbox change
    $(document).on('change', '.row-checkbox', function() {
        if (!this.checked) {
            $('#selectAll').prop('checked', false);
        } else {
            var allChecked = $('.row-checkbox:checked').length === $('.row-checkbox').length;
            $('#selectAll').prop('checked', allChecked);
        }
        updateBulkDeleteButton();
    });

    // Update bulk delete button state
    function updateBulkDeleteButton() {
        var checkedCount = $('.row-checkbox:checked').length;
        var bulkDeleteBtn = $('#bulkDeleteBtn');
        
        if (checkedCount > 0) {
            bulkDeleteBtn.prop('disabled', false);
            bulkDeleteBtn.html('<i class="fas fa-trash-alt mr-2"></i>Hapus (' + checkedCount + ') Data Terpilih');
        } else {
            bulkDeleteBtn.prop('disabled', true);
            bulkDeleteBtn.html('<i class="fas fa-trash-alt mr-2"></i>Hapus Data Terpilih');
        }
    }

    // Bulk delete confirmation
    $('#bulkDeleteBtn').on('click', function(e) {
        e.preventDefault();
        var selectedIds = $('.row-checkbox:checked').map(function() { 
            return this.value; 
        }).get();
        
        if (selectedIds.length > 0) {
            Swal.fire({
                title: 'Konfirmasi Hapus Massal',
                html: `Apakah Anda yakin ingin menghapus <strong>${selectedIds.length}</strong> kategori yang dipilih?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#bulkDeleteForm').submit();
                }
            });
        }
    });

    // Individual delete confirmation - FIXED VERSION
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var kategoriId = $(this).data('id');
        var kategoriName = $(this).data('name');
        var deleteUrl = "{{ route('admin.data_kategori.destroy', ':id') }}".replace(':id', kategoriId);
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            html: `Apakah Anda yakin ingin menghapus kategori <strong>"${kategoriName}"</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Create dynamic form submission
                var deleteForm = $('#deleteForm');
                deleteForm.attr('action', deleteUrl);
                deleteForm.submit();
            }
        });
    });

    // Success message for various actions
    @if(session('success'))
        Swal.fire({
            title: 'Sukses!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#A4B465',
            timer: 3000
        });
    @endif

    @if(session('error'))
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