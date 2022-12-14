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
    $answer=$_POST['answer'];
    $fk_review=$_POST['fk_review'];
    $user=$_POST['fk_user'];
    $message="";
    $sql = "INSERT INTO review_answer(answer, fk_review, fk_user) VALUES('$answer', $fk_review, $user)";

    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The review was successfully answered <br>
            ";
    } else {
        $class = "danger";
        $message = "Error while answering. Try again: <br>" . $connect->error;
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