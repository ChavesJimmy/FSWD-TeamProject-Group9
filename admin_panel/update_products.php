<?php 
require_once '../components//db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data['name'];
        $price = $data['price'];
        $picture = $data['picture'];
        $description = $data['description'];
        $type = $data['type'];
        $available = $data ['availability'];
        if($available == true){
            $available = "available";
        }else{
            $available='not available';
        };
        $discount = $data ['fk_discount'];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
 } else {
    header("location: error.php");
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
        <legend class='h2'>Update => "<?= $name?>"</legend>
        <form action="actions/a_update_product.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="name" placeholder="Product Name" value="<?= $name ?>" /></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td><input class='form-control' type="number" name="price" placeholder="Price" step="any" value="<?= $price ?>" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="text" name="picture" value="<?= $picture ?>"  /></td>
                </tr>
                <tr>
                    <th>description</th>
                    <td><textarea class='form-control' name="description" id="description" cols="30" rows="10"><?= $description ?>" </textarea></td>
                </tr>

                <tr>
                    <th>Type</th>
                    <td>
                        <select class="form-select" name="type" aria-label="Default select example">
                            <option value="<?= $type ?>" ><?= $type?></option>
                            <option value='Food supplements'>Food Supplements</option>
                            <option value='Materials'>Materials</option>
                            <option value='Others'>Others</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Availability</th>
                    <td>
                        <select class="form-select" name="availability" aria-label="Default select example">
                            <option selected value="<?= $available ?>" ><?= $available ?></option>
                            <option  value='true'>Available</option>
                            <option  value='false'>Not available</option>
                        </select>
                    </td>
                </tr>
                <!-- <tr>
                    <th>Discount</th>
                    <td>
                        <select class="form-select" name="fk_discount" aria-label="Default select example">
                            <option selected value='none'>No discount</option>
                             discount need to be updated
                            <option  value='$discount'>to update</option>
                        </select>
                    </td>
                </tr> -->
                <input type= "hidden" name= "id" value= "<?php echo $data['id'] ?>" />

                <tr>
                    <td><button class='btn btn-success' type="submit">Update</button></td>
                    <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>
</html>


