<?php $__env->startSection('pageTitle', 'Edit Data Buku'); ?>
<?php $__env->startSection('content'); ?>

<!-- PDF.js Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    // Set worker path for PDF.js
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
</script>

<style>
    :root {
        --primary: #A4B465;
        --primary-dark: #8a9a58;
        --primary-light: #f0f4e4;
        --primary-50: #f7faf7;
        --primary-100: #e8f3e8;
    }
    
    .back-link {
        color: var(--primary);
        font-weight: 500;
        transition: all 0.3s ease;
        padding: 8px 16px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .back-link:hover {
        background-color: var(--primary-light);
        color: var(--primary-dark);
    }
    
    .page-title {
        color: #1f2937;
        font-size: 1.875rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .page-subtitle {
        color: #6b7280;
        font-size: 1.125rem;
        text-align: center;
    }
    
    .section-divider {
        padding-bottom: 12px;
        border-bottom: 2px solid var(--primary-light);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.5rem;
    }
    
    .form-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    
    .form-input {
        border: 1.5px solid #d1d5db;
        background-color: #f9fafb;
        transition: all 0.3s ease;
        color: #374151;
        width: 100%;
        border-radius: 8px;
        padding: 12px 16px;
    }
    
    .form-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(164, 180, 101, 0.2);
        background-color: white;
        outline: none;
    }
    
    .file-upload-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }
    
    .file-upload-card {
        background: white;
        border: 2px dashed var(--primary);
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .file-upload-card:hover {
        border-color: var(--primary-dark);
        background-color: var(--primary-50);
        transform: translateY(-2px);
    }
    
    .file-upload-icon {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 12px;
    }
    
    .file-upload-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        margin-top: 12px;
    }
    
    .file-upload-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }
    
    .preview-container {
        margin-top: 16px;
        text-align: center;
    }
    
    .current-file {
        background: var(--primary-50);
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 12px;
    }
    
    .current-file-label {
        font-size: 0.875rem;
        color: var(--primary-dark);
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .preview-image {
        max-width: 120px;
        max-height: 160px;
        border-radius: 8px;
        object-fit: cover;
        margin: 0 auto;
        border: 2px solid var(--primary-light);
    }
    
    .pdf-preview {
        background: var(--primary-light);
        padding: 16px;
        border-radius: 8px;
        margin: 8px 0;
        position: relative;
    }
    
    .pdf-thumbnail {
        max-width: 120px;
        max-height: 160px;
        border-radius: 6px;
        border: 2px solid var(--primary);
        background: white;
        margin: 0 auto;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .pdf-icon {
        font-size: 2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    
    .pdf-info {
        margin-top: 8px;
    }
    
    .pdf-link {
        color: var(--primary-dark);
        text-decoration: underline;
        font-size: 0.875rem;
        margin-top: 4px;
        display: inline-block;
    }
    
    .btn-primary {
        background: var(--primary);
        color: white;
        font-weight: 600;
        padding: 12px 32px;
        border-radius: 8px;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }
    
    .btn-secondary {
        background: white;
        color: #6b7280;
        font-weight: 600;
        padding: 12px 32px;
        border-radius: 8px;
        transition: all 0.3s ease;
        border: 1.5px solid #d1d5db;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-secondary:hover {
        background: #f9fafb;
        color: #374151;
        border-color: #9ca3af;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }
    
    .form-group {
        margin-bottom: 0;
    }
    
    .loading-pdf {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: var(--primary-dark);
        font-size: 0.875rem;
    }
    
    @media (max-width: 768px) {
        .file-upload-section {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .section-divider {
            font-size: 1.25rem;
        }
        
        .file-upload-card {
            padding: 16px;
        }
    }
    
    @media (max-width: 480px) {
        .btn-primary,
        .btn-secondary {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        
        <!-- Page Header -->
        <div class="mb-8">
            <a href="<?php echo e(route('admin.data_buku.index')); ?>" class="back-link">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Daftar Buku</span>
            </a>
            
            <div class="text-center mt-6">
                <h1 class="page-title">
                    <i class="fas fa-edit" style="color: #A4B465;"></i>
                    <span>Edit Data Buku</span>
                </h1>
                <p class="page-subtitle mt-2">Perbarui informasi buku di perpustakaan digital</p>
            </div>
        </div>

        <!-- Form -->
        <form action="<?php echo e(route('admin.data_buku.update', $buku->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Upload Section - Dua kolom sejajar -->
            <div class="mb-8">
                <h2 class="section-divider">
                    <i class="fas fa-cloud-upload-alt" style="color: #A4B465;"></i>
                    <span>Upload File Buku</span>
                </h2>
                
                <div class="file-upload-section">
                    <!-- Foto Buku -->
                    <div class="file-upload-card">
                        <div class="file-upload-icon">
                            <i class="fas fa-image"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2">Foto Cover Buku</h3>
                        <p class="text-sm text-gray-600 mb-4">Format: JPG, PNG, JPEG</p>
                        
                        <!-- Preview Foto Saat Ini -->
                        <?php if($buku->foto_buku): ?>
                        <div class="preview-container">
                            <div class="current-file">
                                <div class="current-file-label">Foto Saat Ini:</div>
                                <img src="<?php echo e(asset($buku->foto_buku)); ?>" alt="Foto Buku Saat Ini" class="preview-image">
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <input type="file" id="foto_buku" name="foto_buku" accept="image/*" class="hidden">
                        <label for="foto_buku" class="file-upload-btn">
                            <i class="fas fa-camera"></i>
                            <span><?php echo e($buku->foto_buku ? 'Ganti Foto' : 'Pilih Foto'); ?></span>
                        </label>
                        
                        <div id="imagePreviewContainer" class="preview-container hidden">
                            <div class="current-file">
                                <div class="current-file-label">Preview Foto Baru:</div>
                                <img id="imagePreview" class="preview-image" alt="Preview Cover">
                            </div>
                        </div>
                    </div>

                    <!-- File Buku PDF -->
                    <div class="file-upload-card">
                        <div class="file-upload-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2">File Buku (PDF)</h3>
                        <p class="text-sm text-gray-600 mb-4">Format: PDF, maksimal 10MB</p>
                        
                        <!-- Preview File Saat Ini -->
                        <?php if($buku->file_buku): ?>
                        <div class="preview-container">
                            <div class="current-file">
                                <div class="current-file-label">File Saat Ini:</div>
                                <div class="pdf-preview">
                                    <div id="currentPdfThumbnail" class="pdf-thumbnail-container">
                                        <div class="loading-pdf">
                                            <i class="fas fa-spinner fa-spin"></i>
                                            <span>Loading thumbnail...</span>
                                        </div>
                                    </div>
                                    <div class="pdf-info">
                                        <p class="text-sm font-medium text-primary-dark">File PDF tersedia</p>
                                        <a href="<?php echo e(asset($buku->file_buku)); ?>" target="_blank" 
                                           class="pdf-link">Lihat file lengkap</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <input type="file" id="file_buku" name="file_buku" accept=".pdf" class="hidden">
                        <label for="file_buku" class="file-upload-btn">
                            <i class="fas fa-file-upload"></i>
                            <span><?php echo e($buku->file_buku ? 'Ganti File' : 'Pilih File'); ?></span>
                        </label>

                        <!-- Preview PDF Baru -->
                        <div id="pdfPreviewContainer" class="preview-container hidden">
                            <div class="current-file">
                                <div class="current-file-label">Preview File Baru:</div>
                                <div class="pdf-preview">
                                    <canvas id="pdfPreview" class="pdf-thumbnail"></canvas>
                                    <div class="pdf-info">
                                        <p id="pdfName" class="text-sm font-medium text-primary-dark"></p>
                                        <p id="pdfSize" class="text-xs text-primary-dark mt-1"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Buku -->
            <div class="mb-8">
                <h2 class="section-divider">
                    <i class="fas fa-info-circle" style="color: #A4B465;"></i>
                    <span>Informasi Buku</span>
                </h2>
                
                <div class="form-grid">
                    <!-- Judul Buku -->
                    <div class="form-group">
                        <label for="judul_buku" class="form-label">
                            <i class="fas fa-heading" style="color: #A4B465;"></i>
                            <span>Judul Buku</span>
                        </label>
                        <input type="text" id="judul_buku" name="judul_buku" 
                               value="<?php echo e(old('judul_buku', $buku->judul_buku)); ?>"
                               placeholder="Masukkan judul buku"
                               class="form-input" required>
                    </div>

                    <!-- Penulis -->
                    <div class="form-group">
                        <label for="penulis" class="form-label">
                            <i class="fas fa-user-edit" style="color: #A4B465;"></i>
                            <span>Penulis</span>
                        </label>
                        <input type="text" id="penulis" name="penulis" 
                               value="<?php echo e(old('penulis', $buku->penulis)); ?>"
                               placeholder="Masukkan nama penulis"
                               class="form-input" required>
                    </div>

                    <!-- Penerbit -->
                    <div class="form-group">
                        <label for="penerbit" class="form-label">
                            <i class="fas fa-building" style="color: #A4B465;"></i>
                            <span>Penerbit</span>
                        </label>
                        <input type="text" id="penerbit" name="penerbit" 
                               value="<?php echo e(old('penerbit', $buku->penerbit)); ?>"
                               placeholder="Masukkan nama penerbit"
                               class="form-input" required>
                    </div>

                    <!-- Tahun Terbit -->
                    <div class="form-group">
                        <label for="tahun_terbit" class="form-label">
                            <i class="fas fa-calendar-alt" style="color: #A4B465;"></i>
                            <span>Tahun Terbit</span>
                        </label>
                        <input type="number" id="tahun_terbit" name="tahun_terbit" 
                               value="<?php echo e(old('tahun_terbit', $buku->tahun_terbit)); ?>"
                               placeholder="Contoh: 2024" 
                               class="form-input" required>
                    </div>

                    <!-- Bahasa -->
                    <div class="form-group">
                        <label for="bahasa" class="form-label">
                            <i class="fas fa-language" style="color: #A4B465;"></i>
                            <span>Bahasa</span>
                        </label>
                        <input type="text" id="bahasa" name="bahasa" 
                               value="<?php echo e(old('bahasa', $buku->bahasa)); ?>"
                               placeholder="Contoh: Indonesia"
                               class="form-input" required>
                    </div>

                    <!-- Kategori -->
                    <div class="form-group">
                        <label for="kategori_id" class="form-label">
                            <i class="fas fa-tags" style="color: #A4B465;"></i>
                            <span>Kategori</span>
                        </label>
                        <select name="kategori_id[]" id="kategori_id" multiple class="form-input" required>
                            <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kategori->id); ?>"
                                    <?php echo e(in_array($kategori->id, old('kategori_id', $buku->kategoris->pluck('id')->toArray())) ? 'selected' : ''); ?>>
                                    <?php echo e($kategori->nama_kategori); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <small class="text-gray-600 text-xs mt-2 block">
                            <i class="fas fa-info-circle mr-1"></i>
                            Tekan Ctrl (Windows) atau Cmd (Mac) untuk pilih lebih dari satu
                        </small>
                    </div>
                </div>
            </div>

            <!-- Detail Publikasi -->
            <div class="mb-8">
                <h2 class="section-divider">
                    <i class="fas fa-book-open" style="color: #A4B465;"></i>
                    <span>Detail Publikasi</span>
                </h2>
                
                <div class="form-grid">
                    <!-- Jumlah Halaman -->
                    <div class="form-group">
                        <label for="jumlah_halaman" class="form-label">
                            <i class="fas fa-file-alt" style="color: #A4B465;"></i>
                            <span>Jumlah Halaman</span>
                        </label>
                        <input type="number" id="jumlah_halaman" name="jumlah_halaman" 
                               value="<?php echo e(old('jumlah_halaman', $buku->jumlah_halaman)); ?>"
                               placeholder="0"
                               class="form-input" required>
                    </div>

                    <!-- Edisi -->
                    <div class="form-group">
                        <label for="edisi" class="form-label">
                            <i class="fas fa-bookmark" style="color: #A4B465;"></i>
                            <span>Edisi</span>
                        </label>
                        <input type="text" id="edisi" name="edisi" 
                               value="<?php echo e(old('edisi', $buku->edisi)); ?>"
                               placeholder="Contoh: Edisi 1"
                               class="form-input" required>
                    </div>

                    <!-- Stok -->
                    <div class="form-group">
                        <label for="stok" class="form-label">
                            <i class="fas fa-boxes" style="color: #A4B465;"></i>
                            <span>Stok Tersedia</span>
                        </label>
                        <input type="number" id="stok" name="stok" 
                               value="<?php echo e(old('stok', $buku->stok)); ?>"
                               placeholder="0"
                               class="form-input" required>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-8">
                <h2 class="section-divider">
                    <i class="fas fa-align-left" style="color: #A4B465;"></i>
                    <span>Deskripsi Buku</span>
                </h2>
                
                <div class="form-group">
                    <label for="deskripsi" class="form-label">
                        <i class="fas fa-paragraph" style="color: #A4B465;"></i>
                        <span>Deskripsi Lengkap</span>
                    </label>
                    <textarea id="deskripsi" name="deskripsi" rows="6" 
                              placeholder="Tuliskan deskripsi lengkap mengenai buku, sinopsis, atau ringkasan isi buku..."
                              class="form-input resize-none" required><?php echo e(old('deskripsi', $buku->deskripsi)); ?></textarea>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg p-6 border border-gray-200">
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="<?php echo e(route('admin.data_buku.index')); ?>" class="btn-secondary">
                        <i class="fas fa-times"></i>
                        <span>Batal</span>
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i>
                        <span>Perbarui Buku</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Image Preview Function
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('hidden');
        }
    }

    // PDF Preview Function for new file
    function previewPDF(event) {
        const input = event.target;
        const previewContainer = document.getElementById('pdfPreviewContainer');
        const pdfName = document.getElementById('pdfName');
        const pdfSize = document.getElementById('pdfSize');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            pdfName.textContent = file.name;
            
            // Format file size
            const fileSize = file.size;
            const sizeInKB = (fileSize / 1024).toFixed(2);
            const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
            pdfSize.textContent = fileSize > 1024 * 1024 ? 
                `${sizeInMB} MB` : `${sizeInKB} KB`;
            
            previewContainer.classList.remove('hidden');
            
            // Load PDF for preview (first page only)
            const fileReader = new FileReader();
            fileReader.onload = function() {
                const typedarray = new Uint8Array(this.result);
                
                // Set up PDF.js
                pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
                    // Get the first page
                    pdf.getPage(1).then(function(page) {
                        const scale = 1.2;
                        const viewport = page.getViewport({ scale: scale });
                        
                        // Prepare canvas for rendering
                        const canvas = document.getElementById('pdfPreview');
                        const context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        
                        // Render PDF page
                        const renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        page.render(renderContext);
                    });
                });
            };
            fileReader.readAsArrayBuffer(file);
        } else {
            previewContainer.classList.add('hidden');
        }
    }

    // Generate thumbnail for current PDF file
    function generateCurrentPdfThumbnail() {
        const pdfUrl = "<?php echo e(asset($buku->file_buku)); ?>";
        const container = document.getElementById('currentPdfThumbnail');
        
        if (!pdfUrl || pdfUrl === "<?php echo e(asset('')); ?>") return;
        
        // Set up PDF.js
        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
            // Get the first page
            pdf.getPage(1).then(function(page) {
                const scale = 1.2;
                const viewport = page.getViewport({ scale: scale });
                
                // Create canvas for rendering
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                canvas.className = 'pdf-thumbnail';
                
                // Clear loading message and add canvas
                container.innerHTML = '';
                container.appendChild(canvas);
                
                // Render PDF page
                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext);
            });
        }).catch(function(error) {
            console.error('Error generating PDF thumbnail:', error);
            container.innerHTML = `
                <div class="pdf-preview">
                    <i class="fas fa-file-pdf pdf-icon"></i>
                    <p class="text-sm font-medium text-primary-dark">Thumbnail tidak dapat dimuat</p>
                </div>
            `;
        });
    }

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listeners
        document.getElementById('foto_buku').addEventListener('change', previewImage);
        document.getElementById('file_buku').addEventListener('change', previewPDF);
        
        // Generate thumbnail for current PDF
        <?php if($buku->file_buku): ?>
            generateCurrentPdfThumbnail();
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/admin/data_buku/edit.blade.php ENDPATH**/ ?>