<?php
require_once '../components/db_connect.php' ;
require_once '../components/boot.php';

$sql = "SELECT * FROM products WHERE displ=1";
$result = mysqli_query($connect, $sql);
$tbody = ''; 
if (mysqli_num_rows($result)  > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if($row['Discount']>0){
      $tbody .= "<div class='card col-4 m-auto' style='width: 18rem;'>
      <img src='../pictures/".$row['picture'] ."' class='card-img-top' alt='".$row['name']."'>
      <div class='card-body'>
        <h5 class='card-title'>".$row['name']."</h5>
      </div>
      <ul class='list-group list-group-flush'>
        <li class='list-group-item'><a href='type.php?type=".$row['type']."'>".$row['type']."</a></li>
        <li class='list-group-item'>". $row['price']-($row['price']*$row['Discount']/100)." EUR
        <br>(".$row['price']." EUR - discount ".$row['Discount']."%)</li>
        <li class='list-group-item'>A third item</li>
      </ul>
      <div class='card-body'>
        <a href='details.php?id=".$row['id']."' class='card-link'>Details</a>
      </div>
    </div>" ;}
    else{
      $tbody .= "<div class='card col-4 m-auto' style='width: 18rem;'>
      <img src='../pictures/".$row['picture'] ."' class='card-img-top' alt='".$row['name']."'>
      <div class='card-body'>
        <h5 class='card-title'>".$row['name']."</h5>
      </div>
      <ul class='list-group list-group-flush'>
        <li class='list-group-item'><a href='type.php?type=".$row['type']."'>".$row['type']."</a></li>
        <li class='list-group-item'>".$row['price']." EUR</li>
        <li class='list-group-item'>A third item</li>
      </ul>
      <div class='card-body'>
        <a href='details.php?id=".$row['id']."' class='card-link'>Details</a>
      </div>
    </div>" ;
    };
  };
} else {
  $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>" ;
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta  charset="UTF-8">
  <meta name="viewport"  content="width=device-width, initial-scale=1.0">
  <title>Product Page</title>
   <?php  require_once '../components/boot.php' ?>
  
</head>

<body>
  <div class= "manageProduct w-75 mt-3">
      <p class='h2'> Products </p>
      <div class="row m-auto">
              <?=$tbody;?>
       </div>
  </div>
</body>
</html> 