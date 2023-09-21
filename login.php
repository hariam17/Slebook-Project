<?php
session_start();
include('config.php');
date_default_timezone_set("Asia/Jakarta");

$nim = $_POST['nim'];
$password = $_POST['pass'];
$date = strtotime(date('Y-m-d H:i:s'));
echo $date;
$i = 1;

if ($nim != '' && $password != '') {
    $sql = "SELECT * FROM user WHERE nim='$nim' AND password='$password'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) < 1) {
        setcookie("message", "Maaf, NIM atau password salah", time() + 60);
        header("location: masuk.php");
    } else {
        echo $data['nim'] . $data['password'];
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nim'] = $data['nim'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['st_user'] = $data['user_status'];
        setcookie("message", "", time() - 60);

        $sql1 = "SELECT * FROM peminjaman WHERE id_user =" . $_SESSION['id_user'] . " AND status_pinjam != 'kembali'";
        $query1 = mysqli_query($conn, $sql1);
        while ($data1 = mysqli_fetch_assoc($query1)) {
            $sql2 = "SELECT id_pinjam, DATE(waktu_pinjam) as tanggal_pinjam FROM history_peminjaman WHERE id_pinjam =" . $data1['id_pinjam'];
            $query2 = mysqli_query($conn, $sql2);
            while ($data2 = mysqli_fetch_assoc($query2)){
                $tanggal_mentah = $data2['tanggal_pinjam'];
                $tanggal_pinjam = strtotime($tanggal_mentah);
                $kembali = strtotime(date('Y-m-d 23:59:59', strtotime('+3 days', ($tanggal_pinjam))));
                echo "id pinjam :" . $data1['id_pinjam'] . "<br>";
                if ($kembali > $date) {
                    
                    //berlaku
                } else if ($kembali < $date){
                    
                    $sql3 = "UPDATE history_peminjaman SET waktu_kembali = CURRENT_TIMESTAMP() WHERE id_pinjam = " . $data1['id_pinjam'];
                    $query3 = mysqli_query($conn, $sql3);
                    $sql3 = "UPDATE peminjaman SET status_pinjam = 'kembali' WHERE id_pinjam = " . $data1['id_pinjam'];
                    $query3 = mysqli_query($conn, $sql3);
                    $sql = "SELECT * FROM buku";
                    $query = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_assoc($query)) {
                        $stok = $data['stok'];
                        $stokUpdate = $stok + 1;
                        $sql4 = "UPDATE buku SET stok = $stokUpdate  WHERE id_buku = " . $data1['id_buku'];
                        $query4 = mysqli_query($conn, $sql4);
                    }
                   
                    //udah habis masa berlakunya
                }
            }
        }
        if ($_SESSION['role'] != 'admin') {
            header("location:index.php");
        } else {
            header('location: dashboardAdmin.php');
        }
    }
} else {
    setcookie("message", "NIM atau Password kosong", time() + 60);
    header("location: masuk.php");
}
?>