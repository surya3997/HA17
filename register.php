<?php
    include 'includes/config.php';
/*
    if($session->IsLoggedIn()) {
        PageRedirect('index');
    }*/

    $rootpath = $_SERVER['DOCUMENT_ROOT'].'/HA17/';

    include $rootpath.'templates/c_template_register.php';
?>