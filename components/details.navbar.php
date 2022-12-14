<nav class="navbar navbar-expand-lg bg-light text-dark p-4 sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand w-25" href="../index.php">
            <div class="logo d-flex flex-column align-items-start">
                <img class="logo-img flex-fill w-75 " src="../img/logo.png">
            </div>
        </a>

    </div>

    <a class="btn btn-outline-dark" href="../user_panel/index_user.php">BACK</a>

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