<?php
//session_start();
require_once '../components/db_connect.php' ;

/* if (isset($_SESSION['user']) != "" ) {
  header("Location: ../home.php");
  exit;
}

if (! isset($_SESSION['adm']) && !isset($_SESSION['user' ])) {
  header("Location: ../index.php");
  exit;
} */

$sql = "SELECT * FROM products WHERE displ=1";
$result = mysqli_query($connect, $sql);
$tbody = ''; 
if (mysqli_num_rows($result)  > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $tbody .= "<tr>
          <td><img class='img-thumbnail' src='pictures/" . $row['picture'] . "'</td>
          <td>" . $row['name'] . "</td>
          <td>"  . $row['price'] . ' €' ."</td>
          <td><a href='details.php?id="  . $row['id'] . "'>Details</a></td>
          </tr>" ;
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
   <?php  require_once '../components/boot.php' ?>
  
</head>

<body>
  <div class= "manageProduct w-75 mt-3">
      <p class='h2'> Products </p>
      <table class='table table-striped'>
          <thead class='table-success'>
              <tr>
                  <th> Picture </th>
                  <th> Name </th>
                  <th> Price </th>
                  <th> Details </th>
              </tr>
          </thead>
          <tbody>
              <?=$tbody;?>
          </tbody>
      </table>
  </div>
</body>
</html> 