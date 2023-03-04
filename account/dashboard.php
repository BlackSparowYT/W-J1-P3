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
        <title>Dashboard</title>
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

        
        <h1>Welkom, <?php echo $username; ?>!</h1>
        <p>You are now logged in. <a href="logout.php">Logout</a></p>
        <p>Want to change your username? <a href="reset-name.php">Change username</a></p>
        <p>Want to change your email? <a href="reset-mail.php">Change Email</a></p>
        <p>Want to change your password? <a href="reset-pass.php">Change Password</a></p>
        <?php if($_SESSION['admin'] == true) : ?>
            <p>Welcome to the admin panel</p>
        <?php endif; ?>

    </body>

</html>