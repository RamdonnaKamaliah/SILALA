

<div class="lg:hidden fixed top-4 left-4 z-50">
    <button id="sidebar-toggle"
        class="p-2 rounded-lg bg-white shadow-md hover:bg-primary-pale transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>


<div id="sidebar-overlay"
    class="fixed inset-0 bg-black bg-opacity-40 hidden lg:hidden z-30">
</div>


<aside id="sidebar"
    class="fixed top-0 left-0 h-screen w-64
           bg-gradient-to-b from-primary_dark to-primary_medium
           shadow-lg z-50 overflow-hidden
           sidebar-transition sidebar-desktop sidebar-mobile
           -translate-x-full lg:translate-x-0">

    
    <button id="sidebar-close"
        class="lg:hidden absolute top-4 right-4 p-2 rounded-lg
               bg-white/20 backdrop-blur-sm text-white
               hover:bg-white/30 transition-colors z-50">
        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

        <!-- Sidebar Header dengan Logo (Fixed) -->
        <?php
            $adminSidebarLogo = \App\Models\Setting::getValue('admin_sidebar_logo', null);

            $logoPath = $adminSidebarLogo &&
                \Illuminate\Support\Facades\Storage::disk('public')->exists('cms/' . $adminSidebarLogo)
                ? Storage::url('cms/' . $adminSidebarLogo)
                : asset('/assets_admin/image/BPMSPH-logo.png');
        ?>

        <img src="<?php echo e($logoPath); ?>" alt="BPMS Logo" class="logo-img">


        <!-- Sidebar Content (Scrollable) -->
        <div class="sidebar-content">
            <ul class="mt-4 space-y-1 px-4 pb-4">
                <!-- Dashboard -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="<?php echo e(route('admin.dashboard')); ?>">

                        <div
                            class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-center xl:p-2.5 text-[#8a9a55]">
                            <i class="fa-solid fa-house-chimney-window text-lg"></i>
                        </div>

                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">
                            Dashboard
                        </span>
                    </a>
                </li>


                <!-- Akun Pengguna -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="<?php echo e(route('admin.data_pengguna.index')); ?>">

                        <div
                            class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-center xl:p-2.5 text-[#8a9a55]">
                            <i class="fa-solid fa-user-gear text-lg"></i>
                        </div>

                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">
                            Akun Pengguna
                        </span>
                    </a>
                </li>

                <!-- CMS -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="<?php echo e(route('admin.cms_admin.index')); ?>">

                        <div
                            class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-center xl:p-2.5 text-[#8a9a55]">
                            <i class="fa-solid fa-user-gear text-lg"></i>
                        </div>

                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">
                            CMS
                        </span>
                    </a>
                </li>

                <!-- Data Buku -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="<?php echo e(route('admin.data_buku.index')); ?>">

                        <div
                            class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-center xl:p-2.5 text-[#8a9a55]">
                            <i class="fa-solid fa-book-bookmark text-lg"></i>
                        </div>

                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">
                            Data Buku
                        </span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="<?php echo e(route('admin.media.index')); ?>">

                        <div
                            class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-center xl:p-2.5 text-[#8a9a55]">
                            <i class="fa-solid fa-book-bookmark text-lg"></i>
                        </div>

                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">
                            Media Buku
                        </span>
                    </a>
                </li>

                <!-- Data Kategori -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="<?php echo e(route('admin.data_kategori.index')); ?>">

                        <div
                            class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-center xl:p-2.5 text-[#8a9a55]">
                            <i class="fa-solid fa-layer-group text-lg"></i>
                        </div>

                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">
                            Data Kategori
                        </span>
                    </a>
                </li>

                <!-- Data Arsip -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="<?php echo e(route('admin.data_arsip.index')); ?>">

                        <div
                            class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-center xl:p-2.5 text-[#8a9a55]">
                            <i class="fa-solid fa-box-archive text-lg"></i>
                        </div>

                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">
                            Data Arsip
                        </span>
                    </a>
                </li>

                <!-- Data Peminjam -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="<?php echo e(route('admin.data_peminjam.index')); ?>">

                        <div
                            class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center text-center xl:p-2.5 text-[#8a9a55]">
                            <i class="fa-solid fa-id-card text-lg"></i>
                        </div>

                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">
                            Data Peminjam
                        </span>
                    </a>
                </li>

                <!-- Divider -->
                <li class="w-full mt-4">
                    <h6 class="pl-2 text-xs font-bold leading-tight uppercase divider-text">Account pages</h6>
                </li>

                <!-- Logout Menu -->
                <li class="mt-0.5 w-full">
                    <a id="logout-btn"
                        class="menu-item py-2.7 text-sm my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all duration-200 cursor-pointer group bg-transparent hover:bg-gradient-to-r from-red-500 to-pink-500 hover:text-white shadow-none hover:shadow-lg active:scale-95">

                        <div
                            class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white/20 backdrop-blur-sm bg-center text-center xl:p-2.5 group-hover:bg-white/20 transition-all duration-300 text-white">
                            <i class="fa-solid fa-right-from-bracket text-[15px]"></i>
                        </div>

                        <span class="ml-1 duration-300 ease-soft">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <li class="mt-0.5 w-full">
            <a id="logout-btn"
                class="py-2.7 text-sm my-0 mx-4 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all duration-200 text-slate-700 cursor-pointer group bg-transparent hover:bg-gradient-to-r from-red-500 to-pink-500 hover:text-white shadow-none hover:shadow-lg active:scale-95">
                <div
                    class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white/40 bg-center stroke-0 text-center xl:p-2.5 group-hover:bg-white/20 transition-all duration-300">
                    <svg class="text-red-600 group-hover:text-white transition-colors duration-200" width="16px"
                        height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17 16L21 12M21 12L17 8M21 12H7M13 16V17C13 18.6569 11.6569 20 10 20H6C4.34315 20 3 18.6569 3 17V7C3 5.34315 4.34315 4 6 4H10C11.6569 4 13 5.34315 13 7V8"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>

                <span class="ml-1 duration-300 ease-soft">Logout</span>
            </a>
        </li>
        </ul>
    </aside>

    <!-- Logout Form (Hidden) -->
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>

    <!-- SweetAlert2 CDN - Minimal untuk loading lebih cepat -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">

    <script>
        // Sidebar toggle functionality
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarClose = document.getElementById('sidebar-close');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        let isSidebarOpen = false;

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('sidebar-open');
            sidebarOverlay.classList.remove('hidden');
            isSidebarOpen = true;
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('sidebar-open');
            sidebarOverlay.classList.add('hidden');
            isSidebarOpen = false;
        }

        sidebarToggle.addEventListener('click', openSidebar);
        sidebarClose.addEventListener('click', closeSidebar);
        sidebarOverlay.addEventListener('click', closeSidebar);

        // Close sidebar on window resize if it's open and we're on a large screen
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024 && isSidebarOpen) {
                closeSidebar();
            }
        });

        // Logout functionality
        document.getElementById('logout-btn').addEventListener('click', function() {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin keluar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#8a9a55',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });

        // Enhanced Active Menu System
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial active menu based on current path
            setActiveMenu();

            // Add click event to all menu items to close sidebar on mobile and update active state
            document.querySelectorAll('.menu-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    // Skip for logout button
                    if (this.id === 'logout-btn') return;

                    // Update active menu state
                    updateActiveMenu(this);

                    // Close sidebar on mobile after clicking a menu item
                    if (window.innerWidth < 1024) {
                        closeSidebar();
                    }
                });
            });

            // Listen for URL changes (for SPA-like behavior)
            observeUrlChanges();
        });

        // Enhanced function to set active menu based on current path
        function setActiveMenu() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.menu-item');
            let activeItem = null;

            // Remove active class from all items first
            menuItems.forEach(item => {
                item.classList.remove('active');
                const glow = item.querySelector('.active-glow');
                if (glow) glow.remove();
            });

            // Find the best matching menu item
            menuItems.forEach(item => {
                if (item.id === 'logout-btn') return;

                const itemHref = item.getAttribute('href');

                if (!itemHref || itemHref.startsWith('#') || itemHref.startsWith('javascript:')) {
                    return;
                }

                // Check for exact match
                if (itemHref === currentPath) {
                    activeItem = item;
                    return;
                }

                // Check for partial match (for nested routes)
                if (currentPath.startsWith(itemHref) && itemHref !== '/') {
                    // If we haven't found an active item yet, or this is a better match (longer path)
                    if (!activeItem || itemHref.length > activeItem.getAttribute('href').length) {
                        activeItem = item;
                    }
                }
            });

            // Activate the found item
            if (activeItem) {
                updateActiveMenu(activeItem);
            }
        }

        // Function to update active menu state
        function updateActiveMenu(activeItem) {
            // Remove active class from all items
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
                const glow = item.querySelector('.active-glow');
                if (glow) glow.remove();
            });

            // Add active class to clicked item
            activeItem.classList.add('active');

            // Add glow effect
            const glow = document.createElement('span');
            glow.className = 'active-glow';
            activeItem.appendChild(glow);
        }

        // Observe URL changes for SPA-like applications
        function observeUrlChanges() {
            let currentUrl = window.location.href;

            // Check for URL changes every 100ms
            setInterval(() => {
                if (window.location.href !== currentUrl) {
                    currentUrl = window.location.href;
                    setActiveMenu();
                }
            }, 100);

            // Also listen to popstate event (back/forward navigation)
            window.addEventListener('popstate', setActiveMenu);
        }

        // Enhanced touch support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const swipeDistance = touchEndX - touchStartX;

            // Swipe right to open sidebar (only on mobile)
            if (swipeDistance > swipeThreshold && window.innerWidth < 1024 && !isSidebarOpen) {
                openSidebar();
            }

            // Swipe left to close sidebar (only on mobile)
            if (swipeDistance < -swipeThreshold && window.innerWidth < 1024 && isSidebarOpen) {
                closeSidebar();
            }
        }
    </script>
</body>

</html>
<?php /**PATH C:\laragon\www\silala_bpmsph\resources\views\components\sidebarAdmin.blade.php ENDPATH**/ ?>