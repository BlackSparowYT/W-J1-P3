<?php

    session_start();

    if ($_SESSION['admin'] == 0) {
        header("location: login.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sono:wght@300;600;800&display=swap" rel="stylesheet">

        <title>Admin Orders || Het Oventje</title>
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
                        <a class="t1" href="../index.html">
                            <h3>Home</h3>
                        </a>
                        <a class="t2" href="../menu/index.php">
                            <h3>Menu</h3>
                        </a>
                        <a class="t3" href="../over-ons/index.html">
                            <h3>Over Ons</h3>
                        </a>
                        <a class="t4" href="../contact/index.html">
                            <h3>Contact</h3>
                        </a>
                        <a class="t5" href="../account/login.php">
                            <h3>Account</h3>
                        </a>
                    </div>
                </div>

                <div id="navbar-mobile">
                    <div class="navbar-mobile-sitelogo">
                        <img src="../files/images/logo-white-side.png">
                    </div>
                    <div class="navbar-mobile-items">
                        <a onclick="openNav()">
                            <h3>&#9776;</h3>
                        </a>
                    </div>
                    <div id="navbar-mobile-fullscreen" class="nav-overlay">
                        <a href="javascript:void(0)" class="closebtn t1" onclick="closeNav()">&times;</a>
                        <div class="nav-overlay-content">
                            <a class="t1" href="../index.html">
                                <h3>Home</h3>
                            </a>
                            <a class="t2" href="../menu/index.php">
                                <h3>Menu</h3>
                            </a>
                            <a class="t3" href="../over-ons/index.html">
                                <h3>Over Ons</h3>
                            </a>
                            <a class="t4" href="../contact/index.html">
                                <h3>Contact</h3>
                            </a>
                            <a class="t5" href="../account/login.php">
                                <h3>Account</h3>
                            </a>
                        </div>
                    </div>
                </div>

                <script>
                    function openNav() {
                        document.getElementById("navbar-mobile-fullscreen").style.height = "100%";
                    }

                    function closeNav() {
                        document.getElementById("navbar-mobile-fullscreen").style.height = "0%";
                    }
                </script>
            </nav>
        </header>

        <main class="account-page admin-page">

            <div class="hero">
                <div class="hero-text">
                    <h1 class="t1">Orders</h1>
                </div>
            </div>
            <div class="dash-content admin-menu-block">
                <div class="table-content">
                    <?php
                        require_once('../files/config.php');

                        echo "<h3>Orders:</h3>";
                        echo "<div class='table-div'>";
                        echo "<table class='admin-orders-table'>";
                        echo '<tr>';
                        echo '<th><p>Order ID</p></th>';
                        echo '<th><p>User ID</p></th>';
                        echo '<th><p>Datum</p></th>';
                        echo '<th><p>Order</p></th>';
                        echo '</tr>';

                        $stmt = $link->prepare("SELECT * FROM `orders`");
                        if ($stmt->execute()) {
                            $is_run = $stmt->get_result();
                            while ($result = mysqli_fetch_assoc($is_run))
                            {
                                echo '<tr>';
                                echo '<td><p>'.$result['id'].'</p></td>';
                                echo '<td><p>'.$result['user_id'].'</p></td>';
                                echo '<td><p>'.$result['date'].'</p></td>';
                                echo '<td><p>'.$result['contains'].'</p></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo "Error in execution!";
                        }

                        echo "</table>";
                        echo "</div>";
                    ?>
                </div>
            </div>
        </main>
        <footer>

        </footer>
    </body>

</html>