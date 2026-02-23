@extends('layout_admin.admin')
@section('pageTitle', 'Admin Dashboard - Data Pengguna')

@section('content')
<!-- Tabel Data Pengguna -->
<div class="p-4 md:p-6 overflow-x-auto">
    <!-- Header Section -->
    <div class="text-left mb-8 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center space-x-4 mb-3">
            <div class="bg-white/20 p-3 rounded-full">
                <i class="fa-solid fa-user text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl lg:text-4xl font-bold mb-2 text-white">Manajemen Data Pengguna</h1>
                <p class="text-white text-lg">Kelola dan pantau seluruh pengguna di perpustakaan</p>
            </div>
        </div>
        <div class="flex items-center space-x-2 text-sm text-white">
            <i class="fas fa-chart-line"></i>
            <span>Total Pengguna: <strong>{{ $totalUsers }}</strong></span>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mt-6">
        <div class="overflow-x-auto">
            <table id="usersTable" class="w-full text-sm">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 text-gray-700 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-hashtag text-[#A4B465]"></i>
                                <span>No</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left font-semibold">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-user text-[#A4B465]"></i>
                                <span>Nama Pengguna</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left font-semibold">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-phone text-[#A4B465]"></i>
                                <span>No. Telepon</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left font-semibold">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-envelope text-[#A4B465]"></i>
                                <span>Alamat Email</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-center font-semibold">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-id-card text-[#A4B465]"></i>
                                <span>Jenis Keanggotaan</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-center font-semibold">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-venus-mars text-[#A4B465]"></i>
                                <span>Gender</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-center font-semibold">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-venus-mars text-[#A4B465]"></i>
                                <span>Aksi</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($users as $index => $user)
                    <tr class="hover:bg-gray-50/80 transition-colors duration-150">
                        <td class="px-6 py-4 text-center text-gray-600 font-medium">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#A4B465] to-[#8A9A55] flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-semibold text-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                                <span class="font-semibold text-gray-900">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->phone)
                                <div class="text-sm text-gray-900">
                                    <i class="fas fa-phone text-gray-400 mr-2"></i>{{ $user->phone }}
                                </div>
                            @else
                                <span class="text-sm text-gray-400 italic">Not Found</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 flex items-center gap-2">
                                <i class="fas fa-envelope text-gray-400"></i>
                                <span class="truncate max-w-[250px]">{{ $user->email }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($user->membership_type == 'pengunjung')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#A4B465] text-white">
                                    <i class="fas fa-user"></i>
                                    Pengunjung
                                </span>
                            @elseif($user->membership_type == 'anggota')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#C5D28B] text-white">
                                    <i class="fas fa-user-graduate"></i>
                                    Anggota
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-gray-400 text-white">
                                    {{ ucfirst($user->membership_type) }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($user->gender == 'L')
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-blue-100 text-blue-600">
                                    <i class="fas fa-mars"></i>
                                </span>
                            @elseif($user->gender == 'P')
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-pink-100 text-pink-600">
                                    <i class="fas fa-venus"></i>
                                </span>
                            @else
                                <span class="text-sm text-gray-400 italic">Not Found</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button
                                type="button"
                                class="bg-red-600 text-white p-2.5 rounded-lg hover:bg-red-700 transition-all duration-200 delete-btn shadow-sm transform hover:scale-105"
                                title="Hapus Pengguna"
                                data-id="{{ $user->id }}"
                                data-name="{{ $user->name }}">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#usersTable').DataTable({
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
                    { orderable: false, targets: [5] } // Gender tidak bisa di-sort
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
        });


        $(document).on('click', '.delete-btn', function () {
            let userId = $(this).data('id');
            let userName = $(this).data('name');

            Swal.fire({
                title: 'Hapus Pengguna?',
                html: `Apakah kamu yakin ingin menghapus <strong>${userName}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/data_pengguna/${userId}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (res) {
                            Swal.fire('Berhasil!', res.message, 'success')
                                .then(() => location.reload());
                        },
                        error: function (xhr) {
                            Swal.fire(
                                'Gagal!',
                                xhr.responseJSON?.message ?? 'Terjadi kesalahan.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
@endpush