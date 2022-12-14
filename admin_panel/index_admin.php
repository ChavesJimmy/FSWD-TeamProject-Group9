<?php
session_start();
require_once '../components/db_connect.php';

if (isset($_SESSION['USER'])) {
    header("Location: ../user_panel/index_user.php");
    exit;
} 

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../login.php");
    exit;
}
$sqladmin = "SELECT * FROM users WHERE status != {$_SESSION['ADMIN']}";
$resultadmin = mysqli_query($connect, $sqladmin);
if ($resultadmin->num_rows > 0) {
    $rowadmin = $resultadmin->fetch_array(MYSQLI_ASSOC);

} 
// take infos from all users except the admin
// $id = $_SESSION['ADMIN'];
$status = 'ADMIN';
$sql = "SELECT * FROM users WHERE status != '$status'";
$result = mysqli_query($connect, $sql);
$tbody2 = "";

if ($result->num_rows > 0) {
    while ($row2 = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody2 .= "<tr>
            <td><img class='img-thumbnail rounded-circle' src='../pictures/" . $row2['photo'] . "'></td>
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
$tbody = "";

if ($result_products->num_rows > 0) {
    while ($row = $result_products->fetch_array(MYSQLI_ASSOC)) {
                $sql_discount = "SELECT * FROM discount 
                JOIN products ON products.fk_discount=discount.id";
                $result_discount = mysqli_query($connect, $sql_discount);
                $discount = $result_discount->fetch_array(MYSQLI_ASSOC);
            
                if($row['Discount'] > 0){
                    //need to work on the discount formula to get the value of discount
                $tbody .= "<tr class='text-center'>
                    <td><img class='img-thumbnail rounded-circle' src='../pictures/" . $row['picture'] . "'></td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['price'] . "</td>
                    <td>" . $row['Discount'] ." </td>
                    <td>" . $row['price']-($row['Discount']*$row['price']/100). "</td>
                    <td>".$row['displ']."</td>
                    <td><a href='update_products.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
                    <a href='delete_product.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a>
                    <a href='sale_statistic.php?id=". $row['id']."'><button class='btn btn-warning btn-sm' type='button'>Sales</button></a>
                    </td>
                    <td>
                    <a href='reviews.php?id=" . $row['id'] . "'><button class='btn btn-success btn-sm' type='button'>Reviews</button></a>
                    </td>
                 </tr>";} 
                 
                 else{
                    $tbody .= "<tr>
                    <td><img class='img-thumbnail rounded-circle' src='../pictures/" . $row['picture'] . "'></td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['price'] . "</td>
                    <td>no discount</td>
                    <td> no discounted price</td>
                    <td>".$row['displ']."</td>
                    <td><a href='update_products.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
                    <a href='delete_product.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a>
                    <a href='sale_statistic.php?id=". $row['id']."'><button class='btn btn-warning btn-sm' type='button'>Sales</button></a>
                    </td>
                    <td>
                    <a href='reviews.php?id=" . $row['id'] . "'><button class='btn btn-success btn-sm' type='button'>Reviews</button></a>
                    </td>
                 </tr>";
                 }
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
    <title>Welcome - <?= $rowadmin['user_name'] ?></title>
    <style type="text/css">
        body{
            padding:2rem;
            text-align: center;
        }
        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }
        td {
            text-align: center;
            vertical-align: middle;
        }
        tr {
            text-align: center;
        }
        .userImage {
            width: 100px;
            height: auto;
        }
        #buttons{
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: space-between;
            padding: 2rem;
            border: solid 2px;
            margin: 1rem;
        }
        button{
            height: 3rem;
        }
        a{
            text-decoration: none;
            color: black;
            font-weight: bold;

        }
    </style>
</head>

<body>
    <?php require_once "../components/navbar_admin.php" ?>
    Welcome - <?= $rowadmin['user_name'] ?>  
 <br><br>
    <h1>Products list</h1>
    <div id="buttons">
        <span>Sort by type:</span>
        <button class="btn btn-info p-3"><a href="type.php?type='Others'" >Others</a></button>
        <button class="btn btn-info p-3"><a href="type.php?type='Food%20Supplements'">Food supplements</a></button>
        <button class="btn btn-info p-3"><a href="type.php?type='Materials'">Material</a></button>

    </div>
    <table class='table table-striped'>
                    <thead class='table-success'>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Price(EUR)</th>
                            <th>Discount(%)</th>
                            <th>Discounted price(EUR)</th>
                            <th>Displayed?</th>
                            <th>Action</th>
                            <th>See reviews</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
    <h1>Users list</h1>
    <table class='table table-striped'>
                    <thead class='table-success'>
                        <tr>
                            <th>Picture</th>
                            <th>User Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody2 ?>
                    </tbody>
                </table>
                <?php require_once "../components/footer.php" ?>
</body>
</html>