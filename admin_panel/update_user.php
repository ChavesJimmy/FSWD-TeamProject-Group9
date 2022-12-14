<?php
session_start();
require_once '../components/db_connect.php';

if (isset($_SESSION['USER'])) {
    header("Location: ../user_panel/index_user.php");
    exit;
} 

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../login.php");
    exit;
}
if ($_GET['id']) {
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
        $birth_date = $data ['birth_date'];
        $photo = $data ['photo'];
        $status = $data ['status'];
        $user_allowed = $data ['user_allowed'];

          
    }
}

//update
$class = 'd-none';
if (isset($_POST["submit"])) {
    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $id = $_POST['id'];
    //variable for upload pictures errors is initialized
    $uploadError = '';
    $photoArray = file_upload($_FILES['photo']); //file_upload() called
    $photo = $photoArray->fileName;
    if ($photoArray->error === 0) {
        ($_POST["photo"] == "avatar.png") ?: unlink("pictures/{$_POST["photo"]}");
        $sql = "UPDATE users SET first_name = '$f_name', last_name = '$l_name', email = '$email', date_of_birth = '$date_of_birth', picture = '$photoArray->fileName' WHERE user_id = {$id}";
    } else {
        $sql = "UPDATE users SET first_name = '$f_name', last_name = '$l_name', email = '$email', date_of_birth = '$date_of_birth' WHERE user_id = {$id}";
    }
    if (mysqli_query($connect, $sql) === true) {
        $class = "alert alert-success";
        $message = "The record was successfully updated";
        $uploadError = ($photoArray->error != 0) ? $photoArray->ErrorMessage : '';
        header("refresh:3;url=update.php?id={$id}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connect->error;
        $uploadError = ($photoArray->error != 0) ? $photoArray->ErrorMessage : '';
        header("refresh:3;url=update.php?id={$id}");
    }
}

mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../components/boot.php' ?>
    <title>Edit User Infos</title>
</head>

<body class="bg-light">
    <fieldset>
        <p class='fs-1 fw-bold mt-4 mb-5' style="text-align:center;"> Update User infos</p>
        <form class="cont1 container border rounded rounded-3 p-5 w-50" style="margin-top:2%; background-color: rgba(127, 123, 116, 0.8431372549);" action="actions/a_update_user.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>User Name</th>
                    <td><input class='form-control' type="text" name="user_name" placeholder="Product Name" value="<?= $user_name ?>" /></td>
                </tr>
                <tr>
                    <th>Photo</th>
                    <td><input class='form-control' type="file" name="photo" value="<?= $photo ?>" /></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <select class="form-select" name="status" aria-label="Default select example">
                            <option selectted value="<?= $status ?>"><?= $status ?></option>
                            <option value='USER'>User</option>
                            <option value='ADMIN'>Admin</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Allowed</th>
                    <td>
                        <select class="form-select" name="user_allowed" aria-label="Default select example">
                            <option selected value="<?= $user_allowed ?>"><?= $user_allowed ?></option>
                            <option value='allowed'>Allowed</option>
                            <option value='banned'>Banned</option>
                        </select>
                    </td>
                </tr>
                <input type= "hidden" name= "id" value= "<?php echo $data['id'] ?>" />

                <tr>
                    <td><button class='btn btn-success' type="submit">Update</button></td>
                    <td><a href="index_admin.php"><button class='btn btn-dark' type="button">Home</button></a></td>
                    <td><a class="btn btn-danger" href="delete_user.php?id=<?=$id?>"> Delete User </a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>
</html>