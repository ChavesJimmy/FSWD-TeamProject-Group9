<?php
session_start();

require_once '../components/db_connect.php';
$userinfo =mysqli_query($connect, "SELECT * FROM users WHERE id={$_SESSION['USER']}");
$info= mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if($info['user_allowed']=='banned'){
  header('Location: ../ban.php');
  exit;
}
 if (isset($_SESSION['ADMIN'])) {
     header('Location: ../admin_panel/index_admin.php');
    exit;
 }
 if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
  header('Location: ../login.php');
 exit;
}

$query = "SELECT * FROM users WHERE id={$_SESSION['USER']}";
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
    <link rel="stylesheet" href="../css/style.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/49748d0fd6.js" crossorigin="anonymous"></script>
    </head>

<body>
<?php require_once("../components/navbar_user.php");
?>
    <?php require_once '../components/boot.php' ?>
    
    <style type="text/css">
        .manageProduct {
            margin: middle;
        }

        .card-user {
            padding-top: 125px;
        }

        .card-body-user {
            height: 200px;
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
<body class="bg-light">
    <div class="container py-4 h100">
        <div class="row">
            <div class="col-lg-4">
                <div class="card-user mb-4">
                    <div class="card-body-user text-center rounded-3" style="  background-color: rgba(127, 123, 116, 0.8431372549);">
                        <img src="../pictures/<?= $photo ?>" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;margin-top:20px;">
                        <h5 class="my-4">Hello, <?= $user_name ?>!</h5>
                        <div class="d-flex justify-content-center mb-2">
                            <a class=" btn btn-primary ms-1" href="update.php?id=<?= $_SESSION['USER'] ?>">Update your account</a>
                            <a class="btn btn-outline-danger ms-1" href="../logout.php?logout">Log Out</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 p-4">
                <div class="card-body rounded-3 p-4" style="  background-color: rgba(127, 123, 116, 0.8431372549);">
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
    </div>
    </div>
    </div>
    </div>
    <?php require_once "../components/footer.php" ?>

</body>

</html>