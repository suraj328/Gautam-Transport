<?php

    include 'Backend/dbconfig.php';
    session_start();

    $incorrectPassword=false;
    $mailerror=false;
    $verificationerror=false;
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        
        $email = strtolower(trim($_POST['email']));
        $password = $_POST['password'];
        
        $searchEmail="SELECT `email_id`  FROM `session` WHERE `email_id` = '$email' ";
        if($searchEmailQuery = mysqli_query($conn,$searchEmail)){
            $searchEmailRow = mysqli_num_rows($searchEmailQuery);
            
            
            if ($searchEmailRow == 1) {
                

                $searchStatus="SELECT `email_id` , `status` FROM `session` WHERE `email_id` = '$email'  AND `status` = 'verify' ";

                

                if ($searchStatusQuery = mysqli_query($conn,$searchStatus)) {
                    $searchStatusResult = mysqli_num_rows($searchStatusQuery);
                    

                    if ($searchStatusResult == 1) {
                        
                        $passwordProfile= "SELECT * FROM `session` WHERE `email_id`='$email' ";
                        $passwordProfileResult = mysqli_query($conn,$passwordProfile);

                        
                        
                        while ($row=mysqli_fetch_assoc($passwordProfileResult)) {
                            
                            
                            if(password_verify($password,$row['password'])){
                                $_SESSION['profile-image']=$row['profile'];
                                $_SESSION['full-name']=$row['full_name'];
                                // $_SESSION['loggedin']=true;
                                $_SESSION['useremail']=$row['email_id'];


                                $updatedToken=bin2hex(random_bytes(5));
                                

                                $updateTokenQuery="UPDATE `session` SET `token`='$updatedToken' where `email_id` = '$email' ";
                                mysqli_query($conn,$updateTokenQuery);

                                $positionQuery = "SELECT `position`,`email_id` FROM `session` WHERE `email_id`='$email' AND `position`='admin'";
                                if ($positionConnQuerry = mysqli_query($conn,$positionQuery)) {
                                    $positionQuerryresult = mysqli_num_rows($positionConnQuerry);
                                    if ($positionQuerryresult==1) {
                                        header("location:gautam-home-page.php");
                                        $_SESSION['aloggedin']=true;

                                    }else{
                                        header("location:gautam-home-customer.php");
                                        $_SESSION['cloggedin']=true;

                                    }
                                }

                            }else{
                                $incorrectPassword=true;
                                $_SESSION['incorrect-password']="Incorrect Password";
                            }

                        }

                    }else{
                        $verificationerror=true;
                        $_SESSION['verificationerror'] = "Please check your mail to verify your account";
                    }

                }
                

            }else {
                $mailerror=true;
                $_SESSION['mailerror'] = "invalid email";
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
    <title>Gautam-Transport-Login</title>
    <link rel="stylesheet" href="gautam-login-form.css">


    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


    <!-- this link is known as cdn link basically used for unique code of fontawesome and it hels to give fontawsome icon inside input field or input tag -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .alert-error{
            background-color : white;
            color : red;
        }
    </style>

</head>





<body>
    <div class="container">
        <div class="login-background display-grid">

            <div class="logo-div">
                <img src="images/Gautam-Transport-logos-black.png" height="287" width="287" alt="">
                <div class="logo-paragraph">
                    <article class="logo-paragraph">Gautam transporatation is Trustable transporatation for transoprting goods.Remeber us while transoprting goods

                    </article>

                    <footer>
                        <p>!!Follow Us!! Belive Us!!</p>
                        <p>Contact Us!!</p>
                        <p><a href=""><i class="fab fa-facebook-square"></i></a> <a href=""><i class="fas fa-envelope-open-text"></i></a></p>
                    </footer>
                </div>
            </div>
            <div class="inner-div form-background">
                <form action="http://localhost/Gautam-Transport/Gautam-Transport-Login.php" method="POST">
                    <div class="input-block">
                        <a class="create-account" href="gautam-signup.php" target="parent">Craete an Account</a>
                        <div class="alert-error">
                            <?php
                            if ($verificationerror==true) {
                                echo$_SESSION['verificationerror'];
                            }
                            ?>
                        </div>
                        <input class="input-div0 email" type="text" placeholder="&#xf007; Email" name="email">
                        <div class="alert-error">
                            <?php
                            if ($mailerror==true) {
                                
                                echo$_SESSION['mailerror'];
                            }
                            ?>
                        </div>
                        <input class="input-div" type="password" placeholder="&#xf084; Password" name="password">
                        <div class="alert-error">
                            <?php
                                if($incorrectPassword==true){
                                    echo$_SESSION['incorrect-password'];
                                }

                            ?>
                        </div>
                        <button type="submit" id="login-submit">Login <i class="fas fa-sign-in-alt"></i></button>
                        <button class="forget-password"><a href="gautam-forget-password.php">forgot password</a></button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>

</body>

</html>