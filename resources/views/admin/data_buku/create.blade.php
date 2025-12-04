{{-- @extends('layout_admin.admin')
@section('pageTitle', 'Tambah Buku')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Tambah Buku Baru</h1>
            <p class="text-gray-600">Lengkapi informasi buku di bawah ini</p>
        </div>

        <form action="{{ route('admin.data_buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Upload Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Upload File</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Foto Cover -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Cover Buku *</label>
                        <input type="file" name="foto_buku" accept="image/*" class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                        
                        <!-- Pilih dari Galeri -->
                        <button type="button" class="mt-2 w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg px-3 py-2 text-sm hover:bg-gray-200 transition duration-200" 
                                data-bs-toggle="modal" data-bs-target="#pilihGambarModal">
                            📁 Pilih dari Galeri
                        </button>
                        
                        <input type="hidden" name="foto_id" id="selectedGambar">
                        <p class="mt-2 text-sm text-gray-600">Dipilih: <span id="selectedGambarNama" class="font-medium">-</span></p>
                        <p class="text-xs text-gray-500 mt-1">* Pilih salah satu: upload file baru atau pilih dari galeri</p>
                    </div>

                    <!-- File PDF -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">File Buku (PDF) *</label>
                        <input type="file" name="file_buku" accept=".pdf" class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                        <p class="text-xs text-gray-500 mt-1">Format: PDF, maksimal 10MB</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Buku -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Buku</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Buku *</label>
                        <input type="text" name="judul_buku" placeholder="Masukkan judul buku" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penulis *</label>
                        <input type="text" name="penulis" placeholder="Masukkan nama penulis" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit *</label>
                        <input type="text" name="penerbit" placeholder="Masukkan nama penerbit" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit *</label>
                        <input type="number" name="tahun_terbit" placeholder="Contoh: 2024" min="1900" max="2030"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bahasa *</label>
                        <input type="text" name="bahasa" placeholder="Contoh: Indonesia" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                        <select name="kategori_id[]" multiple 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <small class="text-gray-500 text-xs mt-1">⚠️ Tekan <kbd>Ctrl</kbd> (Windows) atau <kbd>Cmd</kbd> (Mac) untuk memilih lebih dari satu kategori</small>
                    </div>
                </div>
            </div>

            <!-- Detail Publikasi -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Detail Publikasi</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Halaman *</label>
                        <input type="number" name="jumlah_halaman" placeholder="0" min="1"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Edisi *</label>
                        <input type="text" name="edisi" placeholder="Contoh: Edisi 1" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stok Tersedia *</label>
                        <input type="number" name="stok" placeholder="0" min="0"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Deskripsi Buku</h2>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap *</label>
                    <textarea name="deskripsi" rows="5" 
                              placeholder="Tuliskan deskripsi lengkap mengenai buku, sinopsis, atau ringkasan isi buku..."
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 resize-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" required></textarea>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    <a href="{{ route('admin.data_buku.index') }}" 
                       class="px-6 py-3 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg text-center hover:bg-gray-200 transition duration-200 font-medium">
                        ❌ Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                        💾 Simpan Buku
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Galeri -->
<div class="modal fade" id="pilihGambarModal" tabindex="-1" aria-labelledby="pilihGambarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gray-50">
                <h5 class="modal-title font-semibold">Pilih Gambar dari Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                @if($media->count() > 0)
                    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                        @foreach ($media as $g)
                            <div class="cursor-pointer transform transition-transform hover:scale-105">
                                <img src="{{ Storage::url($g->path_file) }}" 
                                     class="w-full h-20 object-cover rounded border-2 border-transparent hover:border-blue-500"
                                     onclick="pilihGambar('{{ $g->id }}', '{{ $g->nama_file }}')"
                                     alt="{{ $g->nama_file }}"
                                     title="{{ $g->nama_file }}">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <p>❌ Tidak ada gambar di galeri</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer bg-gray-50">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    function pilihGambar(id, nama) {
        // Set nilai hidden input
        document.getElementById('selectedGambar').value = id;
        document.getElementById('selectedGambarNama').textContent = nama;
        
        // Reset file input foto_buku
        document.querySelector('input[name="foto_buku"]').value = '';
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('pilihGambarModal'));
        modal.hide();
        
        // Show success message
        alert('Gambar "' + nama + '" dipilih!');
    }

    // Reset galeri selection when file input changes
    document.querySelector('input[name="foto_buku"]').addEventListener('change', function() {
        if(this.files.length > 0) {
            document.getElementById('selectedGambar').value = '';
            document.getElementById('selectedGambarNama').textContent = '-';
        }
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const fotoBuku = document.querySelector('input[name="foto_buku"]');
        const fotoId = document.getElementById('selectedGambar');
        
        // Check if either foto_buku or foto_id is provided
        if (!fotoBuku.files[0] && !fotoId.value) {
            e.preventDefault();
            alert('❌ Harus memilih foto cover buku!');
            return false;
        }
        
        // Check if PDF file is provided
        const fileBuku = document.querySelector('input[name="file_buku"]');
        if (!fileBuku.files[0]) {
            e.preventDefault();
            alert('❌ Harus memilih file PDF buku!');
            return false;
        }
        
        // Validate PDF file type
        if (fileBuku.files[0] && !fileBuku.files[0].name.toLowerCase().endsWith('.pdf')) {
            e.preventDefault();
            alert('❌ File buku harus berformat PDF!');
            return false;
        }
        
        // Show loading or confirmation
        if(confirm('Apakah Anda yakin ingin menyimpan data buku?')) {
            // Form will submit
            return true;
        } else {
            e.preventDefault();
            return false;
        }
    });

    // Initialize AOS
    AOS.init({
        once: true,
        duration: 600
    });
