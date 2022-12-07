<?php
session_start();
require_once '../components/db_connect.php';

/* if (isset($_SESSION['USER']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
    header("Location: ../index.php");
    exit;
} */
$discount="";
$result = mysqli_query($connect, "SELECT * FROM discount");
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $discount .=
        "<option value='{$row['id']}'>{$row['discount']}</option>";
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../components/boot.php' ?>
    <title>Add Product</title>
</head>

<body>
    <fieldset>
        <legend class='h2'>Add Product</legend>
        <form action="actions/a_create.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="name" placeholder="Product Name" /></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td><input class='form-control' type="number" name="price" placeholder="Price" step="any" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="text" name="picture" /></td>
                </tr>
                <tr>
                    <th>Discount</th>
                    <td>
                        <select class="form-select" name="fk_discount" aria-label="Default select example">
                            <option selected value='NULL'>no discount</option>
                            <?= $discount ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>description</th>
                    <td><textarea class='form-control' name="description" id="description" cols="30" rows="10"></textarea></td>
                </tr>

                <tr>
                    <th>Type</th>
                    <td>
                        <select class="form-select" name="type" aria-label="Default select example">
                            <option selected value='Food supplements'>Food Supplements</option>
                            <option selected value='Materials'>Materials</option>
                            <option selected value='Others'>Others</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Available ?</th>
                    <td>
                        <select class="form-select" name="availability" aria-label="Default select example">
                            <option selected value='true'>YES</option>
                            <option  value='false'>NO</option>
                        </select>
                    </td>
                </tr>
                <tr>
                <tr>
                    <th>Sould be displayed on the website?</th>
                    <td>
                        <select class="form-select" name="displ" aria-label="Default select example">
                            <option selected value='yes'>YES</option>
                            <option  value='no'>NO</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><button class='btn btn-success' type="submit">Insert Product</button></td>
                    <td><a href="index_admin.php"><button class='btn btn-warning' type="button">Home</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>
</html>