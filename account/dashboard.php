<?php

    // start the session
    session_start();

    // check if you are logged in or not, if not then send back to login
    if (!isset($_SESSION['loggedin'])) {
        header("Location: login.php");
    }
    // Get the username from the session
    $username = $_SESSION['name'];

?>

<!DOCTYPE html>
<html>

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sono:wght@300;600;800&display=swap" rel="stylesheet">

        <title>Dashboard || Het Oventje</title>
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

        <main class="dash-page account-page">
            <div class="hero">
                <div class="hero-text">
                    <h1 class="t1">Welkom, <?php echo $username; ?>!</h1>
                </div>
            </div>
            <div class="dash-content">
                <div class="table-content">
                    <?php if($_SESSION['admin'] != true) : ?>
                        <div class="user-table order">
                            <h3>Je recenten orders:</h3>
                            <?php
                                require_once('../files/config.php');
                                $user_id = $_SESSION['id'];
                                $query = "SELECT * FROM `orders` WHERE user_id LIKE '$user_id' LIMIT 5";
            

                                echo "<table class='order-table'>";
                                echo '<tr>';
                                echo '<th><p>Order ID</p></th>';
                                echo '<th><p>Tijd</p></th>';
                                echo '<th><p>Order</p></th>';
                                echo '</tr>';

                                if ($is_query_run = mysqli_query($link, $query)) {
                                    while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                                    {
                                        echo '<tr>';
                                        echo '<td><p>'.$query_executed['id'].'</p></td>';
                                        echo '<td><p>'.$query_executed['date'].'</p></td>';
                                        echo '<td><p>'.$query_executed['contains'].'</p></td>';
                                        echo '</tr>';
                                    }
                                } else { echo "Error in execution!"; }

                                echo "</table>";
                            ?>
                        </div>
                        <div class="user-table reseveringen">
                            <h3>Je recenten reseveringen:</h3>
                            <?php
                                require_once('../files/config.php');
                                $user_id = $_SESSION['id'];
                                $query = "SELECT * FROM `reseveringen` WHERE user_id LIKE '$user_id' LIMIT 5";

                                echo "<table class='order-table'>";
                                echo '<tr>';
                                echo '<th><p>Order ID</p></th>';
                                echo '<th><p>Tijd</p></th>';
                                echo '<th><p>Order</p></th>';
                                echo '</tr>';

                                if ($is_query_run = mysqli_query($link, $query)) {
                                    while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                                    {
                                        echo '<tr>';
                                        echo '<td><p>'.$query_executed['id'].'</p></td>';
                                        echo '<td><p>'.$query_executed['date'].'</p></td>';
                                        echo '<td><p>'.$query_executed['contains'].'</p></td>';
                                        echo '</tr>';
                                    }
                                } else { echo "Error in execution!"; }

                                echo "</table>";
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php if($_SESSION['admin'] == true) : ?>
                        <div class="admin-table order">
                            <h3>Recenten orders:</h3>
                            <?php
                                require_once('../files/config.php');
                                $query = "SELECT * FROM `orders` LIMIT 5";
            

                                echo "<table class='order-table'>";
                                echo '<tr>';
                                echo '<th><p>Order ID</p></th>';
                                echo '<th><p>User ID</p></th>';
                                echo '<th><p>Tijd</p></th>';
                                echo '<th><p>Order</p></th>';
                                echo '</tr>';

                                if ($is_query_run = mysqli_query($link, $query)) {
                                    while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                                    {
                                        echo '<tr>';
                                        echo '<td><p>'.$query_executed['id'].'</p></td>';
                                        echo '<td><p>'.$query_executed['user_id'].'</p></td>';
                                        echo '<td><p>'.$query_executed['date'].'</p></td>';
                                        echo '<td><p>'.$query_executed['contains'].'</p></td>';
                                        echo '</tr>';
                                    }
                                } else { echo "Error in execution!"; }

                                echo "</table>";
                            ?>
                            
                        </div>
                        <div class="admin-table reseveringen">
                            <h3>Recenten reseveringen:</h3>
                            <?php
                                require_once('../files/config.php');
                                $query = "SELECT * FROM `reseveringen` LIMIT 5";
            

                                echo "<table class='order-table'>";
                                echo '<tr>';
                                echo '<th><p>Order ID</p></th>';
                                echo '<th><p>User ID</p></th>';
                                echo '<th><p>Tijd</p></th>';
                                echo '<th><p>Order</p></th>';
                                echo '</tr>';

                                if ($is_query_run = mysqli_query($link, $query)) {
                                    while ($query_executed = mysqli_fetch_assoc ($is_query_run))
                                    {
                                        echo '<tr>';
                                        echo '<td><p>'.$query_executed['id'].'</p></td>';
                                        echo '<td><p>'.$query_executed['user_id'].'</p></td>';
                                        echo '<td><p>'.$query_executed['date'].'</p></td>';
                                        echo '<td><p>'.$query_executed['contains'].'</p></td>';
                                        echo '</tr>';
                                    }
                                } else { echo "Error in execution!"; }

                                echo "</table>";
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="btn-content">
                    <div class="user-btns">
                        <h3>Pas je account aan:</h3> 
                        <a href="logout.php" class="first-btn">Log uit</a>
                        <a href="reset-name.php">Verander Naam</a>
                        <a href="reset-mail.php">Verander Email</a>
                        <a href="reset-pass.php" class="last-btn">Verander Wachtwoord</a>
                    </div>
                    <?php if($_SESSION['admin'] == true) : ?>
                        <div class="user-btns">
                            <h3>Meer informatie:</h3> 
                            <a href="admin-menu.php" class="first-btn">Bekijk items</a>
                            <a href="admin-users.php">Bekijk Gebruikers</a>
                            <a href="admin-orders.php">Bekijk orders</a>
                            <a href="admin-resev.php" class="last-btn">Bekijk reseveringen</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </body>

</html>