<?php
session_start();
require_once '../components/db_connect.php';

/* // if adm will redirect to dashboard
if (isset($_SESSION['ADMIN'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
    header("Location: index.php");
    exit;
} */
// take infos from all users except the admin
// $id = $_SESSION['ADMIN'];
$status = 'ADMIN';
$sql = "SELECT * FROM users WHERE status != '$status'";
$result = mysqli_query($connect, $sql);
$tbody2 = "";

if ($result->num_rows > 0) {
    while ($row2 = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody2 .= "<tr>
            <td><img class='img-thumbnail rounded-circle' src='" . $row2['photo'] . "'></td>
            <td>" . $row2['user_name'] . "</td>
            <td><a href='update_user.php?id=" . $row2['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete_user.php?id=" . $row2['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
         </tr>";
    }
} else {
    $tbody2 = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}
//print products
$sql_products = "SELECT * FROM products";
$result_products = mysqli_query($connect,$sql_products);
mysqli_close($connect); 
$tbody = "";

if ($result_products->num_rows > 0) {
    while ($row = $result_products->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail rounded-circle' src='" . $row['picture'] . "'></td>
            <td>" . $row['id'] . "</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['price'] . "</td>
            <td><a href='update_products.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete_product.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a>
            <a href='sale_statistic.php?id=". $row['id']."'>Sales</a>
            </td>
         </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="container">
        <div class="hero">
            <img class="userImage" src="pictures/<?php /*  echo $row['picture'];  */?>" alt="<?php /*  echo $row['first_name']; */ ?>">
            <p class="text-white">Hi <?php /* echo $row['first_name']; */ ?></p>
        </div>
        <a href="../logout.php?logout">Sign Out</a> <br>
    </div>
    <h1>products list</h1>
    <table class='table table-striped'>
                    <thead class='table-success'>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
    <h1>users list</h1>
    <table class='table table-striped'>
                    <thead class='table-success'>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody2 ?>
                    </tbody>
                </table>

</body>
</html>