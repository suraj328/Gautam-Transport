<?php
    $server="localhost";
    $user="root";
    $password="";
    $dbname="gautam_transport";

    $conn=mysqli_connect($server,$user,$password,$dbname);

    if (!$conn) {
        die("error".mysqli_connect_error());
    }
?>