
<nav class="navbar navbar-expand-lg bg-light text-dark p-4 sticky-top" style="background-color: #837f79 !important;">
    <div class="container-fluid">
        <a class="navbar-brand w-25" href="../index.php">
            <div class="logo d-flex flex-column align-items-start">
                <img class="logo-img flex-fill w-75 " src="../img/logo.png">
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <span></span>
            </div>
        
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-5 d-flex justify-content-end" id="items">
                    <form method="get" action="../searchlist.php">
                        <input type="text" name="search" placeholder="Search for products" id="searchProd">
                        <button type="submit" class="search-btn" ><i class="fa-solid fa-magnifying-glass search-btn"></i></button>
                    </form>
                    
                    <li class="nav-item">
                        <a class="nav-link"  href="../user_panel/shopping_cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link"  href="../login.php"><i class="fa-solid fa-user"></i></a>
                    </li> 
                </ul>
        </div>
        <div id="mySidepanel" class="sidepanel">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a aria-current="page" href="../index.php">Home</a>
  <a href="../login.php">Login</a>
  <a href="../contact/contact.php">Contact</a>
  <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-5">
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="../index.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="../products/supplements.php">Supplements</a></li>
      <li><a class="dropdown-item" href="../products/equipment.php">Equipment</a></li>
    </ul>
    </li>
</ul>
  
 
</div>

<button class="openbtn" onclick="openNav()">&#9776;</button>

</nav>

<script>
    /* Set the width of the sidebar to 250px (show it) */
function openNav() {
  document.getElementById("mySidepanel").style.width = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.1)";
  document.getElementById("items").style.paddingRight = "200px";
  document.getElementById("items").style.transition = "all 1s";
}

/* Set the width of the sidebar to 0 (hide it) */
function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
  document.body.style.backgroundColor = "white";
  document.getElementById("items").style.paddingRight = "0px";
}
</script>