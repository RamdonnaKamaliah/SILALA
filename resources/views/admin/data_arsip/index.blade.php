 @extends('layout_admin.admin')
 @section('pageTitle', 'Data Arsip - Admin')
 @section('content')
    
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Arsip - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">DATA ARSIP<h1>
            <div class="mb-4">
                <p class="text-gray-600">Ini adalah halaman data arsip buku (untuk percobaan).</p>
            </div>
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-2">Menu:</h3>
                   <div class="space-x-2">
                    <a href="{{ route('admin.data_buku.index') }}" class="bg-yellow-500 text-white px-4 py-2 rounded">DATA BUKU</a>
                    <a href="{{ route('admin.data_arsip.index') }}" class="bg-green-500 text-white px-4 py-2 rounded">DATA ARSIP</a>
                    <a href="{{ route('admin.data_pengguna.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">DATA PENGGUNA</a>
                    <a href="{{ route('admin.data_peminjam.index') }}" class="bg-yellow-900  text-white px-4 py-2 rounded">DATA PEMINJAM</a>
                    <a href="{{ route('admin.data_denda.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">DATA DENDA</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

 @endsection
 