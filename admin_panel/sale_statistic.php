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


if ($_GET['id']) {
$id=$_GET['id'];
//get product name
$sqlproduct="SELECT *  FROM products 
WHERE id={$id}";
$resultproduct = mysqli_query($connect, $sqlproduct);
$rowproduct = $resultproduct->fetch_array(MYSQLI_ASSOC);
//total sale
$sql="SELECT COUNT(*) as count FROM purchase 
JOIN products ON products.id=purchase.fk_product 
WHERE fk_product=$id";
$result = mysqli_query($connect, $sql);
//sale before 31.12.2022

$sql3="SELECT COUNT(*) as count FROM purchase 
JOIN products ON products.id=purchase.fk_product 
WHERE purchase_date <= '2023-01-01' and fk_product={$id}";
$result3 = mysqli_query($connect, $sql3);
$row3 = $result3->fetch_array(MYSQLI_ASSOC);
$tbody3="";
//sale from 01.01.2023

$sql4="SELECT COUNT(*) as count FROM purchase 
JOIN products ON products.id=purchase.fk_product 
WHERE purchase_date >= '2022-12-31' and fk_product={$id}";
$result4 = mysqli_query($connect, $sql4);
$row4 = $result4->fetch_array(MYSQLI_ASSOC);
$tbody4="";
//select number product sold with method Paypal
$sql5="SELECT COUNT(*) as count FROM purchase 
JOIN products ON products.id=purchase.fk_product 
WHERE payment_method = 'Paypal' and fk_product={$id}";
$result5 = mysqli_query($connect, $sql5);
$row5 = $result5->fetch_array(MYSQLI_ASSOC);
$tbody5="";
//select number product sold with method Paypal
$sql6="SELECT COUNT(*) as count FROM purchase 
JOIN products ON products.id=purchase.fk_product 
WHERE payment_method = 'Click and collect' and fk_product={$id}";
$result6 = mysqli_query($connect, $sql6);
$row6 = $result6->fetch_array(MYSQLI_ASSOC);
$tbody6="";
//select number product sold with method Paypal
$sql7="SELECT COUNT(*) as count FROM purchase 
JOIN products ON products.id=purchase.fk_product 
WHERE payment_method = 'Credit card' and fk_product={$id}";
$result7 = mysqli_query($connect, $sql7);
$row7 = $result7->fetch_array(MYSQLI_ASSOC);
$tbody7="";

//select products
$sql2="SELECT * FROM products WHERE id={$id}";
$result2 = mysqli_query($connect, $sql2);
$row2 = $result2->fetch_array(MYSQLI_ASSOC);
$tbody ="";

if($result)
{
 while($row=mysqli_fetch_assoc($result))
  {
        $tbody= "<br><h3>Sales statistics :</h3><br>" . $row2['name'] . " was sold ".$row['count'] ." times <br> ";
        $tbody3 = $row2['name'] . " was sold ".$row3['count'] ." times in 2022 <br>";
        $tbody4 = $row2['name'] . " was sold ".$row4['count'] ." times in 2023 <br>";
        $tbody5 ="<h3>Payment Method statistics: </h3><br>"
        . $row2['name'] . " was payed ".$row5['count'] ." with Paypal <br>";
        $tbody6 =
         $row2['name'] . " was payed ".$row6['count'] ." with Click and collect<br>";
        $tbody7=
         $row2['name'] . " was payed ".$row7['count'] ." with Credit card";
  }     

}}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../components/boot.php' ?>
    <title>Add Product</title>
    <style>
        #statbox{
            border: solid 2px;
            padding: 2rem;
            text-align: center;
            font-weight: bold;
            font-size: 150%;
            margin: 3rem;
            background-color: lightgoldenrodyellow;

        }
        .stat{
            margin-top: 2rem;
        }
        h3{
            border-bottom: 2px solid;
            width: 50%;
            display: block;
            margin: auto;
            font-size: 150%;
        }
        h1{
            margin: auto;
            display: block;
            text-align: center;
            padding: 3rem;
            border: solid 2px;
            margin-top: 1rem;
            width: 75%;
            border-radius: 35px;
            background-color: lightgoldenrodyellow;
        }
    </style>
</head>
<body>
<h1>Sales statistic of product : <?= $rowproduct['name']?></h1>
    <div id="statbox">
    <div class="stat" id="date"><?= $tbody?>
    <?= $tbody4?>
    <?= $tbody3?></div>
    <div class="stat" id="pay"><?= $tbody5?>
    <?= $tbody6?>
    <?= $tbody7?></div>
</div>
<a href="./index_admin.php" class="d-flex m-auto mt-5"><button type="button" class="btn btn-primary m-auto">Index</button></a>


</body>
</html>