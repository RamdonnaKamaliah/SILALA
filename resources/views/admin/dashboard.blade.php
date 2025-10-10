@extends('layout_admin.admin')
@section('pageTitle', 'Admin Dashboard')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .glass-card-dark {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }
        .floating {
            animation: floating 4s ease-in-out infinite;
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }
        @keyframes pulse-glow {
            from { box-shadow: 0 0 10px rgba(255, 255, 255, 0.3); }
            to { box-shadow: 0 0 20px rgba(255, 255, 255, 0.5); }
        }
        .font-elegant {
            font-family: 'Playfair Display', serif;
        }

        /* Tambahkan ke stylesheet Anda */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Animasi fade-in */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        /* Animasi untuk progress bar */
        @keyframes growWidth {
            from { width: 0; }
            to { width: var(--target-width); }
        }
        
        .grow-animation {
            animation: growWidth 1.5s ease-out forwards;
        }
    </style>
</head>
<body class="min-h-screen py-8">

    <div class="container mx-auto px-4 space-y-8">

       <!-- 🎉 HERO SECTION - Bagian sapaan untuk admin -->
<div class="max-w-5xl mx-auto">
    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
        <!-- Background Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800"></div>
        
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-10 left-10 w-20 h-20 bg-white rounded-full blur-xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-16 h-16 bg-blue-300 rounded-full blur-lg animate-bounce"></div>
            <div class="absolute top-1/2 left-1/3 w-12 h-12 bg-pink-300 rounded-full blur-md"></div>
        </div>
        
        <!-- Content Container -->
        <div class="relative z-10 p-6 md:p-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Text Content -->
                <div class="md:w-2/3 mb-6 md:mb-0 md:pr-8">
                    <!-- Badge -->
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-4">
                        <i class="fas fa-shield-alt text-blue-300 mr-2"></i>
                        <span class="text-xs font-medium text-white">Admin Dashboard</span>
                    </div>
                    
                    <!-- Main Heading - Sapaan untuk admin -->
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-3">
                        Selamat Datang, 
                        <span class="bg-gradient-to-r from-blue-300 to-purple-300 bg-clip-text text-transparent">
                            Administrator
                        </span>
                    </h1>
                    
                    <!-- Description -->
                    <p class="text-white/80 text-sm md:text-base mb-4 leading-relaxed">
                        Kelola sistem dengan efisiensi maksimal. Pantau aktivitas, kelola pengguna, 
                        dan optimalkan performa platform dari dashboard ini.
                    </p>
                </div>
                
                <!-- Gambar Sapaan -->
                <div class="w-full md:w-1/3 flex items-center justify-center">
                    <img src="{{ asset('/assets_admin/image/sapa.png') }}" alt="Sapaan Admin" class="max-w-full h-auto floating pulse-glow" style="max-height: 200px;">
                </div>
            </div>
        </div>
    </div>
