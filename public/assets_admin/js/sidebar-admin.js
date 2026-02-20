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