
<?php
    
    session_start();

    

    if($_SESSION['loggedin']!=true || !isset($_SESSION['loggedin'])){
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
            echo"email exist";
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
        // echo"running";
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
            /* height:50vh; */
            /* width:50%; */
            top: 20%;
            left: 18%;
            border-radius:20px;
            
        }
        .cross{
            float:right;
            margin-right:10%;
        }
        #search-table{
            margin:auto;
        }
        th{
        color:black;
        font-size:larger;
        background: linear-gradient(0.25turn, #3f87a6, #ebf8e1, #f69d3c);
    }
    td{
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
    <?php
    if($showDiv){
    ?>
        <div id="customer-search">
                <div  class="cross" onclick="hide()">
                hide
                </div>
                <br>
                <table border="1px" id="search-table">
                    <thead>
                        <th>User_id</th>
                        <th>Email</th>
                        <th>Full Name</th>
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
                            <td><img src="<?php  echo$result['profile'] ;?>" alt="" height="15px" width="200px"><?php  echo$result['profile'] ;?></td>
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

    
    <section id="content" class="body-content">
        
    <div class="form">
    <span>
            <?php
            $msg1="data inserted sucessfully";
            
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

        
</html>