<?php
include 'config.php';
session_start();
date_default_timezone_set("Asia/Jakarta");
$id = $_SESSION['book_active'];
$user = $_SESSION['id_user'];
$sql = "SELECT * FROM `buku` WHERE `id_buku` = '$id'";
$query = mysqli_query($conn, $sql);
$i = 0;
?>

<html class="h-100">

<head>
    <?php
    while ($data = mysqli_fetch_assoc($query)) {
        echo "<title>Slebook - " . $data['judul'] . " (" . $data['tahun_terbit'] . ")</title>";
    }
    ?>
    <link rel="stylesheet" href="assets/style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    
    <script>
        function konfirmasi() {
            confirm("Apakah anda ingin meminjam buku ini?");
        }
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>
    <style>
            .content{
                width:100%;
                height: 100%;
                background-color: rgba(255,255,255,0.7);
            }

            .search-input {
            outline: none;
            border: 0px;
            border-radius: 5px;
            box-shadow: 0px 1px 8px rgba(0,0,0,0.15);
            background: none;
            width: 0;
            padding: 0;
            color: rgb(0,0,0);
            float: left;
            font-size: 12px;
            transition: .3s;
            line-height: 36px;
            vertical-align: middle;
            }
            .search-input::placeholder {
                font-size: 12px;
            color: rgba(0,0,0,0.75);
            vertical-align: middle;
            }

            .search-btn {
            float: right;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            transition: .3s;
            color: inherit;
            }

            .carousel-item {
            height: 70vh;
            min-height: 350px;
            background: no-repeat center center scroll;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            }

            .search-input:focus,
            .search-input:not(:placeholder-shown) {
            width: 240px;
            padding: 0 6px;
            }
            .search-box:hover > .search-input {
            width: 240px;
            padding: 0 6px;
            }
            .search-box:hover > .search-btn,
            .search-input:focus + .search-btn,
            .search-input:not(:placeholder-shown) + .search-btn {
            color: #4B88FF;
            }
            .book{
                width:16.66%;
                min-width: 120px;
            } 
            

            .book-sm-cover:hover{
                box-shadow: 0px 0px 16px #4B88FF;
                transition: 0.5s;
                animate: glow;
            }

            .book-sm-cover:hover img {
                transform: scale(102.5%);
                transition : all 0.5s linear;
            }

            .cover-img {
                width: 100%;
                height: 100%;
            }

            .book-cover{
                width: 15%;
            }

            .selected-book{
                min-height: 50% !important;
            }
            

        </style>

</head>

