<?php

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "fswd-teamproject_group9";

// create connection
$connect = new  mysqli($localhost, $username, $password, $dbname);

/* check connection
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
} else {
  echo "Successfully Connected";
}
*/
?>