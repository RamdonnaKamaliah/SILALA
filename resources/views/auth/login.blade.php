<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SiLala BPMSPH</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      position: relative;
    }

    /* Desktop / landscape */
    @media (min-width: 769px) {
      body {
        background: url("{{ asset('assets/bg.png') }}") no-repeat center center fixed;
        background-size: cover;
      }
    }

    /* Mobile / portrait */
    @media (max-width: 768px) and (orientation: portrait) {
      body {
        background: url("{{ asset('assets/big.png') }}") no-repeat center center fixed;
        background-size: cover;
      }
    }

    /* Mobile / landscape tetap pakai bg.png */
    @media (max-width: 768px) and (orientation: landscape) {
      body {
        background: url("{{ asset('assets/bg.png') }}") no-repeat center center fixed;
        background-size: cover;
      }
    }

    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 128, 0, 0.15);
      z-index: 0;
    }

    .floating {
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0%   { transform: translateY(0px); }
      50%  { transform: translateY(-10px); }
      100% { transform: translateY(0px); }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 relative z-10">

  <!-- Container -->
  <div class="w-full max-w-5xl grid md:grid-cols-2 bg-white/90 rounded-xl overflow-hidden border border-green-100 backdrop-blur-sm relative z-20">

    <!-- Left Side: Illustration (hilang di mobile) -->
    <div class="hidden md:flex items-center justify-center bg-green-50 p-6">
      <img src="{{ asset('assets/libey.png') }}" alt="Library Illustration" class="w-3/4 mx-auto floating">
    </div>

    <!-- Right Side: Login Form -->
    <div class="px-6 py-6 md:px-10 md:py-8 flex flex-col justify-center">

      <h2 class="text-2xl font-semibold text-green-700 mb-2 text-center flex items-center justify-center gap-2">
        <i class="fas fa-book text-green-600"></i>
        Login SiLala BPMSPH
      </h2>

      <p class="text-sm text-gray-600 mb-6 text-center">
        Masuk untuk mengakses SiLala BPMSPH.
      </p>

      <!-- Tampilkan pesan sukses jika ada (setelah registrasi dll) -->
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg">
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-2"></i>
            <span class="text-sm text-green-600 font-medium">{{ session('success') }}</span>
          </div>
        </div>
      @endif

      <!-- Google Login -->
      <div class="mb-4">
       <a href="{{ route('google.redirect') }}"  
          class="flex items-center justify-center gap-3 w-full py-2 px-4 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition">
          <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Logo" class="w-5 h-5">
          <span class="font-semibold text-black text-sm">Login dengan Google</span>
        </a>
      </div>

      <div class="flex items-center my-3">
        <div class="flex-grow h-px bg-green-200"></div>
        <span class="px-3 text-green-400 text-xs">atau</span>
        <div class="flex-grow h-px bg-green-200"></div>
      </div>

      <!-- Form Laravel -->
      <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-green-700 mb-1">
            <i class="fa-solid fa-envelope mr-2"></i>Email
          </label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
            class="block w-full px-3 py-2 border {{ $errors->has('email') ? 'border-red-400' : 'border-green-200' }} rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none text-sm">
          @error('email')
            <p class="mt-1 text-xs text-red-500">
              <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-green-700 mb-1">
            <i class="fa-solid fa-lock mr-2"></i>Password
          </label>
          <div class="relative flex items-center">
            <input id="password" type="password" name="password" required autocomplete="current-password"
              class="block w-full px-3 py-2 border {{ $errors->has('password') ? 'border-red-400' : 'border-green-200' }} rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none text-sm pr-10">
            <span class="absolute right-3 cursor-pointer text-gray-400" onclick="togglePassword()">
              <i id="eyeIcon" class="fa-solid fa-eye"></i>
            </span>
          </div>
          @error('password')
            <p class="mt-1 text-xs text-red-500">
              <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
          <input id="remember_me" type="checkbox" name="remember"
            class="h-4 w-4 text-green-600 border-green-300 rounded focus:ring-green-500">
          <label for="remember_me" class="ml-2 text-sm text-gray-600">Ingat saya</label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">
          <a href="{{ route('password.request') }}" class="text-xs text-green-700 hover:underline">Lupa Password?</a>
          <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg transition flex items-center text-sm">
            <i class="fa-solid fa-right-to-bracket mr-2"></i>Login
          </button>
        </div>

        <!-- Register Link -->
        <div class="mt-4 text-center">
          <p class="text-base text-gray-600 mb-2">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-medium text-green-700 hover:underline">Daftar di sini</a>
          </p>
          <p class="text-xs text-gray-500">
            Dengan masuk, kamu menyetujui 
            <a href="" class="underline hover:text-green-700">Kebijakan Privasi</a> dan 
            <a href="" class="underline hover:text-green-700">Syarat & Ketentuan</a>.
          </p>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePassword() {
      const password = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');
      if (password.type === 'password') {
        password.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      } else {
        password.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      }
    }
  </script>
</body>
</html>