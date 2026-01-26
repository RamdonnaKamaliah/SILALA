@extends('layout_admin.admin')
@section('pageTitle', 'Tambah Buku')
@section('content')

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Form - HANYA SATU FORM TAG -->
            <form action="{{ route('admin.data_buku.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Foto Buku -->
                <div>
                    <label for="foto_buku" class="block text-gray-700 font-semibold mb-2">Foto Buku</label>

                    <!-- Upload manual -->
                    <input type="file" id="foto_buku" name="foto_buku"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 
                    focus:outline-none focus:ring-2 focus:ring-[#A4B465] transition duration-200">
                    @error('foto_buku')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                    {{-- GAMBAR BUKU (PICK FROM MEDIA) --}}
                    <div class="mb-4">
                        <label class="block font-medium">Gambar Buku</label>

                        <div class="flex items-center gap-4">
                            <img id="previewImage" class="w-24 h-24 object-cover rounded border"
                                src="{{ old('foto_url', 'https://placehold.co/100x100?text=No+Image') }}">

                            <button type="button" id="openModalBtn"
                                class="px-4 py-2 bg-indigo-600 text-white rounded">Pilih dari Media</button>
                        </div>

                        <input type="hidden" name="foto_id" id="foto_id" value="{{ old('foto_id') }}">
                    </div>
                </div>

                <!-- Upload Section -->
                <div data-aos="fade-up" data-aos-duration="800">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                        <div>
                            <div id="imagePreviewContainer" class="preview-box mt-4 hidden">
                                <img id="imagePreview" class="preview-image" alt="Preview Cover">
                                <p id="imageName" class="text-xs font-medium text-primary-dark break-all px-2 line-clamp-2">
                                </p>
                            </div>
                        </div>

                        <!-- File Buku PDF -->
                    <div>
                        <label class="form-label">
                            <i class="fas fa-file-pdf text-primary"></i>
                            <span>File Buku (PDF)</span>
                        </label>

                        <input type="file" id="file_buku" name="file_buku" accept=".pdf" onchange="previewPDF(event)"
                            class="hidden"> @error('file_buku')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        <label for="file_buku" class="file-upload-btn">
                            <i class="fas fa-file-upload"></i>
                            <span>Pilih File PDF</span>
                        </label>

                        <div id="pdfPreviewContainer" class="preview-box mt-4 hidden flex flex-col items-center gap-1">
    <canvas id="pdfPreview" class="border rounded-md" style="width: 120px; height: 160px;"></canvas>
    <div class="text-center">
        <p id="pdfName" class="text-[11px] font-medium text-primary-dark break-all max-w-[80px]"></p>
        <p id="pdfSize" class="text-[10px] text-primary-medium mt-0.5"></p>
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
                                class="form-input w-full rounded-lg px-4 py-3 @error('judul_buku')
                                border-red-500
                            @enderror"
                                value="{{ old('judul_buku') }}">
                            @error('judul_buku')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Penulis -->
                        <div>
                            <label for="penulis" class="form-label">
                                <i class="fas fa-user-edit text-primary"></i>
                                <span>Penulis</span>
                            </label>
                            <input type="text" id="penulis" name="penulis" placeholder="Masukkan nama penulis"
                                class="form-input w-full rounded-lg px-4 py-3 @error('penulis')
                                border-red-500
                            @enderror"
                                value="{{ old('penulis') }}">
                            @error('penulis')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Penerbit -->
                        <div>
                            <label for="penerbit" class="form-label">
                                <i class="fas fa-building text-primary"></i>
                                <span>Penerbit</span>
                            </label>
                            <input type="text" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit"
                                class="form-input w-full rounded-lg px-4 py-3 @error('penerbit')
                                border-red-500
                            @enderror"
                                value="{{ old('penerbit') }}">
                            @error('penerbit')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tahun Terbit -->
                        <div>
                            <label for="tahun_terbit" class="form-label">
                                <i class="fas fa-calendar-alt text-primary"></i>
                                <span>Tahun Terbit</span>
                            </label>
                            <input type="number" id="tahun_terbit" name="tahun_terbit" placeholder="Contoh: 2024"
                                class="form-input w-full rounded-lg px-4 py-3 @error('tahun_terbit')
                                border-red-500
                            @enderror"
                                value="{{ old('tahun_terbit') }}">
                            @error('tahun_terbit')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bahasa -->
                        <div>
                            <label for="bahasa" class="form-label">
                                <i class="fas fa-language text-primary"></i>
                                <span>Bahasa</span>
                            </label>
                            <input type="text" id="bahasa" name="bahasa" placeholder="Contoh: Indonesia"
                                class="form-input w-full rounded-lg px-4 py-3 @error('bahasa')
                                border-red-500
                            @enderror"
                                value="{{ old('bahasa') }}">
                            @error('bahasa')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori_id" class="form-label">
                                <i class="fas fa-tags text-primary"></i>
                                <span>Kategori</span>
                            </label>
                            <select name="kategori_id[]" id="kategori_id" multiple
                                class="form-input w-full rounded-lg px-4 py-3">
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
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
                                class="form-input w-full rounded-lg px-4 py-3 @error('jumlah_halaman')
                                border-red-500
                            @enderror"
                                value="{{ old('jumlah_halaman') }}">
                            @error('jumlah_halaman')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Edisi -->
                        <div>
                            <label for="edisi" class="form-label">
                                <i class="fas fa-bookmark text-primary"></i>
                                <span>Edisi</span>
                            </label>
                            <input type="text" id="edisi" name="edisi" placeholder="Contoh: Edisi 1"
                                class="form-input w-full rounded-lg px-4 py-3 @error('edisi')
                                border-red-500
                            @enderror"
                                value="{{ old('edisi') }}">
                            @error('edisi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stok -->
                        <div>
                            <label for="stok" class="form-label">
                                <i class="fas fa-boxes text-primary"></i>
                                <span>Stok Tersedia</span>
                            </label>
                            <input type="number" id="stok" name="stok" placeholder="0"
                                class="form-input w-full rounded-lg px-4 py-3 @error('stok')
                                border-red-500
                            @enderror"
                                value="{{ old('stok') }}">
                            @error('stok')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
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
                            class="form-input w-full rounded-lg px-4 py-3 resize-none @error('deskripsi')
                            border-red-500
                        @enderror">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white rounded-lg p-6 shadow-md" data-aos="fade-up" data-aos-duration="800"
                    data-aos-delay="400">
                    <div class="flex flex-col sm:flex-row gap-4 justify-end">
                        <a href="{{ route('admin.data_buku.index') }}"
                            class="btn-secondary text-center inline-flex items-center justify-center gap-2 min-w-[150px]">
                            <i class="fas fa-times"></i>
                            <span>Batal</span>
                        </a>
                        <button type="submit"
                            class="btn-primary inline-flex items-center justify-center gap-2 min-w-[150px]">
                            <i class="fas fa-save"></i>
                            <span>Simpan Buku</span>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    {{-- ================= MODAL PILIH GAMBAR ================= --}}
    <div id="modalGambar" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg w-10/12 md:w-6/12 p-6 shadow-lg">

            <h2 class="text-lg font-semibold mb-4">Pilih Gambar</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-h-80 overflow-y-auto">

                @foreach ($media as $g)
                    <div class="cursor-pointer border rounded p-1 hover:border-indigo-600 transition"
                        onclick="pilihGambar('{{ $g->id }}', '{{ asset('storage/' . $g->path_file) }}')">

                        <img src="{{ asset('storage/' . $g->path_file) }}" class="w-full h-32 object-cover rounded">
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

@endsection
