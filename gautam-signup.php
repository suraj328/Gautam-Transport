<?php
    include 'Backend/dbconfig.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gautam-Transport-Signup</title>
    <link rel="stylesheet" href="gautam-signup.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="login-background display-grid">
            <div class="inner-div form-background">
                <p id="Gautam">Gautam Transport</p>
                <form action="#" method="POST" id="sign-up" onsubmit="event.preventDefault();validateForm();">
                    <div class="input-block">
                        <input type="text" placeholder="&#xf007; Full Name" id="full_name" name=full_name>
                        <div id="alertname" style="color:red;background-color:yellow;"></div>
                        <input type="email" placeholder="&#xf199; Email ID" id="email"  name="email">
                        <div id="alertemail" style="color:red;background-color:yellow;"></div>
                        <input type="password" placeholder="&#xf26e; password" id="password" name="password">
                        <div id="alertpassword" style="color:red;background-color:yellow;"></div>
                        <input type="password" placeholder="&#xf26e; comfirm password" id="cpassword" name="cpassword">
                        <div id="alertcpassword" style="color:red;background-color:yellow;"></div>
                        <p style="color: red;">*for profile picture</p>
                        <input type="file" id="profile" name="profile">
                        <div id="alertfile" style="color:red;background-color:yellow;"></div>
                        
                        <input type="submit" id="signup-submit">
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <script src="Js/form-signup-validation.js">
        
    </script>
</body>

</html>