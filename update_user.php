<?php
include("config.php");
session_start();
if ($_SESSION['role'] != 'admin') {
    header("location: index.php");
}

if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id_user']); // Memperbaiki pengambilan nilai id
    $nim = $_POST['nim'];
    $password = $_POST['pass'];
    $nama = $_POST['nama'];
    $role = $_POST['role'];

    // Query SQL untuk mengupdate data pengguna
    $query = "UPDATE user SET nim='$nim', password='$password', nama='$nama', role='$role' WHERE id_user='$id'"; // Memperbaiki sintaksis UPDATE
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: mdUser.php");
        exit();
    } else {
        echo "Terjadi kesalahan saat mengupdate data pengguna.";
    }
}

mysqli_close($conn);