document.addEventListener("DOMContentLoaded", () => {

    /* ==========================
       DROPDOWN PROFILE
       ========================== */
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
            const icon = dropdownButton.querySelector('.iconify');
            icon?.classList.toggle('rotate-180');
        });

        document.addEventListener('click', function (e) {
            const wrapper = document.getElementById('dropdownWrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
                const icon = dropdownButton.querySelector('.iconify');
                icon?.classList.remove('rotate-180');
            }
        });
    }

  });
