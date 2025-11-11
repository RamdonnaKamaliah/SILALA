<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Password - SiLala BPMSPH</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 flex items-center justify-center min-h-screen">
  <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-semibold text-green-700 text-center mb-4">
      Buat Password Baru
    </h2>
    <p class="text-sm text-gray-600 text-center mb-6">
      Kamu masuk dengan akun Google. Buat password agar bisa login manual nanti.
    </p>

    <form method="POST" action="{{ route('setup.password.store') }}" class="space-y-4">
      @csrf
      <div>
        <label class="block text-sm font-medium text-green-700 mb-1">Password</label>
        <input type="password" name="password" required class="w-full border border-green-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500">
      </div>
      <div>
        <label class="block text-sm font-medium text-green-700 mb-1">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required class="w-full border border-green-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500">
      </div>
      <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
        Simpan Password
      </button>
    </form>
  </div>
</body>
</html>
