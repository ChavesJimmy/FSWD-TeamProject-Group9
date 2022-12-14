<?php
session_start(); 
if (isset($_SESSION['USER']) != "") {
  header("Location: user_panel/index_user.php");
}
if (isset($_SESSION['ADMIN']) != "") {
  header("Location: admin_panel/index_admin.php"); 
} 
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';

$error = false;
$user_name = $first_name = $last_name = $address = $email = $birth_date = $password = $photo = '';
$user_nameError =  $nameError = $addressError = $emailError = $birth_dateError = $passwordError = $photoError = '';
if (isset($_POST['btn-signup'])) {

    $user_name = trim($_POST['user_name']);
    $user_name = strip_tags($user_name);
    $user_name = htmlspecialchars($user_name);

    $first_name = trim($_POST['first_name']);
    $first_name = strip_tags($first_name);
    $first_name = htmlspecialchars($first_name);

    $last_name = trim($_POST['last_name']);
    $last_name = strip_tags($last_name);
    $last_name = htmlspecialchars($last_name);

    $address = trim($_POST['address']);
    $address = strip_tags($address);
    $address = htmlspecialchars($address);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $birth_date = trim($_POST['birth_date']);
    $birth_date = strip_tags($birth_date);
    $birth_date = htmlspecialchars($birth_date);

    $password = trim($_POST['password']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);


    $uploadError = '';
    $photo = file_upload($_FILES['photo']);




    // basic name validation
    if (empty($first_name) || empty($last_name)) {
        $error = true;
        $nameError = "Please enter your full name and surname";
    } else if (strlen($first_name) < 3 || strlen($last_name) < 3) {
        $error = true;
        $nameError = "Name and surname must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z]+$/", $first_name) || !preg_match("/^[a-zA-Z]+$/", $last_name)) {
        $error = true;
        $nameError = "Name and surname must contain only letters and no spaces.";
    }

    // basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {
        // checks whether the email exists or not
        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    // checks if the date input was left empty
    if (empty($birth_date)) {
        $error = true;
        $birth_dateError = "Please enter your date of birth.";
    }
    // password validation
    if (empty($password)) {
        $error = true;
        $passwordError = "Please enter password.";
    } else if (strlen($password) < 6) {
        $error = true;
        $passwordError = "Password must have at least 6 characters.";
    }

    $password = hash('sha256', $password);
    if (!$error) {

        $query = "INSERT INTO users(user_name, first_name, last_name, password, email, address, birth_date, photo)
              VALUES('$user_name', '$first_name', '$last_name', '$password', '$email', '$address', '$birth_date', '$photo->fileName')";
        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            $uploadError = ($photo->error != 0) ? $photo->ErrorMessage : '';
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
            $uploadError = ($photo->error != 0) ? $photo->ErrorMessage : '';
        }
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/49748d0fd6.js" crossorigin="anonymous"></script>
    <?php require_once 'components/boot.php' ?>
</head>

<body class=" bg-light">

    <div class="container mt-4 mb-5">
        <form class="cont1 container border rounded-3 p-4 w-50" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data" style="  background-color: rgba(127, 123, 116, 0.8431372549);
">
            <h1 class="mb-4" style="text-align:center;">Register</h1>

            <?php
            if (isset($errMSG)) {
            ?>
                <div class="alert alert-<?php echo $errTyp ?>">
                    <p><?php echo $errMSG; ?></p>
                </div>

            <?php
            }
            ?>

            <input type="text" name="user_name" class="form-control mb-2" placeholder="Username" maxlength="50" value="<?php echo $user_name ?>" />
            <span class="text-danger"> <?php echo $user_nameError; ?> </span>

            <input type="text" name="first_name" class="form-control mb-2" placeholder="First name" maxlength="50" value="<?php echo $first_name ?>" />
            <span class="text-danger"> <?php echo $nameError; ?> </span>

            <input type="text" name="last_name" class="form-control mb-2" placeholder="Surname" maxlength="50" value="<?php echo $last_name ?>" />
            <span class="text-danger"> <?php echo $nameError; ?> </span>


            <input type="text" name="address" class="form-control mb-2" placeholder="Address" maxlength="50" value="<?php echo $address ?>" />
            <span class="text-danger"> <?php echo $addressError; ?> </span>

            <input type="email" name="email" class="form-control mb-2" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
            <span class="text-danger"> <?php echo $emailError; ?> </span>

            <input class='form-control w-50 mb-2' type="date" name="birth_date" value="<?php echo $birth_date ?>" />
            <span class="text-danger"> <?php echo $birth_dateError; ?> </span>



            <input type="password" name="password" class="form-control" placeholder="Enter Password" maxlength="15" />
            <span class="text-danger"> <?php echo $passwordError; ?> </span>
            <hr />

            <div>
          <input class="form-control mb-2 w-75" type="file" name="photo" />
          <span><?php echo $photoError; ?> </span>
            </div>

            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            <hr />
            <a href="login.php" class="btn btn-outline-primary">Sign in here</a>
        </form>
    </div>
    <?php require_once "components/footer.php" ?>

</body>

</html>