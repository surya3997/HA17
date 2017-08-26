<?php
    // include './includes/common_functions.php';
    include './includes/config.php';
    
    if (!$session->isLoggedIn()) {
        header("Location:login.php");
    }

    $sql = 'SELECT `anim_viewed` 
            FROM '.DBT_USER_LEVELS.'
            WHERE `user_id` = \''.$user->getUserId().'\'
                    AND `level_id` = \'1\'';
    
    $query = $db->query($sql);
    $result = $db->result($query);
    if ($result->anim_viewed == '0') {
        header('Location:narrator.php?level=1');
    }

    /* change this */
    
    $template->setPageTitle('Hack-a-Venture');
    $template->setPage('0');
    $template->loadPage();
?>
