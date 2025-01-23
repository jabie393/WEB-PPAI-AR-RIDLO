<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.html"); // Redirect ke halaman login jika tidak login
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $page = $_POST['page'];
    $image = $_FILES['image'];

    // Validasi upload
    if ($image['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $uploadPath = $uploadDir . basename($image['name']);

        // Buat folder jika belum ada
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Temukan gambar lama dalam halaman HTML
        $htmlPath = "../$page";
        if (file_exists($htmlPath)) {
            $htmlContent = file_get_contents($htmlPath);

            // Ambil path gambar lama dari elemen <img src="">
            preg_match('/<section.*?<img src="(.*?)"/s', $htmlContent, $matches);
            if (!empty($matches[1])) {
                $oldImagePath = $matches[1];
                $oldImageFullPath = realpath(dirname(__FILE__) . '/../uploads/' . $oldImagePath);

                // Hapus gambar lama jika ada
                if ($oldImageFullPath && file_exists($oldImageFullPath)) {
                    unlink($oldImageFullPath);
                }
            }

            // Pindahkan file yang diunggah
            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                // Update elemen gambar di dalam <section> saja
                $updatedContent = preg_replace_callback(
                    '/<section.*?<img src=".*?"(.*?)>/s',
                    function ($matches) use ($uploadPath) {
                        return preg_replace(
                            '/<img src=".*?"/',
                            '<img src="' . $uploadPath . '"',
                            $matches[0]
                        );
                    },
                    $htmlContent
                );

                // Simpan perubahan
                file_put_contents($htmlPath, $updatedContent);
                echo "Gambar berhasil diperbarui dan gambar lama dihapus.";
            } else {
                echo "Gagal mengunggah gambar baru.";
            }
        } else {
            echo "Halaman tidak ditemukan.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }
} else {
    echo "Invalid request method.";
}
?>
