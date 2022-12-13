<?php
session_start();
require_once '../components/db_connect.php';

if (isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../user_panel/index_user.php");
    exit;
} 

if (!isset($_SESSION['USER']) && !isset($_SESSION['ADMIN'])) {
    header("Location: ../login.php");
    exit;
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
        <p class='fs-1 mt-5' style="text-align:center;">Add Product</p>
        <form class="cont1 container border rounded rounded-3 p-4 w-50" style="margin-top:2%; background-color: rgba(127, 123, 116, 0.8431372549);" action="actions/a_create.php" method="post" enctype="multipart/form-data">
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
                        <select class="form-select" name="Discount" aria-label="Default select example">
                            <option selected value=''>no discount</option>
                            <option  value='5'>5 %</option>
                            <option  value='10'>10 %</option>
                            <option  value='15'>15%</option>
                            <option  value='20'>20%</option>
                            <option  value='25'>25%</option>
                            <option  value='30'>30%</option>
                            <option  value='40'>40%</option>
                            <option  value='50'>50%</option>

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
                    <td><a href="index_admin.php"><button class='btn btn-dark' type="button">Home</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>
</html>