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
    $review=$_POST['message'];
    $rating=$_POST['star'];
    $product=$_POST['product'];
    $user=$_POST['user'];
    $message="";
    $sql = "INSERT INTO products_reviews(message, fk_product, star, fk_user) VALUES('$review', $product,'$rating', $user)";

    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The review below was successfully created <br>";
          
    } else {
        $class = "danger";
        $message = "Error while adding review. Try again: <br>" . $connect->error;
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
            <a href='../index_user.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
    </div>
</body>
</html>