<?php 
session_start();


if (!isset($_SESSION['USER']) ) {
    header("Location: ../login.php");
    exit;
}

require_once '../components/db_connect.php';

$sql = "SELECT * from shopping_cart 
JOIN users ON users.id=shopping_cart.fk_user
JOIN products ON products.id=shopping_cart.fk_produkt
where shopping_cart.fk_user={$_SESSION['USER']}";
$result = mysqli_query($connect, $sql);
$tbodySum='';
$totalprice=0;

$tbody = ''; 
if (mysqli_num_rows($result)  > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if($row['Discount']>0){
            $price=$row['price']-($row['price']*$row['Discount']/100);
            $totalprice+=$row['price']-($row['price']*$row['Discount']/100);
        }else{
            $price=$row['price'];
            $totalprice+=$row['price'];

        }
        $tbody.=$row['name'] ." ".$price."EUR <br>";
        $tbodySum=$totalprice;
    };
}

        
//take personal infos
$sqlUser="SELECT * FROM users where id=3";
$resultUser = mysqli_query($connect, $sqlUser);
$tbodyUser = ''; 
if (mysqli_num_rows($resultUser)  > 0) {
    $rowUser = mysqli_fetch_array($resultUser, MYSQLI_ASSOC);
    $tbodyUser="
    My first name : ".$rowUser['first_name']."<br>
    My last name : ".$rowUser['last_name']."<br>
    My address : ".$rowUser['address'] ."<br>
    My email : ".$rowUser['email']."";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>My shopping cart</h1>
    <?= $tbody?>
    Total : <?= $tbodySum?>
    <h1>My infos</h1>
    <?= $tbodyUser?>
    <h1>Payment Method</h1>
    <form action="actions/pay.php" method="post">
        <select name="payment_method">
            <option value="Paypal">Paypal</option>
            <option value="Click and collect">Click and Collect</option>
            <option value="Credit Card">Credit Card</option>
    <input type="hidden" name="fk_user" value="<?= $_SESSION['USER'] ?>">
    <input type="hidden" name="fk_product" value="<?= 3 ?>">


        </select><br>
        <button type="submit">Pay</button>
    </form>
    <script>
        
    </script>
</body>
</html>