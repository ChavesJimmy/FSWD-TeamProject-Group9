<?php
require_once '../components/db_connect.php';
$search =$_GET['search'];
$qlProducts ="SELECT * FROM products WHERE name LIKE '$search%'";
$result = mysqli_query($connect, $qlProducts);
$searchresult = "";
if(mysqli_num_rows($result)==0) {
        echo "no match";}
   else{
    while($rows=mysqli_fetch_array($result, MYSQLI_ASSOC)){

        echo "<div class='card col-4 m-auto' style='width: 18rem;'>
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
    
}}