<?php
session_start();


// if (isset($_SESSION['admin'])) {
//     header('Location: ../index_admin.php');
//     exit;
// }
// if (!isset($_SESSION['user'])) {
//     header("Location: ..login.php");
//     exit;
// }

require_once '../components/db_connect.php';

$query = "SELECT * FROM users WHERE id={$_SESSION['user']}";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$user_name = $row['user_name'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$email = $row['email'];
$address = $row['address'];
$birth_date = $row['birth_date'];
$photo = $row['photo'];
$status = $row['status'];
$user_allowed = $row['user_allowed'];


mysqli_close($connect);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Welcome <?= $user_name ?></title>
    <?php require_once '../components/boot.php' ?>
    
    <style type="text/css">
        .manageProduct {
            margin: middle;
        }

        .img-thumbnail {
            width: 170px !important;
            height: 150px !important;
        }

        td {
            text-align: left;
            vertical-align: middle;
        }

        tr {
            text-align: middle;
        }
    </style>
</head>
<body>
    <div class="container py-4 h100">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="pictures/<?= $picture ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-4">Hello <?= $user_name ?></h5>
                        <div class="d-flex justify-content-center mb-2">
                            <a class=" btn btn-primary ms-1" href="update.php?id=<?= $_SESSION['user'] ?>">Update your account</a>
                            <a class="btn btn-outline-danger ms-1" href="logout.php?logout">Log Out</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card card-body ">
                <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">User name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $user_name ?></p>
                        </div>
                    </div>
                    <hr>
                     <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">First name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $first_name ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Last name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $last_name ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $email ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Address</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $address ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Birth Date</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $birth_date ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Status</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?= $status ?></p>
                        </div>
                    </div>
                    
</body>

</html>