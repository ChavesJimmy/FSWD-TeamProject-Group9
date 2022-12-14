<?php
session_start();
require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';
if (isset($_SESSION['USER'])) {
    header("Location: ../user_panel/user.php");
    exit;
} 

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../login.php");
    exit;
}



if ($_POST) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $availability = $_POST['availability'];
    $discount = $_POST['Discount'];
    $displ=$_POST['displ'];
    $id = $_POST['id'];
    
    $uploadError = '';

    $picture = file_upload($_FILES['picture'], 'noimage'); 
    if ($picture->error === 0) {
        ($_POST["picture"] = "noimage.jpg") ?: unlink("../pictures/$_POST[picture]");
        $sql = "UPDATE products SET name = '$name', picture = '$picture->fileName' WHERE id = {$id}";
    } else {
        $sql = "UPDATE products SET name = '$name', price = $price, description = '$description', type = '$type', availability='$availability', displ='$displ', Discount='$discount' WHERE id = {$id}";  
    }
   if (mysqli_query($connect, $sql) === TRUE) {
       $class = "success";
       $message = "The record was successfully updated";
       $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
   } else {
       $class = "danger";
       $message = "Error while updating record : <br>" . mysqli_connect_error();
       $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
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