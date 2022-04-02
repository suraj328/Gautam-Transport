<?php
include './Backend/dbconfig.php';
// echo"update";
   $itemUpdate = $_POST['update'];
   $sql = "SELECT * FROM `gautam_transport_item` WHERE item_id = $itemUpdate";
   $result = mysqli_query($conn,$sql);
   $row =  mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .update-item-form{
            display: flex;
            flex-direction:column;
            row-gap:10px;
            font-size:larger;
        }
        section input{
            font-size:large;
        }
        .upper-update-btn button{
           padding:10px;
           background-color: #607d8bba;
           border-radius:10px;
        }
        
    </style>
</head>
<body>
    <section>
        <form id="item-update-form" class="update-item-form">
        <input style="display:none;" type="number" value = "<?=$row['item_id'];?>" name="u-item-id" >
            <section>
                <label for="item_name">Item Name</label>
                <br>
                <input id="item_name" type="text" value = "<?=$row['item_name'];?>" name="u-item-name" >
            </section>
            <section>
            <label for="begining_address">begining_address</label><br>
                <input id="begining_address" type="text" value = "<?=$row['beginning_address'];?>" name="u-begining" >
            </section>
            <section>
            <label for="destination_address">destination_address</label><br>
                <input id="destination_address" type="text" value = "<?=$row['destination_address'];?>" name="u-destination" >
            </section>
            <section class="upper-update-btn">
                <button type="submit">Update</button>
            </section>
        </form>
    </section>
    <script>
        $('#item-update-form').on('submit',(e)=>{
            e.preventDefault();
            $.ajax({
                url:'item-update.php',
                method: 'POST',
                data: $('#item-update-form').serialize(),
                success : (data)=>{
                    alert(data);
                }
            })
        });
    </script>
</body>
</html>