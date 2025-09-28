<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Password - SiLala BPMSPH</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      background: url("{{ asset('assets/bg.png') }}") no-repeat center center fixed;
      background-size: cover;
      position: relative;
    }

    /* Mobile Portrait */
    @media (max-width: 768px) {
      body {
        background: url("{{ asset('assets/big.png') }}") no-repeat center center fixed;
        background-size: cover;
      }
    }

    /* Semi-transparent overlay */
    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 128, 0, 0.15);
      z-index: 0;
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen px-4 relative z-10">

  <!-- Form Container -->
  <div class="w-full max-w-md bg-white/90 rounded-xl shadow-lg p-8 backdrop-blur-sm border border-green-100 relative z-20">
    
    <!-- Judul -->
    <h2 class="text-2xl font-semibold text-green-700 mb-2 text-center flex items-center justify-center gap-2">
      <i class="fas fa-unlock-keyhole text-green-600"></i>
      Lupa Password
    </h2>

    <p class="text-sm text-gray-600 mb-6 text-center">
      Masukkan email Anda untuk menerima link reset password.
    </p>

    <!-- Session Status Laravel -->
    <x-auth-session-status class="mb-4 text-sm text-green-700 text-center" :status="session('status')" />

    <!-- Form Laravel -->
    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
      @csrf

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-green-700 mb-1">
          <i class="fa-solid fa-envelope mr-2"></i>Email
        </label>
        <input id="email" type="email" name="email" :value="old('email')" required autofocus
          class="block w-full px-3 py-2 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none text-sm">
        <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
      </div>

      <!-- Tombol & Link Kembali -->
      <div class="flex items-center justify-between">
        <a href="{{ route('login') }}" class="text-xs text-green-700 hover:underline flex items-center">
          <i class="fa-solid fa-arrow-left mr-1"></i>Kembali ke Login
        </a>
        <button type="submit"
          class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg transition flex items-center text-sm">
          <i class="fa-solid fa-paper-plane mr-2"></i>Kirim Link
        </button>
      </div>
    </form>

  </div>

</body>
</html>
