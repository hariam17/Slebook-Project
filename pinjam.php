<?php
    include 'config.php';
    session_start();

    
    $user = $_SESSION['id_user'];
    $book = $_POST['id_buku'];
    $date = date('Y-m-d');
    
    $sqlCekStok = "SELECT stok FROM buku WHERE id_buku = $book";
    $query = mysqli_query($conn, $sqlCekStok);
    $data = mysqli_fetch_assoc($query);
    $stok = $data['stok'];
    $stok_update = $stok - 1;
    
    $sql = "INSERT INTO peminjaman(id_user, id_buku, status_pinjam) values('$user','$book', 'dipinjam');";
    $query = mysqli_query($conn, $sql);
    if ($query){
        $sql = "UPDATE buku SET stok = $stok_update WHERE id_buku = $book";
        mysqli_query($conn, $sql);
        header("location:detail_buku.php");
    }else{
        echo "matek u're f*cked heheheheheheheh";
    }

?>