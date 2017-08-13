<?php
    include 'includes/config.php';

    if($session->isLoggedIn()) {
        PageRedirect('index');
    } 

    /* change this */
    include $rootpath.'templates/c_template_resend.php';
?>