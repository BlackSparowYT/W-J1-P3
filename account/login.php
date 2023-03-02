<?php
  // Start a session
  session_start();

  require_once("../files/config.php");

  // Check if the user has submitted the login form
  if (isset($_POST['login'])) {
    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database to check if the email exists
    $stmt = $link->prepare("SELECT password FROM `users` WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

      $row = $result->fetch_assoc();
      $hashed_password = $row['password'];

      // Use password_verify to check if the entered password matches the hashed password
      if (password_verify($password, $hashed_password)) {

        $_SESSION['email'] = $email;
        $_SESSION['loggedin'] = 'yes';

        $stmt = $link->prepare("SELECT admin, name, id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user has admin access
        if ($row = mysqli_fetch_assoc($result)) {
          $admin = $row['admin'];
          if ($admin == 1) {
            $_SESSION["admin"] = true;
          } else {
            $_SESSION["admin"] = false;
          }

          $_SESSION['id'] = $row['id'];
          $_SESSION['name'] = $row['name'];
        }

        header("Location: dashboard.php");
        exit();
      } else {
        // If the password doesn't match, show an error message
        $error = "<h4 style='color: red;'>Invalid password" . $hashed_password . "</h4>";
      }
    } else {
      // If the password doesn't match, show an error message
      $error = "<h4 style='color: red;'>Invalid email</h4>";
    }
  }
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Login Page</title>
  </head>

  <body>
    <h1>Login</h1>
    <?php if (isset($error)) : ?>
      <div><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post">
      <div>
        <label>Email</label>
        <input type="email" name="email" required>
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password" required>
      </div>
      <div>
        <button type="submit" name="login">Login</button>
      </div>
      <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
  </body>

</html>