<?php
include 'config/koneksi.php';

/* =======================
   QUERY DATA DASHBOARD
   ======================= */

// Total stok buah
$qStok = mysqli_query($conn, "SELECT SUM(stok) AS total FROM buah");
$total_buah = ($qStok && mysqli_num_rows($qStok) > 0)
    ? mysqli_fetch_assoc($qStok)['total']
    : 0;

// Total transaksi
$qTransaksi = mysqli_query($conn, "SELECT COUNT(*) AS total FROM transaksi");
$total_transaksi = ($qTransaksi && mysqli_num_rows($qTransaksi) > 0)
    ? mysqli_fetch_assoc($qTransaksi)['total']
    : 0;

// Total jenis buah
$qJenis = mysqli_query($conn, "SELECT COUNT(*) AS total FROM buah");
$total_jenis = ($qJenis && mysqli_num_rows($qJenis) > 0)
    ? mysqli_fetch_assoc($qJenis)['total']
    : 0;

// Transaksi terakhir (untuk cetak nota)
$qTerakhir = mysqli_query(
    $conn,
    "SELECT id, tanggal, total 
     FROM transaksi 
     ORDER BY id DESC 
     LIMIT 5"
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Penjualan Buah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">🍎 Penjualan Buah</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="buah.php">Data Buah</a></li>
                <li class="nav-item"><a class="nav-link" href="transaksi.php">Transaksi</a></li>
                <li class="nav-item"><a class="nav-link" href="laporan.php">Laporan</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- HEADER -->
<div class="container mt-5">
    <div class="mb-4">
        <h2 class="fw-bold">Dashboard</h2>
        <p class="text-muted">Ringkasan sistem informasi penjualan buah</p>
    </div>

    <!-- KARTU STATISTIK -->
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Stok Buah</h6>
                    <h2 class="fw-bold text-primary"><?= $total_buah; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Transaksi</h6>
                    <h2 class="fw-bold text-success"><?= $total_transaksi; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Jenis Buah</h6>
                    <h2 class="fw-bold text-warning"><?= $total_jenis; ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- AKSES CEPAT -->
    <div class="row mt-5">
        <h4 class="mb-3">Akses Cepat</h4>

        <div class="col-md-4 mb-3">
            <a href="transaksi.php" class="text-decoration-none">
                <div class="card h-100 text-center shadow-sm">
                    <div class="card-body">
                        <h5>🛒 Transaksi Baru</h5>
                        <p class="text-muted">Lakukan penjualan buah</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="buah.php" class="text-decoration-none">
                <div class="card h-100 text-center shadow-sm">
                    <div class="card-body">
                        <h5>🍉 Data Buah</h5>
                        <p class="text-muted">Kelola stok & harga</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="laporan.php" class="text-decoration-none">
                <div class="card h-100 text-center shadow-sm">
                    <div class="card-body">
                        <h5>📊 Laporan</h5>
                        <p class="text-muted">Rekap penjualan</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- TRANSAKSI TERAKHIR + CETAK NOTA -->
    <div class="row mt-5">
        <h4 class="mb-3">Transaksi Terakhir</h4>
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($qTerakhir && mysqli_num_rows($qTerakhir) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($qTerakhir)) {
                                echo "
                                <tr>
                                    <td>{$no}</td>
                                    <td>{$row['tanggal']}</td>
                                    <td>Rp " . number_format($row['total']) . "</td>
                                    <td>
                                        <a href='cetak_nota.php?id={$row['id']}' 
                                           target='_blank'
                                           class='btn btn-success btn-sm'>
                                           Cetak Nota
                                        </a>
                                    </td>
                                </tr>";
                                $no++;
                            }
                        } else {
                            echo "
                            <tr>
                                <td colspan='4' class='text-center text-muted'>
                                    Belum ada transaksi
                                </td>
                            </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer mt-5">
    <p>© <?= date('Y'); ?> Sistem Informasi Penjualan Buah</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
