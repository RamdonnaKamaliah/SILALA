  // Toggle Sidebar Mobile
const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebar-overlay');
const closeSidebar = document.getElementById('closeSidebar');

function toggleSidebar() {
    hamburger.classList.toggle('hamburger-active');
    sidebar.classList.toggle('sidebar-open');
    sidebarOverlay.classList.toggle('sidebar-overlay-open');
    
    // Mencegah scroll body saat sidebar terbuka
    document.body.style.overflow = sidebar.classList.contains('sidebar-open') ? 'hidden' : '';
}

hamburger.addEventListener('click', toggleSidebar);
sidebarOverlay.addEventListener('click', toggleSidebar);
closeSidebar.addEventListener('click', toggleSidebar); // << tambahin ini

// Tutup sidebar saat mengklik link di dalamnya
const sidebarLinks = document.querySelectorAll('#sidebar a');
sidebarLinks.forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth < 768) {
            toggleSidebar();
        }
    });
});

// Tutup sidebar saat resize window ke ukuran desktop
window.addEventListener('resize', () => {
    if (window.innerWidth >= 768) {
        sidebar.classList.remove('sidebar-open');
        sidebarOverlay.classList.remove('sidebar-overlay-open');
        hamburger.classList.remove('hamburger-active');
        document.body.style.overflow = '';
    }
});

        
        // Toggle Tema Gelap/Terang
        const toggleTheme = document.getElementById('toggle-theme');
const darkIcon = toggleTheme.querySelector('.fa-sun');
const lightIcon = toggleTheme.querySelector('.fa-moon');

// Fungsi untuk apply tema berdasarkan localStorage atau default
function applyTheme(theme) {
    if(theme === 'dark') {
        document.documentElement.classList.add('dark');
        darkIcon.classList.add('hidden');
        lightIcon.classList.remove('hidden');
    } else {
        document.documentElement.classList.remove('dark');
        darkIcon.classList.remove('hidden');
        lightIcon.classList.add('hidden');
    }
}

// Ambil tema dari localStorage saat load
const storedTheme = localStorage.getItem('theme');
if(storedTheme) {
    applyTheme(storedTheme);
} else {
    // default mode (bisa ganti ke 'dark' kalau mau)
    applyTheme('light');
}

// Toggle tema saat klik
toggleTheme.addEventListener('click', () => {
    const isDark = document.documentElement.classList.contains('dark');
    if(isDark) {
        applyTheme('light');
        localStorage.setItem('theme', 'light');
    } else {
        applyTheme('dark');
        localStorage.setItem('theme', 'dark');
    }
});




     // animasi header
document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('.nav-link');

  links.forEach(link => {
    link.addEventListener('click', () => {
      links.forEach(l => l.classList.remove('active','text-green-600'));
      link.classList.add('active','text-green-600');
      // jangan e.preventDefault() kecuali kamu ingin mencegah navigation
    });
  });

  // Optional: set active berdasarkan hash saat load (jika anchor menuju section)
  const currentHash = location.hash;
  if (currentHash) {
    const match = document.querySelector(`.nav-link[href="${currentHash}"]`);
    if (match) {
      links.forEach(l => l.classList.remove('active','text-green-600'));
      match.classList.add('active','text-green-600');
    }
  }
});

// animasi quotes + card section
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add("opacity-100", "translate-y-0");
      entry.target.classList.remove("opacity-0", "translate-y-10");
    } else {
      entry.target.classList.add("opacity-0", "translate-y-10");
      entry.target.classList.remove("opacity-100", "translate-y-0");
    }
  });
}, { threshold: 0.2 });

// Observe semua elemen
document.querySelectorAll('.quote-box, .card-content, .card-label').forEach(el => observer.observe(el));

//card
document.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.recommend-card');

  const io = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  cards.forEach(card => io.observe(card));
});


//dropdown footer
function toggleDropdown(id, btn) {
    const dropdown = document.getElementById(id);
    const icon = btn.querySelector('svg');
    dropdown.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
  }
