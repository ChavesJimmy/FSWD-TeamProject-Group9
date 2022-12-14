<?php

$error = false;
$name = $email = $subject= $message = '';
$nameError = $emailError = $subjectError = $messageError = '';

if (isset($_POST['submit'])) {

  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);

  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  
  $subject = trim($_POST['subject']);
  $subject = strip_tags($subject);
  $subject = htmlspecialchars($subject);

  
  $message = trim($_POST['message']);
  $message = strip_tags($message);
  $message = htmlspecialchars($message);

  if (empty($name)) {
    $error = true;
    $nameError = "Please enter your name.";
  }

  if (empty($email)) {
    $error = true;
    $emailError = "Please enter your email.";
  }

  if (empty($subject)) {
    $error = true;
    $subjectError = "Please enter your subject.";
  }

  if (empty($message)) {
    $error = true;
    $messageError = "Please enter your message.";
  }
}

   ?>
   
   <head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/49748d0fd6.js" crossorigin="anonymous"></script>
    <title>Contact Us</title>
   </head>
   <body>
   <?php require_once "../components/contact_navbar.php" ?>

        <h1 style="text-align:center; margin-top:2%; margin-bottom:2%;">Contact Us</h1>
    <form class="container border rounded rounded-3 p-4 w-50 mb-5" style="background-color: rgba(127, 123, 116, 0.8431372549)" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

       <input class="form-control mb-3" type="text" autocomplete="off" name="name" placeholder="Name" value="<?php echo $name; ?>" />
        <?php echo $nameError; ?>

        <input class="form-control mb-3" type="text" autocomplete="off" name="email" placeholder="Email" value="<?php echo $email; ?>"/>
        <?php echo $emailError; ?>

        <input class="form-control mb-3" type="text" autocomplete="off" name="subject" placeholder="Subject" value="<?php echo $subject; ?>"/>
        <?php echo $subjectError; ?>

        <input class="form-control mb-4" type="text" autocomplete="off" name="message" placeholder="Message" value="<?php echo $message; ?>"  />
        <?php echo $messageError; ?>
    
        <input class="form-control mb-2 btn btn-dark p-3"  type="submit" name="submit" value="Submit" />
       </form>
       <?php require_once "../components/footer.php" ?>

   </body>
</html>








