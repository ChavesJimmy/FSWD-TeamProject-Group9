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


if ($_POST['email']) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email = {$email}";
    $result = mysqli_query($connect, $sql);
    $tbody ="";
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);

        $user_name = $data['user_name'];
        $email = $data['email'];
    
        $email = $result->fetch_array(MYSQLI_ASSOC);
        {
            while($row = mysqli_fetch_array($result))
            {
                $to = $row['email'];   
                $subject = 'the subject';
                $message = 'hello';
                mail($to, "Your Subject", "A message set by you.", "If header information.");
            }
            if(mail($to, $subject, $message)){
                echo 'Your mail has been sent successfully.';
            } else{
                echo 'Unable to send email. Please try again.';
            }
        }



// $tbody .= "<tr>
        
//         <td>" . $row['user_name'] . "</td>
//         <td><a href='update_products.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Confirm</button></a>
//         <a href='delete_product.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a>
        
//         </td>
//          </tr>";
}

mysqli_close($connect);
} else 
header("location: error.php");
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../components/boot.php' ?>
    <title>Send Email</title>
</head>
<body>



<tr>
        <td><button class='btn btn-success' type="submit">Send Email</button></td>
        <td><a href="index_admin.php"><button class='btn btn-warning' type="button">Home</button></a></td>
        
</tr>
</body>
</html>