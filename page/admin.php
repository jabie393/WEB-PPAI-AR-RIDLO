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
<body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md sticky-top py-3 mynavbar">
        <div class="container d-flex justify-content-between align-items-center">
          <!-- Brand Logo dan Nama -->
          <div class="d-flex align-items-center">
            <img src="../assets/logo/logo.png" alt="Logo" style="height: 40px; margin-right: 10px;">
            <a class="navbar-brand mb-0 navtitle" href="#">PPAI AR-RIDLO</a>
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
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="../">Beranda</a>
  </li>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
