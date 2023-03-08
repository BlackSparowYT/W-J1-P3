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

        <title>Admin Users || Het Oventje</title>
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
                    <h1 class="t1">Gebruikers</h1>
                </div>
            </div>
            <div class="dash-content admin-menu-block">
                <div class="table-content admin-menu">
                    <?php
                        require_once('../files/config.php');

                        $query = "SELECT * FROM `users`";

                        echo "<h3>Items op ons menu:</h3>";
                        echo "<div class='table-div'>";
                        echo "<table class='menu-table'>";
                        echo '<tr>';
                        echo '<th><p>User ID</p></th>';
                        echo '<th><p>User Naam</p></th>';
                        echo '<th><p>User email</p></th>';
                        echo '<th><p>User Admin Status</p></th>';
                        echo '<th><p>User Reset Token</p></th>';
                        echo '</tr>';

                        if ($is_run = mysqli_query($link, $query)) {
                            while ($result = mysqli_fetch_assoc($is_run)) {
                                echo '<tr>';
                                echo '<td><p>' . $result['id'] . '</p></td>';
                                echo '<td><p>' . $result['name'] . '</p></td>';
                                echo '<td><p>' . $result['email'] . '</p></td>';
                                echo '<td><p>' . $result['admin'] . '</p></td>';
                                echo '<td><p>' . $result['reset_token'] . '</p></td>';
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