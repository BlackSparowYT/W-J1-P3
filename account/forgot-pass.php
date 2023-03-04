<?php
    // Start a session
    session_start();

    // Connect to the database
    require_once("../files/config.php");

    // Check if the user has submitted the form
    if (isset($_POST['reset_password'])) {
        // Get the email, password and reset token from the form
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $reset_token = $_GET['reset_token'];

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
        $stmt = $link->prepare("SELECT * FROM `password_resets` WHERE email = ? AND token = ?");
        $stmt->bind_param("ss", $email, $reset_token);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            $errors[] = "Invalid reset token.";
        }

        if (count($errors) == 0) {
            // If there are no errors, update the password in the database
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $link->prepare("UPDATE `users` SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $hashed_password, $email);
            $stmt->execute();

            // Delete the reset token from the database
            $stmt = $link->prepare("DELETE FROM `password_resets` WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            // Set a success message and redirect to the login page
            $_SESSION['success'] = "Your password has been reset. Please login with your new password.";
            header("Location: login.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password</title>
    </head>
    <body>
        <h1>Reset Password</h1>
        <?php if (isset($errors) && !empty($errors)) : ?>
            <div>
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (!$token_valid) : ?>
            <div>
                <p>Invalid or expired token.</p>
                <p><a href="forgot_password.php">Request a new password reset link</a></p>
            </div>
        <?php else : ?>
            <form method="post">
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <div>
                    <button type="submit" name="reset_password">Reset Password</button>
                </div>
            </form>
        <?php endif; ?>
    </body>
</html>