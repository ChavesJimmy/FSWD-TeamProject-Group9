<?php
require_once '../components/db_connect.php';
$search = trim($_GET['search']);
$search = strip_tags($search);
$search= htmlspecialchars($search);
$qlProducts ="SELECT * FROM products WHERE name LIKE '$search%'";
$result = mysqli_query($connect, $qlProducts);
$searchresult = "";
$sql2="SELECT * FROM products";
$result2 = mysqli_query($connect, $sql2);
$tsearch="";
$rows=mysqli_fetch_array($result2, MYSQLI_ASSOC);
if(mysqli_num_rows($result)==0) {
    if($rows['name'] != $search){
        echo "no match";}
   }else{
    while($rows=mysqli_fetch_array($result2, MYSQLI_ASSOC)){

        $tsearch="<div class='card col-4 m-auto' style='width: 18rem;'>
        <img src='".$rows['picture'] ."' class='card-img-top' alt='".$rows['name']."'>
        <div class='card-body'>
          <h5 class='card-title'>".$rows['name']."</h5>
        </div>
        <ul class='list-group list-group-flush'>
          <li class='list-group-item'><a href='type.php?type=".$rows['type']."'>".$rows['type']."</a></li>
          <br>(".$rows['price']." EUR - discount ".$rows['Discount']."%)</li>
          <li class='list-group-item'>A third item</li>
        </ul>
        <div class='card-body'>
          <a href='details.php?id=".$rows['id']."' class='card-link'>Details</a>
        </div>
      </div>";
        echo $tsearch;
    
}}