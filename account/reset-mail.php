<?php
    // Start a session
    session_start();

    // Connect to the database
    require_once("../files/config.php");

    // Check if the user has submitted the form
    if (isset($_POST['change_email'])) {
        // Get the email and password from the form
        $new_email = $_POST['new_email'];
        $confirm_email = $_POST['confirm_email'];
        $password = $_POST['password'];

        // Validate the inputs
        $errors = array();
        if ($new_email === "") {
            $errors[] = "Please enter your new email.";
        }
        if ($confirm_email === "") {
            $errors[] = "Please confirm your new email.";
        }
        if ($new_email !== $confirm_email) {
            $errors[] = "The new email and confirmation do not match.";
        }
        if ($password === "") {
            $errors[] = "Please enter your password.";
        }

        // Check if the password is correct
        $stmt = $link->prepare("SELECT * FROM `users` WHERE name = ?");
        $stmt->bind_param("s", $_SESSION['name']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if (!password_verify($password, $user['password'])) {
            $errors[] = "Invalid password.";
        }

        // Check if the new email already exists
        $stmt = $link->prepare("SELECT * FROM `users` WHERE email = ?");
        $stmt->bind_param("s", $new_email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $errors[] = "The new email is already taken.";
        }

        if (count($errors) == 0) {
            // If there are no errors, update the email in the database
            $stmt = $link->prepare("UPDATE `users` SET email = ? WHERE name = ?");
            $stmt->bind_param("ss", $new_email, $_SESSION['name']);
            $stmt->execute();

            // Set a success message and redirect to the dashboard
            $_SESSION['email'] = $new_email;
            header("Location: dashboard.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Change Email</title>
    </head>
    <body>
        <h1>Change Email</h1>
        <?php if (isset($error)) : ?>
            <div><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <div>
                <label>New Email</label>
                <input type="email" name="new_email" required>
            </div>
            <div>
                <label>Confirm New Email</label>
                <input type="email" name="confirm_email" required>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <button type="submit" name="change_email">Change Email</button>
            </div>
        </form>
    </body>
</html>