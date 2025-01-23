<?php
session_start();

// Hard-coded admin credentials (bisa diganti dengan database)
$adminUsername = 'admin';
$adminPassword = 'password123'; // Sebaiknya gunakan hashing di produksi, seperti password_hash()

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi kredensial
    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['admin_logged_in'] = true; // Set sesi admin
        header("Location: admin.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPAI AR-RIDLO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .container {
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo {
            width: 50px;
            height: auto;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-body">
                    <div class="logo-container">
                        <img src="..\assets\logo\logo.png" class="logo" alt="logo">
                    </div>
                        <h2 class="text-center">Login Admin</h2>
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <?php if (isset($_POST['username']) && isset($_POST['password'])) : ?>
                            <div class="alert alert-danger mt-3">
                                <?php echo "Username atau password salah."; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>