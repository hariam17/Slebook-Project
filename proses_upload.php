<?php
include 'config.php';
session_start();
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $author = $_POST['author'];
    $tmp_cover = $_FILES['cover']['tmp_name'];
    $cover = $_FILES['cover']['name'];
    $tmp_book = $_FILES['book-file']['tmp_name'];
    $book = $_FILES['book-file']['name'];
    $desc = $_POST['deskripsi'];
    $bookExt = $_FILES['book-file']['type'];
    $coverExt = $_FILES['cover']['type'];
    $coverAllowed = array("image/jpeg", "image/png", "image/jpg", "image/webp");
    $bookAllowed = "application/pdf";
     if (empty($_POST['judul'])) {
         $error_message .= "<br>Judul anda kosong!";
         $error = true;
     }
     if (empty($_POST['author'])) {
         $error_message .= "<br>Penulis anda kosong!";
         $error = true;
     }
     if (empty($_POST['deskripsi'])) {
         $error_message .= "<br>Deskripsi anda kosong!";
         $error = true;
     }
      if (!file_exists($tmp_book) || !is_uploaded_file($tmp_book)) {
          $error_message .= "<br>Anda Belum Mengupload File Buku!";
          $error = true;
      }else if(file_exists($tmp_book) || is_uploaded_file($tmp_book)){
          if(($bookExt != $bookAllowed)){
              $error_message .= "<br>File Buku yang anda upload bukan file .pdf!";
              $error = true;
          }
      }
      if (!file_exists($tmp_cover) || !is_uploaded_file($tmp_cover)) {
          $error_message .= "<br>Anda Belum Mengupload Cover Buku!";
          $error = true;
      }else if(file_exists($tmp_cover) || is_uploaded_file($tmp_cover)){
          if(!in_array($coverExt, $coverAllowed)){
              $error_message .= "<br>File Cover yang anda upload bukan file .png / .jpg / .jpeg / .webp!";
              $error = true;
          }
      }
    $_SESSION['error'] = $error_message;
    if (isset($error)) {
        header('location: upload.php');
    } else {
        if ($cover) {
            echo "<script>alert($error)</script>";
            $thn = date('Y');
            $publisher = "Perpustakaan UPN Veteran Jakarta";
            $category = "Karya Mahasiswa";
            $stok = 25;
            $dir_cover = "assets/image/$cover";
            $dir_book = "assets/file/$book";
            move_uploaded_file($tmp_cover, $dir_cover);
            move_uploaded_file($tmp_book, $dir_book);
            $sql = "INSERT INTO buku(judul, penulis, tahun_terbit, penerbit, kategori, stok, dir_cover, dir_book, deskripsi) 
           VALUES ('$judul', '$author', '$thn', '$publisher', '$category', $stok, '$dir_cover', '$dir_book', '$desc')";
            $query = mysqli_query($conn, $sql);
            header('location:index.php');
        }
    }
}