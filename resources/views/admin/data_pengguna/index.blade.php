@extends('layout_admin.admin')
@section('pageTitle', 'Admin Dashboard - Data Pengguna')

@section('content')
<!-- Tabel Data Pengguna -->
<div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
    <!-- Header Tabel -->
    <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="bg-[#A4B465] p-3 rounded-lg shadow-md">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Data Pengguna Perpustakaan</h3>
                    <p class="text-sm text-gray-600 mt-1">Kelola dan monitor seluruh data pengguna terdaftar</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Controls -->
    <div class="px-8 py-5 bg-white border-b border-gray-200">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <!-- Show Entries -->
            <div class="flex items-center gap-3">
                <label class="text-sm font-medium text-gray-700 whitespace-nowrap">Tampilkan</label>
                <select id="entriesPerPage" class="px-4 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#A4B465] focus:border-transparent bg-white min-w-[140px]">
                    <option value="10">10 entri</option>
                    <option value="25">25 entri</option>
                    <option value="50">50 entri</option>
                    <option value="100">100 entri</option>
                </select>
            </div>

            <!-- Search -->
            <div class="flex items-center gap-3">
                <label class="text-sm font-medium text-gray-700 whitespace-nowrap">
                    <i class="fas fa-search text-[#A4B465]"></i> Pencarian
                </label>
                <input type="text" id="searchInput" placeholder="Cari nama, email, telepon..." class="px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#A4B465] focus:border-transparent w-full lg:w-80">
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto">
        <table id="usersTable" class="w-full">
            <thead>
                <tr class="bg-[#A4B465] text-white">
                    <th class="px-6 py-4 text-left text-sm font-semibold whitespace-nowrap">No</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold whitespace-nowrap">Nama Pengguna</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold whitespace-nowrap">No. Telepon</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold whitespace-nowrap">Alamat Email</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold whitespace-nowrap">Jenis Keanggotaan</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold whitespace-nowrap">Gender</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $index => $user)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-medium text-gray-900">{{ $index + 1 }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-[#A4B465] to-[#8A9A55] flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->phone)
                            <div class="text-sm text-gray-900">
                                <i class="fas fa-phone text-gray-400 mr-2"></i>{{ $user->phone }}
                            </div>
                        @else
                            <span class="text-sm text-gray-500 italic">Not Found</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900 flex items-center gap-2">
                            <i class="fas fa-envelope text-gray-400"></i>
                            <span class="truncate max-w-[250px]">{{ $user->email }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($user->membership_type == 'karyawan')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-semibold bg-[#A4B465] text-white">
                                <i class="fas fa-briefcase"></i>
                                Karyawan
                            </span>
                        @elseif($user->membership_type == 'magang')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-semibold bg-[#C5D28B] text-white">
                                <i class="fas fa-user-graduate"></i>
                                Magang
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-semibold bg-gray-400 text-white">
                                {{ ucfirst($user->membership_type) }}
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($user->gender == 'L')
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-mars"></i>
                            </span>
                        @elseif($user->gender == 'P')
                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-pink-100 text-pink-600">
                                <i class="fas fa-venus"></i>
                            </span>
                        @else
                            <span class="text-sm text-gray-500 italic">Not Found</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer - Pagination & Info -->
    <div class="px-8 py-5 bg-gradient-to-r from-gray-50 to-white border-t border-gray-200">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <!-- Info -->
            <div class="text-sm text-gray-600 font-medium">
                <span id="tableInfo">Menampilkan 1 sampai 10 dari {{ $users->count() }} entri</span>
            </div>

            <!-- Pagination -->
            <div id="paginationContainer" class="flex items-center gap-2"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#usersTable').DataTable({
        "language": {
            "lengthMenu": "_MENU_",
            "zeroRecords": "Tidak ada data yang ditemukan",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(difilter dari _MAX_ total entri)",
            "search": "",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Berikutnya",
                "previous": "Sebelumnya"
            }
        },
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
        "order": [[0, 'asc']],
        "columnDefs": [
            { "orderable": false, "targets": [5] }
        ],
        "dom": 'rtip',
        "drawCallback": function(settings) {
            var api = this.api();
            var pageInfo = api.page.info();
            
            // Update info text
            $('#tableInfo').text('Menampilkan ' + (pageInfo.start + 1) + ' sampai ' + pageInfo.end + ' dari ' + pageInfo.recordsTotal + ' entri');
            
            // Build custom pagination
            buildPagination(pageInfo);
        }
    });

    // Custom search
    $('#searchInput').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Custom entries per page
    $('#entriesPerPage').on('change', function() {
        table.page.len(parseInt(this.value)).draw();
    });

    // Build pagination buttons
    function buildPagination(pageInfo) {
        var pagination = $('#paginationContainer');
        pagination.empty();

        if (pageInfo.pages <= 1) return;

        var currentPage = pageInfo.page;
        var totalPages = pageInfo.pages;

        // Previous button
        var prevBtn = $('<button class="px-4 py-2 text-sm font-medium rounded-lg border transition-colors ' + 
            (currentPage === 0 ? 'border-gray-200 text-gray-400 cursor-not-allowed' : 'border-gray-300 text-gray-700 hover:bg-gray-50') + 
            '">Sebelumnya</button>');
        if (currentPage > 0) {
            prevBtn.on('click', function() {
                table.page('previous').draw('page');
            });
        }
        pagination.append(prevBtn);

        // Page numbers
        var startPage = Math.max(0, currentPage - 2);
        var endPage = Math.min(totalPages - 1, currentPage + 2);

        if (startPage > 0) {
            var firstBtn = $('<button class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">1</button>');
            firstBtn.on('click', function() {
                table.page(0).draw('page');
            });
            pagination.append(firstBtn);
            
            if (startPage > 1) {
                pagination.append($('<span class="px-2 text-gray-500">...</span>'));
            }
        }

        for (var i = startPage; i <= endPage; i++) {
            var pageBtn = $('<button class="px-4 py-2 text-sm font-medium rounded-lg border transition-colors ' +
                (i === currentPage ? 'bg-[#A4B465] border-[#A4B465] text-white' : 'border-gray-300 text-gray-700 hover:bg-gray-50') +
                '">' + (i + 1) + '</button>');
            
            (function(pageNum) {
                if (pageNum !== currentPage) {
                    pageBtn.on('click', function() {
                        table.page(pageNum).draw('page');
                    });
                }
            })(i);
            
            pagination.append(pageBtn);
        }

        if (endPage < totalPages - 1) {
            if (endPage < totalPages - 2) {
                pagination.append($('<span class="px-2 text-gray-500">...</span>'));
            }
            
            var lastBtn = $('<button class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">' + totalPages + '</button>');
            lastBtn.on('click', function() {
                table.page(totalPages - 1).draw('page');
            });
            pagination.append(lastBtn);
        }

        // Next button
        var nextBtn = $('<button class="px-4 py-2 text-sm font-medium rounded-lg border transition-colors ' + 
            (currentPage === totalPages - 1 ? 'border-gray-200 text-gray-400 cursor-not-allowed' : 'border-gray-300 text-gray-700 hover:bg-gray-50') + 
            '">Berikutnya</button>');
        if (currentPage < totalPages - 1) {
            nextBtn.on('click', function() {
                table.page('next').draw('page');
            });
        }
        pagination.append(nextBtn);
    }

    // Initial pagination build
    buildPagination(table.page.info());
});
</script>

