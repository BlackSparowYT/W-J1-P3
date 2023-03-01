<?php
    // Start a session
    session_start();

    // Connect to the database
    require_once("../files/config.php");

    // Check if the user has submitted the registration form
    if (isset($_POST['register'])) {
        // Get the email and password from the form
        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = substr($_POST["email"], 0, stripos($_POST["email"], "@") );

        // Check if the email already exists
        $sql = "SELECT * FROM `users` WHERE email = '$email'";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) == 0) {
            // If the email doesn't exist, insert the user into the database
            $sql = "INSERT INTO `users` (email, password, username) VALUES ('$email', '$password', '$username')";
            mysqli_query($link, $sql);

            // Log the user in and redirect to the dashboard page
            header("Location: login.php");
            exit();
        } else {
            // If the email already exists, show an error message
            $error = "email already taken";
        }
    }
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Register</title>
    </head>

    <body>
        <h1>Register</h1>
        <?php if (isset($error)) : ?>
            <div><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <div>
                <label>Email</label>
                <input type="text" name="email" required>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <button type="submit" name="register">Register</button>
            </div>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </body>

</html>