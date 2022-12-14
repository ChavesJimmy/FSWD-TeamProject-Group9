<?php
session_start();
require_once '../components/db_connect.php';
require_once '../components/file_upload.php';


if (isset($_SESSION['USER'])) {
    header("Location: ../user_panel/index_user.php");
    exit;
} 

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $user_name = $data['user_name'];
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $email = $data['email'];
        $address = $data['address'];
        $birth_date = $data['birth_date'];
        $photo = $data['photo'];  
        $status = $data['status'];
        $user_allowed = $data['user_allowed'];  
    } else {
            header("location: error.php");
        }
       
} else {
    header("location: error.php");
}


$class = 'd-none';
if (isset($_POST["submit"])) {
    $user_name = $_POST['user_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $birth_date = $_POST['birth_date'];
    $photo = $_POST['photo'];  
      
    $user_allowed = $_POST['user_allowed'];  
    $uploadError = ''; 
    $photoArray = file_upload($_FILES['photo']); 
    $photo = $photoArray->fileName;
    if ($photoArray->error === 0) {
        ($_POST["photo"] == "avatar.png") ?: unlink("../pictures/{$_POST["photo"]}");
        $sql = "UPDATE users SET user_name = '$user_name', first_name = '$first_name', last_name = '$last_name', email = '$email', birth_date = '$birth_date', address = '$address' photo = '$photoArray->fileName' WHERE id = {$id}";
    } else {
        $sql = "UPDATE users SET user_name = '$user_name', first_name = '$first_name', last_name = '$last_name', email = '$email', birth_date = '$birth_date', address = '$address' WHERE id = {$id}";
    }
    if (mysqli_query($connect, $sql) === true) {
        $class = "alert alert-success";
        $message = "Successfully updated";
        $uploadError = ($photoArray->error != 0) ? $photoArray->ErrorMessage : '';
        header("refresh:3;url=../a_update_admin.php?id={$id}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating : <br>" . $connect->error;
        $uploadError = ($photoArray->error != 0) ? $photoArray->ErrorMessage : '';
        header("refresh:3;url=../a_update_admin.php?id={$id}");
    }
}
$backBtn = '';
 mysqli_close($connect); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <?php require_once '../components/boot.php' ?>
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Update your account</h2>
        <img class='img-thumbnail rounded-circle' src='../pictures/<?= $data['photo'] ?>' alt="<?= $first_name ?>">
        <form method="post" enctype="multipart/form-data" action="actions/a_update_admin.php">
            <table class="table">
                <tr>
                    <th>User Name</th>
                    <td><input class="form-control" type="text" name="user_name" placeholder="User Name" value="<?= $user_name ?>" /></td>
                </tr>
                 <tr>
                    <th>First Name</th>
                    <td><input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?= $first_name ?>" /></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?= $last_name ?>" /></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input class="form-control" type="email" name="email" placeholder="Email" value="<?= $email ?>" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input class="form-control" type="text" name="address" placeholder="Address" value="<?= $address ?>" /></td>
                </tr>
                <tr>
                    <th>Birth Date</th>
                    <td><input class="form-control" type="date" name="birth_date" placeholder="Birth Date" value="<?= $birth_date ?>" /></td>
                </tr>
                <tr>
                    <th>Photo</th>
                    <td><input class="form-control" type="file" name="photo" /></td>
                </tr>
                <tr>
                
                    <input type="hidden" name="id" value="<?= $data['id'] ?>" />
                    <input type="hidden" name="photo" value="<?= $data['photo'] ?>" />
                    <td><button name="submit" class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="admin.php<?php $backBtn ?>"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>