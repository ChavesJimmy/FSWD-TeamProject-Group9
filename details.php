<?php
require_once 'components/db_connect.php';
session_start();

if (isset($_SESSION['USER'])) {
  if ($_GET['id']) {
    $id = $_GET['id'];
  header('Location: ../user_panel/details.php?id=' . $id);
 exit;
}
}

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/49748d0fd6.js" crossorigin="anonymous"></script>
  <?php require_once 'components/boot.php' ?>
</head>

<body>
  <?php require_once './components/details.navbar.php' ?>
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
                                  ?> EUR</p>
            <p class="card-text p-3"><?= $type ?></p>
            <p class="card-text p-3"><?= $availability ?></p>
            </p>
            <div class="manageProduct w-75 mt-3">
      <p class='fs-1'> Reviews </p>
    <p class="mt-3"><?= $tbody; ?></p>
    </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once 'components/footer.php' ?>




</body>

</html>