<?php
    include 'config.php';
    session_start();
    print_r($_SESSION);
    if(isset($_POST['action'])){
        $id_user = $_POST['user'];
        echo $id_user;
        if($_POST['action'] == '1'){
            $sql = "UPDATE user SET `role` = 'author', user_status = 'NO ACTION NEEDED' WHERE id_user = '$id_user'";
            $query = mysqli_query($conn, $sql);
            echo "<script>alert('sukses')</script>";
            header('location: dVerifikasi.php');
        }else if($_POST['action'] == '2'){
            $sql = "UPDATE user SET user_status = 'NO ACTION NEEDED' WHERE id_user = '$id_user'";
            $query = mysqli_query($conn, $sql);
            header('location: dVerifikasi.php');
        }
    }
?>