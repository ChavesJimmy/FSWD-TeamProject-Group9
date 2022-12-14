<?php
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
        <form action='actions/a_deleteItem.php?id=" . $row['id'] . "' method='post'>
        <button type='submit'>delete</button></form> <br>
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
    My first name : " . $rowUser['first_name'] . "<br>
    My last name : " . $rowUser['last_name'] . "<br>
    My address : " . $rowUser['address'] . "<br>
    My email : " . $rowUser['email'] . "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | Atom Body</title>
    <link rel="stylesheet" href="../css/style.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/49748d0fd6.js" crossorigin="anonymous"></script>
</head>

<body>
<?php require_once("../components/boot.php");
 require_once("../components/navbar_user.php");
?>

<body class="bg-light">

    <div class="card container border rounded rounded-3 p-5 w-50" style="margin-top:2%; background-color: rgba(127, 123, 116, 0.8431372549);" style="width: 18rem;" action="actions/pay.php" method="post">
        <div class="border rounded mb-3">
            <h1 class="fs-1" style="text-align:center;">My shopping cart</h1>
            <?= $tbody ?>

            <h3 style="text-align:center; margin-top:5%; margin-bottom:5%;">Total : <?= $tbodySum ?></h3>
        </div>
        <div class="border rounded">
            <h1 class="mt-2" style="text-align:center;">My infos</h1>

            <h3 style="text-align:center; margin-top:5%; margin-bottom:5%;"><?= $tbodyUser ?></h3>
        </div>
        <div class="container border rounded rounded-3 p-5 w-50 mt-3">
            <h1 style="text-align:center;">Payment Method</h1>

            <form class="form-control" style="margin-top:2%;" action="actions/pay.php" method="post">
                <select style="text-align:center;" name="payment_method">
                    <option value="Paypal">Paypal</option>
                    <option value="Click and collect">Click and Collect</option>
                    <option value="Credit Card">Credit Card</option>
                    <input type="hidden" name="fk_user" value="<?= $_SESSION['USER'] ?>">



                </select><br>
                <button class="btn btn-primary" type="submit">Pay</button>
            </form>

        </div>

    </div>

    <?php require_once "../components/footer.php" ?>

    <script>

    </script>


</body>

</html>