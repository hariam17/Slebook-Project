<?php
    session_start();

    if(isset($_SESSION['username'])){
        header('location: index.php');
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            .login{
                background-color: rgb(55,60,69);
            }
            .red-mg{
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="d-flex align-items-center h-100">
            <div class="flex-row w-50 h-100 bg-primary overflow-hidden">
                <img src="assets/image/login_img.webp" alt="" class="login-img mh-100" style="translate:-320px">
            </div>
            <div class="login d-flex align-items-center flex-row p-3 w-50 h-100">
                <div class="login-box shadow d-flex border rounded w-75 h-75 bg-light mx-auto align-items-center">
                    <div class="login-form mx-auto w-75">
                        <div class="logo">
                            <img src="assets/image/logo_dark.png" class="shadow d-block mx-auto" height="36px" alt="">
                        </div>
                        <br>
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input class="form-control shadow-sm" type="text" name="nim" placeholder="Masukkan NIM Anda">
                            </div>
                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" name="pass" class="form-control shadow-sm" placeholder="Masukkan Password Anda">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block shadow" value="Login">
                            </div>
                        </form>
                        <div class="red-mg">
                            <?php
                            if(isset($_COOKIE['message'])){
                                echo $_COOKIE['message'];
                            }
                            ?>
                        </div>
                        <hr>
                        <div class="forgpass w-75 p-2 mx-auto">
                            <small class="text-center" style="display:block;">Lupa Password Anda? Silahkan Hubungi Staff Bagian Kemahasiswaan di <a href="https://api.whatsapp.com/send?phone=6289602998995&text=Halo%20saya%20mau%20reset%20password">sini</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>