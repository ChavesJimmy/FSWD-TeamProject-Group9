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
    exit;*/
if ($_GET['id']) {
$id=$_GET['id'];
$sql="SELECT COUNT(*) as count FROM purchase 
JOIN products ON products.id=purchase.fk_product 
WHERE fk_product=$id";
$result = mysqli_query($connect, $sql);

$sql2="SELECT * FROM products WHERE id={$id}";
$result2 = mysqli_query($connect, $sql2);
$row2 = $result2->fetch_array(MYSQLI_ASSOC);
$tbody ="";
if($result)
{
 while($row=mysqli_fetch_assoc($result))
  {
        $tbody= "<br>" . $row2['name'] . " was sold ".$row['count'] ." times ";
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
</head>
<body>
    <?= $tbody?>

</body>
</html>