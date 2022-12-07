<?php
require_once '../../components/db_connect.php';

if ($_POST) {
    $name = $_POST['name'];
    $picture = $_POST['picture'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $availability = $_POST['availability'];
    $fk_discount = $_POST['fk_discount'];
    $displ=$_POST['displ'];
    //$fk_discount = $_POST['fk_discount'];

    $id = $_POST['id'];


       $sql = "UPDATE products SET name = '$name', price = $price, description = '$description', type = '$type', availability='$availability', displ='$displ', fk_discount='$fk_discount' WHERE id = {$id}";  
   if (mysqli_query($connect, $sql) === TRUE) {
       $class = "success";
       $message = "The record was successfully updated";
   } else {
       $class = "danger";
       $message = "Error while updating record : <br>" . mysqli_connect_error();
   }
   mysqli_close($connect);  
} else {
    header("location: ../error.php");
 }  
?>


<!DOCTYPE html>
<html lang="en">
   <head>
       <meta charset="UTF-8">
       <title>Update</title>
       <?php require_once '../../components/boot.php'?> 
   </head>
   <body>
       <div class="container">
           <div class="mt-3 mb-3">
               <h1>Update request response</h1>
           </div>
           <div class="alert alert-<?php echo $class;?>" role="alert">
               <p><?php echo ($message) ?? ''; ?></p>
               <p><?php echo ($uploadError) ?? ''; ?></p>
               <a href='../update_products.php?id=<?=$id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
               <a href='../index_admin.php'><button class="btn btn-success" type='button'>Home</button></a>
           </div>
       </div>
   </body>
</html>