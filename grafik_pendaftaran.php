<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Pendaftaran Magang</title>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #1f4f2e;
            margin-bottom: 30px;
        }

        canvas {
            width: 100% !important;
            height: auto !important;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 20px;
            }

            h2 {
                font-size: 1.4em;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>📈 Grafik Pendaftaran Magang</h2>
        <canvas id="pendaftaranChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('pendaftaranChart').getContext('2d');
        let myChart;

        async function loadChart() {
            try {
                const res = await fetch('data_grafik.php');
                const data = await res.json();

                const colors = data.totals.map(() => {
                    const r = Math.floor(Math.random() * 180);
                    const g = Math.floor(Math.random() * 180);
                    const b = Math.floor(Math.random() * 180);
                    return `rgba(${r}, ${g}, ${b}, 0.7)`;
                });

                if (myChart) {
                    // Update data grafik
                    myChart.data.labels = data.dates;
                    myChart.data.datasets[0].data = data.totals;
                    myChart.data.datasets[0].backgroundColor = colors;
                    myChart.update();
                } else {
                    // Buat grafik baru
                    myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.dates,
                            datasets: [{
                                label: 'Jumlah Pendaftaran',
                                data: data.totals,
                                backgroundColor: colors,
                                borderColor: 'rgba(0,0,0,0.7)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    labels: {
                                        font: {
                                            size: 14
                                        }
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: (context) =>
                                            `${context.dataset.label}: ${context.raw} pendaftar`
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                }
            } catch (err) {
                console.error('Gagal memuat grafik:', err);
            }
        }

        // Jalankan pertama kali
        loadChart();

        // Update otomatis tiap 10 detik (10000 ms)
        setInterval(loadChart, 10000);
    </script>

</body>

</html>