<?php
require_once '../../components/db_connect.php';

if ($_POST) {
    $name = $_POST['name'];
    $picture = $_POST['picture'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $id = $_POST['id'];


       $sql = "UPDATE products SET name = '$name', price = $price, meal_description = '$description' WHERE id = {$id}";  
   if (mysqli_query($connect, $sql) === TRUE) {
       $class = "success";
       $message = "The record was successfully updated";
       $uploadError = ($image->error !=0)? $image->ErrorMessage :'';
   } else {
       $class = "danger";
       $message = "Error while updating record : <br>" . mysqli_connect_error();
       $uploadError = ($image->error !=0)? $image->ErrorMessage :'';
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
       <?php require_once '../components/boot.php'?> 
   </head>
   <body>
       <div class="container">
           <div class="mt-3 mb-3">
               <h1>Update request response</h1>
           </div>
           <div class="alert alert-<?php echo $class;?>" role="alert">
               <p><?php echo ($message) ?? ''; ?></p>
               <p><?php echo ($uploadError) ?? ''; ?></p>
               <a href='../update.php?id=<?=$id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
               <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
           </div>
       </div>
   </body>
</html>