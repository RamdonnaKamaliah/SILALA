@extends('layout_admin.admin')
@section('pageTitle', 'Edit Profile Admin')

@section('content')

{{-- Sweet Alert CDN (Opsional, jika belum ada di layout) --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="min-h-screen bg-gradient-to-br from-[#F9FBF4] via-[#F2F6E9] to-[#E9F0D8]">
    
    <div class="h-full">
        
        {{-- HEADER SECTION - Compact --}}
        <div class="bg-gradient-to-r from-[#6E7C45] to-[#8C9E55] shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <h1 class="text-2xl md:text-3xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-user-circle"></i>
                    <span>Profil Saya</span>
                </h1>
                <p class="text-white/90 text-sm mt-1">Kelola informasi profil dan keamanan akun Anda</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                {{-- LEFT SIDEBAR - PROFILE CARD (Lebih compact) --}}
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-2xl shadow-xl border border-[#DDE6C5] overflow-hidden h-full">
                        
                        {{-- Header Card dengan Gradient --}}
                        <div class="bg-gradient-to-br from-[#A4B465] to-[#6E7C45] h-24 relative">
                            <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                                <div class="relative group">
                                    <div class="absolute inset-0 bg-white rounded-full blur-md opacity-50"></div>
                                    <img id="previewImage" 
                                         src="{{ $admin->foto ? asset('uploads/admin/'.$admin->foto) : asset('default.png') }}"
                                         class="relative w-32 h-32 rounded-full object-cover border-4 border-white shadow-xl ring-4 ring-[#A4B465]/30 bg-white">
                                    <div class="absolute inset-0 rounded-full bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <i class="fas fa-camera text-white text-2xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-20 pb-6 px-6 text-center">
                            <label class="inline-flex items-center gap-2 cursor-pointer bg-gradient-to-r from-[#A4B465] to-[#8C9E55] text-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 text-sm font-medium">
                                <i class="fas fa-camera"></i> 
                                <span>Ganti Foto</span>
                                <input type="file" id="fotoInput" name="foto" class="hidden" form="formProfile" accept="image/*">
                            </label>

                            <div class="mt-6 space-y-3">
                                <h3 class="text-xl font-bold text-[#6E7C45]">{{ $admin->name }}</h3>
                                <p class="text-sm text-[#8C9E55] flex items-center justify-center gap-2">
                                    <i class="fas fa-envelope"></i>
                                    <span class="break-all">{{ $admin->email }}</span>
                                </p>
                                <span class="inline-flex items-center gap-1.5 bg-[#F2F6E9] text-[#6E7C45] text-xs font-semibold px-3 py-1.5 rounded-full border border-[#DDE6C5]">
                                    <i class="fas fa-shield-alt"></i>
                                    Administrator
                                </span>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- RIGHT CONTENT - FORMS (Lebih lebar) --}}
                <div class="lg:col-span-8 space-y-6">
                    
                    {{-- FORM UPDATE PROFILE --}}
                    <div class="bg-white rounded-2xl shadow-xl border border-[#DDE6C5] overflow-hidden">
                        
                        <div class="bg-gradient-to-r from-[#F9FBF4] to-[#F2F6E9] px-6 py-4 border-b-2 border-[#DDE6C5]">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#A4B465] to-[#8C9E55] rounded-lg flex items-center justify-center shadow-md">
                                    <i class="fas fa-user-edit text-white"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg md:text-xl font-bold text-[#6E7C45]">Informasi Profil</h2>
                                    <p class="text-xs text-[#8C9E55]">Update data pribadi Anda</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <form id="formProfile" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                    {{-- Nama --}}
                                    <div>
                                        <label class="font-semibold text-[#6E7C45] flex items-center gap-2 mb-2 text-sm">
                                            <i class="fas fa-id-card-alt text-[#A4B465]"></i> 
                                            <span>Nama Lengkap</span>
                                        </label>
                                        <input type="text" id="nameInput" name="name" value="{{ $admin->name }}"
                                               class="w-full border-2 border-[#D8E2C0] rounded-lg px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] transition-all text-sm"
                                               placeholder="Masukkan nama lengkap">
                                    </div>

                                    {{-- Telepon --}}
                                    <div>
                                        <label class="font-semibold text-[#6E7C45] flex items-center gap-2 mb-2 text-sm">
                                            <i class="fas fa-phone-alt text-[#A4B465]"></i> 
                                            <span>No Telepon</span>
                                        </label>
                                        <input type="text" id="telpInput" name="telp" value="{{ $admin->telp }}"
                                               class="w-full border-2 border-[#D8E2C0] rounded-lg px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] transition-all text-sm"
                                               placeholder="08123456789">
                                    </div>

                                    {{-- Email --}}
                                    <div class="md:col-span-2">
                                        <label class="font-semibold text-[#6E7C45] flex items-center gap-2 mb-2 text-sm">
                                            <i class="fas fa-envelope text-[#A4B465]"></i> 
                                            <span>Email</span>
                                        </label>
                                        <div class="relative">
                                            <input type="text" value="{{ $admin->email }}" readonly
                                                   class="w-full border-2 bg-gray-50 border-gray-200 rounded-lg px-4 py-2.5 cursor-not-allowed opacity-75 pr-24 text-sm">
                                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded-full font-medium">
                                                <i class="fas fa-lock text-xs mr-1"></i>Terkunci
                                            </span>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" id="btnSaveProfile" disabled
                                        class="mt-6 w-full py-3 text-white rounded-lg font-bold transition-all duration-300 flex justify-center items-center gap-2 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400">
                                    <i class="fas fa-save"></i> 
                                    <span>Simpan Perubahan</span>
                                </button>
                            </form>
                        </div>

                    </div>

                    {{-- GANTI PASSWORD --}}
                    <div class="bg-white rounded-2xl shadow-xl border border-[#DDE6C5] overflow-hidden">
                        
                        <div class="bg-gradient-to-r from-[#F9FBF4] to-[#F2F6E9] px-6 py-4 border-b-2 border-[#DDE6C5]">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#6E7C45] to-[#5E6A3A] rounded-lg flex items-center justify-center shadow-md">
                                    <i class="fas fa-lock text-white"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg md:text-xl font-bold text-[#6E7C45]">Keamanan Akun</h2>
                                    <p class="text-xs text-[#8C9E55]">Ubah password untuk keamanan</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <form id="formPassword" action="{{ route('admin.profile.updatePassword') }}" method="POST">
                                @csrf

                                <div class="space-y-4">

                                    {{-- Password Lama --}}
                                    <div>
                                        <label class="font-semibold text-[#6E7C45] flex items-center gap-2 mb-2 text-sm">
                                            <i class="fas fa-key text-[#6E7C45]"></i> 
                                            <span>Password Sekarang</span>
                                        </label>
                                        <input type="password" id="currentPassword" name="current_password"
                                               class="w-full border-2 border-[#D8E2C0] rounded-lg px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#6E7C45] focus:border-[#6E7C45] transition-all text-sm"
                                               placeholder="Masukkan password saat ini">
                                    </div>

                                    {{-- Password Baru & Konfirmasi --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="font-semibold text-[#6E7C45] flex items-center gap-2 mb-2 text-sm">
                                                <i class="fas fa-unlock-alt text-[#6E7C45]"></i> 
                                                <span>Password Baru</span>
                                            </label>
                                            <input type="password" id="newPassword" name="password"
                                                   class="w-full border-2 border-[#D8E2C0] rounded-lg px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#6E7C45] focus:border-[#6E7C45] transition-all text-sm"
                                                   placeholder="Min. 8 karakter">
                                        </div>

                                        <div>
                                            <label class="font-semibold text-[#6E7C45] flex items-center gap-2 mb-2 text-sm">
                                                <i class="fas fa-check-circle text-[#6E7C45]"></i> 
                                                <span>Konfirmasi Password</span>
                                            </label>
                                            <input type="password" id="confirmPassword" name="password_confirmation"
                                                   class="w-full border-2 border-[#D8E2C0] rounded-lg px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#6E7C45] focus:border-[#6E7C45] transition-all text-sm"
                                                   placeholder="Ulangi password baru">
                                        </div>
                                    </div>

                                    {{-- Info Box - Compact --}}
                                    <div class="bg-gradient-to-r from-[#F9FBF4] to-[#F2F6E9] border-l-4 border-[#A4B465] rounded-lg p-3">
                                        <div class="flex items-start gap-2">
                                            <i class="fas fa-info-circle text-[#A4B465] mt-0.5 text-sm"></i>
                                            <div class="text-xs text-[#6E7C45]">
                                                <p class="font-semibold mb-1">Tips Password Kuat:</p>
                                                <p>Min. 8 karakter • Kombinasi huruf, angka & simbol • Hindari info pribadi</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" id="btnSavePassword" disabled
                                        class="mt-6 w-full py-3 text-white rounded-lg font-bold transition-all duration-300 flex justify-center items-center gap-2 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400">
                                    <i class="fas fa-sync-alt"></i> 
                                    <span>Update Password</span>
                                </button>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===========================================
    // AUTO REDIRECT AFTER SUCCESS dengan Sweet Alert
    // ===========================================
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        }).then(() => {
            window.location.href = "{{ route('admin.dashboard') }}"; // Ganti dengan route index/dashboard kamu
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session("error") }}',
            confirmButtonColor: '#6E7C45'
        });
    @endif

    // ===========================================
    // PREVIEW FOTO REAL-TIME
    // ===========================================
    const fotoInput = document.getElementById('fotoInput');
    const previewImage = document.getElementById('previewImage');
    
    fotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                // Aktifkan tombol simpan
                checkProfileChanges();
            }
            reader.readAsDataURL(file);
        }
    });

    // ===========================================
    // DETECT CHANGES - FORM PROFILE
    // ===========================================
    const btnSaveProfile = document.getElementById('btnSaveProfile');
    const nameInput = document.getElementById('nameInput');
    const telpInput = document.getElementById('telpInput');
    
    // Simpan nilai awal
    const initialName = nameInput.value;
    const initialTelp = telpInput.value;
    let fotoChanged = false;
    
    function checkProfileChanges() {
        const nameChanged = nameInput.value !== initialName;
        const telpChanged = telpInput.value !== initialTelp;
        fotoChanged = fotoInput.files.length > 0;
        
        const hasChanges = nameChanged || telpChanged || fotoChanged;
        
        btnSaveProfile.disabled = !hasChanges;
        
        if (hasChanges) {
            btnSaveProfile.classList.remove('bg-gray-400');
            btnSaveProfile.classList.add('bg-gradient-to-r', 'from-[#A4B465]', 'to-[#8C9E55]', 'hover:from-[#8C9E55]', 'hover:to-[#6E7C45]', 'hover:scale-[1.02]');
        } else {
            btnSaveProfile.classList.add('bg-gray-400');
            btnSaveProfile.classList.remove('bg-gradient-to-r', 'from-[#A4B465]', 'to-[#8C9E55]', 'hover:from-[#8C9E55]', 'hover:to-[#6E7C45]', 'hover:scale-[1.02]');
        }
    }
    
    nameInput.addEventListener('input', checkProfileChanges);
    telpInput.addEventListener('input', checkProfileChanges);
    fotoInput.addEventListener('change', checkProfileChanges);

    // ===========================================
    // DETECT CHANGES - FORM PASSWORD
    // ===========================================
    const btnSavePassword = document.getElementById('btnSavePassword');
    const currentPassword = document.getElementById('currentPassword');
    const newPassword = document.getElementById('newPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    
    function checkPasswordChanges() {
        const hasChanges = currentPassword.value.length > 0 || 
                          newPassword.value.length > 0 || 
                          confirmPassword.value.length > 0;
        
        btnSavePassword.disabled = !hasChanges;
        
        if (hasChanges) {
            btnSavePassword.classList.remove('bg-gray-400');
            btnSavePassword.classList.add('bg-gradient-to-r', 'from-[#6E7C45]', 'to-[#5E6A3A]', 'hover:from-[#5E6A3A]', 'hover:to-[#4E5A2A]', 'hover:scale-[1.02]');
        } else {
            btnSavePassword.classList.add('bg-gray-400');
            btnSavePassword.classList.remove('bg-gradient-to-r', 'from-[#6E7C45]', 'to-[#5E6A3A]', 'hover:from-[#5E6A3A]', 'hover:to-[#4E5A2A]', 'hover:scale-[1.02]');
        }
    }
    
    currentPassword.addEventListener('input', checkPasswordChanges);
    newPassword.addEventListener('input', checkPasswordChanges);
    confirmPassword.addEventListener('input', checkPasswordChanges);
});
</script>

<style>
/* Smooth transitions */
* {
    transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #F2F6E9;
}

::-webkit-scrollbar-thumb {
    background: #A4B465;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #8C9E55;
}

/* Remove extra padding/margin */
body {
    margin: 0;
    padding: 0;
}
</style>

@endsection