<?php

include 'Backend/dbconfig.php';
session_start();

if($_SESSION['loggedin']==true || isset($_SESSION['loggedin'])){

    $mail=$_SESSION['useremail'];
    // echo$mail;

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



    }else{
        // echo '<script>alert("Any field cannt be empty");</script> ';
    }



    
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- css link -->
    <link rel="stylesheet" href="gautam-home-navbar.css">


    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- fontawsome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <style>
        #content {
            background-color: #607d8bba;
            
        }
        section{
            display:flex;
            align-items:center;
            justify-content:center;
            
        }
        section div{
            width:30%;
        }
        section div form input{
                background-color:#fff0;    
                display: block;
                width:100%;
                padding:10px;
                outline:none;
                font-size:larger;
                color:black;
                border:none;
                border-bottom:4px solid #607d8bd4;
        }

    </style>
</head>


<body>
    <header>
        <nav class="navbar">
            <span><img src="<?php echo$_SESSION['profile-image']; ?> " alt="load.."></span>

            <span class="transport-text">Gautam Transport</span>
            <span class="right-bar"><i onclick="bar();" class="fas fa-bars bar-icon"></i></span>
            <span class="search-box">
                <input class="search input" type="Search" placeholder="&#xf002; Search">
                <button class="search search-btn" type="submit"><i class="fal fa-search"></i></button>
            </span>
            <span id="right-content">
                <a class="active" href="#">Home</a>
                <a href="#">Contact</a>
                <a href="#">Location</a>
                <select name="session" id="session">
                    <option value="nochange" selected disabled></option>
                    <option value="gautam-change-password.php">Change Pw</option></a>
                    <option value="gautam-logout.php">Log-Out</option>
                </select>
            </span>
        </nav>
    </header>
    <hr style="background-color: #607d8b;height: 5px;border: none;">

    <section id="content" class="body-content">
    <div>
        <form action="gautam-change-password.php" method="POST">
            <input type="text" placeholder="Old password" name="oldpassword">
            <input type="password" placeholder="new password" name="newpassword" >
            <input type="password" placeholder="comfirm password" name="cnewpassword">
            <input style="background-color:#607d8bd4;" type="submit" value="change-password">
        </form>
    </div>
    </section>
    <hr style="background-color: #607d8b;height: 5px;border: none;">
    <footer id="footer">

        <a href="tel:+9779809603594">Call</a> <span>Gautam Transport</span>

    </footer>
</body>
<script src="js/gautam-home-navbar-js.js"></script>

<script>
            // window.alert("welcome <?php echo$_SESSION['full-name']." to gautam transport"; ?>");
</script>

</html>