<?php
 session_start();
if (!isset($_SESSION['ADMIN']) && !isset($_SESSION['USER'])) {
    header("Location: index.php");
    exit;
} else if (isset($_SESSION['USER']) != "") {
    header("Location: index.php");
} else if (isset($_SESSION['ADMIN']) != "") {
    header("Location: index.php");
} 

if (isset($_GET['logout'])) {
    unset($_SESSION['USER']);
    unset($_SESSION['ADMIN']);
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}