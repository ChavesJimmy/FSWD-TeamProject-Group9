<?php
session_start();
require_once '../../components/db_connect.php';

$id=$_GET['id'];
$class = 'd-none';
//the POST method will delete the user permanently
if ($_POST) {
    $id = $_POST['id'];
    $sql = "DELETE FROM shopping_cart WHERE fk_produkt = {$id}";
    if ($connect->query($sql) === TRUE) {
        $class = "alert alert-success";
        $message = "Successfully Deleted!";
        header("refresh:3;url=../index_user.php");
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
        <legend class='h2 mb-3'>Delete reviews request</legend>
        
        <h3 class="mb-4">Do you really want to remove this item?</h3>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <button class="btn btn-danger" type="submit">Yes, delete it!</button>
            <a href="../index_user.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
        </form>
    </fieldset>
</body>
</html>