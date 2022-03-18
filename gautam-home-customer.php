
<?php
session_start();
include 'Backend/dbconfig.php';



if($_SESSION['loggedin']!=true || !isset($_SESSION['loggedin'])){
    header("location:Gautam-Transport-login.php");
}

// maill
    $requestSucess = false; 
    $mailSuccess=false;
    $unsendMail = false;
    if(!empty($_POST['c_message'])){
        $email = "bca190620_suraj@achsnepal.edu.np";
        $messsage = trim($_POST['c_message']);

        

            
            $reciverMail = $email;
            $subject = "From Gautam Transport";
            $body =$messsage;
            $sender_mail="From:shahsuraj328@gamil.com";

            if(mail($reciverMail,$subject,$body,$sender_mail)){
                $mailSuccess = true;
            }else{
                $unsendMail = true;
            }

        

    }
    $email = $_SESSION['useremail'];
    if(!empty($_POST['request-item'])){

        $sql = "SELECT * FROM `session` WHERE `email_id` = '$email'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $item = $_POST['request-item'];
        $username = $row['full_name'];
        $usernumber = $row['user_no'];
        $sqli = "INSERT INTO `request_item` values($usernumber,'$username','$email','$item',CURDATE())";
        if(mysqli_query($conn,$sqli)){
            $requestSucess = true;
        }
    }



?>



<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gautam-Transport</title>
<!-- css link -->
<link rel="stylesheet" href="gautam-home-navbar.css">

<link rel="stylesheet" href="gautam-home-body.css">


<!-- fontawesome link -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<!-- fontawsome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>
    #content {
        background-color: #607d8bba;
    }
    h1,h2,h3{
        font-family: 'Luxurious Roman', cursive;
        color:orange;
    }
    ::placeholder{
        color:black;
    }
</style>
</head>
    
<body>
<header>
    <nav class="navbar">
        <span><img src="<?php echo$_SESSION['profile-image'];?> " alt="load.."></span>

        <span class="transport-text">Gautam Transport</span>
        <span class="right-bar"><i onclick="bar();" class="fas fa-bars bar-icon"></i></span>
        <span class="search-box">
        <input class="search input" type="Search" placeholder="&#xf002; Search" disabled>
        <button class="search search-btn" type="submit" disabled><i class="fal fa-search"></i></button>
    </span>
        <span id="right-content">
    <a class="active"href="#">Home</a>
    <a href="tel:+9779809603594">Contact</a>
    <a href="https://www.google.com/maps/dir/26.9834942,85.8913698/XVRQ%2BHP9+Gautam+Dhuwanii+sewa,+Bardibas+45701/@26.9869717,85.8867008,16z/data=!3m1!4b1!4m17!1m6!3m5!1s0x39ec736141511f39:0x2e8be892dc0bb878!2sGautam+Dhuwanii+sewa!8m2!3d26.9914141!4d85.8893788!4m9!1m1!4e1!1m5!1m1!1s0x39ec736141511f39:0x2e8be892dc0bb878!2m2!1d85.8893788!2d26.9914141!3e0">Location</a>
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
<div class="form">
        <form action="gautam-result-page.php">
            <h1>Today Available item</h1>
            <input style="color:green;" class="upload-submit" type="submit" value="Show Available items ">
        </form>
    </div>
    <div class="form">
        <form action="">
            <!-- <input class="search-customer" style="display: block;" type="text" placeholder="Customer Name"> -->
            <h3>Remember Your Selected Item</h3>
            <input style="color:green;" class="search-submit" type="submit" value="Check">
        </form>
    </div>
    <div class="form email-div">
        <h4> <?php  echo$mailSuccess?"Mail Sent Sucessfully":"";
        echo$unsendMail?"Mail have not sent Sucessfully":""; ?></h4>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            <h1>Type Your Mail Here!!</h1>
            <textarea style="display: block; color:green;" name="c_message"  placeholder="type here"id="message" cols="24" rows="5"></textarea>
            <input style="color:green;" id="mail-send" type="submit" value="Send"">
        </form>
    </div>
    


    <div class="form">
        <form action="" method="POST">
            <h3>Request order</h3>
            <h3 style="color:green;"><?php echo$requestSucess?"requestproccessed":"" ?><h3>
            <input type="text" style="color:green;width:50% " id="search-request" placeholder="Request Item" name="request-item">
            <input style="color:green;"  id="search-request" type="submit" value="request">
        </form>
    </div>

</section>
<hr style="background-color: #607d8b;height: 5px;border: none;">
<footer id="footer">

    <!-- <a href="tel:+9779809603594">Call</a>--> <span>Gautam Transport</span> 

</footer>
</body>
<script src="js/gautam-home-navbar-js.js"></script>

    
</html>