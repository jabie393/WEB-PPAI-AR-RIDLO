<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$flashMessage = '';
$flashMessageType = '';

if (isset($_SESSION['flash_message']) && isset($_SESSION['flash_message_type'])) {
    $flashMessage = $_SESSION['flash_message'];
    $flashMessageType = $_SESSION['flash_message_type'];

    // Hapus pesan flash setelah ditampilkan
    unset($_SESSION['flash_message']);
    unset($_SESSION['flash_message_type']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel PPAI AR-RIDLO</title>
    <link rel="icon" href="../assets/logo/logo square.png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Mate+SC&family=Numans&family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sancreek&display=swap" rel="stylesheet">

    <!-- Ikon Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Css -->
    <link rel="stylesheet" href="../css/admin.css">
    
</head>

<!-- Preload -->
<div id="preloader">
    <div class="spinner"></div>
    <div class="progress-text">0%</div>
</div>

<body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md sticky-top py-3 mynavbar">
        <div class="container d-flex justify-content-between align-items-center">
          <!-- Brand Logo dan Nama -->
          <div class="d-flex align-items-center">
            <img src="../assets/logo/logo.png" alt="Logo" style="height: 40px; margin-right: 10px;">
            <a class="navbar-brand mb-0 navtitle" href="../">PPAI AR-RIDLO</a>
          </div>

          <!-- Tombol Toggle -->
          <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
<!-- Offcanvas Menu -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">PPAI AR-RIDLO</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  <ul class="navbar-nav me-3 mb-2 mb-lg-0">
    <a href="../" class="navlink">Beranda</a>
  <a href="logout.php"class="btn d-flex justify-content-center align-items-center w-100 navbtn" type="button">
    <i class="bi bi-box-arrow-right me-2"></i>
        Logout</a>
</ul>
  </div>
</div>
      </nav>

      <div class="container-fluid p-0">
        <div class="container mt-5">
            <h1 class="text-center mb-4">Selamat datang Admin!</h1>

            <!-- Flash Message -->
            <?php if ($flashMessage): ?>
                <div class="alert alert-<?= htmlspecialchars($flashMessageType) ?> alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($flashMessage) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="pageSelect" class="form-label">Pilih Halaman:</label>
                    <select class="form-select" id="pageSelect" name="page">
                        <option value="page/biaya.html">Biaya</option>
                        <option value="page/info_pendaftaran.html">Info Pendaftaran</option>
                        <option value="page/jadwal.html">Jadwal Kegiatan</option>
                        <option value="page/peraturan.html">Peraturan Pesantren</option>
                    </select>
                </div>
                <div class="mb-3 imgselect">
                    <label for="imageUpload" class="form-label">Unggah Gambar:</label>
                    <input type="file" class="form-control" id="imageUpload" name="image" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 uploadbtn">Upload dan Update</button>
            </form>
        </div>
    </div>

<!-- Footer -->
<footer class="text-light py-5">
  <div class="container">
    <div class="row">
      <!-- Logo dan Alamat -->
      <div class="col-md-4 mb-4">
        <div class="col-12 text-center mb-4">
          <img src="../assets/logo/logo panjang.png" alt="logo" class="img-fluid" style="width: 300px;">
        </div>
        <p class="small text-center">Tawang RT 30 RW 06, Sukowilagun, Kec. Kalipare, Kabupaten Malang, Jawa Timur 65166.</p>
      </div>

      <!-- Pendidikan -->
      <div class="col-md-4 mb-4 mt-4">
        <h5 class="mb-3">PENDIDIKAN</h5>
        <ul class="list-unstyled">
          <li><a href="https://www.instagram.com/ppai_arridlo/" class="text-light text-decoration-none" target="_blank">Madrasah Diniyah</a></li>
          <li><a href="https://www.instagram.com/mtsbahrulhuda/" class="text-light text-decoration-none" target="_blank">Madrasah Tsanawiyah (MTS)</a></li>
          <li><a href="https://www.instagram.com/ma_arridlo/" class="text-light text-decoration-none" target="_blank">Madrasah Aliyah</a></li>
        </ul>
      </div>

      <!-- Link Cepat -->
      <div class="col-md-4 mb-4 mt-4">
        <h5 class="mb-3">LINK CEPAT</h5>
        <ul class="list-unstyled">
          <li><a href="#Tentang Kami" class="text-light text-decoration-none">Tentang Kami</a></li>
          <li><a href="#Yayasan SABIL AR-RIDLO" class="text-light text-decoration-none">Yayasan SABIL AR-RIDLO</a></li>
          <li><a href="#Kebijakan Privasi" class="text-light text-decoration-none">Kebijakan Privasi</a></li>
        </ul>
      </div>
    </div>

    <!-- Social Media -->
    <div class="col-12 text-center mt-4">
      <div class="social-media d-flex justify-content-center gap-4">
        <a href="index.html" class="text-light"><i class="bi bi-globe fs-4"></i></a>
        <a href="#Link Facebook" class="text-light"><i class="bi bi-facebook fs-4"></i></a>
        <a href="https://www.instagram.com/ppai_arridlo/" class="text-light"  target="_blank"><i class="bi bi-instagram fs-4"></i></a>
        <a href="#Link Twitter x" class="text-light"><i class="bi bi-twitter fs-4"></i></a>
        <a href="#Link Youtube" class="text-light"><i class="bi bi-youtube fs-4"></i></a>
      </div>
    </div>

    <hr class="my-4 border-light">

    <!-- Footer Bottom -->
    <div class="footer-bottom text-center mt-3">
      <p class="mb-0">Hak Cipta &copy; 2025 PPAI AR-RIDLO. Hak Cipta Dilindungi.</p><br>
      <p class="mb-0">Design by <a href="https://www.instagram.com/kknt18_ar.ridlo/" target="_blank">KKN-T 18 UNIRA</a>:</p>
      <p class="mb-0">DPL: <a href="https://www.instagram.com/fiya_phiyoul/" target="_blank">Wafiyatu Maslahah, M.Pd.</a></p>
      <p class="mb-0">Member: 
        <a href="https://www.instagram.com/jabie.png/" target="_blank">Fahd,</a>
        <a href="https://www.instagram.com/abdul_aziis22/" target="_blank">Abdul,</a>
        <a href="https://www.instagram.com/aditya.phs/" target="_blank">Adit,</a>
        <a href="https://www.instagram.com/zekisetiawan1922/" target="_blank">Zeki,</a>
        <a href="https://www.instagram.com/adeardiansyaah/" target="_blank">Ade,</a>
        <a href="https://www.instagram.com/swxrdhana_aji/" target="_blank">Aji,</a>
        <a href="https://www.instagram.com/ramdfks/" target="_blank">Rama,</a>
        <a href="#abdus">Abdus,</a>
        <a href="https://www.instagram.com/erika.pramudy/" target="_blank">Erika,</a>
        <a href="https://www.instagram.com/lailaa.qfr/" target="_blank">Firli,</a>
        <a href="https://www.instagram.com/firnandaulfa_02/" target="_blank">Firnanda,</a>
        <a href="https://www.instagram.com/pemilik_scorpio/" target="_blank">Fihan,</a>
        <a href="https://www.instagram.com/layla_10032/" target="_blank">Laila,</a>
        <a href="https://www.instagram.com/lutfiaakamila/" target="_blank">Lutfi,</a>
        <a href="https://www.instagram.com/lailifattahulmaulidia/" target="_blank">Laili.</a>
      </p>
    </div>
  </div>
</footer>

    <!-- JavaScript -->
    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
