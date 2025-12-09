@extends('layout_admin.admin')
@section('pageTitle', 'Profile Admin')

@section('content')

<div class="min-h-screen p-4 md:p-6">

    <div class="max-w-4xl mx-auto">

        <!-- HEADER -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-[#2d5016]">
                Selamat Datang, Admin!
            </h1>
            <p class="text-gray-600 mt-1">Kelola biodata Anda dengan mudah.</p>
        </div>

        <!-- CARD PROFILE -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8">

            <div class="flex flex-col md:flex-row items-start md:items-center gap-8">

                <!-- FOTO -->
                <div class="relative mx-auto md:mx-0">
                    <div class="w-32 h-32 md:w-36 md:h-36 rounded-xl overflow-hidden shadow-md border">
                        <img src="{{ $admin->foto ? asset('uploads/admin/'.$admin->foto) : asset('default-user.png') }}"
                             class="w-full h-full object-cover">
                    </div>

                    <div class="absolute -bottom-3 -right-3 bg-[#A4B465] text-white p-2 rounded-full shadow">
                        <i class="fas fa-user-cog"></i>
                    </div>
                </div>

                <!-- INFO UTAMA -->
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-col md:flex-row md:items-center gap-2">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">{{ $admin->name }}</h2>

                        @if($admin->role === 'administrator')
                        <span class="bg-[#A4B465] text-white text-xs px-3 py-1 rounded-full shadow-sm">
                            Administrator
                        </span>
                        @endif
                    </div>

                    <div class="mt-3 space-y-2 text-gray-600">
                        <p class="flex items-center justify-center md:justify-start gap-2">
                            <i class="fas fa-envelope text-[#A4B465] w-5"></i>
                            {{ $admin->email }}
                        </p>
                        <p class="flex items-center justify-center md:justify-start gap-2">
                            <i class="fas fa-phone text-[#A4B465] w-5"></i>
                            {{ $admin->telp ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- INFORMASI TAMBAHAN -->
            {{-- <div class="mt-10">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2 mb-4">
                    <i class="fas fa-info-circle text-[#A4B465]"></i>
                    Informasi Tambahan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Alamat -->
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $admin->alamat ?? 'Belum diisi' }}
                        </p>
                    </div>

                    <!-- SMA -->
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <p class="text-sm text-gray-500">Website Resmi</p>
                        <p class="font-semibold text-gray-800 mt-1">
                            {{ $admin->webres ?? 'Belum diisi' }}
                        </p>
                    </div> --}}

                </div>
            </div>

            <!-- EDIT BUTTON -->
            <div class="flex justify-end mt-8">
                <a href="{{ route('admin.profile.edit') }}"
                   class="inline-flex items-center gap-2 bg-[#A4B465] hover:bg-[#8FA056] text-white px-6 py-3 rounded-lg font-semibold shadow-md transition">
                    <i class="fas fa-edit"></i>
                    Edit Profile
                </a>
            </div>

        </div>
    </div>
</div>

{{-- SWEETALERT --}}
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session("success") }}',
    showConfirmButton: false,
    timer: 1600,
    toast: true,
    position: 'top-end'
})
</script>
@endif

@endsection
