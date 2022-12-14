<?php
session_start();
require_once '../components/db_connect.php';

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
 if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
  header('Location: ../login.php');
 exit;
}
$type = $_GET['type'];
$sql = "SELECT * FROM products WHERE type='{$type}' AND displ=1";
$result = mysqli_query($connect, $sql);
$tbody = '';
if (mysqli_num_rows($result)  > 0) {
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $tbody .= "<div class='card col-4 m-auto' style='width: 18rem;'>
      <img src='../pictures/" . $row['picture'] . "' class='card-img-top' alt='" . $row['name'] . "'>
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
} else {
  $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $type . " | Atom Body"?></title>
  <link rel="stylesheet" href="../css/style.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/49748d0fd6.js" crossorigin="anonymous"></script>
</head>

<body>
<?php require_once("../components/boot.php");
 require_once("../components/navbar_user.php");
?>

</head>

<body>
  <div class="manageProduct w-75 mt-3">
    <p class='h2'> <?= $type ?> </p>
    <div class="row">
    <tbody>
      <?= $tbody; ?>
    </tbody>
  </div>
  </div>

  <?php require_once("../components/footer.php");
?>

</body>

</html>