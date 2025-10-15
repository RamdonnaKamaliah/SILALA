// === TOGGLE SIDEBAR MOBILE ===
const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebar-overlay');
const closeSidebar = document.getElementById('closeSidebar');

function toggleSidebar() {
  hamburger.classList.toggle('hamburger-active');
  sidebar.classList.toggle('sidebar-open');
  sidebarOverlay.classList.toggle('sidebar-overlay-open');

  // Mencegah scroll saat sidebar terbuka
  document.body.style.overflow = sidebar.classList.contains('sidebar-open') ? 'hidden' : '';
}

hamburger?.addEventListener('click', toggleSidebar);
sidebarOverlay?.addEventListener('click', toggleSidebar);
closeSidebar?.addEventListener('click', toggleSidebar);

// Tutup sidebar saat klik link (khusus mobile)
document.querySelectorAll('#sidebar a').forEach(link => {
  link.addEventListener('click', () => {
    if (window.innerWidth < 768) toggleSidebar();
  });
});

// Tutup sidebar saat resize ke desktop
window.addEventListener('resize', () => {
  if (window.innerWidth >= 768) {
    sidebar.classList.remove('sidebar-open');
    sidebarOverlay.classList.remove('sidebar-overlay-open');
    hamburger.classList.remove('hamburger-active');
    document.body.style.overflow = '';
  }
});

// === TOGGLE TEMA GELAP/TERANG ===
const toggleTheme = document.getElementById('toggle-theme');
if (toggleTheme) {
  const darkIcon = toggleTheme.querySelector('.fa-sun');
  const lightIcon = toggleTheme.querySelector('.fa-moon');

  function applyTheme(theme) {
    document.documentElement.classList.toggle('dark', theme === 'dark');
    darkIcon?.classList.toggle('hidden', theme === 'dark');
    lightIcon?.classList.toggle('hidden', theme !== 'dark');
  }

  const storedTheme = localStorage.getItem('theme') || 'light';
  applyTheme(storedTheme);

  toggleTheme.addEventListener('click', () => {
    const newTheme = document.documentElement.classList.contains('dark') ? 'light' : 'dark';
    applyTheme(newTheme);
    localStorage.setItem('theme', newTheme);
  });
}

// === ANIMASI HEADER (LINK AKTIF) ===
document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('.nav-link');
  links.forEach(link => {
    link.addEventListener('click', () => {
      links.forEach(l => l.classList.remove('active', 'text-green-600'));
      link.classList.add('active', 'text-green-600');
    });
  });

  // Saat halaman di-refresh
  const currentHash = location.hash;
  if (currentHash) {
    const match = document.querySelector(`.nav-link[href="${currentHash}"]`);
    if (match) {
      links.forEach(l => l.classList.remove('active', 'text-green-600'));
      match.classList.add('active', 'text-green-600');
    }
  }
});

// === ANIMASI QUOTES & CARD SECTION ===
const fadeObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    entry.target.classList.toggle('opacity-100', entry.isIntersecting);
    entry.target.classList.toggle('translate-y-0', entry.isIntersecting);
    entry.target.classList.toggle('opacity-0', !entry.isIntersecting);
    entry.target.classList.toggle('translate-y-10', !entry.isIntersecting);
  });
}, { threshold: 0.2 });

document.querySelectorAll('.quote-box, .card-content, .card-label')
  .forEach(el => fadeObserver.observe(el));

// === ANIMASI CARD ===
const cardObserver = new IntersectionObserver((entries, obs) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('is-visible');
      obs.unobserve(entry.target);
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('.recommend-card').forEach(card => cardObserver.observe(card));

// === DROPDOWN FOOTER ===
function toggleDropdown(id, btn) {
  const dropdown = document.getElementById(id);
  const icon = btn.querySelector('svg');
  dropdown?.classList.toggle('hidden');
  icon?.classList.toggle('rotate-180');
}
