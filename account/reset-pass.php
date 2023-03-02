<?php
    // Start a session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['loggedin'])) {
        // If the user is not logged in, redirect to the login page
        header("Location: login.php");
        exit();
    }

    // Connect to the database
    require_once("../files/config.php");

    // Check if the user has submitted the password reset form
    if (isset($_POST['reset'])) {
        // Get the current id from the session
        $id = $_SESSION['id'];

        // Get the new password and confirm password from the form
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        $sql = "SELECT password FROM users WHERE id = '$id'";
        $result = mysqli_query($link, $sql);

        // Get the users current password
        if ($row = mysqli_fetch_assoc($result)) {
            $current_password = $row['password'];
        }




        // Check if the new password and confirm password match
        if ($new_password === $confirm_password) {
            // If the passwords match, update the user's password in the database
            $sql = "UPDATE users SET password='$new_password' WHERE id='$id' AND password='$current_password'";
            mysqli_query($conn, $sql);

            // Log the user out and redirect to the login page
            session_destroy();
            header("Location: index.php");
            exit();
            } else {
            // If the passwords don't match, show an error message
            $error = "Passwords do not match";
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
        <label>New Password</label>
        <input type="password" name="new_password" required>
      </div>
      <div>
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" required>
      </div>
      <div>
        <button type="submit" name="reset">Reset Password</button>
      </div>
    </form>
  </body>

</html>