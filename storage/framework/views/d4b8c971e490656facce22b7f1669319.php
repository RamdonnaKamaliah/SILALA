<?php $__env->startSection('pageTitle', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<<<<<<< HEAD
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --army-green-dark: #2d5016;
            --army-green-medium: #4a7c3a;
            --army-green-light: #6b9c5a;
            --cream: #f5f5e9;
            --beige: #e8e4d5;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .glass-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);
        }
        
        .card-gradient-border::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--army-green-medium), var(--army-green-light));
        }

        /* Mobile Optimizations */
        @media (max-width: 640px) {
            .mobile-stack {
                flex-direction: column;
            }
            
            .mobile-center {
                text-align: center;
            }
            
            .mobile-padding {
                padding: 1rem;
            }
            
            .mobile-text-sm {
                font-size: 0.875rem;
            }
            
            .mobile-text-lg {
                font-size: 1.125rem;
            }
        }
    </style>
</head>
<body class="bg-[#f5f5e9] min-h-screen p-2 md:p-4 text-gray-800 font-['Segoe_UI',_Tahoma,_Geneva,_Verdana,_sans-serif]">
    <div class="container mx-auto max-w-7xl">
        <!-- Header dengan Glass Blur -->
        <div class="glass-effect rounded-2xl shadow-[0_8px_32px_rgba(0,0,0,0.1)] mb-4 md:mb-6 p-4 md:p-6 relative overflow-hidden flex flex-col md:flex-row justify-between items-center mobile-padding">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-4 md:gap-6 mb-4 md:mb-0 mobile-center">
                <img src="<?php echo e(asset('/assets_admin/image/sisapa.png')); ?>" alt="Logo Silala" class="w-16 h-16 md:w-20 md:h-20 lg:w-24 lg:h-24 rounded-xl object-contain opacity-90 transition-all duration-300 hover:opacity-100 hover:scale-105 filter drop-shadow-[0_4px_8px_rgba(0,0,0,0.2)] hover:drop-shadow-[0_6px_12px_rgba(0,0,0,0.3)]">
                <div class="text-center md:text-left mt-0 md:mt-2">
                    <h1 class="text-xl md:text-2xl lg:text-3xl font-extrabold text-[rgb(45,80,22)] mb-1 md:mb-2 tracking-wide text-shadow-[1px_1px_3px_rgba(255,255,255,0.9)] mobile-text-lg">Selamat Datang!</h1>
                    <p class="text-sm md:text-base text-[#5a6c5d] font-semibold tracking-wide text-shadow-[1px_1px_2px_rgba(255,255,255,0.8)] mobile-text-sm">Sistem Manajemen Perpustakaan Silala</p>
                </div>
            </div>
            
            <div class="text-center md:text-right">
                <div id="current-time" class="text-lg md:text-xl lg:text-2xl font-bold text-[#2d5016] mb-1 tracking-wider text-shadow-[1px_1px_2px_rgba(255,255,255,0.8)] mobile-text-lg">00:00:00</div>
                <div id="current-date" class="text-xs md:text-sm text-[#5a6c5d] font-medium text-shadow-[1px_1px_2px_rgba(255,255,255,0.8)] mobile-text-sm">Hari, DD Bulan YYYY</div>
            </div>
        </div>

        <!-- Dashboard Cards Responsive -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            <!-- Total Buku -->
            <div class="bg-white/70 backdrop-blur-md rounded-xl p-3 md:p-4 shadow-[0_4px_15px_rgba(0,0,0,0.08)] border border-white/40 relative overflow-hidden min-h-[90px] md:min-h-[100px] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_6px_20px_rgba(0,0,0,0.12)] hover:bg-white/85 card-gradient-border">
                <div class="flex justify-between items-start mb-2 md:mb-3">
                    <div class="text-xs md:text-sm font-semibold text-[#2d5016] leading-tight mobile-text-sm">Total Buku</div>
                    <div class="w-7 h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 rounded-lg flex items-center justify-center text-white text-sm md:text-base bg-[rgba(74,124,58,0.9)] backdrop-blur">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
                <div class="text-xl md:text-2xl font-bold text-[#2d5016] mb-1">2,543</div>
                <div class="text-xs text-[#5a6c5d] flex items-center mobile-text-sm">
                    <i class="fas fa-arrow-up text-[#10b981] mr-1 text-xs"></i>
                    <span>+12 dari bulan lalu</span>
                </div>
            </div>
            
            <!-- Peminjam Aktif -->
            <div class="bg-white/70 backdrop-blur-md rounded-xl p-3 md:p-4 shadow-[0_4px_15px_rgba(0,0,0,0.08)] border border-white/40 relative overflow-hidden min-h-[90px] md:min-h-[100px] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_6px_20px_rgba(0,0,0,0.12)] hover:bg-white/85 card-gradient-border">
                <div class="flex justify-between items-start mb-2 md:mb-3">
                    <div class="text-xs md:text-sm font-semibold text-[#2d5016] leading-tight mobile-text-sm">Peminjam Aktif</div>
                    <div class="w-7 h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 rounded-lg flex items-center justify-center text-white text-sm md:text-base bg-[rgba(107,156,90,0.9)] backdrop-blur">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="text-xl md:text-2xl font-bold text-[#2d5016] mb-1">187</div>
                <div class="text-xs text-[#5a6c5d] flex items-center mobile-text-sm">
                    <i class="fas fa-arrow-up text-[#10b981] mr-1 text-xs"></i>
                    <span>+8 dari minggu lalu</span>
                </div>
            </div>
            
            <!-- Buku Dipinjam -->
            <div class="bg-white/70 backdrop-blur-md rounded-xl p-3 md:p-4 shadow-[0_4px_15px_rgba(0,0,0,0.08)] border border-white/40 relative overflow-hidden min-h-[90px] md:min-h-[100px] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_6px_20px_rgba(0,0,0,0.12)] hover:bg-white/85 card-gradient-border">
                <div class="flex justify-between items-start mb-2 md:mb-3">
                    <div class="text-xs md:text-sm font-semibold text-[#2d5016] leading-tight mobile-text-sm">Buku Dipinjam</div>
                    <div class="w-7 h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 rounded-lg flex items-center justify-center text-white text-sm md:text-base bg-[rgba(143,185,130,0.9)] backdrop-blur">
                        <i class="fas fa-hand-holding"></i>
                    </div>
                </div>
                <div class="text-xl md:text-2xl font-bold text-[#2d5016] mb-1">324</div>
                <div class="text-xs text-[#5a6c5d] flex items-center mobile-text-sm">
                    <i class="fas fa-arrow-up text-[#10b981] mr-1 text-xs"></i>
                    <span>+24 dari kemarin</span>
                </div>
            </div>
            
            <!-- E-book Tersedia -->
            <div class="bg-white/70 backdrop-blur-md rounded-xl p-3 md:p-4 shadow-[0_4px_15px_rgba(0,0,0,0.08)] border border-white/40 relative overflow-hidden min-h-[90px] md:min-h-[100px] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_6px_20px_rgba(0,0,0,0.12)] hover:bg-white/85 card-gradient-border">
                <div class="flex justify-between items-start mb-2 md:mb-3">
                    <div class="text-xs md:text-sm font-semibold text-[#2d5016] leading-tight mobile-text-sm">E-book Tersedia</div>
                    <div class="w-7 h-7 md:w-8 md:h-8 lg:w-9 lg:h-9 rounded-lg flex items-center justify-center text-white text-sm md:text-base bg-[rgba(165,201,152,0.9)] backdrop-blur">
                        <i class="fas fa-tablet-alt"></i>
                    </div>
                </div>
                <div class="text-xl md:text-2xl font-bold text-[#2d5016] mb-1">856</div>
                <div class="text-xs text-[#5a6c5d] flex items-center mobile-text-sm">
                    <i class="fas fa-download text-[#10b981] mr-1 text-xs"></i>
                    <span>125 unduhan hari ini</span>
                </div>
            </div>
        </div>

    <script>
        // Update waktu secara real-time
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', { 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit' 
            });
            
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const dateString = now.toLocaleDateString('id-ID', options);
            
            document.getElementById('current-time').textContent = timeString;
            document.getElementById('current-date').textContent = dateString;
        }

        // Update waktu setiap detik
        setInterval(updateTime, 1000);
        updateTime(); // Panggil sekali saat halaman dimuat

        // Optimasi untuk mobile
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan class untuk touch optimization di mobile
            if (window.innerWidth < 768) {
                document.body.classList.add('mobile-optimized');
            }
        });
    </script>
