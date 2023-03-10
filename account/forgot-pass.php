<?php
    // Start a session
    session_start();

    // Connect to the database
    require_once("../files/config.php");

    // Check if the user has submitted the form
    if (isset($_POST['reset_password'])) {
        // Get the email, password and reset token from the form
        $email = $_POST['email'];
        $new_password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $reset_token = $_GET['token'];

        // Validate the inputs
        $errors = array();
        if ($email === "") {
            $errors[] = "Please enter your email.";
        }
        if ($new_password === "") {
            $errors[] = "Please enter your new password.";
        }
        if ($confirm_password === "") {
            $errors[] = "Please confirm your new password.";
        }
        if ($new_password !== $confirm_password) {
            $errors[] = "The new password and confirmation do not match.";
        }

        // Check if the reset token is valid for the email
        $stmt = $link->prepare("SELECT * FROM `users` WHERE email = ? AND reset_token = ?");
        $stmt->bind_param("ss", $email, $reset_token);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            $errors[] = "Invalid reset token.";
        } else {
            $token_valid = '<p>Your token is invalid or has expired</p>
            <p><a href="ask-forgot-password.php">Request a new password reset link</a></p>';
        }

        if (count($errors) == 0) {

            $new_token = substr(bin2hex(random_bytes(16)), 0, 32);

            // If there are no errors, update the password in the database
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $link->prepare("UPDATE `users` SET password = ?, reset_token = ? WHERE email = ?");
            $stmt->bind_param("sss", $hashed_password, $new_token, $email);
            $stmt->execute();

            // Set a success message and redirect to the login page
            header("Location: login.php");
            exit();
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

        <title>Wachtwoord Vergeten || Het Oventje</title>
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

        <main class="login-page account-page">
            <div class="hero">
                <div class="hero-text">
                    <h1 class="t1">Wachtwoord Vergeten</h1>
                </div>
            </div>
            <div class="forum">
                <form method="post">
                    <div>
                        <h3 for="email">Email</h3>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div>
                        <h3 for="password">Nieuw Wachtwoord</h3>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div>
                        <h3 for="confirm_password">Bevestig Nieuw Wachtwoord</h3>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    <?php if (isset($errors) && !empty($errors)) : ?>
                        <div>
                            <?php foreach ($errors as $error) : ?>
                                <p><?php echo $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <button type="submit" name="reset_password">Reset Password</button>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>