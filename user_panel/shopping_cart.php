<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


if (!isset($_SESSION['USER'])) {
    header("Location: ../login.php");
    exit;
}

require_once '../components/db_connect.php';

$sql = "SELECT * from shopping_cart 
JOIN users ON users.id=shopping_cart.fk_user
JOIN products ON products.id=shopping_cart.fk_produkt
where shopping_cart.fk_user={$_SESSION['USER']}";
$result = mysqli_query($connect, $sql);
$product = "";
$tbodySum = '';
$totalprice = 0;
$tbody = '';
if (mysqli_num_rows($result)  > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $product .= $row['id'];
        if ($row['Discount'] > 0) {
            $price = $row['price'] - ($row['price'] * $row['Discount'] / 100);
            $totalprice += $row['price'] - ($row['price'] * $row['Discount'] / 100);
        } else {
            $price = $row['price'];
            $totalprice += $row['price'];
        }
        $tbody .= $row['name'] . " " . $price . "EUR 
        <form class='mt-3 p-3' action='actions/a_deleteItem.php?id=" . $row['id'] . "' method='post'>
        <button class='btn btn-danger' type='submit'>Delete</button></form> <br>
        ";
        $tbodySum = $totalprice;
    };
}


//take personal infos
$sqlUser = "SELECT * FROM users where id={$_SESSION['USER']}";
$resultUser = mysqli_query($connect, $sqlUser);
$tbodyUser = '';
if (mysqli_num_rows($resultUser)  > 0) {
    $rowUser = mysqli_fetch_array($resultUser, MYSQLI_ASSOC);
    $tbodyUser = "



    
    First name : " . $rowUser['first_name'] . "<br>
    Last name : " . $rowUser['last_name'] . "<br>
    Address : " . $rowUser['address'] . "<br>
    E-mail : " . $rowUser['email'] . "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../components/boot.php" ?>

    <title>Document</title>
</head>

<body class="bg-light">

    <div class="card container border rounded rounded-3 p-5 w-50" style="margin-top:2%; background-color: rgba(127, 123, 116, 0.8431372549);" style="width: 18rem;" action="actions/pay.php" method="post">
        <div class="border rounded mb-3">
            <h1 class="fs-1 mb-5" style="text-align:center;">My shopping cart</h1>
            <?= $tbody ?>

            <h3 style="text-align:center; margin-top:5%; margin-bottom:5%;">Total : <?= $tbodySum ?> €</h3>
        </div>
        <div class="border rounded">
            <h1 class="mt-2" style="text-align:center;">My infos</h1>

            <p class="fs-5" style="text-align:center; margin-top:5%; margin-bottom:5%;"><?= $tbodyUser ?></p>
        </div>
        <div class="container  p-5 w-50 mt-3">
            <h1 style="text-align:center;"></h1>

            <form class="" style="margin-top:2%;" action="actions/pay.php" method="post">
                <select class="form-control dropdown;" style="text-align:center;"  name="payment_method">
                    <option value="Paypal">Paypal</option>
                    <option value="Click and collect">Click and Collect</option>
                    <option value="Credit Card">Credit Card</option>
                    <input type="hidden" name="fk_user" value="<?= $_SESSION['USER'] ?>">



                </select><br>
                <button class="btn btn-primary w-100" type="submit">Pay</button>
            </form>

        </div>

    </div>
    <script>

    </script>
</body>

</html>