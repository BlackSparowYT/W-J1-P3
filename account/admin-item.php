<?php

    ini_set('display_errors', 0);
    
    // Start a session
    session_start();

    require_once("../files/config.php");

    if ($_SESSION['loggedin'] !== true) {
        header("location: login.php");
    }


    $item_id = $action = NULL;

    $action = $_GET["action"];
    $item_id = $_GET["id"];

    if ($action == "edit"){
        $stmt = $link->prepare("SELECT * FROM `menu` WHERE id = ?");
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
        $is_run = $stmt->get_result();
        $result = mysqli_fetch_assoc($is_run);

        $old_name = $result["name"];
        $old_image = $result["image"];
        $old_smalldesc = $result["small_desc"];
        $old_largedesc = $result["large_desc"];
        $old_prijs = $result["prijs"];
        $old_cat = $result["categorie"];
        $old_subcat = $result["sub_categorie"];
    }

    if (isset($_POST['add_item'])) {    
        $new_name = $_POST['new_name'];
        $new_image = $_POST['new_image'];
        $new_smalldesc = $_POST['new_smalldesc'];
        $new_largedesc = $_POST['new_largedesc'];
        $new_prijs = $_POST['new_prijs'];
        $new_cat = $_POST['new_cat'];
        $new_subcat = $_POST['new_subcat'];

        $stmt = $link->prepare("INSERT INTO `menu`(`name`, `image`, `small_desc`, `large_desc`, `prijs`, `categorie`, `sub_categorie`) VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $new_name, $new_image, $new_smalldesc, $new_largedesc, $new_prijs, $new_cat, $new_subcat);
        $stmt->execute();

        header("location: admin-menu.php");
        exit;
    }
    else if (isset($_POST['edit_item'])) {
        $new_name = $_POST['new_name'];
        $new_image = $_POST['new_image'];
        $new_smalldesc = $_POST['new_smalldesc'];
        $new_largedesc = $_POST['new_largedesc'];
        $new_prijs = $_POST['new_prijs'];
        $new_cat = $_POST['new_cat'];
        $new_subcat = $_POST['new_subcat'];
    

        $stmt = $link->prepare("UPDATE `menu` SET name = ?, image = ?, small_desc = ?, large_desc = ?, prijs = ?, categorie = ?, sub_categorie = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", $new_name, $new_image, $new_smalldesc, $new_largedesc, $new_prijs, $new_cat, $new_subcat, $item_id);
        $stmt->execute();

        header("location: admin-menu.php");
        exit;
    }
    else if (isset($_POST['delete_item'])) {
        $stmt = $link->prepare("DELETE FROM `menu` WHERE id = ?");
        $stmt->bind_param("i", $item_id);
        $stmt->execute();

        header("location: admin-menu.php");
        exit;
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
        
        <title>Item <?php echo htmlspecialchars($item_id." - ".$action); ?> || Het Oventje</title>
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
                        <a class="t1" href="../index.html">
                            <h3>Home</h3>
                        </a>
                        <a class="t2" href="../menu/index.php">
                            <h3>Menu</h3>
                        </a>
                        <a class="t3" href="../over-ons/index.html">
                            <h3>Over Ons</h3>
                        </a>
                        <a class="t4" href="../contact/index.html">
                            <h3>Contact</h3>
                        </a>
                        <a class="t5" href="../account/login.php">
                            <h3>Account</h3>
                        </a>
                    </div>
                </div>

                <div id="navbar-mobile">
                    <div class="navbar-mobile-sitelogo">
                        <img src="../files/images/logo-white-side.png">
                    </div>
                    <div class="navbar-mobile-items">
                        <a onclick="openNav()">
                            <h3>&#9776;</h3>
                        </a>
                    </div>
                    <div id="navbar-mobile-fullscreen" class="nav-overlay">
                        <a href="javascript:void(0)" class="closebtn t1" onclick="closeNav()">&times;</a>
                        <div class="nav-overlay-content">
                            <a class="t1" href="../index.html">
                                <h3>Home</h3>
                            </a>
                            <a class="t2" href="../menu/index.php">
                                <h3>Menu</h3>
                            </a>
                            <a class="t3" href="../over-ons/index.html">
                                <h3>Over Ons</h3>
                            </a>
                            <a class="t4" href="../contact/index.html">
                                <h3>Contact</h3>
                            </a>
                            <a class="t5" href="../account/login.php">
                                <h3>Account</h3>
                            </a>
                        </div>
                    </div>
                </div>

                <script>
                    function openNav() {
                        document.getElementById("navbar-mobile-fullscreen").style.height = "100%";
                    }

                    function closeNav() {
                        document.getElementById("navbar-mobile-fullscreen").style.height = "0%";
                    }
                </script>
            </nav>
        </header>



        <main class="admin-item account-page">
            <div class="hero">
                <div class="hero-text">
                    <?php if($action != "add") : ?>
                        <h1 class="t1">Item: <?php echo htmlspecialchars($item_id." - ".$action); ?></h1>
                    <?php endif; ?>
                    <?php if($action == "add") : ?>
                        <h1 class="t1">Add Item</h1>
                    <?php endif; ?>
                </div>
            </div>

            

            
            <div class="forum">
                <form method="post">
                    <?php if($action == 'add'): ?>
                        <div class="flexbox">
                            <div>
                                <h3>Item Name</h3>
                                <input type="text" name="new_name" required>
                            </div>
                            <div>
                                <h3>Image Link</h3>
                                <input type="text" name="new_image" required>
                            </div>
                        </div>
                        <div class="flexbox">
                            <div>
                                <h3>Small Description</h3>
                                <input type="text" name="new_smalldesc">
                            </div>
                            <div>
                                <h3>Large Description</h3>
                                <input type="text" name="new_largedesc">
                            </div>
                        </div>
                        <div class="flexbox">
                            <div>
                                <h3>Item Prijs</h3>
                                <input type="text" name="new_prijs" required>
                            </div>
                            <div>
                                <h3>Item Categorie</h3>
                                <input type="text" name="new_cat" required>
                            </div>
                        </div>
                        <div class="flexbox">
                            <div>
                                <h3>Item Sub Categorie</h3>
                                <input type="text" name="new_subcat">
                            </div>
                            <!--<div>
                                <h3>Select image file to upload:</h3>
                                <input type="file" name="file" accept="image/*"><br>
                            </div>-->
                        </div>
                        <div>
                            <button type="submit" name="add_item">Add item</button>
                        </div>
                    <?php endif; ?>
                    <?php if($action == 'edit'): ?>
                        <div class="flexbox">
                            <div>
                                <h3>Item Name</h3>
                                <input 
                                    type="text" 
                                    name="new_name" 
                                    <?php echo "value='".$old_name."'" ?> 
                                    required
                                >
                            </div>
                            <div>
                                <h3>Image Link</h3>
                                <input 
                                    type="text" 
                                    name="new_image" 
                                    <?php echo "value='".$old_image."'" ?> 
                                    required
                                >
                            </div>
                        </div>
                        <div class="flexbox">
                            <div>
                                <h3>Small Description</h3>
                                <input 
                                    type="text" 
                                    name="new_smalldesc" 
                                    <?php echo "value='".$old_smalldesc."'" ?> 
                                >
                            </div>
                            <div>
                                <h3>Large Description</h3>
                                <input 
                                    type="text" 
                                    name="new_largedesc" 
                                    <?php echo "value='".$old_largedesc."'" ?> 
                                >
                            </div>
                        </div>
                        <div class="flexbox">
                            <div>
                                <h3>Item Prijs</h3>
                                <input 
                                    type="text" 
                                    name="new_prijs"
                                    <?php echo "value='".$old_prijs."'" ?> 
                                    required
                                >
                            </div>
                            <div>
                                <h3>Item Categorie</h3>
                                <input 
                                    type="text" 
                                    name="new_cat" 
                                    <?php echo "value='".$old_cat."'" ?> 
                                    required
                                >
                            </div>
                        </div>
                        <div class="flexbox">
                            <div>
                                <h3>Item Sub Categorie</h3>
                                <input 
                                    type="text" 
                                    name="new_subcat"
                                    <?php echo "value='".$old_subcat."'" ?> 
                                >
                            </div>
                            <!--<div>
                                <h3>Item Image</h3>
                                <input 
                                    type="file" 
                                    name="file"
                                >
                            </div>-->
                        </div>
                        <div class="flexbox">
                            <div>
                                <button type="submit" name="edit_item">Edit item</button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($action == 'delete'): ?>
                        <div class="flexbox">
                            <div>
                                <button type="submit" name="delete_item">Delete item</button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <p><a href="admin-menu.php">&#x2190; Terug</a></p>
                </form>
            </div>
        </main>
    </body>

</html>