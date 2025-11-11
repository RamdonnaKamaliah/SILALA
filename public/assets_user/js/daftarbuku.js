const btn = document.querySelector('#kategoriDropdown button');
  const menu = document.querySelector('#kategoriMenu');
  const icon = document.querySelector('#kategoriIcon');
  const text = document.querySelector('#kategoriText');
  const items = document.querySelectorAll('.kategori-item');

  btn.addEventListener('click', () => {
    menu.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
  });

  items.forEach(item => {
    item.addEventListener('click', () => {
      text.textContent = item.textContent;
      menu.classList.add('hidden');
      icon.classList.remove('rotate-180');
    });
  });

  document.addEventListener('click', (e) => {
    if (!btn.contains(e.target) && !menu.contains(e.target)) {
      menu.classList.add('hidden');
      icon.classList.remove('rotate-180');
    }
  });