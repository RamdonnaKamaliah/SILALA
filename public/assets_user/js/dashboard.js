const menuItems = document.querySelectorAll("#sidebar-menu .menu-item");

menuItems.forEach(item => {
  item.addEventListener("click", () => {
    // hapus 'active' dari semua menu-item
    menuItems.forEach(el => el.classList.remove("active"));

    // tambahkan ke menu yang diklik
    item.classList.add("active");
  });
});

  const hamburger = document.getElementById("hamburger");
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("sidebar-overlay");
  const navbar = document.getElementById("navbar"); 

  hamburger.addEventListener("click", () => {
    const isHidden = sidebar.classList.contains("-translate-x-full");

    if (isHidden) {
      // Buka sidebar
      sidebar.classList.remove("-translate-x-full");
      overlay.classList.remove("hidden");
      setTimeout(() => overlay.classList.add("opacity-100"), 10);

      // Navbar ikut menggelap (khusus mobile)
      navbar.classList.add("navbar-dim");

      // Ubah jadi X dan posisikan di kanan sidebar
      hamburger.classList.add("open");
      hamburger.style.position = "fixed";
      hamburger.style.left = "295px";
      hamburger.style.top = "16px";
      hamburger.style.zIndex = "9999";
    } else {
      // Tutup sidebar
      sidebar.classList.add("-translate-x-full");
      overlay.classList.remove("opacity-100");
      setTimeout(() => overlay.classList.add("hidden"), 300);

      // Navbar kembali normal
      navbar.classList.remove("navbar-dim");

      hamburger.classList.remove("open");
      hamburger.style.position = "";
      hamburger.style.left = "";
      hamburger.style.top = "";
      hamburger.style.zIndex = "";
    }
  });

  overlay.addEventListener("click", () => {
    sidebar.classList.add("-translate-x-full");
    overlay.classList.remove("opacity-100");
    setTimeout(() => overlay.classList.add("hidden"), 300);

    navbar.classList.remove("navbar-dim");

    hamburger.classList.remove("open");
    hamburger.style.position = "";
    hamburger.style.left = "";
    hamburger.style.top = "";
    hamburger.style.zIndex = "";
  });

  //notifikasi
  const notifBtn = document.getElementById('notifBtn');
  const notifBox = document.getElementById('notifBox');
  const closeNotif = document.getElementById('closeNotif');
  const notifItems = document.querySelectorAll('.notif-item');

  notifBtn.addEventListener('click', () => {
    notifBox.classList.toggle('opacity-100');
    notifBox.classList.toggle('pointer-events-auto');
    notifBox.classList.toggle('translate-y-0');
  });

  closeNotif.addEventListener('click', () => {
    notifBox.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
  });

  // Efek klik (aktifkan garis tetap muncul di item yang diklik)
  notifItems.forEach(item => {
    item.addEventListener('click', () => {
      notifItems.forEach(i => {
        i.classList.remove('active');
        i.querySelector('.notif-line').classList.remove('scale-y-100');
      });
      item.classList.add('active');
      item.querySelector('.notif-line').classList.add('scale-y-100');
    });
  });
// Aktifkan dark mode dari localStorage
    document.addEventListener("DOMContentLoaded", () => {
      if (localStorage.getItem("theme") === "dark") {
        document.documentElement.classList.add("dark");
      }
    });

    // Fungsi untuk toggle dark mode
    function toggleDarkMode() {
      const html = document.documentElement;
      html.classList.toggle("dark");

      // Simpan status di localStorage
      if (html.classList.contains("dark")) {
        localStorage.setItem("theme", "dark");
      } else {
        localStorage.setItem("theme", "light");
      }
    }
  