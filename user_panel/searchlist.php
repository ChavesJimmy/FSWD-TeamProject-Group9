<?php
//PHP FILE FOR THE RESEARCH PRODUCTS
require_once '../components/db_connect.php';
session_start();

$search =$_GET['search'];
$qlProducts ="SELECT * FROM products WHERE name LIKE '%$search%'";
$result = mysqli_query($connect, $qlProducts);
$searchresult = "";
$tbody = "";
if(mysqli_num_rows($result)==0) {
        $tbody= "no match";}
   else{
    while($rows=mysqli_fetch_array($result, MYSQLI_ASSOC)){
      if(empty($search)){
          echo"";}
          else{
            if ($rows['Discount']>0){
              $tbody .= "<br><tr class='col-10'>
              <td>" . $rows['name'] . "</td>
              <td>/" . $rows['price']-($rows['Discount']*$rows['price']/100). "EUR</td>
              <td><a href='details.php?id=" . $rows['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Details</button></a>  
            </td>
           </tr><br>";} 
           
           else{
              $tbody .= "<br><tr class='col-10'>
              <td>" . $rows['name'] . "</td>
              <td> /" . $rows['price'] . "EUR</td>
              <td><a href='details.php?id=" . $rows['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Details</button></a>  

              </td>
              
           </tr> <br>";
           }}}}

          ?>

          <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/49748d0fd6.js" crossorigin="anonymous"></script>
  <title>Atom Body</title>
  <style type="text/css">
   
   td {
       text-align: center;
       vertical-align: middle;
       border: solid;
       font-weight: bold;

   }
   tr {
       text-align: center;
       border: solid;
       font-weight: bold;

   }
   #right{
     float: right;
     position: absolute;
     z-index: 20;
     background-color: whitesmoke;
     right: 0;
   }
   </style>
</head>

<body>
<!-- Start Main Section -->
<main>
<div class="manageProduct w-25 d-block" id="right">
 <div class="row w-100">
   <h6>Search result:</h6>
   <div class="container-productmb-5 w-100 m-auto border border-4">
     <?= $tbody; ?>
   </div>
 </div>
</div>
</main>
</body>