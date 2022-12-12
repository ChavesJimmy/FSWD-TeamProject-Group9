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
$type=$_GET['type'];
$sql_products = "SELECT * FROM products WHERE type = {$type}";
$result_products = mysqli_query($connect,$sql_products);
$tbody = "";

if ($result_products->num_rows > 0) {
    while ($row = $result_products->fetch_array(MYSQLI_ASSOC)) {
       
                $tbody .= "<tr>
                    <td><img class='img-thumbnail rounded-circle' src='../pictures/" . $row['picture'] . "'></td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['price'] . "</td>
                    <td>" . $row['fk_discount'] ." </td>
                    <td>".$row['displ']."</td>
                    <td><a href='update_products.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
                    <a href='delete_product.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a>
                    <a href='sale_statistic.php?id=". $row['id']."'>Sales</a>
                    </td>
                 </tr>";
            }
        } else {
            $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
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
 
    <h1>products list</h1>
    <table class='table table-striped'>
                    <thead class='table-success'>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Price (EUR)</th>
                            <th>Discount_ID</th>
                            <th>Displayed?</th>
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