<?php
include 'config.php';
session_start();
if ($_SESSION['role'] != 'admin') {
    header("location: index.php");
}

//Nilai-nilai dari elemen form 
//(judul, penulis, tahun terbit, penerbit, kategori, stok) dan 
//file yang diunggah (gambar sampul dan file buku) disimpan dalam variabel-variabel.

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $author = $_POST['author'];
    $thn = $_POST['thn'];
    $publisher = $_POST['publisher'];
    $category = $_POST['category'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $tmp_cover = $_FILES['cover']['tmp_name'];
    $cover = $_FILES['cover']['name'];
    $tmp_book = $_FILES['book-file']['tmp_name'];
    $book = $_FILES['book-file']['name'];
}


if ($cover) {
    //digunakan untuk menyimpan path (lokasi) direktori tujuan 
    $dir_cover = "assets/images/$cover";
    $dir_book = "assets/file/$book";

    //berfungsi untuk memindahkan file gambar sampul buku yang diunggah
    move_uploaded_file($tmp_cover, $dir_cover);
    move_uploaded_file($tmp_book, $dir_book);

    //query untuk menambahkan data buku ke database
    $sql = "INSERT INTO buku(judul, penulis, tahun_terbit, penerbit, kategori, stok, deskripsi, dir_cover, dir_book) 
            VALUES ('$judul', '$author', '$thn', '$publisher', '$category', '$stok', '$deskripsi', '$dir_cover', '$dir_book')";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($query) {
        header("Location: mdBuku.php");
        exit();
    } else {
        echo "Terjadi kesalahan dalam penyimpanan data.";
    }
}