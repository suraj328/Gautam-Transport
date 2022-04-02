<?php
    include'./Backend/dbconfig.php';


    $psearch = 0;
    $maxSearch = 9;

    if(isset($_POST['page'])){
        if($_POST['page'] == 1){
            $psearch = 0;
            
        }else{
            $psearch = ($_POST['page'] - 1 )* $maxSearch;
        }
    }
    

    // echo"run";
    // echo$_POST['page'];
    $sql = "SELECT * FROM `gautam_transport_item` LIMIT $psearch,$maxSearch";
    $result = mysqli_query($conn,$sql);


   
    
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>all product</title>
</head>
<style>
    .u-all-item{
        position:absolute;
        top:15%;
        left:25%;
        right:25%;
    }
    .u-all-item table{
        border-collapse:collapse;
    }
    .update-btn{
        background-color: blue;
        color:white;
    }
    .danger-btn{
        background-color: red;
        color:white;
    }
    .page-btn{
        margin-top: 10px;
        
    }
    .page-btn button{
        background-color: blue;
        padding:10px;
    }

    
</style>
<body>
    <section class="u-all-item" >

   
    <table id="all-item">
        <th>item_id</th>
        <th>item_name</th>
        <th>starting address</th>
        <th>destination_address</th>
        <th>Action</th>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
    ?>

        <tr>
            <td><?=$row['item_id'];?></td>
            <td><?=$row['item_name'];?></td>
            <td><?=$row['beginning_address'];?></td>
            <td><?=$row['destination_address'];?></td>
            <td>

            <!-- update -->
                <form id="formData<?=$row['item_id'];?>">
                    <input  style="display:none;" type="number" value="<?=$row['item_id'];?>"name="update">
                    <button class="update-btn" type="submit">Edit</button>
                </form>

                <!-- delete -->
                <form id="delData<?=$row['item_id'];?>">
                    <input style="display:none;" type="number" value="<?=$row['item_id'];?>"name="del">
                    <button class="danger-btn" type="submit">Delete</button>
                </form>
                
                
                <script>
                    // update
                    $('#formData<?=$row['item_id'];?>').on('submit',(e)=>{
                        e.preventDefault();
                        // console.log($('#formData<?=$row['item_id'];?>').serialize());
                        $.ajax({
                            url : 'item-edit.php',
                            method :'POST',
                            data : $('#formData<?=$row['item_id'];?>').serialize(),
                            success : (data)=>{
                                // console.log(data);
                                $('.u-all-item').html(data);
                            }
                        })
                    });

                    // delete
                    $('#delData<?=$row['item_id'];?>').on('submit',(e)=>{
                        e.preventDefault();
                        $.ajax({
                            url : 'item-delete.php',
                            method :'POST',
                            data : $('#delData<?=$row['item_id'];?>').serialize(),
                            success : (data)=>{
                                alert(data);
                            }
                        })
                    });
                </script>

            </td>
        </tr>

    <?php
    }
    ?>
    </table>
        <section class="page-btn">
            <button id="one" value="1">1</button>
            <button id ="two" value = "2">2</button>
            <button id ="three" value = "3">3</button>
        </section>
    </section>
    <script>
        $('#one').click(()=>{
            var pagevalue = $('#one').val();
            
            $.post('item.php',{
                page:pagevalue,
            },(info)=>{
                $('#content').html(info);
            });
        });

        $('#two').click(()=>{
            var pagevalue = $('#two').val();
            
            $.post('item.php',{
                page:pagevalue,
            },(info)=>{
                $('#content').html(info);
            });
        });


        $('#three').click(()=>{
            var pagevalue = $('#three').val();
            
            $.post('item.php',{
                page:pagevalue,
            },(info)=>{
                $('#content').html(info);
            });
        });
    </script>
</body>
</html>