<?php
session_start();


require_once '../../components/db_connect.php';

if ($_POST) {
    $fk_user=$_POST['fk_user'];
    $product='';
    $payment_method=$_POST['payment_method'];
    $date=date('Y-m-d');
    $message="";
    $cart="SELECT * FROM shopping_cart WHERE fk_user={$_SESSION['USER']}";
    $result=mysqli_query($connect, $cart);
    while($rowcart = mysqli_fetch_assoc($result)){
    $sql = "INSERT INTO purchase(purchase_date,fk_user,fk_product,payment_method) VALUES('$date', $fk_user,{$rowcart['fk_produkt']},'$payment_method')";
    
    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The review below was successfully created <br>
            <table class='table w-50'><tr>
            <td> $message </td>
            </tr></table><hr>";
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
    }}
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <?php require_once '../../components/boot.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../index_user.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
    </div>
</body>
</html>