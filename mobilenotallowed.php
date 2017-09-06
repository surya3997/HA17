<?php
    include 'includes/config.php';
    if($session->isLoggedIn()) {
        $session->logout();
    }
    $template->loadCustomPage('mobilenotallowed');
?>
