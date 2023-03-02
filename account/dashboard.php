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