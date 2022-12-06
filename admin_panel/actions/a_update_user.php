<?php
require_once '../../components/db_connect.php';

if ($_POST) {
    $user_name = $_POST['user_name'];
    $photo = $_POST['photo'];
    $status = $_POST['status'];
    $user_allowed = $_POST['user_allowed'];
    $id = $_POST['id'];


       $sql = "UPDATE users SET user_name = '$user_name', photo = '$photo', status = '$status', user_allowed = '$user_allowed' WHERE id = {$id}";  
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
   </head>
   <body>
       <div class="container">
           <div class="mt-3 mb-3">
               <h1>Update "<?= $user_name?>" response</h1>
           </div>
           <div class="alert alert-<?php echo $class;?>" role="alert">
               <p><?php echo ($message) ?? ''; ?></p>
               <a href='../update_user.php?id=<?=$id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
               <a href='../index_admin.php'><button class="btn btn-success" type='button'>Home</button></a>
           </div>
       </div>
   </body>
</html>