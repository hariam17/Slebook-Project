<?php
include("config.php");
session_start();
if ($_SESSION['role'] != 'admin') {
    header("location: index.php");
}

if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id_buku']); // Memperbaiki pengambilan nilai id
    $judul = $_POST['judul'];
    $author = $_POST['author'];
    $tahun_terbit = $_POST['thn'];
    $publisher = $_POST['publisher'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    // Query SQL untuk mengupdate data buku
    $query = "UPDATE buku SET judul='$judul', penulis='$author', tahun_terbit='$tahun_terbit', penerbit='$publisher', 
                     kategori='$kategori', stok='$stok', deskripsi='$deskripsi' WHERE id_buku='$id'";
    $result = mysqli_query($conn, $query);


    if ($result) {
        header("Location: mdBuku.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat mengupdate data pengguna.";
    }
}

mysqli_close($conn);