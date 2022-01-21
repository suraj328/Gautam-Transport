<?php
    include 'Backend/dbconfig.php';
    session_start();

    


    if($_SESSION['forget']==true){

        if(isset($_GET['getToken'])){
    
            $reciveToken = $_GET['getToken'];

            
            
            
            if(!empty($_POST['old-password'])  && !empty($_POST['newpassword']) && !empty($_POST['cnewpassword']) ){

                

                $oldpassword = $_POST['old-password'];
                $newpassword = $_POST['newpassword'];
                $cnewpassword = $_POST['cnewpassword'];


                


                if($newpassword==$cnewpassword){

                    

                    $searchToken = "SELECT * FROM `session` WHERE `token`= '$reciveToken' ";
                    $searchResult=mysqli_query($conn,$searchToken);
                    
                    
            
                    

                    while ($row = mysqli_fetch_assoc($searchResult) ) {

                        

                        if(password_verify($oldpassword,$row['password'])){

                            $hashOldPw=password_hash($newpassword,PASSWORD_BCRYPT);

                            $updatePassword="UPDATE `session` SET `password` = '$hashOldPw' WHERE `token` ='$reciveToken' ";

                            if(mysqli_query($conn,$updatePassword)){
                                echo'<script>alert("password reset sucessfull");</script>';

                                $generateToken=bin2hex(random_bytes(5));

                                $updateToken="UPDATE `session` SET `token` = '$generateToken' WHERE `token` ='$reciveToken' ";
                                

                                if(mysqli_query($conn,$updateToken)){
                                    header("location:Gautam-Transport-Login.php");
                                }

                            }


                        }else{
                            echo'<script>alert("old password incorrect");</script>';
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
</head>
<body>
    <form action="http://localhost/Gautam-Transport/change-user-password.php?getToken=<?php echo$reciveToken;  ?>"   method="POST">

        <input type="text" name="old-password" placeholder="Old Password">
        <br>
        <input type="text" name="newpassword" placeholder="New Password"> 
        <br>
        <input type="text" name="cnewpassword" placeholder="Comfirm New Password">
        <br>
        <input type="submit" value="change password">

    </form>
</body>
</html>