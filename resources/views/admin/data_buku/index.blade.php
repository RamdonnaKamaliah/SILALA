@extends('layout_admin.admin')
@section('pageTitle', 'Tambah Buku')

@section('content')
<!-- Import font -->
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Nunito Sans', sans-serif;
    }

    /* animasi masuk halus */
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .fade-slide {
        animation: fadeSlideUp 0.8s ease forwards;
    }

    /* efek glow neon */
    .input-glow:focus {
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.4), 0 0 20px rgba(99, 102, 241, 0.2);
    }

    .btn-glow:hover {
        box-shadow: 0 0 25px rgba(99, 102, 241, 0.6);
    }

    .bg-grid {
        background-image: linear-gradient(to right, rgba(99,102,241,0.05) 1px, transparent 1px),
                          linear-gradient(to bottom, rgba(99,102,241,0.05) 1px, transparent 1px);
        background-size: 24px 24px;
    }
</style>

<div class="relative min-h-screen bg-gradient-to-br from-[#eef2ff] via-[#f8f9ff] to-[#ffffff] flex flex-col justify-center overflow-hidden bg-grid px-6 py-16">

    <!-- Glow lingkaran hias -->
    <div class="absolute top-[-100px] left-[-100px] w-[400px] h-[400px] bg-blue-400/20 blur-[120px] rounded-full"></div>
    <div class="absolute bottom-[-100px] right-[-100px] w-[400px] h-[400px] bg-indigo-500/20 blur-[120px] rounded-full"></div>

    <!-- Judul -->
    <div class="fade-slide text-center mb-10">
        <a href="{{ route('admin.data_buku.index') }}" class="inline-flex items-center gap-2 text-indigo-500 hover:text-indigo-700 transition">
            <i class="fas fa-arrow-left text-lg"></i>
            <span class="font-semibold text-sm">Kembali</span>
        </a>
        <h1 class="text-5xl font-extrabold bg-gradient-to-r from-indigo-600 via-blue-600 to-indigo-700 bg-clip-text text-transparent mt-6 tracking-wide">
            Tambah Buku Baru
        </h1>
        <p class="text-gray-500 mt-2 text-base">Isi data buku dengan lengkap dan jelas 📚</p>
    </div>

    <!-- FORM -->
    <form action="{{ route('admin.data_buku.store') }}" method="POST" enctype="multipart/form-data"
        class="fade-slide w-full max-w-5xl mx-auto grid md:grid-cols-2 gap-8 text-gray-800 bg-white/40 backdrop-blur-xl 
               p-10 rounded-3xl border border-white/40 shadow-[0_8px_40px_rgba(0,0,0,0.05)] transition-all duration-300">
        @csrf

        <!-- Foto Buku -->
        <div class="col-span-2">
            <label class="block font-semibold mb-2">Foto Buku</label>
            <input type="file" name="foto_buku" id="foto_buku"
                class="w-full border border-gray-300 bg-white/50 px-4 py-3 rounded-xl focus:outline-none focus:border-indigo-400 input-glow transition">
        </div>

        <!-- Judul Buku -->
        <div>
            <label class="block font-semibold mb-2">Judul Buku</label>
            <input type="text" name="judul_buku" placeholder="Masukkan judul buku"
                class="w-full border border-gray-300 bg-white/50 px-4 py-3 rounded-xl placeholder-gray-400 focus:outline-none focus:border-indigo-400 input-glow transition" required>
        </div>

        <!-- Penulis -->
        <div>
            <label class="block font-semibold mb-2">Penulis</label>
            <input type="text" name="penulis" placeholder="Masukkan nama penulis"
                class="w-full border border-gray-300 bg-white/50 px-4 py-3 rounded-xl placeholder-gray-400 focus:outline-none focus:border-indigo-400 input-glow transition" required>
        </div>

        <!-- Penerbit -->
        <div>
            <label class="block font-semibold mb-2">Penerbit</label>
            <input type="text" name="penerbit" placeholder="Masukkan nama penerbit"
                class="w-full border border-gray-300 bg-white/50 px-4 py-3 rounded-xl placeholder-gray-400 focus:outline-none focus:border-indigo-400 input-glow transition" required>
        </div>

        <!-- Tahun Terbit -->
        <div>
            <label class="block font-semibold mb-2">Tahun Terbit</label>
            <input type="text" name="tahun_terbit" placeholder="Masukkan tahun terbit"
                class="w-full border border-gray-300 bg-white/50 px-4 py-3 rounded-xl placeholder-gray-400 focus:outline-none focus:border-indigo-400 input-glow transition" required>
        </div>

        <!-- Bahasa -->
        <div>
            <label class="block font-semibold mb-2">Bahasa</label>
            <input type="text" name="bahasa" placeholder="Masukkan bahasa buku"
                class="w-full border border-gray-300 bg-white/50 px-4 py-3 rounded-xl placeholder-gray-400 focus:outline-none focus:border-indigo-400 input-glow transition" required>
        </div>

        <!-- Kategori -->
        <div>
            <label class="block font-semibold mb-2">Kategori</label>
            <input type="text" name="kategori" placeholder="Fiksi, Edukasi..."
                class="w-full border border-gray-300 bg-white/50 px-4 py-3 rounded-xl placeholder-gray-400 focus:outline-none focus:border-indigo-400 input-glow transition" required>
        </div>

        <!-- Jumlah Halaman -->
        <div>
            <label class="block font-semibold mb-2">Jumlah Halaman</label>
            <input type="number" name="jumlah_halaman" placeholder="Masukkan jumlah halaman"
                class="w-full border border-gray-300 bg-white/50 px-4 py-3 rounded-xl placeholder-gray-400 focus:outline-none focus:border-indigo-400 input-glow transition" required>
        </div>

        <!-- Edisi -->
        <div>
            <label class="block font-semibold mb-2">Edisi</label>
            <input type="text" name="edisi" placeholder="Masukkan edisi buku"
                class="w-full border border-gray-300 bg-white/50 px-4 py-3 rounded-xl placeholder-gray-400 focus:outline-none focus:border-indigo-400 input-glow transition" required>
        </div>

        <!-- Stok -->
        <div>
            <label class="block font-semibold mb-2">Stok</label>
            <input type="number" name="stok" placeholder="Masukkan stok buku"
                class="w-full border border-gray-300 bg-white/50 px-4 py-3 rounded-xl placeholder-gray-400 focus:outline-none focus:border-indigo-400 input-glow transition" required>
        </div>

        <!-- File Buku -->
        <div class="col-span-2">
            <label class="block font-semibold mb-2">File Buku (PDF)</label>
            <input type="file" name="file_buku" accept=".pdf"
                class="w-full border border-gray-300 bg-white/50 px-4 py-3 rounded-xl focus:outline-none focus:border-indigo-400 input-glow transition">
        </div>

        <!-- Deskripsi -->
        <div class="col-span-2">
            <label class="block font-semibold mb-2">Deskripsi</label>
            <textarea name="deskripsi" rows="4" placeholder="Tuliskan deskripsi singkat buku"
                class="w-full border border-gray-300 bg-white/50 px-4 py-3 rounded-xl placeholder-gray-400 focus:outline-none focus:border-indigo-400 input-glow transition" required></textarea>
        </div>

        <!-- Tombol -->
        <div class="col-span-2 flex justify-center pt-4">
            <button type="submit"
                class="btn-glow bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-semibold px-10 py-3 rounded-2xl shadow-lg hover:scale-[1.03] active:scale-[0.98] transition-all duration-200">
                💾 Simpan Buku
            </button>
        </div>
    </form>
</div>
@endsection
