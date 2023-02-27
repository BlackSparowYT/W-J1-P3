<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sono:wght@300;600;800&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <header>
        <nav>
                <div id="navbar-desktop">
                    <div class="navbar-desktop-sitename">
                        <h2 class="t1">Mikado's</h2>
                    </div>
                    <div class="navbar-desktop-items">
                        <a class="t1" href="../index.html"><h3>Home</h3></a>
                        <a class="t2" href="../menu/index.php"><h3>Menu</h3></a>
                        <a class="t3" href="../over-ons/index.html"><h3>Over Ons</h3></a>
                        <a class="t4" href="../contact/index.html"><h3>Contact</h3></a>
                        <a class="t5" href="../account/index.html"><h3>Account</h3></a>
                    </div>
                </div>
                
                <div id="navbar-mobile">
                    <div class="navbar-mobile-sitename">
                        <h2 class="t1">Mikado's</h2>
                    </div>
                    <div class="navbar-mobile-items">
                        <a onclick="openNav()"><h3>&#9776;</h3></a>
                    </div>
                    <div id="navbar-mobile-fullscreen" class="nav-overlay">
                        <a href="javascript:void(0)" class="closebtn t1" onclick="closeNav()">&times;</a>
                        <div class="nav-overlay-content">
                            <a class="t1" href="../index.html"><h3>Home</h3></a>
                            <a class="t2" href="../menu/index.php"><h3>Menu</h3></a>
                            <a class="t3" href="../over-ons/index.html"><h3>Over Ons</h3></a>
                            <a class="t4" href="../contact/index.html"><h3>Contact</h3></a>
                            <a class="t5" href="../account/index.html"><h3>Account</h3></a>
                        </div>
                    </div>
                </div>

                <script>
                    function openNav() { document.getElementById("navbar-mobile-fullscreen").style.height = "100%"; }
                    function closeNav() { document.getElementById("navbar-mobile-fullscreen").style.height = "0%"; }
                </script>
            </nav>
        </header>

        <title>Menu || Mikado's</title>
        <link rel="stylesheet" href="../styles.css">

        <main class="menu-page">

            <div class="hero">
                <h1 class="t1">Ons Menu</h1>
            </div>
            <h2>Pizza's</h2>
            <hr>
            <div class="flexbox">
                <?php
                    require_once("../config.php");

                    $query = "SELECT * FROM `menu` WHERE categorie LIKE 'pizza'";
                    if ($is_query_run = mysqli_query($link, $query)) {
                        while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                        {
                            echo "<a class='block' href='./product.php?id=".$query_executed['id']."'/>";
                            echo "<img src='".$query_executed['image']."' />";
                            if ($query_executed['sub-categorie'] == "vegie" ) {
                                echo "<img class='sub-categorie' src='../files/images/menu/vegie.png' />";
                                echo "<div class='product-flex-box' style='margin-top: -65px;'>";
                            }
                            else {
                                echo "<div class='product-flex-box'>";
                            }
                            echo "<h2>".$query_executed['name']."</h2>";
                            echo "<p>".$query_executed['small-desc']."</p>";
                            echo "<hr>";
                            echo "<p class='prijs-text'>".$query_executed['prijs']."</p>";
                            echo "</div>";
                            echo "</a>";
                        }
                    } else { echo "Error in execution!"; }
                ?> 
            </div>
            <h2>Dranken</h2>
            <hr>
            <div class="flexbox">
                <?php
                    require_once("../config.php");

                    $query = "SELECT * FROM `menu` WHERE categorie LIKE 'dranken'";
                    if ($is_query_run = mysqli_query($link, $query)) {
                        while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                        {
                            echo "<a class='block' href='./product.php?id=".$query_executed['id']."'/>";
                            echo "<img class='dranken-img' src='".$query_executed['image']."' />";
                            echo "<div class='product-flex-box'>";
                            echo "<h2>".$query_executed['name']."</h2>";
                            echo "<p>".$query_executed['small-desc']."</p>";
                            echo "<hr>";
                            echo "<p class='prijs-text'>".$query_executed['prijs']."</p>";
                            echo "</div>";
                            echo "</a>";
                        }
                    } else { echo "Error in execution!"; }
                ?> 
            </div>
            <h2>Bijgerecht</h2>
            <hr>
            <div class="flexbox">
                <?php
                    require_once("../config.php");

                    $query = "SELECT * FROM `menu` WHERE categorie LIKE 'bijgerecht'";
                    if ($is_query_run = mysqli_query($link, $query)) {
                        while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                        {
                            echo "<a class='block' href='./product.php?id=".$query_executed['id']."'/>";
                            echo "<img src='".$query_executed['image']."' />";
                            if ($query_executed['sub-categorie'] == "vegie" ) {
                                echo "<img class='sub-categorie' src='../files/images/menu/vegie.png' />";
                                echo "<div class='product-flex-box' style='margin-top: -65px;'>";
                            }
                            else {
                                echo "<div class='product-flex-box'>";
                            }
                            echo "<h2>".$query_executed['name']."</h2>";
                            echo "<p>".$query_executed['small-desc']."</p>";
                            echo "<hr>";
                            echo "<p class='prijs-text'>".$query_executed['prijs']."</p>";
                            echo "</div>";
                            echo "</a>";
                        }
                    } else { echo "Error in execution!"; }
                ?> 
            </div>
        </main>
        <footer>

        </footer>
    </body>
</html>