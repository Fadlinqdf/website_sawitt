<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$page_title = "Dashboard-admin - Website Sawit";
$current_page = "admin";
include('includes/header.php');
?>

<h2 style="text-align:center;">Selamat Datang, Admin</h2>

<h3 style="text-align:center;">Grafik Pendaftaran Magang</h3>
<div style="display:flex; justify-content:center; margin:30px 0;">
    <canvas id="pendaftaranChart" width="700" height="400"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let myChart;

    function loadChart() {
        fetch('data_grafik.php')
            .then(res => res.json())
            .then(data => {
                const ctx = document.getElementById('pendaftaranChart').getContext('2d');

                const colors = data.totals.map(() => {
                    let r = Math.floor(Math.random() * 200);
                    let g = Math.floor(Math.random() * 200);
                    let b = Math.floor(Math.random() * 200);
                    return `rgba(${r}, ${g}, ${b}, 0.7)`;
                });

                if (myChart) {
                    // Update data grafik
                    myChart.data.labels = data.dates;
                    myChart.data.datasets[0].data = data.totals;
                    myChart.data.datasets[0].backgroundColor = colors;
                    myChart.update();
                } else {
                    // Buat grafik pertama kali
                    myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.dates,
                            datasets: [{
                                label: 'Jumlah Pendaftar',
                                data: data.totals,
                                backgroundColor: colors,
                                borderColor: 'rgba(0,0,0,0.5)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: false, // ⚠️ Matikan mode responsif agar ukuran tetap
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: ctx => ctx.raw + " pendaftar"
                                    }
                                }
                            }
                        }
                    });
                }
            })
            .catch(err => console.error("Gagal memuat data grafik:", err));
    }

    // 🔹 Muat pertama kali
    loadChart();

    // 🔁 Auto update setiap 10 detik
    setInterval(loadChart, 10000);
</script>

<?php include('includes/footer.php'); ?>