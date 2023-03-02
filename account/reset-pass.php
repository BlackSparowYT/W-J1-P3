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
        <title>Reset Password</title>
    </head>

    <body>
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