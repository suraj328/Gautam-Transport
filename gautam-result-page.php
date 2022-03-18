
<?php

session_start();
include 'Backend/dbconfig.php';


if($_SESSION['loggedin']!=true){
    header("location:Gautam-Transport-login.php");
}
// $_SESSION['full-name']

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
    .table-view{
        background-color: red;
        flex-direction:column;
        margin: auto;
        width:50%;
        box-shadow:1px 1px 10px red;
        background-color: #607d8bba;
        border-radius:10px;
    }
    .empty{
        height: 35px;
    }
    th{
        color:black;
        font-size:larger;
        background: linear-gradient(0.25turn, #3f87a6, #ebf8e1, #f69d3c);
    }
    td{
        width: 300px;
        height:20px;
        padding: 5px;
        text-align:center;
        font-size:large;
        background: linear-gradient(0.25turn,#ff003b94, #607d8b, #f6593ca3);
        color:black; 
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

<section id="content" >
    <div class="empty"></div>
    
    <table border="1" class="table-view">
        <thead>
            <th>Item_id</th>
            <th>Item_name</th>
            <th>begining_address</th>
            <th>destination_address</th>
            <th>Contact</th>
            
        </thead>
    
    <?php
        include 'Backend/dbconfig.php';
        $showHead=false;
        $itemViewQuerry = "SELECT `item_id`,`item_name`,`beginning_address`, `destination_address` FROM `gautam_transport_item`WHERE `upload_dates`=CURDATE()";
        $itemConnQuerry = mysqli_query($conn,$itemViewQuerry);
        $itemRowQuerry = mysqli_num_rows($itemConnQuerry);
        
        if ($itemRowQuerry !=0) {
            $showHead=true;
            
            while($result = mysqli_fetch_array($itemConnQuerry)){
                ?>

                    
               
                    <tbody>
                        <tr>
                            <td> <?php echo$result['item_id'] ; ?></td>
                            <td> <?php echo$result['item_name'];?></td>
                            <td> <?php echo$result['beginning_address'];?></td>
                            <td> <?php echo$result['destination_address'];?></td>
                            <td><a href="tel:+9779809603594">Call</a></td>
                        </tr>
                    </tbody>
                    
                    
            <?Php } 

        }else{
            echo '<h1 style="text-align:center;">No Item are Available</h1>';
        }
    ?>
</table>

        <button type="button"><a href="gautam-home-customer.php">Go Back</a></button>

         
</section>
<hr style="background-color: #607d8b;height: 5px;border: none;">
<footer id="footer">

     <span>Gautam Transport</span> 

</footer>
</body>
<script src="js/gautam-home-navbar-js.js"></script>

</html
