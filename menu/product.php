<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sono:wght@300;600;800&display=swap" rel="stylesheet">

        <title>Product || Het Oventje</title>
        <link rel="stylesheet" href="../styles.css">
    </head>
    
    <body>
        <header>
            <nav>
                <div id="navbar-desktop">
                    <div class="navbar-desktop-sitelogo">
                        <img src="../files/images/logo-white-side.png">
                    </div>
                    <div class="navbar-desktop-items">
                        <a class="t1" href="../index.html"><h3>Home</h3></a>
                        <a class="t2" href="../menu/index.php"><h3>Menu</h3></a>
                        <a class="t3" href="../over-ons/index.html"><h3>Over Ons</h3></a>
                        <a class="t4" href="../contact/index.html"><h3>Contact</h3></a>
                        <a class="t5" href="../account/login.php"><h3>Account</h3></a>
                    </div>
                </div>
                
                <div id="navbar-mobile">
                    <div class="navbar-mobile-sitelogo">
                        <img src="../files/images/logo-white-side.png">
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
                            <a class="t5" href="../account/login.php"><h3>Account</h3></a>
                        </div>
                    </div>
                </div>

                <script>
                    function openNav() { document.getElementById("navbar-mobile-fullscreen").style.height = "100%"; }
                    function closeNav() { document.getElementById("navbar-mobile-fullscreen").style.height = "0%"; }
                </script>
            </nav>
        </header>

        <main class="projects-page">

            <div class="image-background">
                <!-- particles.js container --> 
                <div id="particles-js"></div> 

                <!-- particles.js lib - https://github.com/VincentGarreau/particles.js --> 
                <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> 

                <!-- particles.js script -->
                <script src="../scripts.js"></script>
            </div>

            
            <div class="projects-block-2">
                <?php
                    require_once("../config.php");

                    $urlid = $_GET["id"];

                    $query = "SELECT * FROM `menu` WHERE id = $urlid";
                    if ($is_query_run = mysqli_query($link, $query)) {
                        while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                        {
                            echo "<img src='".$query_executed['image']."' />";
                            echo "<div class='product-flex-box'>";
                            echo "<h2>".$query_executed['name']."</h2>";
                            echo "<p class='desc'>".$query_executed['large-desc']."</p>";
                            echo "<p class='bttns'>".$query_executed['buttons']."</p>";
                            echo "</div>";
                        }
                    } else { echo "Error in execution!"; }
                ?> 
            </div>
        </main>
        <footer>

        </footer>
    </body>
</html>