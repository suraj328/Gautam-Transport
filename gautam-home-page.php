
<?php
    
    session_start();

    

    if($_SESSION['aloggedin']!=true || !isset($_SESSION['aloggedin'])){
        header("location:Gautam-Transport-login.php");
        
    }
    $alert=false;
    


    include 'Backend/dbconfig.php';

    // for recording item to gautam_transport_item

    if(!empty($_POST['itemName']) && !empty($_POST['start_address']) && !empty($_POST['dest_address'])){
        $itemName = trim($_POST['itemName']);
        $start_address = trim($_POST['start_address']);
        $dest_address = trim($_POST['dest_address']);

        $itemQuery = "INSERT INTO `gautam_transport_item`(`item_name`,`upload_dates`,`beginning_address`,`destination_address`) VALUES('$itemName',CURDATE(),'$start_address','$dest_address') ";
        if(mysqli_query($conn,$itemQuery)){
            $alert=true;
        }
    }

    // for mail
    $invalidMail=false;
    $mailSuccess = false;
    if(!empty($_POST['email_id']) && !empty($_POST['message'] )){
        $email = trim($_POST['email_id']);
        $messsage = trim($_POST['message']);

        include 'Backend/dbconfig.php';
        $checkEmail = "SELECT `email_id` FROM `session` WHERE `email_id`= '$email'";
        $checkEmailConn = mysqli_query($conn,$checkEmail);
        $checkEmailRow = mysqli_num_rows($checkEmailConn);

        if($checkEmailRow == 1){
            
            $reciverMail = $email;
            $subject = "From Gautam Transport";
            $body =$messsage;
            $sender_mail="From:shahsuraj328@gamil.com";

            if(mail($reciverMail,$subject,$body,$sender_mail)){
                $mailSuccess = true;
            }

        }else{
            $invalidMail=true;
        }

    }
    
    // search customer
    $showDiv = false;
    $noResult = false;
    if(!empty($_POST['customer_name'])){
        $name=trim($_POST['customer_name']);
        $searchCustomer = "SELECT * FROM `session` WHERE `full_name` LIKE '$name%'";
        $searchConn=mysqli_query($conn,$searchCustomer);
        $searchRow=mysqli_num_rows($searchConn);
        if($searchRow>0){

            $showDiv = true;
        }else{
            $noResult = true;
        }
       
    }

    $requestDiv = false;
    if(isset($_POST['Search_Request'])){
       
        
            $requestDiv = true;
         
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
        .item{
            margin: 5px;
            padding: 5px;
            display:flex;
            width:100%;
            font-size:larger;
        }
        ::placeholder{
            color:black;
        }
        #customer-search{
            position:absolute;
            background-color: #465e74;
            top: 20%;
            left: 18%;
            border: 2px solid burlywood;
            border-radius:5px;
            z-index: 2;

        }
        .scross{
           
            font-size:20px;
            margin: auto;
        }
        .search-table{
            margin:auto;
            border-collapse: collapse;
        }
        th{
        color:black;
        font-size:larger;
        border:1px solid black;
    }
    td{
        padding: 5px;
        text-align:center;
        font-size:large;
        border:1px solid black;
        color:black;
        
    }
    #request{
        position:absolute;
        background-color: #465e74;
        top: 20%;
        left: 18%;
        z-index: 2;
        border: 2px solid burlywood;
        border-radius: 2px;
    }

    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <span><img src="<?php echo$_SESSION['profile-image'];  ?> " alt="load.."></span>

            <span class="transport-text">Gautam Transport</span>
            <span class="right-bar"><i onclick="bar();" class="fas fa-bars bar-icon"></i></span>
            <span class="search-box">
            <input class="search input" id="product" type="text" value="product"readonly>
        </span>
            <span id="right-content">
        <a class="active"href="gautam-home-page.php">Home</a>
        <a href="tel:+9779809603594">Contact</a>
        <a href="https://goo.gl/maps/sCqvBRuafiZfd7Gm8">Location</a>
        <select name="session" id="session">
            <option value="nochange" selected disabled></option>
            <option value="gautam-change-password.php">Change Pw</option></a>
            <option value="gautam-logout.php">Log-Out</option>
        </select>
        </span>
        </nav>
    </header>
    <hr style="background-color: #607d8b;height: 5px;border: none;">
    <?php
    if($showDiv){
    ?>
        <div id="customer-search">
                <div  class="cross" >
                <span  onclick="hide()"><i class="fas fa-times-circle  scross"></i></span>
                </div>
                <br>
                <table  class="search-table">
                    <thead>
                        <th>User_id</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>profile</th>
                    </thead>
                    <?php
                    while($result = mysqli_fetch_array($searchConn)){
                        ?>
                     <tbody>
                        <tr>
                            <td><?php echo$result['user_no'] ;?></td>
                            <td><?php echo$result['full_name']  ;?></td>
                            <td><?php echo$result['email_id'] ;?></td>
                            <td><img src="<?php  echo$result['profile'] ;?>" alt="" height="15px" width="200px"></td>
                        </tr>
                     </tbody>
                        
                <?php
                    }
                    ?>
                        

                </table>
                <script>
                    function hide(){

                        document.getElementById('customer-search').style.display='none';
                    }
                    
                </script>
            </div>
    <?php
    }
    ?>

    <?php
    if($requestDiv){
        ?>
    
    <div id="request" >
        <div><span class="request-cross" onclick="reqHide()"><i class="fas fa-times-circle"></i></span></div>
        <table class="search-table">
            <thead>
                <th>user_no</th>
                <th>Name</th>
                <th>Email</th>
                <th>Item</th>
                <th>Date</th>
            </thead>
        <?php  
            $sql = "SELECT * FROM `request_item`  WHERE `request_date` = CURDATE() ";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td> <?php echo$row['user_no'] ?> </td>
                        <td> <?php echo$row['full_name'] ?> </td>
                        <td> <?php echo$row['email_id'] ?> </td>
                        <td> <?php echo$row['item'] ?> </td>
                        <td> <?php echo$row['request_date'] ?> </td>
                    </tr>
                <?php
            }
            
            ?>
        </table>
        <script>
            function reqHide(){
                document.getElementById('request').style.display='none';
            }
        </script>
    </div>
    <?php
        }
    
    ?>   
    <section id="content" class="body-content">
        
    <div class="form">
    <span>
            <?php
            $msg1="Your Item have Inserted";
            
                if ($alert) {
                echo$msg1;
                    
                }
            ?>
        </span>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                <!-- <input style="display: block;" type="file" name="upload-file" id="uploadfile"> -->

                <input style="display:block;" type="text" class="item" placeholder="Your Item Name" name='itemName'>
                <input style="display:block;" type="text" class="item" placeholder="From:" name="start_address">
                <input style="display:block;" type="text" class="item" placeholder="To:" name="dest_address">

                <input class="upload-submit" type="submit" value="ADD" name="submitItem">
            </form>
        </div>
        <div class="form">
            <span>
                <?php  echo$noResult?"No Result Found":"";  ?>
            </span>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                <input class="search-customer" style="display: block;" type="text" placeholder="Customer Name" name="customer_name">
                <input class="search-submit" type="submit" value="Search">
            </form>
        </div>
        <div class="form email-div">
            <span>
                <p>
                    <?php
                        if($invalidMail){
                            echo'<h4>Invalid Customer Mail</h4>';
                        }else if($mailSuccess){
                            echo'<h4>MaiL Sent Success fully</h4>';
                        }
                    ?>
                </p>
            </span>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                <input style="display: block;" type="email" name="email_id" id="email_id" placeholder="Customer Email">
                <textarea style="display: block;" name="message" placeholder="type here"id="message" cols="24" rows="5"></textarea>
                <input id="mail-send" type="submit" name="email_send" value="Send">
                
            </form>
        </div>
        <div class="form">
            <form action="" method="POST">
                <h3>Customer-Request</h3>
                <input  id="search-request" type="submit" value="Search_Request" name="Search_Request">
            </form>
        </div>

    </section>
    <hr style="background-color: #607d8b;height: 5px;border: none;">
    <footer id="footer">

         <span>Gautam Transport</span> 

    </footer>
</body>
<script src="js/gautam-home-navbar-js.js"></script>
<script src="./Js/main.js"></script>
<script src="./Js/jqajax.js"></script>
        
</html>