<header class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full px-4">
    <div class="flex items-center justify-between md:justify-center">
        <!-- Hamburger -->
        <button id="hamburger" class="md:hidden w-8 h-8 flex flex-col justify-center items-center">
            <span class="hamburger-line block w-5 h-0.5 bg-gray-700 mb-1.5"></span>
            <span class="hamburger-line block w-5 h-0.5 bg-gray-700 mb-1.5"></span>
            <span class="hamburger-line block w-5 h-0.5 bg-gray-700"></span>
        </button>

        <!-- Navbar desktop -->
        <nav
            class="relative hidden md:flex items-center space-x-8 text-base font-semibold 
  bg-white text-slate-700 
    shadow-md rounded-full px-8 py-4 transition-colors duration-300">
            <a href="/" class="nav-link text-green-600">Beranda</a>
            <a href="#tentang" class="nav-link">Tentang</a>
            <a href="#rekomendasi" class="nav-link">Rekomendasi</a>
            <a href="#panduan" class="nav-link">Panduan</a>

            @if (auth('admin')->check())
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard Admin</a>
            @elseif(auth('web')->check())
                <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="nav-link text-blue-500">Login</a>
            @endif
        </nav>

        <!-- Theme toggle -->
        <button id="toggle-theme"
            class="w-10 h-10 ml-4 flex items-center justify-center bg-gray-100 rounded-full shadow hover:bg-gray-200 transition-colors duration-200">
            <i class="fas fa-sun text-yellow-500 text-lg dark:hidden"></i>
            <i class="fas fa-moon text-gray-700 text-lg hidden dark:inline"></i>
        </button>
    </div>
</header>

{{-- Pindahkan sidebar & overlay keluar dari header --}}
<div id="sidebar-overlay"
    class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden transition-opacity"></div>

<aside id="sidebar"
    class="sidebar fixed top-0 left-0 h-full w-64 dark:bg-[#2A320F] bg-[#F5ECD5] dark:text-white text-gray-900 shadow-xl z-50 md:hidden transform -translate-x-full transition-transform duration-300">
    <div class="p-6 border-b border-gray-700 flex items-center justify-between">
        <button id="closeSidebar" class="dark:text-white text-gray-900 text-xl">&times;</button>
    </div>

    <nav class="p-4">
        <ul class="space-y-2">
            <li><a href="/"
                    class="flex items-center px-4 py-3 hover:bg-green-700 rounded-lg font-semibold transition-all duration-200"><i
                        class="fas fa-home mr-3"></i>Beranda</a></li>
            <li><a href="#tentang"
                    class="flex items-center px-4 py-3 hover:bg-green-700 rounded-lg font-medium transition-all duration-200"><i
                        class="fas fa-info-circle mr-3"></i>Tentang</a></li>
            <li><a href="#rekomendasi"
                    class="flex items-center px-4 py-3 hover:bg-green-700 rounded-lg font-medium transition-all duration-200"><i
                        class="fas fa-book mr-3"></i>Rekomendasi</a></li>
            <li><a href="#panduan"
                    class="flex items-center px-4 py-3 hover:bg-green-700 rounded-lg font-medium transition-all duration-200"><i
                        class="fas fa-question-circle mr-3"></i>Panduan</a></li>
        </ul>

        <div class="border-t border-gray-700 mt-6 pt-4 space-y-2">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="flex items-center px-4 py-3 hover:bg-green-700 rounded-lg font-medium transition-all duration-200"><i
                        class="fas fa-tachometer-alt mr-3"></i>Dashboard</a>
            @else
                <a href="{{ route('register') }}"
                    class="flex items-center px-4 py-3 hover:bg-green-700 rounded-lg font-medium transition-all duration-200"><i
                        class="fas fa-user-plus mr-3"></i>Register</a>
                <a href="{{ route('login') }}"
                    class="flex items-center px-4 py-3 text-blue-400 hover:bg-blue-50 rounded-lg font-medium transition-all duration-200"><i
                        class="fas fa-sign-in-alt mr-3"></i>Login</a>
            @endauth
        </div>
    </nav>
</aside>
