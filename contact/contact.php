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
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title></title>
   </head>
   <body>

        <p>Contact Us</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

       <input type="text" autocomplete="off" name="name" placeholder="Name" value="<?php echo $name; ?>" />
        <?php echo $nameError; ?>

        <input type="text" autocomplete="off" name="email" placeholder="Email" value="<?php echo $email; ?>"/>
        <?php echo $emailError; ?>

        <input type="text" autocomplete="off" name="subject" placeholder="Subject" value="<?php echo $subject; ?>"/>
        <?php echo $subjectError; ?>

        <input type="text" autocomplete="off" name="message" placeholder="Message" value="<?php echo $message; ?>"  />
        <?php echo $messageError; ?>
    
        <input  type="submit" name="submit" value="Submit" />
       </form>
      
   </body>
</html>








