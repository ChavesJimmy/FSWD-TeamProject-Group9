<?php
require_once 'components/db_connect.php';
require_once 'components/boot.php';

$sql = "SELECT * FROM products WHERE displ=1";
$result = mysqli_query($connect, $sql);
$tbody = '';
if (mysqli_num_rows($result)  > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if ($row['Discount'] > 0) {
            $tbody .= "<div class='card col-4 m-auto' style='width: 18rem;'>
      <img src='pictures/" . $row['picture'] . "' class='card-img-top' alt='" . $row['name'] . "'>
      <div class='card-body'>
        <h5 class='card-title'>" . $row['name'] . "</h5>
      </div>
      <ul class='list-group list-group-flush'>
        <li class='list-group-item'><a href='type.php?type=" . $row['type'] . "'>" . $row['type'] . "</a></li>
        <li class='list-group-item'>" . $row['price'] - ($row['price'] * $row['Discount'] / 100) . " EUR
        <br>(" . $row['price'] . " EUR - discount " . $row['Discount'] . "%)</li>
        <li class='list-group-item'>A third item</li>
      </ul>
      <div class='card-body'>
        <a href='details.php?id=" . $row['id'] . "' class='card-link'>Details</a>
      </div>
    </div>";
        } else {
            $tbody .= "<div class='card col-4 m-auto' style='width: 18rem;'>
      <img src='pictures/" . $row['picture'] . "' class='card-img-top' alt='" . $row['name'] . "'>
      <div class='card-body'>
        <h5 class='card-title'>" . $row['name'] . "</h5>
      </div>
      <ul class='list-group list-group-flush'>
        <li class='list-group-item'><a href='type.php?type=" . $row['type'] . "'>" . $row['type'] . "</a></li>
        <li class='list-group-item'>" . $row['price'] . " EUR</li>
        <li class='list-group-item'>A third item</li>
      </ul>
      <div class='card-body'>
        <a href='details.php?id=" . $row['id'] . "' class='card-link'>Details</a>
      </div>
    </div>";
        };
    };
} else {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
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
    <?php require_once "components/navbar.php" ?>
    <!-- Hero -->
    <div class="hero">
        <div class="hero-img-container">
            <img class="hero-img" src=".">
        </div>
    </div>

    <!--START HTML FOR THE RESEARCH PRODUCTS-->
    <h5>Search products:</h5>
    <input type="text" name="search" placeholder="product name" id="searchProd">
    <h6 style="background-color: yellow;">Search results</h6>
    <div id="container" style="background-color: yellow;" class="row"></div>
    <!--END RESEARCH-->
    <!-- Start Main Section -->
    <main>
        <div class="d-flex flex-column align-items-center w-100">
            <h1 class="p-3 text-light text-center mt-5 mb-5">Welcome to our shop</h1>
        </div>
        <div class="container">
            <!-- Cards Area printed from Classes -->
            <div id="result" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 justify-content-center m-auto mb-5 gap-5">
                <?= $tbody; ?>

            </div>
        </div>
    </main>



    <!-- Start Footer -->
    <?php require_once "components/footer.php" ?>
    <?php require_once "googleMaps/location.html" ?>
    <!-- Scripts -->
    <!-- Swiper Script -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> <!-- General Script -->
    <script src="scripts/script.js"></script>
    <!--SCRIPT THAT GET WITH PRODUCTLISTS:PHP FOR THE RESEARCH FUNCTION-->
  <script>
    function SearchProducts(){
            let xhttp = new XMLHttpRequest();
            let productVal = document.getElementById("searchProd").value;
            console.log(productVal);
            xhttp.open("GET", "user_panel/productslist.php?search=" + productVal);
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