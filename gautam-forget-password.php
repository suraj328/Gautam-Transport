<?php

    include 'Backend/dbconfig.php';
    

    session_start();
    
    if(!empty($_POST['email'])){


        $email = strtolower(trim($_POST['email']));
        $checkEmail = " SELECT `email_id`, `full_name` ,`token` FROM  `session` WHERE `email_id` = '$email' ";
        $checkEmailQuery = mysqli_query($conn,$checkEmail);
        $checkEmailQueryRow = mysqli_num_rows($checkEmailQuery);

        if($checkEmailQueryRow==1){

            $checkStatus = "SELECT `email_id` , `status` FROM `session` WHERE  `email_id` = '$email' AND `status`= 'verify' ";
            $checkStatusQuery=mysqli_query($conn,$checkStatus);
            $checkStatusRow = mysqli_num_rows($checkStatusQuery);

            if($checkEmailQueryRow==1){

                
                $_SESSION['forget']= true;


                while($rowResult=mysqli_fetch_assoc($checkEmailQuery)){

                

                    $resetToken= $rowResult['token'];
                    $username = $rowResult['full_name'];

                    $reciverEmail = $email;
                    $subject = "Change Your Password";
                    $body = "hello $username click here to change password <br> http://localhost/Gautam-Transport/change-user-password.php?getToken=$resetToken";
                    $senderMail="From:shahsuraj328@gamil.com";

                    if(mail($reciverEmail,$subject,$body,$senderMail)){
                        
                        
                        echo"check your mailbox to reset your password";

                     }else{
                        echo"Invalid email";
                    }

                }

            }else{
                echo"verify your account first";
             }

        }else{
            echo"you have not created any account or invalid email";
        }


        
    }else{
        echo '<script>alert("your field is empty");</script>';
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gautam-reset-password</title>
</head>
<body>
    <form action="gautam-forget-password.php" method="POST">
    <input type="email" name="email">
    
    
    <input type="submit">
    </form>
</body>
</html>