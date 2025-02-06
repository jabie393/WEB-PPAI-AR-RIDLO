<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login"); // Redirect ke halaman login jika tidak login
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $page = $_POST['page'];
    $image = $_FILES['image'];

    // Validasi upload
    if ($image['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $uploadPath = $uploadDir . basename($image['name']);

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Jika file dengan nama yang sama sudah ada, hapus sebelum diunggah ulang
        if (file_exists($uploadPath)) {
            unlink($uploadPath);
        }

        $htmlPath = "../$page";
        if (file_exists($htmlPath)) {
            $htmlContent = file_get_contents($htmlPath);

            // Cari gambar lama yang digunakan dalam halaman
            preg_match('/<section.*?<img src="(.*?)"/s', $htmlContent, $matches);
            if (!empty($matches[1])) {
                $oldImagePath = $matches[1];

                // Pastikan hanya menghapus file yang berada di dalam folder uploads
                $oldImageFullPath = realpath(dirname(__FILE__) . '/../' . $oldImagePath);
                if ($oldImageFullPath && strpos($oldImageFullPath, realpath($uploadDir)) === 0 && file_exists($oldImageFullPath)) {
                    unlink($oldImageFullPath);
                }
            }

            // Pindahkan file baru setelah menghapus file lama
            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
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

                file_put_contents($htmlPath, $updatedContent);

                // Tambahkan pesan sukses ke session
                $_SESSION['flash_message'] = 'Gambar berhasil diperbarui!';
                $_SESSION['flash_message_type'] = 'success';
            } else {
                $_SESSION['flash_message'] = 'Gagal mengunggah gambar baru.';
                $_SESSION['flash_message_type'] = 'danger';
            }
        } else {
            $_SESSION['flash_message'] = 'Halaman tidak ditemukan.';
            $_SESSION['flash_message_type'] = 'warning';
        }
    } else {
        $_SESSION['flash_message'] = 'Terjadi kesalahan saat mengunggah gambar.';
        $_SESSION['flash_message_type'] = 'danger';
    }
    
    header("Location: admin"); // Redirect kembali ke halaman admin
    exit();
} else {
    echo "Invalid request method.";
}
?>
