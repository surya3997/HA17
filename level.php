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
    
    //Set the start time of the level.
    $sql = 'SELECT `open_time`, `anim_viewed`
                FROM '.DBT_USER_LEVELS.'
                WHERE `level_id` = \''.$level.'\'
                    AND `user_id` = \''.$user->getUserId().'\'';
    $query = $db->query($sql);
    $result = $db->result($query);
    if($result->open_time == NULL) {    //Make this the first entry.
        $cTime = time();
        $sql = 'UPDATE '.DBT_USER_LEVELS.'
                    SET `open_time` = \''.$cTime.'\'
                        WHERE `level_id` = \''.$level.'\'
                            AND `user_id` = \''.$user->getUserId().'\'';
        $db->query($sql);
    }
    
    //If the animation is not view show the narator. 
    if($result->anim_viewed == 0) {
        header('Location:narrator.php?level='.$level);
    }
    
    $db->freeResults($query);
    
    //Set up the level data handler for that level.
    $levelDataMgr = new LevelDataManager($level);

    $sql = 'UPDATE `ha_user` SET `current_level`= '.$level.' WHERE id = '.$user->getUserId();
    $db->query($sql);
    
    //We need some setup for each level. We store them in separate files in another folder.
    //They will be included into this file as required.
    include 'levels_detail/detail_php_level_'.$level.'.php';

    
    //We need the templating engine to load the require page.
    $template->setPageTitle('Level');
    $template->setPage($level);
    //$template->setLevelId($level);
    $template->loadPage();
?>