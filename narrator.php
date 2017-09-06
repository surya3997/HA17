<?php
    include_once 'includes/config.php';

    if(!$session->isLoggedIn()) {   //redirect to login if the user is not authenticated.
        PageRedirect('login');
    }

    //The stage should be specified via a stage_data variable. This will contain a hash of the level id
    if(!isset($_GET['level']) || $_GET['level'] == '') {
        PageRedirect('index');
    }
    
    $level = clean($_GET['level']);
    
    //Check if the level is open.
    if(!$levelMgr->IsLevelOpen($level)) {
        header('Location:index.php');
    }

    

    //Clear this level's anim_viewed flag. 
    $sql = 'UPDATE '.DBT_USER_LEVELS.'
                SET `anim_viewed` = \'1\'
                WHERE `user_id` = \''.$user->getUserId().'\'
                    AND `level_id` = \''.$level.'\'';
    $query = $db->query($sql);

    $template->loadCustomPage('narrator');
?>