<body class="bg-gray-50">
    <!-- Navbar -->
    <nav
        class="fe2-navbar bg-gradient-to-r from-primary_dark to-primary_medium 
fixed top-0 right-0 left-0 w-full z-30 
lg:left-64 lg:w-[calc(100%-16rem)] shadow-lg transition-all duration-300 
border-b border-primary_light/20">

        <div class="navbar-padding">
            <div class="flex justify-between items-center navbar-height">
                <!-- Bagian Kiri -->
                <div class="flex items-center flex-1 min-w-0">
                    <!-- Hamburger Menu - Mobile Only -->
                    <button id="navbar-sidebar-toggle"
                        class="lg:hidden p-2 rounded-lg text-primary_pale hover:text-white hover:bg-primary_light/30 focus:outline-none transition-all duration-200 touch-target icon-button">
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
                    <div class="relative" id="adminDropdown">
                        <!-- Avatar -->
                        <button id="avatarBtn" class="flex items-center gap-2 focus:outline-none">
                            <div class="relative">
                                <div
                                    class="h-9 w-9 rounded-full overflow-hidden border-2 border-white/30 shadow-lg hover:border-white/50 transition-all">
                                    <img src="<?php echo e($admin->foto && Storage::disk('public')->exists($admin->foto)
                                        ? asset('storage/' . $admin->foto)
                                        : asset('default/profile_admin.svg')); ?>"
                                        class="w-full h-full object-cover" alt="Foto Admin">
                                </div>
                                <div
                                    class="absolute bottom-0 right-0 w-3 h-3 bg-green_dark rounded-full border-2 border-white">
                                </div>
                            </div>

                            <!-- Nama -->
                            <div class="text-left hidden sm:block">
                                <p class="text-sm font-semibold text-white leading-none">Admin</p>
                                <p class="text-xs text-white/80">Administrator</p>
                            </div>
                        </button>

                        <!-- Dropdown -->
                        <div id="dropdownMenu"
                            class="hidden absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-50 origin-top-right">

                            <!-- Header -->
                            <div class="px-4 py-2 w-full border-b text-center">
                                <p class="text-sm font-semibold text-gray-800"><?php echo e($admin->nama); ?></p>
                                <p class="text-xs text-gray-500 text-center">Administrator</p>
                            </div>

                            <!-- Menu -->
                            <a href="<?php echo e(route('admin.profile.index')); ?>"
                                class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                <i class="fas fa-user w-5 mr-2"></i> Profil
                            </a>


                            <!-- Logout -->
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                    class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                    <i class="fas fa-sign-out-alt w-5 mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>



                </a>

                <!-- LOGOUT BUTTON -->


            </div>
        </div>
        </div>
        </div>
    </nav>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const avatarBtn = document.getElementById("avatarBtn");
            const dropdownMenu = document.getElementById("dropdownMenu");
            const dropdownWrapper = document.getElementById("adminDropdown");

            avatarBtn.addEventListener("click", function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle("hidden");
            });

            document.addEventListener("click", function(e) {
                if (!dropdownWrapper.contains(e.target)) {
                    dropdownMenu.classList.add("hidden");
                }
            });
        });
    </script>

</body>

</html>
<?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/components/navbarAdmin.blade.php ENDPATH**/ ?>