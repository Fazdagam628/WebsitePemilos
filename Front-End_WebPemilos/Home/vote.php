<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PEMILOS 2025</title>
  <link rel="stylesheet" href="../css/styleUser.css">
  <style>
    
  </style>
</head>
<body>

  <!-- HEADER -->
  <div class="header">
    <div class="logo">
      <img src="Screenshot (20).png" alt="Logo">
      <h1>PEMILOS 2025</h1>
    </div>
    <div class="timer">
      <span>TIMER</span>
      <div class="time">05:00</div>
    </div>
  </div>

  <!-- SECTION PILIH CALON -->
  <div id="pilihSection" class="container">
    <!-- CARD 1 -->
    <div class="card">
      <img src="Screenshot (16).png" alt="Calon 1">
    <p>Calon ketua osis<br><strong>Dimas Diky Maulana</strong></p>
  <p>Calon wakil ketua osis<br><strong>Akbar Rizki Maulana</strong></p>
  <button class="btn-pilih" onclick="showKonfirmasi('Screenshot (16).png','Dimas Diky Maulana','Akbar Rizki Maulana')">PILIH</button>
    </div>

    <!-- CARD 2 -->
    <div class="card">
   <img src="Screenshot (16).png" alt="Calon 2">
     <p>Calon ketua osis<br><strong>Budi Santoso</strong></p>
      <p>Calon wakil ketua osis<br><strong>Andi Pratama</strong></p>
  <button class="btn-pilih" onclick="showKonfirmasi('Screenshot (16).png','Budi Santoso','Andi Pratama')">PILIH</button>
    </div>

    <!-- CARD 3 -->
    <div class="card">
      <img src="Screenshot (16).png" alt="Calon 3">
  <p>Calon ketua osis<br><strong>Siti Nurhaliza</strong></p>
      <p>Calon wakil ketua osis<br><strong>Rina Amelia</strong></p>
     <button class="btn-pilih" onclick="showKonfirmasi('Screenshot (16).png','Siti Nurhaliza','Rina Amelia')">PILIH</button>
    </div>
  </div>

  <!-- SECTION KONFIRMASI -->
  <div id="konfirmasiSection" class="konfirmasi-section">
    <h2>Apakah Kamu yakin dengan pilihanmu?</h2>
   <img id="fotoCalon" src="" alt="Foto Calon">
    <p class="nama-calon" id="namaCalon"></p>

    <div class="btn-group">
      <button class="btn batal" onclick="batalPilih()">Batal</button>
    <button class="btn konfirmasi" onclick="konfirmasiPilih()">Konfirmasi</button>

    </div>
  </div>

  <!-- FOOTER -->
<?php
include('../template/footer_home.php');
?>

  <!-- SCRIPT -->
  <script>
    
    function showKonfirmasi(foto, ketua, wakil) {
      document.getElementById("pilihSection").style.display = "none";
    document.getElementById("konfirmasiSection").style.display = "block";
      document.getElementById("fotoCalon").src = foto;
     document.getElementById("namaCalon").innerHTML = ketua + " &<br>" + wakil;
    }

    function batalPilih() {
      document.getElementById("pilihSection").style.display = "flex";
     document.getElementById("konfirmasiSection").style.display = "none";
    }

    // TIMER
    let waktu = 5 * 60;
    const timeElement = document.querySelector(".time");

 function updateTimer() {
    let menit = Math.floor(waktu / 60);
  let detik = waktu % 60;

      menit = menit < 10 ? "0" + menit : menit;
      detik = detik < 10 ? "0" + detik : detik;

      timeElement.textContent = `${menit}:${detik}`;

      if (waktu > 0) {
        waktu--;
      } else {
        window.location.href = "index.html"; 
      }
    }

    setInterval(updateTimer, 1000);
    updateTimer();
   function konfirmasiPilih() {
  alert("Jawaban Anda berhasil dikirim!");
  window.location.href = "index.html";
}


  </script>
</body>
</html>
