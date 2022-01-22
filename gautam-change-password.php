<?php

include 'Backend/dbconfig.php';
session_start();

if($_SESSION['loggedin']==true || isset($_SESSION['loggedin'])){

    $mail=$_SESSION['useremail'];
    echo$mail;

    $changePw="SELECT `email_id` ,`password`, `token` FROM `session` WHERE `email_id`='$mail' ";
    $changePwConn= mysqli_query($conn,$changePw);

    
    if(!empty($_POST['oldpassword'])  && !empty($_POST['newpassword']) && !empty($_POST['cnewpassword'])){
        
        $oldPassword=$_POST['oldpassword'];
        $newPassword=$_POST['newpassword'];
        $cnewPassword=$_POST['cnewpassword'];
        
        
        while($row = mysqli_fetch_assoc($changePwConn)){
            $token=$row['token'];
            
            if(password_verify($oldPassword,$row['password'])){
    
               if($newPassword==$cnewPassword){

                    $hashPw=password_hash($cnewPassword, PASSWORD_BCRYPT);

                    $updatePw = "UPDATE `session` SET `password`='$hashPw' WHERE `token`='$token' AND `email_id`='$mail' ";

                    if(mysqli_query($conn,$updatePw)){
                        echo '<script>alert("password changed sucessfully");</script>';

                        $newToken=bin2hex(random_bytes(5));

                        $newTokenQuery = "UPDATE `session` SET `token`='$newToken' WHERE `token`='$token' AND `email_id`='$mail' ";

                        mysqli_query($conn,$newTokenQuery);
                    }

               }
    
            }else{
                echo '<script>alert("incorrect old password");</script>';
            }
    
        }



    }



    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change-password</title>
</head>
<body>
    <div>
        <form action="gautam-change-password.php" method="POST">
            <input type="text" placeholder="old password" name="oldpassword"><br>
            <input type="text" placeholder="new password" name="newpassword" ><br>
            <input type="text" placeholder="comfirm password" name="cnewpassword"><br>
            <input type="submit" value="change-password"><br>
        </form>
    </div>
</body>
</html>