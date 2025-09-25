<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Favorit Buku - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Favorit Buku</h1>
            
            <div class="mb-4">
                <p class="text-gray-600">Ini adalah halaman data arsip buku (untuk percobaan).</p>
                <p class="text-gray-600">Controller: ArsipBukuController</p>
                <p class="text-gray-600">Route: Route::resource('/admin/arsip_buku', ArsipBukuController::class)</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-blue-800">Total Favorit</h3>
                    <p class="text-2xl font-bold text-blue-600">156</p>
                </div>
                <div class="bg-green-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-green-800">Buku Populer</h3>
                    <p class="text-2xl font-bold text-green-600">23</p>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-purple-800">Rating Tertinggi</h3>
                    <p class="text-2xl font-bold text-purple-600">4.8/5</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Judul Buku</th>
                            <th class="py-2 px-4 border-b">Jumlah Favorit</th>
                            <th class="py-2 px-4 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b">1</td>
                            <td class="py-2 px-4 border-b">Pemrograman Web dengan Laravel</td>
                            <td class="py-2 px-4 border-b">45</td>
                            <td class="py-2 px-4 border-b">
                                <button class="bg-blue-500 text-white px-3 py-1 rounded">Lihat</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b">2</td>
                            <td class="py-2 px-4 border-b">Database Management</td>
                            <td class="py-2 px-4 border-b">32</td>
                            <td class="py-2 px-4 border-b">
                                <button class="bg-blue-500 text-white px-3 py-1 rounded">Lihat</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b">3</td>
                            <td class="py-2 px-4 border-b">Machine Learning Fundamentals</td>
                            <td class="py-2 px-4 border-b">28</td>
                            <td class="py-2 px-4 border-b">
                                <button class="bg-blue-500 text-white px-3 py-1 rounded">Lihat</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-2">Test CRUD Operations:</h3>
                <div class="space-x-2">
                    <a href="{{ route('admin.arsip_buku.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Tambah Favorit</a>
                    <a href="{{ route('admin.arsip_buku.show', 1) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Lihat Detail</a>
                    <a href="{{ route('admin.arsip_buku.edit', 1) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>