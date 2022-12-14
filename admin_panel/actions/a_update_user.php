<?php
require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';
session_start();
if (isset($_SESSION['USER'])) {
    header("Location: ../user_panel/user.php");
    exit;
} 

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../login.php");
    exit;
}

if ($_POST) {
    $user_name = $_POST['user_name'];
    
    $status = $_POST['status'];
    $user_allowed = $_POST['user_allowed'];
    $id = $_POST['id'];


    $photo = file_upload($_FILES['photo']); //file_upload() called  
    if ($photo->error === 0) {
        ($_POST["photo"] = "avatar.png") ?: unlink("../pictures/$_POST[photo]");
        $sql = "UPDATE users SET user_name = '$user_name', photo = '$photo->fileName' WHERE id = {$id}";
    } else {
       $sql = "UPDATE users SET user_name = '$user_name', photo = '$photo', status = '$status', user_allowed = '$user_allowed' WHERE id = {$id}";  
    }
       if (mysqli_query($connect, $sql) === TRUE) {
       $class = "success";
       $message = "The record was successfully updated";
       $uploadError = ($photo->error != 0) ? $photo->ErrorMessage : '';
   } else {
       $class = "danger";
       $message = "Error while updating record : <br>" . mysqli_connect_error();
       $uploadError = ($photo->error != 0) ? $photo->ErrorMessage : '';
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