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
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sono:wght@300;600;800&display=swap" rel="stylesheet">

        <title>Login || Het Oventje</title>
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

        <main class="login-page">
            <div class="hero">
                <div class="hero-text">
                    <h1 class="t1">Login</h1>
                </div>
            </div>
            <div class="forum">
                <form method="post">
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div>
                        <label>Wachtwoord</label>
                        <input type="password" name="password" required>
                    </div>
                    <?php if (isset($error)) : ?>
                        <div><?php echo $error; ?></div>
                    <?php endif; ?>
                    <div>
                        <button type="submit" name="login">Login</button>
                    </div>
                    <p>Heb je nog geen account? <a href="register.php">Registreer</a></p>
                </form>
            </div>
        </main>
    </body>

</html>