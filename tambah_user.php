<?php
include 'config.php';
session_start();
if ($_SESSION['role'] != 'admin') {
    header("location: index.php");
}
if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $pass = $_POST['pass'];
    $nama = $_POST['nama'];
    $role = $_POST['role'];

    $sql = "INSERT INTO user(nim, password, nama, role) VALUES ('$nim', '$pass', '$nama', '$role')";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($query) {
        header("Location: mdUser.php");
        exit();
    } else {
        echo "Terjadi kesalahan dalam penyimpanan data.";
    }
}