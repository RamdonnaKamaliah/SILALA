<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        'primary-bg': '#f8faf0'
                    }
                }
            }
        }
    </script>
    <style>
        /* Sidebar styling */
        .sidebar-transition {
            transition: all 0.3s ease;
        }
        
        .sidebar-desktop {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        
        /* Active menu item styling dengan efek yang lebih menonjol */
        .menu-item.active {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.9) 100%);
            color: #8a9a55;
            border-left: 4px solid #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
            position: relative;
            z-index: 1;
            font-weight: 700;
            backdrop-filter: blur(10px);
        }
        
        /* Efek glow untuk menu aktif */
        .menu-item.active::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background-color: #ffffff;
            border-radius: 50%;
            box-shadow: 0 0 10px 3px rgba(255, 255, 255, 0.8);
            animation: pulse 2s infinite;
        }
        
        /* Efek background gradient untuk menu aktif */
        .menu-item.active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.1) 100%);
            border-radius: 8px;
            z-index: -1;
        }
        
        /* Icon container dengan gradient putih */
        .icon-container {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.8) 100%);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        /* Active menu icon styling - LEBIH MENONJOL */
        .menu-item.active .icon-container {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.4);
            transform: scale(1.05);
        }
        
        /* Hover effects */
        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            transform: translateX(5px);
            transition: all 0.2s ease;
        }
        
        /* Active menu dengan efek yang lebih menonjol */
        .active-glow {
            position: absolute;
            right: 12px;
            width: 8px;
            height: 8px;
            background-color: #ffffff;
            border-radius: 50%;
            box-shadow: 0 0 8px 2px rgba(255, 255, 255, 0.5);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
                transform: scale(1);
            }
            50% {
                box-shadow: 0 0 0 6px rgba(255, 255, 255, 0.3);
                transform: scale(1.1);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
                transform: scale(1);
            }
        }
        
        /* Animasi slide untuk sidebar mobile */
        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }
        
        @keyframes slideOutLeft {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-100%);
            }
        }
        
        .sidebar-open {
            animation: slideInLeft 0.3s ease-out forwards;
        }
        
        .sidebar-close {
            animation: slideOutLeft 0.3s ease-out forwards;
        }
        
        /* Logo styling */
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            background: linear-gradient(135deg, #8a9a55 0%, #A4B465 100%);
            z-index: 10;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo-img {
            max-width: 120px;
            max-height: 60px;
            object-fit: contain;
        }
                
        /* Sidebar content yang bisa di-scroll */
        .sidebar-content {
            height: calc(100vh - 80px);
            overflow-y: auto;
        }
        
        /* Custom scrollbar untuk sidebar dengan warna putih */
        .sidebar-content::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar-content::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }
        
        .sidebar-content::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.8));
            border-radius: 4px;
        }
        
        .sidebar-content::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 1));
        }
        
        /* Mobile responsive improvements */
        @media (max-width: 1023px) {
            .sidebar-mobile {
                width: 280px;
            }
            
            .menu-item {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
            
            .icon-container {
                width: 32px;
                height: 32px;
                margin-right: 0.75rem;
            }
            
            /* Efek lebih besar di mobile untuk penanda aktif */
            .menu-item.active::after {
                width: 10px;
                height: 10px;
                right: 16px;
            }
        }
        
        /* Efek tambahan untuk menu aktif */
        .menu-item.active .menu-text {
            font-weight: 700;
            letter-spacing: 0.025em;
            color: #8a9a55;
        }
        
        /* Badge notifikasi untuk menu aktif */
        .active-badge {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            color: #8a9a55;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        /* Text color for normal menu items */
        .menu-item {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Icon color adjustment */
        .icon-container svg path {
            fill: #8a9a55;
        }

        /* Divider color */
        .divider-text {
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body class="bg-white">
    <!-- Hamburger Button untuk Mobile -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="sidebar-toggle" class="p-2 rounded-lg bg-white shadow-md text-primary-dark hover:bg-primary-pale transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden lg:hidden z-30"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 h-screen w-64 bg-gradient-to-b from-primary-dark to-primary-medium shadow-lg z-50 overflow-hidden sidebar-transition sidebar-desktop sidebar-mobile -translate-x-full lg:translate-x-0">
        <!-- Tombol Close (hanya muncul di mobile) -->
        <button id="sidebar-close" class="lg:hidden absolute top-4 right-4 p-2 rounded-lg bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 transition-colors z-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        
        <!-- Sidebar Header dengan Logo (Fixed) -->
        <div class="logo-container">
            <img src="{{ asset('/assets_admin/image/BPMSPH-logo.png')}}" alt="BPMS Logo" class="logo-img">
        </div>
        
        <!-- Sidebar Content (Scrollable) -->
        <div class="sidebar-content">
            <ul class="mt-4 space-y-1 px-4 pb-4">
                <!-- Dashboard -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="{{ route('admin.dashboard') }}">
                        <div class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <title>shop</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#8a9a55" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="opacity-60" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                                                <path class="" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">Dashboard</span>
                    </a>
                </li>

                <!-- Akun Pengguna -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="{{ route('admin.data_pengguna.index') }}">
                        <div class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <title>Akun Pengguna</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1869.000000, -293.000000)" fill="#8a9a55" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(153.000000, 2.000000)">
                                                <path class="opacity-60" d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z"></path>
                                                <path d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">Akun Pengguna</span>
                    </a>
                </li>

                <!-- Data Buku -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="{{ route('admin.data_buku.index') }}">
                        <div class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <title>Data Buku</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1869.000000, -293.000000)" fill="#8a9a55" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(153.000000, 2.000000)">
                                                <path class="opacity-60" d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z"></path>
                                                <path d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">Data Buku</span>
                    </a>
                </li>

                <!-- Data Kategori -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="{{ route('admin.data_kategori.index') }}">
                        <div class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <title>Data Kategori</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1869.000000, -293.000000)" fill="#8a9a55" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(153.000000, 2.000000)">
                                                <path class="opacity-60" d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z"></path>
                                                <path d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">Data Kategori</span>
                    </a>
                </li>

                <!-- Data Arsip -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="{{ route('admin.data_arsip.index') }}">
                        <div class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <title>Favorit</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1869.000000, -293.000000)" fill="#8a9a55" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(153.000000, 2.000000)">
                                                <path class="opacity-60" d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z"></path>
                                                <path d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">Data Arsip</span>
                    </a>
                </li>

                <!-- Data Peminjam -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="{{ route('admin.data_peminjam.index') }}">
                        <div class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <title>settings</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2020.000000, -442.000000)" fill="#8a9a55" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(304.000000, 151.000000)">
                                                <polygon class="opacity-60" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                                                <path class="opacity-60" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"></path>
                                                <path d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">Data Peminjam</span>
                    </a>
                </li>

                <!-- Data Denda -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all relative"
                        href="{{ route('admin.data_denda.index') }}">
                        <div class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <title>settings</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2020.000000, -442.000000)" fill="#8a9a55" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(304.000000, 151.000000)">
                                                <polygon class="opacity-60" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                                                <path class="opacity-60" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"></path>
                                                <path d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">Data Denda</span>
                    </a>
                </li>

                <!-- Divider -->
                <li class="w-full mt-4">
                    <h6 class="pl-2 text-xs font-bold leading-tight uppercase divider-text">Account pages</h6>
                </li>

                <!-- E-book -->
                <li class="mt-0.5 w-full">
                    <a class="menu-item py-2.7 text-sm ease-nav-brand my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all"
                        href="#e-book">
                        <div class="icon-container shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <title>customer-support</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1717.000000, -291.000000)" fill="#8a9a55" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(1.000000, 0.000000)">
                                                <path class="opacity-60" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
                                                <path d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                                                <path d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft menu-text">E-book</span>
                    </a>
                </li>

                <!-- Logout Menu -->
                <li class="mt-0.5 w-full">
                    <a id="logout-btn"
                        class="menu-item py-2.7 text-sm my-0 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-all duration-200 cursor-pointer group bg-transparent hover:bg-gradient-to-r from-red-500 to-pink-500 hover:text-white shadow-none hover:shadow-lg active:scale-95">
                        <div
                            class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white/20 backdrop-blur-sm bg-center stroke-0 text-center xl:p-2.5 group-hover:bg-white/20 transition-all duration-300">
                            <svg class="text-white group-hover:text-white transition-colors duration-200" width="16px" height="16px" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17 16L21 12M21 12L17 8M21 12H7M13 16V17C13 18.6569 11.6569 20 10 20H6C4.34315 20 3 18.6569 3 17V7C3 5.34315 4.34315 4 6 4H10C11.6569 4 13 5.34315 13 7V8"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
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
                <svg class="text-red-600 group-hover:text-white transition-colors duration-200" width="16px" height="16px" viewBox="0 0 24 24"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
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
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
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