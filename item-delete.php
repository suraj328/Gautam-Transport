<?php

    include './Backend/dbconfig.php';
    $delitem = $_POST['del'];

    $sql = "DELETE FROM `gautam_transport_item` WHERE `item_id` = $delitem";
    if(mysqli_query($conn,$sql)){
        echo "your item id which have $delitem is deleted";
    }
?>