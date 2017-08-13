<?php
    include 'includes/config.php';
    

    if(!$session->isLoggedIn()) {
        header("Location:login.php");
    }

    /* change this */
    echo "You have logged in successfully!";
?>
