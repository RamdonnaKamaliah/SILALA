<?php $__env->startSection('pageTitle', 'Detail Data Buku'); ?>

<?php $__env->startSection('content'); ?>
    <div class="p-4 md:p-6 font-poppins">
        <!-- Header Section -->
        <div class="mb-6 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-6 text-white shadow-xl">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <div class="bg-white/20 p-3 rounded-xl shadow-inner">
                        <i class="fas fa-book-open text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold mb-1 text-white">Detail Buku</h1>
                        <p class="text-white/90 text-sm">Informasi lengkap buku perpustakaan</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="flex items-center space-x-2 bg-white/10 px-3 py-2 rounded-lg">
                        <i class="fas fa-archive text-sm"></i>
                        <span class="text-sm font-medium">Status: <strong>Terarsip</strong></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mb-6">
            <a href="<?php echo e(route('admin.data_arsip.index')); ?>"
                class="inline-flex items-center space-x-3 px-5 py-2.5 
                   border border-gray-300 text-gray-700 rounded-xl font-semibold
                   hover:bg-gray-50 transition-all duration-200 text-sm shadow-sm hover:shadow-md">
                <i class="fas fa-arrow-left text-sm"></i>
                <span>Kembali ke Data Arsip</span>
            </a>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Left Column - Cover & File -->
            <div class="xl:col-span-1 space-y-6">
                <!-- Cover Book Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center space-x-3">
                        <div class="w-2 h-2 bg-[#A4B465] rounded-full"></div>
                        <span>Cover Buku</span>
                    </h2>
                    <div class="flex justify-center">
                        <?php if($buku->foto_buku && Storage::disk('public')->exists($buku->foto_buku)): ?>
                            <img src="<?php echo e(asset('storage/' . $buku->foto_buku)); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <img src="<?php echo e(asset('assets/image_default/image_default_book.jpeg')); ?>"
                                class="w-full h-full object-cover">
                        <?php endif; ?>
                    </div>
                </div>

                <!-- File PDF Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center space-x-3">
                        <div class="w-2 h-2 bg-[#A4B465] rounded-full"></div>
                        <span>File Buku</span>
                    </h2>
                    <div class="space-y-4">
                        <?php if($buku->file_buku): ?>
                            <!-- Download PDF Button -->
                            <a href="<?php echo e(asset($buku->file_buku)); ?>" download
                                class="flex items-center justify-center space-x-3 px-6 py-3
                                   bg-gradient-to-r from-[#A4B465] to-[#8AA24F] text-white rounded-xl font-bold
                                   hover:from-[#8AA24F] hover:to-[#75883f] transition-all duration-200
                                   shadow-lg hover:shadow-xl transform hover:scale-105 text-sm w-full">
                                <i class="fas fa-download text-base"></i>
                                <span>Download PDF</span>
                            </a>

                            <!-- View PDF Button -->
                            <button type="button" onclick="openPdfModal('<?php echo e(asset('storage/' . $buku->file_buku )); ?>')"
                                class="flex items-center justify-center space-x-3 px-6 py-3
                                   bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl font-bold
                                   hover:from-blue-600 hover:to-blue-700 transition-all duration-200
                                   shadow-lg hover:shadow-xl transform hover:scale-105 text-sm w-full">
                                <i class="fas fa-eye text-base"></i>
                                <span>Lihat PDF</span>
                            </button>
                        <?php else: ?>
                            <div class="flex flex-col items-center justify-center space-y-2 text-gray-400 w-full py-8">
                                <i class="fas fa-file text-3xl"></i>
                                <p class="text-sm font-semibold">Tidak ada file PDF</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right Column - Book Details -->
            <div class="xl:col-span-2 space-y-6">
                <!-- Basic Information Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center space-x-3">
                        <div class="w-2 h-2 bg-[#A4B465] rounded-full"></div>
                        <span>Informasi Buku</span>
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Judul -->
                        <div
                            class="md:col-span-2 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-[#A4B465] rounded-lg flex items-center justify-center">
                                    <i class="fas fa-heading text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1">Judul
                                        Buku</label>
                                    <p class="text-gray-800 text-base font-semibold"><?php echo e($buku->judul_buku); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Penulis & Penerbit -->
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-[#A4B465] rounded-lg flex items-center justify-center">
                                    <i class="fas fa-user-edit text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <label
                                        class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1">Penulis</label>
                                    <p class="text-gray-800 text-sm font-medium"><?php echo e($buku->penulis); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-[#A4B465] rounded-lg flex items-center justify-center">
                                    <i class="fas fa-building text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <label
                                        class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1">Penerbit</label>
                                    <p class="text-gray-800 text-sm font-medium"><?php echo e($buku->penerbit); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Tahun & Bahasa -->
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-[#A4B465] rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1">Tahun
                                        Terbit</label>
                                    <p class="text-gray-800 text-sm font-medium"><?php echo e($buku->tahun_terbit); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-[#A4B465] rounded-lg flex items-center justify-center">
                                    <i class="fas fa-language text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <label
                                        class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1">Bahasa</label>
                                    <p class="text-gray-800 text-sm font-medium"><?php echo e($buku->bahasa); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Edisi & Stok -->
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-[#A4B465] rounded-lg flex items-center justify-center">
                                    <i class="fas fa-layer-group text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <label
                                        class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1">Edisi</label>
                                    <p class="text-gray-800 text-sm font-medium"><?php echo e($buku->edisi ?: '-'); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-[#A4B465] rounded-lg flex items-center justify-center">
                                    <i class="fas fa-cubes text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <label
                                        class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1">Stok</label>
                                    <span
                                        class="inline-flex items-center justify-center px-3 py-1 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-full text-sm font-bold shadow-sm">
                                        <?php echo e($buku->stok); ?> Buku
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Halaman -->
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-[#A4B465] rounded-lg flex items-center justify-center">
                                    <i class="fas fa-file-alt text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-1">Jumlah
                                        Halaman</label>
                                    <p class="text-gray-800 text-sm font-medium"><?php echo e($buku->jumlah_halaman ?: '-'); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div
                            class="md:col-span-2 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-[#A4B465] rounded-lg flex items-center justify-center mt-0.5">
                                    <i class="fas fa-tags text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <label
                                        class="block text-xs font-bold text-gray-600 uppercase tracking-wide mb-2">Kategori</label>
                                    <?php if($buku->kategoris->isNotEmpty()): ?>
                                        <div class="flex flex-wrap gap-2">
                                            <?php $__currentLoopData = $buku->kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] text-white rounded-full text-xs font-bold shadow-sm">
                                                    <?php echo e($kategori->nama_kategori); ?>

                                                </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-gray-500 italic text-sm font-medium">Tidak ada kategori</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Card - Lebar penuh persegi panjang -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center space-x-3">
                        <div class="w-2 h-2 bg-[#A4B465] rounded-full"></div>
                        <span>Deskripsi Buku</span>
                    </h2>
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                        <p class="text-gray-700 leading-relaxed text-sm font-medium">
                            <?php echo e($buku->deskripsi ?: 'Tidak ada deskripsi tersedia untuk buku ini.'); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="<?php echo e(route('admin.data_buku.edit', $buku->id)); ?>"
                    class="flex items-center justify-center space-x-3 px-8 py-3
                       bg-gradient-to-r from-[#A4B465] to-[#8AA24F] text-white rounded-xl font-bold
                       hover:from-[#8AA24F] hover:to-[#75883f] transition-all duration-200
                       shadow-lg hover:shadow-xl transform hover:scale-105 text-sm flex-1 max-w-xs">
                    <i class="fas fa-edit text-base"></i>
                    <span>Edit Buku</span>
                </a>

                <form action="<?php echo e(route('admin.data_buku.restore', ['id' => $buku->id])); ?>" method="POST"
                    class="flex-1 max-w-xs">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <button type="submit"
                        class="w-full flex items-center justify-center space-x-3 px-8 py-3
                           bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl font-bold
                           hover:from-green-600 hover:to-green-700 transition-all duration-200
                           shadow-lg hover:shadow-xl transform hover:scale-105 text-sm">
                        <i class="fas fa-undo text-base"></i>
                        <span>Pulihkan Buku</span>
                    </button>
                </form>

                <form action="<?php echo e(route('admin.data_arsip.destroy', $buku->id)); ?>" method="POST"
                    class="flex-1 max-w-xs">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit"
                        class="w-full flex items-center justify-center space-x-3 px-8 py-3
                           bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-bold
                           hover:from-red-600 hover:to-red-700 transition-all duration-200
                           shadow-lg hover:shadow-xl transform hover:scale-105 text-sm delete-permanent-btn"
                        data-title="<?php echo e($buku->judul_buku); ?>">
                        <i class="fas fa-trash text-base"></i>
                        <span>Hapus Permanen</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- PDF Modal -->
    <div id="pdfModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closePdfModal()"></div>
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-11/12 h-5/6 max-w-6xl bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Modal Header -->
            <div
                class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] text-white">
                <h3 class="text-lg font-bold">Preview PDF - <?php echo e($buku->judul_buku); ?></h3>
                <button onclick="closePdfModal()"
                    class="w-8 h-8 flex items-center justify-center bg-white/20 rounded-lg hover:bg-white/30 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="h-full p-4 bg-gray-100">
                <iframe id="pdfViewer" class="w-full h-full rounded-lg border border-gray-300 bg-white"
                    frameborder="0"></iframe>
            </div>

            <!-- Modal Footer -->
            <div class="flex items-center justify-between px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex items-center space-x-2 text-sm text-gray-600">
                    <i class="fas fa-info-circle"></i>
                    <span>Gunakan scroll untuk melihat konten PDF</span>
                </div>
                <button onclick="closePdfModal()"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 transition-colors text-sm">
                    Tutup Preview
                </button>
            </div>
        </div>
    </div>

    <style>
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        /* Optimized spacing - reduced margins */
        .space-y-6>*+* {
            margin-top: 1rem;
        }

        .space-y-4>*+* {
            margin-top: 0.75rem;
        }

        /* Smooth animations */
        * {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }

        /* PDF Modal Animation */
        #pdfModal {
            transition: opacity 0.3s ease;
        }

        #pdfModal:not(.hidden) {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .p-6 {
                padding: 1rem;
            }

            .text-2xl {
                font-size: 1.5rem;
            }

            .grid-cols-2 {
                grid-template-columns: 1fr;
            }
        }

        /* Custom scrollbar for better UX */
        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #A4B465, #8AA24F);
            border-radius: 10px;
        }

        /* Ensure containers align perfectly */
        .xl\:col-span-2 .space-y-6 {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .xl\:col-span-2 .space-y-6>* {
            flex: 1;
        }
    </style>

    <script>
        function openPdfModal(pdfUrl) {
            const modal = document.getElementById('pdfModal');
            const pdfViewer = document.getElementById('pdfViewer');

            pdfViewer.src = pdfUrl;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePdfModal() {
            const modal = document.getElementById('pdfModal');
            const pdfViewer = document.getElementById('pdfViewer');

            modal.classList.add('hidden');
            pdfViewer.src = '';
            document.body.style.overflow = 'auto';
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePdfModal();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Delete confirmation with enhanced dialog
            document.querySelectorAll('.delete-permanent-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const bookTitle = this.getAttribute('data-title');
                    const form = this.closest('form');

                    const confirmed = confirm(
                        `Hapus permanen buku "${bookTitle}"?\n\n⚠️ Tindakan ini tidak dapat dibatalkan dan data akan hilang selamanya!`
                    );

                    if (confirmed) {
                        form.submit();
                    }
                });
            });

            // Add loading state to buttons
            const buttons = document.querySelectorAll('button, a[href]');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    if (this.classList.contains('delete-permanent-btn') || this.onclick) return;

                    const originalText = this.innerHTML;
                    this.innerHTML = `
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    <span>Memproses...</span>
                </div>
            `;
                    this.disabled = true;

                    // Reset after 3 seconds if still processing
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }, 3000);
                });
            });
        });
    </script>

    <?php $__env->startPush('styles'); ?>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_arsip/show.blade.php ENDPATH**/ ?>