<?php
    // Start a session
    session_start();

    // Connect to the database
    require_once("../files/config.php");

    // Check if the user has submitted the registration form
    if (isset($_POST['register'])) {
        // Get the email, username, and password from the form
        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = $_POST['username'];
        

        // Generate a random reset token
        $reset_is_same = true;
        while ($reset_is_same == true) {
            $reset_token = substr(bin2hex(random_bytes(16)), 0, 32);
            $stmt = $link->prepare("SELECT * FROM `users` WHERE reset_token = ?");
            $stmt->bind_param("s", $reset_token);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                $reset_is_same = false;
            }
        }

        // Check if the email already exists
        $stmt = $link->prepare("SELECT * FROM `users` WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // If the email doesn't exist, hash the password and insert the user into the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $link->prepare("INSERT INTO `users` (email, password, name, reset_token) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $email, $hashed_password, $username, $reset_token);
            $stmt->execute();

            // Log the user in and redirect to the dashboard page
            header("Location: login.php");
            exit();
        } else {
            // If the email already exists, show an error message
            $error = "Email already taken";
        }
    }
?>

<!DOCTYPE html>
<html>
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
            <label>Username</label>
            <input type="text" name="username" required>
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