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
    $user_name = $_POST['user_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $birth_date = $_POST['birth_date'];
    $id = $_POST['id'];


    
    $uploadError = ''; 
     $photoArray = file_upload($_FILES['photo'], "admavatar"); 
    if ($photoArray->error === 0) {
        ($_POST["photo"] == "admavatar.png") ?: unlink("../../pictures/$_POST[photo]");
        $sql = "UPDATE users SET user_name = '$user_name', first_name = '$first_name', last_name = '$last_name', email = '$email', birth_date = '$birth_date', address = '$address', photo = '$photoArray->fileName' WHERE id = {$id}";
    } else {
        $sql = "UPDATE users SET user_name = '$user_name', first_name = '$first_name', last_name = '$last_name', email = '$email', birth_date = '$birth_date', address = '$address' WHERE id = {$id}";
    } 
    if (mysqli_query($connect, $sql)) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($photoArray->error != 0) ? $photoArray->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
        $uploadError = ($photoArray->error != 0) ? $photoArray->ErrorMessage : '';
    }


}
$backBtn = '';
 mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <?php require_once '../../components/boot.php'; ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../update_admin.php?id=<?= $id ?>'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='../admin.php'><button class="btn btn-primary" type='button'>Admin Page</button></a>
            <a href='../index_admin.php'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
    </div>

</body>
