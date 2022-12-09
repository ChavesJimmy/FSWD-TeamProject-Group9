<?php
require_once '../components/db_connect.php' ;
require_once '../components/boot.php';
session_start();


// if (isset($_SESSION['admin'])) {
//     header('Location: ../index_admin.php');
//     exit;
// }
// if (!isset($_SESSION['user'])) {
//     header("Location: ..login.php");
//     exit;
// }

$sql = "SELECT * FROM products WHERE displ=1";
$result = mysqli_query($connect, $sql);
$tbody = ''; 
if (mysqli_num_rows($result)  > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if($row['Discount']>0){
      $tbody .= "<div class='card col-4 m-auto' style='width: 18rem;'>
      <img src='".$row['picture'] ."' class='card-img-top' alt='".$row['name']."'>
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
      <img src='".$row['picture'] ."' class='card-img-top' alt='".$row['name']."'>
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
  <h5>Search products:</h5>
  <input type="text" name="email" placeholder="product name" id="searchProd">
  <h6 style="background-color: yellow;">Search results</h6>
  <div id="container" style="background-color: yellow;" class="row"></div>

  <div class= "manageProduct w-75 mt-3">
      <p class='h2'> Products </p>
      <div class="row m-auto">
              <?=$tbody;?>
       </div>
  </div>
  <script>
    function SearchProducts(e){
            e.preventDefault();
            let xhttp = new XMLHttpRequest();
            let productVal = document.getElementById("searchProd").value;
            //console.log(productVal);
            xhttp.open("GET", "productslist.php?search=" + productVal);
            xhttp.onload = function(){
            if(this.status == 200){
                document.getElementById('container').innerHTML=this.responseText;
            }}
            xhttp.send();
        }
        document.getElementById('searchProd').addEventListener("input", SearchProducts);
  </script>
</body>
</html> 