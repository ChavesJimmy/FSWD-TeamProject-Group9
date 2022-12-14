<?php
session_start();

require_once '../../components/db_connect.php';

if ($_POST) {
    $fk_produkt=$_POST['fk_produkt'];
    $fk_user=$_POST['fk_user'];
    $message="";
    $sql = "INSERT INTO shopping_cart(fk_produkt, fk_user) VALUES ($fk_produkt, $fk_user)";

    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The item was added to the cart. <br>
            <table class='table w-50'><tr>
            <td> $message </td>
            </tr></table><hr>";
    } else {
        $class = "danger";
        $message = "Error while adding item. Try again: <br>" . $connect->error;
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
    <?php require_once '../../components/boot.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../index_user.php'><button class="btn btn-primary" type='button'>Continue shopping</button></a>
            <a href='../shopping_cart.php'><button class="btn btn-primary" type='button'>Shopping Cart</button></a>

        </div>
    </div>
</body>
</html>