<?php
session_start();

/* if (isset($_SESSION['USER']) != "") {
    header("Location: ../../home.php");
    exit;
}

if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
    header("Location: ../../index.php");
    exit;
} */

require_once '../../components/db_connect.php';

if ($_POST) {
    $name = $_POST['name'];
    $picture = $_POST['picture'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $availability = $_POST['availability'];
    echo $availability;

    $sql = "INSERT INTO products(name, picture, description, price, type, availability) VALUES('$name', '$picture', '$description', '$price', '$type', '$availability')";

    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td> $name </td>
            <td> $price </td>
            </tr></table><hr>";
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
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
            <a href='../index_admin.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
    </div>
</body>
</html>