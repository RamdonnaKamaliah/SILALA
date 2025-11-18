 const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', function () {
      dropdownMenu.classList.toggle('hidden');
      dropdownButton.querySelector('.iconify').classList.toggle('rotate-180');
    });

    // Klik di luar dropdown → tutup
    document.addEventListener('click', function (e) {
      if (!document.getElementById('dropdownWrapper').contains(e.target)) {
        dropdownMenu.classList.add('hidden');
        dropdownButton.querySelector('.iconify').classList.remove('rotate-180');
      }
    });