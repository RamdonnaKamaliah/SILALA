@extends('layout_admin.admin')
@section('pageTitle', 'Tambah Buku')
@section('content')

    <!-- AOS CSS -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" /> --}}
    <link rel="stylesheet" href="{{ asset('/assets_admin/css/create-databuku.css') }}">

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Page Header -->
            <div class="mb-8" data-aos="fade-down" data-aos-duration="800">
                <a href="{{ route('admin.data_buku.index') }}" class="back-link inline-flex items-center mb-4">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Kembali ke Daftar Buku</span>
                </a>
                <div class="text-center">
                    <h1 class="page-title flex items-center justify-center gap-3 sm:gap-4 mb-3 flex-wrap">
                        <i class="fas fa-book-medical text-primary"></i>
                        <span>Tambah Buku Baru</span>
                    </h1>
                    <p class="page-subtitle px-4">Lengkapi formulir di bawah untuk menambahkan buku ke perpustakaan digital
                    </p>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.data_buku.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf


                <!-- Upload Section -->
                <div data-aos="fade-up" data-aos-duration="800">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 flex items-center gap-3 section-divider">
                        <i class="fas fa-cloud-upload-alt text-primary"></i>
                        <span>Upload File Buku</span>
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                        <!-- Foto Buku -->
                        <div>
                            <label class="form-label">
                                <i class="fas fa-image text-primary"></i>
                                <span>Foto Cover Buku</span>
                            </label>

                            <input type="file" id="foto_buku" name="foto_buku" accept="image/*"
                                onchange="previewImage(event)" class="hidden">
                            <label for="foto_buku" class="file-upload-btn">
                                <i class="fas fa-camera"></i>
                                <span>Pilih Foto Cover</span>
                            </label>

                            {{-- GAMBAR BUKU (PICK FROM MEDIA) --}}
                            <div class="mb-4">
                                <label class="block font-medium">Gambar Buku</label>

                                <div class="flex items-center gap-4">
                                    <img id="previewImage" class="w-24 h-24 object-cover rounded border"
                                        src="https://placehold.co/100x100?text=No+Image">

                                    <button type="button" id="openModalBtn"
                                        class="px-4 py-2 bg-indigo-600 text-white rounded">Pilih dari Media</button>
                                </div>

                                {{-- input hidden untuk simpan path_file --}}
                                <input type="hidden" name="gambar_buku" id="gambar_buku">
                            </div>

                        </div>
                    </div>

                    {{-- ================= MODAL PILIH GAMBAR ================= --}}
                    <div id="modalGambar"
                        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                        <div class="bg-white rounded-lg w-10/12 md:w-6/12 p-6 shadow-lg">

                            <h2 class="text-lg font-semibold mb-4">Pilih Gambar</h2>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-h-80 overflow-y-auto">

                                @foreach ($media as $g)
                                    <div class="cursor-pointer border rounded p-1 hover:border-indigo-600 transition"
                                        onclick="pilihGambar('{{ $g->path_file }}', '{{ asset('storage/' . $g->path_file) }}')">

                                        <img src="{{ asset('storage/' . $g->path_file) }}"
                                            class="w-full h-32 object-cover rounded">
                                    </div>
                                @endforeach

                            </div>

                            <div class="mt-5 text-right">
                                <button id="closeModalBtn" class="px-4 py-2 bg-gray-300 rounded">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>



                    <!-- File Buku PDF -->
                    <div>
                        <label class="form-label">
                            <i class="fas fa-file-pdf text-primary"></i>
                            <span>File Buku (PDF)</span>
                        </label>

                        <input type="file" id="file_buku" name="file_buku" accept=".pdf" onchange="previewPDF(event)"
                            class="hidden">
                        <label for="file_buku" class="file-upload-btn">
                            <i class="fas fa-file-upload"></i>
                            <span>Pilih File PDF</span>
                        </label>

                        <div id="pdfPreviewContainer" class="preview-box mt-4 hidden">
                            <canvas id="pdfPreview" class="preview-pdf-canvas"></canvas>
                            <div class="mt-2">
                                <p id="pdfName" class="text-xs font-medium text-primary-dark break-all px-2 line-clamp-1">
                                </p>
                                <p id="pdfSize" class="text-xs text-primary-medium mt-1"></p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Informasi Buku -->
        <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800 flex items-center gap-3 section-divider">
                <i class="fas fa-info-circle text-primary"></i>
                <span>Informasi Buku</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <!-- Judul Buku -->
                <div>
                    <label for="judul_buku" class="form-label">
                        <i class="fas fa-heading text-primary"></i>
                        <span>Judul Buku</span>
                    </label>
                    <input type="text" id="judul_buku" name="judul_buku" placeholder="Masukkan judul buku"
                        class="form-input w-full rounded-lg px-4 py-3" required>
                </div>

                <!-- Penulis -->
                <div>
                    <label for="penulis" class="form-label">
                        <i class="fas fa-user-edit text-primary"></i>
                        <span>Penulis</span>
                    </label>
                    <input type="text" id="penulis" name="penulis" placeholder="Masukkan nama penulis"
                        class="form-input w-full rounded-lg px-4 py-3" required>
                </div>

                <!-- Penerbit -->
                <div>
                    <label for="penerbit" class="form-label">
                        <i class="fas fa-building text-primary"></i>
                        <span>Penerbit</span>
                    </label>
                    <input type="text" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit"
                        class="form-input w-full rounded-lg px-4 py-3" required>
                </div>

                <!-- Tahun Terbit -->
                <div>
                    <label for="tahun_terbit" class="form-label">
                        <i class="fas fa-calendar-alt text-primary"></i>
                        <span>Tahun Terbit</span>
                    </label>
                    <input type="number" id="tahun_terbit" name="tahun_terbit" placeholder="Contoh: 2024"
                        class="form-input w-full rounded-lg px-4 py-3" required>

                </div>

                <!-- Bahasa -->
                <div>
                    <label for="bahasa" class="form-label">
                        <i class="fas fa-language text-primary"></i>
                        <span>Bahasa</span>
                    </label>
                    <input type="text" id="bahasa" name="bahasa" placeholder="Contoh: Indonesia"
                        class="form-input w-full rounded-lg px-4 py-3" required>
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori_id" class="form-label">
                        <i class="fas fa-tags text-primary"></i>
                        <span>Kategori</span>
                    </label>
                    <select name="kategori_id[]" id="kategori_id" multiple class="form-input w-full rounded-lg px-4 py-3"
                        required>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                    <small class="text-gray-600 text-xs mt-1 flex items-center gap-1">
                        <i class="fas fa-info-circle"></i>
                        <span>Tekan Ctrl (Windows) atau Cmd (Mac) untuk pilih lebih dari satu</span>
                    </small>
                </div>
            </div>
        </div>

        <!-- Detail Publikasi -->
        <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800 flex items-center gap-3 section-divider">
                <i class="fas fa-book-open text-primary"></i>
                <span>Detail Publikasi</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                <!-- Jumlah Halaman -->
                <div>
                    <label for="jumlah_halaman" class="form-label">
                        <i class="fas fa-file-alt text-primary"></i>
                        <span>Jumlah Halaman</span>
                    </label>
                    <input type="number" id="jumlah_halaman" name="jumlah_halaman" placeholder="0"
                        class="form-input w-full rounded-lg px-4 py-3" required>
                </div>

                <!-- Edisi -->
                <div>
                    <label for="edisi" class="form-label">
                        <i class="fas fa-bookmark text-primary"></i>
                        <span>Edisi</span>
                    </label>
                    <input type="text" id="edisi" name="edisi" placeholder="Contoh: Edisi 1"
                        class="form-input w-full rounded-lg px-4 py-3" required>
                </div>

                <!-- Stok -->
                <div>
                    <label for="stok" class="form-label">
                        <i class="fas fa-boxes text-primary"></i>
                        <span>Stok Tersedia</span>
                    </label>
                    <input type="number" id="stok" name="stok" placeholder="0"
                        class="form-input w-full rounded-lg px-4 py-3" required>
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800 flex items-center gap-3 section-divider">
                <i class="fas fa-align-left text-primary"></i>
                <span>Deskripsi Buku</span>
            </h2>

            <div>
                <label for="deskripsi" class="form-label">
                    <i class="fas fa-paragraph text-primary"></i>
                    <span>Deskripsi Lengkap</span>
                </label>
                <textarea id="deskripsi" name="deskripsi" rows="6"
                    placeholder="Tuliskan deskripsi lengkap mengenai buku, sinopsis, atau ringkasan isi buku..."
                    class="form-input w-full rounded-lg px-4 py-3 resize-none" required></textarea>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-white rounded-lg p-6 shadow-md" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('admin.data_buku.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-center inline-flex items-center justify-center gap-2 min-w-[150px] rounded-lg px-4 py-3">
                    <i class="fas fa-times"></i>
                    <span>Batal</span>
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold inline-flex items-center justify-center gap-2 min-w-[150px] rounded-lg px-4 py-3">
                    <i class="fas fa-save"></i>
                    <span>Simpan Buku</span>
                </button>
            </div>
        </div>
    </div>
    </div>
    </form>

    <!-- PDF.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="{{ asset('/assets_admin/js/create-databuku.js') }}"></script>
@endsection