<style>
/* Table Styling */
#usersTable {
    border-collapse: separate;
    border-spacing: 0;
}

#usersTable thead tr th {
    position: sticky;
    top: 0;
    z-index: 10;
}

#usersTable tbody tr {
    background-color: white;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .overflow-x-auto {
        margin: 0 -2rem;
        padding: 0 2rem;
    }
}

@media (max-width: 768px) {
    .px-8 {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }
    
    #usersTable thead th,
    #usersTable tbody td {
        padding-left: 1rem;
        padding-right: 1rem;
        font-size: 0.813rem;
    }
    
    .overflow-x-auto {
        margin: 0 -1.5rem;
        padding: 0 1.5rem;
    }
    
    #paginationContainer button {
        padding: 0.5rem 0.75rem;
        font-size: 0.813rem;
    }
}

@media (max-width: 640px) {
    .px-8 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    #usersTable thead th,
    #usersTable tbody td {
        padding: 0.75rem 0.5rem;
        font-size: 0.75rem;
    }
    
    #paginationContainer {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    #paginationContainer button,
    #paginationContainer span {
        font-size: 0.75rem;
    }
    
    .max-w-[250px] {
        max-width: 150px;
    }
}

/* Custom Scrollbar */
.overflow-x-auto::-webkit-scrollbar {
    height: 8px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #A4B465;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #8A9A55;
}

/* Smooth transitions */
* {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>

@endpush
@endsection