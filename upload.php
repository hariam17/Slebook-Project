<?php
include 'config.php';
session_start();
$id_user = $_SESSION['id_user'];
$sql = "SELECT * FROM user WHERE id_user = '$id_user'";
$query = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($query)){
    $stts = $data['user_status'];
    $role = $data['role'];
}
$error_message = "";
if(isset($_SESSION['error'])){
    $error_message = $_SESSION['error'];
}
?>

<html>

<head>
    <title> Form Upload </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
</head>

<body>
    <?php
    if (($role == 'reader') && ($stts == 'NO ACTION NEEDED')) {
        echo "<script type='text/javascript'>
                    $(document).ready(function(){
                        $('#notAuthor').modal('show');
                    });
            </script>";
    } else if (($role == 'reader') && ($stts == 'ACTION NEEDED')) {
        echo "<script type='text/javascript'>
                    $(document).ready(function(){
                        $('#authorWait').modal('show');
                    });
            </script>";
    }
    ?>
    <nav class="navbar navbar-expand-sm bg-light p-1 sticky-top shadow-lg">
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
                <div class="nav-item">
                            <form id="searchForm" class="search-box" action="cari.php" method="get">
                            <input name="search" type="search" class="search-input" placeholder="Ketikkan Judul Buku...">
                            <a class="search-btn" href="javascript:;" onclick="document.getElementById('searchForm').submit();">
                                <!-- Seach Icon -->
                                <i class="bi bi-search"></i>
                            </a>
                            </form>
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

    <div class="content p-4 d-flex flex-column w-100">
        <div class="flex-row px-4">
            <h2>Upload Buku</h2>
        </div>
        <div class="px-4 mb-0">
            <hr style="width:100%;" class="mx-auto">
        </div>
        <div class="error px-4">
            <p class="text-danger"><?php echo $error_message?></p>
        </div>
        <div class="w-100 flex-row px-4">
            <form method="post" action="proses_upload.php" enctype="multipart/form-data" style="width: inherit">
                <div class="form w-100">
                    <form action="">
                        <div class="form-group row mb-2">
                            <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="judul"
                                    placeholder="Inputkan Judul Buku Anda..." maxlength="128">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="author" class="col-sm-2 col-form-label">Penulis</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="author"
                                    value="<?php echo $_SESSION['nama']; ?>" maxlength="64">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="deskripsi" rows="4"
                                    placeholder="Deskripsi Singkat Mengenai Buku Anda..." maxlength="512"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row mb-4 ">
                            <div class="col">
                                <label for="fileCover">Input Cover Buku (Ekstensi: *.png/*.jpg/*.jpeg/*.webp)</label>
                                <br>
                                <input type="file" name="cover" class="form-control-file" id="fileCover">
                            </div>
                            <div class="col">
                                <label for="fileBuku">Input File Buku (Ekstensi: *.pdf)</label> <br>
                                <input type="file" name="book-file" class="form-control-file" id="fileBuku">
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <input type="submit" name="submit" class="btn btn-primary"></button>
                        </div>
                    </form>
                    <!-- <tr>
                            <td width = "250">File Cover Buku</td>
                            <td>
                                <input name = "cover" type = "file" id = "cover">
                            </td>
                        </tr>
                        <tr>
                            <td width = "250">File Buku</td>
                            <td>
                                <input name = "book" type = "file" id = "book">
                            </td>
                        </tr> -->
            </form>
        </div>

    </div>
    <div class="modal fade" id="notAuthor">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header justify-content-center">
                    <h4 class="modal-title">Informasi</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body text-center">
                    <h6>Anda Belum Terdaftar Sebagai Author Slebook</h6>
                    Apakah anda ingin mendaftar sebagai Author?
                </div>

                <!-- Modal footer -->
                <div class="modal-footer justify-content-center">
                    <form action="registerAuthor.php" method="post" id="modal1">
                        <a href="javascript:;" onclick="document.getElementById('modal1').submit();"
                            class="btn btn-success">Ya</a>
                        <input type="hidden" name="id_user" value="<?php echo $id_user ?>">
                    </form>
                    <a href="index.php" class="btn btn-danger">Tidak</a>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="authorWait">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header justify-content-center">
                    <h4 class="modal-title">Informasi</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body text-center">
                    <h6>Pendaftaran Anda Sebagai Author Sedang Diverifikasi</h6>
                    Silahkan Menunggu Admin untuk menverifikasi pendaftaran anda<br>Hubungi Admin di Perpustakaan UPNVJ
                    jika butuh segera
                </div>

                <!-- Modal footer -->
                <div class="modal-footer justify-content-center">
                    <a href="index.php" class="btn btn-primary">Kembali ke Home</a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
<!-- <?php
unset($_SESSION['error']);
?> -->