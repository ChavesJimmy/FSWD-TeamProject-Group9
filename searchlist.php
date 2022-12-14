<?php
//PHP FILE FOR THE RESEARCH PRODUCTS
require_once 'components/db_connect.php';


$search =$_GET['search'];
$qlProducts ="SELECT * FROM products WHERE name LIKE '%$search%'";
$result = mysqli_query($connect, $qlProducts);
$searchresult = "";
$tbody = "";
if(mysqli_num_rows($result)==0) {
        echo "no match";}
   else{
    while($rows=mysqli_fetch_array($result, MYSQLI_ASSOC)){
        if(empty($search)){
            echo"";}
            else{
              if ($rows['Discount']>0){
        echo  $tbody .= "
        <div class='card-product'>
          <div class='card-head-product'>
            <img src='img/logo.png' alt='logo' class='card-logo-product'>
            <img src='pictures/" . $rows['picture'] . "' class='product-img-product' alt='" . $rows['name'] . "'>
            <div class='product-detail-product'>
              <h2>" . $rows['name'] . "</h2> 
            </div>
            <span class='back-text-product'>
                    ATOM
            </span>
          </div>
      
          <div class='card-body-product'>
            <div class='product-desc-product'>
              <span class='product-title-product'>
                <b>" . $rows['name'] . "</b>
              </span>
              <span class='product-caption-product'>
                <a href='type.php?type=" . $rows['type'] . "'>" . $rows['type'] . "</a>
              </span>
              <span class='product-rating-product'>
                      <i class='fa fa-star'></i>
                      <i class='fa fa-star'></i>
                      <i class='fa fa-star'></i>
                      <i class='fa fa-star'></i>
                      <i class='fa fa-star grey'></i>
               </span>
            </div>
            <div class='product-properties-product'>
              <span class='product-size-product'>
                  <h4>Availability</h4>
                  <span class='ul-size-product'>
                    <p>" . $rows['availability'] . "</p>
                  </span>   
              </span>
              <span class='product-color-product'>
                   <h4>Prize</h4>
                   <p>" . $rows['price'] . "</p>
              </span>
                    <span class='product-price-product'>
                      EUR<b>" . $rows['price'] - ($rows['price'] * $rows['Discount'] / 100) . "</b>
                    </span>
                    <span class='details-button'>
                         <a href='details.php?id=" . $rows['id'] . "' class='card-link-product'>Details</a>
                    </span>
            </div>
          </div>
      </div>";
          } else {
            $tbody .= "
        <div class='card-product'>
          <div class='card-head-product'>
            <img src='img/logo.png' alt='logo' class='card-logo-product'>
            <img src='pictures/" . $rows['picture'] . "' class='product-img-product' alt='" . $rows['name'] . "'>
            <div class='product-detail-product'>
              <h2>" . $rows['name'] . "</h2> 
            </div>
            <span class='back-text-product'>
                    ATOM
                  </span>
          </div>
          <div class='card-body-product'>
            <div class='product-desc-product'>
              <span class='product-title-product'>
                      <b>" . $rows['name'] . "</b>
                      
              </span>
      
              <span class='product-caption-product'>
              <a href='type.php?type=" . $rows['type'] . "'>" . $rows['type'] . "</a>
              </span>
      
              <span class='product-rating-product'>
                      <i class='fa fa-star'></i>
                      <i class='fa fa-star'></i>
                      <i class='fa fa-star'></i>
                      <i class='fa fa-star'></i>
                      <i class='fa fa-star grey'></i>
              </span>
            </div>
            <div class='product-properties-product'>
              <span class='product-size-product'>
                      <h4>Availability</h4>
                      <span class='ul-size-product'>
                        <p>" . $rows['availability'] . "</p>
                      </span>
              </span>
              <span class='product-color-product'>
                <h4>Prize</h4>
                <p> </p>
              </span>
              <span class='product-price-product'>
                 EUR<b>" . $rows['price'] . "</b>
              </span>
              <span class='details-product'>
                <a href='details.php?id=" . $rows['id'] . "' class='card-link-product'>Details</a>
              </span>
            </div>
          </div>
      </div>";
          }}}}

          ?>

          <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/49748d0fd6.js" crossorigin="anonymous"></script>
  <title>Atom Body</title>
</head>

<body>
  <?php
  session_start();
  
  if (isset($_SESSION['USER'])) {
    require_once "components/navbar_user.php";
  } else {
    require_once "components/navbar.php";
  }

    ?>


  
  <!-- Start Main Section -->
  <main>
    <div class="manageProduct w-100 mt-3">
      <div class="d-flex flex-column align-items-center">
        <h1 class="p-3 text-light text-center mt-5 mb-5">Welcome to our shop</h1>
      </div>
      <div class="row w-100">
        <div class="container-product d-flex flex-wrap justify-content-between mb-5 w-75 m-auto">
          <?= $tbody; ?>
        </div>
      </div>
    </div>
    <!--<div class="container admin-container">
        <div class="d-flex flex-column align-items-center">
            <h1 class="p-3 text-light text-center mt-5 mb-5">Welcome to our shop</h1>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 justify-content-center m-auto mb-5 gap-5">
          <?= $tbody; ?> 
        </div>   -->


    </div>
  </main>