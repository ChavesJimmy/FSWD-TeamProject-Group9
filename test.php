<?php 
session_start();
require_once 'components/db_connect.php';


echo $_SESSION['USER'];
echo $_SESSION['ADMIN'];

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';


/* if (isset($_SESSION['ADMIN'])) {
    echo "Herzlich Willkommen ".$_SESSION;
 } else {
    echo "Bitte erst einloggen";
 } */

?>

<h1>Test Seite</h1>