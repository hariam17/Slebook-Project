<?php
include('config.php');
session_start();
if (!isset($_SESSION['nim'])) {
    header("location: masuk.php");
}
if($_SESSION['role'] != 'admin') {
    header("location: index.php");
}
$nama = $_SESSION['nama'];
?>

<?php

$query = "SELECT COUNT(*) as total FROM buku";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($result);
$totalData = $data['total'];

$query = "SELECT COUNT(*) as total FROM buku WHERE kategori != 'Karya Mahasiswa'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($result);
$totalBukuUmum = $data['total'];

$query = "SELECT COUNT(*) as total FROM buku WHERE kategori = 'Karya Mahasiswa'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($result);
$totalBukuKM = $data['total'];

$query = "SELECT COUNT(*) as total FROM user WHERE user_status = 'ACTION NEEDED'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($result);
$totalRequestStatus = $data['total'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Welcome to Dashboard Admin Slebook</title>
    <link rel="shortcut icon" href="assets/image/logo_light.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="dashboardAdmin.php">
            <img style="width: 40%" src="./assets/image/logo_light.png" alt="">
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="index.php">Index - User View</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="dashboardAdmin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Master Data
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="mdBuku.php">Data Buku</a>
                                <a class="nav-link" href="mdUser.php">Data User</a>

                            </nav>
                        </div>
                        <a class="nav-link" href="dPeminjaman.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Data Peminjaman
                        </a>
                        <a class="nav-link" href="dVerifikasi.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            Verifikasi User
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as</div>
                    <?php echo $nama ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="my-4">Dashboard</h1>
                    <p>Data Buku</p>
                    <div class="row">
                        
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Total Buku : <?php echo $totalData ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="mdBuku.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-primary text-white mb-4">
                                <div class="card-body text-primary">Buku Umum : <?php echo $totalBukuUmum ?> </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-primary stretched-link" href="#">View Details</a>
                                    <div class="small text-primary"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-primary text-primary mb-4">
                                <div class="card-body">Buku Karya Mahasiswa : <?php echo $totalBukuKM ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-primary stretched-link" href="#">View Details</a>
                                    <div class="small text-primary"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Menunggu Verifikasi : <?php echo $totalRequestStatus ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="dVerifikasi.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>Menu</p>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body p-4 d-flex justify-content-between">
                                    <a href="mdBuku.php" class="m-0 link-light link-offset-2 link-underline link-underline-opacity-0">
                                        <p class="m-0">Data Buku</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body p-4 d-flex justify-content-between">
                                    <a href="mdUser.php" class="m-0 link-light link-offset-2 link-underline link-underline-opacity-0">
                                        <p class="m-0">Data User</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning mb-4">
                                <div class="card-body p-4 d-flex justify-content-between">
                                    <a href="dPeminjaman.php" class="m-0 link-dark link-offset-2 link-underline link-underline-opacity-0">
                                        <p class="m-0">Data Peminjaman</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body p-4 d-flex justify-content-between">
                                    <a href="dVerifikasi.php" class="m-0 link-light link-offset-2 link-underline link-underline-opacity-0">
                                        <p class="m-0">Verifikasi User</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-primary text-white mb-4">
                                <div class="card-body p-4 d-flex justify-content-between">
                                    <a href="index.php" class="m-0 link-primary link-offset-2 link-underline link-underline-opacity-0">
                                        <p class="m-0">Index - User View</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-success text-white mb-4">
                                <div class="card-body p-4 d-flex justify-content-between">
                                    <a href="https://api.whatsapp.com/send?phone=6289684684107" class="m-0 link-success link-offset-2 link-underline link-underline-opacity-0">
                                        <p class="m-0">WhatsApp Bag. Kemahasiswaan</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-warning text-white mb-4">
                                <div class="card-body p-4 d-flex justify-content-between">
                                    <a href="/phpmyadmin" class="m-0 link-warning link-offset-2 link-underline link-underline-opacity-0">
                                        <p class="m-0">phpMyAdmin (Server-only)</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Slebook 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
</body>

</html>