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

  <!-- HEADER -->
 
   <?php
include('../template/header_home.php');
?>
  <!-- CONTAINER -->
  <div class="container-statistik">
    <h2>Hasil Pemilihan</h2>
    <p>Real-time hasil pemilihan OSIS 2025</p>
    <canvas id="voteChart"></canvas>
  </div>

  <script>
    const ctx = document.getElementById('voteChart').getContext('2d');
    const voteChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Bagas dan bagas', 'Bagas dan bagas', 'Bagas dan bagas'],
        datasets: [{
          data: [12, 9, 6], // contoh jumlah suara
          backgroundColor: '#8b0000'
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false }
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
  </script>
<?php
include('../template/footer_home.php');
?>

</body>
</html>
