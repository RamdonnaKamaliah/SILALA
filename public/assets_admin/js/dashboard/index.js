
    document.addEventListener('DOMContentLoaded', function() {
        // Update waktu dan tanggal
        function updateTime() {
            const now = new Date();
            const timeElement = document.getElementById('current-time');
            const dateElement = document.getElementById('current-date');
            
            if (timeElement) {
                timeElement.textContent = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            }
            
            if (dateElement) {
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                dateElement.textContent = now.toLocaleDateString('id-ID', options);
            }
        }
        
        updateTime();
        setInterval(updateTime, 1000);

        // Inisialisasi sparkline charts
        function initSparklineCharts() {
            const sparkConfig = {
                type: 'line',
                data: {
                    datasets: [{
                        data: [],
                        borderColor: '',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { display: false },
                        y: { display: false }
                    },
                    elements: {
                        point: { radius: 0 }
                    }
                }
            };

            // Sparkline data
            const sparkData = {
                sparkTotalBuku: {
                    data: [12, 15, 10, 14, 16, 18, 20],
                    color: '#4a7c3a'
                },
                sparkPeminjam: {
                    data: [5, 8, 6, 9, 7, 10, 12],
                    color: '#6b9c5a'
                },
                sparkDipinjam: {
                    data: [20, 22, 18, 24, 26, 23, 25],
                    color: '#8fb982'
                },
                sparkEbook: {
                    data: [8, 10, 9, 12, 11, 14, 16],
                    color: '#a5c998'
                }
            };

            // Buat chart untuk setiap sparkline
            Object.keys(sparkData).forEach(id => {
                const canvas = document.getElementById(id);
                if (canvas) {
                    const config = { ...sparkConfig };
                    config.data.datasets[0].data = sparkData[id].data;
                    config.data.datasets[0].borderColor = sparkData[id].color;
                    new Chart(canvas, config);
                }
            });
        }

        // Inisialisasi main chart
        function initMainChart() {
            const ctx = document.getElementById('mainChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                        datasets: [
                            {
                                label: 'Peminjaman',
                                data: [50, 65, 70, 60, 80, 95, 75],
                                backgroundColor: '#4a7c3a',
                                borderRadius: 4
                            },
                            {
                                label: 'Pengembalian',
                                data: [30, 45, 40, 50, 60, 70, 55],
                                backgroundColor: '#a5c998',
                                borderRadius: 4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    pointStyle: 'circle'
                                }
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    borderDash: [3, 3]
                                },
                                ticks: {
                                    callback: function(value) {
                                        return value;
                                    }
                                }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'nearest'
                        }
                    }
                });
            }
        }

        // Panggil fungsi inisialisasi
        initSparklineCharts();
        initMainChart();

        // Animasi fade in untuk cards
        const cards = document.querySelectorAll('.bg-white.rounded-xl');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });