@extends('layout_admin.admin')
@section('pageTitle', 'Admin Dashboard - Data Denda')

@section('content')
<div class="text-left">
    <!-- Judul Dashboard -->
    <h1 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-3">
        Selamat datang di Dashboard Data Denda 🎉
    </h1>
    <p class="text-gray-600 mb-6">
        Ini isi konten halaman Data Denda
    </p>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-xl p-6 border border-gray-100 hover:shadow-md transition">
            <h3 class="font-semibold text-lg text-slate-700">Total Buku</h3>
            <p class="text-3xl font-bold text-purple-600 mt-2">1.234</p>
            <p class="text-sm text-gray-500 mt-1">Jumlah keseluruhan buku di perpustakaan</p>
        </div>

        <div class="bg-white shadow rounded-xl p-6 border border-gray-100 hover:shadow-md transition">
            <h3 class="font-semibold text-lg text-slate-700">Peminjaman Hari Ini</h3>
            <p class="text-3xl font-bold text-pink-600 mt-2">42</p>
            <p class="text-sm text-gray-500 mt-1">Jumlah transaksi peminjaman aktif</p>
        </div>

        <div class="bg-white shadow rounded-xl p-6 border border-gray-100 hover:shadow-md transition">
            <h3 class="font-semibold text-lg text-slate-700">Anggota Aktif</h3>
            <p class="text-3xl font-bold text-indigo-600 mt-2">3.210</p>
            <p class="text-sm text-gray-500 mt-1">Jumlah anggota yang masih aktif</p>
        </div>
    </div>
</div>
@endsection
