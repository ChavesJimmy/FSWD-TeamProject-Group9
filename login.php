<?php
require_once 'components/db_connect.php';

$error = false;
$user_name = $password = $user_nameError = $passwordError = '';

if (isset($_POST['login'])) {

    $user_name = trim($_POST['user_name']);
    $user_name = strip_tags($user_name);
    $user_name = htmlspecialchars($user_name);

    $password = trim($_POST['password']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);

    if (empty($user_name)) {
        $error = true;
        $user_nameError = "Please enter your user name.";
    } 

    if (empty($password)) {
        $error = true;
        $passwordError = "Please enter your password.";
    }

  
    if (!$error) {

        $password = hash('sha256', $password);

        $sql = "SELECT id, status, password FROM users WHERE user_name = '$user_name'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        if ($count == 1 && $row['password'] == $password) {
            if ($row['status'] == 'admin') {
                $_SESSION['admin'] = $row['status'];
                header("Location: dashboard.php");
            } else {
                $_SESSION['user'] = $row['status'];
                header("Location: logout.php");
            }
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
}

if (isset($_SESSION['user']) != "") {
    header("Location: user_panel/user.php");
    exit;
  }
  if (isset($_SESSION['admin']) != "") {
    header("Location: admin_panel/index_admin.php");
  }

mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login- Animal Adoption</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
        <form
          method="post"
          action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
          autocomplete="off"
        >
          <h2>Login</h2>
          <?php
            if (isset($errMSG)) {
                echo $errMSG;
            }
            ?>

          <input
            type="text"
            autocomplete="off"
            name="user_name"
            placeholder="Your Username"
            value="<?php echo $user_name; ?>"
            maxlength="40"
          />
          <span class="text-danger"><?php echo $user_nameError; ?></span>

          <input
            type="password"
            name="password"
            placeholder="Your Password"
            maxlength="15"
          />
          <span class="text-danger"><?php echo $passwordError; ?></span>
          <button class="btn btn-block btn-primary" type="submit" name="login">
            Sign In
          </button>
          <a href="register.php">Not registered yet? Click here</a>
        </form>
  </body>
</html>