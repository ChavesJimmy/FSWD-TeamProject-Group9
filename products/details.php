<?php
require_once '../components/db_connect.php' ;

if ($_GET['id']) {
    $id = $_GET['id'];
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
    <title>Details - Animal Adoption</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
  <section>
        <div>
        <h2>Details</h2>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Picture</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Type</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <th><?= $id ?></th>
                <th><img src='<?= "pictures/" . $picture ?>' class="thumb"></th>
                <th><?= $name ?></th>
                <th><?= $description ?></th>
                <th><?= $price . " €" ?></th>
                <th><?= $type ?></th>
            </tr>
            </tbody>
        </table>
        </div>
    </section>
  </body>
</html>