<body class="h-100">
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
                    <div class="nav-item search-box">
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

    <?php
    //print_r($_POST);
    //$sql = "SELECT * FROM `buku` WHERE `id_buku` = '$id'";
    $query = mysqli_query($conn, $sql);
    while ($data = mysqli_fetch_assoc($query)) {
        ?>
        <div class="content d-flex flex-column h-100 w-100 p-4">
            <div class="selected-book d-flex flex-row w-100 p-4">
                <div class="book-cover mb-2 rounded h-100">
                    <img src="<?php echo $data['dir_cover']; ?>" style="object-fit: cover; width:100%; height:inherit;" class="rounded img-fluid cover-img shadow" alt="<?php echo $data['judul']?>">
                </div>
                <div class="info-container d-flex flex-row px-4" style="width:85%">
                    <div class="book-info flex-wrap flex-column">
                        <div class="book-title">
                            <h1>
                                <?php echo $judul = $data['judul']; ?>
                            </h1>
                        </div>
                        <div class="book-author">
                            <p>
                                <?php echo $data['penulis'] . '&nbsp;&nbsp;|&nbsp;&nbsp;' . $data['tahun_terbit'] ?>
                            </p>
                        </div>
                        <div class="book-desc">
                            <p>
                                <?php echo $data['deskripsi'] ?>
                            </p>
                        </div>
                        <div class="book-borrow">
                            <?php
                            $query = "SELECT * FROM peminjaman WHERE id_user = '$user' AND id_buku = '$id' AND status_pinjam = 'dipinjam'";
                            if ($result = mysqli_query($conn, $query)) {
                                if ((mysqli_num_rows($result)) >= 1) {
                                    ?>
                                    <span>
                                        <a href="baca.php" class="btn btn-success">Baca</a>
                                    </span>
                                    <?php
                                } else {
                                    if(($data['stok']) >= 0){
                                    ?>
                                        <span>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Pinjam</button>
                                        &nbsp;&nbsp;&nbsp;Buku tersedia :
                                        <?php echo $data['stok']; ?>
                                    </span>
                                    <?php
                                    }else{
                                        ?>
                                        <span>
                                        <button class="btn btn-secondary" data-toggle="modal" data-target="#bukuTT">Buku Tidak Tersedia</button>
                                        &nbsp;&nbsp;&nbsp;Buku tersedia :
                                        <?php echo $data['stok']; ?>
                                    </span>
                                        <?php
                                    } 
                                    ?>
                                    
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4">
                <hr>
            </div>
            <?php
            $sql = "SELECT * FROM buku WHERE id_buku != '$id' ORDER BY id_buku DESC LIMIT 6";
            $query = mysqli_query($conn, $sql);
            $itemsPerColumn = 6;
            while ($data = mysqli_fetch_assoc($query)) {
                if ($i % $itemsPerColumn == 0) {
                    echo "<div class='recently-added d-flex flex-row my-4'>";
                }
                ?>
                <div class="book d-flex flex-column px-4">
                    <div class="book-sm-cover h-100 mb-2 rounded">
                        <form action="bookRedirector.php" method="post" id="<?php echo 'form' . $i ?>">
                            <a href="javascript:;" onclick="document.getElementById('<?php echo 'form' . $i ?>').submit();"
                                class="h-100">
                                <img src="<?php echo $data['dir_cover']; ?>" style="object-fit: cover;"
                                    class="rounded img-fluid cover-img shadow" alt="ada buku">
                                <input type="hidden" name="id_buku" value="<?php echo $data['id_buku'] ?>">
                            </a>
                        </form>
                    </div>
                    <div class="book-title">
                        <h4 class="my-0 text-truncate">
                            <?php echo $data['judul']; ?>
                        </h4 class="m-0">
                    </div>
                    <div class="book-author">
                        <p class="my-0 text-truncate">
                            <?php echo $data['penulis']; ?>
                        </p>
                    </div>
                    <div class="book-year">
                        <p class="my-0 text-truncate">
                            <?php echo $data['tahun_terbit']; ?>
                        </p>
                    </div>
                </div>
                <?php
                if (($i % $itemsPerColumn == $itemsPerColumn - 1)) {
                    echo "</div>";
                }
                $i++;
            }
            ?>
            <div class="modal fade" id="myModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header justify-content-center">
                            <h4 class="modal-title">Apakah anda ingin meminjam buku ini?</h4>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body text-center">
                            <h6>
                                <?php echo $judul; ?>
                            </h6>
                            Durasi Peminjaman : 3 hari
                            <br>
                            (s.d.
                            <?php echo date('d-m-Y 23:59', strtotime('+3 days')); ?>)
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer justify-content-center">
                            <form action="pinjam.php" method="post" id="pinjamBuku">
                                <a href="javascript:;" onclick="document.getElementById('pinjamBuku').submit();"
                                    class="btn btn-primary">Pinjam</a>
                                <input type="hidden" name="id_buku" value="<?php echo $id ?>">
                            </form>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="bukuTT">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header justify-content-center">
                            <h4 class="modal-title">Peringatan</h4>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body text-center">
                            <h6>
                                <?php echo $judul; ?>
                            </h6>
                            Buku Tersebut tidak tersedia
                            <br>
                            Silahkan coba lain waktu
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer justify-content-center">
                            <form action="pinjam.php" method="post" id="pinjamBuku">
                                <a href="javascript:;" onclick="document.getElementById('pinjamBuku').submit();"
                                    class="btn btn-primary">Pinjam</a>
                                <input type="hidden" name="id_buku" value="<?php echo $id ?>">
                            </form>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

</body>

</html>