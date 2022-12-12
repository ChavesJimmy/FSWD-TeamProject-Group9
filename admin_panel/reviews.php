<?php
session_start();
require_once '../components/db_connect.php';

if (isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../user_panel/index_user.php");
    exit;
} 

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../login.php");
    exit;
}

//print products
$id=$_GET['id'];
$sql_reviews = "SELECT * FROM products_reviews WHERE fk_product = $id";
$result_reviews = mysqli_query($connect,$sql_reviews);
$tbody = "";

if ($result_reviews->num_rows > 0) {
    while ($row = $result_reviews->fetch_array(MYSQLI_ASSOC)) {
       
                $tbody .= "<tr>
                    <td>" . $row['message'] . "</td>
                    <td>" . $row['fk_product'] . "</td>
                    <td>" . $row['fk_user'] ." </td>
                    <td>" . $row['star'] ."⭐ </td>
                    <td>
                    <a href='delete_reviews.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a>
                    </td>
                 </tr>";
            }
        } else {
            $tbody = "<tr><td colspan='5'><center>No Reviews Available </center></td></tr>";
        }
        mysqli_close($connect); 
        
        ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../components/boot.php"?>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/49748d0fd6.js" crossorigin="anonymous"></script>
    <title>Welcome - <?php /* echo $row['first_name']; */ ?></title>
    <style type="text/css">
        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }

        td {
            text-align: left;
            vertical-align: middle;
        }

        tr {
            text-align: center;
        }

        .userImage {
            width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
    <?php require_once "../components/navbar_admin.php" ?>
 
    <h1>reviews list</h1>
    <table class='table table-striped'>
                    <thead class='table-success'>
                        <tr>
                            <th>Message</th>
                            <th>Product</th>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
    
                <?php require_once "../components/footer.php" ?>
</body>
</html>