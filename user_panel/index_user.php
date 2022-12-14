<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../components/db_connect.php' ;
require_once '../components/boot.php';
session_start();

if (isset($_SESSION['ADMIN'])) {
  header('Location: ../admin_panel/index_admin.php');
 exit;
}
if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
header('Location: ../login.php');
exit;
}

$userinfo =mysqli_query($connect, "SELECT * FROM users WHERE id={$_SESSION['USER']}");
$info= mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if($info['user_allowed']=='banned'){
  header('Location: ../ban.php');
  exit;
}


 $infoUser="SELECT * FROM users WHERE id={$_SESSION['USER']}";
 $infoResult = mysqli_query($connect, $infoUser);
 if (mysqli_num_rows($infoResult)  > 0) {
  $user = mysqli_fetch_array($infoResult, MYSQLI_ASSOC);}
$sql = "SELECT * FROM products WHERE displ=1";
$result = mysqli_query($connect, $sql);
$tbody = ''; 
if (mysqli_num_rows($result)  > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if($row['Discount']>0){
      $tbody .= "  <div class='card-product'>
      <div class='card-head-product'>
        <img src='../img/logo.png' alt='logo' class='card-logo-product'>
        <img src='../pictures/" . $row['picture'] . "' class='product-img-product' alt='" . $row['name'] . "'>
        <div class='product-detail-product'>
          <h2>" . $row['name'] . "</h2> 
        </div>
        <span class='back-text-product'>
                ATOM
        </span>
      </div>
  
      <div class='card-body-product'>
        <div class='product-desc-product'>
          <span class='product-title-product'>
            <b>" . $row['name'] . "</b>
          </span>
          <span class='product-caption-product'>
            <a href='type.php?type=" . $row['type'] . "'>" . $row['type'] . "</a>
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
                <p>" . $row['availability'] . "</p>
              </span>   
          </span>
          <span class='product-color-product'>
               <h4>Prize</h4>
               <p>" . $row['price'] . "</p>
          </span>
                <span class='product-price-product'>
                  EUR<b>" . $row['price'] - ($row['price'] * $row['Discount'] / 100) . "</b>
                </span>
                <span class='details-product'>
            <a href='details.php?id=" . $row['id'] . "' class='card-link-product'>Details</a>
            <form action='./actions/a_addToCart.php' method='post'>
          <input type='hidden' name='fk_produkt' value='". $row['id']."'>  
          <input type='hidden' name='fk_user' value=3>
          <button type='submit'>Add to cart</button></form>
          </span>
        </div>
      </div>
  </div>
      
    </div>" ;}
    else{
      $tbody .=  "<div class='card-product'>
      <div class='card-head-product'>
        <img src='../img/logo.png' alt='logo' class='card-logo-product'>
        <img src='../pictures/" . $row['picture'] . "' class='product-img-product' alt='" . $row['name'] . "'>
        <div class='product-detail-product'>
          <h2>" . $row['name'] . "</h2> 
        </div>
        <span class='back-text-product'>
                ATOM
              </span>
      </div>
      <div class='card-body-product'>
        <div class='product-desc-product'>
          <span class='product-title-product'>
                  <b>" . $row['name'] . "</b>
                  
          </span>
  
          <span class='product-caption-product'>
          <a href='type.php?type=" . $row['type'] . "'>" . $row['type'] . "</a>
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
                    <p>" . $row['availability'] . "</p>
                  </span>
          </span>
          <span class='product-color-product'>
            <h4>Prize</h4>
            <p> </p>
          </span>
          <span class='product-price-product'>
             EUR<b>" . $row['price'] . "</b>
          </span>
          <span class='details-product'>
            <a href='details.php?id=" . $row['id'] . "' class='card-link-product'>Details</a>
            <form action='./actions/a_addToCart.php' method='post'>
          <input type='hidden' name='fk_produkt' value='". $row['id']."'>  
          <input type='hidden' name='fk_user' value=". $_SESSION['USER'] .">
          <button class=' btn btn-outline-dark' type='submit'>Add to cart</button></form>
          </span>
        </div>
      </div>
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
  <link rel="stylesheet" href="../css/style.css">  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/49748d0fd6.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
<?php require_once("../components/navbar_user.php");
?>


<div class="fs-2 mt-5 fw-bold"><p class="text-center"> Welcome, <?= $user['user_name']?> !</p></div> <br>
<p class='h2 text-center'> Products </p>
<div id="container"></div>
<div class="manageProduct w-100 mt-3">
      <div class="row w-100">
        <div class="container-product d-flex flex-wrap justify-content-between mb-5 w-75 m-auto">
          <?= $tbody; ?>
        </div>
      </div>
    </div>

      <?php require_once "../components/footer.php" ?>
<!--SCRIPT THAT GET WITH PRODUCTLISTS:PHP FOR THE RESEARCH FUNCTION-->
<script>
    function SearchProducts() {
      let xhttp = new XMLHttpRequest();
      let productVal = document.getElementById("searchProd").value;
      console.log(productVal);
      xhttp.open("GET", "searchlist.php?search=" + productVal);
      xhttp.onload = function() {
        if (this.status == 200) {
          document.getElementById('container').innerHTML = this.responseText;
        }
      }
      xhttp.send();
    }
    document.getElementById('searchProd').addEventListener("input", SearchProducts);
  </script>
</body>
</html> 