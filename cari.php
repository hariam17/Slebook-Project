<?php
    include "config.php";
    session_start();
    $search = $_GET ['search'];
    $sql = "SELECT * FROM buku WHERE judul LIKE '%".$search."%'";
    $i = 0;
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
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
            
            .cover-img{
                height: inherit;
                
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
        </style>
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
            <?php
            $query = mysqli_query($conn, $sql);
            $jml = mysqli_num_rows($query);
            $itemsPerColumn = 6;
            while($data = mysqli_fetch_assoc($query)){
                if($i == 0){
                    echo "<div class='header d-flex flex-column px-5 mt-5'>
                            <h4>Hasil Pencarian dari \"$search\" </h4>
                            <p>$jml hasil ditemukan</p>
                        </div>";
                }
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
        ?>
        </body>
</html>

