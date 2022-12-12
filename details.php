<?php
require_once './components/db_connect.php';

if ($_GET['id']) {
  $id = $_GET['id'];
//display reviews
$sqlreview = "SELECT * FROM products_reviews WHERE fk_product={$id}";
$resultreview = mysqli_query($connect, $sqlreview);
$tbody = ''; 
if (mysqli_num_rows($resultreview)  > 0) {
  while ($rowreview = mysqli_fetch_array($resultreview, MYSQLI_ASSOC)) {
      $tbody .= "<div id='review'>
      <h6>Rating ".$rowreview['star']."⭐</h6>
      <p>".$rowreview['message']."</p>
      </div>" ;
  };
} else {
  $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>" ;
}

  $sql = "SELECT * FROM products WHERE id = $id";
  $result = mysqli_query($connect, $sql);
  if (mysqli_num_rows($result) == 1) {
    $data = mysqli_fetch_assoc($result);
    $name = $data['name'];
    $price = $data['price'];
    $picture = $data['picture'];
    $description = $data['description'];
    $type = $data['type'];
    $availability = $data['availability'];
    $discount=$data['Discount'];
    
  }
} else {
  header("location: error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Details - Products</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <section>
    <div>
      <h2>Details</h2>
      <div class="card mb-3">
        <img src="./pictures/<?=$picture ?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><?=$name ?></h5>
          <p class="card-text"><?=$description?></p>
          <p class="card-text"><?php 
          if($discount>0){echo $price-($price*$discount/100);}
          else{echo $price;}
          ?> EUR</p>
          <p class="card-text"><?=$type?></p>
          <p class="card-text"><?=$availability?></p>

        </div>
      </div>
      <br><br>
      <div class= "manageProduct w-75 mt-3">
      <p class='h1'> Reviews </p>
      
              <?=$tbody;?>
      </div>
    </div>
  </section>
</body>

</html>