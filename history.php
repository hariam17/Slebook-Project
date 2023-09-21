<?php
    include 'config.php';
    session_start();
    $id_user = $_SESSION['id_user'];
    $i = 0;
?>

<html>
    <head>
        <link rel="stylesheet" href="assets/style/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar navbar-expand-sm bg-light p-1 sticky-top shadow-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img src="assets/image/logo_dark.png" height="32px" class="my-2 mx-3 shadow"></a>
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
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
        <div class="content">
            <header class="px-5 pt-4">
                <table class="w-100">
                        <tr>
                            <td class="px-4"><h2>Riwayat Peminjaman</h2></td>
                            <td class="px-4 align-middle text-end"><a href="mylibrary.php" class="link-secondary link-offset-1 link-underline-opacity-0 link-underline-opacity-75-hover"><i class="bi bi-collection-fill"></i>&nbsp;&nbsp;Koleksi Saya</a></td>
                        </tr>
                    </table>
            </header>
            <div>
                <hr style="width:90%;" class="mx-auto"> 
            </div>
            <div class="w-100">
            <?php
            $sql_pinjam = "SELECT DISTINCT id_buku FROM peminjaman WHERE id_user = '$id_user' AND status_pinjam = 'kembali'";
            $query_pinjam = mysqli_query($conn, $sql_pinjam);
            $numRows = mysqli_num_rows($query_pinjam);
            if ($numRows <= 0){
                echo "<div class='recently-added d-flex flex-row px-5 my-4'>";
                echo "<div class='my-5'>";
                echo "<p class='mx-auto' style='width:100%'><span>Belum ada buku</span></p>
                        </div>";
            }
            while($data_pinjam = mysqli_fetch_assoc($query_pinjam)){
            
            $sql = "SELECT * FROM buku WHERE id_buku = '".$data_pinjam['id_buku']."'";
            $query = mysqli_query($conn, $sql);
            $itemsPerColumn = 6;
            while($data = mysqli_fetch_assoc($query)){
                if($i % $itemsPerColumn == 0){                  
                    echo "<div class='recently-added d-flex flex-row px-5 my-4'>";   
                }
        ?>
            <div class="book d-flex flex-column px-4">
                <div class="book-sm-cover h-100 mb-2 rounded">
                    <form action="bookRedirector.php" method="post" id="<?php echo 'form'.$i?>">
                        <a href="javascript:;" onclick="document.getElementById('<?php echo 'form'.$i?>').submit();" class="h-100">
                            <img src="<?php echo $data['dir_cover'];?>" style="object-fit: cover;" class="rounded img-fluid cover-img shadow" alt="ada buku">
                            <input type="hidden" name="id_buku" value="<?php echo $data['id_buku']?>">
                        </a>
                    </form>
                </div>
                <div class="book-title">
                    <h4 class="my-0 text-truncate"><?php echo $data['judul'];?></h4 class="m-0">
                </div>
                <div class="book-author">
                    <p class="my-0 text-truncate"><?php echo $data['penulis'];?></p>
                </div>
                <div class="book-year">
                    <p class="my-0 text-truncate"><?php echo $data['tahun_terbit'];?></p>
                </div>
            </div>
        <?php
                if(($i % $itemsPerColumn == $itemsPerColumn - 1)){
                    echo "</div>";
                }
                $i++;
            }
        }   
        ?>
        </div>
        <div class="my-5">
                <p class="separator mx-auto" style="width:90%"><span>Buku Terbaru</span></p>
            </div>
        <?php
            $data = "";
            $sql = "SELECT * FROM buku ORDER BY id_buku DESC LIMIT 6";
            $query = mysqli_query($conn, $sql);
            $itemsPerColumn = 6;
            $j = 0;
            while($data_latest = mysqli_fetch_assoc($query)){
                if($j % $itemsPerColumn == 0){                  
                    echo "<div class='recently-added d-flex flex-row px-5 my-4'>";   
                }
        ?>
            <div class="book d-flex flex-column px-4">
                <div class="book-sm-cover h-100 mb-2 rounded">
                    <form action="bookRedirector.php" method="post" id="<?php echo 'form'.$i?>">
                        <a href="javascript:;" onclick="document.getElementById('<?php echo 'form'.$i?>').submit();" class="h-100">
                            <img src="<?php echo $data_latest['dir_cover'];?>" style="object-fit: cover;" class="rounded img-fluid cover-img shadow" alt="ada buku">
                            <input type="hidden" name="id_buku" value="<?php echo $data_latest['id_buku']?>">
                        </a>
                    </form>
                </div>
                <div class="book-title">
                    <h4 class="my-0 text-truncate"><?php echo $data_latest['judul'];?></h4 class="m-0">
                </div>
                <div class="book-author">
                    <p class="my-0 text-truncate"><?php echo $data_latest['penulis'];?></p>
                </div>
                <div class="book-year">
                    <p class="my-0 text-truncate"><?php echo $data_latest['tahun_terbit'];?></p>
                </div>
            </div>
            <?php
                if(($j % $itemsPerColumn == $itemsPerColumn - 1)){
                    echo "</div>";
                }
                $j++;
                $i++;
            }   
            ?>
        
           
            </div>
    </body>
</html>