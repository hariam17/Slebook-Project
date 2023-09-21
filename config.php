<?php
    $server = 'localhost';
    $db = 'slebook';
    $user = 'root';
    $pass = '';
    

    $conn = new mysqli($server, $user, $pass, $db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }else{
        
    }
?>