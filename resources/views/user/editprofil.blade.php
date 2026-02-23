@extends('layout_user.user')

@section('title', 'Edit Profil User')

@section('content')
<div class="min-h-screen bg-cream py-10 px-6">
    <form id="formEditProfil" method="POST" action="{{ route('user.updateprofil') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        
        <!-- Card -->
        <div class="bg-white shadow-md rounded-3xl p-8 md:p-10 w-full">
            <h2 class="text-center text-xl md:text-2xl font-semibold text-gray-800 mb-8">
                Ubah Informasi Anda
            </h2>

            <!-- Kontainer dua kolom -->
            <div class="flex flex-col md:flex-row gap-8 md:gap-10 items-start">

                <!-- KIRI: Foto profil + Password -->
                <div class="flex flex-col w-full md:w-1/2 justify-between">
                    <!-- Foto Profil -->
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <div class="w-36 h-36 rounded-full bg-gray-50 border-2 border-primary overflow-hidden 
                                      shadow-[0_6px_12px_rgba(0,0,0,0.12)] flex items-center justify-center">
                                @if(Auth::user()->foto_profil)
                                    <img id="preview-foto" src="{{ Storage::url(Auth::user()->foto_profil) }}" 
                                         class="w-full h-full object-cover" alt="Foto profil" />
                                @else
                                    <img id="preview-foto" src="{{ asset('assets/Profile.jpg') }}" 
                                         class="w-full h-full object-cover" alt="Foto profil" />
                                @endif
                            </div>

                            <label for="foto_profil" class="cursor-pointer absolute bottom-2 right-2 bg-primary hover:bg-green text-white p-2 rounded-full shadow-md transition"
                                   aria-label="Ubah foto profil">
                                <span class="iconify" data-icon="mdi:pencil" data-width="16"></span>
                            </label>
                            <input type="file" id="foto_profil" name="foto_profil" accept="image/*" class="hidden" onchange="previewImage(this)">
                        </div>
                    </div>

                    <!-- Passwords -->