</body>
</html>
<?php $__env->stopSection(); ?>
=======
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Perpustakaan — Silala</title>

  <!-- Tailwind (CDN for quick preview; in production use compiled assets) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    :root{
      --army-green-dark: #2d5016;
      --army-green-medium: #4a7c3a;
      --army-green-light: #6b9c5a;
      --cream: #f5f5e9;
      --beige: #e8e4d5;
    }

    .glass-effect{background: rgba(255,255,255,0.28);backdrop-filter: blur(10px);-webkit-backdrop-filter: blur(10px);border:1px solid rgba(255,255,255,0.35)}
    .card-gradient-border{position:relative}
    .card-gradient-border::before{content:'';position:absolute;top:0;left:0;width:100%;height:3px;background:linear-gradient(90deg,var(--army-green-medium),var(--army-green-light));border-radius:6px}

    /* small text shadow for contrast on cream bg */
    .text-soft-shadow{text-shadow: 1px 1px 0 rgba(255,255,255,0.9)}

    /* animation */
    .fade-in{opacity:0;transform:translateY(6px);transition:all .45s cubic-bezier(.2,.9,.4,1)}
    .fade-in.show{opacity:1;transform:none}

    /* notification badge */
    .notification-badge{position:absolute;top:-6px;right:-6px;display:inline-flex;align-items:center;justify-content:center;width:18px;height:18px;border-radius:999px;background:#ef4444;color:#fff;font-size:11px;font-weight:700;box-shadow:0 4px 10px rgba(0,0,0,0.12)}

    /* mobile tweaks */
    @media (max-width:640px){
      .mobile-stack{flex-direction:column}
      .mobile-center{text-align:center}
      .mobile-gap{gap:.5rem}
    }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-[var(--cream)] to-[var(--beige)] p-4 md:p-6 font-sans text-gray-800">
    <!-- Header big -->
    <div class="glass-effect rounded-2xl p-4 md:p-6 mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
      <div class="flex items-center gap-4">
        <img src="<?php echo e(asset('/assets_admin/image/sisapa.png')); ?>" alt="logo" class="w-20 h-20 rounded-xl object-contain" />
        <div>
          <h1 class="text-2xl md:text-3xl font-extrabold text-[var(--army-green-dark)]">Selamat Datang, Admin 👋</h1>
          <p class="text-sm text-[#5a6c5d]">Sistem Manajemen Perpustakaan — Silala</p>
        </div>
      </div>

      <div class="text-center">
        <div id="current-time" class="text-lg md:text-2xl font-bold text-[var(--army-green-dark)]">00:00:00</div>
        <div id="current-date" class="text-xs text-[#5a6c5d]">Hari, DD Bulan YYYY</div>
      </div>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

      <!-- card: total buku -->
      <div class="card card-gradient-border fade-in bg-white/70 rounded-xl p-4 shadow-md">
        <div class="flex justify-between items-start">
          <div class="text-xs font-semibold text-[var(--army-green-dark)]">Total Buku</div>
          <div class="w-9 h-9 rounded-lg flex items-center justify-center text-white bg-[var(--army-green-medium)] shadow-sm">
  <i class="fa-solid fa-book-open"></i>
</div>
        </div>
        <div class="mt-3 flex items-center justify-between">
          <div>
            <div class="text-2xl font-bold text-[var(--army-green-dark)]">2,543</div>
            <div class="text-xs text-[#5a6c5d] mt-1 flex items-center"><i class="fa-solid fa-arrow-up text-[#10b981] mr-1 text-xs"></i>+12 dari bulan lalu</div>
          </div>
          <div class="w-20">
            <canvas id="sparkTotalBuku" height="50"></canvas>
          </div>
        </div>
      </div>

      <!-- card: peminjam aktif -->
      <div class="card card-gradient-border fade-in bg-white/70 rounded-xl p-4 shadow-md">
        <div class="flex justify-between items-start">
          <div class="text-xs font-semibold text-[var(--army-green-dark)]">Peminjam Aktif</div>
          <div class="w-9 h-9 rounded-lg flex items-center justify-center text-white bg-[rgba(107,156,90,0.95)] shadow-sm">
            <i class="fa-solid fa-user-group"></i>
          </div>
        </div>
        <div class="mt-3 flex items-center justify-between">
          <div>
            <div class="text-2xl font-bold text-[var(--army-green-dark)]">187</div>
            <div class="text-xs text-[#5a6c5d] mt-1 flex items-center"><i class="fa-solid fa-arrow-up text-[#10b981] mr-1 text-xs"></i>+8 dari minggu lalu</div>
          </div>
          <div class="w-20">
            <canvas id="sparkPeminjam" height="50"></canvas>
          </div>
        </div>
      </div>

      <!-- card: buku dipinjam -->
      <div class="card card-gradient-border fade-in bg-white/70 rounded-xl p-4 shadow-md">
        <div class="flex justify-between items-start">
          <div class="text-xs font-semibold text-[var(--army-green-dark)]">Buku Dipinjam</div>
          <div class="w-9 h-9 rounded-lg flex items-center justify-center text-white bg-[rgba(143,185,130,0.95)] shadow-sm">
            <i class="fa-solid fa-book-bookmark"></i>
          </div>
        </div>
        <div class="mt-3 flex items-center justify-between">
          <div>
            <div class="text-2xl font-bold text-[var(--army-green-dark)]">324</div>
            <div class="text-xs text-[#5a6c5d] mt-1 flex items-center"><i class="fa-solid fa-arrow-up text-[#10b981] mr-1 text-xs"></i>+24 dari kemarin</div>
          </div>
          <div class="w-20">
            <canvas id="sparkDipinjam" height="50"></canvas>
          </div>
        </div>
      </div>

      <!-- card: e-book -->
      <div class="card card-gradient-border fade-in bg-white/70 rounded-xl p-4 shadow-md">
        <div class="flex justify-between items-start">
          <div class="text-xs font-semibold text-[var(--army-green-dark)]">E-book Tersedia</div>
          <div class="w-9 h-9 rounded-lg flex items-center justify-center text-white bg-[rgba(165,201,152,0.95)] shadow-sm">
            <i class="fa-solid fa-tablet-screen-button"></i>
          </div>
        </div>
        <div class="mt-3">
          <div class="flex items-center justify-between">
            <div>
              <div class="text-2xl font-bold text-[var(--army-green-dark)]">856</div>
              <div class="text-xs text-[#5a6c5d] mt-1 flex items-center"><i class="fa-solid fa-download text-[#10b981] mr-1 text-xs"></i>125 unduhan hari ini</div>
            </div>
            <div class="w-20">
              <canvas id="sparkEbook" height="50"></canvas>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Analytics & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
      <div class="lg:col-span-2 bg-white/70 rounded-xl p-4 shadow-md glass-effect">
        <div class="flex items-center justify-between mb-3">
          <h3 class="font-semibold text-[var(--army-green-dark)]">Statistik Mingguan</h3>
          <div class="text-xs text-[#5a6c5d]">Perbandingan 7 hari terakhir</div>
        </div>
        <canvas id="mainChart" height="140"></canvas>
      </div>

      
    </div>

    <!-- Footer small -->
    
  </div>

  <script>
    // show fade-in for cards
    window.addEventListener('load', ()=>{
      document.querySelectorAll('.fade-in').forEach((el,i)=>{
        setTimeout(()=>el.classList.add('show'), i*90);
      });
    });

    // waktu real-time
    function updateTime(){
      const now = new Date();
      const timeString = now.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit',second:'2-digit'});
      const dateString = now.toLocaleDateString('id-ID',{weekday:'long',year:'numeric',month:'long',day:'numeric'});
      document.getElementById('current-time').textContent = timeString;
      document.getElementById('current-date').textContent = dateString;
    }
    setInterval(updateTime,1000); updateTime();

    // Sparkline helper
    function createSpark(id, data, color){
      const ctx = document.getElementById(id).getContext('2d');
      new Chart(ctx,{
        type:'line',
        data:{labels:data.map((v,i)=>i+1),datasets:[{data:data,fill:false,borderColor:color,borderWidth:2,pointRadius:0}]},
        options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{display:false},y:{display:false}},elements:{line:{tension:0.3}}
        }
      });
    }

    // example spark data (replace with real)
    createSpark('sparkTotalBuku',[10,12,9,14,13,16,18],'#3f6212');
    createSpark('sparkPeminjam',[2,4,3,5,6,5,7],'#5d8c3a');
    createSpark('sparkDipinjam',[20,18,22,24,21,25,24],'#7fb56a');
    createSpark('sparkEbook',[5,7,6,8,9,10,12],'#9ecd88');

    // main chart
    const mainCtx = document.getElementById('mainChart').getContext('2d');
    new Chart(mainCtx,{
      type:'bar',
      data:{labels:['Sen','Sel','Rab','Kam','Jum','Sab','Min'],datasets:[{label:'Peminjaman',data:[50,65,70,60,80,95,75],backgroundColor:'#4a7c3a'},{label:'Pengembalian',data:[30,45,40,50,60,70,55],backgroundColor:'#a7c68f'}]},
      options:{responsive:true,plugins:{legend:{position:'top'}},scales:{y:{beginAtZero:true}}
      }
    });

    // simple interactions
    document.getElementById('notification-button').addEventListener('click', ()=>{
      alert('Kamu punya 3 notifikasi. Implementasikan panel notif untuk detail.');
    });
  </script>

</body>
</html>
<?php $__env->stopSection(); ?>

>>>>>>> f0747171cd3dd3a038c7f5e52e06862e4f0a8864
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>