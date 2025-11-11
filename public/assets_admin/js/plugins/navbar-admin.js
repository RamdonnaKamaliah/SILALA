    // bag atas
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'purple-dark': '#4c1d95',
                        'blue-dark': '#1e3a8a',
                        'pink-dark': '#9d174d',
                    }
                }
            }
        }

        // bag bawah

    // Toggle dropdown profil dengan animasi chevron
    const profileButton = document.getElementById('user-menu-button');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const chevronIcon = document.getElementById('chevron-icon');
    
    profileButton.addEventListener('click', function() {
        const isHidden = dropdownMenu.classList.contains('hidden');
        
        // Tutup notifikasi dan pesan jika terbuka
        closeAllPopupsExcept('dropdown-menu');
        
        if (isHidden) {
            dropdownMenu.classList.remove('hidden', 'opacity-0', 'scale-95');
            dropdownMenu.classList.add('opacity-100', 'scale-100');
            chevronIcon.classList.add('rotate-180');
        } else {
            dropdownMenu.classList.add('hidden', 'opacity-0', 'scale-95');
            dropdownMenu.classList.remove('opacity-100', 'scale-100');
            chevronIcon.classList.remove('rotate-180');
        }
    });

    // Toggle popup notifikasi
    const notificationButton = document.getElementById('notification-button');
    const notificationPopup = document.getElementById('notification-popup');
    
    notificationButton.addEventListener('click', function() {
        const isHidden = notificationPopup.classList.contains('hidden');
        
        // Tutup profil dan pesan jika terbuka
        closeAllPopupsExcept('notification-popup');
        
        if (isHidden) {
            notificationPopup.classList.remove('hidden', 'opacity-0', 'scale-95');
            notificationPopup.classList.add('opacity-100', 'scale-100');
        } else {
            notificationPopup.classList.add('hidden', 'opacity-0', 'scale-95');
            notificationPopup.classList.remove('opacity-100', 'scale-100');
        }
    });

    // Toggle popup pesan
    const messageButton = document.getElementById('message-button');
    const messagePopup = document.getElementById('message-popup');
    
    messageButton.addEventListener('click', function() {
        const isHidden = messagePopup.classList.contains('hidden');
        
        // Tutup profil dan notifikasi jika terbuka
        closeAllPopupsExcept('message-popup');
        
        if (isHidden) {
            messagePopup.classList.remove('hidden', 'opacity-0', 'scale-95');
            messagePopup.classList.add('opacity-100', 'scale-100');
        } else {
            messagePopup.classList.add('hidden', 'opacity-0', 'scale-95');
            messagePopup.classList.remove('opacity-100', 'scale-100');
        }
    });

    // Toggle pencarian mobile
    const mobileSearchButton = document.getElementById('mobile-search-button');
    const mobileSearch = document.getElementById('mobile-search');
    
    mobileSearchButton.addEventListener('click', function() {
        const isHidden = mobileSearch.classList.contains('hidden');
        
        if (isHidden) {
            mobileSearch.classList.remove('hidden');
        } else {
            mobileSearch.classList.add('hidden');
        }
    });

    // Fungsi untuk menutup semua popup kecuali yang ditentukan
    function closeAllPopupsExcept(exception) {
        const popups = [
            {id: 'dropdown-menu', element: dropdownMenu},
            {id: 'notification-popup', element: notificationPopup},
            {id: 'message-popup', element: messagePopup}
        ];
        
        popups.forEach(popup => {
            if (popup.id !== exception) {
                popup.element.classList.add('hidden', 'opacity-0', 'scale-95');
                popup.element.classList.remove('opacity-100', 'scale-100');
                
                // Reset chevron jika dropdown ditutup
                if (popup.id === 'dropdown-menu') {
                    chevronIcon.classList.remove('rotate-180');
                }
            }
        });
    }

    // Tutup semua popup ketika klik di luar
    document.addEventListener('click', function(event) {
        const isClickInsideProfile = profileButton.contains(event.target) || dropdownMenu.contains(event.target);
        const isClickInsideNotification = notificationButton.contains(event.target) || notificationPopup.contains(event.target);
        const isClickInsideMessage = messageButton.contains(event.target) || messagePopup.contains(event.target);
        
        if (!isClickInsideProfile) {
            dropdownMenu.classList.add('hidden', 'opacity-0', 'scale-95');
            dropdownMenu.classList.remove('opacity-100', 'scale-100');
            chevronIcon.classList.remove('rotate-180');
        }
        
        if (!isClickInsideNotification) {
            notificationPopup.classList.add('hidden', 'opacity-0', 'scale-95');
            notificationPopup.classList.remove('opacity-100', 'scale-100');
        }
        
        if (!isClickInsideMessage) {
            messagePopup.classList.add('hidden', 'opacity-0', 'scale-95');
            messagePopup.classList.remove('opacity-100', 'scale-100');
        }
        
        // Tutup pencarian mobile jika klik di luar
        const isClickInsideMobileSearch = mobileSearchButton.contains(event.target) || mobileSearch.contains(event.target);
        if (!isClickInsideMobileSearch) {
            mobileSearch.classList.add('hidden');
        }
    });
