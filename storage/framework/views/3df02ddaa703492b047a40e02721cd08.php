
<?php $__env->startSection('pageTitle', 'Data Akun Admin'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Tabel Data Pengguna -->
    <div class="p-4 md:p-6 overflow-x-auto">
        <!-- Header Section -->
        <div class="text-left mb-8 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center space-x-4 mb-3">
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fa-solid fa-user-gear text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl lg:text-4xl font-bold mb-2 text-white">Manajemen Data Admin</h1>
                    <p class="text-white text-lg">Kelola dan pantau seluruh admin di perpustakaan</p>
                </div>
            </div>
            <div class="flex items-center space-x-2 text-sm text-white">
                <i class="fas fa-chart-line"></i>
                <span>Total Admin: <strong><?php echo e($totalUsers); ?></strong></span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                <i class="fas fa-list-alt text-[#A4B465] mr-3"></i>
                Daftar Akun Admin
            </h2>
            <form action="<?php echo e(route('superadmin.akun_admin.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit"
                    class="bg-[#A4B465] hover:bg-[#8AA24F] text-white px-5 py-2.5 rounded-xl shadow
           flex items-center gap-2"
                    title="Akun dibuat otomatis (username, email, dan password di-generate sistem)">
                    <i class="fas fa-bolt"></i>
                    Tambah Akun Admin
                </button>

            </form>

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
                            <th class="px-6 py-4 text-left font-semibold">
                                <button type="button" onclick="togglePassword()"
                                    class="flex items-center gap-2 text-[#A4B465] hover:text-[#8AA24F] transition">
                                    <i class="fas fa-key"></i>
                                    <span>Password</span>
                                    <i id="eyeIcon" class="fas fa-eye-slash"></i>
                                </button>
                            </th>
                            <th class="px-6 py-4 text-center font-semibold">
                                <div class="flex items-center justify-center space-x-2">
                                    <i class="fas fa-cog text-[#A4B465]"></i>
                                    <span>Aksi</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50/80 transition-colors duration-150">
                                <td class="px-6 py-4 text-center text-gray-600 font-medium">
                                    <?php echo e($index + 1); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-to-br from-[#A4B465] to-[#8A9A55] flex items-center justify-center flex-shrink-0">
                                            <span
                                                class="text-white font-semibold text-sm"><?php echo e(strtoupper(substr($admin->name, 0, 1))); ?></span>
                                        </div>
                                        <span class="font-semibold text-gray-900"><?php echo e($admin->name); ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if($admin->phone): ?>
                                        <div class="text-sm text-gray-900">
                                            <i class="fas fa-phone text-gray-400 mr-2"></i><?php echo e($admin->phone); ?>

                                        </div>
                                    <?php else: ?>
                                        <span class="text-sm text-gray-400 italic">Not Found</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 flex items-center gap-2">
                                        <i class="fas fa-envelope text-gray-400"></i>

                                        <span class="truncate max-w-[250px] email-text">
                                            <?php echo e($admin->email); ?>

                                        </span>

                                        <button type="button"
                                            class="copy-email-btn text-gray-400 hover:text-[#A4B465] transition"
                                            data-email="<?php echo e($admin->email); ?>" title="Copy email">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="font-mono text-red-600 password-text blur-sm select-none transition"
                                            data-visible="false" data-password="<?php echo e($admin->plain_password); ?>">
                                            <?php echo e($admin->plain_password); ?>

                                        </span>

                                        <!-- Copy icon (hidden by default) -->
                                        <button type="button"
                                            class="copy-btn hidden text-gray-500 hover:text-[#A4B465] transition"
                                            data-password="<?php echo e($admin->plain_password); ?>" title="Copy password">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="<?php echo e(route('superadmin.akun_admin.destroy', $admin)); ?>" method="POST"
                                        class="delete-form">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button type="button"
                                            class="delete-btn inline-flex items-center justify-center w-9 h-9 rounded-lg
                                        bg-red-50 text-red-600
                                        hover:bg-red-600 hover:text-white transition"
                                            data-name="<?php echo e($admin->name); ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {

            const table = $('#usersTable').DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,

                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],

                ordering: true,
                searching: true,
                info: true,

                dom: `
            <"flex flex-col sm:flex-row justify-between items-center gap-4 mb-4 px-4 pt-4"
                l
                f
            >
            rt
            <"flex flex-col sm:flex-row justify-between items-center gap-4 mt-4 px-4 pb-4"
                i
                p
            >
        `,

                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    zeroRecords: "Data tidak ditemukan",
                    emptyTable: "Belum ada data admin",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "›",
                        previous: "‹"
                    }
                },

                columnDefs: [{
                        targets: 0,
                        orderable: false,
                        searchable: false
                    },
                    {
                        targets: 4, // Password
                        orderable: false,
                        searchable: false
                    },
                    {
                        targets: 5, // Aksi
                        orderable: false,
                        searchable: false
                    }
                ]

            });

            /* ===============================
               Styling Tailwind DataTables
            =============================== */

            $('.dataTables_length select').addClass(
                'px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465]'
            );

            $('.dataTables_filter input').addClass(
                'px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] ml-2'
            );

            $('.dataTables_length label, .dataTables_filter label').addClass(
                'text-sm text-gray-700 font-medium'
            );

            $('.dataTables_info').addClass(
                'text-sm text-gray-600'
            );

            $('.dataTables_paginate').addClass(
                'flex gap-1'
            );

            $('.paginate_button').addClass(
                'px-3 py-1 border border-gray-300 rounded-lg text-sm hover:bg-[#A4B465] hover:text-white hover:border-[#A4B465] transition'
            );

            $('.paginate_button.current').addClass(
                'bg-[#A4B465] text-white border-[#A4B465]'
            );

            $('.paginate_button.disabled').addClass(
                'opacity-50 cursor-not-allowed'
            );

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout_superAdmin.super_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/super_admin/akun_admin/index.blade.php ENDPATH**/ ?>