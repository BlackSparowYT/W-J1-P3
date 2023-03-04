<?php
    // Start a session
    session_start();

    // Connect to the database
    require_once("../files/config.php");

    // Check if the user has submitted the password reset form
    if (isset($_POST['reset_password'])) {
        // Get the user's email and old password from the form
        $email = $_SESSION['email'];
        $old_password = $_POST['old_password'];

        // Check if the old password is correct
        $stmt = $link->prepare("SELECT password FROM `users` WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $hashed_old_password = $row['password'];

        if (password_verify($old_password, $hashed_old_password)) {
            // If the old password is correct, get the new passwords from the form
            $new_password1 = $_POST['new_password1'];
            $new_password2 = $_POST['new_password2'];

            // Check if the new passwords match
            if ($new_password1 === $new_password2) {
                // If the new passwords match, hash the new password and update the user's password in the database
                $hashed_new_password = password_hash($new_password1, PASSWORD_DEFAULT);
                $stmt = $link->prepare("UPDATE `users` SET password = ? WHERE email = ?");
                $stmt->bind_param("ss", $hashed_new_password, $email);
                $stmt->execute();

                // Redirect to the dashboard page
                header("Location: dashboard.php");
                exit();
            } else {
                // If the new passwords don't match, show an error message
                $error = "New passwords don't match";
            }
        } else {
            // If the old password is incorrect, show an error message
            $error = "Invalid password";
        }
    }
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

        <title>Verander Wachtwoord || Het Oventje</title>
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

        <h1>Reset Password</h1>
        <?php if (isset($error)) : ?>
            <div><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <div>
                <label>Old Password</label>
                <input type="password" name="old_password" required>
            </div>
            <div>
                <label>New Password</label>
                <input type="password" name="new_password1" required>
            </div>
            <div>
                <label>Confirm New Password</label>
                <input type="password" name="new_password2" required>
            </div>
            <div>
                <button type="submit" name="reset_password">Reset Password</button>
            </div>
        </form>
    </body>

</html>