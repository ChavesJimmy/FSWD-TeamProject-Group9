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
</head>

<body>
<?php require_once "components/navbar.php" ?>    

        <!-- Hero -->
        <div class="hero">
        <div class="hero-img-container">
          <img class="hero-img" src=".">
        </div>
        </div>


    <!-- Start Main Section -->
    <main>
        <div class="d-flex flex-column align-items-center w-100">
            <h1 class="p-3 text-light text-center mt-5 mb-5">Welcome to our shop</h1>
        </div>
        <div class="container">
            <!-- Cards Area printed from Classes -->
            <div id="result" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 justify-content-center m-auto mb-5 gap-5">

            </div>
        </div>
    </main>



    <!-- Start Footer -->
    <?php require_once "components/footer.php" ?> 

    <!-- Scripts -->
    <!-- Swiper Script -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>    <!-- General Script -->
    <script src="scripts/script.js"></script>
</body>

</html>