</div>
       <!-- Sampai di sini bagian hero section -->

       <!-- 🗓️ CALENDAR + CLOCK SECTION -->
       <!-- Mulai dari sini bagian kalender dan jam -->
       <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
           <!-- Calendar -->
           <div class="glass-card-dark text-white p-6 rounded-2xl shadow-xl fade-in">
               <div class="flex items-center justify-between mb-6">
                   <h3 class="text-xl font-semibold flex items-center">
                       <i class="far fa-calendar-alt mr-3 text-purple-300"></i> Kalender
                   </h3>
                   <span class="text-sm bg-white/20 py-1 px-3 rounded-full">Hari ini</span>
               </div>

               <div class="text-center glass-card p-4 rounded-xl mb-6">
                   <div id="currentDate" class="text-2xl font-bold mb-1 font-elegant">Senin, 1 Jan 2025</div>
                   <div id="currentDay" class="text-sm opacity-80">Hari ke-1 dalam tahun 2025</div>
               </div>

               <div class="grid grid-cols-7 text-center text-sm gap-2 mb-3 opacity-80 font-medium">
                   <span class="text-red-400">M</span>
                   <span>S</span>
                   <span>S</span>
                   <span>R</span>
                   <span>K</span>
                   <span>J</span>
                   <span class="text-blue-400">S</span>
               </div>
               <div id="calendarDays" class="grid grid-cols-7 gap-2 text-center"></div>

               <div class="flex justify-between items-center mt-6 text-sm">
                   <span id="monthYear" class="font-medium text-lg">Januari 2025</span>
                   <div class="flex space-x-2">
                       <button id="prevMonth" class="p-2 rounded-full glass-card hover:bg-white/20 transition-all duration-300">
                           <i class="fas fa-chevron-left"></i>
                       </button>
                       <button id="nextMonth" class="p-2 rounded-full glass-card hover:bg-white/20 transition-all duration-300">
                           <i class="fas fa-chevron-right"></i>
                       </button>
                   </div>
               </div>
           </div>

           <!-- Clock -->
           <div class="glass-card-dark text-white p-6 rounded-2xl shadow-xl fade-in">
               <h3 class="text-xl font-semibold mb-6 flex items-center">
                   <i class="far fa-clock mr-3 text-purple-300"></i> Jam Digital
               </h3>

               <div class="text-center mb-8">
                   <div id="digitalClock" class="text-5xl font-bold font-mono mb-2">00:00:00</div>
                   <div id="period" class="text-lg opacity-80 bg-white/20 py-1 px-4 rounded-full inline-block">AM</div>
               </div>

               <div class="grid grid-cols-3 gap-4 text-center">
                   <div class="glass-card rounded-xl p-4">
                       <div id="currentDayName" class="text-xl font-bold">Senin</div>
                       <p class="opacity-70 text-sm mt-1">Hari</p>
                   </div>
                   <div class="glass-card rounded-xl p-4">
                       <div id="currentDateNum" class="text-xl font-bold">10</div>
                       <p class="opacity-70 text-sm mt-1">Tanggal</p>
                   </div>
                   <div class="glass-card rounded-xl p-4">
                       <div id="currentMonth" class="text-xl font-bold">Okt</div>
                       <p class="opacity-70 text-sm mt-1">Bulan</p>
                   </div>
               </div>

               <div class="mt-6 text-center text-sm opacity-70 flex items-center justify-center">
                   <i class="fas fa-globe-asia mr-2"></i> Waktu Indonesia Barat (WIB)
               </div>
           </div>
       </div>
       <!-- Sampai di sini bagian kalender dan jam -->

       <!-- 📊 STATISTICS SECTION -->
       <!-- Mulai dari sini bagian statistik -->
       <div class="max-w-5xl mx-auto">
           <div class="glass-card-dark text-white p-6 rounded-2xl shadow-xl fade-in">
               <h3 class="text-xl font-semibold mb-6 flex items-center">
                   <i class="fas fa-chart-line mr-3 text-purple-300"></i> Statistik Performa
               </h3>
               
               <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                   <!-- Card Pengguna -->
                   <div class="glass-card rounded-xl p-4">
                       <div class="flex justify-between items-start mb-3">
                           <div>
                               <p class="text-white/70 text-sm">Total Pengguna</p>
                               <h4 class="text-2xl font-bold mt-1">2,847</h4>
                           </div>
                           <div class="bg-blue-500/30 p-2 rounded-lg">
                               <i class="fas fa-users text-blue-300"></i>
                           </div>
                       </div>
                       <div class="w-full bg-white/20 rounded-full h-2">
                           <div class="bg-blue-400 h-2 rounded-full" style="width: 75%"></div>
                       </div>
                       <p class="text-xs text-white/70 mt-2">+12% dari bulan lalu</p>
                   </div>
                   
                   <!-- Card Pendapatan -->
                   <div class="glass-card rounded-xl p-4">
                       <div class="flex justify-between items-start mb-3">
                           <div>
                               <p class="text-white/70 text-sm">Pendapatan Bulan Ini</p>
                               <h4 class="text-2xl font-bold mt-1">Rp 42.5Jt</h4>
                           </div>
                           <div class="bg-green-500/30 p-2 rounded-lg">
                               <i class="fas fa-wallet text-green-300"></i>
                           </div>
                       </div>
                       <div class="w-full bg-white/20 rounded-full h-2">
                           <div class="bg-green-400 h-2 rounded-full" style="width: 65%"></div>
                       </div>
                       <p class="text-xs text-white/70 mt-2">+8% dari bulan lalu</p>
                   </div>
                   
                   <!-- Card Pesanan -->
                   <div class="glass-card rounded-xl p-4">
                       <div class="flex justify-between items-start mb-3">
                           <div>
                               <p class="text-white/70 text-sm">Pesanan Baru</p>
                               <h4 class="text-2xl font-bold mt-1">156</h4>
                           </div>
                           <div class="bg-purple-500/30 p-2 rounded-lg">
                               <i class="fas fa-shopping-cart text-purple-300"></i>
                           </div>
                       </div>
                       <div class="w-full bg-white/20 rounded-full h-2">
                           <div class="bg-purple-400 h-2 rounded-full" style="width: 85%"></div>
                       </div>
                       <p class="text-xs text-white/70 mt-2">+15% dari bulan lalu</p>
                   </div>
               </div>
           </div>
       </div>
       <!-- Sampai di sini bagian statistik -->

       <!-- 🚀 QUICK ACTIONS SECTION -->
       <!-- Mulai dari sini bagian aksi cepat -->
       <div class="max-w-5xl mx-auto">
           <div class="glass-card-dark text-white p-6 rounded-2xl shadow-xl fade-in">
               <h3 class="text-xl font-semibold mb-6 flex items-center">
                   <i class="fas fa-bolt mr-3 text-purple-300"></i> Aksi Cepat
               </h3>
               
               <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                   <a href="#" class="glass-card rounded-xl p-4 text-center transition-all duration-300 hover:bg-white/20 hover:transform hover:scale-105">
                       <div class="bg-blue-500/30 p-3 rounded-lg inline-block mb-2">
                           <i class="fas fa-user-plus text-blue-300 text-xl"></i>
                       </div>
                       <p class="font-medium">Tambah Pengguna</p>
                   </a>
                   
                   <a href="#" class="glass-card rounded-xl p-4 text-center transition-all duration-300 hover:bg-white/20 hover:transform hover:scale-105">
                       <div class="bg-green-500/30 p-3 rounded-lg inline-block mb-2">
                           <i class="fas fa-file-invoice text-green-300 text-xl"></i>
                       </div>
                       <p class="font-medium">Kelola Pesanan</p>
                   </a>
                   
                   <a href="#" class="glass-card rounded-xl p-4 text-center transition-all duration-300 hover:bg-white/20 hover:transform hover:scale-105">
                       <div class="bg-purple-500/30 p-3 rounded-lg inline-block mb-2">
                           <i class="fas fa-chart-pie text-purple-300 text-xl"></i>
                       </div>
                       <p class="font-medium">Lihat Laporan</p>
                   </a>
                   
                   <a href="#" class="glass-card rounded-xl p-4 text-center transition-all duration-300 hover:bg-white/20 hover:transform hover:scale-105">
                       <div class="bg-yellow-500/30 p-3 rounded-lg inline-block mb-2">
                           <i class="fas fa-cog text-yellow-300 text-xl"></i>
                       </div>
                       <p class="font-medium">Pengaturan</p>
                   </a>
               </div>
           </div>
       </div>
       <!-- Sampai di sini bagian aksi cepat -->

    </div>

    <script>
        // Clock - Fungsi untuk memperbarui jam digital
        function updateClock() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            const shortMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

            let h = now.getHours(), m = now.getMinutes(), s = now.getSeconds();
            const period = h >= 12 ? 'PM' : 'AM';
            h = h % 12 || 12;

            document.getElementById('digitalClock').textContent =
                `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
            document.getElementById('period').textContent = period;
            document.getElementById('currentDayName').textContent = days[now.getDay()];
            document.getElementById('currentDateNum').textContent = now.getDate();
            document.getElementById('currentMonth').textContent = shortMonths[now.getMonth()];
            
            // Update current date display
            document.getElementById('currentDate').textContent = 
                `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
            document.getElementById('currentDay').textContent = 
                `Hari ke-${Math.ceil((now - new Date(now.getFullYear(), 0, 1)) / 86400000)} dalam tahun ${now.getFullYear()}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Calendar - Fungsi untuk menampilkan dan mengelola kalender
        let currentDate = new Date();
        function renderCalendar() {
            const calendarDays = document.getElementById('calendarDays');
            const monthYear = document.getElementById('monthYear');
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            const monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

            monthYear.textContent = `${monthNames[month]} ${year}`;
            calendarDays.innerHTML = '';

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const today = new Date();

            // Adjust for Monday as first day of week
            const adjustedFirstDay = firstDay === 0 ? 6 : firstDay - 1;

            for (let i = 0; i < adjustedFirstDay; i++) {
                const empty = document.createElement('div');
                empty.classList.add('p-2', 'rounded-lg');
                calendarDays.appendChild(empty);
            }

            for (let d = 1; d <= daysInMonth; d++) {
                const cell = document.createElement('div');
                cell.classList.add('p-2', 'rounded-lg', 'text-sm', 'cursor-pointer', 'transition', 'duration-200', 'flex', 'items-center', 'justify-center');
                cell.textContent = d;
                
                // Highlight today
                if (d === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                    cell.classList.add('bg-white', 'text-purple-700', 'font-bold', 'shadow-md');
                } else {
                    cell.classList.add('hover:bg-white/20');
                }
                
                // Highlight weekends
                const dayOfWeek = new Date(year, month, d).getDay();
                if (dayOfWeek === 0) { // Sunday
                    cell.classList.add('text-red-300');
                } else if (dayOfWeek === 6) { // Saturday
                    cell.classList.add('text-blue-300');
                }
                
                calendarDays.appendChild(cell);
            }
        }
        
        // Event listeners untuk tombol bulan sebelumnya dan selanjutnya
        document.getElementById('prevMonth').onclick = () => { 
            currentDate.setMonth(currentDate.getMonth() - 1); 
            renderCalendar(); 
        };
        
        document.getElementById('nextMonth').onclick = () => { 
            currentDate.setMonth(currentDate.getMonth() + 1); 
            renderCalendar(); 
        };
        
        renderCalendar();
        
        // Animasi progress bar
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.bg-blue-400, .bg-green-400, .bg-purple-400');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });
        });
    </script>
</body>
</html>
@endsection
