@extends('layout_admin.admin')
@section('pageTitle', 'Admin Dashboard')

@section('content')
    <!doctype html>
    <html lang="id">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard Perpustakaan — Silala</title>

        <!-- Tailwind (CDN for quick preview; in production use compiled assets) -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <style>
            :root {
                --army-green-dark: #2d5016;
                --army-green-medium: #4a7c3a;
                --army-green-light: #6b9c5a;
                --cream: #f5f5e9;
                --beige: #e8e4d5;
            }

            .glass-effect {
                background: rgba(255, 255, 255, 0.28);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.35)
            }

            .card-gradient-border {
                position: relative
            }

            .card-gradient-border::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 3px;
                background: linear-gradient(90deg, var(--army-green-medium), var(--army-green-light));
                border-radius: 6px
            }

            /* small text shadow for contrast on cream bg */
            .text-soft-shadow {
                text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.9)
            }

            /* animation */
            .fade-in {
                opacity: 0;
                transform: translateY(6px);
                transition: all .45s cubic-bezier(.2, .9, .4, 1)
            }

            .fade-in.show {
                opacity: 1;
                transform: none
            }

            /* notification badge */
            .notification-badge {
                position: absolute;
                top: -6px;
                right: -6px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 18px;
                height: 18px;
                border-radius: 999px;
                background: #ef4444;
                color: #fff;
                font-size: 11px;
                font-weight: 700;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12)
            }

            /* mobile tweaks */
            @media (max-width:640px) {
                .mobile-stack {
                    flex-direction: column
                }

                .mobile-center {
                    text-align: center
                }

                .mobile-gap {
                    gap: .5rem
                }
            }
        </style>
    </head>

    <body class="min-h-screen bg-gradient-to-br from-[var(--cream)] to-[var(--beige)] p-4 md:p-6 font-sans text-gray-800">
        <!-- Header big -->
        <div class="glass-effect rounded-2xl p-4 md:p-6 mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <img src="{{ asset('/assets_admin/image/sisapa.png') }}" alt="logo"
                    class="w-20 h-20 rounded-xl object-contain" />
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-[var(--army-green-dark)]">Selamat Datang, Admin 👋
                    </h1>
                    <p class="text-sm text-[#5a6c5d]">Sistem Manajemen Perpustakaan — Silala</p>
                </div>
            </div>

            <div class="text-center">
                <div id="current-time" class="text-lg md:text-2xl font-bold text-[var(--army-green-dark)]">00:00:00</div>
                <div id="current-date" class="text-xs text-[#5a6c5d]">Hari, DD Bulan YYYY</div>
            </div>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            <!-- card: total buku -->
            <div class="card card-gradient-border fade-in bg-white/70 rounded-xl p-4 shadow-md">
                <div class="flex justify-between items-start">
                    <div class="text-xs font-semibold text-[var(--army-green-dark)]">Total Buku</div>
                    <div
                        class="w-9 h-9 rounded-lg flex items-center justify-center text-white bg-[var(--army-green-medium)] shadow-sm">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-[var(--army-green-dark)]">2,543</div>
                        <div class="text-xs text-[#5a6c5d] mt-1 flex items-center"><i
                                class="fa-solid fa-arrow-up text-[#10b981] mr-1 text-xs"></i>+12 dari bulan lalu</div>
                    </div>
                    <div class="w-20">
                        <canvas id="sparkTotalBuku" height="50"></canvas>
                    </div>
                </div>
            </div>

            <!-- card: peminjam aktif -->
            <div class="card card-gradient-border fade-in bg-white/70 rounded-xl p-4 shadow-md">
                <div class="flex justify-between items-start">
                    <div class="text-xs font-semibold text-[var(--army-green-dark)]">Peminjam Aktif</div>
                    <div
                        class="w-9 h-9 rounded-lg flex items-center justify-center text-white bg-[rgba(107,156,90,0.95)] shadow-sm">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-[var(--army-green-dark)]">187</div>
                        <div class="text-xs text-[#5a6c5d] mt-1 flex items-center"><i
                                class="fa-solid fa-arrow-up text-[#10b981] mr-1 text-xs"></i>+8 dari minggu lalu</div>
                    </div>
                    <div class="w-20">
                        <canvas id="sparkPeminjam" height="50"></canvas>
                    </div>
                </div>
            </div>

            <!-- card: buku dipinjam -->
            <div class="card card-gradient-border fade-in bg-white/70 rounded-xl p-4 shadow-md">
                <div class="flex justify-between items-start">
                    <div class="text-xs font-semibold text-[var(--army-green-dark)]">Buku Dipinjam</div>
                    <div
                        class="w-9 h-9 rounded-lg flex items-center justify-center text-white bg-[rgba(143,185,130,0.95)] shadow-sm">
                        <i class="fa-solid fa-book-bookmark"></i>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-[var(--army-green-dark)]">324</div>
                        <div class="text-xs text-[#5a6c5d] mt-1 flex items-center"><i
                                class="fa-solid fa-arrow-up text-[#10b981] mr-1 text-xs"></i>+24 dari kemarin</div>
                    </div>
                    <div class="w-20">
                        <canvas id="sparkDipinjam" height="50"></canvas>
                    </div>
                </div>
            </div>

            <!-- card: e-book -->
            <div class="card card-gradient-border fade-in bg-white/70 rounded-xl p-4 shadow-md">
                <div class="flex justify-between items-start">
                    <div class="text-xs font-semibold text-[var(--army-green-dark)]">E-book Tersedia</div>
                    <div
                        class="w-9 h-9 rounded-lg flex items-center justify-center text-white bg-[rgba(165,201,152,0.95)] shadow-sm">
                        <i class="fa-solid fa-tablet-screen-button"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-2xl font-bold text-[var(--army-green-dark)]">856</div>
                            <div class="text-xs text-[#5a6c5d] mt-1 flex items-center"><i
                                    class="fa-solid fa-download text-[#10b981] mr-1 text-xs"></i>125 unduhan hari ini</div>
                        </div>
                        <div class="w-20">
                            <canvas id="sparkEbook" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Analytics & Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="lg:col-span-2 bg-white/70 rounded-xl p-4 shadow-md glass-effect">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-semibold text-[var(--army-green-dark)]">Statistik Mingguan</h3>
                    <div class="text-xs text-[#5a6c5d]">Perbandingan 7 hari terakhir</div>
                </div>
                <canvas id="mainChart" height="140"></canvas>
            </div>


        </div>

        <!-- Footer small -->

        </div>

        <script>
            // show fade-in for cards
            window.addEventListener('load', () => {
                document.querySelectorAll('.fade-in').forEach((el, i) => {
                    setTimeout(() => el.classList.add('show'), i * 90);
                });
            });

            // waktu real-time
            function updateTime() {
                const now = new Date();
                const timeString = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                const dateString = now.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                document.getElementById('current-time').textContent = timeString;
                document.getElementById('current-date').textContent = dateString;
            }
            setInterval(updateTime, 1000);
            updateTime();

            // Sparkline helper
            function createSpark(id, data, color) {
                const ctx = document.getElementById(id).getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.map((v, i) => i + 1),
                        datasets: [{
                            data: data,
                            fill: false,
                            borderColor: color,
                            borderWidth: 2,
                            pointRadius: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                display: false
                            },
                            y: {
                                display: false
                            }
                        },
                        elements: {
                            line: {
                                tension: 0.3
                            }
                        }
                    }
                });
            }

            // example spark data (replace with real)
            createSpark('sparkTotalBuku', [10, 12, 9, 14, 13, 16, 18], '#3f6212');
            createSpark('sparkPeminjam', [2, 4, 3, 5, 6, 5, 7], '#5d8c3a');
            createSpark('sparkDipinjam', [20, 18, 22, 24, 21, 25, 24], '#7fb56a');
            createSpark('sparkEbook', [5, 7, 6, 8, 9, 10, 12], '#9ecd88');

            // main chart
            const mainCtx = document.getElementById('mainChart').getContext('2d');
            new Chart(mainCtx, {
                type: 'bar',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    datasets: [{
                        label: 'Peminjaman',
                        data: [50, 65, 70, 60, 80, 95, 75],
                        backgroundColor: '#4a7c3a'
                    }, {
                        label: 'Pengembalian',
                        data: [30, 45, 40, 50, 60, 70, 55],
                        backgroundColor: '#a7c68f'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // simple interactions
            document.getElementById('notification-button').addEventListener('click', () => {
                alert('Kamu punya 3 notifikasi. Implementasikan panel notif untuk detail.');
            });
        </script>

    </body>

    </html>
@endsection
