document.addEventListener("DOMContentLoaded", () => {
  // Toggle notifikasi popup
  const notifButton = document.getElementById('notifButton');
  const notifBox = document.getElementById('notifBox');
  const closeNotif = document.getElementById('closeNotif');
  
  if (notifButton && notifBox) {
    notifButton.addEventListener('click', function(e) {
      e.stopPropagation();
      notifBox.classList.toggle('opacity-0');
      notifBox.classList.toggle('pointer-events-none');
      notifBox.classList.toggle('-translate-y-2');
      
      // Load notifikasi saat popup dibuka
      if (!notifBox.classList.contains('opacity-0')) {
        loadNotifikasiTelat();
      }
    });
    
    closeNotif.addEventListener('click', function(e) {
      e.stopPropagation();
      notifBox.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
    });
    
    // Tutup notifikasi saat klik di luar
    document.addEventListener('click', function(e) {
      if (!notifBox.contains(e.target) && !notifButton.contains(e.target)) {
        notifBox.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
      }
    });
  }
  
  // Load notifikasi saat pertama kali
  loadNotifikasiTelat();
  
  // Refresh setiap 1 menit (bisa disesuaikan)
  setInterval(loadNotifikasiTelat, 60000);
});

function loadNotifikasiTelat() {
  fetch('/peminjaman-terlambat')
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      const container = document.getElementById('notifikasiTelatContainer');
      const defaultNotif = document.getElementById('defaultNotif');
      
      // Kosongkan container
      if (container) container.innerHTML = '';
      
      // Sembunyikan notifikasi default jika ada notifikasi telat
      if (data.count > 0) {
        if (defaultNotif) defaultNotif.style.display = 'none';
        
        // Tampilkan setiap notifikasi telat
        if (container) {
          data.data.forEach(item => {
            const notifItem = createNotifItem(item);
            container.appendChild(notifItem);
          });
        }
      } else {
        if (defaultNotif) defaultNotif.style.display = 'flex';
      }
      
      // Update badge counter notifikasi
      updateNotificationBadge(data.count);
    })
    .catch(error => {
      console.error('Error loading notifications:', error);
      // Fallback: sembunyikan badge jika error
      updateNotificationBadge(0);
    });
}

function createNotifItem(item) {
  const div = document.createElement('div');
  div.className = 'notif-item relative flex items-start gap-3 px-5 py-3 hover:bg-gray-50 cursor-pointer group';
  div.dataset.id = item.id;
  
  // Format waktu relatif
  const waktu = formatRelativeTime(item.tanggal_kembali);
  
  div.innerHTML = `
    <div class="notif-line absolute left-0 top-0 bottom-0 w-[3px] ${item.warna_status} rounded-r-full scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></div>
    <div class="w-3 h-3 mt-1 ${item.warna_status} rounded-full flex-shrink-0"></div>
    <div class="flex-1">
      <p class="text-sm font-semibold ${item.is_today ? 'text-yellow-600' : 'text-red-600'}">
  ${item.is_today 
    ? `
      <span class="inline-flex items-center gap-1">
        <span class="iconify" data-icon="material-symbols:alarm" data-width="20" data-height="20"></span>
        <span>Pengingat</span>
      </span>
    `
    : `
      <span class="inline-flex items-center gap-1">
        <span class="iconify" data-icon="material-symbols:warning" data-width="20" data-height="20"></span>
        <span>Keterlambatan</span>
      </span>
    `
  }
</p>

      <p class="text-xs text-gray-800 mt-1">${item.pesan}</p>
      <p class="text-[10px] text-gray-500 mt-1">
        Jatuh tempo: ${formatDate(item.tanggal_kembali)}
      </p>
    </div>
    <span class="text-[10px] text-gray-400 whitespace-nowrap">${waktu}</span>
  `;
  
  // Tambahkan klik event untuk aksi
  div.addEventListener('click', function() {
    window.location.href = `/riwayat?status=belum`;
  });
  
  return div;
}

function formatRelativeTime(dateString) {
  try {
    const tanggalKembali = new Date(dateString);
    const sekarang = new Date();

    // Reset ke awal hari
    tanggalKembali.setHours(0, 0, 0, 0);
    sekarang.setHours(0, 0, 0, 0);

    // Hitung selisih hari
    const diffMs = sekarang - tanggalKembali;
    const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));

    // PAKSA nilai positif (hilangkan minus)
    const hari = Math.abs(diffDays);

    if (hari === 0) {
      return 'Hari ini';
    }

    return `${hari} hari`;
  } catch (e) {
    return 'Baru saja';
  }
}


function formatDate(dateString) {
  try {
    const date = new Date(dateString);
    const options = { 
      day: 'numeric', 
      month: 'long', 
      year: 'numeric' 
    };
    return date.toLocaleDateString('id-ID', options);
  } catch (e) {
    return dateString;
  }
}

function updateNotificationBadge(count) {
  const badge = document.getElementById('notificationBadge');
  if (badge) {
    if (count > 0) {
      badge.textContent = count;
      badge.classList.remove('hidden');
    } else {
      badge.classList.add('hidden');
    }
  }

}