@extends('layout_admin.admin')
@section('pageTitle', 'Admin Dashboard - Data Pengguna')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Data Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'user-primary': '#A4B465',
                        'user-primary-dark': '#8A9A55',
                        'user-primary-light': '#C5D28B',
                        'user-primary-50': '#F5F7ED'
                    }
                }
            }
        }
    </script>
    <style>
        .user-dashboard {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }
        
        .user-stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #fafbf6 100%);
            border-left: 4px solid #A4B465;
            transition: all 0.3s ease;
        }
        
        .user-stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(164, 180, 101, 0.15);
        }
        
        .user-progress-bar {
            background: linear-gradient(90deg, #A4B465, #C5D28B);
            box-shadow: 0 2px 8px rgba(164, 180, 101, 0.3);
        }
        
        .user-chart-container {
            background: linear-gradient(135deg, #ffffff 0%, #fafbf6 100%);
            border: 1px solid #e5e7eb;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #A4B465 0%, #8A9A55 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body>
    <!-- Container khusus untuk dashboard user -->
    <div class="user-dashboard p-4 md:p-6 bg-gray-50 min-h-screen">
        
        <!-- Header Profesional -->
        <div class="text-left mb-8 md:mb-10">
            <div class="flex items-center mb-3">
                <div class="bg-user-primary p-3 rounded-xl mr-4 shadow-sm">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 mb-1">
                        Manajemen Data Pengguna
                    </h1>
                    <p class="text-gray-600 text-sm md:text-base">
                        <i class="fas fa-chart-line text-user-primary mr-2"></i>
                        Pantau dan kelola data pengguna perpustakaan secara real-time
                    </p>
                </div>
            </div>
            <div class="w-24 h-1 bg-gradient-to-r from-user-primary to-user-primary-light rounded-full mt-2"></div>
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
            <!-- Total Pengguna -->
            <div class="user-stat-card rounded-xl p-4 md:p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-user-friends text-user-primary mr-2 text-sm"></i>
                            <h3 class="font-semibold text-gray-700 text-sm md:text-base">Total Pengguna</h3>
                        </div>
                        <p class="text-2xl md:text-3xl font-bold text-user-primary mb-1">{{ $totalUsers }}</p>
                        <p class="text-xs text-gray-500">
                            <i class="fas fa-database mr-1"></i>
                            Seluruh pengguna terdaftar
                        </p>
                    </div>
                    <div class="bg-user-primary-50 p-3 rounded-full ml-4">
                        <i class="fas fa-users text-user-primary text-lg md:text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Karyawan -->
            <div class="user-stat-card rounded-xl p-4 md:p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-briefcase text-user-primary mr-2 text-sm"></i>
                            <h3 class="font-semibold text-gray-700 text-sm md:text-base">Karyawan</h3>
                        </div>
                        <p class="text-2xl md:text-3xl font-bold text-user-primary mb-1">{{ $karyawanCount }}</p>
                        <p class="text-xs text-gray-500">
                            <i class="fas fa-chart-pie mr-1"></i>
                            {{ $totalUsers > 0 ? number_format(($karyawanCount/$totalUsers)*100, 1) : 0 }}% dari total
                        </p>
                    </div>
                    <div class="bg-user-primary-50 p-3 rounded-full ml-4">
                        <i class="fas fa-user-tie text-user-primary text-lg md:text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Magang/PKL -->
            <div class="user-stat-card rounded-xl p-4 md:p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-user-graduate text-user-primary mr-2 text-sm"></i>
                            <h3 class="font-semibold text-gray-700 text-sm md:text-base">Magang/PKL</h3>
                        </div>
                        <p class="text-2xl md:text-3xl font-bold text-user-primary mb-1">{{ $magangCount }}</p>
                        <p class="text-xs text-gray-500">
                            <i class="fas fa-chart-pie mr-1"></i>
                            {{ $totalUsers > 0 ? number_format(($magangCount/$totalUsers)*100, 1) : 0 }}% dari total
                        </p>
                    </div>
                    <div class="bg-user-primary-50 p-3 rounded-full ml-4">
                        <i class="fas fa-graduation-cap text-user-primary text-lg md:text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Distribusi Pengguna -->
        <div class="user-chart-container rounded-xl p-5 md:p-6 shadow-sm mb-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div class="flex items-center mb-3 md:mb-0">
                    <div class="bg-user-primary p-2 rounded-lg mr-3">
                        <i class="fas fa-chart-bar text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg md:text-xl text-gray-800">Analisis Distribusi Pengguna</h3>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Persentase berdasarkan kategori pengguna
                        </p>
                    </div>
                </div>
                
                <!-- Legend untuk Mobile -->
                <div class="flex md:hidden space-x-4 mt-2">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-user-primary rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Karyawan</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-user-primary-light rounded-full mr-2"></div>
                        <span class="text-xs text-gray-600">Magang</span>
                    </div>
                </div>
                
                <!-- Legend untuk Desktop -->
                <div class="hidden md:flex space-x-6">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-user-primary rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Karyawan</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-user-primary-light rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Magang/PKL</span>
                    </div>
                </div>
            </div>
            
            <!-- Progress Bars -->
            <div class="space-y-5 md:space-y-6">
                <!-- Progress Bar Karyawan -->
                <div>
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-2">
                        <div class="flex items-center mb-1 sm:mb-0">
                            <i class="fas fa-briefcase text-user-primary mr-2 text-sm"></i>
                            <span class="text-sm font-medium text-gray-700">Karyawan</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700 bg-user-primary-50 px-2 py-1 rounded">
                            {{ $karyawanCount }} ({{ $totalUsers > 0 ? number_format(($karyawanCount/$totalUsers)*100, 1) : 0 }}%)
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 md:h-3">
                        <div class="user-progress-bar h-2.5 md:h-3 rounded-full transition-all duration-1000 ease-out" 
                             style="width: {{ $totalUsers > 0 ? ($karyawanCount/$totalUsers)*100 : 0 }}%"></div>
                    </div>
                </div>
                
                <!-- Progress Bar Magang/PKL -->
                <div>
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-2">
                        <div class="flex items-center mb-1 sm:mb-0">
                            <i class="fas fa-user-graduate text-user-primary-light mr-2 text-sm"></i>
                            <span class="text-sm font-medium text-gray-700">Magang/PKL</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700 bg-user-primary-50 px-2 py-1 rounded">
                            {{ $magangCount }} ({{ $totalUsers > 0 ? number_format(($magangCount/$totalUsers)*100, 1) : 0 }}%)
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 md:h-3">
                        <div class="user-progress-bar h-2.5 md:h-3 rounded-full transition-all duration-1000 ease-out" 
                             style="width: {{ $totalUsers > 0 ? ($magangCount/$totalUsers)*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Summary untuk Mobile -->
            <div class="mt-6 p-4 bg-user-primary-50 rounded-lg md:hidden">
                <div class="text-center">
                    <p class="text-user-primary font-semibold text-sm">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Total Data: {{ $totalUsers }} Pengguna
                    </p>
                </div>
            </div>
        </div>

    <script>
        // Animasi progress bars
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.user-progress-bar');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });
        });
    </script>
</body>
</html>
@endsection