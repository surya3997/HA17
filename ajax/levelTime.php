<?php 
    include '../includes/config.php';

    if(!$session->isLoggedIn()) {
        die(json_encode(array('status' => ENUM_STATUS_AUTH_FAILED)));
    }

    if(!isset($_REQUEST['level'])) {
        die(json_encode(array('status' => ENUM_STATUS_ILLEGAL)));
    }

    $level = clean($_REQUEST['level']);    

    $levelDataMgr = new LevelDataManager($level);
    $levelDataMgr->IncreaseTimeSpentOnLevel();

    echo json_encode(array('status' => ENUM_STATUS_OK));
?>