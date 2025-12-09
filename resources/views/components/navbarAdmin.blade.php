<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Admin Dashboard</title>
    
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

                        <!-- BUTTON PROFIL -->
                        <button class="flex items-center text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-white/50 hover:bg-primary-light/30 px-2 sm:px-3 py-2 transition-all duration-200 group touch-target"
                                id="user-menu-button">

                            <!-- FOTO PROFIL -->
                            <div class="h-8 w-8 sm:h-9 sm:w-9 rounded-full overflow-hidden border border-white/30 shadow-lg group-hover:scale-105 transition-transform duration-200">
                                <img src="{{ $admin->foto ? asset('uploads/admin/'.$admin->foto) : asset('default-user.png') }}"
                                    class="w-full h-full object-cover"
                                    alt="Foto Admin">
                            </div>

                            <!-- NAMA & ROLE -->
                            <div class="ml-2 sm:ml-3 text-left hidden lg:block">
                                <p class="text-white font-semibold text-sm truncate">{{ $admin->name }}</p>
                                <p class="text-primary-pale/80 text-xs truncate">{{ $admin->role ?? 'Administrator' }}</p>
                            </div>

                            <!-- ICON CHEVRON -->
                            <i class="fas fa-chevron-down ml-2 text-primary-pale/80 text-xs hidden lg:block transition-transform duration-200"
                            id="chevron-icon"></i>

                        </button>

                        <!-- DROPDOWN MENU -->
                        <div class="dropdown-menu shadow-2xl border border-primary-pale/30 glass-effect" id="dropdown-menu">

                            <!-- HEADER DROPDOWN -->
                            <div class="p-4 sm:p-6 bg-gradient-to-br from-primary-dark to-primary-medium rounded-t-2xl text-white">
                                <div class="flex items-center">
                                    <!-- FOTO PROFIL BESAR -->
                                    <div class="h-12 w-12 sm:h-14 sm:w-14 rounded-full overflow-hidden border border-white/30 shadow-lg">
                                        <img src="{{ $admin->foto ? asset('uploads/admin/'.$admin->foto) : asset('default-user.png') }}"
                                            class="w-full h-full object-cover"
                                            alt="Foto Admin">
                                    </div>

                                    <!-- NAMA & EMAIL -->
                                    <div class="ml-3 sm:ml-4 min-w-0 flex-1">
                                        <h3 class="font-bold text-base sm:text-lg truncate text-white">{{ $admin->name }}</h3>
                                        <p class="text-white/80 text-xs sm:text-sm truncate">{{ $admin->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- MENU DALAM DROPDOWN -->
                            <div class="p-3 sm:p-4 space-y-2">

                                <!-- LINK KE PROFILE -->
                                <a href="{{ route('admin.profile') }}"
                                class="profile-item flex items-center justify-between px-3 sm:px-4 py-2.5 sm:py-3 text-sm text-gray-700 hover:bg-primary-pale/50 hover:text-primary-dark rounded-xl transition-all duration-200 group">

                                    <div class="flex items-center min-w-0 flex-1">
                                        <div class="w-8 h-8 flex items-center justify-center mr-3 bg-primary-pale rounded-lg group-hover:bg-primary-medium group-hover:text-white transition-all duration-200 flex-shrink-0">
                                            <i class="fas fa-user text-primary-medium group-hover:text-white text-sm"></i>
                                        </div>

                                        <div class="min-w-0">
                                            <span class="font-semibold block truncate">Profile Admin</span>
                                            <p class="text-xs text-gray-500 hidden sm:block truncate">Lihat atau edit profil</p>
                                        </div>
                                    </div>

                                    <i class="fas fa-chevron-right text-gray-400 group-hover:text-primary-dark text-xs ml-2 flex-shrink-0"></i>
                                </a>

                            </div>

                            <div class="border-t border-primary-pale/30 mx-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</body>
</html>