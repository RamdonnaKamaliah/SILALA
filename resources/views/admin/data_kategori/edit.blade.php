@extends('layout_admin.admin')
@section('pageTitle', 'Edit Data Kategori')
@section('content')

    <div class="container mt-4">
        <h2 class="text-xl font-semibold mb-4 text-[#A4B465]">Edit Kategori</h2>


        @if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


        <form action="{{ route('admin.data_kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama Kategori --}}
            <div class="mb-4">
                <label for="nama_kategori" class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#A4B465]"
                    required>
            </div>

            <button 
    type="submit"
    class="bg-[#A4B465] hover:bg-[#8EA05C] text-white font-semibold px-6 py-2 rounded-xl transition duration-200 shadow-md"
>
    Simpan Perubahan
</button>


        </form>
    </div>

@endsection
