
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
            <input class="search input" type="Search" placeholder="&#xf002; Search">
            <button class="search search-btn" type="submit"><i class="fal fa-search"></i></button>
        </span>
            <span id="right-content">
        <a class="active"href="#">Home</a>
        <a href="#">Contact</a>
        <a href="#">Location</a>
        <select name="session" id="session">
            <option value="nochange" selected disabled></option>
            <option value="https://www.youtube.com">Change Pw</option></a>
            <option value="gautam-logout.php">Log-Out</option>
        </select>
        </span>
        </nav>
        <hr style="background-color: #607d8b;height: 5px;border: none;">
    </header>

    <section id="content" class="body-content">

    </section>
    <hr style="background-color: #607d8b;height: 5px;border: none;">
    <footer id="footer">

        <a href="tel:+9779809603594">Call</a> <span>Gautam Transport</span>

    </footer>
</body>
<script src="js/gautam-home-navbar-js.js"></script>

        <script>
            alert("welcome <?php echo$_SESSION['full-name']." to gautam transport"; ?>");
        </script>
</html>