<?php
include("config.php");
if($_SESSION['role'] != 'admin') {
    header("location: index.php");
}
if (isset($_POST["submit"])) {
    $id = htmlentities(strip_tags(trim($_POST["id"])));
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT nama, nim FROM user WHERE id_user ='$id' ";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $nim = $data["nim"];
    $nama = $data["nama"];
    $query = "DELETE FROM user WHERE id_user='$id' ";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $message = "User dengan NIM \"<b>$nim</b>\" dan Nama\"<b>$nama</b>\" sudah berhasil dihapus";
        $message = urlencode($message);
        header("Location: mdUser.php?message={$message}");
    } else {
        die("Query Error: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
    }
}
