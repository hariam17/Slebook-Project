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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Data Peminjaman - Slebook</title>
  <link rel="shortcut icon" href="assets/image/logo_light.png">
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

  <style>
    .table-action {
      display: flex;
      justify-content: space-around;
    }
  </style>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="dashboardAdmin.php">
      <img style="width: 40%" src="./assets/image/logo_light.png" alt="">
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
          <h1 class="mt-4">Data Peminjaman Buku</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">
              <a href="dashboardAdmin.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Data Peminjaman Buku</li>
          </ol>
          <hr />
          <br />
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Data Peminjaman Buku
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID_PEMINJAMAN</th>
                    <th scope="col">Nama User</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Tanggal Peminjaman</th>
                    <th scope="col">Tanggal Pengembalian</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include('config.php');
                  $sql = 'SELECT peminjaman.id_pinjam, user.nama, buku.judul, peminjaman.status_pinjam 
                          FROM ((peminjaman INNER JOIN user ON peminjaman.id_user = user.id_user)
                          INNER JOIN buku ON peminjaman.id_buku = buku.id_buku) ORDER BY peminjaman.id_pinjam DESC';

                  $result = mysqli_query($conn, $sql);

                  if (!$result) {
                    die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
                  }

                  $i = 1;

                  while ($data = mysqli_fetch_assoc($result)) {
                    $sql_history = "SELECT * FROM history_peminjaman WHERE id_pinjam = " . $data['id_pinjam'];
                    $result_history = mysqli_query($conn, $sql_history);
                    while ($dataHistory = mysqli_fetch_assoc($result_history)) {
                      echo "<tr>";
                      echo "<th scope=\"row\">$i</th>";
                      echo "<td>" . $data['id_pinjam'] . "</td>";
                      echo "<td>" . $data['nama'] . "</td>";
                      echo "<td>" . $data['judul'] . "</td>";
                      echo "<td>" . $dataHistory['waktu_pinjam'] . "</td>";
                      echo "<td>" . $dataHistory['waktu_kembali'] . "</td>";
                      echo "<td>" . $data['status_pinjam'] . "</td>";
                      echo "<th scope=\"row\" class=\"text-center\">
                      <form action=\"./detailDataPeminjaman.php\" method=\"post\"class=\"d-inline-block mb-2\">
                      <input type=\"hidden\" name=\"id\" value=\"$data[id_pinjam]\">
                      <button type=\"submit\" name=\"submit\" class=\"btn btn-info\"><i class=\"bi bi-info-circle\"></i></button>
                </form>
        </th>";
                      echo "</tr>";
                      $i++;
                    }
                  }

                  mysqli_free_result($result);
                  mysqli_close($conn);
                  ?>

                </tbody>
              </table>
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
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script src="js/datatables-simple-demo.js"></script>
</body>

</html>