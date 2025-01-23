<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Proses upload gambar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $page = $_POST['page'];
    $image = $_FILES['image'];

    if ($image['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $uploadPath = $uploadDir . basename($image['name']);

        if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
            echo "Gambar berhasil diunggah!";
        } else {
            echo "Gagal mengunggah gambar.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel PPAI AR-RIDLO</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
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
    <i class="bi bi-person me-2"></i>
        Logout</a>
</ul>
  </div>
</div>
      </nav>

    <div class="container-fluid p-0">

        <div class="container mt-5">
            <h1 class="text-center mb-4">Admin Panel</h1>
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
                <div class="mb-3">
                    <label for="imageUpload" class="form-label">Unggah Gambar:</label>
                    <input type="file" class="form-control" id="imageUpload" name="image" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 uploadbtn">Upload dan Update</button>
            </form>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>