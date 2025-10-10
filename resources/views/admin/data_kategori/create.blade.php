@extends('layout_admin.admin')
@section('pageTitle', 'Tambah Kategori')
@section('content')

    <div class="w-fullflex justify-center">
        <div class="max-w-3xl w-full bg-white rounded-2xl shadow-lg p-8 mt-10 border border-gray-200">
            <a href="{{ route('admin.data_buku.index') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left"></i>
            </a>

            <h2 class="text-3xl font-bold text-primary mb-8 text-center tracking-wide">
                📚 Tambah Kategori Baru
            </h2>

            <form action="{{ route('admin.data_kategori.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf


               
                <!-- Nama Kategori -->
                <div>
                    <label for="nama_kategori" class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama kategori"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50
                           focus:outline-none focus:ring-2 focus:ring-[#A4B465] placeholder-gray-400 transition duration-200"
                        required>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="bg-blue-500 text-black px-8 py-3 rounded-xl font-semibold shadow-md 
                           hover:bg-blue-600 hover:shadow-lg transition duration-200">
                        💾 Simpan Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
