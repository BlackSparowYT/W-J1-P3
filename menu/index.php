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

                    <script>
                        var firstChoice = document.getElementById('first-choice');
                        var secondChoice = document.getElementById('second-choice');
                        var result = document.getElementById('result');

                        firstChoice.addEventListener('change', function() {
                            if (this.value == 'dranken') {
                            result.innerHTML = '<a class="filterbtn" href="index.php?cat=dranken">Filter</a>';
                            result.style.display = 'block';
                            } else if (this.value == 'pizza' || this.value == 'bijgerecht' || this.value == 'all') {
                            secondChoice.style.display = 'block';
                            secondChoice.children[0].addEventListener('change', function() {
                                if (this.value == 'vegetarian') {
                                    if (firstChoice.value == 'pizza') {
                                        result.innerHTML = '<a class="filterbtn" href="index.php?cat=pizza&sub_cat=vegie">Filter</a>';
                                    } else if (firstChoice.value == 'bijgerecht') {
                                        result.innerHTML = '<a class="filterbtn" href="index.php?cat=bijgerecht&sub_cat=vegie">Filter</a>';
                                    }else if (firstChoice.value == 'all') {
                                        result.innerHTML = '<a class="filterbtn" href="index.php?sub_cat=vegie">Filter</a>';
                                    }
                                    result.style.display = 'block';
                                } else if (this.value == 'all2') {
                                    if (firstChoice.value == 'pizza') {
                                        result.innerHTML = '<a class="filterbtn" href="index.php?cat=pizza">Filter</a>';
                                    } else if (firstChoice.value == 'bijgerecht') {
                                        result.innerHTML = '<a class="filterbtn" href="index.php?cat=bijgerecht">Filter</a>';
                                    }else if (firstChoice.value == 'all') {
                                        result.innerHTML = '<a class="filterbtn" href="index.php">Filter</a>';
                                    }
                                    result.style.display = 'block';
                                }
                            });
                            } else {
                            secondChoice.style.display = 'none';
                            result.style.display = 'none';
                            }
                        });
                    </script>
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
                            $query = "SELECT * FROM `menu` WHERE categorie LIKE 'pizza' AND sub_categorie LIKE '$sub_cat'";
                        } else {
                            $query = "SELECT * FROM `menu` WHERE categorie LIKE 'pizza'";
                        }
                        
                        echo "<h2>Pizza's</h2>";
                        echo "<hr>";
                        echo "<div class='flexbox'>";
    
    
                        if ($is_query_run = mysqli_query($link, $query)) {
                            while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                            {
                                echo "<a class='block' href='./product.php?id=".$query_executed['id']."'/>";
                                echo "<img src='".$query_executed['image']."' />";
                                if ($query_executed['sub_categorie'] == "vegie" ) {
                                    echo "<img class='sub_categorie' src='../files/images/menu/vegie.png' />";
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

                    } else if ($cat == 'dranken') {

                        // See if a sub categorie is selected and prepair the correct statement
                        if ($sub_cat != NULL) {
                            $query = "SELECT * FROM `menu` WHERE categorie LIKE 'dranken' AND sub_categorie LIKE '$sub_cat'";
                        } else {
                            $query = "SELECT * FROM `menu` WHERE categorie LIKE 'dranken'";
                        }

                        echo "</div>";
                        echo "<h2>Dranken</h2>";
                        echo "<hr>";
                        echo "<div class='flexbox'>";
    
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

                    } else if ($cat == 'bijgerecht') {

                        // See if a sub categorie is selected and prepair the correct statement
                        if ($sub_cat != NULL) {
                            $query = "SELECT * FROM `menu` WHERE categorie LIKE 'bijgerecht' AND sub_categorie LIKE '$sub_cat'";
                        } else {
                            $query = "SELECT * FROM `menu` WHERE categorie LIKE 'bijgerecht'";
                        }

                        echo "</div>";
                        echo "<h2>Bijgerecht</h2>";
                        echo "<hr>";
                        echo "<div class='flexbox'>";
    
                        $query = "SELECT * FROM `menu` WHERE categorie LIKE 'bijgerecht'";
                        if ($is_query_run = mysqli_query($link, $query)) {
                            while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                            {
                                echo "<a class='block' href='./product.php?id=".$query_executed['id']."'/>";
                                echo "<img src='".$query_executed['image']."' />";
                                if ($query_executed['sub_categorie'] == "vegie" ) {
                                    echo "<img class='sub_categorie' src='../files/images/menu/vegie.png' />";
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

                    } else if ($cat == NULL) {

                        // See if a sub categorie is selected and prepair the correct statement
                        if ($sub_cat != NULL) {
                            $query = "SELECT * FROM `menu` WHERE categorie LIKE 'pizza' AND sub_categorie LIKE '$sub_cat'";
                        } else {
                            $query = "SELECT * FROM `menu` WHERE categorie LIKE 'pizza'";
                        }
                        
                        echo "<h2>Pizza's</h2>";
                        echo "<hr>";
                        echo "<div class='flexbox'>";
    
    
                        if ($is_query_run = mysqli_query($link, $query)) {
                            while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                            {
                                echo "<a class='block' href='./product.php?id=".$query_executed['id']."'/>";
                                echo "<img src='".$query_executed['image']."' />";
                                if ($query_executed['sub_categorie'] == "vegie" ) {
                                    echo "<img class='sub_categorie' src='../files/images/menu/vegie.png' />";
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

                        // See if a sub categorie is selected and prepair the correct statement
                        if ($sub_cat != NULL) {
                            $query = "SELECT * FROM `menu` WHERE categorie LIKE 'dranken' AND sub_categorie LIKE '$sub_cat'";
                        } else {
                            $query = "SELECT * FROM `menu` WHERE categorie LIKE 'dranken'";
                        }

                        echo "</div>";
                        if ($sub_cat == "vegie" ) {
                            echo "<h2>Dranken (niet gefilterd op vegetarisch)</h2>";
                        }
                        else {
                            echo "<h2>Dranken</h2>";
                        }
                        echo "<hr>";
                        echo "<div class='flexbox'>";
    
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


                        // See if a sub categorie is selected and prepair the correct statement
                        if ($sub_cat != NULL) {
                            $query = "SELECT * FROM `menu` WHERE categorie LIKE 'bijgerecht' AND sub_categorie LIKE '$sub_cat'";
                        } else {
                            $query = "SELECT * FROM `menu` WHERE categorie LIKE 'bijgerecht'";
                        }

                        echo "</div>";
                        echo "<h2>Bijgerecht</h2>";
                        echo "<hr>";
                        echo "<div class='flexbox'>";
    
                        $query = "SELECT * FROM `menu` WHERE categorie LIKE 'bijgerecht'";
                        if ($is_query_run = mysqli_query($link, $query)) {
                            while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                            {
                                echo "<a class='block' href='./product.php?id=".$query_executed['id']."'/>";
                                echo "<img src='".$query_executed['image']."' />";
                                if ($query_executed['sub_categorie'] == "vegie" ) {
                                    echo "<img class='sub_categorie' src='../files/images/menu/vegie.png' />";
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