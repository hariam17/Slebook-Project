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

$id = htmlentities(strip_tags(trim($_POST["id"])));
$id = mysqli_real_escape_string($conn, $id);
$query = "SELECT * FROM user WHERE id_user='$id'";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Page Detail Data User - Slebook</title>
    <link rel="shortcut icon" href="assets/image/logo_light.png">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <style>
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-control-file {
            display: inline-block;
            margin-top: 5px;
        }

        .btn-primary {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
        }
    </style>
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="dashboardAdmin.php">
            <img style="width: 40%" src="./assets/images/logo_light.png" alt="">
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-columns"></i>
                            </div>
                            Master Data
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="mdBuku.php">Data Buku</a>
                                <a class="nav-link" href="mdUser.php">Data User</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="dPeminjaman.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
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
                    <div class="small">Logged in as:</div>
                    <?php echo $nama ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Detail Data User</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">
                            <a href="dashboardAdmin.php">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Data User</li>
                        <li class="breadcrumb-item active">Detail Data User</li>
                    </ol>
                    <hr />
                </div>
                <form enctype="multipart/form-data">
                    <div class="container-fluid px-4">
                        <div class="form-group">
                            <label for="inputNim">NIM</label>
                            <input type="text" name="nim" class="form-control" id="inputNim" placeholder="NIM" disabled value="<?php echo $row['nim']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="inputPenulis">Password</label>
                            <input type="password" name="author" class="form-control" id="inputPassword" placeholder="Password" disabled value="<?php echo $row['password']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="inputNama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="inputNama" placeholder="Nama" disabled value="<?php echo $row['nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="inputRole">Role</label>
                            <input type="text" name="role" class="form-control" id="inputRole" placeholder="Role" disabled value="<?php echo $row['role']; ?>">
                        </div>
                    </div>
                </form>
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
</body>

</html>