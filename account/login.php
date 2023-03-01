<?php
    // Start a session
    session_start();
    
    require_once("../files/config.php");

    // Check if the  has submitted the login form
    if (isset($_POST['login'])) {
        // Get the email and password from the form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query the database to check if the  exists
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($link, $sql);

        // If the  exists, log them in and redirect to the dashboard page
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['loggedin'] = 'yes';




            $email = $_SESSION['email'];
            $sql = "SELECT admin, name FROM users WHERE email = '$email'";
            $result = mysqli_query($link, $sql);

            // Check if user has admin access
            if ($row = mysqli_fetch_assoc($result)) {
                $admin = $row['admin'];
                if ($admin == 1) {
                    $_SESSION["admin"] = true;
                } else {
                    $_SESSION["admin"] = false;
                }

                $name = $row['name'];
                $_SESSION['name'] = $name;
            }



            header("Location: dashboard.php");
            exit();

        } else {
            // If the  doesn't exist, show an error message
            $error = "<h4 style='color: red;'>Invalid name or password</h4>";
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
  <?php if (isset($error)): ?>
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
    <p>Dont have an account? <a href="register.php">Register</a></p>
  </form>
</body>
</html>