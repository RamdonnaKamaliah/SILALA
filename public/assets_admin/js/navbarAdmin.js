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
    