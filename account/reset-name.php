<?php
    // Start a session
    session_start();

    // Connect to the database
    require_once("../files/config.php");

    // Check if the user has submitted the form
    if (isset($_POST['change_username'])) {
        // Get the password from the form
        $new_username = $_POST['new_username'];
        $confirm_username = $_POST['confirm_username'];
        $password = $_POST['password'];

        // Validate the inputs
        $errors = array();
        if ($new_username === "") {
            $errors[] = "Please enter your new username.";
        }
        if ($confirm_username === "") {
            $errors[] = "Please confirm your new username.";
        }
        if ($new_username !== $confirm_username) {
            $errors[] = "The new username and confirmation do not match.";
        }
        if ($password === "") {
            $errors[] = "Please enter your password.";
        }

        // Check if the password is correct
        $stmt = $link->prepare("SELECT * FROM `users` WHERE email = ?");
        $stmt->bind_param("s", $_SESSION['email']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if (!password_verify($password, $user['password'])) {
            $errors[] = "Invalid password.";
        }

        // Check if the new username already exists
        $stmt = $link->prepare("SELECT * FROM `users` WHERE name = ?");
        $stmt->bind_param("s", $new_username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $errors[] = "The new username is already taken.";
        }

        if (count($errors) == 0) {
            // If there are no errors, update the username in the database
            $stmt = $link->prepare("UPDATE `users` SET name = ? WHERE email = ?");
            $stmt->bind_param("ss", $new_username, $_SESSION['email']);
            $stmt->execute();

            // Set a success message and redirect to the dashboard
            $_SESSION['name'] = $new_username;
            header("Location: dashboard.php");
            exit();
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Change Username</title>
    </head>
    <body>
        <h1>Change Username</h1>
        <?php if (isset($error)) : ?>
            <div><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <div>
                <label>New Username</label>
                <input type="text" name="new_username" required>
            </div>
            <div>
                <label>Confirm New Username</label>
                <input type="text" name="confirm_username" required>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <button type="submit" name="change_username">Change Username</button>
            </div>
        </form>
    </body>
</html>