<!-- Tombol Hamburger -->
<button id="hamburger" class="fixed top-4 left-4 z-50 flex flex-col justify-between w-8 h-6 focus:outline-none md:hidden">
    <span class="block w-full h-[3px] bg-[#626F47] rounded transition-all duration-300"></span>
    <span class="block w-full h-[3px] bg-[#626F47] rounded transition-all duration-300"></span>
    <span class="block w-full h-[3px] bg-[#626F47] rounded transition-all duration-300"></span>
</button>

<!-- Overlay gelap -->
<div id="sidebar-overlay"
    class="fixed inset-0 bg-black bg-opacity-40 hidden opacity-0 transition-opacity duration-300 z-40 md:hidden"></div>

<!-- Sidebar -->
<div id="sidebar"
    class="fixed w-[300px] h-full bg-[var(--green)] border-l-[10px] border-[var(--green)] transition-all duration-500 overflow-hidden transform -translate-x-full md:translate-x-0 z-50 sidebar">

    <!-- Header -->
    <div class="flex items-center justify-between px-4 mt-4 mb-6 text-white">
        <div class="flex items-center gap-2">
            <img src="<?php echo e(asset('assets/logo_kementan.png')); ?>" alt="Logo"
                class="w-12 h-12 rounded-full object-cover" />
            <p class="text-white font-bold text-lg leading-tight">
                PERPUSTAKAAN BPMSPH
            </p>
        </div>
    </div>

    <!-- Profil -->
    <ul id="sidebar-menu" class="space-y-3">
        <li class="relative nav-item rounded-l-[50px] hover:bg-white list-none">
            <a href="<?php echo e(route('user.profil')); ?>"
                class="group relative flex items-center w-full text-[#626F47] transition-all duration-300">

                <div
                    class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
          group-hover:border-transparent group-hover:bg-white">
                    <img src="<?php echo e(asset('assets/Profile.jpg')); ?>" alt="Foto Profil"
                        class="w-20 h-20 rounded-full border-2 border-[#626F47] object-cover shadow-md" />
                    <div class="leading-tight">
                        <p class="font-bold text-[#626F47] text-sm">Rifdatul Aisya</p>
                        <p class="text-xs opacity-80 -mt-[2px]">Rifdah@gmail.com</p>
                    </div>
                </div>
            </a>
        </li>

        <!-- Menu -->
        <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
            <a href="<?php echo e(route('dashboard')); ?>"
                class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
                <div
                    class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
        group-hover:border-transparent group-hover:bg-white">
                    <i class="fa-solid fa-chart-line text-xl"></i>
                    <span class="whitespace-nowrap text-base font-bold">Dashboard</span>
                </div>
            </a>
        </li>

        <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
            <a href="<?php echo e(route('user.daftarbuku')); ?>"
                class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
                <div
                    class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
        group-hover:border-transparent group-hover:bg-white">
                    <i class="fa-solid fa-book text-xl"></i>
                    <span class="whitespace-nowrap text-base font-bold">Buku</span>
                </div>
            </a>
        </li>

        <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
            <a href="<?php echo e(route('user.riwayatbuku')); ?>"
                class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
                <div
                    class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
        group-hover:border-transparent group-hover:bg-white">
                    <i class="fa-solid fa-clock-rotate-left text-xl"></i>
                    <span class="whitespace-nowrap text-base font-bold">Riwayat</span>
                </div>
            </a>
        </li>

        <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
            <a href="<?php echo e(route('user.favorit')); ?>"
                class="group relative flex items-center w-full text-[#626F47] transition-colors duration-300">
                <div
                    class="menu-item flex items-center gap-3 border-[2px] border-[#F5ECD5] bg-[#F5ECD5] rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
        group-hover:border-transparent group-hover:bg-white">
                    <i class="fa-solid fa-bookmark text-xl"></i>
                    <span class="whitespace-nowrap text-base font-bold">Favorit</span>
                </div>
            </a>
        </li>

        <li>
            <div class="h-[1px] bg-gray-300 mx-2 rounded"></div>
        </li>

        <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="w-full">
                <?php echo csrf_field(); ?>
                <button type="submit"
                    class="relative flex items-center w-full text-red-600 hover:text-[var(--green)] transition-colors duration-300">
                    <span class="block min-w-[60px] h-[60px] leading-[60px] text-center text-xl">
                        <i class="fa-solid fa-gear"></i>
                    </span>
                    <span class="block px-[10px] h-[60px] leading-[60px] whitespace-nowrap">
                        Logout
                    </span>
                </button>
            </form>
        </li>
    </ul>
</div>
<?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/components/sidebarUser.blade.php ENDPATH**/ ?>