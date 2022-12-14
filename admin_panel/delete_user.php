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

$class = 'd-none';
if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $user_name = $data['user_name'];
        $email = $data['email'];
        $birth_date = $data['birth_date'];
        $photo = $data['photo'];
    }
}
//the POST method will delete the user permanently
if ($_POST) {
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE id = {$id}";
    if ($connect->query($sql) === TRUE) {
        $class = "alert alert-success";
        $message = "Successfully Deleted!";
        header("refresh:3;url=index_admin.php");
    } else {
        $class = "alert alert-danger";
        $message = "The entry was not deleted due to: <br>" . $connect->error;
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 70%;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }
    </style>
</head>

<body>
    <div class="<?php echo $class; ?>" role="alert">
        <p><?php echo ($message) ?? ''; ?></p>
    </div>
    <fieldset>
        <legend class='h2 mb-3'>Delete request <img class='img-thumbnail rounded-circle' src='<?php echo $photo ?>' alt="<?php echo $user_name ?>"></legend>
        <h5>You have selected the data below:</h5>
        <table class="table w-75 mt-3">
            <tr>
                <td><?php echo "$user_name " ?></td>
                <td><?php echo $email ?></td>
                <td><?php echo $birth_date ?></td>
            </tr>
        </table>
        <h3 class="mb-4">Do you really want to delete this user?</h3>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <input type="hidden" name="picture" value="<?php echo $photo ?>" />
            <button class="btn btn-danger" type="submit">Yes, delete it!</button>
            <a href="index_admin.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
        </form>
    </fieldset>
</body>
</html>