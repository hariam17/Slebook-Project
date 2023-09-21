<?php
include 'config.php';
session_start();
if (isset($_POST['id_user'])) {
    $sql = "UPDATE user SET user_status = 'ACTION NEEDED' WHERE id_user =" . $_POST['id_user'];
    $query = mysqli_query($conn, $sql);
    $_SESSION['st_user'] = 'ACTION NEEDED';
    header("location: upload.php");
}
?>