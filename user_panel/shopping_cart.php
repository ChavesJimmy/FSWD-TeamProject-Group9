<?php 
require_once '../components/db_connect.php';

//take infos from shopping cart
//$user=$_GET['id'];
$sql = "SELECT * from shopping_cart 
JOIN users ON users.id=shopping_cart.fk_user
JOIN products ON products.id=shopping_cart.fk_produkt
where shopping_cart.fk_user=3";
$result = mysqli_query($connect, $sql);
/* $tbodySum=0;

calculate total price(doesn't work)
function Amount($price)
        {
            // calculate total price here
            global $tbodySum;
            $tbodySum = $price;    
    } */
$tbody = ''; 
if (mysqli_num_rows($result)  > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if($row['Discount']>0){
            $price=$row['price']-($row['price']*$row['Discount']/100);
        }else{
            $price=$row['price'];
        }
        $tbody.=$row['name'] ." ".$price ."EUR <br>";
    }/* Amount($price) */;
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
    Total : <?= ''?>
    <h1>My infos</h1>
    <?= $tbodyUser?>
    <h1>Payment Method</h1>
    <form action="actions/pay.php" method="post">
        <select name="payment_method">
            <option value="Paypal">Paypal</option>
            <option value="Click and collect">Click and Collect</option>
            <option value="Credit Card">Credit Card</option>
    <input type="hidden" name="user" value="<?= ''?>">
    <input type="hidden" name="products" value="<?= ''?>">
    <input type="hidden" name="date" value="<?= date('YYY-MM-dd')?>">


        </select><br>
        <button type="submit">Pay</button>
    </form>
    <script>
        
    </script>
</body>
</html>