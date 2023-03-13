<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sono:wght@300;600;800&display=swap" rel="stylesheet">

        <title>Menu || Het Oventje</title>
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

        <main class="menu-page">

            <div class="hero">
                <div class="hero-text">
                    <h1 class="t1">Ons Menu</h1>
                </div>    

                <div class="select-cat">
                    <select id="first-choice">
                        <option selected disabled>Filter op categorie</option>
                        <option value="pizza">Pizza</option>
                        <option value="dranken">Dranken</option>
                        <option value="bijgerecht">Bijgerecht</option>
                        <option value="all">Alles</option>
                    </select>

                    <div id="second-choice" style="display:none;">
                        <select>
                            <option selected disabled>Filter op vegetarisch</option>
                            <option value="vegetarian">Vegetarisch</option>
                            <option value="all2">Alles</option>
                        </select>
                    </div>

                    <div id="result" style="display:none;"></div>

                    <script src="../files/filter-items.js"></script>
                </div>
            </div>
                <?php

                    ini_set('display_errors', 0);

                    require_once("../files/config.php");

                    $sub_cat = $cat = NULL;

                    $sub_cat = $_GET['sub_cat'];
                    $cat = $_GET['cat'];

                    if ($cat == 'pizza'){

                        // See if a sub categorie is selected and prepair the correct statement
                        if ($sub_cat != NULL) {
                            $stmt = $link->prepare("SELECT * FROM `menu` WHERE categorie LIKE 'pizza' AND sub_categorie LIKE ?");
                            $stmt->bind_param("s", $sub_cat);
                        } else {
                            $stmt = $link->prepare("SELECT * FROM `menu` WHERE categorie LIKE 'pizza'");
                        }
                        
                        echo "<h2>Pizza's</h2>";
                        echo "<hr>";
                        echo "<div class='flexbox'>";
    
    
                        if ($stmt->execute()) {
                            $is_run = $stmt->get_result();
                            while ($result = mysqli_fetch_assoc($is_run))
                            {
                                echo "<a class='block' href='./product.php?id=".$result['id']."'/>";
                                echo "<img src='".$result['image']."' />";
                                if ($result['sub_categorie'] == "veggi" ) {
                                    echo "<img class='sub_categorie' src='../files/images/menu/veggi-marker.png' />";
                                    echo "<div class='product-flex-box' style='margin-top: -65px;'>";
                                }
                                else {
                                    echo "<div class='product-flex-box'>";
                                }
                                echo "<h2>".$result['name']."</h2>";
                                echo "<p>".$result['small_desc']."</p>";
                                echo "<hr>";
                                echo "<p class='prijs-text'>".$result['prijs']."</p>";
                                echo "</div>";
                                echo "</a>";
                            }
                        } else { echo "Error in execution!"; }

                    } else if ($cat == 'dranken') {

                        echo "</div>";
                        echo "<h2>Dranken</h2>";
                        echo "<hr>";
                        echo "<div class='flexbox'>";
    
                        $stmt = $link->prepare("SELECT * FROM `menu` WHERE categorie LIKE 'dranken'");
                        if ($stmt->execute()) {
                            $is_run = $stmt->get_result();
                            while ($result = mysqli_fetch_assoc($is_run))
                            {
                                echo "<a class='block' href='./product.php?id=".$result['id']."'/>";
                                echo "<img class='dranken-img' src='".$result['image']."' />";
                                echo "<div class='product-flex-box'>";
                                echo "<h2>".$result['name']."</h2>";
                                echo "<p>".$result['small_desc']."</p>";
                                echo "<hr>";
                                echo "<p class='prijs-text'>".$result['prijs']."</p>";
                                echo "</div>";
                                echo "</a>";
                            }
                        } else { echo "Error in execution!"; }

                    } else if ($cat == 'bijgerecht') {

                        // See if a sub categorie is selected and prepair the correct statement
                        if ($sub_cat != NULL) {
                            $stmt = $link->prepare("SELECT * FROM `menu` WHERE categorie LIKE 'bijgerecht' AND sub_categorie LIKE ?");
                            $stmt->bind_param("s", $sub_cat);
                        } else {
                            $stmt = $link->prepare("SELECT * FROM `menu` WHERE categorie LIKE 'bijgerecht' ");
                        }

                        echo "</div>";
                        echo "<h2>Bijgerecht</h2>";
                        echo "<hr>";
                        echo "<div class='flexbox'>";

                        if ($stmt->execute()) {
                            $is_run = $stmt->get_result();
                            while ($result = mysqli_fetch_assoc($is_run))
                            {
                                echo "<a class='block' href='./product.php?id=".$result['id']."'/>";
                                echo "<img src='".$result['image']."' />";
                                if ($result['sub_categorie'] == "veggi" ) {
                                    echo "<img class='sub_categorie' src='../files/images/menu/veggi-marker.png' />";
                                    echo "<div class='product-flex-box' style='margin-top: -65px;'>";
                                }
                                else {
                                    echo "<div class='product-flex-box'>";
                                }
                                echo "<h2>".$result['name']."</h2>";
                                echo "<p>".$result['small_desc']."</p>";
                                echo "<hr>";
                                echo "<p class='prijs-text'>".$result['prijs']."</p>";
                                echo "</div>";
                                echo "</a>";
                            }
                        } else { echo "Error in execution!"; }

                    } else if ($cat == NULL) {

                        // See if a sub categorie is selected and prepair the correct statement
                        if ($sub_cat != NULL) {
                            $stmt = $link->prepare("SELECT * FROM `menu` WHERE categorie LIKE 'pizza' AND sub_categorie LIKE ?");
                            $stmt->bind_param("s", $sub_cat);
                            
                        } else {
                            $stmt = $link->prepare("SELECT * FROM `menu` WHERE categorie LIKE 'pizza'");
                        }
                        
                        echo "<h2>Pizza's</h2>";
                        echo "<hr>";
                        echo "<div class='flexbox'>";
    
    
                        if ($stmt->execute()) {
                            $is_run = $stmt->get_result();
                            while ($result = mysqli_fetch_assoc($is_run))
                            {
                                echo "<a class='block' href='./product.php?id=".$result['id']."'/>";
                                echo "<img src='".$result['image']."' />";
                                if ($result['sub_categorie'] == "veggi" ) {
                                    echo "<img class='sub_categorie' src='../files/images/menu/veggi-marker.png' />";
                                    echo "<div class='product-flex-box' style='margin-top: -65px;'>";
                                }
                                else {
                                    echo "<div class='product-flex-box'>";
                                }
                                echo "<h2>".$result['name']."</h2>";
                                echo "<p>".$result['small_desc']."</p>";
                                echo "<hr>";
                                echo "<p class='prijs-text'>".$result['prijs']."</p>";
                                echo "</div>";
                                echo "</a>";
                            }
                        } else { echo "Error in execution!"; }

                        echo "</div>";
                        if ($sub_cat == "veggi" ) {
                            echo "<h2>Dranken (niet gefilterd op vegetarisch)</h2>";
                        }
                        else {
                            echo "<h2>Dranken</h2>";
                        }
                        echo "<hr>";
                        echo "<div class='flexbox'>";
    
                        $stmt = $link->prepare("SELECT * FROM `menu` WHERE categorie LIKE 'dranken'");
                        if ($stmt->execute()) {
                            $is_run = $stmt->get_result();
                            while ($result = mysqli_fetch_assoc($is_run))
                            {
                                echo "<a class='block' href='./product.php?id=".$result['id']."'/>";
                                echo "<img class='dranken-img' src='".$result['image']."' />";
                                echo "<div class='product-flex-box'>";
                                echo "<h2>".$result['name']."</h2>";
                                echo "<p>".$result['small_desc']."</p>";
                                echo "<hr>";
                                echo "<p class='prijs-text'>".$result['prijs']."</p>";
                                echo "</div>";
                                echo "</a>";
                            }
                        } else { echo "Error in execution!"; }


                        // See if a sub categorie is selected and prepair the correct statement
                        if ($sub_cat != NULL) {
                            $stmt = $link->prepare("SELECT * FROM `menu` WHERE categorie LIKE 'bijgerecht' AND sub_categorie LIKE ?");
                            $stmt->bind_param("s", $sub_cat);
                            
                        } else {
                            $stmt = $link->prepare("SELECT * FROM `menu` WHERE categorie LIKE 'bijgerecht'");
                        }

                        echo "</div>";
                        echo "<h2>Bijgerecht</h2>";
                        echo "<hr>";
                        echo "<div class='flexbox'>";

                        if ($stmt->execute()) {
                            $is_run = $stmt->get_result();
                            while ($result = mysqli_fetch_assoc($is_run))
                            {
                                echo "<a class='block' href='./product.php?id=".$result['id']."'/>";
                                echo "<img src='".$result['image']."' />";
                                if ($result['sub_categorie'] == "veggi" ) {
                                    echo "<img class='sub_categorie' src='../files/images/menu/veggi-marker.png' />";
                                    echo "<div class='product-flex-box' style='margin-top: -65px;'>";
                                }
                                else {
                                    echo "<div class='product-flex-box'>";
                                }
                                echo "<h2>".$result['name']."</h2>";
                                echo "<p>".$result['small_desc']."</p>";
                                echo "<hr>";
                                echo "<p class='prijs-text'>".$result['prijs']."</p>";
                                echo "</div>";
                                echo "</a>";
                            }
                        } else { echo "Error in execution!"; }

                    } else {
                        echo "<h2 style='color: red;'>INVALID CATEGORIE</h2>";
                    }
                    

                    
                ?> 
            </div>
        </main>

        <footer>

        </footer>

    </body>
</html>