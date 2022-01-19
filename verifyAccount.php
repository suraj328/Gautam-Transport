<?php
    include 'Backend/dbconfig.php';
    session_start();
    

    if(isset($_GET['token'])){
        $token=$_GET['token'];

        $verifyQuery="UPDATE `session` SET `status`='verify' where `token`='$token' ";

        if(mysqli_query($conn,$verifyQuery)){
            echo"hello your account verified";
        }
    }

?>