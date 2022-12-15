<?php
require_once '../components/db_connect.php';
require_once '../components/boot.php';
session_start();
$userinfo = mysqli_query($connect, "SELECT * FROM users WHERE id={$_SESSION['USER']}");
$info = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if ($info['user_allowed'] == 'banned') {
  header('Location: ../ban.php');
  exit;
}
if (isset($_SESSION['ADMIN'])) {
  header('Location: ../admin_panel/index_admin.php');
  exit;
}
if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
  header('Location: ../login.php');
  exit;
}


if ($_GET['id']) {
  $id = $_GET['id'];
  //display details from id products
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
//take infos from logged user
$sqluser = "SELECT * FROM users WHERE id={$_SESSION['USER']}";
$resultuser = mysqli_query($connect, $sqluser);
$rowuser = mysqli_fetch_assoc($resultuser);
//display reviews
$sqlreview = "SELECT * FROM products_reviews 
WHERE fk_product={$id}";
$resultreview = mysqli_query($connect, $sqlreview);
$tbody = '';
$tresponse = '';
if (mysqli_num_rows($resultreview)  > 0) {
  while ($rowreview = mysqli_fetch_array($resultreview, MYSQLI_ASSOC)) {
    //add answer to review
    $sqlresponse = "SELECT * FROM review_answer 
    RIGHT JOIN users ON review_answer.fk_user=users.id
    WHERE fk_review = {$rowreview['id']}";
    $resultresponse = mysqli_query($connect, $sqlresponse);
    $tresponse = '';

    if (mysqli_num_rows($resultresponse)  > 0) {
      while ($rowresponse = mysqli_fetch_array($resultresponse, MYSQLI_ASSOC)) {
        $tresponse .= "<div class='response border border-1'>
      <p>" . $rowresponse['answer'] . "</p>
      <p>answer from " . $rowresponse['user_name'] . "</p>

      </div>";
      };
    }
    $tbody .= "<div id='review'>
      <h6>Rating " . $rowreview['star'] . "⭐</h6>
      <p>" . $rowreview['message'] . "<br> </p>
      </div><br>
      <div id='response'>
              <h6>Answer</h6>
                " . $tresponse . "
              </div><br>
      <form action='actions/a_answer.php' method='post'>
              <label for='review'>your answer</label>
                <textarea  class='form-select' name='answer' id='' cols='10' rows='3'></textarea>
                <input type='hidden' name='fk_review' value=" . $rowreview['id'] . ">
                <input type='hidden' name='fk_user' value=" . $_SESSION['USER'] . ">
                <button class='btn btn-success' type='submit'>Send answer</button>

              </form>
              
              ";
  };
} else {
  $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
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
  <?php require_once '../components/details.navbar.php' ?>
  <section>
    <div>
      <p class="fs-1 fw-bold mt-4" style="text-align:center;">Details</p>
        <div class="mt-5" style="margin-left:20%;">
          <div class="card p-4 w-75" style="background-color: rgba(127, 123, 116, 0.8431372549);">
            <div class="row g-0">
              <div class="col-md-4 rounded mt-3">
                <img class="mb-3 rounded" src="../pictures/<?= $picture ?>" class="card-img-top" alt="..." style="width: 200px;">
              </div>
              <div class="col-md-8">
                <div class="card-body" style="margin-left:15%;">
                  <h5 class="card-title"><?= $name ?></h5>
                  <p class="card-text"><?= $description ?></p>
                  <p class="card-text"><?php
                                        if ($discount > 0) {
                                          echo $price - ($price * $discount / 100);
                                        } else {
                                          echo $price;
                                        }
                                        ?> EUR</p>
                  <p class="card-text"><?= $type ?></p>
                  <p class="card-text"><?= $availability ?></p>
                  <form action="./actions/a_addToCart.php" method="post">
                    <input type="hidden" name="fk_produkt" value="<?= $id ?>">
                    <input type="hidden" name="fk_user" value=<?= $_SESSION['USER'] ?>>
                    <button class="btn btn-dark" type="submit">Add to cart</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br>

      <div style="margin-left:20%;">
      <form class="card p-4 w-75" style="background-color: rgba(127, 123, 116, 0.8431372549);" action="actions/a_review.php" method="post">
        <h1 style="text-align:center;">Add review for <?=$name?></h1>
        <textarea class="form-select mt-3" name="message" id="" cols="30" rows="10"></textarea>
        <label for="rating">Rating</label>
        <select class="form-select" name="star" id="">
          <option value="0">0</option>
          <option value="1">⭐</option>
          <option value="2">⭐⭐</option>
          <option value='3'>⭐⭐⭐</option>
          <option value="4">⭐⭐⭐⭐</option>
          <option value="5">⭐⭐⭐⭐⭐</option>
        </select>
        <input type="hidden" name="product" value="<?= $id ?>">
        <input type="hidden" name="user" value=<?= $_SESSION['USER'] ?>>
        <button class='btn btn-success mt-3' type="submit">Send review</button>
      </form><br><br>
      </div>
      <div class="manageProduct w-50  mt-3 mb-4 border border-5 rounded-1" style="margin-left:25%;">
        <p class='fs-1 fw-bold p-3' style="text-align:center;"> Reviews </p>
         <br/>
        <?= $tbody; ?>
        <br/>

      </div>
    </div>
  </section>
</body>

</html>