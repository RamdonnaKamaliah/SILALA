<body class="bg-white">
    <!-- Hamburger Button untuk Mobile -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="sidebar-toggle"
            class="p-2 rounded-lg bg-white shadow-md text-primary_dark hover:bg-primary_pale transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden lg:hidden z-30"></div>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 h-screen w-64 bg-gradient-to-b from-primary_dark to-primary_medium shadow-lg z-50 overflow-hidden sidebar-transition sidebar-desktop sidebar-mobile -translate-x-full lg:translate-x-0">
        <!-- Tombol Close (hanya muncul di mobile) -->
        <button id="sidebar-close"
            class="lg:hidden absolute top-4 right-4 p-2 rounded-lg bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 transition-colors z-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="logo-container">
            @php
                $logoAdmin = \App\Models\Setting::getValue('logo_admin_sidebar');
                $currentRoute = Route::currentRouteName();
            @endphp

            @if ($logoAdmin && \Storage::disk('public')->exists('cms/' . $logoAdmin))
                <img src="{{ asset('storage/cms/' . $logoAdmin) }}" alt="BPMS Logo" class="logo-img">
            @else
                <img src="{{ asset('assets_admin/image/BPMSPH-logo.png') }}" alt="BPMS Logo" class="logo-img">
            @endif
        </div>

        <!-- Sidebar Content (Scrollable) -->
        <div class="sidebar-content">
            <ul class="mt-4 space-y-2 px-4 pb-4">

                <!-- Dashboard -->
                <li>
                    <a class="menu-item py-3 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative 
                        {{ $currentRoute == 'superadmin.dashboard' ? 'bg-white/20 backdrop-blur-sm shadow-md border-l-4 border-white' : '' }}"
                        href="{{ route('superadmin.dashboard') }}">
                        <div
                            class="icon-container shadow-soft-2xl mr-3 flex h-9 w-9 items-center justify-center rounded-lg bg-center text-center xl:p-2.5 
                            {{ $currentRoute == 'superadmin.dashboard' ? 'bg-white text-[#8a9a55]' : 'text-[#8a9a55]' }}">
                            <i class="fa-solid fa-house-chimney-window text-lg"></i>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text 
                            {{ $currentRoute == 'superadmin.dashboard' ? 'text-white font-semibold' : '' }}">
                            Dashboard
                        </span>
                    </a>
                </li>

                <!-- AKUN ADMIN -->
                <li>
                    <a class="menu-item py-3 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative 
                        {{ $currentRoute == 'superadmin.akun_admin.index' ? 'bg-white/20 backdrop-blur-sm shadow-md border-l-4 border-white' : '' }}"
                        href="{{ route('superadmin.akun_admin.index') }}">
                        <div
                            class="icon-container shadow-soft-2xl mr-3 flex h-9 w-9 items-center justify-center rounded-lg bg-center text-center xl:p-2.5 
                            {{ $currentRoute == 'superadmin.akun_admin.index' ? 'bg-white text-[#8a9a55]' : 'text-[#8a9a55]' }}">
                            <i class="fa-solid fa-user-gear text-lg"></i>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text 
                            {{ $currentRoute == 'superadmin.akun_admin.index' ? 'text-white font-semibold' : '' }}">
                            Akun Admin
                        </span>
                    </a>
                </li>

                <!-- Akun Pengguna -->
                <li>
                    <a class="menu-item py-3 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative 
                        {{ $currentRoute == 'admin.data_pengguna.index' ? 'bg-white/20 backdrop-blur-sm shadow-md border-l-4 border-white' : '' }}"
                        href="{{ route('superadmin.data_user.index') }}">
                        <div
                            class="icon-container shadow-soft-2xl mr-3 flex h-9 w-9 items-center justify-center rounded-lg bg-center text-center xl:p-2.5 
                            {{ $currentRoute == 'superadmin.data_user.index' ? 'bg-white text-[#8a9a55]' : 'text-[#8a9a55]' }}">
                            <i class="fa-solid fa-user text-lg"></i>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text 
                            {{ $currentRoute == 'superadmin.data_user.index' ? 'text-white font-semibold' : '' }}">
                            Akun Pengguna
                        </span>
                    </a>
                </li>


                <!-- Data Peminjam -->
                <li>
                    <a class="menu-item py-3 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative
                        {{ in_array($currentRoute, ['superadmin.data_peminjam.index', 'superadmin.data_peminjam.show'])
                            ? 'bg-white/20 backdrop-blur-sm shadow-md border-l-4 border-white'
                            : '' }}"
                        href="{{ route('superadmin.data_peminjam.index') }}">

                        <div
                            class="icon-container shadow-soft-2xl mr-3 flex h-9 w-9 items-center justify-center rounded-lg bg-center text-center xl:p-2.5
                            {{ in_array($currentRoute, ['admin.data_peminjam.index', 'admin.data_peminjam.show'])
                                ? 'bg-white text-[#8a9a55]'
                                : 'text-[#8a9a55]' }}">
                            <i class="fa-solid fa-id-card text-lg"></i>
                        </div>

                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text
                            {{ in_array($currentRoute, ['superadmin.data_peminjam.index', 'superadmin.data_peminjam.show'])
                                ? 'text-white font-semibold'
                                : '' }}">
                            Data Peminjam
                        </span>
                    </a>
                </li>


                <!-- Data Buku -->
                <li>
                    <a class="menu-item py-3 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative
                        {{ in_array($currentRoute, [
                            'superadmin.data_buku.index',
                            'admin.data_buku.create',
                            'admin.data_buku.edit',
                            'superadmin.data_buku.show',
                        ])
                            ? 'bg-white/20 backdrop-blur-sm shadow-md border-l-4 border-white'
                            : '' }}"
                        href="{{ route('superadmin.data_buku.index') }}">

                        <div
                            class="icon-container shadow-soft-2xl mr-3 flex h-9 w-9 items-center justify-center rounded-lg bg-center text-center xl:p-2.5
                            {{ in_array($currentRoute, [
                                'superadmin.data_buku.index',
                                'admin.data_buku.create',
                                'admin.data_buku.edit',
                                'superadmin.data_buku.show',
                            ])
                                ? 'bg-white text-[#8a9a55]'
                                : 'text-[#8a9a55]' }}">
                            <i class="fa-solid fa-book text-lg"></i>
                        </div>

                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text
                            {{ in_array($currentRoute, [
                                'superadmin.data_buku.index',
                                'admin.data_buku.create',
                                'admin.data_buku.edit',
                                'superadmin.data_buku.show',
                            ])
                                ? 'text-white font-semibold'
                                : '' }}">
                            Data Buku
                        </span>
                    </a>
                </li>


                <!-- Media Buku -->
                <li>
                    <a class="menu-item py-3 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative 
                        {{ $currentRoute == 'superadmin.media_buku.index' ? 'bg-white/20 backdrop-blur-sm shadow-md border-l-4 border-white' : '' }}"
                        href="{{ route('superadmin.media_buku.index') }}">
                        <div
                            class="icon-container shadow-soft-2xl mr-3 flex h-9 w-9 items-center justify-center rounded-lg bg-center text-center xl:p-2.5 
                            {{ $currentRoute == 'superadmin.media_buku.index' ? 'bg-white text-[#8a9a55]' : 'text-[#8a9a55]' }}">
                            <i class="fa-solid fa-photo-film text-lg"></i>
                        </div>
                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text 
                            {{ $currentRoute == 'superadmin.media_buku.index' ? 'text-white font-semibold' : '' }}">
                            Media Buku
                        </span>
                    </a>
                </li>

                <!-- Data Kategori -->
                <li>
                    <a class="menu-item py-3 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative
                        {{ in_array($currentRoute, [
                            'superadmin.kategori.index',
                            'admin.data_kategori.create',
                            'superadmin.kategori.show',
                            'admin.data_kategori.edit',
                        ])
                            ? 'bg-white/20 backdrop-blur-sm shadow-md border-l-4 border-white'
                            : '' }}"
                        href="{{ route('superadmin.kategori.index') }}">

                        <div
                            class="icon-container shadow-soft-2xl mr-3 flex h-9 w-9 items-center justify-center rounded-lg bg-center text-center xl:p-2.5
                            {{ in_array($currentRoute, [
                                'superadmin.kategori.index',
                                'admin.data_kategori.create',
                                'superadmin.kategori.show',
                                'admin.data_kategori.edit',
                            ])
                                ? 'bg-white text-[#8a9a55]'
                                : 'text-[#8a9a55]' }}">
                            <i class="fa-solid fa-tags text-lg"></i>
                        </div>

                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text
                            {{ in_array($currentRoute, [
                                'superadmin.kategori.index',
                                'admin.data_kategori.create',
                                'superadmin.kategori.show',
                                'admin.data_kategori.edit',
                            ])
                                ? 'text-white font-semibold'
                                : '' }}">
                            Data Kategori
                        </span>
                    </a>
                </li>



                <!-- Data Arsip -->
                <li>
                    <a class="menu-item py-3 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative
                        {{ in_array($currentRoute, ['superadmin.data_arsip.index', 'superadmin.data_arsip.show'])
                            ? 'bg-white/20 backdrop-blur-sm shadow-md border-l-4 border-white'
                            : '' }}"
                        href="{{ route('superadmin.data_arsip.index') }}">

                        <div
                            class="icon-container shadow-soft-2xl mr-3 flex h-9 w-9 items-center justify-center rounded-lg bg-center text-center xl:p-2.5
                            {{ in_array($currentRoute, ['superadmin.data_arsip.index', 'superadmin.data_arsip.show'])
                                ? 'bg-white text-[#8a9a55]'
                                : 'text-[#8a9a55]' }}">
                            <i class="fa-solid fa-box-archive text-lg"></i>
                        </div>

                        <span
                            class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text
                            {{ in_array($currentRoute, ['superadmin.data_arsip.index', 'superadmin.data_arsip.show'])
                                ? 'text-white font-semibold'
                                : '' }}">
                            Data Arsip
                        </span>
                    </a>
                </li>




                <!-- Logout Menu -->
                <li class="w-full mt-2">
                    <a id="logout-btn"
                        class="menu-item py-3 text-sm my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all duration-200 cursor-pointer group hover:bg-gradient-to-r from-red-500 to-pink-500 hover:text-white shadow-none hover:shadow-lg active:scale-95">
                        <div
                            class="shadow-soft-2xl mr-3 flex h-9 w-9 items-center justify-center rounded-lg bg-white/20 backdrop-blur-sm bg-center text-center xl:p-2.5 group-hover:bg-white/20 transition-all duration-300 text-white">
                            <i class="fa-solid fa-right-from-bracket text-[15px]"></i>
                        </div>
                        <span class="ml-1 duration-300 ease-soft">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Logout Form (Hidden) -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- SweetAlert2 CDN - Minimal untuk loading lebih cepat -->
</body>
