<?php
session_start();
require_once '../components/db_connect.php' ;
$userinfo =mysqli_query($connect, "SELECT * FROM users WHERE id={$_SESSION['USER']}");
$info= mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

if($info['user_allowed']=='banned'){
  header('Location: ../ban.php');
  exit;
}
 if (isset($_SESSION['ADMIN'])) {
     header('Location: ../admin_panel/index_admin.php');
    exit;
 }
 if (isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
  header('Location: ../login.php');
 exit;
}
//$id=$_GET['id'];
//mmmust change 3 by get id
$sql = "SELECT * FROM products_reviews WHERE fk_product=3";
$result = mysqli_query($connect, $sql);
$sql2 = "SELECT * FROM products WHERE id=3";
$result2 = mysqli_query($connect, $sql2);
$row2=mysqli_fetch_array($result2, MYSQLI_ASSOC);
$tbody = ''; 
if (mysqli_num_rows($result)  > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $tbody .= "<div id='review'>
      <h1>Review" .$row2['name']."</h1>
      <h3>Rating ".$row['star']."</h3>
      <p>".$row['message']."</p>
      </div>" ;
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
  <title>Reviews <?= $row2['name']?></title>
    <link rel="stylesheet" href="../css/style.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/49748d0fd6.js" crossorigin="anonymous"></script>
</head>

<body>
<?php require_once("../components/boot.php");
 require_once("../components/navbar_user.php");
?>
   

  <style>
    #review{
        border: solid 2px;
        padding: 1rem;
    }
  </style>
</head>

<body>
  <div class= "manageProduct w-75 mt-3">
      <p class='h2'> Reviews </p>
      
              <?=$tbody;?>
  </div>
  <form action="actions/a_review.php" method="post">
    <h1>Add review for <?= $row2['name']?></h1>
    <label for="review">your review</label>
    <textarea  class="form-select" name="message" id="" cols="30" rows="10"></textarea>
    <label for="rating">Rating</label>
    <select class="form-select" name="star" id="">
        <option value="0">0</option>
        <option value="1">⭐</option>
        <option value="2">⭐⭐</option>
        <option value='3'>⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="5">⭐⭐⭐⭐⭐</option>
    </select>
    <input type="hidden" name="product" value="<?=$row2['id']?>">
    <input type="hidden" name="user" value="">
    <button class='btn btn-success' type="submit">Send review</button>
  </form>
  <?php require_once("../components/footer.php"); ?>

</body>
</html> 