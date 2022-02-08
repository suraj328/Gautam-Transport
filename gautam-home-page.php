
<?php

    session_start();

    

    if($_SESSION['loggedin']!=true || !isset($_SESSION['loggedin'])){
        header("location:Gautam-Transport-login.php");
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
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <span><img src="<?php echo$_SESSION['profile-image']; ?> " alt="load.."></span>

            <span class="transport-text">Gautam Transport</span>
            <span class="right-bar"><i onclick="bar();" class="fas fa-bars bar-icon"></i></span>
            <span class="search-box">
            <input class="search input" type="Search" placeholder="&#xf002; Search" disabled>
            <button class="search search-btn" type="submit" disabled><i class="fal fa-search"></i></button>
        </span>
            <span id="right-content">
        <a class="active"href="#">Home</a>
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
    <div class="form">
            <form action="#">
                <input style="display: block;" type="file" name="upload-file" id="uploadfile">
                <input class="upload-submit" type="submit" value="uplaod">
            </form>
        </div>
        <div class="form">
            <form action="">
                <input class="search-customer" style="display: block;" type="text" placeholder="Customer Name">
                <input class="search-submit" type="submit" value="Search">
            </form>
        </div>
        <div class="form email-div">
            <form action="">
                <input style="display: block;" type="email" name="email_id" id="email_id" placeholder="Customer Email">
                <textarea style="display: block;" name="message" placeholder="type here"id="message" cols="24" rows="5"></textarea>
                <input id="mail-send" type="submit" value="Send">
            </form>
        </div>
        <div class="form">
            <form action="">
                <h3>Customer-Request</h3>
                <input  id="search-request" type="submit" value="Search-Customer-Request">
            </form>
        </div>

    </section>
    <hr style="background-color: #607d8b;height: 5px;border: none;">
    <footer id="footer">

        <!-- <a href="tel:+9779809603594">Call</a>--> <span>Gautam Transport</span> 

    </footer>
</body>
<script src="js/gautam-home-navbar-js.js"></script>

        <script>
            alert("welcome <?php echo$_SESSION['full-name']." to gautam transport"; ?>");
        </script>
</html>