<div class="mt-2">
    <!-- Password Sekarang -->
    <div class="mb-1">
        <label for="current_password" class="flex items-center text-gray-800 text-sm font-medium mb-1">
            <span class="iconify mr-2 text-green" data-icon="mdi:lock-outline"></span> Password Sekarang
        </label>
        <div class="relative">
            <input id="current_password"
       name="current_password"
       type="password"
       placeholder="Masukkan password saat ini"
       autocomplete="new-password"
       class="w-full border border-gray-200 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-primary pr-10" />

            <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-primary transition"
                onclick="togglePassword('current_password', 'current_password_eye')">
                <span id="current_password_eye" class="iconify" data-icon="mdi:eye-off-outline" data-width="20"></span>
            </button>
        </div>
        @error('current_password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password Baru -->
    <div class="mt-4">
        <label for="new_password" class="flex items-center text-gray-800 text-sm font-medium mb-1">
            <span class="iconify mr-2 text-green" data-icon="mdi:lock-reset"></span> Password Baru
        </label>
        <div class="relative">
            <input id="new_password" name="new_password" type="password" placeholder="Masukkan password baru (opsional)"
                class="w-full border border-gray-200 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-primary pr-10" />
            <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-primary transition"
                onclick="togglePassword('new_password', 'new_password_eye')">
                <span id="new_password_eye" class="iconify" data-icon="mdi:eye-off-outline" data-width="20"></span>
            </button>
        </div>
        @error('new_password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Konfirmasi Password Baru -->
    <div class="mt-4">
        <label for="new_password_confirmation" class="flex items-center text-gray-800 text-sm font-medium mb-1">
            <span class="iconify mr-2 text-green" data-icon="mdi:lock-check-outline"></span> Konfirmasi Password Baru
        </label>
        <div class="relative">
            <input id="new_password_confirmation" name="new_password_confirmation" type="password" placeholder="Konfirmasi password baru"
                class="w-full border border-gray-200 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-green pr-10" />
            <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-green transition"
                onclick="togglePassword('new_password_confirmation', 'new_password_confirmation_eye')">
                <span id="new_password_confirmation_eye" class="iconify" data-icon="mdi:eye-off-outline" data-width="20"></span>
            </button>
        </div>
    </div>
</div>

                </div>

                <!-- KANAN: Data Profil -->
                <div class="flex flex-col w-full md:w-1/2 gap-4">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="flex items-center text-gray-800 text-sm font-medium mb-1">
                            <span class="iconify mr-2 text-green" data-icon="mdi:account-outline"></span> Nama Lengkap
                        </label>
                        <input id="name" name="name" type="text" value="{{ old('name', Auth::user()->name) }}"
                            class="w-full border border-gray-200 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-primary" />
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="flex items-center text-gray-800 text-sm font-medium mb-1">
                            <span class="iconify mr-2 text-green" data-icon="mdi:email-outline"></span> Email
                        </label>
                        <input id="email" name="email" type="email" value="{{ old('email', Auth::user()->email) }}"
                            class="w-full border border-gray-200 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-primary" />
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Telepon -->
                    <div>
                        <label for="phone" class="flex items-center text-gray-800 text-sm font-medium mb-1">
                            <span class="iconify mr-2 text-green" data-icon="mdi:phone-outline"></span> Telepon
                        </label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone', Auth::user()->phone) }}"
                            class="w-full border border-gray-200 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-primary" />
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="flex items-center text-gray-800 text-sm font-medium mb-1">
                            <span class="iconify mr-2 text-green" data-icon="mdi:gender-female"></span> Jenis Kelamin
                        </label>
                        <div class="flex items-center space-x-6">
                            <label class="flex items-center text-sm text-gray-800">
                                <input type="radio" name="gender" value="Perempuan" 
                                  {{ (old('gender', Auth::user()->gender) == 'P' || old('gender') == 'Perempuan') ? 'checked' : '' }} class="accent-primary mr-2" /> Perempuan
                            </label>
                            <label class="flex items-center text-sm text-gray-800">
                                <input type="radio" name="gender" value="Laki-laki" 
                                  {{ (old('gender', Auth::user()->gender) == 'L' || old('gender') == 'Laki-laki') ? 'checked' : '' }} class="accent-primary mr-2" /> Laki-laki  
                            </label>
                        </div>
                        @error('gender')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
<!-- Tipe Keanggotaan -->
<div>
    <label class="flex items-center text-gray-800 text-sm font-medium mb-1">
        <span class="iconify mr-2 text-primary" data-icon="mdi:card-account-details"></span> Tipe Keanggotaan
    </label>
    
    <div class="bg-[#F8F8F8] border border-gray-200 rounded-md p-4">
        <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-6">
            @php
                $current = old('membership_type', Auth::user()->membership_type);
                $normalizedCurrent = $current ? trim(ucfirst(strtolower($current))) : '';
            @endphp
            
            <!-- Opsi Pengunjung -->
            <div class="flex items-center">
                <input type="radio" id="pengunjung" name="membership_type" value="pengunjung" 
                    {{ ($normalizedCurrent == 'pengunjung') ? 'checked' : '' }} 
                    class="accent-primary mr-2" />
                <label for="pengunjung" class="text-sm text-gray-800 cursor-pointer flex items-center">
                    <span class="iconify mr-1" data-icon="mdi:account-outline" data-width="16"></span>
                    Pengunjung
                </label>
            </div>
            
            <!-- Opsi Anggota -->
            <div class="flex items-center">
                <input type="radio" id="anggota" name="membership_type" value="anggota" 
                    {{ ($normalizedCurrent == 'anggota') ? 'checked' : '' }} 
                    class="accent-primary mr-2" />
                <label for="anggota" class="text-sm text-gray-800 cursor-pointer flex items-center">
                    <span class="iconify mr-1" data-icon="mdi:school-outline" data-width="16"></span>
                    Anggota
                </label>
            </div>
        </div>
    </div>
    
    @error('membership_type')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
    <p class="text-xs text-gray-500 mt-1">Pilih status keanggotaan Anda di perusahaan</p>
</div>
                </div>
            </div>

            <!-- Tombol Simpan dan Batal -->
            <div class="mt-8 flex justify-center gap-4">
                <a href="{{ route('user.profil') }}" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-xl shadow-md transition">
                    Batal
                </a>
                <button type="button" onclick="confirmSubmit()"
                    class="bg-primary hover:bg-green text-white font-semibold py-2 px-6 rounded-xl shadow-md transition">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
