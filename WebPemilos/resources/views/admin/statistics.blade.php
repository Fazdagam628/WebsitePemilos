<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEMILOS 2025 - Hasil Pemilihan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

    </style>
</head>

<body>
    @include('layouts.header_home')
    <!-- CONTAINER -->
    <div class="container-statistik">
        <h2>Hasil Pemilihan</h2>
        <p>Real-time hasil pemilihan OSIS 2025</p>
        <canvas id="voteChart"></canvas>
    </div>
    <script>
        const ctx = document.getElementById('voteChart').getContext('2d');
        let chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [], // kosong dulu
                datasets: [{
                    label: 'Jumlah Suara',
                    data: [],
                    backgroundColor: [
                        '#8b0000'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    },
                    title: {
                        display: true,
                        text: 'Hasil Perhitungan Suara Kandidat'
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#8b0000',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        grid: {
                            color: '#d3a6a6'
                        },
                        ticks: {
                            color: '#8b0000'
                        }
                    }
                }
            }
        });

        function loadData() {
            fetch("{{ route('admin.getData') }}?t=" + new Date().getTime())
                .then(response => response.json())
                .then(result => {
                    chart.data.labels = result.labels;
                    chart.data.datasets[0].data = result.data;
                    chart.update();
                });
        }

        loadData(); // ambil data pertama
        setInterval(loadData, 3000); // update tiap 3 detik
    </script>
    @include('layouts.footer_home')
</body>

</html>