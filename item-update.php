<?php
    include './Backend/dbconfig.php';
    $unique_id = $_POST['u-item-id'];

    $citem_name = $_POST['u-item-name'];
    $cbaddress = $_POST['u-begining'];
    $cdestination = $_POST['u-destination'];

    $sql = "UPDATE `gautam_transport_item` SET `item_name`='$citem_name',`beginning_address`='$cbaddress',`destination_address`='$cdestination' WHERE `item_id` = $unique_id";
    if(mysqli_query($conn,$sql)){
        echo" Your Item_ID:-$unique_id have updated";
    }
?>