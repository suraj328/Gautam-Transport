<?php
    include 'Backend/dbconfig.php';
    session_start();
    $Exist=false;
    $Existimg=false;
    
    if (!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['cpassword']) && !empty($_FILES['profile']) ) {
        
        $full_name=strtolower(trim($_POST['full_name']));
        $email=strtolower(trim($_POST['email']));
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $image = $_FILES['profile'];

        $imageName=$image['name'];
        $imagePath=$image['tmp_name'];
        $imageError=$image['error'];


        
        if($password==$cpassword){



            $hashpassword=password_hash($password,PASSWORD_BCRYPT);
            $token=bin2hex(random_bytes(5));
            

            $searchEmail="SELECT * from `session` WHERE `email_id` = '$email'";
            $searchEmailResult=mysqli_query($conn,$searchEmail);
            $searchEmailRow=mysqli_num_rows($searchEmailResult);
            
                
                if ($searchEmailRow==0) {

                    $reciver_mail=$email;
                    $subject="Verify Your account by Gautam-Transport";
                    $body="Hello,$full_name Click on this link to verify your account: http://localhost/Gautam-Transport/verifyAccount.php?token=$token";
                    $sender_mail="From:shahsuraj328@gamil.com";
    
                    if(mail($reciver_mail,$subject,$body,$sender_mail)){

                        $_SESSION['username']=$full_name;

                        if ($imageError==0) {
                            $distFolder='UserProfile/'.$imageName;
                            move_uploaded_file($imagePath,$distFolder);
                            $insertQuery="INSERT INTO `session`(`full_name`,`email_id`,`password`,`profile`,`token`,`status`,`position`) VALUES('$full_name','$email','$hashpassword','$distFolder','$token','not_verify','customer')";

                            if(mysqli_query($conn,$insertQuery)){
                                echo'<script>alert("Your account created sucessfully");</script>';
                            }else{
                                echo'<script>alert("Account creation failed");</script>';
                            }

                        }else{
                            $Existimg=true;
                            $_SESSION['alertimg']="invalid image";
                        }
                        echo'<script>alert("Check your mail to verify your account");</script>';
                    }else{
                        
                    $Exist=true;
                    $_SESSION['alert']="invalid email";
                        
                    }
                
                }else{
                    
                    $Exist=true;
                    $_SESSION['alert']="email already taken";
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
    <title>Gautam-Transport-Signup</title>
    <link rel="stylesheet" href="gautam-signup.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="login-background display-grid">
            <div class="inner-div form-background">
                <p id="Gautam">Gautam Transport</p>
                <a href="Gautam-Transport-Login.php">Process to login</a>
                <form action="http://localhost/Gautam-Transport/gautam-signup.php" method="POST" id="sign-up" enctype="multipart/form-data" onsubmit="event.preventDefault();validateForm();">
                    <div class="input-block">
                        <input type="text" placeholder="&#xf007; Full Name" id="full_name" name=full_name>
                        <div id="alertname" style="color:red;background-color:yellow;"></div>
                        <input type="text" placeholder="&#xf199; Email ID" id="email"  name="email">
                        <div id="alertemail" style="color:red;background-color:yellow;">
                        <?php  

                        
                        if ($Exist==true) {
                            echo$_SESSION['alert'];
                        }
                        ?>

                        </div>
                        <input type="password" placeholder="&#xf26e; password" id="password" name="password">
                        <div id="alertpassword" style="color:red;background-color:yellow;"></div>
                        <input type="password" placeholder="&#xf26e; comfirm password" id="cpassword" name="cpassword">
                        <div id="alertcpassword" style="color:red;background-color:yellow;"></div>
                        <p style="color: red;">*for profile picture</p>
                        <input type="file" id="profile" name="profile">
                        <div id="alertfile" style="color:red;background-color:yellow;">
                        <?php  

                        if ($Existimg==true) {
                            echo$_SESSION['alertimg'];
                        }
                        ?>
                    
                        </div>
                        
                        <input type="submit" value="sign up" id="signup-submit">
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <script src="Js/form-signup-validation.js">
        
    </script>
</body>

</html>