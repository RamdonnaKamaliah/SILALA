<?php $__env->startSection('pageTitle', 'Data Peminjam'); ?>

<?php $__env->startSection('content'); ?>
<<<<<<< HEAD
<div class="p-4 md:p-6 overflow-x-auto">
    <!-- Judul Halaman -->
    <div class="text-left mb-6">
        <h1 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-2">
            Selamat datang di Dashboard Data Peminjam 🎉
        </h1>
        <p class="text-gray-600">
            Lihat dan pantau seluruh data peminjaman buku perpustakaan.
        </p>
    </div>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-[#A4B465]">Data Peminjaman Buku</h2>
    </div>

    <!-- Filter Status -->
    <div class="mb-6 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="flex flex-wrap gap-2 items-center">
            <span class="text-sm font-medium text-gray-700">Filter Status:</span>
            <button type="button" data-status="all" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200 hover:bg-blue-200 transition-colors active">
                Semua
            </button>
            <button type="button" data-status="dipinjam" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200 hover:bg-blue-200 transition-colors">
                Dipinjam
            </button>
            <button type="button" data-status="dikembalikan" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200 hover:bg-green-200 transition-colors">
                Dikembalikan
            </button>
            <button type="button" data-status="bermasalah" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200 hover:bg-red-200 transition-colors">
                Bermasalah
            </button>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="overflow-x-auto mt-4 bg-white rounded-lg shadow-sm border border-gray-200">
        <?php if($data_peminjam->count() > 0): ?>
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="w-16 px-4 py-3 border-b border-gray-200 text-center">No</th>
                        <th class="px-4 py-3 border-b border-gray-200 text-left">Nama Peminjam</th>
                        <th class="px-4 py-3 border-b border-gray-200 text-left">Judul Buku</th>
                        <th class="px-4 py-3 border-b border-gray-200 text-center">Tanggal Pinjam</th>
                        <th class="px-4 py-3 border-b border-gray-200 text-center">Tanggal Kembali</th>
                        <th class="px-4 py-3 border-b border-gray-200 text-center">Status</th>
                        <th class="px-4 py-3 border-b border-gray-200 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200" id="tableBody">
                    <?php $__currentLoopData = $data_peminjam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peminjam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isLate = now()->gt($peminjam->tanggal_kembali) && $peminjam->status == 'dipinjam';
                        ?>
                        <tr class="hover:bg-gray-50 transition-colors" data-status="<?php echo e($peminjam->status); ?>">
                            <td class="px-4 py-3 text-center font-medium text-gray-600">
                                <?php echo e($loop->iteration); ?>

                            </td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900"><?php echo e($peminjam->user->name ?? '-'); ?></div>
                                <div class="text-xs text-gray-500"><?php echo e($peminjam->user->email ?? ''); ?></div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900"><?php echo e($peminjam->buku->judul_buku ?? '-'); ?></div>
                                <div class="text-xs text-gray-500">oleh <?php echo e($peminjam->buku->penulis ?? '-'); ?></div>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-600">
                                <?php echo e(\Carbon\Carbon::parse($peminjam->tanggal_pinjam)->translatedFormat('d M Y')); ?>

                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="text-gray-600 <?php echo e($isLate ? 'text-red-600 font-semibold' : ''); ?>">
                                    <?php echo e(\Carbon\Carbon::parse($peminjam->tanggal_kembali)->translatedFormat('d M Y')); ?>

                                </div>
                                <?php if($isLate): ?>
                                    <div class="text-xs text-red-500 mt-1">
                                        Terlambat <?php echo e(now()->diffInDays($peminjam->tanggal_kembali)); ?> hari
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <?php if($peminjam->status == 'dipinjam'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium <?php echo e($isLate ? 'bg-red-100 text-red-800 border border-red-200' : 'bg-blue-100 text-blue-800 border border-blue-200'); ?>">
=======
<div class="p-4 md:p-6 lg:p-8 min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <div class="flex-1">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                Data
                <span class="relative">
                    Peminjam
                    <span class="absolute -top-1 -right-8 text-3xl text-[#A4B465]">✨</span>
                </span>
            </h1>

            <!-- Elegant Description -->
            <div class="relative">
                <p class="text-gray-600 text-lg max-w-2xl leading-relaxed pl-6 border-l-2 border-[#A4B465]">
                    Sistem manajemen peminjaman buku yang <span class="text-[#A4B465] font-semibold">canggih</span> dan 
                    <span class="text-[#A4B465] font-semibold">user-friendly</span> untuk pengalaman terbaik.
                </p>
                <div class="absolute left-0 top-0 w-1 h-full bg-gradient-to-b from-[#A4B465] to-[#8a9a58] rounded-full"></div>
            </div>
    <!-- Quick Actions -->
    <div class="flex items-center gap-3 mt-6">
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <i class="fas fa-shield-alt text-[#A4B465]"></i>
            <span>Secure</span>
        </div>
        <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <i class="fas fa-rocket text-[#A4B465]"></i>
            <span>Fast</span>
        </div>
        <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <i class="fas fa-infinity text-[#A4B465]"></i>
            <span>Reliable</span>
        </div>
    </div>
</div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#A4B465] rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-white text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Peminjaman</p>
                        <p class="text-xl font-bold text-gray-800"><?php echo e($data_peminjam->count()); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="mb-6 bg-white rounded-2xl shadow-sm border border-gray-200 p-4 md:p-6">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            <div class="flex items-center gap-2">
                <i class="fas fa-filter text-[#A4B465]"></i>
                <span class="text-sm font-semibold text-gray-700">Filter Status:</span>
            </div>
            <div class="flex flex-wrap gap-2">
                <button type="button" data-status="all" 
                    class="filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-[#A4B465] text-white border border-[#A4B465] hover:bg-[#8a9a58] transition-all duration-200 shadow-sm active transform hover:scale-105 flex items-center gap-2">
                    <i class="fas fa-layer-group text-xs"></i>
                    Semua
                </button>
                <button type="button" data-status="dipinjam" 
                    class="filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-book text-xs"></i>
                    Dipinjam
                </button>
                <button type="button" data-status="dikembalikan" 
                    class="filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-green-50 text-green-700 border border-green-200 hover:bg-green-100 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-check text-xs"></i>
                    Dikembalikan
                </button>
                <button type="button" data-status="bermasalah" 
                    class="filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-red-50 text-red-700 border border-red-200 hover:bg-red-100 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle text-xs"></i>
                    Bermasalah
                </button>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <?php if($data_peminjam->count() > 0): ?>
            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-hashtag text-[#A4B465]"></i>
                                    No
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-user text-[#A4B465]"></i>
                                    Peminjam
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-book text-[#A4B465]"></i>
                                    Buku
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-calendar-alt text-[#A4B465]"></i>
                                    Tanggal
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-tag text-[#A4B465]"></i>
                                    Status
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-cog text-[#A4B465]"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="tableBody">
                        <?php $__currentLoopData = $data_peminjam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peminjam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $isLate = now()->gt($peminjam->tanggal_kembali) && $peminjam->status == 'dipinjam';
                            ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-150" data-status="<?php echo e($peminjam->status); ?>">
                                <!-- No -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 text-center">
                                        <?php echo e($loop->iteration); ?>

                                    </div>
                                </td>
                                
                                <!-- Peminjam -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-[#A4B465] rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-white text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900"><?php echo e($peminjam->user->name ?? '-'); ?></div>
                                            <div class="text-xs text-gray-500"><?php echo e($peminjam->user->email ?? ''); ?></div>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Buku -->
                                <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        <div class="font-semibold text-gray-900 truncate"><?php echo e($peminjam->buku->judul_buku ?? '-'); ?></div>
                                        <div class="text-xs text-gray-500">oleh <?php echo e($peminjam->buku->penulis ?? '-'); ?></div>
                                    </div>
                                </td>
                                
                                <!-- Tanggal -->
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <i class="fas fa-sign-out-alt text-[#A4B465] text-xs"></i>
                                            <?php echo e(\Carbon\Carbon::parse($peminjam->tanggal_pinjam)->translatedFormat('d M Y')); ?>

                                        </div>
                                        <div class="flex items-center gap-2 text-sm <?php echo e($isLate ? 'text-red-600 font-semibold' : 'text-gray-600'); ?>">
                                            <i class="fas fa-sign-in-alt text-[#A4B465] text-xs"></i>
                                            <?php echo e(\Carbon\Carbon::parse($peminjam->tanggal_kembali)->translatedFormat('d M Y')); ?>

                                            <?php if($isLate): ?>
                                                <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">
                                                    +<?php echo e(now()->diffInDays($peminjam->tanggal_kembali)); ?> hari
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                
                                <!-- Status -->
                                <td class="px-6 py-4">
                                    <?php if($peminjam->status == 'dipinjam'): ?>
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold <?php echo e($isLate ? 'bg-red-100 text-red-800 border border-red-200' : 'bg-blue-100 text-blue-800 border border-blue-200'); ?>">
                                            <i class="fas <?php echo e($isLate ? 'fa-exclamation-triangle' : 'fa-book'); ?> mr-1.5"></i>
                                            <?php echo e($isLate ? 'Terlambat' : 'Dipinjam'); ?>

                                        </span>
                                    <?php elseif($peminjam->status == 'dikembalikan'): ?>
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                            <i class="fas fa-check mr-1.5"></i>
                                            Dikembalikan
                                        </span>
                                    <?php elseif($peminjam->status == 'bermasalah'): ?>
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                                            <i class="fas fa-exclamation-circle mr-1.5"></i>
                                            Bermasalah
                                        </span>
                                    <?php endif; ?>
                                </td>
                                
                                <!-- Aksi -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <?php if($peminjam->status == 'dipinjam'): ?>
                                            <!-- Konfirmasi Kembali -->
                                            <form action="<?php echo e(route('admin.data_peminjam.kembalikan', $peminjam->id)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <button type="submit" 
                                                    class="bg-[#A4B465] text-white px-3 py-2 rounded-lg hover:bg-[#8a9a58] text-xs font-semibold transition-all duration-200 flex items-center gap-2 shadow-sm transform hover:scale-105"
                                                    onclick="return confirm('Konfirmasi pengembalian buku?')">
                                                    <i class="fas fa-undo text-xs"></i>
                                                    Kembalikan
                                                </button>
                                            </form>
                                            
                                            <!-- Laporkan Masalah -->
                                            <form action="<?php echo e(route('admin.data_peminjam.masalah', $peminjam->id)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <button type="submit"
                                                    class="bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 text-xs font-semibold transition-all duration-200 flex items-center gap-2 shadow-sm transform hover:scale-105"
                                                    title="Laporkan Masalah"
                                                    onclick="return confirm('Yakin melaporkan masalah pada peminjaman ini?')">
                                                    <i class="fas fa-exclamation-triangle text-xs"></i>
                                                    Masalah
                                                </button>
                                            </form>
                                        <?php elseif($peminjam->status == 'dikembalikan'): ?>
                                            <span class="inline-flex items-center px-3 py-2 bg-green-100 text-green-800 rounded-lg text-xs font-semibold">
                                                <i class="fas fa-check-circle mr-1.5"></i>
                                                Selesai
                                            </span>
                                        <?php elseif($peminjam->status == 'bermasalah'): ?>
                                            <span class="inline-flex items-center px-3 py-2 bg-red-100 text-red-800 rounded-lg text-xs font-semibold">
                                                <i class="fas fa-exclamation-circle mr-1.5"></i>
                                                Bermasalah
                                            </span>
                                        <?php endif; ?>

                                        <!-- Tombol Detail -->
                                        <a href="<?php echo e(route('admin.data_peminjam.show', $peminjam->id)); ?>"
                                            class="bg-gray-600 text-white px-3 py-2 rounded-lg hover:bg-gray-700 text-xs font-semibold transition-all duration-200 flex items-center gap-2 shadow-sm transform hover:scale-105"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye text-xs"></i>
                                            Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="lg:hidden space-y-4 p-4">
                <?php $__currentLoopData = $data_peminjam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peminjam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $isLate = now()->gt($peminjam->tanggal_kembali) && $peminjam->status == 'dipinjam';
                    ?>
                    <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm hover:shadow-md transition-all duration-200" data-status="<?php echo e($peminjam->status); ?>">
                        <!-- Header Card -->
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-[#A4B465] rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900"><?php echo e($peminjam->user->name ?? '-'); ?></h3>
                                    <p class="text-xs text-gray-500"><?php echo e($peminjam->user->email ?? ''); ?></p>
                                </div>
                            </div>
                            <div class="text-right">
                                <?php if($peminjam->status == 'dipinjam'): ?>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold <?php echo e($isLate ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800'); ?>">
>>>>>>> f0747171cd3dd3a038c7f5e52e06862e4f0a8864
                                        <i class="fas <?php echo e($isLate ? 'fa-exclamation-triangle' : 'fa-book'); ?> mr-1"></i>
                                        <?php echo e($isLate ? 'Terlambat' : 'Dipinjam'); ?>

                                    </span>
                                <?php elseif($peminjam->status == 'dikembalikan'): ?>
<<<<<<< HEAD
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
=======
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
>>>>>>> f0747171cd3dd3a038c7f5e52e06862e4f0a8864
                                        <i class="fas fa-check mr-1"></i>
                                        Dikembalikan
                                    </span>
                                <?php elseif($peminjam->status == 'bermasalah'): ?>
<<<<<<< HEAD
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
=======
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
>>>>>>> f0747171cd3dd3a038c7f5e52e06862e4f0a8864
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        Bermasalah
                                    </span>
                                <?php endif; ?>
<<<<<<< HEAD
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex flex-col sm:flex-row gap-2 justify-center items-center">
                                    <?php if($peminjam->status == 'dipinjam'): ?>
                                        <!-- Konfirmasi Kembali -->
                                        <form action="<?php echo e(route('admin.data_peminjam.kembalikan', $peminjam->id)); ?>" method="POST" class="inline">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <button type="submit" 
        class="bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700 text-xs font-medium transition-colors flex items-center gap-1"
        onclick="return confirm('Konfirmasi pengembalian buku?')">
        <i class="fas fa-undo text-xs"></i>
        Kembalikan
    </button>
</form>
                                        
                                        <!-- Laporkan Masalah -->
                                        <form action="<?php echo e(route('admin.data_peminjam.masalah', $peminjam->id)); ?>" method="POST" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1.5 rounded-lg hover:bg-red-700 text-xs font-medium transition-colors flex items-center gap-1"
                                                title="Laporkan Masalah"
                                                onclick="return confirm('Yakin melaporkan masalah pada peminjaman ini?')">
                                                <i class="fas fa-exclamation-triangle text-xs"></i>
                                                Masalah
                                            </button>
                                        </form>
                                        
                                    <?php elseif($peminjam->status == 'dikembalikan'): ?>
                                        <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Selesai
                                        </span>
                                    <?php elseif($peminjam->status == 'bermasalah'): ?>
                                        <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">
                                            <i class="fas fa-exclamation-circle mr-1"></i>
                                            Bermasalah
                                        </span>
                                    <?php endif; ?>

                                    <!-- Tombol Detail -->
                                    <a href="<?php echo e(route('admin.data_peminjam.show', $peminjam->id)); ?>"
                                        class="bg-gray-600 text-white px-3 py-1.5 rounded-lg hover:bg-gray-700 text-xs font-medium transition-colors flex items-center gap-1"
                                        title="Lihat Detail">
                                        <i class="fas fa-eye text-xs"></i>
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <!-- Empty State untuk Filter (awalnya tersembunyi) -->
            <div id="emptyFilterState" class="hidden text-center py-12">
                <div class="mx-auto w-24 h-24 mb-4 text-gray-400">
                    <i class="fas fa-search text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Tidak Ada Data</h3>
                <p class="text-gray-500 max-w-md mx-auto">
=======
                            </div>
                        </div>

                        <!-- Book Info -->
                        <div class="mb-3">
                            <h4 class="font-semibold text-gray-900 text-sm mb-1"><?php echo e($peminjam->buku->judul_buku ?? '-'); ?></h4>
                            <p class="text-xs text-gray-600">oleh <?php echo e($peminjam->buku->penulis ?? '-'); ?></p>
                        </div>

                        <!-- Dates -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Tanggal Pinjam</p>
                                <p class="text-sm font-medium text-gray-900">
                                    <?php echo e(\Carbon\Carbon::parse($peminjam->tanggal_pinjam)->translatedFormat('d M Y')); ?>

                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Tanggal Kembali</p>
                                <p class="text-sm font-medium <?php echo e($isLate ? 'text-red-600' : 'text-gray-900'); ?>">
                                    <?php echo e(\Carbon\Carbon::parse($peminjam->tanggal_kembali)->translatedFormat('d M Y')); ?>

                                    <?php if($isLate): ?>
                                        <span class="text-xs bg-red-100 text-red-800 px-1.5 py-0.5 rounded-full ml-1">
                                            +<?php echo e(now()->diffInDays($peminjam->tanggal_kembali)); ?> hari
                                        </span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-200">
                            <?php if($peminjam->status == 'dipinjam'): ?>
                                <form action="<?php echo e(route('admin.data_peminjam.kembalikan', $peminjam->id)); ?>" method="POST" class="flex-1 min-w-[120px]">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button type="submit" 
                                        class="w-full bg-[#A4B465] text-white px-3 py-2 rounded-lg hover:bg-[#8a9a58] text-xs font-semibold transition-all duration-200 flex items-center justify-center gap-2"
                                        onclick="return confirm('Konfirmasi pengembalian buku?')">
                                        <i class="fas fa-undo text-xs"></i>
                                        Kembalikan
                                    </button>
                                </form>
                                
                                <form action="<?php echo e(route('admin.data_peminjam.masalah', $peminjam->id)); ?>" method="POST" class="flex-1 min-w-[100px]">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button type="submit"
                                        class="w-full bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700 text-xs font-semibold transition-all duration-200 flex items-center justify-center gap-2"
                                        onclick="return confirm('Yakin melaporkan masalah pada peminjaman ini?')">
                                        <i class="fas fa-exclamation-triangle text-xs"></i>
                                        Masalah
                                    </button>
                                </form>
                            <?php elseif($peminjam->status == 'dikembalikan'): ?>
                                <span class="inline-flex items-center px-3 py-2 bg-green-100 text-green-800 rounded-lg text-xs font-semibold w-full justify-center">
                                    <i class="fas fa-check-circle mr-1.5"></i>
                                    Selesai
                                </span>
                            <?php elseif($peminjam->status == 'bermasalah'): ?>
                                <span class="inline-flex items-center px-3 py-2 bg-red-100 text-red-800 rounded-lg text-xs font-semibold w-full justify-center">
                                    <i class="fas fa-exclamation-circle mr-1.5"></i>
                                    Bermasalah
                                </span>
                            <?php endif; ?>

                            <a href="<?php echo e(route('admin.data_peminjam.show', $peminjam->id)); ?>"
                                class="flex-1 min-w-[80px] bg-gray-600 text-white px-3 py-2 rounded-lg hover:bg-gray-700 text-xs font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                                <i class="fas fa-eye text-xs"></i>
                                Detail
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Empty State untuk Filter -->
            <div id="emptyFilterState" class="hidden text-center py-12">
                <div class="mx-auto w-20 h-20 mb-4 text-gray-300">
                    <i class="fas fa-search text-5xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Tidak Ada Data</h3>
                <p class="text-gray-500 max-w-md mx-auto text-sm">
>>>>>>> f0747171cd3dd3a038c7f5e52e06862e4f0a8864
                    Tidak ada data peminjaman dengan status yang dipilih.
                </p>
            </div>
        <?php else: ?>
<<<<<<< HEAD
            <!-- Tampilan ketika data kosong secara keseluruhan -->
            <div class="text-center py-12">
                <div class="mx-auto w-24 h-24 mb-4 text-gray-400">
                    <i class="fas fa-book-open text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Tidak Ada Data Peminjaman</h3>
                <p class="text-gray-500 max-w-md mx-auto mb-6">
                    Saat ini belum ada data peminjaman buku yang tercatat dalam sistem.
                </p>
                <div class="text-gray-400 text-3xl">
=======
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="mx-auto w-24 h-24 mb-6 text-gray-300">
                    <i class="fas fa-book-open text-6xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-3">Belum Ada Data Peminjaman</h3>
                <p class="text-gray-500 max-w-md mx-auto mb-6 text-sm">
                    Saat ini belum ada data peminjaman buku yang tercatat dalam sistem.
                </p>
                <div class="text-gray-400 text-4xl">
>>>>>>> f0747171cd3dd3a038c7f5e52e06862e4f0a8864
                    <i class="fas fa-inbox"></i>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
<<<<<<< HEAD
    const tableRows = document.querySelectorAll('#tableBody tr');
    const emptyFilterState = document.getElementById('emptyFilterState');
    const table = document.querySelector('table');
    
    // Hanya jalankan filter jika ada data
=======
    const tableRows = document.querySelectorAll('#tableBody tr, .lg\\:hidden .bg-white[data-status]');
    const emptyFilterState = document.getElementById('emptyFilterState');
    const desktopTable = document.querySelector('.hidden.lg\\:block');
    const mobileCards = document.querySelector('.lg\\:hidden');
    
>>>>>>> f0747171cd3dd3a038c7f5e52e06862e4f0a8864
    if (tableRows.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                
                // Update active button
<<<<<<< HEAD
                filterButtons.forEach(btn => btn.classList.remove('active', 'ring-2', 'ring-offset-1'));
                this.classList.add('active', 'ring-2', 'ring-offset-1');
=======
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'ring-2', 'ring-[#A4B465]', 'ring-offset-2');
                    if (btn.getAttribute('data-status') === 'all') {
                        btn.className = 'filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition-all duration-200 flex items-center gap-2';
                    } else if (btn.getAttribute('data-status') === 'dipinjam') {
                        btn.className = 'filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition-all duration-200 flex items-center gap-2';
                    } else if (btn.getAttribute('data-status') === 'dikembalikan') {
                        btn.className = 'filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-green-50 text-green-700 border border-green-200 hover:bg-green-100 transition-all duration-200 flex items-center gap-2';
                    } else if (btn.getAttribute('data-status') === 'bermasalah') {
                        btn.className = 'filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-red-50 text-red-700 border border-red-200 hover:bg-red-100 transition-all duration-200 flex items-center gap-2';
                    }
                });
                
                this.classList.add('active', 'ring-2', 'ring-[#A4B465]', 'ring-offset-2');
                if (status === 'all') {
                    this.className = 'filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-[#A4B465] text-white border border-[#A4B465] hover:bg-[#8a9a58] transition-all duration-200 shadow-sm active transform hover:scale-105 flex items-center gap-2 ring-2 ring-[#A4B465] ring-offset-2';
                }
>>>>>>> f0747171cd3dd3a038c7f5e52e06862e4f0a8864
                
                let visibleRows = 0;
                
                // Filter rows
                tableRows.forEach(row => {
                    if (status === 'all') {
                        row.style.display = '';
                        visibleRows++;
                    } else {
                        const rowStatus = row.getAttribute('data-status');
                        if (rowStatus === status) {
                            row.style.display = '';
                            visibleRows++;
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });

                // Tampilkan pesan kosong jika tidak ada baris yang terlihat
                if (visibleRows === 0) {
<<<<<<< HEAD
                    table.style.display = 'none';
                    emptyFilterState.classList.remove('hidden');
                } else {
                    table.style.display = '';
                    emptyFilterState.classList.add('hidden');
=======
                    if (desktopTable) desktopTable.style.display = 'none';
                    if (mobileCards) mobileCards.style.display = 'none';
                    if (emptyFilterState) emptyFilterState.classList.remove('hidden');
                } else {
                    if (desktopTable) desktopTable.style.display = '';
                    if (mobileCards) mobileCards.style.display = '';
                    if (emptyFilterState) emptyFilterState.classList.add('hidden');
>>>>>>> f0747171cd3dd3a038c7f5e52e06862e4f0a8864
                }
            });
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_peminjam/index.blade.php ENDPATH**/ ?>