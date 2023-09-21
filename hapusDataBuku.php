<?php
session_start();
include("config.php");
if($_SESSION['role'] != 'admin') {
    header("location: mdBuku.php");
}
if (isset($_POST["submit"])) {
    $id = htmlentities(strip_tags(trim($_POST["id"])));
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT judul FROM buku WHERE id_buku ='$id' ";
    $result = mysqli_query($conn, $query);
    while($data = mysqli_fetch_assoc($result)){
        $judul = $data["judul"];
    }

    $query = "DELETE FROM buku WHERE id_buku='$id'";
    $result = mysqli_query($conn, $query);
    echo $id;
    if ($result) {
        $message = "Buku dengan judul \"<b>$judul</b>\" sudah berhasil dihapus";
        $message = urlencode($message);
        //header("Location: mdBuku.php?message={$message}");
    } else {
        die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
    }
}
