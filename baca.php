<?php
include 'config.php';
session_start();
$id = $_SESSION['book_active'];
$sql = "SELECT * FROM buku WHERE id_buku = '$id'";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.7.107/build/pdf.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="build/pdf.js"></script>
    <script src="build/pdf.worker.js"></script>

    <title>Document</title>
    <link rel="stylesheet" href="assets/style/style.css">
</head>

<body style="background-color: #2a2a2e;">
    <nav class="navbar bg-light navbar-expand-sm p-1 sticky-top shadow-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="assets/image/logo_dark.png" height="32px"
                    class="my-2 mx-3 shadow"></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="mylibrary.php">My Library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="upload.php">Author Menu</a>
                    </li>
                </ul>

                <div class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <div class="nav-item search-box">
                        <input type="search" class="search-input search-input-dark"
                            placeholder="Ketikkan Judul Buku...">
                        <a class="search-btn-dark search-btn" href="#">
                            <!-- Seach Icon -->
                            <i class="bi bi-search"></i>
                        </a>
                    </div>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item text-truncate" href="<?php if(($_SESSION['role'])=='admin'){echo "dashboardAdmin.php";}?>"><?php if(($_SESSION['role'])=='admin'){echo $_SESSION['role']." - ";}?><?php echo $_SESSION['nama']?></a></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    </nav>
    <?php
    while ($data = mysqli_fetch_assoc($query)) {
        ?>
    <div class="content d-flex w-100" style="background-color:rgba(0,0,0,0); height:90vh;">
        <div class="flex-column w-25 h-100 px-3 pt-2">
            <div class="flex-row p-2 text-end">
                <a href="detail_buku.php" class="btn btn-primary flex-row">Kembali</a>
            </div>
            <div class="flex-row p-2 text-end">
                <a href="index.php" class="btn btn-success flex-row">Beranda</a>
            </div>

        </div>
        <div class="flex-column w-50 h-100">
            <div class="embed-responsive embed-responsive-21by9 w-100 h-100">
                <iframe src="generic/web/viewer_readonly.html?file=../../<?php echo $data['dir_book'];
    } ?>" class="embed-responsive-item" style="width:inherit; height:inherit; "></iframe>
            </div>
        </div>
        <div class="flex-column w-25 h-100">
            <input type="hidden" name="fun fact, ini di koding jam 23:48. Yak betul, 12 menit sebelum deadline :D">
        </div>
    </div>
</body>

</html>