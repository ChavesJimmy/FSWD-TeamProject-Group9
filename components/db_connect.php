<?php

$localhost = "";
$username = "";
$password = "";
$dbname = "";

// create connection
$connect = new  mysqli($localhost, $username, $password, $dbname);

// check connection
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
} else {
  echo "Successfully Connected";
}

?>