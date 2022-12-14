<?php
require_once 'components/db_connect.php';

if ($_GET['id']) {
  $id = $_GET['id'];
  //display reviews
  $sqlreview = "SELECT * FROM products_reviews WHERE fk_product={$id}";
  $resultreview = mysqli_query($connect, $sqlreview);
  $tbody = '';
  if (mysqli_num_rows($resultreview)  > 0) {
    while ($rowreview = mysqli_fetch_array($resultreview, MYSQLI_ASSOC)) {
      $tbody .= "<div id='review'>
      <h6>Rating " . $rowreview['star'] . "⭐</h6>
      <p>" . $rowreview['message'] . "</p>
      </div>";
    };
  } else {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
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
    $discount = $data['Discount'];
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
  <?php require_once 'components/boot.php' ?>
</head>

<body class="bg-light">
  <div class="mt-5" style="margin-left:20%;">
    <div class="card p-4 w-75" style="background-color: rgba(127, 123, 116, 0.8431372549);">
      <div class="row g-0">
        <div class="col-md-4 rounded mt-3">
          <img class="mb-3 rounded" src="./pictures/<?= $picture ?>" class="card-img-top" alt="..." style="width: 200px;">
        </div>
        <div class="col-md-8">
          <div class="card-body" style="margin-left:15%;">
            <h1 class="card-title">Details</h1>
            <p class="card-text p-3"><?= $description ?></p>
            <p class="card-text fs-2 p-3"><?php
                                  if ($discount > 0) {
                                    echo $price - ($price * $discount / 100);
                                  } else {
                                    echo $price;
                                  }
                                  ?> €</p>
            <p class="card-text p-3"><?= $type ?></p>
            <p class="card-text p-3"><?= $availability ?></p>
            </p>
            <div class="manageProduct w-75 mt-3">
      <p class='fs-1'> Reviews </p>
    <p class="mt-3"><?= $tbody; ?></p>
    </div>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>
  </div>





</body>

</html>