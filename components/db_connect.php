<?php

$localhost = "173.212.235.205";
$username = "juliacodefactory_julia";
$password = "jjh3MzM#X2";
$dbname = "juliacodefactory_fswd-teamproject_group9";

// create connection
$connect = new  mysqli($localhost, $username, $password, $dbname);

// check connection
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
} else {
  echo "Successfully Connected";
}

?>