<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
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
    </script>
    <style>
        .navbar-shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #ef4444;
            color: white;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .dropdown-transition {
            transition: all 0.2s ease-in-out;
        }
        .popup-shadow {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        /* Tambahan untuk responsif */
        .mobile-search-container {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            padding: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            z-index: 40;
        }
        @media (max-width: 768px) {
            .popup-mobile {
                width: 100vw;
                position: fixed;
                top: 4rem;
                left: 0;
                right: 0;
                border-radius: 0;
                max-height: calc(100vh - 4rem);
                margin-top: 0;
            }
        }
        @media (max-width: 640px) {
            .navbar-padding {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
        <nav class="bg-white fixed top-0 right-0 left-0 w-full z-30 
            lg:left-64 lg:w-[calc(100%-16rem)] shadow-md transition-all duration-300">
            
        <div class="navbar-padding px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Bagian Kiri: Menu Toggle (Mobile) & Pencarian -->
                <div class="flex items-center flex-1 min-w-0">
                    <!-- Menu Toggle untuk Mobile -->
                    <button id="navbar-sidebar-toggle" class="lg:hidden p-2 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none mr-1">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    
                   <!-- Logo -->
                    <div class="hidden sm:flex items-center flex-shrink-0 ml-2 lg:ml-4 mr-3 lg:mr-4">
                        <div class="bg-gradient-to-tl from-purple-dark to-pink-dark h-8 w-8 rounded-lg flex items-center justify-center">
                            <i class="fas fa-book text-white text-sm"></i>
                        </div>
                        <span class="ml-2 text-lg font-bold text-purple-dark">Perpustakaan</span>
                    </div>

                    <!-- Pencarian Desktop -->
                    <div class="hidden lg:block ml-2 relative flex-1 max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-sm" placeholder="Cari buku, anggota, atau transaksi...">
                    </div>
                    
                    <!-- Ikon Pencarian Mobile -->
                    <button class="lg:hidden p-2 rounded-md text-gray-500 hover:text-gray-700 focus:outline-none ml-auto" id="mobile-search-button">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                </div>

                <!-- Bagian Kanan: Notifikasi & Profil -->
                <div class="flex items-center space-x-1 sm:space-x-2 lg:space-x-4 flex-shrink-0">
                    <!-- Notifikasi -->
                    <div class="relative" id="notification-container">
                        <button class="p-2 rounded-full text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 relative" id="notification-button">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <!-- Popup Notifikasi -->
                        <div class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md popup-shadow border border-gray-200 dropdown-transition transform opacity-0 scale-95 popup-mobile lg:popup-normal" id="notification-popup">
                            <div class="p-4 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold text-gray-800">Notifikasi</h3>
                                    <span class="text-xs text-purple-dark cursor-pointer hover:underline">Tandai semua sudah dibaca</span>
                                </div>
                            </div>
                            <div class="max-h-80 overflow-y-auto">
                                <!-- Item Notifikasi 1 -->
                                <div class="p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-book text-blue-500"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Peminjaman buku baru</p>
                                            <p class="text-sm text-gray-500">Anggota "Ahmad" meminjam "Laskar Pelangi"</p>
                                            <p class="text-xs text-gray-400 mt-1">5 menit yang lalu</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Item Notifikasi 2 -->
                                <div class="p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                                <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Buku terlambat</p>
                                            <p class="text-sm text-gray-500">"Siti" terlambat mengembalikan "Bumi Manusia"</p>
                                            <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Item Notifikasi 3 -->
                                <div class="p-4 hover:bg-gray-50 cursor-pointer">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                <i class="fas fa-user-plus text-green-500"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Anggota baru</p>
                                            <p class="text-sm text-gray-500">"Rina" telah terdaftar sebagai anggota baru</p>
                                            <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 border-t border-gray-200 text-center">
                                <a href="#" class="text-sm text-purple-dark font-medium hover:underline">Lihat semua notifikasi</a>
                            </div>
                        </div>
                    </div>

                    <!-- Pesan -->
                    <div class="relative" id="message-container">
                        <button class="p-2 rounded-full text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500 relative" id="message-button">
                            <i class="fas fa-envelope text-lg"></i>
                            <span class="notification-badge">5</span>
                        </button>
                        
                        <!-- Popup Pesan -->
                        <div class="hidden absolute right-0 mt-2 w-80 bg-white rounded-md popup-shadow border border-gray-200 dropdown-transition transform opacity-0 scale-95 popup-mobile lg:popup-normal" id="message-popup">
                            <div class="p-4 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold text-gray-800">Pesan</h3>
                                    <span class="text-xs text-purple-dark cursor-pointer hover:underline">Tandai semua sudah dibaca</span>
                                </div>
                            </div>
                            <div class="max-h-80 overflow-y-auto">
                                <!-- Item Pesan 1 -->
                                <div class="p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                                <i class="fas fa-user text-purple-500"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Budi Santoso</p>
                                            <p class="text-sm text-gray-500">Apakah buku "Pulang" sudah tersedia?</p>
                                            <p class="text-xs text-gray-400 mt-1">10 menit yang lalu</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Item Pesan 2 -->
                                <div class="p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center">
                                                <i class="fas fa-user text-pink-500"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Sari Indah</p>
                                            <p class="text-sm text-gray-500">Saya ingin memperpanjang peminjaman buku</p>
                                            <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Item Pesan 3 -->
                                <div class="p-4 hover:bg-gray-50 cursor-pointer">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                <i class="fas fa-user text-indigo-500"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Rizky Pratama</p>
                                            <p class="text-sm text-gray-500">Terima kasih, pelayanan perpustakaan sangat baik</p>
                                            <p class="text-xs text-gray-400 mt-1">3 jam yang lalu</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 border-t border-gray-200 text-center">
                                <a href="#" class="text-sm text-purple-dark font-medium hover:underline">Lihat semua pesan</a>
                            </div>
                        </div>
                    </div>

                    <!-- Profil Dropdown -->
<div class="relative" id="profile-dropdown">
    <button class="flex items-center text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500/50 hover:bg-white/80 px-3 py-2 transition-all duration-200 hover:shadow-md border border-transparent hover:border-purple-100" id="user-menu-button">
        <div class="h-9 w-9 rounded-full bg-gradient-to-tl from-purple-dark to-pink-dark flex items-center justify-center text-white font-semibold shadow-lg">
            <i class="fas fa-user text-sm"></i>
        </div>
        <span class="ml-3 text-gray-800 font-medium hidden lg:block">Admin User</span>
        <i class="fas fa-chevron-down ml-2 text-gray-500 text-xs hidden lg:block transition-transform duration-200" id="chevron-icon"></i>
    </button>
    
    <!-- Dropdown Menu -->
    <div class="hidden origin-top-right absolute right-0 mt-3 w-56 rounded-xl shadow-2xl bg-white/95 backdrop-blur-lg border border-gray-100 focus:outline-none dropdown-transition transform opacity-0 scale-95 popup-mobile lg:popup-normal z-50" id="dropdown-menu">
        <div class="py-2" role="none">
            <!-- Header Profil -->
            <div class="px-4 py-3 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-pink-50 rounded-t-xl">
                <p class="text-sm font-semibold text-gray-900">Admin User</p>
                <p class="text-xs text-gray-600 mt-1">admin@perpustakaan.com</p>
            </div>
            
            <!-- Menu Items -->
            <div class="py-2 space-y-1">
                <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-all duration-200 group border-l-4 border-transparent hover:border-purple-500">
                    <div class="w-6 h-6 flex items-center justify-center mr-3">
                        <i class="fas fa-user-circle text-purple-500"></i>
                    </div>
                    <span class="font-medium">Profile</span>
                </a>
                
                <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 group border-l-4 border-transparent hover:border-blue-500">
                    <div class="w-6 h-6 flex items-center justify-center mr-3">
                        <i class="fas fa-cog text-blue-500"></i>
                    </div>
                    <span class="font-medium">Settings</span>
                </a>
            </div>
            
            <!-- Divider -->
            <div class="border-t border-gray-100 my-1"></div>
            
            <!-- Footer -->
            <div class="px-4 py-2 text-xs text-gray-500 text-center">
                Status: <span class="text-green-600 font-medium">Aktif</span>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- Pencarian Mobile (Tersembunyi secara default) -->
<div class="hidden lg:hidden mobile-search-container" id="mobile-search">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
        </div>
        <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-sm transition-all duration-200" placeholder="Cari buku, anggota, atau transaksi...">
    </div>
</div>
</div>
</nav>

<script>
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
</script>
</body>
</html><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/components/navbarAdmin.blade.php ENDPATH**/ ?>