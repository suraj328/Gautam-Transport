<?php
    include 'Backend/dbconfig.php';
    session_start();

    


    if($_SESSION['forget']==true){

        if(isset($_GET['getToken'])){
    
            $reciveToken = $_GET['getToken'];

            
            
            
            if(!empty($_POST['newpassword']) && !empty($_POST['cnewpassword']) ){

                
                $newpassword = $_POST['newpassword'];
                $cnewpassword = $_POST['cnewpassword'];


                


                if($newpassword==$cnewpassword){

                    
                    $hashPassword = password_hash($newpassword,PASSWORD_BCRYPT);
                    $searchToken = "SELECT * FROM `session` WHERE `token`= '$reciveToken' ";
                    $searchResult=mysqli_query($conn,$searchToken);
                    $searchTokenRow = mysqli_num_rows($searchResult);
                    if($searchTokenRow == 1){
                        $updatePassword="UPDATE `session` SET `password`='$hashPassword' WHERE `token`= '$reciveToken'";
                        if(mysqli_query($conn,$updatePassword)){
                            echo '<script>alert("password changed sucessfully");</script>';
                            $generateToken=bin2hex(random_bytes(5));

                                $updateToken="UPDATE `session` SET `token` = '$generateToken' WHERE `token` ='$reciveToken' ";
                                

                                // if(mysqli_query($conn,$updateToken)){
                                //     header("location:Gautam-Transport-Login.php");
                                // }

                        }else{
                            echo '<script>alert("Invalid Request");</script>';
                        }
                    }
                    

                }else{
                    echo'<script>alert("new password and comfirm password does not match");</script>';
                }



            }else{
                echo '<script>alert("filed cannt be empty");</script>';
            }    

                
            
        }

    }else{
        echo"you are out of session";
        
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset-password</title>
    <link rel="stylesheet" href="change-user-password.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="top">
        <h1 id="top"><marquee behavior="alternate" direction="right">Gautam Transport</marquee></h1>
    </div>
    
    <section id="reset-form">
    <form action="http://localhost/Gautam-Transport/change-user-password.php?getToken=<?php echo$reciveToken;  ?>"   method="POST">

            <input type="password" name="newpassword" placeholder="New Password"> 
            
            <input type="password" name="cnewpassword" placeholder="Comfirm New Password">
            
            <input id="submit" type="submit" value="change password">

        </form>
        <a href="Gautam-Transport-Login.php">Process to Login</a>
    </section>
</body>
</html>


