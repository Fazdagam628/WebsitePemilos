<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Calon OSIS</title>
  <style>
    

  

    
  </style>
</head>
<body>

  <!-- HEADER -->
   <?php
include('../template/header.php');
?>
  <!-- <header>
    <div class="header-left">
      <img src="logo.png" alt="Logo">
      PENDAFTARAN CALON OSIS
    </div>
    <button class="btn-dashboard">Dashboard</button>
  </header> -->

  <!-- FORM -->
  <div class="form-container">
    <form>
      <div class="form-grid">
        <div>
          <label>Nama Ketua</label>
          <input type="text" placeholder="Masukkan nama lengkap dan kelas">
        </div>
        <div>
          <label>Nama Wakil</label>
          <input type="text" placeholder="Masukkan nama lengkap">
        </div>

        <div>
          <label>Visi</label>
          <textarea placeholder="Masukkan Visi"></textarea>
        </div>
        <div>
          <label>Nomor urut</label>
          <input type="text" placeholder="Masukkan nomor urut">

          <label style="margin-top:18px;">Upload Foto</label>
          <input type="file">
        </div>

        <button type="submit" class="btn-submit">Tambah Paslon</button>
        <p class="note">Pastikan data sesuai dan hanya digunakan sekali</p>
      </div>
    </form>
  </div>

  <!-- FOOTER -->
 

</body>
</html>
