<?php
    include 'config.php';
    session_start();
    $id = $_POST['id_buku'];
    $_SESSION['book_active'] = $id;
    header("location: detail_buku.php");
?>