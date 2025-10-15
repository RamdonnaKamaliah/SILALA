@extends('layout_admin.admin')
@section('pageTitle', 'Admin Dashboard - Data Pengguna')

@section('content')
<div class="p-4 md:p-6">
    <!-- Judul Dashboard -->
    <div class="text-left mb-8">
        <h1 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-3">
            Selamat datang di Dashboard Data Pengguna 🎉
        </h1>
        <p class="text-gray-600">
            Kelola dan pantau data pengguna perpustakaan
        </p>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <!-- Total Pengguna -->
        <div class="bg-white shadow rounded-xl p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-lg text-slate-700">Total Pengguna</h3>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalUsers }}</p>
                    <p class="text-sm text-gray-500 mt-1">Seluruh pengguna terdaftar</p>
                </div>
                <div class="text-purple-500 text-2xl">👥</div>
            </div>
        </div>

        <!-- Karyawan -->
        <div class="bg-white shadow rounded-xl p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-lg text-slate-700">Karyawan</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $karyawanCount }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $totalUsers > 0 ? number_format(($karyawanCount/$totalUsers)*100, 1) : 0 }}% dari total
                    </p>
                </div>
                <div class="text-blue-500 text-2xl">💼</div>
            </div>
        </div>

        <!-- Magang/PKL -->
        <div class="bg-white shadow rounded-xl p-6 border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-lg text-slate-700">Magang/PKL</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $magangCount }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $totalUsers > 0 ? number_format(($magangCount/$totalUsers)*100, 1) : 0 }}% dari total
                    </p>
                </div>
                <div class="text-green-500 text-2xl">🎓</div>
            </div>
        </div>
    </div>

    <!-- Chart Sederhana -->
    <div class="bg-white shadow rounded-xl p-6 border border-gray-100 mb-8">
        <h3 class="font-semibold text-lg text-slate-700 mb-4">📊 Distribusi Pengguna</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Progress Bars -->
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">Karyawan</span>
                        <span class="text-sm font-medium text-gray-700">{{ $karyawanCount }} ({{ $totalUsers > 0 ? number_format(($karyawanCount/$totalUsers)*100, 1) : 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-blue-600 h-3 rounded-full" 
                             style="width: {{ $totalUsers > 0 ? ($karyawanCount/$totalUsers)*100 : 0 }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">Magang/PKL</span>
                        <span class="text-sm font-medium text-gray-700">{{ $magangCount }} ({{ $totalUsers > 0 ? number_format(($magangCount/$totalUsers)*100, 1) : 0 }}%)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-green-600 h-3 rounded-full" 
                             style="width: {{ $totalUsers > 0 ? ($magangCount/$totalUsers)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
            
            <!-- Chart Sederhana -->
            <div class="flex items-center justify-center">
                <div class="text-center">
                    <div class="inline-flex items-center space-x-4">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-blue-600 rounded mr-2"></div>
                            <span class="text-sm">Karyawan</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-green-600 rounded mr-2"></div>
                            <span class="text-sm">Magang/PKL</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection