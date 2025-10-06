<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Calon OSIS</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fae6d6;
      margin: 0;
      padding: 0;
    }

    /* HEADER */
    header {
      background-color: #8b0000;
      color: white;
      padding: 14px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    header img {
      width: 55px;
      height: 55px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 12px;
    }

    .header-left {
      display: flex;
      align-items: center;
      font-weight: bold;
      font-size: 22px;
    }

    .btn-dashboard {
      background: #fff8dc;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      color: #8b0000;
      transition: 0.2s;
    }

    .btn-dashboard:hover {
      background: #ffe9a8;
    }

    /* FORM CONTAINER */
    .form-container {
      background: #fff;
      padding: 35px 40px;
      border-radius: 14px;
      margin: 50px auto;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 92%;
      max-width: 950px;
      margin-top: 150px;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 25px 35px;
    }

    label {
      font-weight: bold;
      margin-bottom: 6px;
      display: block;
      color: #800000;
    }

    input, textarea {
      width: 100%;
      padding: 12px;
      border-radius: 6px;
      border: 1px solid #a33;
      font-size: 15px;
      box-sizing: border-box;
    }

    textarea {
      min-height: 150px;
      resize: none;
    }

    .btn-submit {
      grid-column: span 2;
      padding: 15px;
      background-color: #8b0000;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 17px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.2s;
    }

    .btn-submit:hover {
      background-color: #a10000;
    }

    p.note {
      grid-column: span 2;
      text-align: center;
      font-size: 13px;
      margin-top: 6px;
      color: #a33;
    }

    /* FOOTER */
    footer {
      background-color: #8b0000;
      color: white;
      padding: 14px 24px;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      margin-top: 100px;
      height: 5.5dvh;
    }

    .footer-text {
      font-weight: bold;
      font-size: 15px;
    }

    .footer-btn {
      position: absolute;
      right: 24px;
      background: #fff;
      color: #8b0000;
      border: none;
      padding: 7px 18px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
    }

    .footer-btn:hover {
      background: #f0f0f0;
    }
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
<?php
include('../template/footer_home.php');
?>

</body>
</html>
