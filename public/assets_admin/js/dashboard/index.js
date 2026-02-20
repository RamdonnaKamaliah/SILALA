let mainChart;

document.addEventListener("DOMContentLoaded", function () {
    function initMainChart(filter = "mingguan") {
        const ctx = document.getElementById("mainChart");
        if (!ctx) return;

        fetch(`/admin/statistik?filter=${filter}`)
            .then((res) => res.json())
            .then((data) => {
                if (mainChart) {
                    mainChart.destroy();
                }

                mainChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: data.labels,
                        datasets: [
                            {
                                label: "Peminjaman",
                                data: data.peminjaman,
                                backgroundColor: "#4a7c3a",
                                borderRadius: 4,
                            },
                            {
                                label: "Pengembalian",
                                data: data.pengembalian,
                                backgroundColor: "#a5c998",
                                borderRadius: 4,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: "top",
                                labels: {
                                    padding: 20,
                                    usePointStyle: true,
                                    pointStyle: "circle",
                                },
                            },
                        },
                        scales: {
                            x: { grid: { display: false } },
                            y: {
                                beginAtZero: true,
                                grid: { borderDash: [3, 3] },
                            },
                        },
                    },
                });
            });
    }

    // LOAD AWAL
    initMainChart();

    // DROPDOWN CHANGE
    const filterSelect = document.getElementById("filterStatistik");
    if (filterSelect) {
        filterSelect.addEventListener("change", function () {
            initMainChart(this.value);
        });
    }
});
