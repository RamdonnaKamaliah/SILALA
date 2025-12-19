<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Password - SiLala BPMSPH</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  
  <style>
    body {
      background: linear-gradient(135deg, #f0f9f0 0%, #e6f7e6 50%, #d1f2d1 100%);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .card-shadow {
      box-shadow: 0 10px 25px rgba(34, 197, 94, 0.1), 0 5px 10px rgba(34, 197, 94, 0.05);
    }
    
    .input-focus {
      transition: all 0.3s ease;
    }
    
    .input-focus:focus {
      box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
  <!-- Background decoration -->
  <div class="fixed inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-10 left-10 w-64 h-64 bg-green-100 rounded-full opacity-20 blur-3xl"></div>
    <div class="absolute bottom-10 right-10 w-80 h-80 bg-emerald-100 rounded-full opacity-20 blur-3xl"></div>
    <div class="absolute top-1/2 right-1/4 w-40 h-40 bg-teal-100 rounded-full opacity-15 blur-3xl"></div>
  </div>

  <!-- Main Card -->
  <div class="bg-white rounded-2xl card-shadow w-full max-w-md overflow-hidden relative z-10">
    <!-- Header with gradient -->
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-6 text-center">
      <div class="flex justify-center mb-3">
        <div class="bg-white/20 p-3 rounded-full">
          <i class="fas fa-key text-white text-2xl"></i>
        </div>
      </div>
      <h2 class="text-2xl font-bold text-white mb-2">
        Buat Password Baru
      </h2>
      <p class="text-green-100 text-sm">
        Lengkapi akun Anda dengan password
      </p>
    </div>

    <!-- Form Container -->
    <div class="p-6 md:p-8">
      <!-- Success Message -->
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg">
          <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-2"></i>
            <span class="text-sm text-green-600 font-medium">{{ session('success') }}</span>
          </div>
        </div>
      @endif

      <!-- Error Messages -->
      @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
          <div class="flex items-center">
            <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
            <span class="text-sm text-red-600 font-medium">Periksa password Anda</span>
          </div>
        </div>
      @endif

      <form method="POST" action="{{ route('setup.password.store') }}" class="space-y-5">
        @csrf
        
        <!-- Password Field -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fas fa-lock text-green-600 mr-2 text-sm"></i>
            Password Baru
          </label>
          <div class="relative">
            <input 
              type="password" 
              name="password" 
              id="password" 
              required 
              class="w-full border border-green-200 rounded-lg px-4 py-3 pl-10 input-focus focus:outline-none focus:border-green-500"
              placeholder="Masukkan password minimal 8 karakter"
            >
            <i class="fas fa-lock text-green-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-400 hover:text-green-600" onclick="togglePassword('password', 'eye-icon-password')">
              <i id="eye-icon-password" class="fas fa-eye"></i>
            </span>
          </div>
          @error('password')
            <p class="mt-2 text-xs text-red-500 flex items-center">
              <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
          <p class="text-xs text-gray-500 mt-2">
            Gunakan Minimal 8 karakter
          </p>
        </div>
        
        <!-- Confirm Password Field -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fas fa-lock text-green-600 mr-2 text-sm"></i>
            Konfirmasi Password
          </label>
          <div class="relative">
            <input 
              type="password" 
              name="password_confirmation" 
              id="password_confirmation" 
              required 
              class="w-full border border-green-200 rounded-lg px-4 py-3 pl-10 input-focus focus:outline-none focus:border-green-500"
              placeholder="Ulangi password Anda"
            >
            <i class="fas fa-shield-alt text-green-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-400 hover:text-green-600" onclick="togglePassword('password_confirmation', 'eye-icon-confirm')">
              <i id="eye-icon-confirm" class="fas fa-eye"></i>
            </span>
          </div>
          @error('password_confirmation')
            <p class="mt-2 text-xs text-red-500 flex items-center">
              <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
            </p>
          @enderror
        </div>

        <!-- Submit Button -->
        <button 
          type="submit" 
          class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-lg font-semibold hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center"
        >
          <i class="fas fa-save mr-2"></i>
          Simpan Password
        </button>
        
      </form>
    </div>
  
  </div>

  <script>
    // Toggle password visibility
    function togglePassword(inputId, eyeIconId) {
      const passwordInput = document.getElementById(inputId);
      const eyeIcon = document.getElementById(eyeIconId);
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      }
    }
    
    // Password strength checker (optional feature)
    document.getElementById('password')?.addEventListener('input', function(e) {
      const password = e.target.value;
      const checkLength = document.getElementById('check-length');
      const checkUpper = document.getElementById('check-upper');
      const checkNumber = document.getElementById('check-number');
      
      // Check length
      if (password.length >= 8) {
        checkLength.className = 'fas fa-check-circle text-green-500 mr-2 text-xs';
      } else {
        checkLength.className = 'fas fa-circle text-gray-300 mr-2 text-xs';
      }
      
      // Check uppercase
      if (/[A-Z]/.test(password)) {
        checkUpper.className = 'fas fa-check-circle text-green-500 mr-2 text-xs';
      } else {
        checkUpper.className = 'fas fa-circle text-gray-300 mr-2 text-xs';
      }
      
      // Check number
      if (/[0-9]/.test(password)) {
        checkNumber.className = 'fas fa-check-circle text-green-500 mr-2 text-xs';
      } else {
        checkNumber.className = 'fas fa-circle text-gray-300 mr-2 text-xs';
      }
    });
    
    // Confirm password matching
    document.getElementById('password_confirmation')?.addEventListener('input', function(e) {
      const password = document.getElementById('password').value;
      const confirmPassword = e.target.value;
      
      if (confirmPassword && password !== confirmPassword) {
        e.target.classList.add('border-red-300');
        e.target.classList.remove('border-green-200');
      } else if (confirmPassword) {
        e.target.classList.remove('border-red-300');
        e.target.classList.add('border-green-200');
      }
    });
  </script>
</body>
</html>