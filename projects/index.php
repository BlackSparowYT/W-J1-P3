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
                        <h2 class="t1">F</h2>
                        <h2 class="t2">.</h2>
                        <h2 class="t3">R</h2>
                        <h2 class="t4">.</h2>
                        <h2 class="t5">&nbsp;</h2>
                        <h2 class="t6">J</h2>
                        <h2 class="t7">o</h2>
                        <h2 class="t8">s</h2>
                        <h2 class="t9">t</h2>
                        <h2 class="t10">e</h2>
                        <h2 class="t11">n</h2>
                    </div>
                    <div class="navbar-desktop-items">
                        <a class="t1" href="../index.html"><h3>Home</h3></a>
                        <a class="t2" href="../projects/index.php"><h3>Projects</h3></a>
                        <a class="t3" href="../contact/index.html"><h3>Contact</h3></a>
                        <a class="t4" href="../about/index.html"><h3>About</h3></a>
                    </div>
                </div>


                
                <div id="navbar-mobile">
                    <div class="navbar-mobile-sitename">
                        <h2 class="t1">F</h2>
                        <h2 class="t2">.</h2>
                        <h2 class="t3">R</h2>
                        <h2 class="t4">.</h2>
                        <h2 class="t5">&nbsp;</h2>
                        <h2 class="t6">J</h2>
                        <h2 class="t7">o</h2>
                        <h2 class="t8">s</h2>
                        <h2 class="t9">t</h2>
                        <h2 class="t10">e</h2>
                        <h2 class="t11">n</h2>
                    </div>
                    <div class="navbar-mobile-items">
                        <a onclick="openNav()"><h3>&#9776;</h3></a>
                    </div>
                    <div id="navbar-mobile-fullscreen" class="nav-overlay">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <div class="nav-overlay-content">
                            <a class="t1" href="../index.html"><h3>Home</h3></a>
                            <a class="t2" href="../projects/index.php"><h3>Projects</h3></a>
                            <a class="t3" href="../contact/index.html"><h3>Contact</h3></a>
                            <a class="t4" href="../about/index.html"><h3>About</h3></a>
                        </div>
                    </div>
                </div>


                <script>
                    function openNav() { document.getElementById("navbar-mobile-fullscreen").style.height = "100%"; }
                    function closeNav() { document.getElementById("navbar-mobile-fullscreen").style.height = "0%"; }
                </script>
            </nav>
        </header>

        <title>Projects || F.R. Josten</title>
        <link rel="stylesheet" href="../styles.css">

        <main class="projects-page">

            <div class="image-background">
                <!-- particles.js container --> 
                <div id="particles-js"></div> 

                <!-- particles.js lib - https://github.com/VincentGarreau/particles.js --> 
                <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> 

                <!-- particles.js script -->
                <script src="../scripts.js"></script>
            </div>

            <div class="hero">
                <!--<div class="overlay">-->
                    <h1 class="t1">P</h1>
                    <h1 class="t2">r</h1>
                    <h1 class="t3">o</h1>
                    <h1 class="t4">j</h1>
                    <h1 class="t5">e</h1>
                    <h1 class="t6">c</h1>
                    <h1 class="t7">t</h1>
                    <h1 class="t8">s</h1>
                <!--</div>-->
            </div>
            <div class="hero-arrow" id="t1">
                <a href="#scroll-arrow"><img id="scroll-arrow" src="../images/Arrow.png" /></a>
            </div>
            <h2 style="text-align: center; font-size: x-large; margin-top: 40px;">School Projects</h2>
            <div class="projects-block-1">
                <?php
                    require_once("../config.php");

                    $query = "SELECT * FROM `projects` WHERE id BETWEEN 1000 AND 1999";
                    if ($is_query_run = mysqli_query($link, $query)) {
                        while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                        {
                            echo "<a class='block' href='./project.php?id=".$query_executed['id']."'/>";
                            echo "<div class='product-flex-box'>";
                            echo "<img src='".$query_executed['image']."' />";
                            echo "<h3>".$query_executed['name']."</h3>";
                            echo "<p>".$query_executed['small-desc']."</p>";
                            echo "</div>";
                            echo "</a>";
                        }
                    } else { echo "Error in execution!"; }
                ?> 
            </div>
            <h2 style="text-align: center; font-size: x-large;      display: none;">Personal Projects</h2>
            <div class="projects-block-1"                           style="display: none;">
                <?php
                    require_once("../config.php");

                    $query = "SELECT * FROM `projects` WHERE id BETWEEN 2000 AND 2999";
                    if ($is_query_run = mysqli_query($link, $query)) {
                        while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                        {
                            echo "<a class='block' href='./project.php?id=".$query_executed['id']."'/>";
                            echo "<div class='product-flex-box'>";
                            echo "<img src='".$query_executed['image']."' />";
                            echo "<h3>".$query_executed['name']."</h3>";
                            echo "<p>".$query_executed['small-desc']."</p>";
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