<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Warna Primary - Hijau Muda dengan gradasi
                        'primary-dark': '#8a9a55',
                        'primary-medium': '#A4B465',
                        'primary-light': '#b8c685',
                        'primary-pale': '#f0f4e0',
                        'primary-bg': '#f8faf0',
                        'primary-text': '#5a6d3a'
                    }
                }
            }
        }
    </script>
    <style>
        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border: 2px solid #8a9a55;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .message-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: linear-gradient(135deg, #4dabf7 0%, #339af0 100%);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border: 2px solid #8a9a55;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .popup-shadow {
            box-shadow: 0 20px 40px rgba(138, 154, 85, 0.15);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #8a9a55, #A4B465);
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #A4B465, #b8c685);
        }
        
        .hover-lift {
            transition: all 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(138, 154, 85, 0.15);
        }
        
        @keyframes subtle-pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .pulse-subtle {
            animation: subtle-pulse 2s infinite;
        }
        
        /* Dropdown Styles - MOBILE OPTIMIZED */
        .dropdown-container {
            position: relative;
        }
        
        .dropdown-menu {
            position: fixed;
            z-index: 9999;
            background-color: #fff;
            border-radius: 0.75rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px) scale(0.95);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
            max-height: 85vh;
            overflow-y: auto;
        }
        
        /* Mobile: Full width dropdown */
        @media (max-width: 639px) {
            .dropdown-menu {
                left: 0.5rem !important;
                right: 0.5rem !important;
                width: calc(100vw - 1rem) !important;
                max-width: none !important;
                top: 5.5rem !important;
            }
            
            .dropdown-menu.show {
                transform: translateY(0) scale(1);
            }
        }
        
        /* Tablet */
        @media (min-width: 640px) and (max-width: 1023px) {
            .dropdown-menu {
                position: absolute;
                top: calc(100% + 0.5rem);
                right: 0;
                left: auto;
                width: 350px;
                max-width: 90vw;
            }
        }
        
        /* Desktop */
        @media (min-width: 1024px) {
            .dropdown-menu {
                position: absolute;
                top: calc(100% + 0.5rem);
                right: 0;
                left: auto;
                width: 380px;
                max-width: 90vw;
            }
        }
        
        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }
        
        /* Navbar padding responsive */
        @media (max-width: 639px) {
            .navbar-padding {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            
            .navbar-icon-spacing {
                gap: 0.25rem;
            }
            
            .navbar-height {
                height: 70px;
            }
        }
        
        @media (min-width: 640px) and (max-width: 1023px) {
            .navbar-padding {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .navbar-height {
                height: 80px;
            }
        }
        
        @media (min-width: 1024px) {
            .navbar-padding {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
            
            .navbar-height {
                height: 85px;
            }
        }
        
        /* Optimize dropdown content for mobile */
        @media (max-width: 639px) {
            .dropdown-content {
                max-height: 60vh;
            }
            
            .notification-item,
            .message-item,
            .profile-item {
                padding: 0.875rem 1rem;
            }
            
            .mobile-only {
                display: block;
            }
            
            .desktop-only {
                display: none;
            }
        }
        
        @media (min-width: 640px) {
            .mobile-only {
                display: none;
            }
            
            .desktop-only {
                display: block;
            }
        }
        
        /* Improve touch targets for mobile */
        @media (max-width: 639px) {
            .touch-target {
                min-height: 44px;
                min-width: 44px;
            }
            
            .icon-button {
                padding: 10px;
            }
        }
        
        /* Smooth animations */
        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-primary-dark to-primary-medium fixed top-0 right-0 left-0 w-full z-30 
        lg:left-64 lg:w-[calc(100%-16rem)] shadow-lg transition-all duration-300 border-b border-primary-light/20">
        
        <div class="navbar-padding">
            <div class="flex justify-between items-center navbar-height">
                <!-- Bagian Kiri -->
                <div class="flex items-center flex-1 min-w-0">
                    <!-- Hamburger Menu - Mobile Only -->
                    <button id="navbar-sidebar-toggle" class="lg:hidden p-2 rounded-lg text-primary-pale hover:text-white hover:bg-primary-light/30 focus:outline-none transition-all duration-200 touch-target icon-button">
                        <i class="fas fa-bars text-lg"></i>
                    </button>

                    <!-- Logo & Brand - Desktop Only -->
                    <div class="hidden lg:flex items-center flex-shrink-0 ml-2 mr-6">
                        <div class="bg-white/20 h-8 w-8 rounded-lg flex items-center justify-center">
                            <i class="fas fa-book-open text-white text-sm"></i>
                        </div>
                        <span class="ml-2 text-lg font-bold text-white">Perpustakaan</span>
                    </div>
                </div>

                <!-- Bagian Kanan -->
                <div class="flex items-center navbar-icon-spacing space-x-1 sm:space-x-2 flex-shrink-0 ml-2">
                    <!-- Notifikasi -->
                    <div class="relative dropdown-container">
                        <button class="p-2 rounded-full text-primary-pale hover:text-white hover:bg-primary-light/30 focus:outline-none focus:ring-2 focus:ring-white/50 relative transition-all duration-200 touch-target icon-button" id="notification-button">
                            <i class="fas fa-bell text-base sm:text-lg"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <div class="dropdown-menu popup-shadow border border-primary-pale/50 glass-effect" id="notification-popup">
                            <div class="p-4 border-b border-primary-pale/30 bg-gradient-to-r from-primary-pale to-white rounded-t-xl">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-base sm:text-lg font-bold text-primary-text flex items-center">
                                        <i class="fas fa-bell mr-2 text-primary-medium"></i>
                                        Notifikasi
                                    </h3>
                                    <span class="text-xs text-primary-medium cursor-pointer hover:underline font-medium flex items-center">
                                        <i class="fas fa-check-double mr-1"></i>
                                        <span class="hidden sm:inline">Tandai semua</span>
                                        <span class="sm:hidden">Semua</span>
                                    </span>
                                </div>
                            </div>
                            <div class="dropdown-content overflow-y-auto custom-scrollbar">
                                <div class="notification-item p-3 sm:p-4 border-b border-primary-pale/30 hover:bg-primary-pale/50 cursor-pointer transition-all duration-200 group">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="h-9 w-9 sm:h-10 sm:w-10 rounded-full bg-blue-100 flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                                <i class="fas fa-book text-blue-500 text-sm"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3 flex-1 min-w-0">
                                            <div class="flex justify-between items-start gap-2">
                                                <p class="text-sm font-semibold text-gray-900 truncate">Peminjaman buku baru</p>
                                                <span class="text-xs text-primary-medium bg-primary-pale/50 px-2 py-1 rounded-full font-medium whitespace-nowrap">Baru</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mt-1">Anggota "Ahmad" meminjam "Laskar Pelangi"</p>
                                            <p class="text-xs text-gray-400 mt-2 flex items-center">
                                                <i class="fas fa-clock mr-1"></i> 5 menit yang lalu
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="notification-item p-3 sm:p-4 border-b border-primary-pale/30 hover:bg-primary-pale/50 cursor-pointer transition-all duration-200 group">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="h-9 w-9 sm:h-10 sm:w-10 rounded-full bg-yellow-100 flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                                <i class="fas fa-exclamation-triangle text-yellow-500 text-sm"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3 flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900">Buku terlambat</p>
                                            <p class="text-sm text-gray-600 mt-1">"Siti" terlambat mengembalikan "Bumi Manusia"</p>
                                            <p class="text-xs text-gray-400 mt-2 flex items-center">
                                                <i class="fas fa-clock mr-1"></i> 1 jam yang lalu
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="notification-item p-3 sm:p-4 hover:bg-primary-pale/50 cursor-pointer transition-all duration-200 group">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="h-9 w-9 sm:h-10 sm:w-10 rounded-full bg-green-100 flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                                <i class="fas fa-user-plus text-green-500 text-sm"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3 flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900">Anggota baru</p>
                                            <p class="text-sm text-gray-600 mt-1">"Rina" telah terdaftar sebagai anggota baru</p>
                                            <p class="text-xs text-gray-400 mt-2 flex items-center">
                                                <i class="fas fa-clock mr-1"></i> 2 jam yang lalu
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 border-t border-primary-pale/30 bg-white rounded-b-xl">
                                <a href="#" class="flex items-center justify-center text-sm font-semibold text-primary-medium hover:text-primary-dark transition-colors duration-200 py-2 rounded-lg hover:bg-primary-pale/50">
                                    <i class="fas fa-list mr-2"></i>
                                    Lihat semua notifikasi
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Pesan -->
                    <div class="relative dropdown-container">
                        <button class="p-2 rounded-full text-primary-pale hover:text-white hover:bg-primary-light/30 focus:outline-none focus:ring-2 focus:ring-white/50 relative transition-all duration-200 touch-target icon-button" id="message-button">
                            <i class="fas fa-envelope text-base sm:text-lg"></i>
                            <span class="message-badge">5</span>
                        </button>
                        
                        <div class="dropdown-menu popup-shadow border border-primary-pale/50 glass-effect" id="message-popup">
                            <div class="p-4 border-b border-primary-pale/30 bg-gradient-to-r from-primary-pale to-white rounded-t-xl">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-base sm:text-lg font-bold text-primary-text flex items-center">
                                        <i class="fas fa-envelope mr-2 text-primary-medium"></i>
                                        Pesan
                                    </h3>
                                    <span class="text-xs text-primary-medium cursor-pointer hover:underline font-medium flex items-center">
                                        <i class="fas fa-check-double mr-1"></i>
                                        <span class="hidden sm:inline">Tandai semua</span>
                                        <span class="sm:hidden">Semua</span>
                                    </span>
                                </div>
                            </div>
                            <div class="dropdown-content overflow-y-auto custom-scrollbar">
                                <div class="message-item p-3 sm:p-4 border-b border-primary-pale/30 hover:bg-primary-pale/50 cursor-pointer transition-all duration-200 group">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="h-9 w-9 sm:h-10 sm:w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center group-hover:scale-110 transition-transform duration-200 text-white font-semibold text-sm">
                                                BS
                                            </div>
                                        </div>
                                        <div class="ml-3 flex-1 min-w-0">
                                            <div class="flex justify-between items-start gap-2">
                                                <p class="text-sm font-semibold text-gray-900 truncate">Budi Santoso</p>
                                                <span class="text-xs text-primary-medium bg-primary-pale/50 px-2 py-1 rounded-full font-medium whitespace-nowrap">Baru</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">Apakah buku "Pulang" sudah tersedia?</p>
                                            <p class="text-xs text-gray-400 mt-2 flex items-center">
                                                <i class="fas fa-clock mr-1"></i> 10 menit yang lalu
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="message-item p-3 sm:p-4 border-b border-primary-pale/30 hover:bg-primary-pale/50 cursor-pointer transition-all duration-200 group">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="h-9 w-9 sm:h-10 sm:w-10 rounded-full bg-gradient-to-br from-purple-400 to-purple-500 flex items-center justify-center group-hover:scale-110 transition-transform duration-200 text-white font-semibold text-sm">
                                                SI
                                            </div>
                                        </div>
                                        <div class="ml-3 flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 truncate">Sari Indah</p>
                                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">Saya ingin memperpanjang peminjaman buku</p>
                                            <p class="text-xs text-gray-400 mt-2 flex items-center">
                                                <i class="fas fa-clock mr-1"></i> 1 jam yang lalu
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="message-item p-3 sm:p-4 hover:bg-primary-pale/50 cursor-pointer transition-all duration-200 group">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="h-9 w-9 sm:h-10 sm:w-10 rounded-full bg-gradient-to-br from-green-400 to-green-500 flex items-center justify-center group-hover:scale-110 transition-transform duration-200 text-white font-semibold text-sm">
                                                RP
                                            </div>
                                        </div>
                                        <div class="ml-3 flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 truncate">Rizky Pratama</p>
                                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">Terima kasih, pelayanan perpustakaan sangat baik</p>
                                            <p class="text-xs text-gray-400 mt-2 flex items-center">
                                                <i class="fas fa-clock mr-1"></i> 3 jam yang lalu
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 border-t border-primary-pale/30 bg-white rounded-b-xl">
                                <a href="#" class="flex items-center justify-center text-sm font-semibold text-primary-medium hover:text-primary-dark transition-colors duration-200 py-2 rounded-lg hover:bg-primary-pale/50">
                                    <i class="fas fa-list mr-2"></i>
                                    Lihat semua pesan
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Profil Dropdown -->
                    <div class="relative dropdown-container">
                        <button class="flex items-center text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-white/50 hover:bg-primary-light/30 px-2 sm:px-3 py-2 transition-all duration-200 group touch-target" id="user-menu-button">
                            <div class="h-8 w-8 sm:h-9 sm:w-9 rounded-full bg-gradient-to-tl from-white/20 to-white/10 border border-white/30 flex items-center justify-center text-white font-semibold shadow-lg group-hover:scale-105 transition-transform duration-200">
                                <i class="fas fa-user text-xs sm:text-sm"></i>
                            </div>
                            <div class="ml-2 sm:ml-3 text-left hidden lg:block">
                                <p class="text-white font-semibold text-sm">Admin User</p>
                                <p class="text-primary-pale/80 text-xs">Administrator</p>
                            </div>
                            <i class="fas fa-chevron-down ml-2 text-primary-pale/80 text-xs hidden lg:block transition-transform duration-200" id="chevron-icon"></i>
                        </button>
                        
                        <div class="dropdown-menu shadow-2xl border border-primary-pale/30 glass-effect" id="dropdown-menu">
                            <div class="p-4 sm:p-6 bg-gradient-to-br from-primary-dark to-primary-medium rounded-t-2xl text-white">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 sm:h-14 sm:w-14 rounded-full bg-white/20 border border-white/30 flex items-center justify-center text-white text-lg sm:text-xl font-bold shadow-lg">
                                        <i class="fas fa-user-crown"></i>
                                    </div>
                                    <div class="ml-3 sm:ml-4 min-w-0 flex-1">
                                        <h3 class="font-bold text-base sm:text-lg truncate text-white">Admin User</h3>
                                        <p class="text-white/80 text-xs sm:text-sm truncate">admin@perpustakaan.com</p>
                                    </div>
                                </div>
                                <div class="mt-3 sm:mt-4 flex items-center justify-between">
                                    <span class="text-white/80 text-sm flex items-center">
                                        <i class="fas fa-circle text-green-300 mr-2 text-xs"></i>
                                        Status:
                                    </span>
                                    <span class="bg-white/20 px-3 py-1 rounded-full text-xs font-semibold flex items-center pulse-subtle">
                                        Aktif
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-3 sm:p-4 space-y-2">
                                <a href="#" class="profile-item flex items-center justify-between px-3 sm:px-4 py-2.5 sm:py-3 text-sm text-gray-700 hover:bg-primary-pale/50 hover:text-primary-dark rounded-xl transition-all duration-200 group">
                                    <div class="flex items-center min-w-0 flex-1">
                                        <div class="w-8 h-8 flex items-center justify-center mr-3 bg-primary-pale rounded-lg group-hover:bg-primary-medium group-hover:text-white transition-all duration-200 flex-shrink-0">
                                            <i class="fas fa-question-circle text-primary-medium group-hover:text-white text-sm"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <span class="font-semibold block truncate">Bantuan & Dukungan</span>
                                            <p class="text-xs text-gray-500 hidden sm:block truncate">Pusat bantuan</p>
                                        </div>
                                    </div>
                                    <i class="fas fa-chevron-right text-gray-400 group-hover:text-primary-dark text-xs ml-2 flex-shrink-0"></i>
                                </a>
                            </div>
                            
                            <div class="border-t border-primary-pale/30 mx-4"></div>
                            
                            <div class="p-4">
                                <p class="text-center text-xs text-gray-500 flex items-center justify-center">
                                    <i class="fas fa-clock mr-1"></i>
                                    <span class="hidden sm:inline">Terakhir login: Hari ini, 14:30</span>
                                    <span class="sm:hidden">Login: Hari ini</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notificationBtn = document.getElementById('notification-button');
            const notificationPopup = document.getElementById('notification-popup');
            
            const messageBtn = document.getElementById('message-button');
            const messagePopup = document.getElementById('message-popup');
            
            const profileBtn = document.getElementById('user-menu-button');
            const profileDropdown = document.getElementById('dropdown-menu');
            const chevronIcon = document.getElementById('chevron-icon');
            
            const sidebarToggle = document.getElementById('navbar-sidebar-toggle');

            let currentDropdown = null;

            function closeAllDropdowns() {
                if (notificationPopup) notificationPopup.classList.remove('show');
                if (messagePopup) messagePopup.classList.remove('show');
                if (profileDropdown) {
                    profileDropdown.classList.remove('show');
                    if (chevronIcon) chevronIcon.style.transform = 'rotate(0deg)';
                }
                currentDropdown = null;
            }

            function toggleDropdown(dropdown, isProfile = false) {
                if (currentDropdown === dropdown) {
                    closeAllDropdowns();
                    return;
                }
                
                closeAllDropdowns();
                
                if (dropdown) {
                    dropdown.classList.add('show');
                    currentDropdown = dropdown;
                    
                    if (isProfile && chevronIcon) {
                        chevronIcon.style.transform = 'rotate(180deg)';
                    }
                }
            }

            // Event Listeners
            if (notificationBtn && notificationPopup) {
                notificationBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleDropdown(notificationPopup);
                });
            }

            if (messageBtn && messagePopup) {
                messageBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleDropdown(messagePopup);
                });
            }

            if (profileBtn && profileDropdown) {
                profileBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleDropdown(profileDropdown, true);
                });
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    // Add your sidebar toggle logic here
                    console.log('Sidebar toggle clicked');
                    closeAllDropdowns();
                });
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                const isClickInside = 
                    (notificationBtn && notificationBtn.contains(e.target)) ||
                    (notificationPopup && notificationPopup.contains(e.target)) ||
                    (messageBtn && messageBtn.contains(e.target)) ||
                    (messagePopup && messagePopup.contains(e.target)) ||
                    (profileBtn && profileBtn.contains(e.target)) ||
                    (profileDropdown && profileDropdown.contains(e.target)) ||
                    (sidebarToggle && sidebarToggle.contains(e.target));
                
                if (!isClickInside) {
                    closeAllDropdowns();
                }
            });

            // Close on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeAllDropdowns();
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                closeAllDropdowns();
            });
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/components/navbarAdmin.blade.php ENDPATH**/ ?>