<?php
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
      <form action='./actions/a_addToCart.php' method='post'>
          <input type='hidden' name='fk_produkt' value='". $row['id']."'>  
          <input type='hidden' name='fk_user' value=3>
          <button type='submit'>Add to cart</button></form>
    </div>" ;}
    else{
      $tbody .= "<div class='card col-4 m-auto' style='width: 18rem;'>
      <img src='../pictures/".$row['picture'] ."' class='card-img-top' alt='".$row['name']."'>
      <div class='card-body'>
        <h5 class='card-title'>".$row['name']."</h5>
      </div>
      <ul class='list-group list-group-flush'>
        <li class=' btn btn-outline-dark'><a style='text-decoration:none;' href='type.php?type=".$row['type']."'>".$row['type']."</a></li>
        <li class='list-group-item'>".$row['price']." EUR</li>
        <li class='list-group-item'>A third item</li>
      </ul>
      <div class='card-body'>
        <a class=' btn btn-outline-dark' href='details.php?id=".$row['id']."' class='card-link'>Details</a>
      </div>
      <form action='./actions/a_addToCart.php' method='post'>
          <input type='hidden' name='fk_produkt' value='". $row['id']."'>  
          <input type='hidden' name='fk_user' value=". $_SESSION['USER'] .">
          <button class=' btn btn-outline-dark' type='submit'>Add to cart</button></form>
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


<!--START HTML FOR THE RESEARCH PRODUCTS-->
  <h5 style="  background-color: rgba(127, 123, 116, 0.8431372549);" class="fs-4 p-2">Search products:</h5>
  <input class="form-control w-25 mt-4 mb-4 p-2" type="text" name="search" placeholder="product name" id="searchProd" style="margin-left:1%;">
  <p class="fs-5 p-2" style="  background-color: rgba(127, 123, 116, 0.8431372549);">Search results</p>
  <div id="container" style="background-color: yellow;" class="row"></div>
<!--END RESEARCH-->

  <div class= "manageProduct w-75 mt-3">
      <p class='h2'> Products </p>
      <div class="row m-auto">
              <?=$tbody;?>
       </div>
  </div>
   <!--SCRIPT THAT GET WITH PRODUCTLISTS:PHP FOR THE RESEARCH FUNCTION-->
  <script>
    function SearchProducts(){
            let xhttp = new XMLHttpRequest();
            let productVal = document.getElementById("searchProd").value;
            console.log(productVal);
            xhttp.open("GET", "productslist.php?search=" + productVal);
            xhttp.onload = function(){
            if(this.status == 200){
                document.getElementById('container').innerHTML=this.responseText;
            }}
            xhttp.send();
        }
        document.getElementById('searchProd').addEventListener("input", SearchProducts);
  </script>
      <?php require_once "../components/footer.php" ?>

</body>
</html> 