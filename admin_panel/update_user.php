<?php 
require_once '../components//db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $user_name = $data['user_name'];
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $email = $data['email'];
        $address = $data['address'];
        $birth_date = $data ['birth_date'];
        $photo = $data ['photo'];
        $status = $data ['status'];
        $user_allowed = $data ['user_allowed'];

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
        <legend class='h2'> Update User</legend>
        <form action="actions/a_uodate.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>User Name</th>
                    <td><input class='form-control' type="text" name="user_name" placeholder="Product Name" value="<?= $user_name ?>" /></td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td><input class='form-control' type="text" name="first_name" placeholder="Product Name" value="<?= $first_name ?>" /></td>
                </tr>                
                <tr>
                    <th>Last Name</th>
                    <td><input class='form-control' type="text" name="last_name" placeholder="Product Name" value="<?= $last_name ?>" /></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input class='form-control' type="text" name="email" value="<?= $email ?>" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input class='form-control' type="text" name="address" value="<?= $address ?>" /></td>
                </tr>
                <tr>
                    <th>Photo</th>
                    <td><input class='form-control' type="text" name="photo" value="<?= $photo ?>" /></td>
                </tr>
                <tr>
                    <th>Birth_date</th>
                    <td><input type="date" name="birth_date" id="" value="<?= $birth_date ?>"></td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <select class="form-select" name="status" aria-label="Default select example">
                            <option selectted value="<?= $status ?>"><?= $status ?></option>
                            <option value='USER'>User</option>
                            <option value='ADMIN'>Admin</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Allowed</th>
                    <td>
                        <select class="form-select" name="user_allowed" aria-label="Default select example">
                            <option selected value="<?= $user_allowed ?>"><?= $user_allowed ?></option>
                            <option value='allowed'>Allowed</option>
                            <option value='banned'>Banned</option>
                        </select>
                    </td>
                </tr>
                <input type= "hidden" name= "id" value= "<?php echo $data['id'] ?>" />

                <tr>
                    <td><button class='btn btn-success' type="submit">Insert Product</button></td>
                    <td><a href="index_admin.php"><button class='btn btn-warning' type="button">Home</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>
</html>