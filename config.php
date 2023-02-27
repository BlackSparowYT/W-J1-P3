<?php

    // Webhost Database Login, User has only read perms for the required tables!        

    $user = 'blackspa_w-j1-p3';
    $password = '-U9+bTHY#Nub';
    $database = 'blackspa_w-j1-p3';
    $servername = '116.202.134.139';
    $link = new mysqli($servername, $user, $password, $database);

    if (!$link){
        echo "<p style='color: red;'>Connection Unsuccessful!!!</p>";
    }

?>