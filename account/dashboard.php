<?php

    // start the session
    session_start();

    // check if you are logged in or not, if not then send back to login
    if (!isset($_SESSION['loggedin'])) {
        header("Location: login.php");
    }
    // Get the username from the session
    $name = $_SESSION['name'];

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Dashboard</title>
    </head>

    <body>
        <h1>Welcome, <?php echo $name; ?>!</h1>
        <p>You are now logged in. <a href="logout.php">Logout</a></p>
        <?php if($_SESSION['admin'] == true) : ?>
            <p>Welcome to the admin panel</p>
        <?php endif; ?>

    </body>

</html>