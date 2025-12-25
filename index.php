<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Buah</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Beka Fruit</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="buah.php">Data Buah</a></li>
                <li class="nav-item"><a class="nav-link" href="transaksi.php">Transaksi</a></li>
                <li class="nav-item"><a class="nav-link" href="laporan.php">Laporan</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO SECTION -->
<div class="container mt-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="fw-bold mb-3">
                Sistem Informasi<br>Penjualan Beka Fruit
            </h1>
            <p class="lead">
                Aplikasi berbasis web untuk mengelola data buah, transaksi penjualan,
                dan laporan secara cepat, akurat, dan terintegrasi.
            </p>
            <div class="mt-4">
                <a href="transaksi.php" class="btn btn-primary btn-lg me-2">
                    Mulai Transaksi
                </a>
                <a href="buah.php" class="btn btn-outline-secondary btn-lg">
                    Kelola Data Buah
                </a>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/415/415733.png"
                 class="img-fluid"
                 style="max-height: 320px;"
                 alt="Ilustrasi Buah">
        </div>
    </div>
</div>

<!-- FITUR UTAMA -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Fitur Utama Sistem</h2>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Manajemen Data Buah</h5>
                    <p class="card-text">
                        Mengelola data buah meliputi nama, harga, dan stok dengan mudah.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Transaksi Penjualan</h5>
                    <p class="card-text">
                        Proses transaksi cepat dengan perhitungan otomatis dan update stok.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Laporan Penjualan</h5>
                    <p class="card-text">
                        Menyajikan laporan transaksi sebagai bahan evaluasi dan keputusan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- STATISTIK -->
<?php
$jumlah_buah = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM buah"))['total'];
$jumlah_transaksi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM transaksi"))['total'];
?>

<div class="container mt-5">
    <div class="row text-center">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>Total Jenis Buah</h5>
                    <p class="display-6 fw-bold text-primary">
                        <?= $jumlah_buah; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>Total Transaksi</h5>
                    <p class="display-6 fw-bold text-primary">
                        <?= $jumlah_transaksi; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    <p>
        © <?= date('Y'); ?> Sistem Informasi Penjualan Buah<br>
        Dibangun menggunakan PHP Native & MySQL
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
