<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sono:wght@300;600;800&display=swap" rel="stylesheet">

        <title>Item Help || Het Oventje</title>
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
                   <h1 class="t1">Item Help</h1>
                </div>
            </div>

            <div class="forum">
                <form method="post">
                    <h2>Hoe voeg je items toe / bewerk je items</h2>
                    <br>
                    <h3>Foto Link:</h3>
                    <p>
                        Dit is de link naar de foto, standaart zal de link naar de foto dit zijn "../files/images/menu/foto-naam.png".
                        <br>
                        Voeg je een item to of pas je hem aan zorg dan dat het naar de goede foto naam wijst of zorg ervoor dat de foto is geupload.
                    </p>
                    <br>
                    <h3>Groten en Kleine beschrijvingen:</h3>
                    <p>
                        Hier kun je een beschrijving voor het product toevoegen. De kleine zal op het menu pagina worden weergeven (zorg dus dat deze klein is).
                        <br>
                        De grote beschrijven word op de product pagina laten zien hier kun je zo veel als je wilt in zetten.   
                    </p>
                    <br>
                    <h3>Prijs:</h3>
                    <p>
                        Prijs van het product. Format is €**.** (€euro.centen).
                    </p>
                    <br>
                    <h3>Categorie:</h3>
                    <p>
                        Categorie van het product (kies uit "pizza", "dranken" of "bijgerecht").
                    </p>
                    <br>
                    <h3>Sub Categorie:</h3>
                    <p>
                        Sub categorie van het product hier kun je allen "veggi" invullen als het product veggitarisch is.
                    </p>
                </form>
            </div>
        </main>
    </body>

</html>