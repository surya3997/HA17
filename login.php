<?php
    include 'includes/config.php';

    if($session->isLoggedIn()) {
        PageRedirect('index');
    } 

    /* change this */
    $template->loadCustomPage('login');
?>