</script>

@endsection --}}




























@extends('layout_admin.admin')
@section('pageTitle', 'Tambah Buku')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<link rel="stylesheet" href="{{ asset('/assets_admin/css/create-databuku.css') }}">

<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Tambah Buku Baru</h1>
            <p class="text-gray-600">Lengkapi informasi buku di bawah ini</p>
        </div>

        <form action="{{ route('admin.data_buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Upload Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Upload File</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Foto Cover -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Cover Buku</label>
                        <input type="file" name="foto_buku" accept="image/*" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        
                        <!-- Pilih dari Galeri -->
                        <button type="button" class="mt-2 w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg px-3 py-2 text-sm" 
                                data-bs-toggle="modal" data-bs-target="#pilihGambarModal">
                            Pilih dari Galeri
                        </button>
                        
                        <input type="hidden" name="foto_id" id="selectedGambar">
                        <p class="mt-2 text-sm text-gray-600">Dipilih: <span id="selectedGambarNama">-</span></p>
                    </div>

                    <!-- File PDF -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">File Buku (PDF)</label>
                        <input type="file" name="file_buku" accept=".pdf" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                    </div>
                </div>
            </div>

            <!-- Informasi Buku -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Buku</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Buku</label>
                        <input type="text" name="judul_buku" placeholder="Masukkan judul buku" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                        <input type="text" name="penulis" placeholder="Masukkan nama penulis" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
                        <input type="text" name="penerbit" placeholder="Masukkan nama penerbit" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" placeholder="Contoh: 2024" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bahasa</label>
                        <input type="text" name="bahasa" placeholder="Contoh: Indonesia" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="kategori_id[]" multiple class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <small class="text-gray-500 text-xs mt-1">Tekan Ctrl (Windows) atau Cmd (Mac) untuk memilih lebih dari satu</small>
                    </div>
                </div>
            </div>

            <!-- Detail Publikasi -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Detail Publikasi</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Halaman</label>
                        <input type="number" name="jumlah_halaman" placeholder="0" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Edisi</label>
                        <input type="text" name="edisi" placeholder="Contoh: Edisi 1" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stok Tersedia</label>
                        <input type="number" name="stok" placeholder="0" 
                               class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Deskripsi Buku</h2>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap</label>
                    <textarea name="deskripsi" rows="4" 
                              placeholder="Tuliskan deskripsi lengkap mengenai buku, sinopsis, atau ringkasan isi buku..."
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 resize-none" required></textarea>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    <a href="{{ route('admin.data_buku.index') }}" 
                       class="px-6 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg text-center">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Simpan Buku
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Galeri -->
<div class="modal fade" id="pilihGambarModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Gambar dari Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="grid grid-cols-3 md:grid-cols-4 gap-3">
                    @foreach ($media as $g)
                        <img src="{{ Storage::url($g->path_file) }}" 
                             class="w-full h-24 object-cover rounded border cursor-pointer hover:border-blue-500"
                             onclick="pilihGambar('{{ $g->id }}', '{{ $g->nama_file }}')">
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    function pilihGambar(id, nama) {
        document.getElementById('selectedGambar').value = id;
        document.getElementById('selectedGambarNama').textContent = nama;
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('pilihGambarModal'));
        modal.hide();
    }

    // Initialize AOS
    AOS.init({
        once: true
    });
</script>

@endsection