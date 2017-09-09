<?php
    include 'includes/config.php';

    if($session->IsLoggedIn()) {
        PageRedirect('index');
    }

    /* change this */
    $template->loadCustomPage('register1');
?>
