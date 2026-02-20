@extends('layout_admin.admin')
@section('pageTitle', 'Edit Data Kategori')
@section('content')

<div class="p-4 md:p-6 overflow-x-auto">
    <!-- Header Section -->
    <div class="text-left mb-6 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center space-x-4">
            <div class="bg-white/20 p-3 rounded-full">
                <i class="fas fa-edit text-2xl"></i>
            </div>
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold mb-1 text-white">Edit Data Kategori</h1>
                <p class="text-white/90 text-sm">Memperbarui kategori: <strong>{{ $kategori->nama_kategori }}</strong></p>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <!-- Form Header -->
        <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-green-50/30 px-6 py-3">
            <div class="flex items-center space-x-2">
                <div class="w-2 h-2 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-full"></div>
                <h2 class="text-base font-semibold text-gray-800">Informasi Kategori</h2>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-6">
            <!-- Alert Messages -->
            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-3 flex items-start space-x-2">
                    <div class="flex-shrink-0 w-4 h-4 bg-red-100 rounded-full flex items-center justify-center mt-0.5">
                        <i class="fas fa-exclamation-circle text-red-500 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-red-700 font-medium text-xs">Terjadi Kesalahan</p>
                        <p class="text-red-600 text-xs mt-0.5">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-3 flex items-start space-x-2">
                    <div class="flex-shrink-0 w-4 h-4 bg-green-100 rounded-full flex items-center justify-center mt-0.5">
                        <i class="fas fa-check-circle text-green-500 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-green-700 font-medium text-xs">Sukses!</p>
                        <p class="text-green-600 text-xs mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.data_kategori.update', $kategori->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Nama Kategori Field -->
                <div class="space-y-2">
                    <label for="nama_kategori" class="block text-sm font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-tag text-[#A4B465] mr-2 text-xs"></i>
                        Nama Kategori
                        <span class="text-red-500 ml-1">*</span>
                    </label>
                    
                    <div class="relative">
                        <input type="text" 
                               id="nama_kategori" 
                               name="nama_kategori" 
                               value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                               placeholder="Contoh: Fiksi, Sains, Sejarah, dll."
                               class="w-full border border-gray-300 rounded-lg px-3 py-2.5 bg-white
                                      focus:outline-none focus:ring-2 focus:ring-[#A4B465] focus:border-transparent
                                      placeholder-gray-400 transition-all duration-200
                                      hover:border-gray-400 pr-10 text-sm"
                               required>
                        
                        <div class="absolute right-2.5 top-1/2 transform -translate-y-1/2">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-bookmark text-[#A4B465] text-xs"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <p class="text-xs text-gray-500 flex items-center">
                            <i class="fas fa-info-circle text-gray-400 mr-1 text-xs"></i>
                            Perbarui nama kategori sesuai kebutuhan
                        </p>
                        <div class="text-xs text-gray-500">
                            <span id="charCount">{{ strlen($kategori->nama_kategori) }}</span>/50 karakter
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mt-2">
                    <div class="flex items-start space-x-2">
                        <div class="flex-shrink-0 w-4 h-4 bg-blue-100 rounded-full flex items-center justify-center mt-0.5">
                            <i class="fas fa-history text-blue-500 text-xs"></i>
                        </div>
                        <div>
                            <h3 class="text-blue-800 font-semibold text-xs mb-0.5">Informasi Perubahan</h3>
                            <p class="text-blue-700 text-xs">
                                Kategori ini akan diperbarui di seluruh sistem. Pastikan perubahan nama konsisten dengan kategori lainnya.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.data_kategori.index') }}" 
                       class="w-full sm:w-auto flex items-center justify-center space-x-2 px-5 py-2.5 
                              border border-gray-300 text-gray-700 rounded-lg font-medium
                              hover:bg-gray-50 hover:border-gray-400 transition-all duration-200
                              hover:shadow-sm order-2 sm:order-1 text-sm">
                        <i class="fas fa-arrow-left text-xs"></i>
                        <span>Kembali</span>
                    </a>
                    
                    <div class="flex flex-col sm:flex-row gap-2 order-1 sm:order-2 w-full sm:w-auto">
                        <a href="{{ route('admin.data_kategori.show', $kategori->id) }}" 
                           class="w-full sm:w-auto flex items-center justify-center space-x-2 px-4 py-2.5
                                  border border-blue-300 text-blue-700 rounded-lg font-medium
                                  hover:bg-blue-50 hover:border-blue-400 transition-all duration-200
                                  hover:shadow-sm text-sm">
                            <i class="fas fa-eye text-xs"></i>
                            <span>Detail</span>
                        </a>
                        
                        <button type="submit" 
                                class="w-full sm:w-auto flex items-center justify-center space-x-2 px-5 py-2.5
                                       bg-gradient-to-r from-[#A4B465] to-[#8AA24F] text-white rounded-lg font-semibold
                                       hover:from-[#8AA24F] hover:to-[#75883f] transition-all duration-200
                                       shadow-md hover:shadow-lg transform hover:-translate-y-0.5
                                       text-sm">
                            <i class="fas fa-save text-xs"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tips Section -->
    <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
        <div class="flex items-start space-x-2">
            <div class="flex-shrink-0 w-4 h-4 bg-yellow-100 rounded-full flex items-center justify-center mt-0.5">
                <i class="fas fa-lightbulb text-yellow-500 text-xs"></i>
            </div>
            <div>
                <h3 class="text-yellow-800 font-semibold text-xs mb-1">Tips Edit Kategori</h3>
                <ul class="text-yellow-700 text-xs space-y-0.5">
                    <li class="flex items-start">
                        <span class="text-yellow-500 mr-1.5">•</span>
                        Pastikan nama baru tidak duplikat dengan kategori lain
                    </li>
                    <li class="flex items-start">
                        <span class="text-yellow-500 mr-1.5">•</span>
                        Perubahan akan mempengaruhi semua buku dalam kategori ini
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom animations */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.bg-white {
    animation: slideIn 0.3s ease-out;
}

/* Focus states improvement */
input:focus {
    box-shadow: 0 0 0 3px rgba(164, 180, 101, 0.1);
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .min-h-screen {
        padding: 0.75rem 0.5rem;
    }
    
    .max-w-2xl {
        max-width: 100%;
    }
    
    .p-5 {
        padding: 1rem;
    }
    
    .text-xl {
        font-size: 1.25rem;
    }
}

/* Compact spacing */
.space-y-4 > * + * {
    margin-top: 0.75rem;
}

.space-y-2 > * + * {
    margin-top: 0.25rem;
}

/* Form field compact design */
.rounded-lg {
    border-radius: 0.5rem;
}

.rounded-xl {
    border-radius: 0.75rem;
}

/* Button compact design */
.py-2\.5 {
    padding-top: 0.625rem;
    padding-bottom: 0.625rem;
}

/* Header compact design */
.p-5 {
    padding: 1.25rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const namaKategoriInput = document.getElementById('nama_kategori');
    const charCount = document.getElementById('charCount');
    
    // Auto-capitalize first letter
    namaKategoriInput.addEventListener('input', function(e) {
        if (e.target.value.length === 1) {
            e.target.value = e.target.value.charAt(0).toUpperCase() + e.target.value.slice(1);
        }
        
        // Update character counter
        charCount.textContent = this.value.length;
        
        if (this.value.length > 45) {
            charCount.classList.add('text-orange-500');
            charCount.classList.remove('text-gray-500');
        } else {
            charCount.classList.remove('text-orange-500');
            charCount.classList.add('text-gray-500');
        }
    });
    
    // Trigger initial count
    namaKategoriInput.dispatchEvent(new Event('input'));

    // Add confirmation for form submission
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const originalValue = "{{ $kategori->nama_kategori }}";
        const currentValue = namaKategoriInput.value;
        
        if (originalValue !== currentValue) {
            if (!confirm(`Anda yakin ingin mengubah kategori "${originalValue}" menjadi "${currentValue}"?`)) {
                e.preventDefault();
            }
        }
    });
});
</script>
@endsection