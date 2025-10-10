@extends('layout_admin.admin')

@section('pageTitle', 'Detail Data Kategori')

@section('content')
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-lg mt-8">
        <!-- Judul Halaman -->
        <!-- Tombol Kembali -->
         <a href="{{ route('admin.data_kategori.index') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left"></i>
            </a>

        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">
            📚 Detail Kategori
        </h1>

        <!-- Grid Foto & Info Buku -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Kolom Detail -->
            <div class="space-y-4 text-gray-700">
                <div class="border-l-4 border-blue-600 pl-4">
                    <p><span class="font-semibold text-gray-900">Nama Kategori:</span> {{ $kategori->nama_kategori }}</p>
                </div>
            </div>
        </div>


    </div>
@endsection
