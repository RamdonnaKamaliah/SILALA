<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="fe2-navbar bg-gradient-to-r from-primary_dark to-primary_medium 
fixed top-0 right-0 left-0 w-full z-30 
lg:left-64 lg:w-[calc(100%-16rem)] shadow-lg transition-all duration-300 
border-b border-primary_light/20">

        <div class="navbar-padding">
            <div class="flex justify-between items-center navbar-height">
                <!-- Bagian Kiri -->
                <div class="flex items-center flex-1 min-w-0">
                    <!-- Hamburger Menu - Mobile Only -->
                    <button id="navbar-sidebar-toggle" class="lg:hidden p-2 rounded-lg text-primary_pale hover:text-white hover:bg-primary_light/30 focus:outline-none transition-all duration-200 touch-target icon-button">
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

    <!-- PROFILE LINK -->
    <a href="#" 
       class="flex items-center gap-3 rounded-xl hover:bg-primary_light/30 px-3 py-2 transition-all duration-200 group">
        
        <!-- FOTO PROFIL -->
        <div class="relative">
            <div class="h-9 w-9 rounded-full overflow-hidden border-2 border-white/30 shadow-lg group-hover:border-white/50 transition-all">
                <img 
                src="{{ $admin->foto && Storage::disk('public')->exists($admin->foto)
                    ? asset('storage/'.$admin->foto)
                    : asset('default/profile_admin.svg') }}"
                class="w-full h-full object-cover"
                alt="Foto Admin">

            </div>
            <!-- Status Online -->
            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white bg-green_dark"></div>
        </div>

        <!-- NAMA & ROLE (Hidden on mobile) -->
        <div class="hidden lg:block text-left">
            <p class="text-white font-semibold text-sm leading-tight">{{ $admin->name }}</p>
            <p class="text-primary_pale/80 text-xs">{{ $admin->role ?? 'Administrator' }}</p>
        </div>

       
    </a>

    <!-- LOGOUT BUTTON -->
   

</div>
                </div>
            </div>
        </div>
    </nav>

</body>
</html>