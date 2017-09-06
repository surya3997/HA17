<?php
    include 'includes/config.php';

    if($session->IsLoggedIn()) {
        PageRedirect('index');
    }

    /* change this */
    include $rootpath.'templates/c_template_register1.php';
?>