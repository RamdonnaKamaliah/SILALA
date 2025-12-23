<!-- NAVBAR -->
<nav id="navbar"
  class="fixed top-0 left-0 md:left-[320px] right-0 md:right-3 z-30 bg-cream
  rounded-b-3xl shadow-sm flex justify-between items-center
  px-4 md:px-6 py-4 md:py-6 transition-all duration-300">

  <!-- Judul -->
  <h1
    class="absolute left-1/2 -translate-x-1/2 md:static md:translate-x-0
    text-lg md:text-xl font-semibold text-green">
    {{ $title ?? 'BERANDA' }}
  </h1>

  <div class="flex items-center gap-4 ml-auto">
    <!-- Notifikasi -->
    <div class="relative">
      <!-- Button dengan badge counter -->
      <button id="notifButton" class="relative text-netral text-lg">
        <i class="fa-solid fa-bell"></i>
        <!-- Badge untuk jumlah notifikasi -->
        <span
  id="notificationBadge"
  class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center
         {{ $showBadge ?? false ? '' : 'hidden' }}">
  0
</span>

      </button>

      <!-- Popup Notifikasi -->
      <div id="notifBox"
        class="absolute right-0 mt-3 w-72 sm:w-80 bg-white rounded-2xl shadow-2xl
        border border-gray-100 z-50 opacity-0 pointer-events-none
        transform -translate-y-2 transition-all duration-300">

        <!-- Header -->
        <div class="flex items-center justify-between px-5 py-3 border-b border-gray-100">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-bell text-primary"></i>
            <h3 class="font-semibold text-gray-700 text-sm">Notifikasi</h3>
          </div>
          <button id="closeNotif" class="text-gray-400 hover:text-gray-600">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>

        <!-- List Notifikasi -->
        <div id="notifList" class="max-h-80 overflow-y-auto divide-y divide-gray-100">
          <!-- Notifikasi default (jika tidak ada telat) -->
          <div id="defaultNotif" class="notif-item relative flex items-start gap-3 px-5 py-3 hover:bg-gray-50 cursor-pointer group">
            <div class="notif-line absolute left-0 top-0 bottom-0 w-[3px] bg-primary rounded-r-full scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></div>
            <div class="w-2 h-2 mt-1 bg-primary rounded-full"></div>
            <div class="flex-1">
              <p class="text-sm font-semibold text-green">Sistem</p>
              <p class="text-xs text-gray-600">Tidak ada notifikasi baru.</p>
            </div>
            <span class="text-[10px] text-gray-400">Baru saja</span>
          </div>
          
          <!-- Container untuk notifikasi telat (akan diisi via JS) -->
          <div id="notifikasiTelatContainer"></div>
        </div>

        <!-- Footer -->
        <div class="text-center py-3 border-t border-gray-100">
          <a href="{{ route('user.riwayatbuku')}}" class="text-green text-sm font-medium hover:text-primary">
            Lihat semua aktivitas
          </a>
        </div>
      </div>
    </div>

    <!-- Darkmode -->
    <button onclick="toggleDarkMode()" class="text-green text-lg">
      <span class="iconify text-2xl dark:hidden" data-icon="mdi:weather-sunny"></span>
      <span class="iconify text-2xl hidden dark:inline" data-icon="mdi:weather-night"></span>
    </button>
  </div>
</nav>