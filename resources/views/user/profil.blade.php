@extends('layout_user.user')

@section('title', 'Profil User')

@section('content')
  <div id="profile-page" 
     data-success-message="{{ session('success') ?? '' }}" 
     data-alert-type="{{ session('alert_type') ?? '' }}" class="min-h-screen bg-cream py-10 px-6">
    @auth
      <!-- Kartu Header -->
      <div class="bg-white rounded-2xl shadow-md px-8 py-6 flex justify-between items-center max-w-5xl mx-auto -mt-6">
        <div>
          <h1 class="text-xl font-bold text-gray-800">Hi, {{ Auth::user()->name ?? 'Pengguna' }}!</h1>
          <p class="text-sm text-greenmt-1">
            Bergabung Sejak {{ Auth::user()->created_at ? Auth::user()->created_at->format('d F Y') : 'Tanggal Bergabung Tidak Tersedia' }}
          </p>
        </div>

        <!-- Foto Profile -->
        <div class="w-20 h-20 rounded-full bg-gray-50 border-2 border-primary overflow-hidden 
                    shadow-[0_6px_12px_rgba(0,0,0,0.12)] flex items-center justify-center">
          @if(Auth::user()->foto_profil)
            <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" class="w-full h-full object-cover" />
          @else
            <img src="{{ asset('assets/Profile.jpg') }}" class="w-full h-full object-cover" />
          @endif
        </div>
      </div>

      <!-- Kartu Informasi -->
      <div class="bg-white rounded-2xl shadow-md mt-10 px-10 py-10 max-w-5xl mx-auto">
        <h2 class="text-center text-xl font-bold text-gray-800 mb-10">Informasi Tentang Anda!</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
          <!-- Kolom Kiri (Input Data) -->
          <div class="md:col-span-2 space-y-4">
            <!-- Nama -->
            <div class="flex items-center gap-3 rounded-lg px-3 py-2 
              bg-gray-50 border border-green">
              <span class="iconify" data-icon="fa-solid:user" style="color:#626F47;" data-width="18" data-height="18"></span>
              <input type="text" value="{{ Auth::user()->name ?? 'Nama belum diisi' }}" readonly
                class="w-full border-none focus:ring-0 bg-transparent text-sm {{ Auth::user()->name ? 'text-gray-800' : 'text-red-500 italic' }}" />
            </div>

            <!-- Email -->
            <div class="flex items-center gap-3 rounded-lg px-3 py-2 
              bg-gray-50 border border-green">
              <span class="iconify" data-icon="fa-solid:envelope" style="color:#626F47;" data-width="18" data-height="18"></span>
              <input type="text" value="{{ Auth::user()->email ?? 'Email belum diisi' }}" readonly
                class="w-full border-none focus:ring-0 text-sm {{ Auth::user()->email ? 'text-gray-800' : 'text-red-500 italic' }} bg-transparent" />
            </div>

            <!-- Telepon -->
            <div class="flex items-center gap-3 rounded-lg px-3 py-2 
              bg-gray-50 border border-green">
              <span class="iconify" data-icon="fa-solid:phone" style="color:#626F47;" data-width="18" data-height="18"></span>
              <input type="text" value="{{ Auth::user()->phone ?? 'Nomor telepon belum diisi' }}" readonly
                class="w-full border-none focus:ring-0 text-sm {{ Auth::user()->phone ? 'text-gray-800' : 'text-red-500 italic' }} bg-transparent" />
            </div>

            <!-- Jenis Kelamin -->
<div class="flex items-center gap-3 rounded-lg px-3 py-2 
  bg-gray-50 border border-green">
  <span class="iconify" data-icon="mdi:gender-male-female" style="color:#626F47;" data-width="24" data-height="24"></span>
  <input type="text" value="{{ $genderDisplay }}" readonly
    class="w-full border-none focus:ring-0 text-sm {{ $user->gender ? 'text-gray-800' : 'text-red-500 italic' }} bg-transparent" />
</div>

            
<!-- Tipe Keanggotaan -->
<div class="flex items-center gap-3 rounded-lg px-3 py-2 
    bg-gray-50 border border-green">
    <span class="iconify" data-icon="mdi:card-account-details" style="color:#626F47;" data-width="24" data-height="24"></span>
    <input type="text" value="{{ Auth::user()->membership_type ?? 'Tipe keanggotaan belum ditentukan' }}" readonly
        class="w-full border-none focus:ring-0 text-sm {{ Auth::user()->membership_type ? 'text-gray-800' : 'text-amber-600 italic' }} bg-transparent" />
</div>
          </div>

          <!-- Kolom Kanan (Gambar + Button) -->
          <div class="flex flex-col items-center gap-4">
            <img src="{{ asset('assets/logoprofil.png') }}" class="w-48 object-contain" />

            <a href="{{ route('user.editprofil') }}"
              class="bg-primary hover:bg-green text-white font-medium px-8 py-2 rounded-full flex items-center gap-2 transition">
              <span class="iconify" data-icon="fa-solid:pen" style="color:white;" data-width="16" data-height="16"></span>
              Edit
            </a>
          </div>
        </div>
      </div>
    @else
      <!-- Tampilkan jika user tidak login -->
      <div class="bg-white rounded-2xl shadow-md mt-10 px-10 py-10 max-w-5xl mx-auto text-center">
        <p class="text-lg text-gray-600">Silakan login untuk melihat profil Anda.</p>
        <a href="{{ route('login') }}" class="mt-4 inline-block bg-primary text-white px-6 py-2 rounded-full hover:bg-green transition">
          Login
        </a>
      </div>
    @endauth

  </div>
@endsection